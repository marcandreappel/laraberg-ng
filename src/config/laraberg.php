<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    */

    'use_package_routes' => true,

    'middlewares' => ['web', 'auth'],

    'prefix' => 'laraberg',

    "models" => [
        "block"   => MarcAndreAppel\LarabergNG\Models\Block::class,
        "content" => MarcAndreAppel\LarabergNG\Models\Content::class,
    ],

];
