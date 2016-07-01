<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['sentry.auth']], function () {
    Route::get('/', array ('as' => 'home', function () {
        return View::make('modules/main.index');
    }));

    Route::get('customers', ['as' => 'customers.index', 'uses' => 'CustomersController@index']);
    Route::get('customers/create', ['as' => 'customers.create', 'uses' => 'CustomersController@create']);
    Route::post('customers', ['as' => 'customers.store', 'uses' => 'CustomersController@store']);
    Route::get('customers/{id}', ['as' => 'customers.show', 'uses' => 'CustomersController@show']);
    Route::get('customers/{id}/edit', ['as' => 'customers.edit', 'uses' => 'CustomersController@edit']);
    Route::put('customers/{id}', ['as' => 'customers.update', 'uses' => 'CustomersController@update']);
    Route::delete('customers/{id}', ['as' => 'customers.destroy', 'uses' => 'CustomersController@destroy']);
});

