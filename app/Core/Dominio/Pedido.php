<?php

namespace App\Core\Dominio;

class Pedido
{
    private int $id;
    private string $estado;
    private float $total;
    private string $tipoPago;
    private string $nroTransaccion; // Nuevo atributo
    private string $productos; // Array de productos

    public function __construct(
        int $id,
        string $estado,
        float $total,
        string $tipoPago,
        string $nroTransaccion,
        string $productos // Recibe un array de productos
    ) {
        $this->id = $id;
        $this->estado = $estado;
        $this->total = $total;
        $this->tipoPago = $tipoPago;
        $this->nroTransaccion = $nroTransaccion;
        $this->productos = $productos;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getEstado(): string
    {
        return $this->estado;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getTipoPago(): string
    {
        return $this->tipoPago;
    }

    public function getNroTransaccion(): string
    {
        return $this->nroTransaccion;
    }

    public function getProductos(): string
    {
        return $this->productos;
    }

    // Setters
    public function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }

    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function setTipoPago(string $tipoPago): void
    {
        $this->tipoPago = $tipoPago;
    }

    public function setNroTransaccion(string $nroTransaccion): void
    {
        $this->nroTransaccion = $nroTransaccion;
    }

    public function setProductos(string $productos): void
    {
        $this->productos = $productos;
    }

}
