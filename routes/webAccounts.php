<?php

Route::middleware(['auth', 'associateOf'])->name('accounts.')->group(function () {
    Route::get('/account/{user}', 'AccountController@ofUser' )->name('ofUser');
    Route::get('/account/{user}/opened', 'AccountController@ofUserOpened' )->name('ofUserOpened');
    Route::get('/account/{user}/closed', 'AccountController@ofUserClosed' )->name('ofUserClosed');
});

Route::middleware(['auth'])->name('accounts.')->group(function () {
   	Route::delete('/account/{account}', 'AccountController@destroy' )->name('delete');
	Route::patch('/account/{account}/close', 'AccountController@close' )->name('close');
	Route::patch('/account/{account}/reopen', 'AccountController@reopen' )->name('reopen');
	Route::put('/account', 'AccountController@store' )->name('store');
	Route::get('/account/{account}', 'AccountController@show' )->name('show');
});

