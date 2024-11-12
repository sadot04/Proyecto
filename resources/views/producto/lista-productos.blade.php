@extends('layouts.default')
@section('content')

<h1>Lista de productos</h1>

<form action="{{ url('producto/index') }}" method="get">
    <div class="mb-3 row">
        <label for="filtro" class="col-sm-1 col-form-label">Buscar</label>
        <div class="col-sm-2">
            <input type="search" name="filtro" id="filtro" value="{{ $filtro }}" class="form-control" />
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-secondary">Buscar</button>
        </div>
    </div>
</form>

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->codigo }}</td>
                <td>{{ $producto->nombre }}</td>
                <td class="text-end">{{ number_format($producto->precio, 1) }}</td>
                <td class="text-center">
                    <a href="#" class="btn btn-sm text-primary">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <button type="button" class="btn btn-sm text-danger" onclick="alert('Esta función está deshabilitada en modo de prueba.');">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@stop