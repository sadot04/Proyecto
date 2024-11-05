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

    public function nuevoProducto(array $data)
    {
        //genera el id del producto
        $productoId = $this->productoRepository->nextIdentity();

        //crea el objeto producto
        $producto = new Producto(
            $productoId,
            $data['codigo'],
            $data['nombre'],
            floatval($data['precio']),
        );

        // almacena el producto
        $this->productoRepository->store($producto);

        // devuelve el producto creado
        return $producto;
    }

    public function modificarProducto(int $id, $data)
    {
        // aquí se puede hacer validaciones de acuerdo a las reglas de la aplicación

        //carga el producto almancenado
        $producto = $this->getProducto($id);

        if ($producto === false) {
            throw new Exception("Producto no encontrado");
        }

        //aplica los cambios
        $producto->setCodigo($data['codigo']);
        $producto->setNombre($data['nombre']);
        $producto->setPrecio(floatval($data['precio']));

        //vuelve a almacenar
        $this->productoRepository->store($producto);
    }

    public function eliminarProducto(int $id)
    {
        // aquí se puede hacer validaciones de acuerdo a las reglas de la aplicación

        //carga el producto almancenado
        $producto = $this->getProducto($id);

        if ($producto === false) {
            throw new Exception("Producto no encontrado");
        }

        //elimina del repositorio
        $this->productoRepository->remove($producto->getId());
    }

    public function getProducto(int $id): Producto|false
    {
        return $this->productoRepository->getById($id);
    }
}
