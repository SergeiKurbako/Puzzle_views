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

Route::prefix('socket')->group(function() {
    Route::get('/', 'SocketController@index');

    Route::get('init-event', function () {
        $data = [
            'topic_id' => 'onNewData',
            'data' => 'somData: ' . rand(0, 1000)
        ];

        \Modules\Socket\Services\Socket\PusherSocket::sentDataToServer($data);
    });
});
