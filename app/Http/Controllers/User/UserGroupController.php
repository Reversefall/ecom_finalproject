<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\GroupMessage;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\GitHubUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserGroupController extends Controller
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

        return view('mygroups', compact('categories', 'groups'));
    }


    public function joinGroup($groupId)
    {
        $userId = Auth::id();

        $group = Group::findOrFail($groupId);

        $exists = GroupMember::where('group_id', $groupId)
            ->where('customer_id', $userId)
            ->exists();

        if ($exists) {
            return back()->with('warning', 'Bạn đã tham gia nhóm này rồi.');
        }

        GroupMember::create([
            'group_id'    => $groupId,
            'customer_id' => $userId,
            'joined_at'   => now(),
        ]);

        return back()->with('success', 'Tham gia nhóm thành công!');
    }

    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('create-group', compact('product'));
    }

    public function store(Request $request, $productId)
    {
        $userId = Auth::id();

        $product = Product::findOrFail($productId);

        $exists = Group::where('product_id', $productId)
            ->where('creator_id', $userId)
            ->where('status', 'processing')
            ->exists();

        if ($exists) {
            return back()->with('warning', 'Bạn đã tạo nhóm mua chung cho sản phẩm này rồi!');
        }

        $group = Group::create([
            'creator_id' => $userId,
            'product_id' => $productId,
            'group_name' => $product->product_name . ' - Nhóm Mua Chung',
            'description' => $request->description ?? '',
            'status' => 'processing',
        ]);

        GroupMember::create([
            'group_id'    => $group->group_id,
            'customer_id' => $userId,
            'joined_at'   => now(),
        ]);

        return redirect()->route('user.groups.index')->with('success', 'Tạo nhóm mua chung thành công!');
    }

    public function chat($groupId)
    {
        $group = Group::with(['members.customer'])->findOrFail($groupId);

        $members = $group->members->filter(function ($m) {
            return $m->customer_id != Auth::id();
        });

        foreach ($members as $m) {
            $lastActive = $m->customer->last_active ?? null;
            $m->isOnline = $lastActive && $lastActive >= now()->subMinutes(5);
        }

        $messages = GroupMessage::with('customer')
            ->where('group_id', $groupId)
            ->orderBy('sent_at', 'asc')
            ->get();

        return view('chat', compact('group', 'members', 'messages'));
    }

    public function send(Request $request, $groupId)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $msg = GroupMessage::create([
            'group_id' => $groupId,
            'customer_id' => Auth::id(),
            'message_text' => $request->message,
            'sent_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => $msg,
            'html' => view('components.chat_message', ['msg' => $msg])->render()
        ]);
    }
}
