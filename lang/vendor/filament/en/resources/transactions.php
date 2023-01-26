<?php

return [
    'label' => [
        'singular' => 'Transfer',
        'plural' => 'Transfers',
    ],
    'table' => [
        'columns' => [
            'from' => [
                'label' => 'From'
            ],
            'amount' => [
                'label' => 'Amount'
            ],
            'source' => [
                'label' => 'Source'
            ],
            'status' => [
                'label' => 'Status'
            ],
            'created_at' => [
                'label' => 'Transfer date'
            ],
            'due_date' => [
                'label' => 'Due date'
            ],
        ],
        'actions' => [],
        'filters' => [
            'source' => [
                'label' => 'Transaction source'
            ],
            'status' => [
                'label' => 'Status'
            ]
        ]
    ],
    'form' => [
        'fields' => []
    ]
];
