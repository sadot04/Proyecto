<?php

namespace App\Core\Dominio;

class Producto
{
    private int $id;
    private string $nombre;
    private string $marca;
    private float $precio;
    //private int $talla;
    private string $color;
    private int $stock36;
    private int $stock38;
    private int $stock40;
    private int $stock42;
    private int $stock44;
    private string $imagenUrl;

    public function __construct(
        int $id,
        string $nombre,
        string $marca,
        float $precio,
        //int $talla,
        string $color,
        int $stock36,
        int $stock38,
        int $stock40,
        int $stock42,
        int $stock44,
        string $imagenUrl
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->marca = $marca;
        $this->precio = $precio;
        //$this->talla = $talla;
        $this->color = $color;
        $this->stock36 = $stock36;
        $this->stock38 = $stock38;
        $this->stock40 = $stock40;
        $this->stock42 = $stock42;
        $this->stock44 = $stock44;
        $this->imagenUrl = $imagenUrl;
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

    //public function getTalla(): int
    //{
    //    return $this->talla;
    //}

    public function getColor(): string
    {
        return $this->color;
    }

    public function getStock36(): int
    {
        return $this->stock36;
    }

    public function getStock38(): int
    {
        return $this->stock38;
    }

    public function getStock40(): int
    {
        return $this->stock40;
    }

    public function getStock42(): int
    {
        return $this->stock42;
    }

    public function getStock44(): int
    {
        return $this->stock44;
    }

    public function getImagenUrl(): string
    {
        return $this->imagenUrl;
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

    //public function setTalla(int $value): void
    //{
    //    $this->talla = $value;
    //}

    public function setColor(string $value): void
    {
        $this->color = $value;
    }

    public function setStock36(int $value): void
    {
        $this->stock36 = $value;
    }

    public function setStock38(int $value): void
    {
        $this->stock38 = $value;
    }

    public function setStock40(int $value): void
    {
        $this->stock40 = $value;
    }

    public function setStock42(int $value): void
    {
        $this->stock42 = $value;
    }

    public function setStock44(int $value): void
    {
        $this->stock44 = $value;
    }

    public function setImagenUrl(string $value): void
    {
        $this->imagenUrl = $value;
    }


    
}
