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
    Route::get('/user/catalogue/{id}', [UserCatalogueController::class, 'read'])->name('userCatalogue.read')->where(['id' => '[0-9]+']);
    Route::post('/user/catalogue/store', [UserCatalogueController::class, 'store'])->name('u serCatalogue.store');
    Route::put('/user/catalogue/update/{id}', [UserCatalogueController::class, 'update'])->name('userCatalogue.update')->where(['id' => '[0-9]+']);
    Route::delete('/user/catalogue/deleteAll', [UserCatalogueController::class, 'deleteAll'])->name('userCatalogue.deleteAll');
    Route::delete('/user/catalogue/delete/{id}', [UserCatalogueController::class, 'delete'])->name('userCatalogue.destroy')->where(['id' => '[0-9]+']);

    // GENERA;
    Route::put('/update/status', [DashboardController::class, 'updateStatus'])->name('dashboard.update.status');
    Route::put('/update/status/all', [DashboardController::class, 'updateStatusAll'])->name('dashboard.update.statusAll');
});

Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/getAuthCookie', [AuthController::class, 'getAuthCookie'])->name('auth.getAuthCookie');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
