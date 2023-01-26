<?php

return [
    'label' => [
        'singular' => 'تحويل',
        'plural' => 'التحويلات',
    ],
    'table' => [
        'columns' => [
            'from' => [
                'label' => 'من طرف'
            ],
            'amount' => [
                'label' => 'المبلغ'
            ],
            'source' => [
                'label' => 'المصدر'
            ],
            'status' => [
                'label' => 'الحالة'
            ],
            'created_at' => [
                'label' => 'تاريخ التحويل'
            ],
            'due_date' => [
                'label' => 'تاريخ الإستحقاق'
            ],

        ],
        'actions' => [
        ],
        'filters' => [
            'source' => [
                'label' => 'مصدر المعاملة'
            ],
            'status' => [
                'label' => 'الحالة'
            ]
        ]
    ],
    'form' => [
        'fields' => []
    ]
];
