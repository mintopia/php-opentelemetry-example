<?php

use App\Http\Controllers\Api\V1\ApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->group(function() {
    Route::get('/ping', [ApiController::class, 'ping'])->name('ping');
    Route::post('/up', [ApiController::class, 'up'])->name('up');
    Route::post('/down', [ApiController::class, 'down'])->name('down');
    Route::post('/count', [ApiController::class, 'count'])->name('count');
    Route::put('/load', [ApiController::class, 'load'])->name('load');
    Route::get('/delay', [ApiController::class, 'delay'])->name('delay');
    Route::get('/event', [ApiController::class, 'event'])->name('event');
});
