<?php

use App\Http\Controllers\API\Auth\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\PatientsController;
use App\Http\Controllers\API\DashboardAdmin\SectionsController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::group(['namespace' => 'App\Http\Controllers\API\Auth'], function () {
    Route::post('admin/login', [AdminController::class, 'login']);
    Route::post('admin/register', [AdminController::class, 'register']);
    Route::post('admin/logout', [AdminController::class, 'logout']);
    Route::post('admin/profile', [AdminController::class, 'profile']);
});

Route::middleware(['auth:admin-api', 'ChageLanguage'])->group(function () {
    Route::group(['prefix' => 'sections'], function () {
        Route::get('sections', [SectionsController::class, 'show']);
        Route::post('sections', [SectionsController::class, 'store']);
        ;
    });

    Route::get('patient/{id}', [PatientsController::class, 'show']);
});