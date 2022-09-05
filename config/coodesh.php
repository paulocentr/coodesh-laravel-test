<?php

return [
    'min_convertion_amount' => env('MIN_CONVERTION_AMOUNT', 1000),
    'max_convertion_amount' => env('MAX_CONVERTION_AMOUNT', 10000),
    'payment_methods' => [
        'boleto' => [
            'name' => env('BILLET_TITLE', 'Boleto Bancário'),
            'tax' => env('BILLET_TAX', 1.45)
        ],
        'credit_card' => [
            'name' => env('CC_TITLE', 'Cartão de Crédito'),
            'tax' => env('CC_TAX', 7.63)
        ],
    ],
    'extra_convertion_fees' => [
        'gt' => [
            'value' => env('GT_CONVERSION_FEE', 3000),
            'tax' => 1
        ],

        'lt' => [
            'value' => env('LT_CONVERSION_FEE', 3000),
            'tax' => 2
        ]
    ]
];