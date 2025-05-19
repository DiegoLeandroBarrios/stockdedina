<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthFirebaseController;

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/producto/crear', [ProductoController::class, 'crear'])->name('producto.crear');
Route::post('/producto/guardar', [ProductoController::class, 'guardar'])->name('producto.guardar');
Route::get('/home', [ProductoController::class, 'home'])->name('home');





Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Password Reset
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendPasswordResetEmail'])->name('password.email');

Route::delete('/producto/{id}', [ProductoController::class, 'eliminar'])->name('producto.eliminar');
Route::get('/producto/editar/{id}', [ProductoController::class, 'editar'])->name('producto.editar');
Route::post('/producto/actualizar/{id}', [ProductoController::class, 'actualizar'])->name('producto.actualizar');
Route::get('/producto/{id}/ver', [ProductoController::class, 'ver'])->name('producto.ver');




