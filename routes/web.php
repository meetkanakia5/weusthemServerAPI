<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\PersonalDetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('personal-detail', PersonalDetailController::class);
Route::get('/personal-detail-delete/{id}', [PersonalDetailController::class, 'destroy'])->name('personal-detail-delete');

Route::get('get-city', [PersonalDetailController::class, 'getCity'])->name('get-city');
