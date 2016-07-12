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

    // Companies
    Route::resource('companies', 'CompaniesController');
    Route::get('companies-data', ['before' => 'csrf', 'as' => 'companies.data', 'uses' => 'CompaniesController@getData']);
    Route::get('company-history/{id}', ['before' => 'csrf', 'as' => 'company.history', 'uses' => 'CompaniesController@getCompanyHistory']);

    // Users - get history fot datatables
    Route::get('user-history/{id}', ['before' => 'csrf', 'as' => 'user.history', 'uses' => 'UsersController@getUserHistory']);
});

