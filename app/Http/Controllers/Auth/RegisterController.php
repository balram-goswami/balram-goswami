<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        // dd('This is the registration page');
        return view('UserPenal.register');
    }

    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',  // For password confirmation, use 'password_confirmation' field
        ]);

        // Create the user in the database
        User::create([
            'name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),  // Hash the password
        ]);

        // Redirect or return success message
        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }
    public function showLoginForm()
    {
        // dd('This is the registration page');
        return view('UserPenal.login');
    }

    public function login(Request $request)
    {
        // Validate the incoming request
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
 
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard'); // Redirect to the intended page
        }

        // If login fails, redirect back with error
        return redirect()->back()->withErrors('Invalid login credentials.');
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Redirect to the login page or home
    }
}
