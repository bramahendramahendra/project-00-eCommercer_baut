<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContantUsController;
use App\Http\Controllers\NewslettersController;
use App\Http\Controllers\TermsAndConditionsController;
use App\Http\Controllers\FrequentlyAskedQuestionsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guestOrVerified'])->group(function(){
    
    Route::get('/menu-categories', [MenuCategoryController::class, 'index']);

    Route::get('/', [DashboardController::class, 'index'])->name('home');
    // Route::get('/', [ProductController::class, 'index'])->name('home');
    Route::get('/product', [ProductController::class, 'index'])->name('katalog');
    // Route::get('/product/filter', [ProductController::class, 'index'])->name('katalog.filter');
    Route::get('/product/{product:slug}', [ProductController::class, 'view'])->name('product.view');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/contant-us', [ContantUsController::class, 'index'])->name('contantUs');
    Route::post('/contant-us/send', [ContantUsController::class, 'create'])->name('contantUs.send');
    Route::post('/newsletters/send', [NewslettersController::class, 'create'])->name('newsletters.send');
    Route::get('/terms_and_conditions', [TermsAndConditionsController::class, 'index'])->name('terms_and_conditions');
    Route::get('/frequently_asked_questions', [FrequentlyAskedQuestionsController::class, 'index'])->name('frequently_asked_questions');

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

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password-update', [ProfileController::class, 'passwordUpdate'])->name('profile_password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('cart.checkout');
    // Route::post('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    // Route::post('/checkout/failure', [CheckoutController::class, 'failure'])->name('checkout.failure');

    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    // Route::get('/orders/view/:order', [OrderController::class, 'view'])->name('order.view');
});

require __DIR__.'/auth.php';
