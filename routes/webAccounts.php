<?php

Route::get('/accounts/{user}', 'AccountController@index' )->name('accounts.index');
Route::get('/accounts/{user}/opened', 'AccountController@showOpenedAccounts' )->name('accounts.showOpenedAccounts');
Route::get('/accounts/{user}/closed', 'AccountController@showClosed' )->name('accounts.showClosed');
Route::delete('/accounts/{account}', 'AccountController@destroy' )->name('accounts.destroy');
Route::patch('/accounts/{account}/close', 'AccountController@close' )->name('accounts.close');
Route::patch('/accounts/{account}/reopen', 'AccountController@reopen' )->name('accounts.reopen');
Route::put('/accounts', 'AccountController@store' )->name('accounts.store');
Route::get('/accounts/{account}', 'AccountController@show' )->name('accounts.show');



