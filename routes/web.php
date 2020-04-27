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

Route::get('/kelas', 'ClassController@index')->name('class');
Route::prefix('kelas')->group(function () {
    Route::get('/json', 'ClassController@json');
    Route::get('/{id}', 'ClassController@show')->name('class.show');
    Route::post('/', 'ClassController@store')->name('class.store');
    Route::put('/{id}', 'ClassController@update')->name('class.update');
    Route::delete('/{id}', 'ClassController@destroy')->name('class.destroy');
});

Route::get('/siswa', 'StudentController@index')->name('student');
Route::prefix('siswa')->group(function () {
    Route::get('/json', 'StudentController@json');
    Route::get('/{id}', 'StudentController@show')->name('student.show');
    Route::post('/', 'StudentController@store')->name('student.store');
    Route::put('/{id}', 'StudentController@update')->name('student.update');
    Route::delete('/{id}', 'StudentController@destroy')->name('student.destroy');
});

Auth::routes(['verify' => true]);
