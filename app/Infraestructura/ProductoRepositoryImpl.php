<?php

namespace App\Infraestructura;

use App\Core\Dominio\Producto;
use Illuminate\Support\Facades\DB;
use App\Core\Dominio\ProductoRepository;

class ProductoRepositoryImpl implements ProductoRepository
{
    /**
     * @inheritdoc
     */
    public function search(string $filtro): array
    {
        // convierte en mayusculas el filtro y el nombre en la bd
        $data = DB::select(
            "
            SELECT * 
            FROM producto
            WHERE upper(nombre) LIKE :FILTRO
            ORDER BY codigo
            ",
            [
                ':FILTRO' => '%' . strtoupper($filtro) . '%', // concatena %filtro% para el LIKE
            ]
        );

        $list = [];

        foreach ($data as $row) {
            $list[$row->id] = new Producto(
                $row->id,
                $row->codigo,
                $row->nombre,
                $row->precio,
            );
        }

        // siempre devuelve un array, aunque sea vacío
        return $list;
    }

    public function nextIdentity(): int
    {
        return DB::scalar("SELECT nextval('producto_id_seq') as id");
    }

    public function store(Producto $producto): bool
    {
        return DB::insert(
            "
            INSERT INTO producto(id, codigo, nombre, precio) 
            VALUES (?, ?, ?, ?)
            ON CONFLICT(id)             -- <-- esto es propio de postgres
            DO UPDATE SET    
                codigo = EXCLUDED.codigo,
                nombre = EXCLUDED.nombre,
                precio = EXCLUDED.precio
            ",
            [
                $producto->getId(),
                $producto->getCodigo(),
                $producto->getNombre(),
                $producto->getPrecio(),
            ]
        );
    }

    public function remove(int $productoId): bool
    {
        return DB::table('producto')->delete($productoId) > 0;
    }

    public function getById(int $id): Producto|false
    {
        $row = DB::table('producto')->find($id);

        if (null == $row) {
            return false;
        }

        return new Producto(
            $row->id,
            $row->codigo,
            $row->nombre,
            $row->precio,
        );
    }
}
