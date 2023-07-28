<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use Wave\Facades\Wave;

// Authentication routes
Auth::routes();

// Voyager Admin routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Wave routes
Wave::routes();

// re:App routes
Route::group(['as' => 'reapp.', 'middleware' => 'auth'], function() {
    Route::get('library', '\App\Http\Controllers\LibraryController@index')->name('library');
    Route::get('calendar', '\App\Http\Controllers\CalendarController@index')->name('calendar');
    Route::get('support', '\Wave\Http\Controllers\DashboardController@index')->name('support');
});
