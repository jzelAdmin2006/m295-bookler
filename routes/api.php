<?php

use App\Models\Book;
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
        Route::get("/", function () {
            return Book::get();
        });

        Route::get("/{id}", function ($id) {
            return Book::find($id);
        });
    });
    Route::get("/search/{search}", function ($search) {
        return Book::where('title', 'LIKE', '%' . $search . '%')->orWhere('author', 'LIKE', '%' . $search . '%')->get();
    });

    Route::group(['prefix' => '/book-finder'], function () {
        Route::get("/slug/{slug}", function ($slug) {
            return Book::where('slug', $slug)->first();
        });
        Route::get("/year/{year}", function ($year) {
            return Book::where('year', $year)->get();
        });
        Route::get("/max-pages/{pages}", function ($pages) {
            return Book::where('pages', '<', $pages)->get();
        });
    });

    Route::group(['prefix' => '/meta'], function () {
        Route::get("/count", function () {
            return Book::count();
        });
        Route::get("/avg-pages", function () {
            return Book::avg('pages');
        });
    });
});
