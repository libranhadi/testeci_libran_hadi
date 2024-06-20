<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test4\LevelController;
use App\Http\Controllers\GenerateStarController;
use App\Http\Controllers\GenerateNumberConverterController;
use App\Http\Controllers\Test4\DepartmentController;
use App\Http\Controllers\Test4\EmployeeController;
use App\Http\Controllers\Test4\PositionController;
use App\Http\Middleware\CheckJWTMiddleware;

Route::prefix("generate")->group(function() {
    Route::post('/star', [GenerateStarController::class, 'generate']);
    Route::post('/number-converter', [GenerateNumberConverterController::class, 'generate']);
});


Route::prefix('levels')->group(function() {
    Route::post('/store', [LevelController::class, 'store']);
    Route::put('/update/{id}', [LevelController::class, 'update']);
    Route::delete('/delete/{id}', [LevelController::class, 'destroy']);
});

Route::prefix('departments')->group(function() {
    Route::post('/store', [DepartmentController::class, 'store']);
    Route::put('/update/{id}', [DepartmentController::class, 'update']);
    Route::delete('/delete/{id}', [DepartmentController::class, 'destroy']);
});

Route::prefix('positions')->group(function() {
    Route::post('/store', [PositionController::class, 'store']);
    Route::put('/update/{id}', [PositionController::class, 'update']);
    Route::delete('/delete/{id}', [PositionController::class, 'destroy']);
});

Route::prefix('employees')->group(function() {
    Route::post('/store', [EmployeeController::class, 'store']);
    Route::post('/update/{id}', [EmployeeController::class, 'update']);
    Route::delete('/delete/{id}', [EmployeeController::class, 'destroy']);
});

