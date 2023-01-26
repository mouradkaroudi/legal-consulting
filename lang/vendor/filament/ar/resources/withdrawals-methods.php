<?php 

return [
    'label' => [
        'singular' => 'طريقة سحب',
        'plural' => 'طرق السحب',
    ],
    'table' => [
        'columns' => [
            'name' => [
                'label' => 'الإسم'
            ],

            'minimum_amount' => [
                'label' => 'الحد الأدنى'
            ],
            'maximum_amount' => [
                'label' => 'الحد الأقصى'
            ],
            'fees' => [
                'label' => 'الرسوم'
            ],
        ]
    ],
    'form' => [
        'fields' => [
            'name' => [
                'label' => 'اسم الطريقة'
            ],
            'description' => [
                'label' => 'وصف'
            ],
            'minimum_amount' => [
                'label' => 'الحد الأدنى للتحويل'
            ],
            'maximum_amount' => [
                'label' => 'الحد الأقصى للتحويل'
            ],
            'countries' => [
                'label' => 'البلدان التي تتوفر فيها هذه الطريقة',
                'helperText' => 'إذا لم يتم تحديد اي البلد ، فستكون متاحًا لجميع البلدان'
            ],
            'min_fee' => [
                'label' => 'الحد الأدنى للرسوم'
            ],
            'max_fee' => [
                'label' => 'الحد الأقصى للرسوم'
            ],
            'percentage_fee' => [
                'label' => 'رسوم النسبة المئوية'
            ],
            'information_required' => [
                'label' => 'المعلومات المطلوبة',
                'fields' => [
                    'field_label' => [
                        'label' => 'اسم الحقل',
                        'helperText' => 'مثل البريد الإلكتروني'
                    ]
                ]
            ],
        ]
    ]
];