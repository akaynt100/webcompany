<?php

return [
    'create_response' => [
        'id' => 1,
        'description' => 'Новый отклик на ваш заказ',
        'is_empty' => true,
    ],
    'create_order_with_type' => [
        'id' => 2,
        'description' => 'Новый заказ',
        'is_empty' => false,
        'key' => 'single_value',
    ],
    'create_order_with_city' => [
        'id' => 3,
        'description' => 'Новый заказ',
        'is_empty' => false,
        'key' => 'single_value',
    ],
    'create_order_with_institution' => [
        'id' => 4,
        'description' => 'Новый заказ',
        'is_empty' => false,
        'key' => 'single_value',
    ],
    'create_order' => [
        'id' => 5,
        'description' => 'Новый заказ',
        'is_empty' => true,
    ],
    'took_response' => [
        'id' => 6,
        'description' => 'Ваш отклик принят',
        'is_empty' => true,
    ],
    'reject_response' => [
        'id' => 7,
        'description' => 'Ваш отклик отклонен',
        'is_empty' => true,
    ],
];