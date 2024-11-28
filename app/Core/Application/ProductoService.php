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
        $productoId = $this->productoRepository->nextIdentity();

        $producto = new Producto(
            $productoId,
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

        $this->productoRepository->store($producto);

        return $producto;
    }

    public function modificarProducto(int $id, array $data): void
    {
        $producto = $this->getProducto($id);

        if ($producto === false) {
            throw new Exception("Producto no encontrado");
        }

        $producto->setNombre($data['nombre']);
        $producto->setMarca($data['marca']);
        $producto->setPrecio(floatval($data['precio']));
        //$producto->setTalla(intval($data['talla']));
        $producto->setColor($data['color']);
        $producto->setStock36(intval($data['stock36']));
        $producto->setStock38(intval($data['stock38']));
        $producto->setStock40(intval($data['stock40']));
        $producto->setStock42(intval($data['stock42']));
        $producto->setStock44(intval($data['stock44']));
        $producto->setImagenUrl($data['imagenUrl']);

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
