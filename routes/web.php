<?php

Route::get('/', function() {
    return '';
});

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

    // User Contacts Route - Requires valid JWT
    Route::match(['get', 'post'], 'contacts', 'ContactsController@retrieve')->middleware('token');

    // Find users to be friends with - Requires valid JWT
    // Requires keywords paramter to be passed
    Route::match(['get', 'post'], 'search', 'ContactsController@search')->middleware('token');

    // Send a request to another contact
    Route::match(['get', 'post'], 'request', 'ContactRequestController@send')->middleware('token');

    // Accept a pal request
    Route::match(['get', 'post'], 'request/accept', 'ContactRequestController@accept')->middleware('token');
});
