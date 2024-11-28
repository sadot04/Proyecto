<?php

namespace App\Core\Dominio;

interface PedidoRepository
{
    /**
     * @return \App\Core\Dominio\Producto[]
     */
    public function search(string $filtro): array;

    public function nextIdentity(): int;

    public function store(Pedido $pedido): bool;

    public function remove(int $pedidoId): bool;

    public function getById(int $id): Pedido|false;
}