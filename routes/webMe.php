<?php

Route::get('/me/profile',  'ProfileController@editProfile')->name('me.editProfile');
Route::get('/me/profile/editPassword',  'ProfileController@editPassword')->name('me.editPassword');


Route::patch('/me/password',  'ProfileController@updatePassword')->name('me.updatePassword');
Route::patch('/me/profile',  'ProfileController@updateProfile')->name('me.updateProfile');
Route::patch('/me/associates',  'ProfileController@associates')->name('me.associates');
Route::get('/me/associate-of',  'ProfileController@associate-of')->name('me.associate-of');
Route::get('/me/associate-of',  'ProfileController@associate-of')->name('me.associate-of');
Route::post('/me/associates',  'ProfileController@storeAssociates')->name('me.storeAssociates');
Route::delete('/me/associates/{user}',  'ProfileController@destroyAssociates')->name('me.deleteAssociates');
