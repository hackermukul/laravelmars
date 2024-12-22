<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Registration;

class ProfileController extends Controller
{
    // Show the edit profile form
    public function edit(Request $request)
    {
        $customer = $request->session()->get('customer');
        return view('cauth.edit', compact('customer'));
    }

    // Update the profile
    public function update(Request $request)
    {
        $customer = $request->session()->get('customer');
        $user = Registration::find($customer['id']);
        
        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Update session
        $request->session()->put('customer', $user);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    // Show change password form
    public function changePasswordForm()
    {
        return view('cauth.changePassword');
    }

    // Update the password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $customer = session('customer');
        $user = Registration::find($customer['id']);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password updated successfully!');
    }

    // Show Add Course form
    public function addCourseForm()
    {
        return view('profile.addCourse');
    }

    // Save new course
    public function saveCourse(Request $request)
    {
        // Logic to save the course
        // Assuming you have a Course model
        // Course::create([
        //     'user_id' => session('customer')['id'],
        //     'course_name' => $request->course_name,
        //     // other course details
        // ]);

        return redirect()->route('profile')->with('success', 'Course added successfully!');
    }
}
