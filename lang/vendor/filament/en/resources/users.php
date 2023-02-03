<?php

return [
    'label' => [
        'singular' => 'User',
        'plural' => 'Users',
    ],
    'table' => [
        'columns' => [
            'name' => ['label' => 'Name']
        ],
        'actions' => [
            'ban' => [
                'label' => 'Ban this user'
            ],
            'unban' => [
                'label' => 'Unban'
            ]
        ]
    ],
    'form' => [
        'fields' => [
            'name' => ['label' => 'Name']
        ]
    ]
];
