<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'phone_number'     => 'nullable|string|max:20',
            'role'    => 'nullable|in:admin,moderator,seller,user',
            'password'  => 'required|min:6',
        ]);

        User::create([
            'username'      => $request->username,
            'full_name'      => $request->full_name,
            'email'     => $request->email,
            'phone_number'     => $request->phone_number,
            'role'    => $request->role,
            'status'    => 1,
            'password'  => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('create', true);
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('update', true);
    }

    public function toggleStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();

        return redirect()->route('admin.users.index')->with('updateStatus', true);
    }
}
