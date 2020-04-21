<?php

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
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/spp', 'SppController@index')->name('spp');
Route::prefix('spp')->group(function () {
    Route::get('/json', 'SppController@json');
    Route::get('/{id}', 'SppController@show')->name('spp.show');
    Route::post('/', 'SppController@store')->name('spp.store');
    Route::put('/{id}', 'SppController@update')->name('spp.update');
    Route::delete('/{id}', 'SppController@destroy')->name('spp.destroy');
});

Auth::routes(['verify' => true]);
