<?php 

return [
    'label' => [
        'singular' => 'Profession',
        'plural' => 'Professions',
    ],
    'table' => [
        'columns' => [
            'name' => [
                'label' => 'Profession'
            ]
        ]
    ],
    'form' => [
        'fields' => [
            'service_id' => [
                'label' => 'Choose service'
            ],
            'name' => [
                'label' => 'Name'
            ],
            'slug' => [
                'label' => 'Slug'
            ],
            'is_available' => [
                'label' => 'Is available'
            ],
            'fee_percentage' => [
                'label' => 'Fee percentage'
            ],
        ]
    ]
];