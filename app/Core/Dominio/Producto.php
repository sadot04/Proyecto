<?php

namespace App\Core\Dominio;

class Producto
{
    private int $id;
    private string $nombre;
    private string $marca;
    private float $precio;
    private int $talla;
    private string $color;
    private int $stock;

    public function __construct(
        int $id,
        string $nombre,
        string $marca,
        float $precio,
        int $talla,
        string $color,
        int $stock
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->marca = $marca;
        $this->precio = $precio;
        $this->talla = $talla;
        $this->color = $color;
        $this->stock = $stock;
    }


    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getMarca(): string
    {
        return $this->marca;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function getTalla(): int
    {
        return $this->talla;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getStock(): int
    {
        return $this->stock;
    }
    

    // Setters
    public function setNombre(string $value): void
    {
        $this->nombre = $value;
    }

    public function setMarca(string $value): void
    {
        $this->marca = $value;
    }

    public function setPrecio(float $value): void
    {
        $this->precio = $value;
    }

    public function setTalla(int $value): void
    {
        $this->talla = $value;
    }

    public function setColor(string $value): void
    {
        $this->color = $value;
    }

    public function setStock(int $value): void
    {
        $this->stock = $value;
    }

    // Método toString para representar el objeto como texto
    public function __toString(): string
    {
        return "Producto [ID: {$this->id}, Nombre: {$this->nombre}, Marca: {$this->marca}, Precio: {$this->precio}, Talla: {$this->talla}, Color: {$this->color}, Stock: {$this->stock}]";
    }
}
