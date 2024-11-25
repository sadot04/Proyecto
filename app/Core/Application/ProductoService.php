<?php

namespace App\Core\Application;

use Exception;
use App\Core\Dominio\Producto;
use App\Core\Dominio\ProductoRepository;

class ProductoService
{
    public function __construct(
        private ProductoRepository $productoRepository
    ) {}

    public function searchProducto(string $filtro)
    {
        return $this->productoRepository->search($filtro);
    }

    public function nuevoProducto(array $data): Producto
    {
        // Genera el ID del producto
        $productoId = $this->productoRepository->nextIdentity();

        // Crea el objeto producto con los datos proporcionados
        $producto = new Producto(
            $productoId,
            $data['nombre'],
            $data['marca'],
            floatval($data['precio']),
            intval($data['talla']),
            $data['color'],
            intval($data['stock'])
        );

        // Almacena el producto en el repositorio
        $this->productoRepository->store($producto);

        // Devuelve el producto creado
        return $producto;
    }

    public function modificarProducto(int $id, array $data): void
    {
        // Carga el producto almacenado
        $producto = $this->getProducto($id);

        if ($producto === false) {
            throw new Exception("Producto no encontrado");
        }

        // Aplica los cambios al producto
        $producto->setNombre($data['nombre']);
        $producto->setMarca($data['marca']);
        $producto->setPrecio(floatval($data['precio']));
        $producto->setTalla(intval($data['talla']));
        $producto->setColor($data['color']);
        $producto->setStock(intval($data['stock']));

        // Almacena nuevamente el producto actualizado
        $this->productoRepository->store($producto);
    }

    public function eliminarProducto(int $id): void
    {
        // Carga el producto almacenado
        $producto = $this->getProducto($id);

        if ($producto === false) {
            throw new Exception("Producto no encontrado");
        }

        // Elimina el producto del repositorio
        $this->productoRepository->remove($producto->getId());
    }

    public function getProducto(int $id): Producto|false
    {
        return $this->productoRepository->getById($id);
    }
}
