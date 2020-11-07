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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'authcheck'], function () {
Route::post('add-team','App\Http\Controllers\ApiController@addTeam');
Route::get('get-team','App\Http\Controllers\ApiController@getTeam');
Route::post('add-player','App\Http\Controllers\ApiController@addPlayer');
Route::get('get-player','App\Http\Controllers\ApiController@getPlayer');

Route::get('get-player/{id}','App\Http\Controllers\ApiController@getPlayer');

Route::post('edit-player','App\Http\Controllers\ApiController@editPlayer');
});
