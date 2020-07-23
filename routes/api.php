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
        'prefix' => 'user'
    ], function () {
        Route::group([
            'prefix' => 'directories'
        ], function () {

            Route::get('', 'FileStorageController@index')
                ->name('file-management-user-index-directories');

            Route::post('', 'FileStorageController@store')
                ->name('file-management-user-store-directories');

            Route::put('{id}', 'FileStorageController@update')
                ->name('file-management-user-update-directory');

            Route::delete('{id}', 'FileStorageController@delete')
                ->name('file-management-user-delete-directory');

            Route::get('{id}', 'FileStorageController@show')
                ->name('file-management-user-show-directories');
        });
    });
});

# 'pembayaran' endpoints
Route::group([
    'prefix' => 'bayar'
    // 'middleware' => 'auth:api'
], function () {
});
