<?php
//TODO Perguntar ao prof
// Route::middleware(['auth', 'ownerOfAccount'])->name('movements.')->group(function () {
Route::middleware(['auth', 'ownerOfAccount'])->name('movements.')->group(function () {
    Route::get('movements/{account}', 'MovementController@index' )->name('index');
    Route::get('movements/{account}/create', 'MovementController@create' )->name('create');
    Route::post('movements/{account}/create', 'MovementController@store' )->name('store');
});

Route::middleware('auth')->name('movements.')->group(function () {
    Route::get('movements/{movement}/edit', 'MovementController@edit' )->name('edit');
    Route::put('movements/{movement}', 'MovementController@update' )->name('update');
    Route::delete('movements/{movement}', 'MovementController@destroy' )->name('destroy');
});
