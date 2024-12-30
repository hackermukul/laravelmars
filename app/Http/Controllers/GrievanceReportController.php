<?php


namespace App\Http\Controllers;

use App\Models\City;
use App\Models\GrievanceReport;
use Illuminate\Http\Request;

use App\Http\Requests\StoreCityRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Validator;

use Intervention\Image\Facades\Image as Image;

use DB;
use Session;

use App\libraries\FunctionModel;
use App\libraries\User_auth;



class GrievanceReportController extends Controller
{
    

    public function __construct()
    {
        $this->City= new City();
        $this->GrievanceReport= new GrievanceReport();
        $this->data['main_routes'] = "grievance_report";
        $this->data['page_module_name'] = "GrievanceM Committee Controller";   
		
		$this->data['master'] =  new FunctionModel();
		$this->data['module_master'] = $module_master=$this->data['master']->getModule_details();

        $this->data['User_auth_obj'] = new User_auth();
		$this->data['user_data'] = $this->data['User_auth_obj']->check_user_status();
        	  
		if($this->data['module_master']->count() > 0)
		{
			$this->data['module_id'] = $this->data['module_master'][0]->id;
			$this->data['module_table'] = $this->data['module_master'][0]->table_name;
			$this->data['page_module_name'] = $this->data['module_master'][0]->name;
		}
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
		$department = '';
		$field_value = '';
		$end_date = '';
		$start_date = '';
		$record_status="";

		if(!empty($_REQUEST['department']))
			$department = $_POST['department'];
		else if(!empty($department))	
			$department = $department;
			
		
		if(!empty($_POST['end_date']))
			$end_date = $_POST['end_date'];
		
	    if(!empty($_POST['start_date']))
			$start_date = $_POST['start_date'];
        // dd($start_date);
        // exit;
			 
		if(!empty($_POST['record_status']))
			$record_status = $_POST['record_status'];
				 
		$this->data['department'] = $department;
		
		$this->data['end_date'] = $end_date;
		$this->data['start_date'] = $start_date;
		$this->data['record_status'] = $record_status;
		
		$search['end_date'] = $end_date;
		$search['start_date'] = $start_date;
		$search['department'] = $department;
		$search['record_status'] = $record_status;
        //dd($record_status);
		//$search['search_for'] = "count";
		
		$this->data['data_listing'] =$this->GrievanceReport->get_data_master($search);
        if(!empty($department)){
           
            return view('dashboard.committee_report.export' , $this->data);
        }
        $rowCount = $this->data['data_listing']->count();
		$r_count = $this->data['row_count'] = $rowCount;
        
         
        $this->data['department_models'] = DB::table('department_models')->get();
        
        if($user->id == 1){
            $this->data['grievance_replies'] = DB::table('grievances')->get();
         }else{
 
 
             $this->data['grievance_replies'] = DB::table('grievances')
             ->where('grievances.related_to', '=', $user->department_id) // Filter by user's department_id
             ->select('grievances.*',) // Select relevant columns from both tables
             ->get();
         
 
         }

        return view('dashboard.committee_report.index' , $this->data);
    }


    public function chat()
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
		$grievance = '';
		$field_value = '';
		$end_date = '';
		$start_date = '';
		$record_status="";

		if(!empty($_REQUEST['grievance']))
			$grievance = $_POST['grievance'];
		else if(!empty($grievance))	
			$grievance = $grievance;
			
		
		if(!empty($_POST['end_date']))
			$end_date = $_POST['end_date'];
		
	    if(!empty($_POST['start_date']))
			$start_date = $_POST['start_date'];
        // dd($start_date);
        // exit;
			 
		if(!empty($_POST['record_status']))
			$record_status = $_POST['record_status'];
				 
		$this->data['grievance'] = $grievance;
		
		$this->data['end_date'] = $end_date;
		$this->data['start_date'] = $start_date;
		$this->data['record_status'] = $record_status;
		
		$search['end_date'] = $end_date;
		$search['start_date'] = $start_date;
		$search['grievance'] = $grievance;
		$search['record_status'] = $record_status;
        $search['super_to'] = $user->id;

        //dd($record_status);
		//$search['search_for'] = "count";
		
		$this->data['data_listing'] =$this->GrievanceReport->get_data_master_grievance($search);
        if(!empty($grievance)){
            return view('dashboard.committee_report.chat' , $this->data);
        }

        
        $rowCount = $this->data['data_listing']->count();
		$r_count = $this->data['row_count'] = $rowCount;

        $this->data['department_models'] = DB::table('department_models')->get();

	
        if($user->id == 1){
            $this->data['grievance_replies'] = DB::table('grievances')->get();
         }else{
 
 
             $this->data['grievance_replies'] = DB::table('grievances')
             ->where('grievances.related_to', '=', $user->department_id) // Filter by user's department_id
             ->select('grievances.*',) // Select relevant columns from both tables
             ->get();
         
 
         }

        return view('dashboard.committee_report.index' , $this->data);
    }


}
