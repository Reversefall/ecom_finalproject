<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\GitHubUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerProductController extends Controller
{
    public function index()
    {
        $products = Product::where('seller_id', Auth::id())->with('images')->get();

        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name'     => 'required|string|max:255',
            'category_id'      => 'required|integer',
            'price'            => 'required|numeric|min:0',
            'current_quantity' => 'required|integer|min:0',
            'images.*'         => 'image|max:5120',
        ]);

        $product = Product::create([
            'product_name'     => $request->product_name,
            'category_id'      => $request->category_id,
            'price'            => $request->price,
            'current_quantity' => $request->current_quantity,
            'status'           => 1,
            'seller_id'        => Auth::id(),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {

                $path = "products/" . $product->product_id . "/" . time() . "_" . $img->getClientOriginalName();

                $url = app(GitHubUploadService::class)
                    ->uploadFile($img, $path);

                $product->images()->create([
                    'image_url' => $url
                ]);
            }
        }

        return redirect()->route('seller.products.index')->with('create', true);
    }

    public function edit($id)
    {
        $product = Product::where('seller_id', Auth::id())
            ->findOrFail($id);
        $categories = Category::all();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);

        $request->validate([
            'product_name'     => 'required|string|max:255',
            'category_id'      => 'required|integer',
            'price'            => 'required|numeric|min:0',
            'current_quantity' => 'required|integer|min:0',
            'images.*'         => 'image|max:5120',
        ]);

        $product->update([
            'product_name'     => $request->product_name,
            'category_id'      => $request->category_id,
            'price'            => $request->price,
            'current_quantity' => $request->current_quantity,
        ]);

        if ($request->hasFile('images')) {
            $product->images()->delete();

            foreach ($request->file('images') as $img) {

                $path = "products/" . $product->product_id . "/" . time() . "_" . $img->getClientOriginalName();

                $url = app(GitHubUploadService::class)
                    ->uploadFile($img, $path);

                $product->images()->create([
                    'image_url' => $url
                ]);
            }
        }

        return redirect()->route('seller.products.index')->with('update', true);
    }


    public function toggleStatus($id)
    {
        $product = Product::where('seller_id', Auth::id())
            ->findOrFail($id);

        $product->status = $product->status == 1 ? 0 : 1;
        $product->save();

        return redirect()->route('seller.products.index')->with('updateStatus', true);
    }

    public function destroyImage($id)
    {
        $image = ProductImage::findOrFail($id);
        $image->delete();
        return response()->json(['message' => 'Xóa ảnh thành công']);
    }
}
