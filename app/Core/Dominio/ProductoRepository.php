<?php

namespace App\Core\Dominio;

interface ProductoRepository
{
    /**
     * @return \App\Core\Dominio\Producto[]
     */
    public function search(string $filtro): array;

    public function nextIdentity(): int;

    public function store(Producto $producto): bool;

    public function remove(int $productoId): bool;

    public function getById(int $id): Producto|false;
}