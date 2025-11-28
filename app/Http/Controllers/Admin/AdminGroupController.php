<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
class AdminGroupController extends Controller
{
    public function index()
    {
        $groups = Group::with('members')->get();
        return view('admin.groups.index', compact('groups'));
    }

    public function detail($id)
    {
        $group = Group::with('members')->findOrFail($id);
        return view('admin.groups.details', compact('group'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $group = Group::findOrFail($id);
        $group->status = $request->status;
        $group->save();

        return redirect()->route('admin.groups.index')
            ->with('updateStatus', true)
            ->with('message', 'Trạng thái nhóm đã được cập nhật.');
    }
}
