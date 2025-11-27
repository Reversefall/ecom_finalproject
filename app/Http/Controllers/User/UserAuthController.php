<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Group;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\User;
use App\Services\GitHubUploadService;
use App\Services\VNPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserAuthController extends Controller
{
    public function showChangePassForm()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('user.auth.change_pass', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Mật khẩu hiện tại không đúng!');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }


    public function showChangeInfoForm()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('user.auth.change_info', compact('user'));
    }

    public function updateInfo(Request $request, GitHubUploadService $github)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|unique:users,phone_number,' . $user->id,
            'avatar' => 'nullable|image|max:2048'
        ]);

        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        if ($request->hasFile('avatar')) {
            $timestamp = now()->format('His'); 

            $path = 'avatars/' . $timestamp . '_' . $request->file('avatar')->getClientOriginalName();

            $avatarUrl = $github->uploadFile($request->file('avatar'), $path);

            $user->avatar = $avatarUrl;
        }

        $user->save();

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }
}
