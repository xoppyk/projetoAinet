<?php 
Route::post('documents/{movement}', 'DocumentController@store' )->name('documents.store');
Route::delete('documents/{movement}', 'DocumentController@destroy' )->name('documents.destroy');
Route::get('documents/{movement}', 'DocumentController@create' )->name('documents.create');
