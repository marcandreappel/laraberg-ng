<?php

if (config('laraberg.use_package_routes')) {
    Route::group(['prefix' => config('laraberg.prefix'), 'middleware' => config('laraberg.middlewares')], function () {
        Route::apiResource('blocks', 'MarcAndreAppel\LarabergNG\Http\Controllers\BlockController');
        Route::get('oembed', 'MarcAndreAppel\LarabergNG\Http\Controllers\OEmbedController');
    });
};
