<?php

return [
    'label' => [
        'singular' => 'Subscription',
        'plural' => 'Subscriptions',
    ],
    'table' => [
        'columns' => [
            'started_at' => [
                'label' => 'Subscribed on'
            ],
            'expire_at' => [
                'label' => 'Subscription expires on'
            ],
            'subscriberName' => [
                'label' => 'Office name'
            ],
            'professionName' => [
                'label' => 'Profession'
            ],
        ]
    ],
    'form' => [
        'fields' => [
            'started_at' => [
                'label' => 'Subscribed on'
            ],
            'expire_at' => [
                'label' => 'Subscription expires on'
            ]
        ]
    ]
];
