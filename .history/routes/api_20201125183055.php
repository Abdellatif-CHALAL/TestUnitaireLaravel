<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/users', 'App\Http\Controllers\UserController@index');
Route::get('/user/show/{id}', 'App\Http\Controllers\UserController@show');
Route::post('/user', 'App\Http\Controllers\UserController@store');
Route::post('/user/{id}', 'App\Http\Controllers\UserController@destroy');
