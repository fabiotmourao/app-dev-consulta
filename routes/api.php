<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('api')->group(function () {
    Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index']);
    Route::get('/cliente/{id}/edit', [App\Http\Controllers\ClienteController::class, 'edit']);
    Route::post('/cliente/{id}/update', [App\Http\Controllers\ClienteController::class, 'update']);

    Route::get('/candidatos', [App\Http\Controllers\CandidatoController::class, 'index']);
    Route::get('/candidato/{id}/edit', [App\Http\Controllers\CandidatoController::class, 'edit']);
    Route::post('/candidato/{id}/update', [App\Http\Controllers\CandidatoController::class, 'update']);

    Route::get('/selecao', [App\Http\Controllers\SelecaoController::class, 'index']);
});


