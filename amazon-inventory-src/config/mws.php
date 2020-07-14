<?php

return [

    'US' => [
        'access_id' => env('US_MWS_ACCESS_KEY'),
        'secret_key' => env('US_MWS_SECRET_KEY'),
    ],

    'EU' => [
        'access_id' => env('EU_MWS_ACCESS_KEY'),
        'secret_key' => env('EU_MWS_SECRET_KEY'),
    ],

    'order_statuses' => [
        'Shipped' => 'Shipped',
        'Cancelled' => 'Cancelled',
        'Unshipped' => 'Unshipped',
        'Pending' => 'Pending',
    ],
];
