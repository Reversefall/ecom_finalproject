<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        $user = User::where('username', $request->username)->first();
        Log::info('Login attempt user:', [
            'username_input' => $request->username,
            'db_user_exists' => $user ? true : false,
            'db_user_password' => $user?->password,
        ]);

        if ($user) {
            Log::info('Password check:', [
                'result' => Hash::check($request->password, $user->password)
            ]);
        }
        $attempt = Auth::attempt($credentials);
        Log::info('Auth attempt result:', [
            'credentials' => $credentials,
            'attempt' => $attempt,
        ]);

        if ($attempt) {
            tap(Auth::user())->update([
                'last_active' => now(),
            ]);


            $role = Auth::user()->role;
            Log::info('User logged in successfully', [
                'role' => $role
            ]);

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($role === 'seller') {
                return redirect()->route('seller.dashboard');
            }

            if ($role === 'moderator') {
                return redirect()->route('moderator.dashboard');
            }

            return redirect('');
        }

        Log::warning('Login failed: wrong username or password');

        return back()->withErrors([
            'login_error' => 'Sai tài khoản hoặc mật khẩu'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
