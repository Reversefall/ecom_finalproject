<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerOrderController extends Controller
{
    public function index()
    {
        $sellerId = Auth::id();

        $soldItems = OrderDetail::with([
            'order',
            'product' => function ($q) {
                $q->with('images', 'category');
            }
        ])
            ->whereHas('product', function ($q) use ($sellerId) {
                $q->where('seller_id', $sellerId);
            })
            ->orderBy('order_id', 'DESC')
            ->get();

        return view('seller.orders.index', compact('soldItems'));
    }
}
