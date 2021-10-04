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

    /*
    |--------------------------------------------------------------------------
    | Shipping rates
    |--------------------------------------------------------------------------
    |
    | Each country has a shipping rate per 100 grams by default
    |
    */

    'shipping_rates' => [
        'amount' => 100,
        'uom'    => 'g',
        'countries' => [
            'US' => 2,
            'UK' => 3,
            'CN' => 2
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Offers
    |--------------------------------------------------------------------------
    |
    | Some special offers, which affect the pricing.
    |
    */

    'offers' => [
        [
            'name'      => '10% off shoes',
            'condition' => [
                'type'    => 'item_in',
                'items'   => ['Shoes'],
                'min_qty' => 1
            ],
            'discount' => [
                'apply' => 'subtotal',
                'type'  => 'percentage',
                'value' => 10
            ]
        ],
        [
            'name'      => '50% off jacket',
            'condition' => [
                'type'    => 'item_in',
                'items'   => ['T-shirt', 'Blouse'],
                'min_qty' => 2
            ],
            'discount' => [
                'apply' => 'items',
                'type'  => 'percentage',
                'value' => 50,
                'items' => ['Jacket']
            ]
        ],
        [
            'name'      => '$10 of shipping',
            'condition' => [
                'type'    => 'item_in',
                'items'   => ['*'],
                'min_qty' => 2
            ],
            'discount' => [
                'apply'         => 'shipping',
                'type'          => 'fixed',
                'value'         => 10,
                'capped_amount' => 10
            ]
        ]
    ],

];
