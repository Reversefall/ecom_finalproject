<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Group;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();

        $totalProducts = Product::count();

        $totalGroups = Group::count();

        $totalRevenue = Order::sum('total_amount');

        $year = now()->year;
        $productsPerMonth = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[$i] = $productsPerMonth[$i] ?? 0;
        }

        $revenuePerMonth = Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[$i] = $revenuePerMonth[$i] ?? 0;
        }

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalGroups',
            'totalRevenue',
            'monthlyData',
            'revenueData',
            'year'
        ));
    }
}
