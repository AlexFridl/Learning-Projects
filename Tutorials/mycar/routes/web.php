<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    
    Route::resource('vehicles', 'VehicleController');

    Route::get('/vehicles/{vehicle}/parts/fetch', 'PartController@fetch')->name('parts.fetch');
    Route::resource('vehicles.parts', 'PartController');

    Route::get('/vehicles/{vehicle}/reminders/fetch', 'ReminderController@fetch')->name('reminders.fetch');
    Route::resource('vehicles.reminders', 'ReminderController');

    Route::get('/profile', 'ProfileController@edit');
    Route::post('/profile', 'ProfileController@update');

    Route::get('/notifications', 'NotificationsController@index');
    Route::get('/notifications/fetch', 'NotificationsController@fetch');
    Route::get('/notifications/fetchUnread', 'NotificationsController@fetchUnread');
    Route::get('/notifications/checkUnread', 'NotificationsController@checkUnread');

    Route::get('/nearby', 'MapsController@index');

    Route::get('/admin', 'AdminController@index')->middleware('admin');

});
