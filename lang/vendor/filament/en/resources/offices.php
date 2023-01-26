<?php

return [
    'label' => [
        'singular' => 'Office',
        'plural' => 'Offices',
    ],
    'table' => [
        'columns' => [
            'name' => [
                'label' => 'Name'
            ],
            'ownerName' => [
                'label' => 'Owner Name'
            ],
            'subscriptionPlan' => [
                'label' => 'Subscription Plan'
            ],
            'countryName' => [
                'label' => 'Country'
            ],
            'status' => [
                'label' => 'Status'
            ],
            'is_hidden' => [
                'label' => 'Hidden'
            ]
        ],
        'actions' => [
            'viewProfile' => [
                'label' => 'View Profile'
            ],
            'ban' => [
                'label' => 'Ban this office'
            ],
            'unban' => [
                'label' => 'Unban'
            ]
        ]
    ],
    'form' => [
        'fields' => []
    ]
];
