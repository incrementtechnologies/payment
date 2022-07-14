<?php

Route::group(['middleware' =>  env('PLATFORM') === 'PAYHIRAM' ? ['general_validation', 'token_authorization'] : null], function () {
    // Payment Methods
    $route = env('PACKAGE_ROUTE', '').'/payment_methods/';
    $controller = 'Increment\Payment\Http\PaymentMethodController@';
    Route::post($route.'create', $controller."create");
    Route::post($route.'retrieve', $controller."retrieve");
    Route::post($route.'update', $controller."update");
    Route::post($route.'delete', $controller."delete");
    Route::get($route.'test', $controller."test");

    // Stripe Cards
    $route = env('PACKAGE_ROUTE', '').'/stripe_cards/';
    $controller = 'Increment\Payment\Http\StripeCardController@';
    Route::post($route.'create', $controller."create");
    Route::post($route.'create_charge', $controller."createCharge");
    Route::post($route.'retrieve', $controller."retrieve");
    Route::post($route.'update', $controller."update");
    Route::post($route.'delete', $controller."delete");
    Route::get($route.'test', $controller."test");

    // Stripe Cards
    $route = env('PACKAGE_ROUTE', '').'/stripes/';
    $controller = 'Increment\Payment\Http\StripeController@';
    Route::post($route.'create', $controller."create");
    Route::post($route.'retrieve', $controller."retrieve");
    Route::post($route.'update', $controller."update");
    Route::post($route.'delete', $controller."delete");
    Route::get($route.'test', $controller."test");


    // Paypal Transaction
    $route = env('PACKAGE_ROUTE', '').'/paypal_transactions/';
    $controller = 'Increment\Payment\Http\PaypalTransactionController@';
    Route::post($route.'create', $controller."create");
    Route::post($route.'retrieve', $controller."retrieve");
    Route::post($route.'update', $controller."update");
    Route::post($route.'delete', $controller."delete");
    Route::get($route.'test', $controller."test");

});
