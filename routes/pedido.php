<?php

use App\Http\Controllers\FirebaseTestController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;


Route::get('producto/index', [ProductoController::class, 'index']);
Route::get('producto/pago', [ProductoController::class, 'pago'])->name('producto.pago');

Route::post('pedido/create', [PedidoController::class, 'store']);

Route::get('producto/edit/{id}', [ProductoController::class, 'edit']);
Route::post('producto/update/{id}', [ProductoController::class, 'update']);
Route::post('producto/destroy/{id}', [ProductoController::class, 'destroy']);
