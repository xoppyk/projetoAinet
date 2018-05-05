<?php

Route::get('/me/{user}/profile',  'ProfileController@edit')->name('me.edit');
Route::patch('/me/password',  'ProfileController@password')->name('me.password');
Route::patch('/me/profile',  'ProfileController@update')->name('me.update');
Route::patch('/me/associates',  'ProfileController@associates')->name('me.associates');
Route::get('/me/associate-of',  'ProfileController@associate-of')->name('me.associate-of');
Route::get('/me/associate-of',  'ProfileController@associate-of')->name('me.associate-of');
Route::post('/me/associates',  'ProfileController@storeAssociates')->name('me.storeAssociates');
Route::delete('/me/associates/{user}',  'ProfileController@destroyAssociates')->name('me.deleteAssociates');
