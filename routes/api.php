<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('plan')->group(function () {
    Route::get('/', [PlanController::class, 'index']);
    Route::get('/{id}', [PlanController::class, 'show']);
    Route::post('/', [PlanController::class, 'create']);
    Route::put('/{id}', [PlanController::class, 'update']);
    Route::delete('/{id}', [PlanController::class, 'delete']);
});

Route::prefix('company')->group(function () {
    Route::get('/', [CompanyController::class, 'index']);
    Route::get('/{id}', [CompanyController::class, 'show']);
    Route::post('/', [CompanyController::class, 'create']);
    Route::put('/{id}', [CompanyController::class, 'update']);
    Route::delete('/{id}', [CompanyController::class, 'delete']);
});

Route::prefix('vacancy')->group(function () {
    Route::get('/', [VacancyController::class, 'index']);
    Route::get('/{id}', [VacancyController::class, 'show']);
    Route::post('/', [VacancyController::class, 'create']);
    Route::put('/{id}', [VacancyController::class, 'update']);
    Route::delete('/{id}', [VacancyController::class, 'delete']);
});

Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'create']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'delete']);
});