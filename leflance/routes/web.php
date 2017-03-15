<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'MainController@mainPage')->name('main-page');

Route::group(['middleware' => ['auth', 'acl'], 'prefix' => '{user_id}'], function () {

    Route::get('/', 'UserController@profile')->name('user.profile');

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', 'OrderController@orders')->name('orders.list');
        Route::get('/my', 'OrderController@custom')->name('orders.custom.list');
        Route::get('/create', 'OrderController@create')->name('orders.create');
        Route::post('/create', 'OrderController@doCreate')->name('orders.do-create');
        Route::get('/{order_id}', 'OrderController@order')->name('order.show');
        Route::get('/{order_id}/update', 'OrderController@update')->name('order.update');
        Route::post('/{order_id}/update', 'OrderController@doUpdate')->name('order.do-update');
        Route::get('/{order_id}/responses/create', 'ResponseToOrderController@create')->name('response-to-order.create');
        Route::post('/{order_id}/responses/create', 'ResponseToOrderController@doCreate')->name('response-to-order.do-create');
        Route::get('/{order_id}/delete', 'OrderController@doDelete')->name('order.do-delete');

        Route::get('/{order_id}/file/{file_id}/download', 'OrderController@getFile')->name('orders.file.get');

    });


    Route::get('/responses', 'ResponseToOrderController@responses')->name('response-to-order.show');
    Route::get('/responses/{response_id}/delete', 'ResponseToOrderController@doDelete')->name('response-to-order.do-delete');

    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', 'SettingController@settings')->name('settings.show');


        Route::get('/subscribe', 'SettingController@subscribe')->name('settings.subscribe.show');
        Route::post('/subscribe', 'SettingController@doUpdateSubscribe')->name('settings.subscribe.do-update');
    });

});


//tests
Route::get('/test-react', function () {
    return view('test-react');
});

Route::get('/token', function () {
    return csrf_token();
});

Route::get('/test-socket', function () {
    return view('test-socket');
});

Route::get('/universe', function () {
    return \App\Models\EducationInstitution::all();
});

Route::get('fire', function () {
    //broadcast( new \App\Notifications\CreateOrder(Auth::user()) )->toOthers();
    Notification::send(\App\User::all()->where('id', 59), new \App\Notifications\CreateOrder(Auth::user()));
    return "event fired";


    //(Auth::user()->notify(new \App\Notifications\CreateOrder()));
    //Notification::send(\App\User::all(), new \App\Notifications\CreateOrder());

});