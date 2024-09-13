<?php

use App\Http\Controllers\MarcaVeiculoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/marcaveiculo', [MarcaVeiculoController::class, 'index'])->middleware(['auth', 'verified'])->name('marcaveiculo.index');
Route::delete('/marcaveiculo/{id}', [MarcaVeiculoController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('marcaveiculo.destroy');
Route::get('/marcaveiculo/create', function (){
    return view('marcaveiculo_create');
})->middleware(['auth', 'verified'])->name('marcaveiculo.create');
Route::post('/marcaveiculo', [MarcaVeiculoController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('marcaveiculo.store');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
