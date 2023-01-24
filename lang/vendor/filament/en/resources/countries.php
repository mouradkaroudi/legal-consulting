<?php 

return [
    'label' => [
        'singular' => 'Country',
        'plural' => 'Countries',
    ],
    'table' => [
        'columns' => [
            'name' => [
                'label' => 'Country'
            ]
        ]
    ],
    'form' => [
        'fields' => [
            'name' => [
                'label' => 'Name'
            ],
            'citizenship' => [
                'label' => 'Citizenship'
            ],
            'country_code' => [
                'label' => 'Country ISO code'
            ],
        ]
    ]
];