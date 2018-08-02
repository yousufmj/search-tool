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

//Business
Route::prefix('business')->group(function () {
    //Get all
    Route::get('/', 'BusinessController@index');
    //Get 1
    Route::get('/{id}', 'BusinessController@index');
    //Create
    Route::post('/create', 'BusinessController@create');
    //Edit
    Route::put('/{id}', 'BusinessController@edit');
    //Delete
    Route::delete('/{id}', 'BusinessController@delete');
});
