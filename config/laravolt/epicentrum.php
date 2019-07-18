<?php

/*
 * Set specific configuration variables here
 */
return [
    'route'                 => [
        'enable'     => true,
        'middleware' => ['web', 'auth'],
        'prefix'     => 'epicentrum',
    ],
    'view'                  => [
        'layout' => 'ui::layouts.app',
    ],
    'menu'                  => [
        'enable' => true,
    ],
    'role'                  => [
        'multiple' => false,
        'editable' => false,
    ],
    'repository'            => [
        'user'       => \Laravolt\Epicentrum\Repositories\EloquentRepository::class,
        'role'       => \Laravolt\Epicentrum\Repositories\RoleRepository::class,
        'timezone'   => \Laravolt\Epicentrum\Repositories\DefaultTimezoneRepository::class,
        'searchable' => ['name', 'email', 'status'],
    ],
    'requests'              => [
        'account' => [
            'store'  => \Laravolt\Epicentrum\Http\Requests\Account\Store::class,
            'update' => \Laravolt\Epicentrum\Http\Requests\Account\Update::class,
            'delete' => \Laravolt\Epicentrum\Http\Requests\Account\Delete::class,
        ],
    ],
    'user_available_status' => [
        'PENDING' => 'PENDING',
        'ACTIVE'  => 'ACTIVE',
    ],
    'models'                => [
        'role' => \Laravolt\Acl\Models\Role::class,
    ],

    // Whether to auto load migrations or not.
    // If set to false, then you must publish the migration files first before running the migrate command
    'migrations' => true
];
