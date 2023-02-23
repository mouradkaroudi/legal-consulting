<?php
return [
    'title' => 'Settings',
    'fields' => [
        'general_settings' => [
            'label' => 'General settings',
            'fields' => [
                'site_logo' => [
                    'label' => 'Logo'
                ],
                'site_name' => [
                    'label' => 'Site name'
                ],
                'company_address' => [
                    'label' => 'Company address'
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
                'tax' => [
                    'label' => 'Tax rate',
                ],
            ]
        ],
        'homepage' => [
            'label' => 'Homepage',
            'fields' => [
                'text_color' => [
                    'label' => 'Text color'
                ],
                'bg_color' => [
                    'label' => 'Background color'
                ]
            ]
        ],
        'whatsapp' => [
            'label' => 'Whatsapp number',
            'fields' => [
                'number' => [
                    'label' => 'Number'
                ]
            ]
        ],
        'links' => [
            'label' => 'Links',
            'fields' => [
                'privacy_page' => [
                    'label' => 'Privacy page'
                ]
            ]
        ],
        'social' => [
            'label' => 'Social networks',
            'fields' => [
                'social_links' => [
                    'label' => 'Platforms links',
                    'fields' => [
                        'link' => [
                            'label' => 'Link'
                        ],
                        'platform' => [
                            'label' => 'Platform'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
