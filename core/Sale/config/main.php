<?php

return [

    /*
    |--------------------------------------------------------------------------
    | currency
    |--------------------------------------------------------------------------
    |
    | Default currency
    |
    */

    'currency' => [
        'code'   => 'USD',
        'symbol' => '$'
    ],

    /*
    |--------------------------------------------------------------------------
    | Items
    |--------------------------------------------------------------------------
    |
    | Available catalog products
    |
    */

    'items' => [
        'uom' => 'kg',
        'types' => [
            'T-shirt' => [
                'price'        => 30.99,
                'shipped_from' => 'US',
                'weight'       => 0.2,
            ],
            'Blouse' => [
                'price'        => 10.99,
                'shipped_from' => 'UK',
                'weight'       => 0.3,
            ],
            'Pants' => [
                'price'        => 64.99,
                'shipped_from' => 'UK',
                'weight'       => 0.9,
            ],
            'Sweatpants' => [
                'price'        => 84.99,
                'shipped_from' => 'CN',
                'weight'       => 1.1,
            ],
            'Jacket' => [
                'price'        => 199.99,
                'shipped_from' => 'US',
                'weight'       => 2.2,
            ],
            'Shoes' => [
                'price'        => 79.99,
                'shipped_from' => 'CN',
                'weight'       => 1.3,
            ]
        ]
    ],

];
