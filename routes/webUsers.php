<?php

Route::middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/users',  'UserController@index')->name('users.index');
    Route::patch('users/{user}/toggle-state',  'UserController@toggleState')->name('users.toggleState');
    Route::patch('users/{user}/block',  'UserController@block')->name('users.block');
    Route::patch('users/{user}/unblock',  'UserController@unblock')->name('users.unblock');
    Route::patch('users/{user}/toggle-type',  'UserController@toggleType')->name('users.toggleType');
    Route::patch('users/{user}/promote',  'UserController@promote')->name('users.promote');
    Route::patch('users/{user}/demote',  'UserController@demote')->name('users.demote');
});
