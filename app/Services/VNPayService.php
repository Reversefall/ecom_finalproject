<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class VNPayService
{
    public static function generatePaymentUrl($orderId, $amount, $orderInfo = null)
    {
        $vnp_TmnCode = config('vnpay.vnp_TmnCode');
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $vnp_PayUrl   = config('vnpay.vnp_PayUrl');
        $vnp_ReturnUrl = config('vnpay.vnp_ReturnUrl');

        Log::info('VNPay Payment URL: ' . $vnp_TmnCode);
        Log::info('VNPay Payment URL: ' . $vnp_HashSecret);
        Log::info('VNPay Payment URL: ' . $vnp_PayUrl);
        Log::info('VNPay Payment URL: ' . $vnp_ReturnUrl);


        $vnp_TxnRef = time() . rand(1000, 9999); 
        $vnp_Amount = $amount * 100; 
        $vnp_OrderInfo = $orderInfo ?? "Thanh toán đơn hàng #$orderId";
        $vnp_OrderType = 'other';
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $vnp_CreateDate = date('YmdHis');
        $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));

        $vnp_Params = [
            "vnp_Version"    => "2.1.0",
            "vnp_TmnCode"    => $vnp_TmnCode,
            "vnp_Amount"     => $vnp_Amount,
            "vnp_Command"    => "pay",
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_CurrCode"   => "VND",
            "vnp_IpAddr"     => $vnp_IpAddr,
            "vnp_Locale"     => $vnp_Locale,
            "vnp_OrderInfo"  => $vnp_OrderInfo,
            "vnp_OrderType"  => $vnp_OrderType,
            "vnp_ReturnUrl"  => $vnp_ReturnUrl,
            "vnp_TxnRef"     => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate,
        ];

        ksort($vnp_Params);
        $query = [];
        $hashData = [];
        foreach ($vnp_Params as $key => $value) {
            $hashData[] = $key . '=' . urlencode($value);
            $query[] = $key . '=' . urlencode($value);
        }
        $queryString = implode('&', $query);
        $vnpSecureHash = hash_hmac('sha512', implode('&', $hashData), $vnp_HashSecret);
        $paymentUrl = $vnp_PayUrl . '?' . $queryString . '&vnp_SecureHash=' . $vnpSecureHash;

        return $paymentUrl;
    }
}
