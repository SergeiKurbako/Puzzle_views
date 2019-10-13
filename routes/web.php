<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/confirm-email', 'HomeController@confirmEmail');
Route::get('/after-registration', 'HomeController@afterRegistration');
Route::get('/wait-confirm', 'HomeController@waitConfirm');

Route::get('logout','Auth\LoginController@logout')->name('get-logout');



Route::get('/test-sms', 'HomeController@testSms');
