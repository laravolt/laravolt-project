<?php
/*
 * Set specific configuration variables here
 */
return [
    // Whether to auto load migrations or not.
    // If set to false, then you must publish the migration files first before running the migrate command
    'migrations' => true,
    'models'                => [
        'role'       => \Laravolt\Acl\Models\Role::class,
        'permission' => \Laravolt\Acl\Models\Permission::class
    ],
];
