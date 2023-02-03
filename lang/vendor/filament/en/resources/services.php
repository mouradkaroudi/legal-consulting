<?php 

return [
    'label' => [
        'singular' => 'Service',
        'plural' => 'Services',
    ],
    'table' => [
        'columns' => [
            'name' => [
                'label' => 'Service'
            ]
        ]
    ],
    'form' => [
        'fields' => [
            'name' => [
                'label' => 'Name'
            ],
            'slug' => [
                'label' => 'Slug'
            ],
            'is_available' => [
                'label' => 'Is available ?'
            ],
        ]
    ]
];