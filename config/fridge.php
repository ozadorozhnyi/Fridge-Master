<?php

return [
    'seed' => [
        'locations' => [
            [
                'name' => 'Portland (Oregon)',
                'timezone' => 'America/New_York'
            ],[
                'name' => 'Toronto',
                'timezone' => 'America/Toronto'
            ],[
                'name' => 'Warsaw',
                'timezone' => 'Europe/Warsaw'
            ],[
                'name' => 'Valencia',
                'timezone' => 'Europe/Madrid'
            ],[
                'name' => 'Shanghai',
                'timezone' => 'Asia/Shanghai'
            ],
        ],
        'building' => [
            'range' => [
                'min' => 1,
                'max' => 5,
            ],
            'temperature' => [
                'min' => -5,
                'max' => 5,
            ],
        ],
        'blocks' => [
            'range' => [
                'min' => 10,
                'max' => 100,
            ],
            'price' => [
                'min' => 3,
                'max' => 99,
            ],
        ],
        'contracts' => 5,
    ],
];
