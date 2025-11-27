<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Group;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Services\VNPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserOrderController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $orders = Order::with('payments')
            ->where('buyer_id', $userId)
            ->orderBy('order_date', 'desc')
            ->get();

        return view('user.orders.index', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::with('details')
            ->findOrFail($id);

        return view('user.orders.details', compact('order'));
    }



    public function storePayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'amount_paid' => 'required|numeric|min:1',
        ]);

        $order = Order::findOrFail($request->order_id);
        $alreadyPaid = $order->payments->sum('amount_paid');
        $remaining = $order->total_amount - $alreadyPaid;

        if ($request->amount_paid > $remaining) {
            return back()->with('error', 'Số tiền thanh toán không được lớn hơn số tiền còn lại!');
        }

        session([
            'vnpay_order_id' => $order->order_id,
            'vnpay_amount'   => $request->amount_paid,
        ]);

        $paymentUrl = VNPayService::generatePaymentUrl(
            $order->order_id,
            $request->amount_paid,
            "Thanh toán đơn hàng #" . $order->order_id
        );
        return redirect($paymentUrl);
    }


    public function vnpayReturn(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');

        $orderId = session('vnpay_order_id');
        $amount  = session('vnpay_amount');

        if (!$orderId || !$amount) {
            return redirect()->route('user.orders.index')->with('error', 'Không tìm thấy thông tin thanh toán.');
        }

        $order = Order::find($orderId);
        if (!$order) {
            return redirect()->route('user.orders.index')->with('error', 'Đơn hàng không tồn tại.');
        }

        if ($vnp_ResponseCode == '00') {
            OrderPayment::create([
                'order_id'      => $order->order_id,
                'buyer_id'      => Auth::id(),
                'amount_paid'   => $amount,
                'payment_status' => 'completed',
            ]);

            session()->forget(['vnpay_order_id', 'vnpay_amount']);

            return redirect()->route('user.orders.index')->with('success', 'Thanh toán thành công!');
        } else {
            return redirect()->route('user.orders.index')->with('error', 'Thanh toán thất bại.');
        }
    }
}
