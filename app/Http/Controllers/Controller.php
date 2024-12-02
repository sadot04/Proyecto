<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// Ruta para mostrar el formulario de inicio de sesión
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

// Ruta para procesar el inicio de sesión
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Ruta para mostrar el formulario de registro
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

// Ruta para procesar el registro
Route::post('/register', [RegisteredUserController::class, 'store']);

// Ruta para cerrar sesión
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
