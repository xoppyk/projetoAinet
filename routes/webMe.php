<?php

Route::get('profiles', 'ProfileController@index' )->name('me.index');

Route::get('/me/profile',  'ProfileController@editProfile')->name('me.editProfile');
Route::get('/me/profile/editPassword',  'ProfileController@editPassword')->name('me.editPassword');
Route::put('/me/profile',  'ProfileController@updateProfile')->name('me.updateProfile');
Route::patch('/me/password',  'ProfileController@updatePassword')->name('me.updatePassword');

Route::get('/me/associates',  'ProfileController@associates')->name('me.associates');
Route::post('/me/associates',  'ProfileController@storeAssociates')->name('me.storeAssociates');

Route::get('/me/associate-of',  'ProfileController@associate-of')->name('me.associate-of');
Route::delete('/me/associates/{user}',  'ProfileController@destroyAssociates')->name('me.deleteAssociates');
