<?php

use App\Http\Controllers\FirebaseTestController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;


Route::get('producto/index', [ProductoController::class, 'index']);
Route::get('producto/index2', [ProductoController::class, 'index2']);
Route::get('producto/create', [ProductoController::class, 'create']);
Route::get('producto/pago', [ProductoController::class, 'pago'])->name('producto.pago');
Route::post('producto/create', [ProductoController::class, 'store']);
Route::get('producto/edit/{id}', [ProductoController::class, 'edit']);
Route::post('producto/update/{id}', [ProductoController::class, 'update']);
Route::post('producto/destroy/{id}', [ProductoController::class, 'destroy']);
