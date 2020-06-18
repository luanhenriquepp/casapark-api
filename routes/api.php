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
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::group(['middleware' => 'auth:api'], function()
{
    Route::post('details', 'UserController@details');
    Route::get('dashboard/purchase-total', 'DashboardController@getTotalPurchase');
    Route::get('dashboard/sale-total', 'DashboardController@getTotalSale');
    Route::get('dashboard/total-sale-current-month', 'DashboardController@getTotalSaleInCurrentMonth');
    Route::get('dashboard/total-net-profit', 'DashboardController@getTotalNetProfit');
    Route::get('available-stock', 'StockController@availableStock');
    Route::get('dashboard/biggest-buyers', 'DashboardController@biggestBuyers');
    Route::get('dashboard/total-sold-per-month', 'DashboardController@totalSoldPerMonth');

    Route::resource('purchase', 'PurchaseController');
    Route::resource('sale', 'SaleController');
    Route::resource('stock', 'StockController');
    Route::resource('coupon', 'CouponController');

});

