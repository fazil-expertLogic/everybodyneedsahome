<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationsController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('site.login');
    }

    // Handle login
    public function loginPerform(Request $request)
    {
        
        // Validate the request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

       
        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Regenerate the session to avoid session fixation
            session()->regenerate();
            $user = User::where('id',Auth::user()->id)->first();
            $user->is_online = 1;
            $user->save();
            return redirect('dashboard')->with('success', 'Login successful!');
        }

        // If authentication fails
        return back()->withErrors([
            'email' => 'Your provided credentials could not be verified.',
        ]);
    }

    // Check subscription status for the Creator role
   

    // Show registration form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,  // Set default status, adjust as needed
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to dashboard
        return redirect('dashboard')->with('success', 'Registration successful!');
    }

    // Handle logout
    public function logout()
    {
        $user = User::where('id',Auth::user()->id)->first();
        $user->is_online = 0;
        $user->save();
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
