<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Attribute Routes
    Route::apiResource('attributes', AttributeController::class);

    // Project Routes
    Route::get('/projects', [ProjectController::class, 'index']); // Filterable projects
    Route::get('/projects/{project}', [ProjectController::class, 'show']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{project}', [ProjectController::class, 'update']);
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);

});