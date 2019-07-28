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
//https://code.tutsplus.com/tutorials/laravel-4-a-start-at-a-restful-api-updated--net-29785
//https://medium.freecodecamp.org/how-to-build-a-laravel-rest-api-with-test-driven-development-c4bb6417db3c
///https://www.lynda.com/PHP-tutorials/Returning-validation-errors/677182/713687-4.html belki
//https://emirkarsiyakali.com/laravel-5-5-lts-api-resources-69350452f8d6
