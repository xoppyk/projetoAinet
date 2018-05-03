<?php 
Route::get('movements/{account}', 'MovementController@show' )->name('movements.show');
Route::get('movements/{account}/create', 'MovementController@create' )->name('movements.create');
Route::post('movements/{account}/create', 'MovementController@store' )->name('movements.store');
Route::get('movements/{movement}', 'MovementController@edit' )->name('movements.edit');
Route::put('movements/{movement}', 'MovementController@update' )->name('movements.update');
Route::delete('movements/{movement}', 'MovementController@destroy' )->name('movements.destroy');

