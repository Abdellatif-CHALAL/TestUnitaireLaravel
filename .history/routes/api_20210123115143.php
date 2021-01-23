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

Route::resource('/users', 'App\Http\Controllers\UserController');
Route::post('/users', 'App\Http\Controllers\UserController@store');
Route::resource('/items', 'App\Http\Controllers\ItemController');
Route::resource('/todo_list', 'App\Http\Controllers\TodoListController');
