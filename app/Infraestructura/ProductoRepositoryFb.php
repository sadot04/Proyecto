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
                //intval($row['talla']),
                $row['color'],
                intval($row['stock36']),
                intval($row['stock38']),
                intval($row['stock40']),
                intval($row['stock42']),
                intval($row['stock44']),
                $row['imagenUrl']
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
            //'talla' => $producto->getTalla(),
            'color' => $producto->getColor(),
            'stock36' => $producto->getStock36(),
            'stock38' => $producto->getStock38(),
            'stock40' => $producto->getStock40(),
            'stock42' => $producto->getStock42(),
            'stock44' => $producto->getStock44(),
            'imagenUrl' => $producto->getImagenUrl()
        ];

        FirebaseConnection::set("/productos/" . $producto->getId(), $data);
        return true;
    }



    public function remove(int $productoId): bool
    {
        try {
            // Obtén la instancia de la base de datos
            $factory = new \Kreait\Firebase\Factory();
            $database = $factory
                ->withServiceAccount(base_path('storage/app/firebase_credentials.json'))
                ->withDatabaseUri('https://tbproyectos-f05e7-default-rtdb.firebaseio.com')
                ->createDatabase();

            // Elimina el nodo del producto
            $database->getReference("/productos/$productoId")->remove();
            return true;
        } catch (\Throwable $e) {
            // Loguea el error y retorna false si algo falla
            // Log::error($e->getMessage());
            return false;
        }
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
            //intval($data['talla']),
            $data['color'],
            intval($data['stock36']),
            intval($data['stock38']),
            intval($data['stock40']),
            intval($data['stock42']),
            intval($data['stock44']),
            $data['imagenUrl']
        );
    }

}
