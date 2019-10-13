<?php

Route::prefix('lidsystem')->group(function() {
    Route::get('/', 'LidSystemController@index');
    Route::get('/step1', 'LidSystemController@step1');
    Route::post('/step1/create', 'LidSystemController@step1Create');
    Route::get('/step2', 'LidSystemController@step2');
    Route::post('/step2/create', 'LidSystemController@step2Create');
    Route::get('/step3', 'LidSystemController@step3');
    Route::post('/step3/create', 'LidSystemController@step3Create');
    Route::get('/step5', 'LidSystemController@step5');
    Route::get('/save-game-result', 'LidSystemController@saveGameResult');

    Route::get('/check-have-email', 'LidSystemController@checkHaveEmail');
    Route::get('/check-right-sms-code', 'LidSystemController@checkRightSmsCode');


    Route::get('/{id}/complaint', 'ComplaintController@createComplaint');
    Route::post('/{id}/complaint', 'ComplaintController@storeComplaint');

    Route::get('/complaints/{id}/update', 'ComplaintController@updateComplaint');
});
