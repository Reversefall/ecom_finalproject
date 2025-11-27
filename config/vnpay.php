<?php

return [
    'vnp_TmnCode' => env('VNP_TMNCODE', '4U24A3OG'),
    'vnp_HashSecret' => env('VNP_HASHSECRET', 'NQMWKR3HWPELNPD4855IFE2EOUUXYEQW'),
    'vnp_PayUrl'   => env('VNP_PAYURL', 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'),
    'vnp_ReturnUrl' => env('VNP_RETURNURL', env('APP_URL') . '/vnpay/return'),
];
