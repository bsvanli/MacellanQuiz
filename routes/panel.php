<?php

Route::get('login', 'AuthController@login')->name('login');
Route::post('login-ajax', 'Ajax\AuthController@login')->name('login-ajax');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/', 'DashboardController@home')->name('home');
    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::prefix('category')->name('category.')->group(function(){
        Route::get('all', 'CategoryController@all')->name('all');
        Route::get('edit/{category}', 'CategoryController@edit')->name('edit');
        Route::get('add', 'CategoryController@add')->name('add');

        Route::prefix('ajax')->name('ajax.')->namespace('Ajax')->group(function(){
            Route::get('all', 'CategoryController@all')->name('all');
            Route::post('update/{category}', 'CategoryController@update')->name('update');
            Route::post('add', 'CategoryController@add')->name('add');
        });
    });

    Route::prefix('product')->name('product.')->group(function(){
        Route::get('all', 'ProductController@all')->name('all');
        Route::get('edit/{product}', 'ProductController@edit')->name('edit');
        Route::get('add', 'ProductController@add')->name('add');

        Route::prefix('ajax')->name('ajax.')->namespace('Ajax')->group(function(){
            Route::get('all', 'ProductController@all')->name('all');
            Route::post('update/{product}', 'ProductController@update')->name('update');
            Route::post('add', 'ProductController@add')->name('add');
        });
    });

});
