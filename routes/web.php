<?php

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'HomeController@showHomePage')->name('frontend.home');
    Route::get('/product/{slug}', 'ProductController@showDetails')->name('product.details');

    Route::get('/cart', 'CartController@showCart')->name('cart.show');
    Route::post('/cart', 'CartController@addToCart')->name('cart.add');
    Route::post('/cart/remove', 'CartController@removeFromCart')->name('cart.remove');
    Route::get('/cart/clear', 'CartController@clearCart')->name('cart.clear');

    Route::get('/checkout', 'CartController@checkout')->name('checkout');

    Route::get('/login', 'AuthController@showLoginForm')->name('login');
    Route::post('/login', 'AuthController@processLogin');

    Route::get('/register', 'AuthController@showRegisterForm')->name('register');
    Route::post('/register', 'AuthController@processRegister');

    Route::get('/activate/{token}', 'AuthController@activate')->name('activate');

    Route::group(['middleware' => 'auth'], function () {
        Route::post('/order', 'CartController@processOrder')->name('order');
        Route::get('/order/{id}', 'CartController@showOrder')->name('order.details');

        Route::get('/profile', 'AuthController@profile')->name('profile');
        Route::get('/logout', 'AuthController@logout')->name('logout');
    });
});

Route::get('/api/cart', 'Frontend\HomeController@getCart');
Route::get('/api/pdf', 'Frontend\HomeController@getPdf');
Route::get('/api/sms', 'Frontend\HomeController@sendSms');
Route::post('/', 'Frontend\HomeController@getPayment');
