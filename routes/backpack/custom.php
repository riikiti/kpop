<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('admin', 'AdminCrudController');
    Route::crud('album', 'AlbumCrudController');
    Route::crud('album-user', 'AlbumUserCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('group', 'GroupCrudController');
    Route::crud('logs', 'LogsCrudController');
    Route::crud('comments', 'CommentCrudController');
}); // this should be the absolute last line of this file
