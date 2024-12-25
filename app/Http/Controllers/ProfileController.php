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
    // Retrieve the customer data from session
    $customers = $request->session()->get('customer');
    if (!$customers) {
        return redirect()->route('loginForm')->withErrors(['message' => 'Please log in to access your profile.']);
    }

    $customer = Registration::find($customers['id']); // Use your Registration model
    if (!$customer) {
        return redirect()->route('loginForm')->withErrors(['message' => 'Customer not found.']);
    }

    // Pass customer details to the view
    return view('cauth.edit', compact('customer'));
}


    // Update the profile
    public function update(Request $request)
{
    // Retrieve the customer data from the session
    $customer = $request->session()->get('customer');

    if (!$customer) {
        return redirect()->route('loginForm')->withErrors(['message' => 'Please log in to update your profile.']);
    }

    // Fetch the user from the database
    $user = Registration::find($customer['id']);
    if (!$user) {
        return redirect()->route('profile')->withErrors(['message' => 'User not found.']);
    }

    // Validate the request
    $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:registrations,email,' . $user->id,
        'mobile_no' => 'required|string|max:15',
        'father_name' => 'required|string|max:255',
    ];

    // Add validation rules for specific user types
    if ($customer['registrations_type'] == 'student') {
        $rules['course'] = 'nullable|string|max:255';
        $rules['semester'] = 'nullable|string|max:50';
        $rules['roll_no'] = 'nullable|string|max:50';
        $rules['academic_session'] = 'nullable|string|max:100';
    } elseif ($customer['registrations_type'] == 'parent') {
        $rules['child_name'] = 'nullable|string|max:255';
        $rules['department'] = 'nullable|string|max:255';
    }
    elseif ($customer['registrations_type'] == 'staff') {
        $rules['department'] = 'nullable|string|max:255';
    }

    $validated = $request->validate($rules);

    // Update common fields
    $user->name = $validated['name'];
    $user->email = $validated['email'];
    $user->mobile_no = $validated['mobile_no'] ?? null;
    $user->father_name = $validated['father_name'] ?? null;

    // Update fields based on the user type
    if ($customer['registrations_type'] == 'student') {
        $user->course = $validated['course'] ?? null;
        $user->semester = $validated['semester'] ?? null;
        $user->roll_no = $validated['roll_no'] ?? null;
        $user->academic_session = $validated['academic_session'] ?? null;
    } elseif ($customer['registrations_type'] == 'parent') {
        $user->child_name = $validated['child_name'] ?? null;
    }
    elseif ($customer['registrations_type'] == 'staff') {
        $user->department = $validated['department'] ?? null;
    }

    // Save the updated user
    $user->save();

    // Update session with new user data
    $request->session()->put('customer', $user);

    // Redirect back with success message
    return redirect()->route('profile')->with('success', 'Profile updated successfully!');
}


    // Show change password form
    public function changePasswordForm()
    {
        $customer = $request->session()->get('customer');
        if (!$customer) {
            return redirect()->route('loginForm')->withErrors(['message' => 'Please log in to access your profile.']);
        }
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
