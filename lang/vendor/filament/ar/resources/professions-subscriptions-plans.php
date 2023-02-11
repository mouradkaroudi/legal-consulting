<?php 

return [
    'label' => [
        'singular' => 'خطة الاشتراك',
        'plural' => 'خطط الإشتراك',
    ],
    'table' => [
        'columns' => [
            'professionName' => [
                'label' => 'المهنة'
            ],
            'fee' => [
                'label' => 'رسوم الإشتراك'
            ],
            'type' => [
                'label' => 'نوع الإشتراك'
            ]
        ]
    ],
    'form' => [
        'fields' => [
            'name' => [
                'label' => 'الإسم'
            ],
            'description' => [
                'label' => 'وصف'
            ],
            'profession_id' => [
                'label' => 'المهنة'
            ],
            'amount' => [
                'label' => 'الرسوم'
            ],
            'type' => [
                'label' => 'نوع الإشتراك'
            ]
        ]
    ]
];