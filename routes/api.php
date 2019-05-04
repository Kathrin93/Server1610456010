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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api', 'cors']], function() {
    Route::post('auth/login', 'Auth\ApiAuthController@login');

    Route::get('books', 'BookController@index');
    Route::get('book/{isbn}', 'BookController@findByISBN');
    Route::get('book/checkisbn/{isbn}', 'BookController@checkISBN');
    Route::get('books/search/{searchTerm}', 'BookController@findBySearchTerm');


    // Ab hier eigene selbst angelegte Routen
    Route::get('orders', 'OrderController@index');
    Route::get('order/{id}', 'OrderController@findByID');

});


// methods with auth
Route::group(['middleware' => ['api', 'cors', 'jwt-auth']], function() {

// update book
    Route::put('book/{isbn}', 'BookController@update');
// delete book
    Route::delete('book/{isbn}', 'BookController@delete');

// insert book
    Route::post('book', 'BookController@save');

    Route::post('auth/logout', 'Auth\ApiAuthController@logout');
    Route::post('auth/user', 'Auth\ApiAuthController@getCurrentAuthenticationUser');

   // Ab hier eigene selbst angelegte Routen
    //insert new order
    Route::post('order', 'OrderController@save');

    //update order (state)
    Route::put('order/{id}', 'OrderController@updateState');

});

