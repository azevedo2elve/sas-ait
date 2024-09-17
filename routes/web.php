<?php

use App\Http\Controllers\LiberarDispositivoController;
use App\Http\Controllers\MarcaVeiculoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessaoMobileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Marca Veículo
Route::get('/marcaveiculo', [MarcaVeiculoController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('marcaveiculo.index');
Route::delete('/marcaveiculo/{id}', [MarcaVeiculoController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('marcaveiculo.destroy');
Route::get('/marcaveiculo/create', function (){
    return view('marcaveiculo_create');
})->middleware(['auth', 'verified'])->name('marcaveiculo.create');
Route::post('/marcaveiculo/atualizarbase', [MarcaVeiculoController::class, 'atualizarbase'])
    ->middleware(['auth', 'verified'])
    ->name('marcaveiculo.atualizarbase');
Route::post('/marcaveiculo', [MarcaVeiculoController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('marcaveiculo.store');

// Sessão Mobile
Route::get('/sessaomobile', [SessaoMobileController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('sessaomobile.index');
Route::get('/sessaomobile/procurarefetivo', [SessaoMobileController::class, 'procurarEfetivo'])
    ->middleware(['auth', 'verified'])
    ->name('sessaomobile.procurarefetivo');
Route::post('/sessaomobile/deslogarefetivo/{id}', [SessaoMobileController::class, 'deslogarEfetivo'])
    ->middleware(['auth', 'verified'])
    ->name('sessaomobile.deslogarefetivo');

// Liberar dispositivo
Route::get('/liberardispositivo', [LiberarDispositivoController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('liberardispositivo.index');

Route::get('/liberardispositivo/procurardispositivo', [LiberarDispositivoController::class, 'procurarDispositivo'])
    ->middleware(['auth', 'verified'])
    ->name('liberardispositivo.procurardispositivo');

Route::post('liberardispositivo/desbloquear/{device_id}', [LiberarDispositivoController::class, 'desbloquearDispositivo'])
    ->middleware(['auth', 'verified'])
    ->name('liberardispositivo.desbloqueardispositivo');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
