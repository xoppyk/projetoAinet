<?php

Route::middleware(['auth'])->name('me.')->group(function () {
    Route::get('profiles', 'ProfileController@index' )->name('index');
    Route::get('/me/profile',  'ProfileController@editProfile')->name('editProfile');
    Route::get('/me/profile/editPassword',  'ProfileController@editPassword')->name('editPassword');
    Route::put('/me/profile',  'ProfileController@updateProfile')->name('updateProfile');
    Route::patch('/me/password',  'ProfileController@updatePassword')->name('updatePassword');
    Route::get('/me/associates',  'ProfileController@associates')->name('associates');
    Route::post('/me/associates',  'ProfileController@storeAssociates')->name('storeAssociates');
    Route::get('/me/associate-of',  'ProfileController@associatesOf')->name('associatesOf');
    Route::delete('/me/associates/{user}',  'ProfileController@destroyAssociates')->name('deleteAssociates');
});
