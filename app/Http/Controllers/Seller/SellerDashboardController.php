<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $sellerId = Auth::id();
        $seller = User::findOrFail($sellerId);

        $totalOrders = $seller->sellerOrders()->count();

        $totalProducts = $seller->products()->count();

        $totalGroups = Group::whereIn('product_id', $seller->products()->pluck('product_id'))
            ->count();

        $totalRevenue = $seller->sellerOrders()->sum('total_amount');

        $year = now()->year;

        $productsPerMonth = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('seller_id', $sellerId)
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[$i] = $productsPerMonth[$i] ?? 0;
        }

        return view('seller.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalGroups',
            'totalRevenue',
            'monthlyData',
            'year'
        ));
    }
}
