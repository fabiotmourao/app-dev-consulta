<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('api')->group(function () {
    Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index']);
    Route::get('/cliente/{id}/edit', [App\Http\Controllers\ClienteController::class, 'edit']);
    Route::post('/cliente/{id}/update', [App\Http\Controllers\ClienteController::class, 'update']);

    Route::get('/candidatos', [App\Http\Controllers\CandidatoController::class, 'index']);
    Route::get('/selecao', [App\Http\Controllers\SelecaoController::class, 'index']);
});


