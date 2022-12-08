<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\BlogController;
use App\Http\Controllers\FrontEnd\ContactController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('blogs', BlogController::class);


Route::resource('contacts', ContactController::class);
Route::get('/sort-table/{sortOption}', [ContactController::class, 'sort'])->name('sort-table');
Route::get('/search-table/{searchOption}', [ContactController::class, 'search'])->name('search-table');