<?php

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SectionController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Backend\CategorieController;
use App\Http\Controllers\Backend\MycafeController;

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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::group(['prefix' => 'customer'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::group(['prefix' => 'admin'], function () {
    Route::post('/login', [AuthAdminController::class, 'login']);
});

Route::group(['middleware' => ['auth:sanctum', 'abilities:admin']], function () {
    ///////          Section        //////////

    Route::group(['prefix' => 'section'], function () {
        Route::get('/index', [SectionController::class, 'index']);
        Route::post('/store', [SectionController::class, 'store']);
        Route::get('/edit/{id}', [SectionController::class, 'edit']);
        Route::post('/update/{id}', [SectionController::class, 'update']);
        Route::delete('/destroy/{id}', [SectionController::class, 'destroy']);
    });

    /////         category      ///////////
    Route::group(['prefix' => 'category'], function () {
        Route::get('/index', [CategorieController::class, 'index']);
        Route::post('/store', [CategorieController::class, 'store']);
        Route::get('/edit/{id}', [CategorieController::class, 'edit']);
        Route::post('/update/{id}', [CategorieController::class, 'update']);
        Route::delete('/destroy/{id}', [CategorieController::class, 'destroy']);
    });

    ////  Products  /////////////////
    Route::group(['prefix' => 'product'], function () {
        Route::get('/index', [ProductController::class, 'index']);
        Route::post('/store', [ProductController::class, 'store']);
        Route::get('/edit/{id}', [ProductController::class, 'edit']);
        Route::post('/update/{id}', [ProductController::class, 'update']);
        Route::delete('/destroy/{id}', [ProductController::class, 'destroy']);
    });

    Route::group(['prefix' => 'mycafe'], function () {
        Route::get('/index', [MycafeController::class, 'index']);
        Route::post('/store', [MycafeController::class, 'store']);
        Route::get('/edit/{id}', [MycafeController::class, 'edit']);
        Route::post('/update/{id}', [MycafeController::class, 'update']);
        Route::delete('/destroy/{id}', [MycafeController::class, 'destroy']);
    });
});
