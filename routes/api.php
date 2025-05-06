<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CorsMiddleware;

Route::middleware([CorsMiddleware::class])->group(function () {


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Use 'auth:api' middleware instead of 'auth:sanctum' for Passport token authentication
// routes/api.php
Route::middleware('auth:sanctum')->put('/profile', [UserController::class, 'update']);
Route::middleware('auth:api')->group(function () {
    // Profile
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::get('/user', [AuthController::class, 'user_info']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Roles
    Route::post('/role', [RoleController::class, 'createRole']);
    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/role/{id}', [RoleController::class, 'getRole']);
    Route::put('/role/{id}', [RoleController::class, 'updateRole']);
    Route::delete('/role/{id}', [RoleController::class, 'deleteRole']);

    // Marketplace
    Route::post('/marketplace/job', [MarketplaceController::class, 'createJob']);
    Route::get('/marketplace/jobs', [MarketplaceController::class, 'getJobs']);
    Route::get('/marketplace/categories', [MarketplaceController::class, 'getCategories']);
    Route::get('/marketplace/job/{id}', [MarketplaceController::class, 'getJob']);
    });
});
