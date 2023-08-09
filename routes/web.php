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
Route::group([
    'as' => 'reapp.',
    'middleware' => ['auth', 'localized'],
], function() {
    Route::get('dashboard', '\App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('library', '\App\Http\Controllers\LibraryController@index')->name('library');
    Route::get('calendar/{month?}/{year?}', '\App\Http\Controllers\CalendarController@index')->name('calendar');

    Route::get('profile', function (Request $request) {
        // current profile
        $user = auth()->user();

        // redirect to /@username
        return redirect()->route('wave.profile', [
            'username' => $user->username,
        ]);
    })->name('profile');
});

// re:App guest-available routes
Route::group([
    'as' => 'reapp.',
    'middleware' => [/*noauth*/'localized'],
], function() {
    Route::get('support', '\App\Http\Controllers\SupportController@index')->name('support');
});
