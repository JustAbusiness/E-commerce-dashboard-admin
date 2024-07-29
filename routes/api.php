<?php

use App\Http\Controllers\Api\Finder\HandlerCommand\CreateFolderController;
use App\Http\Controllers\Api\Finder\HandlerCommand\RenameFolderController;
use App\Http\Controllers\Api\Finder\HandlerCommand\UploadController;
use App\Http\Controllers\Api\Finder\HandlerCommand\ListController;
use App\Http\Controllers\Api\V1\LocationController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\Product\ProductCatalogueController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\User\UserCatalogueController;
use App\Http\Controllers\Api\V1\User\UserController;



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard/getModule', [DashboardController::class, 'getModule'])->name('dashboard.getModule');
    Route::get('/auth/refreshToken', [AuthController::class, 'refreshToken'])->name('auth.refreshToken');

    // USER CATALOGUE
    Route::get('/user/catalogue', [UserCatalogueController::class, 'index'])->name('userCatalogue.index');
    Route::get('/user/catalogue/all', [UserCatalogueController::class, 'all'])->name('userCatalogue.all');
    Route::get('/user/catalogue/{id}', [UserCatalogueController::class, 'read'])->name('userCatalogue.read')->where(['id' => '[0-9]+']);
    Route::post('/user/catalogue/store', [UserCatalogueController::class, 'store'])->name('u serCatalogue.store');
    Route::put('/user/catalogue/update/{id}', [UserCatalogueController::class, 'update'])->name('userCatalogue.update')->where(['id' => '[0-9]+']);
    Route::delete('/user/catalogue/deleteAll', [UserCatalogueController::class, 'deleteAll'])->name('userCatalogue.deleteAll');
    Route::delete('/user/catalogue/delete/{id}', [UserCatalogueController::class, 'delete'])->name('userCatalogue.destroy')->where(['id' => '[0-9]+']);

    // USER
    Route::get('/user/info', [UserController::class, 'info'])->name('user.info');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/all', [UserController::class, 'all'])->name('user.all');
    Route::get('/user/{id}', [UserController::class, 'read'])->name('user.read')->where(['id' => '[0-9]+']);
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update')->where(['id' => '[0-9]+']);
    Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('user.destroy')->where(['id' => '[0-9]+']);

    // PRODUCT CATALOGUE
    Route::get('/product/catalogue', [ProductCatalogueController::class, 'index'])->name('productCatalogue.index');
    Route::get('/product/catalogue/all', [ProductCatalogueController::class, 'all'])->name('productCatalogue.all');
    Route::get('/product/catalogue/{id}', [ProductCatalogueController::class, 'read'])->name('productCatalogue.read')->where(['id' => '[0-9]+']);
    Route::post('/product/catalogue/store', [ProductCatalogueController::class, 'store'])->name('productCatalogue.store');
    Route::put('/product/catalogue/update/{id}', [ProductCatalogueController::class, 'update'])->name('productCatalogue.update')->where(['id' => '[0-9]+']);
    Route::delete('/product/catalogue/deleteAll', [ProductCatalogueController::class, 'deleteAll'])->name('productCatalogue.deleteAll');
    Route::delete('/product/catalogue/delete/{id}', [ProductCatalogueController::class, 'delete'])->name('productCatalogue.destroy')->where(['id' => '[0-9]+']);



    // LOCATION
    Route::get('/provinces', [LocationController::class, 'provinces'])->name('provinces.index');
    Route::get('/location', [LocationController::class, 'location'])->name('location.index');


    // FFINDER
    Route::post('/finder/create-root', [CreateFolderController::class, 'buildRootFolder'])->name('finder.create-root');
    Route::post('/finder/create/folder', [CreateFolderController::class, 'create'])->name('finder.create');
    Route::post('/finder/rename/folder', [RenameFolderController::class, 'rename'])->name('finder.rename');
    Route::post('/finder/upload', [UploadController::class, 'upload'])->name('finder.upload');
    Route::get('/finder/list', [ListController::class, 'list'])->name('finder.list');

    // GENERAL;
    Route::put('/update/status', [DashboardController::class, 'updateStatus'])->name('dashboard.update.status');
    Route::put('/update/status/all', [DashboardController::class, 'updateStatusAll'])->name('dashboard.update.statusAll');
});

Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/getAuthCookie', [AuthController::class, 'getAuthCookie'])->name('auth.getAuthCookie');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
