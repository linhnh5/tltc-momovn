<?php
return [
    'PARTNER_CODE' => env('MOMO_PARTNER_CODE', ''),
    'SECRET_KEY' => env('MOMO_SECRET_KEY', ''),
    'ACCESS_KEY' => env('MOMO_ACCESS_KEY', ''),
    'API_END_POINT' => env('MOMO_API_END_POINT', '/gw_payment/transactionProcessor'),
    'DOMAIN' => env('MOMO_DOMAIN', 'https://test-payment.momo.vn'),
];