<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerOrderController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $categories = Category::withCount(['products as group_count' => function ($q) {
            $q->whereHas('groups', function ($q2) {
                $q2->where('status', 'processing');
            });
        }])->get();

        $query = Group::with([
            'creator',
            'product' => function ($q) {
                $q->with('category', 'images');
            }
        ])
            ->where('status', 'processing')
            ->whereHas('members', function ($q) use ($userId) {
                $q->where('customer_id', $userId);
            });

        if ($request->has('category') && $request->category != '') {
            $categoryId = $request->category;

            $query->whereHas('product', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        $groups = $query->paginate(6)->withQueryString();

        return view('seller.orders.index', compact('categories', 'groups'));
    }
}
