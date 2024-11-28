<?php

namespace App\Infraestructura;

use App\Core\Dominio\Pedido;
use App\Core\Dominio\PedidoRepository;

class PedidoRepositoryFb implements PedidoRepository
{
    /**
     * @inheritdoc
     */
    public function search(string $filtro): array
    {
        $data = FirebaseConnection::get("/pedidos", [
            'orderBy' => '"estado"', // Busca por el atributo estado
            'startAt' => "\"$filtro\"",
            'endAt' => "\"$filtro\uf8ff\""
        ]);

        if ($data === false) {
            return [];
        }

        $list = [];
        foreach ($data as $id => $row) {
            $list[$id] = new Pedido(
                intval($id), // Conversión del ID
                $row['estado'],
                floatval($row['total']),
                $row['tipoPago'],
                $row['nroTransaccion'],
                $row['productos'] // Array de productos
            );
        }

        return $list;
    }

    public function nextIdentity(): int
    {
        // Genera un ID único usando la marca de tiempo actual
        return time();
    }

    public function store(Pedido $pedido): bool
    {
        $data = [
            'estado' => $pedido->getEstado(),
            'total' => $pedido->getTotal(),
            'tipoPago' => $pedido->getTipoPago(),
            'nroTransaccion' => $pedido->getNroTransaccion(),
            'productos' => $pedido->getProductos(), // Almacena el array de productos
        ];

        FirebaseConnection::set("/pedidos/" . $pedido->getId(), $data);
        return true;
    }

    public function remove(int $pedidoId): bool
    {
        try {
            // Obtén la instancia de la base de datos
            $factory = new \Kreait\Firebase\Factory();
            $database = $factory
                ->withServiceAccount(base_path('storage/app/firebase_credentials.json'))
                ->withDatabaseUri('https://tbproyectos-f05e7-default-rtdb.firebaseio.com')
                ->createDatabase();

            // Elimina el nodo del pedido
            $database->getReference("/pedidos/$pedidoId")->remove();
            return true;
        } catch (\Throwable $e) {
            // Loguea el error y retorna false si algo falla
            // Log::error($e->getMessage());
            return false;
        }
    }

    public function getById(int $id): Pedido|false
    {
        $data = FirebaseConnection::get("/pedidos/$id");

        if ($data === false) {
            return false;
        }

        return new Pedido(
            $id,
            $data['estado'],
            floatval($data['total']),
            $data['tipoPago'],
            $data['nroTransaccion'],
            $data['productos'] // Recupera el array de productos
        );
    }
}
