<?php

namespace App\Http\Controllers;

use App\Models\Grievance;
use App\Models\DepartmentModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrievanceController extends Controller
{
    /**
     * Display the form for creating a new grievance.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Get all departments from the department table
        $departments = DepartmentModel::all();
    
        // Pass the departments data to the view
        return view('cauth.grievances.create', compact('departments'));
    }
    

    /**
     * Store a newly created grievance in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
{
    // Validate the input data
    $validated = $request->validate([
        'related_to' => 'required|string|max:255',
        'subject' => 'required|string|max:255',
        'grievance' => 'required|string',
        'document' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
    ]);

    // Create a new grievance entry
    $grievance = new Grievance();
    $grievance->registrations_id = session('customer')['id'];  // Assuming this is how you identify the customer
    $grievance->related_to = $validated['related_to'];
    $grievance->subject = $validated['subject'];
    $grievance->grievance = $validated['grievance'];

    // Handle file upload if document is provided
    if ($request->hasFile('document')) {
        $document = $request->file('document');
        
        $documentPath = $document->store('grievances', 'public');

        $grievance->document_path = $documentPath;
    }

    // Save the grievance entry to the database
    $grievance->save();

    // Redirect to 'viewGrievance' route with a success message
    return redirect()->route('viewGrievance')->with('success', 'Grievance submitted successfully!');
}



    /**
     * Display a listing of grievances for the logged-in user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $grievances = Grievance::where('registrations_id', session('customer')['id'])->get();
       
        return view('cauth.grievances.index', compact('grievances'));
    }
}
