<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Assessment1Controller;
use App\Http\Controllers\Assessment2Controller;

// SPA Routes (return main app layout)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/assessment1', [Assessment1Controller::class, 'index'])->name('assessment1.index');
Route::get('/assessment1/create', [Assessment1Controller::class, 'create'])->name('assessment1.create');
Route::get('/assessment1/{user}', [Assessment1Controller::class, 'show'])->name('assessment1.show');
Route::get('/assessment1/{user}/edit', [Assessment1Controller::class, 'edit'])->name('assessment1.edit');
Route::get('/assessment2', [Assessment2Controller::class, 'index'])->name('assessment2.index');
Route::get('/assessment2/create', [Assessment2Controller::class, 'create'])->name('assessment2.create');
Route::get('/assessment2/{category}/edit', [Assessment2Controller::class, 'edit'])->name('assessment2.edit');

// API Routes (handle data operations)
Route::prefix('api')->group(function () {
    // Assessment 1 API Routes
    Route::prefix('assessment1')->group(function () {
        Route::post('/', [Assessment1Controller::class, 'store'])->name('api.assessment1.store');
        Route::put('/{user}', [Assessment1Controller::class, 'update'])->name('api.assessment1.update');
        Route::delete('/{user}', [Assessment1Controller::class, 'destroy'])->name('api.assessment1.destroy');
    });
    
    // Assessment 2 API Routes
    Route::prefix('assessment2')->group(function () {
        Route::post('/', [Assessment2Controller::class, 'store'])->name('api.assessment2.store');
        Route::put('/{category}', [Assessment2Controller::class, 'update'])->name('api.assessment2.update');
        Route::delete('/{category}', [Assessment2Controller::class, 'destroy'])->name('api.assessment2.destroy');
    });
});

// Fallback route for Vue Router
Route::get('/{any}', [DashboardController::class, 'index'])->where('any', '.*');