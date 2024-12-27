<?php

namespace App\Http\Controllers;

use App\Models\Grievance;
use App\Models\GrievanceReply;
use App\Models\DepartmentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

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
        $grievances = DB::table('grievances')
            ->join('department_models', 'grievances.related_to', '=', 'department_models.id')
            ->where('grievances.registrations_id', session('customer')['id'])
            ->select('grievances.*', 'department_models.name as related_to')
            ->get();

        return view('cauth.grievances.index', compact('grievances'));
    }

    /**
     * Display a specific grievance and its replies.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $grievance = DB::table('grievances')
    ->join('department_models', 'grievances.related_to', '=', 'department_models.id')
    ->where('grievances.registrations_id', session('customer')['id'])
    ->where('grievances.id', $id)
    ->select('grievances.*', 'department_models.name as related_to')
    ->first();  // Use first() instead of get()

       
        

        $replies = DB::table('grievance_replies')
            ->join('grievances', 'grievances.id', '=', 'grievance_replies.grievance_id')
            ->join('department_models', 'grievances.related_to', '=', 'department_models.id')
            ->where('grievance_replies.registrations_id', session('customer')['id'])
            ->where('grievance_replies.grievance_id', $id)
            ->select('grievance_replies.*', 'department_models.name as related_to')
            ->orderBy('grievance_replies.created_at', 'asc')  // Order by created_at in ascending order
            ->get();

        return view('cauth.grievances.reply', compact('grievance', 'replies'));
    }

    /**
     * Store a new reply for a specific grievance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeReply(Request $request)
{
    $request->validate([
        'grievance_id' => 'required|exists:grievances,id',
        'reply' => 'required|string',
        'attachment' => 'nullable|file|mimes:jpg,png,pdf|max:10240',
    ]);

    // Handle file upload if exists
    $attachmentPath = null;
    if ($request->hasFile('attachment')) {
        
        $attachmentPath = $request->file('attachment')->store('grievance_attachments', 'public');
    }

    // Create the reply
    GrievanceReply::create([
        'grievance_id' => $request->grievance_id,
        'reply' => $request->reply,
        'attachment' => $attachmentPath,
        'registrations_id' => session('customer')['id'],
    ]);

    return redirect()->route('grievances.show', $request->grievance_id)->with('success', 'Your reply has been submitted.');
}

}
