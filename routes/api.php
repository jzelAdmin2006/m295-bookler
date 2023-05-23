<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/bookler'], function () {
    Route::group(['prefix' => '/books'], function () {
        Route::get('/', [BookController::class, 'findAll']);
        Route::get('/{id}', [BookController::class, 'findById']);
    });
    Route::get('/search/{search}', [BookController::class, 'search']);

    Route::group(['prefix' => '/book-finder'], function () {
        Route::get('/slug/{slug}', [BookController::class, 'findBySlug']);
        Route::get('/year/{year}', [BookController::class, 'findByYear']);
        Route::get('/max-pages/{pages}', [BookController::class, 'findByPages']);
    });

    Route::group(['prefix' => '/meta'], function () {
        Route::get("/count", [BookController::class, 'getCount']);
        Route::get("/avg-pages", [BookController::class, 'getAvgPages']);
    });

    Route::get("/dashboard", [BookController::class, 'getDashboard']);
});
