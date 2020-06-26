<?php

use App\Http\Controllers\StoreController;
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
Route::post('login', 'UserController@login');
Route::get('product/public-page', 'ProductController@publicPage');
Route::post('register', 'UserController@register');
Route::group(['middleware' => 'auth:api'], function()
{
    Route::resource('store', 'StoreController');
    Route::resource('product', 'ProductController');
});

