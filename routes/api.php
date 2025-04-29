<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Assessment1Controller;
use App\Http\Controllers\Assessment2Controller;

Route::prefix('users')->group(function () {
    Route::middleware('throttle:60,1')->group(function () {
        Route::get('/check-email', [Assessment1Controller::class, 'checkEmail']);
        Route::get('/check-username', [Assessment1Controller::class, 'checkUsername']);
    });

    Route::get('/', [Assessment1Controller::class, 'indexApi'])->name('users.index');
    Route::post('/', [Assessment1Controller::class, 'store'])->name('users.store');
    Route::get('/{user}', [Assessment1Controller::class, 'showApi'])->name('users.show');
    Route::put('/{user}', [Assessment1Controller::class, 'update'])->name('users.update');
    Route::delete('/{user}', [Assessment1Controller::class, 'destroy'])->name('users.destroy');
});


Route::prefix('categories')->group(function () {
    Route::get('/', [Assessment2Controller::class, 'indexApi']);
    Route::post('/', [Assessment2Controller::class, 'store']);
    Route::get('/{category}', [Assessment2Controller::class, 'showApi']);
    Route::put('/{category}', [Assessment2Controller::class, 'update']);  
    Route::delete('/{category}', [Assessment2Controller::class, 'destroy']);
});