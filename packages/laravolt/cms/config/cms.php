<?php

return [
    'binding'        => [
        'post' => \Laravolt\Cms\Models\MultilanguagePost::class,
        'custom' => [

        ],
    ],
    'default_status' => 'DRAFT',
    'default_type'   => 'POST',
    'route' => [
        'middleware' => ['web', 'auth'],
        'prefix'     => 'cms'
    ]
];
