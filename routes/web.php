<?php

// Return the current api version
Route::get('version', function () {
    return [
        'version' => env('APP_VERSION'),
        'major' => env('APP_MAJOR'),
        'minor' => env('APP_MINOR'),
        'patch' => env('APP_PATCH')
    ];
});

// Group routes by major version
Route::prefix('v'.env('APP_MAJOR'))->group(function() {
    // User Auth Route
    Route::match(['get', 'post'], 'auth', 'AuthController@authenticate');
    Route::match(['get', 'post'], 'contacts', 'ContactsController@retrieve')->middleware('token');
});
