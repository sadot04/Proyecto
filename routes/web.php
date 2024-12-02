<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// En routes/auth.php
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/option1', function () {
    return view('dashboard', ['content' => 'Contenido de la Opción 1']);
})->name('dashboard.option1');

Route::get('/dashboard/option2', function () {
    return view('dashboard', ['content' => 'Contenido de la Opción 2']);
})->name('dashboard.option2');

Route::get('/dashboard/option3', function () {
    return view('dashboard', ['content' => 'Contenido de la Opción 3']);
})->name('dashboard.option3');

Route::resource('pedidos',App\Http\Controllers\PedidoController::class);
Route::get('/prueba', [App\Http\Controllers\PedidoController::class, 'create']); // Si es para mostrar algo
Route::post('/prueba2', [App\Http\Controllers\PedidoController::class, 'store']);

//require __DIR__.'/auth.php';
require __DIR__.'/auth.php';
require __DIR__.'/producto.php';
require __DIR__.'/pedido.php';
