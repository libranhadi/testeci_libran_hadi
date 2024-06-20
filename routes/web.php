<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Test4\LevelController;
use App\Http\Controllers\GenerateStarController;
use App\Http\Controllers\GenerateNumberConverterController;
use App\Http\Controllers\Test4\DepartmentController;
use App\Http\Controllers\Test4\EmployeeController;
use App\Http\Controllers\Test4\PositionController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::prefix('generator')->name('generator.')->group(function() {
    Route::get('star', [GenerateStarController::class, 'index'])->name('star-form');
    Route::get('number-converter', [GenerateNumberConverterController::class, 'index'])->name('number-converter-form');
});

Route::prefix('levels')->name('levels.')->group(function() {
    Route::get('/', [LevelController::class, 'index'])->name('index');
    Route::get('/create', [LevelController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [LevelController::class, 'edit'])->name('edit');
});
Route::prefix('departments')->name('departments.')->group(function() {
    Route::get('/', [DepartmentController::class, 'index'])->name('index');
    Route::get('/create', [DepartmentController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [DepartmentController::class, 'edit'])->name('edit');
});
Route::prefix('positions')->name('positions.')->group(function() {
    Route::get('/', [PositionController::class, 'index'])->name('index');
    Route::get('/create', [PositionController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [PositionController::class, 'edit'])->name('edit');
});
Route::prefix('employees')->name('employees.')->group(function() {
    Route::get('/', [EmployeeController::class, 'index'])->name('index');
    Route::get('/create', [EmployeeController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('edit');
});