<?php

namespace App\Infraestructura;

use App\Core\Dominio\Producto;
use App\Core\Dominio\ProductoRepository;

class ProductoRepositoryFb implements ProductoRepository
{
    /**
     * @inheritdoc
     */
    public function search(string $filtro): array
    {
        $data = FirebaseConnection::get("/productos", [
            'orderBy' => '"nombre"', // Busca por el atributo nombre
            'startAt' => "\"$filtro\"",
            'endAt' => "\"$filtro\uf8ff\""
        ]);

        if ($data === false) {
            return [];
        }

        $list = [];
        foreach ($data as $id => $row) {
            $list[$id] = new Producto(
                $id,
                $row['nombre'],
                $row['marca'],
                floatval($row['precio']),
                intval($row['talla']),
                $row['color'],
                intval($row['stock'])
            );
        }

        // Siempre devuelve un array, aunque sea vacío
        return $list;
    }

    public function nextIdentity(): int
    {
        // Genera un ID único usando la marca de tiempo actual
        return time();
    }

    public function store(Producto $producto): bool
    {
        $data = [
            'nombre' => $producto->getNombre(),
            'marca' => $producto->getMarca(),
            'precio' => $producto->getPrecio(),
            'talla' => $producto->getTalla(),
            'color' => $producto->getColor(),
            'stock' => $producto->getStock(),
        ];

        FirebaseConnection::set("/productos/" . $producto->getId(), $data);
        return true;
    }

    public function remove(int $productoId): bool
    {
        //FirebaseConnection::delete("/productos/$productoId");
        return true;
    }

    public function getById(int $id): Producto|false
    {
        $data = FirebaseConnection::get("/productos/$id");

        if ($data === false) {
            return false;
        }

        return new Producto(
            $id,
            $data['nombre'],
            $data['marca'],
            floatval($data['precio']),
            intval($data['talla']),
            $data['color'],
            intval($data['stock'])
        );
    }
}