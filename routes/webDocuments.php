<?php

// Route::middleware(['auth', 'ownerOfMovement'])->group(function () {
Route::middleware(['auth'])->group(function () {
    Route::get('document/{document}', 'DocumentController@show' )->name('document.show');
    Route::post('documents/{movement}', 'DocumentController@store' )->name('documents.store');
    Route::delete('document/{document}', 'DocumentController@destroy' )->name('document.delete');
    Route::get('document/{document}/create', 'DocumentController@create' )->name('document.create');
});
