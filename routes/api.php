<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\ThreadDensityController;
use App\Http\Controllers\Api\ThreadDirectionController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\NewslettersController;
use App\Http\Controllers\Api\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum', 'admin'])
    ->group(function () {
        // Route::get('/user', [\App\Http\Controllers\AuthController::class, 'getUser']);
        // Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'getUser']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/categories/options', [CategoryController::class, 'getOptionCategories']);
        Route::get('/types/options', [TypeController::class, 'getOptionTypes']);
        Route::get('/units/options', [UnitController::class, 'getOptionUnits']);
        Route::get('/materials/options', [MaterialController::class, 'getOptionMaterials']);
        Route::get('/colors/options', [ColorController::class, 'getOptionColors']);
        Route::get('/threadDensities/options', [ThreadDensityController::class, 'getOptionThreadDensities']);
        Route::get('/threadDirections/options', [ThreadDirectionController::class, 'getOptionThreadDirections']);

        Route::apiResource('products', ProductController::class);
        Route::apiResource('types', TypeController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('materials', MaterialController::class);
        Route::apiResource('units', UnitController::class);
        Route::apiResource('colors', ColorController::class);
        Route::apiResource('threadDensities', ThreadDensityController::class);
        Route::apiResource('threadDirections', ThreadDirectionController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('customers', CustomerController::class);
        Route::apiResource('newsletters', NewslettersController::class);
        
        // Route::get('Newsletters', [OrderController::class, 'index']);

        Route::get('orders', [OrderController::class, 'index']);
        Route::get('orders/statuses', [OrderController::class, 'getStatuses']);
        Route::post('orders/change-status/{order}/{status}', [OrderController::class, 'changeStatus']);
        Route::get('orders/{order}', [OrderController::class, 'view']);

        Route::get('contactUses', [ContactUsController::class, 'index']);
        Route::get('contactUses/statuses', [ContactUsController::class, 'getStatuses']);
        Route::post('contactUses/change-status/{contactUs}/{status}', [ContactUsController::class, 'changeStatus']);
        // Route::get('contactUses/{contactUs}', [ContactUsController::class, 'view']);
        Route::get('contactUs/{contactUs}', [ContactUsController::class, 'view']);

        Route::get('/dashboard/customers-count', [DashboardController::class, 'activeCustomers']);
        Route::get('/dashboard/products-count', [DashboardController::class, 'activeProducts']);
        Route::get('/dashboard/orders-count', [DashboardController::class, 'paidOrders']);
        Route::get('/dashboard/income-amount', [DashboardController::class, 'totalIncome']);
        Route::get('/dashboard/latest-customers', [DashboardController::class, 'latestCustomers']);
        Route::get('/dashboard/latest-orders', [DashboardController::class, 'latestOrders']);
        
        Route::get('/report/orders', [ReportController::class, 'orders']);
        Route::get('/report/customers', [ReportController::class, 'customers']);
    });

Route::post('/login',[AuthController::class, 'login']);
// Route::post('/login',[\App\Http\Controllers\AuthController::class, 'login']);
