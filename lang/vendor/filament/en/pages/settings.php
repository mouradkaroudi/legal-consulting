<?php
return [
    'title' => 'Settings',
    'fields' => [
        'general_settings' => [
            'label' => 'إعدادات عامة',
            'fields' => [
                'site_logo' => [
                    'label' => 'شعار الموقع'
                ],
                'site_name' => [
                    'label' => 'اسم الموقع'
                ]
            ]
        ],
        'digital_office' => [
            'label' => 'Offices settings',
            'fields' => [
                'direct_registration' => [
                    'label' => 'Direct Registration',
                    'helperText' => 'Register office and display it on the website without the need for site management approval.'
                ],
                'hide_unsubscribed_offices' => [
                    'label' => 'Hide Unsubscribed Offices',
                    'helperText' => 'All offices that are not subscribed or have expired subscriptions will be hidden.'
                ],
            ]
        ],
        'subscriptions' => [
            'label' => 'Subscription Settings',
            'fields' => [
                'enable_subscription' => [
                    'label' => 'Enable Subscription for Offices',
                    'helperText' => 'Offices will be requested to pay subscription fees based on the profession they practice.'
                ],
            ]
        ],
        'registration' => [
            'label' => 'Registration Settings',
            'fields' => [
                'registration_open' => [
                    'label' => 'Registration is Open',
                ],
            ]
        ],
        'payment' => [
            'label' => 'Payment Settings',
            'fields' => [
                'bank_transfer' => [
                    'label' => 'Accept Bank Transfers',
                ],
                'bank_rib' => [
                    'label' => 'Bank Account Identifier Number',
                    'helperText' => 'The bank account number where you want to receive transfers'
                ],
            ]
        ],
        'slider' => [
            'label' => 'Slider Settings',
            'fields' => [
                'homepage_slider' => [
                    'label' => 'Slider',
                    'fields' => [
                        'title' => 'Title',
                        'content' => 'Text',
                        'color' => 'Color',
                    ]
                ]
            ]
        ]
    ]
];
