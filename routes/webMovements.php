<?php
//TODO Perguntar ao prof
// Route::middleware(['auth', 'ownerOfAccount'])->name('movements.')->group(function () {
Route::middleware(['auth', 'ownerOfAccount'])->name('movements.')->group(function () {
    Route::get('movements/{account}/create', 'MovementController@create' )->name('create');
    Route::post('movements/{account}/create', 'MovementController@store' )->name('store');
});

Route::get('movements/{account}', 'MovementController@index' )->name('movements.index')->middleware('auth');

Route::middleware(['auth', 'ownerOfMovement'])->name('movement.')->group(function () {
    Route::get('movement/{movement}', 'MovementController@edit' )->name('edit');
    Route::put('movement/{movement}', 'MovementController@update' )->name('update');
    Route::delete('movement/{movement}', 'MovementController@destroy' )->name('destroy');
});
