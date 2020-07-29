<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\RiskyTestError;

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

// Route::get('docs/{version}', 'RootController@getDocs');


# to retrieve files by authenticated user.
Route::group([
    'prefix' => 'file-management',
    'middleware' => 'auth:api'
], function () {

    Route::group([
        'prefix' => 'files'
    ], function () {
        Route::get('{id?}', 'FileStorageController@index')
            ->name('file-management.files.index');

        Route::post('', 'FileStorageController@store')
            ->name('file-management.files.store');
    });
});

# 'pembayaran' endpoints
Route::group([
    'prefix' => 'bayar'
    // 'middleware' => 'auth:api'
], function () {
});
