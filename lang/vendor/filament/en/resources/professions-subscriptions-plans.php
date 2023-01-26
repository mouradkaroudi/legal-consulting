<?php

return [
    'label' => [
        'singular' => 'Subscription Plan',
        'plural' => 'Subscription Plans',
    ],
    'table' => [
        'columns' => [
            'professionName' => [
                'label' => 'Profession'
            ],
            'fee' => [
                'label' => 'Subscription fee'
            ],
            'type' => [
                'label' => 'Subscription type'
            ]
        ]
    ],
    'form' => [
        'fields' => [
            'name' => [
                'label' => 'Name'
            ],
            'description' => [
                'label' => 'Description'
            ],
            'profession_id' => [
                'label' => 'Profession'
            ],
            'fee' => [
                'label' => 'Fee'
            ],
            'type' => [
                'label' => 'Type'
            ]
        ]
    ]
];
