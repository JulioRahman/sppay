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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    Route::get('/detail/json', 'StudentController@jsonDetail');
    Route::get('/detail/{id}', 'StudentController@detail')->name('student.detail');
});

Route::get('/pengguna/{role}', 'UserController@index')->name('user');
Route::prefix('pengguna/{role}')->group(function () {
    Route::get('/json', 'UserController@json');
    Route::get('/{id}', 'UserController@show')->name('user.show');
    Route::post('/', 'UserController@store')->name('user.store');
    Route::put('/{id}', 'UserController@update')->name('user.update');
    Route::delete('/{id}', 'UserController@destroy')->name('user.destroy');
});

Route::get('/bayar', 'PaymentController@index')->name('payment');
Route::prefix('bayar')->group(function () {
    Route::get('/json', 'PaymentController@json');
    Route::get('/{id}', 'PaymentController@show')->name('payment.show');
    Route::post('/', 'PaymentController@store')->name('payment.store');
    Route::put('/{id}', 'PaymentController@update')->name('payment.update');
    Route::delete('/{id}', 'PaymentController@destroy')->name('payment.destroy');
});

Route::fallback(function () {
    return view('errors.404');
});

Auth::routes(['verify' => true]);
