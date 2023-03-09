<?php

return [
    'label' => [
        'singular' => 'مكتب',
        'plural' => 'المكاتب',
    ],
    'table' => [
        'columns' => [
            'name' => [
                'label' => 'الإسم'
            ],
            'ownerName' => [
                'label' => 'اسم المالك'
            ],
            'subscriptionPlan' => [
                'label' => 'نوع الإشتراك'
            ],
            'countryName' => [
                'label' => 'الدولة'
            ],
            'status' => [
                'label' => 'الحالة'
            ],
            'is_hidden' => [
                'label' => 'مخفي'
            ]
        ],
        'actions' => [
            'displayInfo' => [
                'label' => 'معلومات الظاهرة'
            ],
            'viewProfile' => [
                'label' => 'عرض البروفايل'
            ],
            'ban' => [
                'label' => 'حظر هذا المكتب'
            ],
            'unban' => [
                'label' => 'رفع الحظر'
            ]
        ]
    ],
    'form' => [
        'fields' => []
    ]
];
