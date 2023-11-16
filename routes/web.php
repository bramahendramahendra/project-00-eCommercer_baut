<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuCategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guestOrVerified'])->group(function(){
    
    Route::get('/menu-categories', [MenuCategoryController::class, 'index']);

    Route::get('/', [ProductController::class, 'index'])->name('home');
    Route::get('/product', [ProductController::class, 'index'])->name('katalog');
    // Route::get('/product/filter', [ProductController::class, 'index'])->name('katalog.filter');
    Route::get('/product/{product:slug}', [ProductController::class, 'view'])->name('product.view');

    Route::prefix('/category')->name('kategori.')->group(function(){
        // Route::get('/', [CategoryController::class, 'index'])->name('filter');
        Route::get('/{category:slug}', [CategoryController::class, 'index'])->name('index');
    });
    Route::prefix('/type')->name('jenis.')->group(function(){
        Route::get('/{type:slug}', [TypeController::class, 'index'])->name('index');
    });

    Route::prefix('/cart')->name('cart.')->group(function(){
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{product:slug}', [CartController::class, 'add'])->name('add');
        Route::post('/remove/{product:slug}', [CartController::class, 'remove'])->name('remove');
        Route::post('/update-quantity/{product:slug}', [CartController::class, 'updateQuantity'])->name('update-quantity');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
