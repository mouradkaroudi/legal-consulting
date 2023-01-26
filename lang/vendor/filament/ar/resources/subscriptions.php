<?php 

return [
    'label' => [
        'singular' => 'اشتراك',
        'plural' => 'الاشتراكات',
    ],
    'table' => [
        'columns' => [
            'started_at' => [
                'label' => 'مشترك في'
            ],
            'expire_at' => [
                'label' => 'تنتهي صلاحية الاشتراك في'
            ],
            'subscriberName' => [
                'label' => 'اسم المكتب'
            ],
            'professionName' => [
                'label' => 'المهنة'
            ],
        ]
    ],
    'form' => [
        'fields' => [
            'started_at' => [
                'label' => 'مشترك في'
            ],
            'expire_at' => [
                'label' => 'تنتهي صلاحية الاشتراك في'
            ]
        ]
    ]
];