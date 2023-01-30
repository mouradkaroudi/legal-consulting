<?php

return [
    'label' => [
        'singular' => 'Post',
        'plural' => 'Posts',
    ],
    'table' => [
        'columns' => [
            'title' => ['label' => 'Title'],
            'post_type' => ['label' => 'Post type'],
            'updated_at' => ['label' => 'Updated at'],
        ]
    ],
    'form' => [
        'fields' => [
            'title' => ['label' => 'Title'],
            'content' => ['label' => 'Content'],
            'seo' => ['label' => 'SEO settings'],
            'slug' => ['label' => 'Slug'],
            'post_type' => ['label' => 'Post type'],
            'meta' => [
                'fields' => [
                    'bg_image' => [
                        'label' => 'Background image'
                    ],
                    'bg_color' => [
                        'label' => 'Background color'
                    ],
                    'text_color' => [
                        'label' => 'Text color'
                    ],
                ]
            ]
        ]
    ]
];
