<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

// -------------------------------
// public route
// -------------------------------
Route::post('/login', [AuthController::class, 'login']);

// -------------------------------
//  protected routes
// -------------------------------
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Employees CRUD
    Route::apiResource('employees', EmployeeController::class);

});
