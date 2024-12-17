<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentRegistrationController extends Controller
{
    // Show the registration form
    public function showForm()
    {
        return view('registration.student');
    }

    // Handle form submission
    public function submitForm(Request $request)
    {
        // Validate the form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mobile_no' => 'required|digits:10',
            'email' => 'required|email|max:255',
            'course' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'roll_no' => 'required|string|max:50',
            'academic_session' => 'required|string|max:255',
            'user_id' => 'required|string|max:50|unique:users,user_id',
            'password' => 'required|min:6|confirmed',
        ]);

        // Logic to save the data into the database can go here
        // Example: User::create($validated);

        // Return with success message
        return back()->with('success', 'Registration successful!');
    }
}
