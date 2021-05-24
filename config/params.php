<?php

return [
    'default_role' => 2, // User
    'default_pass' => 'secret',
    'active' =>  1,
    'in_active' =>  2,
    'status' => [
        '1' => 'Active',
        '2' => 'In-Active',
    ],
    'super_admin_role' => 'Super Admin',
    'admin_role' => 'Admin',
    'default_roles' => ['Super Admin', 'Admin'],
    'default_module' => [
        'user',
        'module',
        'role',
        'permission',
        'cms',
        'profile',
        'dashboard',
    ],

    'module_default_permissions' => ['list','create','edit','delete'],
    'module_default_permissions_with_bulk_delete' => ['list','create','edit','delete','bulkdelete'],

    'default_permissions' => [
        'user' => ['list','create','edit','delete','bulkdelete'],
        'role' => ['list','create','edit','delete'],
        'permission' => ['list','create','edit','delete'],
        'module'=> ['list','create','edit','delete'],
        'cms' => ['list','create','edit','delete','bulkdelete'],
        'profile' => ['change-password','list','edit'],
        'dashboard' => ['list']
    ],
    'admin_roles' => ['Super Admin', 'Admin'], // Keep the same name what you have in database
    'gender' => [
        'male' => 'Male',
        'female' => 'Female'
    ],
]

?>
