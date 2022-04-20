<?php

Route::group([
	'middleware' => 'auth',
	'prefix' => 'clients',
	'as' => 'clients.'
], function() {
	

	// Clients.
	Route::get('/', \Egent\Client\Controllers\IndexController::class)->name('index');
	Route::get('/create', \Egent\Client\Controllers\CreateController::class)->name('create');
	Route::post('/', \Egent\Client\Controllers\StoreController::class)->name('store');
	Route::get('/{client}', \Egent\Client\Controllers\ShowController::class)->name('show');
	Route::get('/{client}/edit', \Egent\Client\Controllers\EditController::class)->name('edit');
	Route::patch('/{client}', \Egent\Client\Controllers\UpdateController::class)->name('update');
	Route::get('/{client}/delete', \Egent\Client\Controllers\DeleteController::class)->name('delete');
	Route::delete('/{client}', \Egent\Client\Controllers\DestroyController::class)->name('destroy');
});
