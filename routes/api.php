<?php

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

Route::get("/books", function () {
    return DB::select('SELECT * FROM books');
});

Route::get("/books/{id}", function ($id) {
    return DB::select('SELECT * FROM books WHERE id = ?', [$id]);
});

Route::group(['prefix' => 'book-finder'], function () {
    Route::get("/slug/{slug}", function ($slug) {
        return DB::select('SELECT * FROM books WHERE slug = ?', [$slug]);
    });
    Route::get("/year/{year}", function ($year) {
        return DB::select('SELECT * FROM books WHERE year = ?', [$year]);
    });
    Route::get("/max-pages/{pages}", function ($pages) {
        return DB::select('SELECT * FROM books WHERE pages < ?', [$pages]);
    });
});
