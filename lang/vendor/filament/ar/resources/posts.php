<?php

return [
    'label' => [
        'singular' => 'محتوى',
        'plural' => 'المحتويات',
    ],
    'table' => [
        'columns' => [
            'title' => ['label' => 'العنوان'],
            'post_type' => ['label' => 'نوع المحتوى'],
            'updated_at' => ['label' => 'آخر تحديث'],
        ]
    ],
    'form' => [
        'fields' => [
            'title' => ['label' => 'العنوان'],
            'content' => ['label' => 'المحتوى'],
            'seo' => ['label' => 'إعدادات SEO'],
            'slug' => ['label' => 'اسم اللطيف'],
            'post_type' => ['label' => 'نوع المحتوى'],
            'meta' => [
                'fields' => [
                    'bg_image' => [
                        'label' => 'صورة الخلفية'
                    ],
                    'bg_color' => [
                        'label' => 'لون الخلفية'
                    ],
                    'text_color' => [
                        'label' => 'لون النص'
                    ],
                ]
            ]
        ]
    ]
];
