<?php

Route::patch('/me/password',  'UserController@password')->name('me.password');
Route::patch('/me/profile',  'UserController@profile')->name('me.profile');
Route::patch('/me/associates',  'UserController@associates')->name('me.associates');
Route::get('/me/associate-of',  'UserController@associate-of')->name('me.associate-of');
Route::get('/me/associate-of',  'UserController@associate-of')->name('me.associate-of');
Route::post('/me/associates',  'UserController@storeAssociates')->name('me.storeAssociates');
Route::delete('/me/associates/{user}',  'UserController@destroyAssociates')->name('me.deleteAssociates');

