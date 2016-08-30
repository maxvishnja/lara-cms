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

    // File Task
    Route::post('tasks-store-files/{id}', ['as' => 'tasks.store-files', 'uses' => 'FileTaskController@storeFiles']);
    Route::get('tasks-download-file/{filename}', ['as' => 'tasks.download-file', 'uses' => 'FileTaskController@downloadFile']);
    Route::post('tasks-destroy-drop-file/{fileId?}', ['as' => 'tasks.destroy-drop-file', 'uses' => 'FileTaskController@destroyFile']);

    //Task Time
    Route::post('tasks-work-start/{id}', ['as' => 'tasks.work-start', 'uses' => 'TaskTimeController@start']);
    Route::post('tasks-work-pause/{id}', ['as' => 'tasks.work-pause', 'uses' => 'TaskTimeController@pause']);
    Route::post('tasks-work-end/{id}', ['as' => 'tasks.work-end', 'uses' => 'TaskTimeController@end']);
    Route::get('tasks-check-status/{id}', ['as' => 'tasks.check-status', 'uses' => 'TaskTimeController@checkStatus']);

});

