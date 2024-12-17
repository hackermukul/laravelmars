<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    // Student Registration Page
    public function studentRegistration()
    {
        return view('registration.student');
    }

    // Staff Registration Page
    public function staffRegistration()
    {
        return view('registration.staff');
    }

    // Parent Registration Page
    public function parentRegistration()
    {
        return view('registration.parent');
    }
}
