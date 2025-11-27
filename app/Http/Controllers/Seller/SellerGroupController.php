<?php

namespace App\Http\Controllers\Seller;

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

class SellerGroupController extends Controller
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

        return view('seller.groups.index', compact('categories', 'groups'));
    }

    public function detail($id)
    {
        $group = Group::with(['creator', 'product.images', 'members'])->findOrFail($id);
        return view('seller.groups.details', compact('group'));
    }


    public function payments(Request $request)
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

        return view('seller.groups.payments', compact('categories', 'groups'));
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

        return view('seller.groups.chat', compact('group', 'members', 'messages'));
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
