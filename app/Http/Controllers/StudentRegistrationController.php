<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;


class StudentRegistrationController extends Controller
{
    // Show the registration form
    public function showForm()
    {
        return view('registration.student');
    }

    // Handle form submission
    public function submitForm1(Request $request)
    {
        // Logic to save the data into the database can go here
        // Example: User::create($validated);

        // Return with success message
        return back()->with('success', 'Registration successful!');
    }

    
    public function submitForm(Request $request)
    {
        // Validate the form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mobile_no' => 'required|digits:10|unique:registrations,mobile_no', // Check mobile uniqueness
            'email' => 'required|email|max:255|unique:registrations,email', // Check email uniqueness
            'course' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'roll_no' => 'required|string|max:50',
            'academic_session' => 'required|string|max:255',
            'user_id' => 'required|string|max:50|unique:registrations,user_id',
            'password' => 'required|min:6|confirmed',
        ]);

        // Save the data in the registrations table
        $registration = new Registration();
        $registration->name = $validated['name'];
        $registration->registrations_type = "student";
        $registration->father_name = $validated['father_name'];
        $registration->mobile_no = $validated['mobile_no'];
        $registration->email = $validated['email'];
        $registration->course = $validated['course'];
        $registration->semester = $validated['semester'];
        $registration->roll_no = $validated['roll_no'];
        $registration->academic_session = $validated['academic_session'];
        $registration->user_id = $validated['user_id'];
        $registration->password = bcrypt($validated['password']); // Encrypt the password
        $registration->save();

        // Redirect with a success message
        return redirect()->route('registration.student')->with('success', 'Registration successful.');
    }
    

    

 public function staffsubmitForm(Request $request)
{
    // Validate the form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mobile_no' => 'required|digits:10|unique:registrations,mobile_no', // Check mobile uniqueness
            'email' => 'required|email|max:255|unique:registrations,email', // Check email uniqueness
            'department' => 'required|string|max:255',
            'user_id' => 'required|string|max:50|unique:registrations,user_id', // Ensure user_id is unique
            'password' => 'required|min:6|confirmed',
        ]);


    // Create a new registration record
    $registration = new Registration();
    $registration->name = $validated['name'];
    $registration->registrations_type = "staff";
    $registration->father_name = $validated['father_name'];
    $registration->mobile_no = $validated['mobile_no'];
    $registration->email = $validated['email'];
    $registration->department = $validated['department'];
    $registration->user_id = $validated['user_id'];
    $registration->password = bcrypt($validated['password']); // Encrypt the password
    $registration->save(); // Save data to the database

    // Redirect back with success message
    return redirect()->route('registration.staff')->with('success', 'Registration successful!');
}


public function alumnisubmitForm(Request $request)
    {
        // Validate the form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mobile_no' => 'required|digits:10|unique:registrations,mobile_no', // Check mobile uniqueness
            'email' => 'required|email|max:255|unique:registrations,email', // Check email uniqueness
            'course' => 'required|string|max:255',
            //'semester' => 'required|string|max:255',
            'roll_no' => 'required|string|max:50',
            'academic_session' => 'required|string|max:255',
            'user_id' => 'required|string|max:50|unique:registrations,user_id',
            'password' => 'required|min:6|confirmed',
        ]);

        // Save the data in the registrations table
        $registration = new Registration();
        $registration->name = $validated['name'];
        $registration->registrations_type = "alumni";
        $registration->father_name = $validated['father_name'];
        $registration->mobile_no = $validated['mobile_no'];
        $registration->email = $validated['email'];
        $registration->course = $validated['course'];
       // $registration->semester = $validated['semester'];
        $registration->roll_no = $validated['roll_no'];
        $registration->academic_session = $validated['academic_session'];
        $registration->user_id = $validated['user_id'];
        $registration->password = bcrypt($validated['password']); // Encrypt the password
        $registration->save();

        // Redirect with a success message
        return redirect()->route('registration.alumni')->with('success', 'Registration successful.');
    }



public function parentsubmitForm(Request $request)
{
    // Validate the form inputs
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'child_name' => 'required|string|max:255',
        'mobile_no' => 'required|digits:10|unique:registrations,mobile_no', // Check mobile uniqueness
            'email' => 'required|email|max:255|unique:registrations,email', // Check email uniqueness
        'course' => 'required|string|max:255',
        'semester' => 'required|string|max:255',
        'roll_no' => 'required|string|max:50',
        'session' => 'required|string|max:255',
        'user_id' => 'required|string|max:50|unique:registrations,user_id',
        'password' => 'required|min:6|confirmed',
    ]);

    // Create a new registration record
    $registration = new Registration();
    $registration->name = $validated['name'];
    $registration->child_name = $validated['child_name'];
    $registration->mobile_no = $validated['mobile_no'];
    $registration->email = $validated['email'];
    $registration->course = $validated['course'];
    $registration->semester = $validated['semester'];
    $registration->roll_no = $validated['roll_no'];
    $registration->session = $validated['session'];
    $registration->user_id = $validated['user_id'];
    $registration->password = bcrypt($validated['password']); // Encrypt the password
    $registration->registrations_type = "parent";  // Assuming "parent" as type, adjust as needed
    $registration->save(); // Save data to the database

    // Redirect back with success message
    return redirect()->route('registration.parent')->with('success', 'Registration successful!');
}






}
