<?php

return [
    'title' => 'الإعدادات',
    'fields' => [
        'general_settings' => [
            'label' => 'إعدادات عامة',
            'fields' => [
                'site_logo' => [
                    'label' => 'شعار الموقع'
                ],
                'site_name' => [
                    'label' => 'اسم الموقع'
                ],
                'company_address' => [
                    'label' => 'عنوان الشركة'
                ]
            ]
        ],
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
                    'label' => 'استقبال التحويلات البنكية',
                ],
                'bank_rib' => [
                    'label' => 'رقم معرف الحساب البنكي',
                    'helperText' => 'رقم الحساب البنكي الذي تريد استقبال الحولات فيه'
                ],
                'tax' => [
                    'label' => 'نسبة الضريبة',
                ],
            ]
        ],
        'homepage' => [
            'label' => 'الرئيسية',
            'fields' => [
                'wstextcolor' => [
                    'label' => 'لون نص واتساب'
                ],
                'wsbgcolor' => [
                    'label' => 'لون خلفية واتساب'
                ],
                'text_color' => [
                    'label' => 'لون النص'
                ],
                'bg_color' => [
                    'label' => 'لون الخلفية'
                ]
            ]
        ],
        'whatsapp' => [
            'label' => 'رقم الواتساب',
            'fields' => [
                'number' => [
                    'label' => 'الرقم'
                ]
            ]
        ],
        'links' => [
            'label' => 'الروابط',
            'fields' => [
                'privacy_page' => [
                    'label' => 'صفحة الخصوصية'
                ]
            ]
        ],
        'page' => [
            'label' => 'الصفحات',
            'fields' => [
                'textcolor' => [
                    'label' => 'لون نص '
                ],
                'bgcolor' => [
                    'label' => 'لون خلفية '
                ],
            ]
        ],
        'social' => [
            'label' => 'مواقع التواصل اجتماعي',
            'fields' => [
                'social_links' => [
                    'label' => 'روابط المنصات',
                    'fields' => [
                        'link' => [
                            'label' => 'رابط'
                        ],
                        'platform' => [
                            'label' => 'المنصة'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
