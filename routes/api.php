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
    $controller = BookController::class;

    Route::group(['prefix' => '/books'], function () use ($controller) {
        Route::get('/', [$controller, 'findAll']);
        Route::get('/{id}', [$controller, 'findById']);
    });

    Route::get('/search/{search}', [$controller, 'search']);

    Route::group(['prefix' => '/book-finder'], function () use ($controller) {
        Route::get('/slug/{slug}', [$controller, 'findBySlug']);
        Route::get('/year/{year}', [$controller, 'findByYear']);
        Route::get('/max-pages/{pages}', [$controller, 'findByPages']);
    });

    Route::group(['prefix' => '/meta'], function () use ($controller) {
        Route::get("/count", [$controller, 'getCount']);
        Route::get("/avg-pages", [$controller, 'getAvgPages']);
    });

    Route::get("/dashboard", [$controller, 'getDashboard']);
});
