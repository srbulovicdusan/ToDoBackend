<?php

use App\Http\Controllers\TodoController;
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
Route::group([

    'prefix' => 'auth'

], function ($router) {

Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');
Route::post('me', 'AuthController@me');
Route::post('registration', 'Auth\RegisterController@create');

});
Route::group([
        'middleware' => 'auth'
    ], function($router){
Route::post('todo', 'TodoController@store');
Route::put('todo', 'TodoController@edit');
Route::delete('todo', 'TodoController@destroy');
Route::get('todo', 'TodoController@all');
});
