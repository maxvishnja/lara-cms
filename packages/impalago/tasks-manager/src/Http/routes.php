<?php

/*
|--------------------------------------------------------------------------
| Package Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web', 'sentry.auth'], 'namespace' => 'Impalago\TasksManager\Http\Controllers'], function () {
    Route::resource('tasks', 'TasksController');
    Route::get('tasks-data', ['before' => 'csrf', 'as' => 'tasks.data', 'uses' => 'TasksController@getData']);

    Route::post('tasks-store-files/{id}', ['as' => 'tasks.store-files', 'uses' => 'TasksController@storeFiles']);

    Route::get('tasks-download-file/{filename}', ['as' => 'tasks.download-file', 'uses' => 'TaskFileController@downloadFile'])->where('filename', '[A-Za-z0-9\-\_\.]+');

});
