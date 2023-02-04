<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Cliente\ContratosController;
use App\Http\Controllers\Cliente\ReservacionesController;
use App\Http\Controllers\Cliente\TarjetaController;
use App\Http\Controllers\Cliente\HomeController as HomeCliente;
// Panel cliente
Route::group(['prefix' => 'cliente'], function () {
    Route::get('/', function () {
        return redirect()->route('inicio');
    });

    Route::get('/inicio', [HomeController::class,'index'])->name('inicio');
    Route::resource('paquetes', ContratosController::class);
    Route::get('obtener-contratos', [HomeCliente::class,'obtener_contratos']);
    Route::get('obtener-pagos/{contrato_id}', [HomeCliente::class,'obtener_pagos']);

    Route::resource('tarjetas', TarjetaController::class);
    Route::get('obtener-tarjetas', [TarjetaController::class ,'obtener_tarjetas']);
    Route::get('obtener-bancos', [TarjetaController::class, 'obtener_bancos']);
    Route::resource('reservaciones', ReservacionesController::class);
    Route::get('obtener-reservaciones', [ReservacionesController::class ,'obtener_reservaciones']);
    Route::get('profile', [HomeCliente::class ,'index'])->name('profile');
    Route::get('get-temporadas-reserva', [ReservacionesController::class ,'getTemporada'])->name('get_temporadas');
});
