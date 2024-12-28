<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Registration; // Assuming you're using the Registration model
use DB;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('home.forgot-password');
    }

    public function processForgotPassword(Request $request)
{
    $request->validate([
        'user_id' => 'required', // Validate user ID
        'password' => 'required|min:8|confirmed', // Validate new password
    ]);

    // Retrieve the user from the database
    $user = DB::table('registrations')
        ->where('user_id', $request->user_id)
        ->first(); // Get a single user or null

    // Check if user exists
    if (!$user) {
        return back()->withErrors(['user_id' => 'User ID not found.']);
    }

    // Update the user's password
    DB::table('registrations')
        ->where('user_id', $request->user_id)
        ->update(['password' => Hash::make($request->password)]);

    // Redirect back to the same page with a success message
    return back()->with('success', 'Password reset successfully.');
}



}

