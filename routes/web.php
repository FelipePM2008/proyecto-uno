<?php
use App\Http\Controllers\MovementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    // return view('welcome');
    return view('home.home');
})->name('home');

Route::resource('productos', ProductController::class);
Route::get('productos/pdf/{id}', [ProductController::class, 'pdf'])->name('pdf');
Route::resource('movimientos', MovementController::class);
Route::get('/movimientos/pdf/{movement}', [MovementController::class, 'pdf'])
    ->name('movimientos.pdf');
Route::resource('proveedores', ProviderController::class);
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
