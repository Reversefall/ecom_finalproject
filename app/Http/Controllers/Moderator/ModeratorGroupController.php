<?php

namespace App\Http\Controllers\Moderator;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
class ModeratorGroupController extends Controller
{
    public function index()
    {
        $groups = Group::with('members')->get();
        return view('moderator.groups.index', compact('groups'));
    }


    public function detail($id)
    {
        $user = Group::findOrFail($id);
        return view('moderator.groups.edit', compact('user'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $group = Group::findOrFail($id);
        $group->status = $request->status;
        $group->save();

        return redirect()->route('moderator.groups.index')
            ->with('updateStatus', true)
            ->with('message', 'Trạng thái nhóm đã được cập nhật.');
    }
}
