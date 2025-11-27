<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Group;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCartController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $groups = Group::with([
            'product' => function ($q) {
                $q->with('category', 'images');
            },
            'members'
        ])
            ->where('status', 'processing')
            ->whereHas('members', function ($q) use ($userId) {
                $q->where('customer_id', $userId);
            })
            ->get();

        $products = $groups->pluck('product')->filter();

        return view('user.orders.cart', compact('products', 'groups'));
    }

    public function checkout(Request $request)
    {
        $userId = Auth::id();

        $products = $request->input('products', []);
        if (empty($products)) {
            return back()->with('warning', 'Chưa chọn sản phẩm nào!');
        }

        foreach ($products as $productId => $data) {
            if (!isset($data['selected']) || $data['quantity'] <= 0) continue;

            $group = Group::where('product_id', $productId)
                ->whereHas('members', fn($q) => $q->where('customer_id', $userId))
                ->first();
            if (!$group) continue;

            $product = $group->product;
            $discountBase = 10;
            $additionalDiscount = floor(($group->members->count() - 1) / 5) * 2;
            $discount = $discountBase + $additionalDiscount;
            if ($discount > 50) $discount = 50;
            $finalPrice = $product->price * (1 - $discount / 100);

            $order = Order::create([
                'address' => $request->address,
                'phone' => $request->phone,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'buyer_id' => $userId,
                'order_date' => now(),
                'status' => 'pending',
                'total_amount' => $finalPrice * $data['quantity'],
            ]);

            OrderDetail::create([
                'order_id' => $order->order_id,
                'product_id' => $product->product_id,
                'group_id' => $group->group_id,
                'quantity' => $data['quantity'],
                'unit_price' => $product->price,
                'discount' => $discount,
                'total_price' => $finalPrice * $data['quantity'],
            ]);
        }

        return redirect()->route('user.orders.index')->with('success', 'Đặt hàng thành công!');
    }
}
