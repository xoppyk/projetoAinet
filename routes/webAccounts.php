<?php

Route::middleware(['auth', 'associateOf'])->name('accounts.')->group(function () {
    Route::get('/accounts/{user}', 'AccountController@ofUser' )->name('ofUser');
    Route::get('/accounts/{user}/opened', 'AccountController@ofUserOpened' )->name('ofUserOpened');
    Route::get('/accounts/{user}/closed', 'AccountController@ofUserClosed' )->name('ofUserClosed');
});

Route::middleware(['auth'])->name('account.')->group(function () {
    Route::get('/account', 'AccountController@create' )->name('create');
    Route::post('/account', 'AccountController@store' )->name('store');
    Route::get('/account/{account}/edit', 'AccountController@edit' )->name('edit')->middleware('ownerOfAccount');
    Route::put('/account/{account}', 'AccountController@update' )->name('update')->middleware('ownerOfAccount');
   	Route::delete('/account/{account}', 'AccountController@destroy' )->name('delete')->middleware('ownerOfAccount');
	Route::patch('/account/{account}/close', 'AccountController@close' )->name('close')->middleware('ownerOfAccount');
	Route::patch('/account/{account}/reopen', 'AccountController@reopen' )->name('reopen')->middleware('ownerOfAccount');
	Route::get('/account/{account}', 'AccountController@show' )->name('show')->middleware('ownerOfAccount');
});
