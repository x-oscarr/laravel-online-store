<?php

return [
    'template' => env('APP_TEMPLATE'),

    'configuration' => [
        'amado' => [
            //Seeder
            'seeder' => [
                'path' => base_path('database/seeders/Template'),
                'namespace' => 'Database\Seeders\Template',
            ],
            //Storage
            'storage' => [
                'path' => base_path('templates/amado/storage'),
                'class' => [
                    'App\\Models\\Category' => [
                        'category_image' => 1
                    ],
                    'App\\Models\\Product' => [
                        'product_image' => [1, 4]
                    ],
                ]
            ]
        ]
    ],

];
