<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Group;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)
            ->with('images')
            ->get();

        return view('index', compact('products'));
    }

    public function chat()
    {
        $products = Product::where('status', 1)
            ->with('images')
            ->get();

        return view('chat', compact('products'));
    }

    public function products()
    {
        $products = Product::where('status', 1)
            ->with('images')
            ->get();
        $categories = Category::all();


        return view('user.products', compact('products', 'categories'));
    }

    public function detail($id)
    {
        $product = Product::with(['images', 'groups' => function ($q) {
            $q->whereIn('status', ['processing']);
        }])->where('status', 1)
            ->findOrFail($id);

        return view('user.details', compact('product'));
    }

    public function groups(Request $request)
    {
        $categories = Category::withCount(['products as group_count' => function ($q) {
            $q->whereHas('groups', function ($q2) {
                $q2->where('status', 'processing');
            });
        }])->get();

        $query = Group::with(['creator', 'product' => function ($q) {
            $q->with('category', 'images');
        }])->where('status', 'processing');

        if ($request->has('category') && $request->category != '') {
            $categoryId = $request->category;
            $query->whereHas('product', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        $groups = $query->paginate(6)->withQueryString();

        return view('groups', compact('groups', 'categories'));
    }


    public function detailGroups($id)
    {
        $group = Group::with(['creator', 'product.images', 'members'])->findOrFail($id);

        $relatedGroups = Group::with(['creator', 'product'])
            ->where('status', 'processing')
            ->where('group_id', '!=', $group->group_id)
            ->take(5)
            ->get();


        return view('groups-details', compact('group', 'relatedGroups'));
    }
}
