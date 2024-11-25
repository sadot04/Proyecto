@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="card shadow-lg" style="max-width: 100%; margin: auto; max-height: 150%;">
        <div class="row g-0">
            <!-- Imagen del producto -->
            <div class="col-md-5 d-flex align-items-center justify-content-center p-3" style="background-color: #f0f0f0;">
                <div style="width: 100%; height: 400px; background-color: #e0e0e0; display: flex; align-items: center; justify-content: center;">
                    <span class="text-muted">Espacio para imagen del producto</span>
                </div>
            </div>

            <!-- Detalles del producto -->
            <div class="col-md-7">
                <div class="card-body">
                    <!-- Nombre del producto -->
                    <h2 class="card-title">Nombre del Producto</h2>

                    <!-- Calificaciones y reseñas -->
                    <div class="mb-2">
                        <span class="text-warning">★★★★☆</span> <span>(150 reseñas)</span>
                    </div>

                    <!-- Precio del producto -->
                    <div class="mb-3">
                        <h4 class="text-danger">Bs <span id="precio">200</span></h4>
                    </div>

                    <!-- Descripción del producto -->
                    <p class="card-text">Aquí va una descripción detallada del producto, que destaca sus características principales y beneficios para el usuario. Proporciona información que ayuda al cliente a tomar una decisión informada.</p>

                    <!-- Información adicional -->
                    <ul class="list-unstyled">
                        <li><strong>Marca:</strong> Nombre de la marca</li>
                        <li><strong>Modelo:</strong> Modelo del producto</li>
                        <li><strong>Disponibilidad:</strong> En stock</li>
                        <li><strong>Envío:</strong> Gratis para pedidos mayores a $50</li>
                    </ul>

                    <!-- Opciones: Comprar y Añadir al carrito -->
                    <div class="mt-4 d-flex gap-3">
                        <form action="{{ url('producto/comprar') }}" method="post">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id ?? '' }}">
                            <a href="{{ route('producto.pago') }}" class="btn btn-primary btn-lg">Comprar ahora</a>
                        </form>

                        <form action="{{ url('producto/carrito') }}" method="post">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id ?? '' }}">
                            <button type="submit" class="btn btn-secondary btn-lg">Añadir al carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop