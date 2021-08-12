<?php

// Auth
Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    // Dashboard
    Route::get('/', 'DashboardController@show')->name('home');
    Route::get('/dashboard', 'DashboardController@show')->name('dashboard');

    // Resource Routes
    Route::resources([
        'users' => 'UserController',
    ]);

});