<?php

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

Route::middleware('auth:api')->group(function () {

    //Business
    Route::prefix('business')->group(function () {
        //Get all
        Route::get('/', 'BusinessController@index');
        //Get 1
        Route::get('/{id}', 'BusinessController@show');
        //Create
        Route::post('/create', 'BusinessController@create');
        //Edit
        Route::put('/{id}', 'BusinessController@edit');
        //Delete
        Route::delete('/{id}', 'BusinessController@delete');
    });

    //Categories
    Route::prefix('categories')->group(function () {
        //Get all
        Route::get('/', 'categoriesController@index');
        //Get 1
        Route::get('/{id}', 'categoriesController@show');
        //Create
        Route::post('/create', 'categoriesController@create');
        //Edit
        Route::put('/{id}', 'categoriesController@edit');
        //Delete
        Route::delete('/{id}', 'categoriesController@delete');
    });

});
