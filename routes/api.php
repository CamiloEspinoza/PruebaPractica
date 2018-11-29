<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('getDias', 'CalendarioController@getDias');
Route::post('store', 'CalendarioController@store');