<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\User\UserCatalogueController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard/getModule', [DashboardController::class, 'getModule'])->name('dashboard.getModule');
    Route::get('/auth/refreshToken', [AuthController::class, 'refreshToken'])->name('auth.refreshToken');

    // User Catalogue
    Route::get('/user/catalogue', [UserCatalogueController::class, 'index'])->name('userCatalogue.index');
    Route::post('/user/catalogue/store', [UserCatalogueController::class, 'store'])->name('userCatalogue.store');
    Route::delete('/user/catalogue/deleteAll', [UserCatalogueController::class, 'deleteAll'])->name('userCatalogue.deleteAll');
    // GENERA;
    Route::put('/update/status', [DashboardController::class, 'updateStatus'])->name('dashboard.update.status');
    Route::put('/update/status/all', [DashboardController::class, 'updateStatusAll'])->name('dashboard.update.statusAll');
});

Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/getAuthCookie', [AuthController::class, 'getAuthCookie'])->name('auth.getAuthCookie');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
