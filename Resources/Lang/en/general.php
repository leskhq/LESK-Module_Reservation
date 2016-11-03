<?php

return [

    'audit-log'           => [
        'category'              => 'Reservation',
        'msg-index'             => 'Accessed index Reservation.',
        'msg-show'              => 'Accessed details of item: :name.',
        'msg-store'             => 'Created new item: :name.',
        'msg-edit'              => 'Initiated edit of item: :name.',
        'msg-update'            => 'Submitted edit of item: :name.',
        'msg-signed-in'         => 'Successfully signed-in item: :name.',
        'msg-signed-out'        => 'Successfully signed-out item: :name.',
        'msg-destroyed'         => 'Deleted item: :name.',
    ],

    'page'              => [
        'index'              => [
            'title'                     => 'Reservation | index',
            'description'               => 'Landing page of the Reservation module.',
            'box-title'                 => 'List of items.',
            'welcome'                   => 'Welcome to the Reservation module.',
            ],
        'show'               => [
            'title'                     => 'Items | Show',
            'description'               => 'Displaying item: :name.',
            'box-title'                 => 'Item details and sign-out history',
        ],
        'sign-out'               => [
            'title'                     => 'Items | Sign-out',
            'description'               => 'Displaying item: :name.',
            'box-title'                 => 'Item details and sign-out form',
            'from_date'                 => 'From (YYYY/MM/DD)',
            'to_date'                   => 'To (YYYY/MM/DD)',
        ],
        'edit'               => [
            'title'                     => 'Items | Edit',
            'description'               => 'Editing item: :name.',
            'box-title'                 => 'Item details',
        ],
        'create'             => [
            'title'                     => 'Item | Create',
            'description'               => 'Creating a new item.',
            'box-title'                 => 'Item details',
        ],

    ],

    'columns'       => [
        'available'         => 'Available',
        'name'              => 'Name',
        'description'       => 'Description',
        'user_name'         => 'User',
        'return_date'       => 'Return date',
        'reason'            => 'Reason',
        'from_date'         => 'Sign-out date',
        'to_date'           => 'Expected return date',
        'actions'           => 'Actions',
    ],

    'button'   => [
        'sign-in'           => 'Sign in',
        'sign-out'          => 'Sign out',
        'item'      => [
            'create'            => 'Create new item'
        ],
    ],

    'status'    => [
        'available'          => 'Available',
        'unavailable'        => 'Unavailable',
        'signed-in_failed'   => 'Failed to sign-in item: :name.',
        'signed-out_failed'  => 'Failed to sign-out item: :name.',
        'delete_failed'      => 'Failed to delete item: :name.',
    ],

    'sign-in-confirm'              => [
        'title'   => 'Sign-in item',
        'body'    => 'Are you sure that you want to sign-in item with the name ":name"?',
    ],

    'delete-confirm'              => [
        'title'   => 'Delete item',
        'body'    => 'Are you sure that you want to delete item with the name ":name"? This operation is irreversible.',
    ],

    'exceptions'    => [
        'item-not-signed-out'   =>  'Item: ":name", not signed-out.',
        'item-not-signed-in'    =>  'Item: ":name", not signed-in.',
    ],
];
