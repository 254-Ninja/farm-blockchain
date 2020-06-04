<?php

return [
    'role_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d,v',
            'products' => 'r,v',
            'product_categories' => 'c,r,u,d',
            'certificates' => 'c,r,u,d',
            'sales' => 'r,u',
            'blacklist_files'=>'c,r,u,d'
        ],
        'government' => [
            'users' => 'c,r,u,d,v',
            'products' => 'r,v',
            'product_categories' => 'c,r,u,d',
            'certificates' => 'c,r,u,d',
            'sales' => 'r,u',
            'blacklist_files'=>'c,r,u,d'
        ],
        'farmer' => [
            'users' => 'c,r,u',
            'products' => 'c,r,u,d',
            'certificates' => 'r',
            'blacklist_files'=>'r'
        ],
        'processingcompany' => [
            'users' => 'c,r,u',
            'products' => 'c,r,u,d',
            'certificates' => 'r',
            'blacklist_files'=>'r'
        ],
        'customer' => [
            'users' => 'c,r,u',
            'products' => 'r',
            'certificates' => 'r',
            'blacklist_files'=>'r'
        ],
    ],
    'permission_structure' => [
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'v' => 'verify',
    ]
];
