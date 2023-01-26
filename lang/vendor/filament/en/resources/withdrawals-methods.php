<?php

return [
    'label' => [
        'singular' => 'Withdrawals method',
        'plural' => 'Withdrawal method',
    ],
    'table' => [
        'columns' => [
            'name' => [
                'label' => 'Name'
            ],

            'minimum_amount' => [
                'label' => 'Minimum amount'
            ],
            'maximum_amount' => [
                'label' => 'Maximum amount'
            ],
            'fees' => [
                'label' => 'Fees'
            ],
        ]
    ],
    'form' => [
        'fields' => [
            'name' => [
                'label' => 'Method name'
            ],
            'description' => [
                'label' => 'Description'
            ],
            'minimum_amount' => [
                'label' => 'Minimum transfer amount'
            ],
            'maximum_amount' => [
                'label' => 'Maximum transfer amount'
            ],
            'countries' => [
                'label' => 'Countries this method is available in',
                'helperText' => 'If no countries are selected, it will be available for all countries'
            ],
            'min_fee' => [
                'label' => 'Minimum fees'
            ],
            'max_fee' => [
                'label' => 'Maximum fees'
            ],
            'percentage_fee' => [
                'label' => 'Percentage fee'
            ],
            'information_required' => [
                'label' => 'Required information',
                'fields' => [
                    'field_label' => [
                        'label' => 'Field label',
                        'helperText' => 'Example: Email'
                    ]
                ]
            ],
        ]
    ]
];
