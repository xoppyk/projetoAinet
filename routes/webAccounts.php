<?php

Route::middleware(['auth', 'associateOf'])->name('accounts.')->group(function () {
    Route::get('/accounts/{user}', 'AccountController@ofUser' )->name('ofUser');
    Route::get('/accounts/{user}/opened', 'AccountController@ofUserOpened' )->name('ofUserOpened');
    Route::get('/accounts/{user}/closed', 'AccountController@ofUserClosed' )->name('ofUserClosed');
});


Route::delete('/accounts/{account}', 'AccountController@destroy' )->name('delete');
Route::patch('/accounts/{account}/close', 'AccountController@close' )->name('close');
Route::patch('/accounts/{account}/reopen', 'AccountController@reopen' )->name('reopen');
Route::put('/accounts', 'AccountController@store' )->name('store');
Route::get('/accounts/{account}', 'AccountController@show' )->name('show');
