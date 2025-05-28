<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authenticated routes (using both auth middleware variants)
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Resource routes
    Route::resource('categories', CategoryController::class);
    Route::resource('transactions', TransactionController::class);
    
    // Reports route
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
});