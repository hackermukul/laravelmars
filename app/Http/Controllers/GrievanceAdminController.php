<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreStateRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\GrievanceModel;
use App\Models\GrievanceReply;
use App\Models\Grievance;



use Intervention\Image\Facades\Image as Image;

use DB;
use Session;

use App\libraries\FunctionModel;
use App\libraries\User_auth;

class GrievanceAdminController extends Controller
{
    //
    
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->GrievanceModel= new GrievanceModel();
        
        $this->data['master'] =  new FunctionModel();
		$this->data['module_master'] = $module_master=$this->data['master']->getModule_details();

        $this->data['User_auth_obj'] = new User_auth();
		$this->data['user_data'] = $this->data['User_auth_obj']->check_user_status();
        	  
		if($this->data['module_master']->count() > 0)
		{
			$this->data['module_id'] = $this->data['module_master'][0]->id;
			$this->data['module_table'] = $this->data['module_master'][0]->table_name;
			$this->data['page_module_name'] = $this->data['module_master'][0]->name;
            $this->data['main_routes'] = $this->data['module_master'][0]->class_name;

		}
       //return $this->middleware('auth')->only(['index']);
       
    }
    public function index()
    {

        $this->data['page_module_id'] = $this->data['module_id'];
		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
    
		if(empty($this->data['user_access']))
		{
            return redirect()->route('dashboard.access-denied');
		}
        $this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;
        $user = Auth::user();
        $search = array();
		$field_name = '';
		$field_value = '';
		$end_date = ''; 
		$start_date = '';
		$record_status="";

		if(!empty($_REQUEST['field_name']))
			$field_name = $_POST['field_name'];
		else if(!empty($field_name))	
			$field_name = $field_name;
			
		if(!empty($_REQUEST['field_value']))
			$field_value = $_POST['field_value'];
		else if(!empty($field_value))	
			$field_value = $field_value;
			
		if(!empty($_POST['end_date']))
			$end_date = $_POST['end_date'];
		
	    if(!empty($_POST['start_date']))
			$start_date = $_POST['start_date'];
        // dd($start_date);
        // exit;
			 
		if(!empty($_POST['record_status']))
			$record_status = $_POST['record_status'];
				 
		$this->data['field_name'] = $field_name;
		$this->data['field_value'] = $field_value;
		$this->data['end_date'] = $end_date;
		$this->data['start_date'] = $start_date;
		$this->data['record_status'] = $record_status;
        $this->data['related_to'] = $user->department_id;
        // Get the authenticated user
        

		
		$search['end_date'] = $end_date;
		$search['start_date'] = $start_date;
		$search['field_value'] = $field_value;
		$search['field_name'] = $field_name;
		$search['record_status'] = $record_status;
        $search['related_to'] = $user->department_id;
        $search['super_to'] = $user->id;

        //dd($record_status);
		//$search['search_for'] = "count";
		
		$this->data['data_listing'] =$this->GrievanceModel->get_data_master($search);
        $rowCount = $this->data['data_listing']->count();
		$r_count = $this->data['row_count'] = $rowCount;
	
        return view('dashboard.grievance.index' , $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['page_module_id'] = $this->data['module_id'];
		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
    
		if(empty($this->data['user_access']))
		{
            return redirect()->route('dashboard.access-denied');
		}
        $this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;


        $this->data['countryname'] = DB::table('countries')->get();
        return view('dashboard.grievance.create' , $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStateRequest $request)
    {
       
        $this->State->name       = $request->name;
        $this->State->country_id = $request->country_id;
        $this->State->slug       = $this->State->setTitleAttribute($request->name);
        $this->State->added_by   = Auth::user()->id;
        $this->State->status     = $request->status;
        $this->State->save();
        // Additional logic or redirection after successful data storage
        if($request->save =="save"){
           return redirect()->route('state.index')->with('success', 'state stored successfully!');
        }else{
            return redirect()->route('state.create')->with('success', 'state stored successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->data['page_module_id'] = $this->data['module_id'];
		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
    
		if(empty($this->data['user_access']))
		{
            return redirect()->route('dashboard.access-denied');
		}
        $this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

        
        $search= array();
        $search['id'] = $id;
        $this->data['view_data']=$GrievanceModel = $this->GrievanceModel->get_data_master($search);
    
        $this->data['replies'] = DB::table('grievance_replies')
                ->join('grievances', 'grievances.id', '=', 'grievance_replies.grievance_id')
                ->join('department_models', 'grievances.related_to', '=', 'department_models.id')
                ->where('grievance_replies.grievance_id', $id)
                ->select('grievance_replies.*', 'department_models.name as related_to')
                ->orderBy('grievance_replies.created_at', 'asc')  // Order by created_at in ascending order
                ->get();
    

            
        if( $GrievanceModel->count() > 0) {
            return view('dashboard.grievance.show', $this->data);
        } else {
            return redirect()->route('grievances.index')->with('error','something went wrong this may be due to a ID issue..');
        }

       // return view('dashboard.country.show', compact('country'), $this->data);
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        $this->data['countryname'] = DB::table('countries')->get();
        return view('dashboard.state.edit', compact('state') ,$this->data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function updateReply(Request $request)
{
    // Find the grievance by ID
    
    $grievance = Grievance::findOrFail($request->id);

    // Validate the input
    $validated = $request->validate([
        'reply' => 'required',
        'attachment' => 'nullable|file|mimes:jpg,png,pdf,docx|max:10240', // Optional file upload validation
        'status' => 'required', // Ensure valid status
    ]);

    // Handle file upload if present
    $attachmentPath = null;
    if ($request->hasFile('attachment')) {
        // Get the uploaded file
        $attachment = $request->file('attachment');
    
        // Define the custom directory path (e.g., public/build/assets/attachments)
        $destinationPath = base_path('build/assets/uploads/attachments');
    
        // Ensure the directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true); // Create the directory if it doesn't exist
        }
    
        // Create a custom filename
        $customName = 'attachment_' . Auth::user()->id . '_' . time() . '.' . $attachment->getClientOriginalExtension();
    
        // Move the file to the custom directory
        $attachment->move($destinationPath, $customName);
    
        // Save the relative file path to the database
        $attachmentPath = 'build/assets/uploads/attachments/' . $customName;
    }
    

    // Insert reply into the grievance_replies table
    $grievanceReply = new GrievanceReply();
    $grievanceReply->grievance_id = $grievance->id; // Assuming GrievanceReply has a 'grievance_id' column
    $grievanceReply->reply = $validated['reply'];
    $grievanceReply->registrations_id = $grievance->registrations_id;
    $grievanceReply->management_id = Auth::user()->id;


    $grievanceReply->attachment = $attachmentPath;
    $grievanceReply->save();
    
    
        $lastReply = DB::table('grievance_replies')
        ->where('grievance_replies.grievance_id', $request->id)
        ->whereNull('grievance_replies.management_id') // Match condition: management_id is null
        ->orderBy('id', 'desc') // Order by id descending to get the latest record
        ->limit(1) // Limit the query to only one result
        ->first();
   
   
    if ($lastReply) {
    // Update the status field in the grievance_replies table based on the last reply's id
            DB::table('grievance_replies')
                ->where('id', $lastReply->id)
                ->update(['status' => 1]);  // Assuming the status field exists and you want to set it to 1
        }
    
                
    // Update only the status field in the grievances table
    $grievance->status = $validated['status'];
    $grievance->save();

    // Redirect back with success message
return redirect()->route('grievance.show', ['id' => $grievance->id])
                 ->with('success', 'Grievance reply added and status updated successfully');
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        //
    }

    


    public function updateStatus(Request $request)
    {
        $task = $_POST['task'];
		$id_arr = $_POST['sel_recds'];
        $update_data = array();
        if(!empty($id_arr))
        {
            $action_taken = "";
            $ids = implode(',' , $id_arr);
           
            if($task=="active")
            {
                $update_data['status'] = 1;
                $action_taken = "Activate";
            }
            if($task=="block")
            {
                $update_data['status'] = 0;
                $action_taken = "Blocked";
            }
            $update_data['updated_at'] = date("Y-m-d H:i:s");
            $update_data['updated_by'] = Auth::user()->id;
           
            $response = $this->GrievanceModel->update_operation(array('table'=>"grievances" , 'data'=>$update_data , 'condition'=>$id_arr));
           
            if($response){
                return redirect()->route('grievance.index')->with('success','Status updated successfully');
            }
            elseif($response < 0){
                return redirect()->route('grievance.index')->with('error','NO changes have been made in the form fields');
            }
            else{
                return redirect()->route('grievance.index')->with('error','There seems some error in updating announcement. Please try again');
            }
        }
       
    }


}
 