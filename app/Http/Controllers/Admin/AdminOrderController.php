<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }

    public function toggleStatus(Request $request)
    {
        $order = Order::find($request->order_id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json(['success' => true]);
    }

    public function detail($id)
    {
        $order = Order::with('details')
            ->findOrFail($id);

        return view('admin.orders.details', compact('order'));
    }
}
