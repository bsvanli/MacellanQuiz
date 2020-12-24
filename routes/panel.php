<?php

Route::get('login', 'AuthController@login')->name('login');
Route::get('login-ajax', 'AuthController@login')->name('login-ajax');

Route::middleware(['auth:web'])->group(function () {
    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::get('/', 'ProductController@all')->name('home');

    Route::prefix('product')->group(function () {
        Route::get('all', 'ProductController@all')->name('product-all');
        Route::get('add', 'ProductController@add')->name('product-add');
        Route::get('edit/{id}', 'ProductController@edit')->name('product-edit');
    });
/*
    Route::prefix('customer')->group(function () {
        Route::get('all', 'CustomerController@all')->name('customer-all');
    });

    Route::prefix('order')->group(function () {
        Route::get('all', 'OrderController@all')->name('order-all');
        Route::get('show/{id}', 'OrderController@show')->name('order-show');
    });
*/
});
