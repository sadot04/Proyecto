<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('producto/index', [ProductoController::class, 'index']);
Route::get('producto/create', [ProductoController::class, 'create']);
Route::post('producto/create', [ProductoController::class, 'store']);
Route::get('producto/edit/{id}', [ProductoController::class, 'edit']);
Route::post('producto/update/{id}', [ProductoController::class, 'update']);
Route::post('producto/destroy/{id}', [ProductoController::class, 'destroy']);
