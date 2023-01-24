<?php

return [
    'title' => 'الإعدادات',
    'fields' => [
        'digital_office' => [
            'label' => 'إعدادات المكاتب',
            'fields' => [
                'direct_registration' => [
                    'label' => 'تسجيل مباشر',
                    'helperText' => 'تسجيل مكتب وظهوره في الموقع دون الحاجة لموافقة ادارة الموقع.'
                ],
                'hide_unsubscribed_offices' => [
                    'label' => 'حجب المكاتب غير مشتركة',
                    'helperText' => 'سيتم حجب كل المكاتب غير مشتركة او انتهت مدة اشتراكها.'
                ],
            ]
        ],
        'subscriptions' => [
            'label' => 'إعدادت الإشتراك',
            'fields' => [
                'enable_subscription' => [
                    'label' => 'تفعيل الإشتراك للمكاتب',
                    'helperText' => 'سيتم طلب من مكتب دفع رسوم اشتراك على حسب المهنة التي يمارسها.'
                ],
            ]
        ],
        'registration' => [
            'label' => 'إعدادت التسجيل',
            'fields' => [
                'registration_open' => [
                    'label' => 'التسجيل مفتوح',
                ],
            ]
        ],
        'payment' => [
            'label' => 'إعدادت الدفع',
            'fields' => [
                'bank_transfer' => [
                    'label' => 'استقبال التحويلات البكنية',
                ],
                'bank_rib' => [
                    'label' => 'رقم معرف الحساب البنكي',
                    'helperText' => 'رقم الحساب البنكي الذي تريد استقبال الحولات فيه'
                ],
            ]
        ],
        'slider' => [
            'label' => 'إعدادت سلايدر',
            'fields' => [
                'homepage_slider' => [
                    'label' => 'سلايدر',
                    'fields' => [
                        'title' => 'العنوان',
                        'content' => 'نص',
                        'color' => 'اللون',
                    ]
                ]
            ]
        ]
    ]
];
