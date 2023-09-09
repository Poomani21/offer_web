<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group([
    'prefix' => 'auth', 'as' => 'auth.'
], function () {
    Route::post('login', 'App\Http\Controllers\Mobile\LoginController@login')->name('login');
});

Route::post('logout', 'App\Http\Controllers\Mobile\LoginController@logout')->name('logout');

Route::middleware(['jwt.verify'])->group(function () {

Route::post('user', 'App\Http\Controllers\Mobile\LoginController@me');
Route::post('user_update', 'App\Http\Controllers\Mobile\LoginController@profileUpdate');
Route::get('images','App\Http\Controllers\Mobile\ImagesController@index');

});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
