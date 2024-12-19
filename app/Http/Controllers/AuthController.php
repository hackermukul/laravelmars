<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Registration;

class AuthController extends Controller
{
    // Show login form if not logged in
    public function showLoginForm(Request $request)
    {
        if ($request->session()->has('customer')) {
            return redirect()->route('profile');
        }
        return view('home.login_module');
    }

    // Handle customer login
    public function customer_login(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'password' => 'required',
        ]);

        $user = Registration::where('user_id', $request->user_id)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->regenerate(); // Regenerate session ID for security

            // Store customer info in session
            $request->session()->put('customer', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'user_id' => $user->user_id,
            ]);

            return redirect()->route('profile')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'user_id' => 'The provided user ID does not exist.',
            'password' => 'The provided password is incorrect.',
        ]);
    }

    // Display customer profile
    public function profile(Request $request)
    {
        // Check if user is logged in
        $customer = $request->session()->get('customer');
        if (!$customer) {
            return redirect()->route('loginForm')->withErrors(['message' => 'Please log in to access your profile.']);
        }
          
        return view('cauth.profile', compact('customer'));
    }

    // Handle logout
    public function logout(Request $request)
    {
        // Clear session and invalidate the session token
        $request->session()->forget('customer');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('loginForm');
    }
}
