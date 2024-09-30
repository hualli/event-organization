<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\InscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // Events
    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->middleware('ability:event-index');
        Route::post('/', [EventController::class, 'store'])->middleware('ability:event-store');
        Route::get('/{id}', [EventController::class, 'show'])->middleware('ability:event-show');
        Route::put('/{id}', [EventController::class, 'update'])->middleware('ability:event-update');
        Route::delete('/{id}', [EventController::class, 'destroy'])->middleware('ability:event-destroy');
    });

    // Inscriptions
    Route::prefix('inscriptions')->group(function () {
        Route::post('/', [InscriptionController::class, 'store'])->middleware('ability:inscription-store');
        Route::get('/{id}', [InscriptionController::class, 'getInscriptionsByUser'])->middleware('ability:inscription-show');
    });

});

