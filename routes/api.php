<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MarketplaceController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);    // Login Route
Route::post('/register', [AuthController::class, 'register']);  // Register Route
Route::post('/signup', [AuthController::class, 'register']);  // Signup Route (same as register)

// Authenticated Routes (Requires Sanctum Authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Auth Routes
    Route::post('/logout', [AuthController::class, 'logout']);    // Logout Route
    Route::get('/user', [AuthController::class, 'user_info']);    // Get current authenticated user info

    // Role Management Routes
    Route::post('/role', [RoleController::class, 'createRole']);    // Create Role
    Route::get('/roles', [RoleController::class, 'index']);        // Get all roles
    Route::get('/role/{id}', [RoleController::class, 'getRole']);    // Get specific role
    Route::put('/role/{id}', [RoleController::class, 'updateRole']);    // Update Role
    Route::delete('/role/{id}', [RoleController::class, 'deleteRole']);    // Delete Role

    // Marketplace Routes
    Route::post('/marketplace/job', [MarketplaceController::class, 'createJob']);    // Post a job
    Route::get('/marketplace/jobs', [MarketplaceController::class, 'getJobs']);    // Get list of jobs
    Route::get('/marketplace/categories', [MarketplaceController::class, 'getCategories']);    // Get job categories
    Route::get('/marketplace/job/{id}', [MarketplaceController::class, 'getJob']);    // View job details
});
