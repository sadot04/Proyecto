<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});


Route::get('/option1', function () {
    return view('dashboard', ['content' => 'Contenido de la Opción 1']);
})->name('dashboard.option1');

Route::get('/dashboard/option2', function () {
    return view('dashboard', ['content' => 'Contenido de la Opción 2']);
})->name('dashboard.option2');

Route::get('/dashboard/option3', function () {
    return view('dashboard', ['content' => 'Contenido de la Opción 3']);
})->name('dashboard.option3');



//require __DIR__.'/auth.php';
require __DIR__.'/auth.php';
require __DIR__.'/producto.php';
