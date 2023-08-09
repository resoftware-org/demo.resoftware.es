<?php

use Illuminate\Http\Request;

// re:App API routes
Route::group([
    'as' => 'reapp.api.',
    'prefix' => 'api/v1',
], function() {

    // Wave API routes
    // POST Auth API (Sanctum)
    // Resources API (BREAD)
    Route::group([
        'as' => 'wave.',
        'prefix' => 'wave',
    ], function() {
        Wave::api();
    });

    // GET USER
    Route::get('/user', function (Request $request) {
        return auth()->user();
    })->name('users.me');

    // SEARCH COURSES
    Route::get('/courses', '\App\Http\Controllers\API\CoursesController@search')->name('courses.search');

    // CHARTS API
    Route::get('/charts/audience', '\App\Http\Controllers\API\ChartsController@audience')->name('charts.audience');

});
