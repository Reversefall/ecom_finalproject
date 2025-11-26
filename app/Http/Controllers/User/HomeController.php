<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

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

    public function detail($id)
    {
        $product = Product::with('images')
            ->where('status', 1)
            ->findOrFail($id);

        return view('user.details', compact('product'));
    }


    public function products()
    {
        $products = Product::where('status', 1)
            ->with('images')
            ->get();
        $categories = Category::all();


        return view('user.products', compact('products', 'categories'));
    }
}
