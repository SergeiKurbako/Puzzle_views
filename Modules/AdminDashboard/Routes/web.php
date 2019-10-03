<?php

Route::prefix('admin-dashboard')->group(function() {
    Route::get('/', 'AdminDashboardController@index');
    Route::get('/requests', 'AdminDashboardController@showRequests');
    Route::get('/user/{id}', 'AdminDashboardController@showUser');
    Route::get('/frame/{id}', 'AdminDashboardController@showFrame');
    Route::get('/create-frame', 'AdminDashboardController@createFrame');
    Route::get('/frame/{id}/update', 'AdminDashboardController@updateFrame');
    Route::post('/frame/{id}/update', 'AdminDashboardController@storeFrame');
    Route::get('/user/{id}/on', 'AdminDashboardController@onUser');
    Route::get('/user/{id}/off', 'AdminDashboardController@offUser');
    Route::get('/user/{id}/delete', 'AdminDashboardController@deleteUser');
    Route::get('/complaints', 'AdminDashboardController@showComplaints');
    Route::get('/complaints/{id}', 'AdminDashboardController@showComplaint');
});
