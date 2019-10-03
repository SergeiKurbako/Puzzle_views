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

Route::prefix('gameframe')->group(function() {
    Route::get('/{id}', 'GameFrameController@show');
    Route::post('/store-user-frame', 'GameFrameController@storeUserFrame');
    Route::post('/store-admin-frame', 'GameFrameController@storeAdminFrame');
    Route::get('/update-game-status/{id}', 'GameFrameController@updateGameStatus');
    Route::get('/update-frame-status/{id}', 'GameFrameController@updateFrameStatus');
    Route::get('/delete/{id}', 'GameFrameController@deleteFrame');
    Route::post('/set-price/{id}', 'GameFrameController@setPrice');
    Route::get('/update-sms-confirm-status/{id}', 'GameFrameController@updateSmsConfirmStatus');
    Route::get('/update-email-confirm-status/{id}', 'GameFrameController@updateEmailConfirmStatus');
});
