<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products/scan', [ProductController::class, 'scan'])->name('products.scan');
    Route::get('/products/scan/{sku}', [ProductController::class, 'scanProduct'])->name('products.scan-product');

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('sales', SaleController::class);

    Route::prefix('reports')->group(function () {
        Route::get('/sales', [ReportController::class, 'salesReport'])->name('reports.sales');
        Route::get('/products-sold', [ReportController::class, 'productsSoldReport'])->name('reports.products-sold');
    });
});

require __DIR__ . '/auth.php';
