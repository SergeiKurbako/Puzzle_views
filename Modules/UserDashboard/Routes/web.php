<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('user-dashboard')->group(function() {
    Route::get('/', 'UserDashboardController@index');
    Route::get('/create-frame', 'UserDashboardController@createFrame');
    Route::get('/frame/{id}', 'UserDashboardController@showFrame');
    Route::get('/frame-rules/{id}', 'UserDashboardController@showFrameRules');
    Route::post('/frame-rules/{id}/update', 'UserDashboardController@updateFrameRules');
    Route::get('/wallet', 'UserDashboardController@showWallet');
    Route::get('/frame/{id}/update', 'UserDashboardController@updateFrame');
    Route::post('/frame/{id}/update', 'UserDashboardController@storeFrame');
    Route::get('/billing', 'UserDashboardController@showBilling');
});
