<?php 

return [
    'label' => [
        'singular' => 'مهنة',
        'plural' => 'المهن',
    ],
    'table' => [
        'columns' => [
            'name' => [
                'label' => 'المهنة'
            ]
        ]
    ],
    'form' => [
        'fields' => [
            'service_id' => [
                'label' => 'اختر الخدمة'
            ],
            'name' => [
                'label' => 'الإسم'
            ],
            'slug' => [
                'label' => 'الإسم اللطيف'
            ],
            'is_available' => [
                'label' => 'متوفر ؟'
            ],
            'fee_percentage' => [
                'label' => 'نسبة الرسوم'
            ],
        ]
    ]
];