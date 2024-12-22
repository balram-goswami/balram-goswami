<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Admin,
    User,
    UserEvent
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    Hash,
    Auth,
    Log,
    Session
};

class AdminController extends Controller
{

    public function dashboard()
    {
        $getUsers = User::get();
        $getUserEvent = UserEvent::get();

        return view('AdminPenal.dashboard', compact('getUsers', 'getUserEvent'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully'); // Redirect to intended page
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
