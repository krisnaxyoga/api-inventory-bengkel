<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', \App\Http\Controllers\Api\Auth\AuthController::class);
Route::post('/auth/login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', [\App\Http\Controllers\Api\User\UserController::class, 'index']);

    // workshop
    Route::get('/workshop', [\App\Http\Controllers\Api\Workshop\WorkshopController::class, 'index'])->name('workshop.index');
    Route::get('/workshop/{id}', [\App\Http\Controllers\Api\Workshop\WorkshopController::class, 'show'])->name('workshop.show');
    Route::get('/workshopbyuser/{userid}', [\App\Http\Controllers\Api\Workshop\WorkshopController::class, 'showByUserId'])->name('workshop.showByUserId');
    Route::post('/workshop', [\App\Http\Controllers\Api\Workshop\WorkshopController::class, 'store'])->name('workshop.store');
    Route::put('/workshop/{id}', [\App\Http\Controllers\Api\Workshop\WorkshopController::class, 'update'])->name('workshop.update');
    Route::delete('/workshop/{id}', [\App\Http\Controllers\Api\Workshop\WorkshopController::class, 'destroy'])->name('workshop.destroy');
    Route::put('/workshopbyuser/{userid}', [\App\Http\Controllers\Api\Workshop\WorkshopController::class, 'updateByUserId'])->name('workshop.updateByUserId');
    
});
