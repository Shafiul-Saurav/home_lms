<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function loginPage()
    {
        return view('backend.pages.auth.login');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // login attempt if success then redirect home
        if(Auth::attempt($credentials, $request->filled('remember'))){
            $request->session()->regenerate();

            // Event Fire/Trigger/Dispatch
            // $user = Auth::user();
            // event(new LoginHistory($user));

            return redirect()->intended('admin/dashboard');
        }

        // return error message
        return back()->withErrors([
            'email' => 'Wrong Credentials found!'
        ])->onlyInput('email');

    }

    public function adminLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
