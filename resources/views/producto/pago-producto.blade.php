@extends('layouts.default')
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
                    <h2 class="card-title"> nombre producto</h2>

                    <!-- Calificaciones y reseñas -->
                    <div class="mb-2">
                        <span class="text-warning">★★★★☆</span> <span>(150 reseñas)</span>
                    </div>

                    <!-- Precio del producto -->
                    <div class="mb-3">
                        <h4 class="text-danger">Bs <span id="precio"> 200 </span></h4>
                    </div>

                    <!-- Formulario de pago -->
                    <form action="" method="post">
                        @csrf
                        <input type="hidden" name="producto_id" value="">
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del titular de la tarjeta</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="tarjeta" class="form-label">Número de tarjeta</label>
                            <input type="text" class="form-control" id="tarjeta" name="tarjeta" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento</label>
                            <input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" required>
                        </div>
                        
                        <button type="submit" class="btn btn-success btn-lg">Pagar ahora</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
