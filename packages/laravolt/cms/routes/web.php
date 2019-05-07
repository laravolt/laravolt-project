<?php

Route::group(
    [
        'namespace'  => '\Laravolt\Cms\Http\Controllers',
        'prefix'     => config('laravolt.cms.route.prefix'),
        'as'         => 'cms::',
        'middleware' => config('laravolt.cms.route.middleware'),
    ],
    function () {
        Route::resource('media', 'MediaController', ['only' => ['store']]);
        //Route::resource('slim-media', 'SlimMediaController', ['only' => ['store']]);
    }
);
