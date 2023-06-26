<?php

use App\Http\Controllers\BarometreController;
use Illuminate\Support\Facades\Route;

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

Route::resource('/', '\App\Http\Controllers\BarometreController');

Route::get('metiers/{id}', '\App\Http\Controllers\BarometreController@getMetiers');
Route::get('specialisations/{id}', '\App\Http\Controllers\BarometreController@getSpecialisations');
Route::get('stacks/{id}', '\App\Http\Controllers\BarometreController@getStacks');
Route::get('villes', '\App\Http\Controllers\BarometreController@getVilles');
Route::get('frameworks/{id}/{stack}', '\App\Http\Controllers\BarometreController@getFrameworks');
Route::get('form', '\App\Http\Controllers\BarometreController@submitForm')->name('submitForm');
Route::get('success/{secteur}/{metier}/{stack}/{specialisation}/{framework}', '\App\Http\Controllers\BarometreController@success')->name('success');
Route::get('/estimateur', function () {
    return view('estimation');
});
