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

Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {
    Route::post('signin', 'Api\V1\Auth\SignInController')->name('signIn');

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::group(['prefix' => 'books', 'as' => 'books.'], function () {
            Route::get('', 'Api\V1\BookController@index')->name('index');
            Route::get('{book}', 'Api\V1\BookController@get')->where('book', '[0-9]+')->name('get');
            Route::put('{book}', 'Api\V1\BookController@update')->where('book', '[0-9]+')->middleware('can:update,App\Models\Book')->name('update');
            Route::delete('{book}', 'Api\V1\BookController@destroy')->where('book', '[0-9]+')->middleware('can:delete,App\Models\Book')->name('delete');
        });
    });
});
