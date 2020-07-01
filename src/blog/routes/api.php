<?php

use Illuminate\Http\Request;

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

Route::pattern('apiVersion1', 'v[1]');
Route::prefix('{apiVersion1}')->namespace('Api\V1')->middleware('api')->name('api.')->group(function () {
    // Auth
    Route::namespace('Authencation')->group(function () {
        Route::post('/login', 'AuthencationController@login')->name('login');
        Route::post('/logout', 'AuthencationController@logout');
    });

    Route::prefix('book')->namespace('Book')->group(function () {
        Route::group(['middleware' => 'filter'], function () {
            Route::get('/index', 'BookController@index');
            Route::get('/show/{slug}', 'BookController@show');
            Route::get('/top', 'BookController@topBook');
        });
    });

    Route::prefix('category')->namespace('Category')->group(function () {
        Route::group(['middleware' => 'filter'], function () {
            Route::get('/list', 'CategoryList@index');
            Route::get('/book-of-category/{slug}', 'CategoryList@bookOfCategory')->name('book_of_category');
            // Route::get('/show/{slug}', 'BookController@show');
        });
    });
    
    Route::namespace('Contact')->group(function () {
        Route::post('store-contact', 'ContactController@createContact');
    });

    Route::get('/', 'Index@index')->name('index');
});
