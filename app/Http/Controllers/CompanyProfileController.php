<?php

namespace App\Http\Controllers;

use App\Models\company\CompanyProfile;
use Illuminate\Http\Request;

use App\Http\Requests\RulescompanyRequest;
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


class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $CompanyProfile;
    public function __construct()
    {   
        $this->CompanyProfile= new CompanyProfile();
        $this->data['main_routes'] = "company";
        $this->data['page_module_name'] = "Company Profile";

        $this->data['master'] =  new FunctionModel();
		$this->data['module_master'] = $module_master=$this->data['master']->getModule_details();

        $this->data['User_auth_obj'] = new User_auth();
		$this->data['user_data'] = $this->data['User_auth_obj']->check_user_status();
        	  
		if($this->data['module_master']->count() > 0)
		{
			$this->data['module_id'] = $this->data['module_master'][0]->id;
			$this->data['module_table'] = $this->data['module_master'][0]->table_name;
			$this->data['page_module_name'] = $this->data['module_master'][0]->name;
            $this->data['page_is_master'] = $this->data['module_master'][0]->is_master;
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
		
		$search['end_date'] = $end_date;
		$search['start_date'] = $start_date;
		$search['field_value'] = $field_value;
		$search['field_name'] = $field_name;
		$search['record_status'] = $record_status;
        //dd($record_status);
		//$search['search_for'] = "count";
		
		$this->data['data_listing'] =$this->CompanyProfile->get_data_master($search);
        $rowCount = $this->data['data_listing']->count();
		$r_count = $this->data['row_count'] = $rowCount;
	
        return view('dashboard.company.index' , $this->data);

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


        return view('dashboard.company.create' , $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * php artisan make:request RulescompanyRequest
     */
    public function store(RulescompanyRequest $request)
    {
        $this->CompanyProfile->name       = $request->name;
        $this->CompanyProfile->slug       = $this->CompanyProfile->setTitleAttribute($request->name);
        $this->CompanyProfile->added_by   = Auth::user()->id;
        $this->CompanyProfile->status     = $request->status;
        $this->CompanyProfile->save();
        // Additional logic or redirection after successful data storage
        if($request->save =="save"){
           return redirect()->route('company.index')->with('success', 'company stored successfully!');
        }else{
            return redirect()->route('company.create')>with('success', 'company stored successfully!');
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
        $this->data['data_view']=$data_view =$this->CompanyProfile->get_data_master($search);
        if( $data_view->count() > 0) {
            return view('dashboard.company.show', $this->data);
        } else {
            return redirect()->route('company.index')->with('error','something went wrong this may be due to a ID issue..');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyProfile $companyProfile)
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
        $this->data['statename'] = DB::table('states')->get();
        $this->data['cityname'] = DB::table('cities')->get();

        return view('dashboard.company.edit', compact('companyProfile') ,$this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyProfile $companyProfile)
    {
        $request->validate([
            'name' => 'required|unique:company_profiles,name,'.$request->department_id,
            'email' => 'required|unique:company_profiles,email,'.$request->department_id,
            'status'          => 'required',
        ]);

        $companyProfile->name           = $request->name;
        $companyProfile->slug           = $this->CompanyProfile->setTitleAttribute($request->name);
        $companyProfile->unique_name    = $request->unique_name;
        $companyProfile->website        = $request->website;
        $companyProfile->email          = $request->email;
        $companyProfile->first_name     = $request->first_name;
        $companyProfile->last_name      = $request->last_name;
        $companyProfile->mobile_no      = $request->mobile_no;
        $companyProfile->alt_mobile_no  = $request->alt_mobile_no;
        $companyProfile->short_description    = $request->description;
        $companyProfile->address1       = $request->address1;
        $companyProfile->pincode        = $request->pincode;
        $companyProfile->country_id     = $request->country_id;
        $companyProfile->state_id       = $request->state_id;
        $companyProfile->city_id        = $request->city_id;
        $companyProfile->header_color   = $request->header_color;
        $companyProfile->footer_color   = $request->footer_color;
        $companyProfile->status         = $request->status;
        $companyProfile->updated_by     = Auth::user()->id;
        $companyProfile->save();
        if($request->save =="save"){
            return redirect()->route('company.index')->with('success', 'company succesfully updated!');
        }else{
             return redirect()->route('company.create')->with('success', 'company succesfully updated!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(company $company)
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
            $response = $this->CompanyProfile->update_operation(array('table'=>"company_profiles" , 'data'=>$update_data , 'condition'=>$id_arr));
           
            if($response){
                return redirect()->route('company.index')->with('success','Status updated successfully');
            }
            elseif($response < 0){
                return redirect()->route('company.index')->with('error','NO changes have been made in the form fields');
            }
            else{
                return redirect()->route('company.index')->with('error','There seems some error in updating announcement. Please try again');
            }
        }
       
    }

    public function export_excel()
    { 

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
		
		$search['end_date'] = $end_date;
		$search['start_date'] = $start_date;
		$search['field_value'] = $field_value;
		$search['field_name'] = $field_name;
		$search['record_status'] = $record_status;
        //dd($record_status);
		//$search['search_for'] = "count";
		
		$this->data['department'] =$this->CompanyProfile->get_data_master($search);
        return view('dashboard.company.export' , $this->data);
    }

    public function getCity()
	{
		$state_id = $city_id ='0'; 
		if(!empty($_POST['city_id'])){ $city_id = $_POST['city_id']; }
		if(!empty($_POST['state_id'])){ $state_id = $_POST['state_id']; }
            
		$state_data = $this->CompanyProfile->getData(array('select'=>'*' , 'from'=>'cities' , 'where'=>"$state_id" , "field"=>"state_id"));
		
        $result = '<option value="">Select State</option>';
		if(!empty($state_data))
		{
			foreach($state_data as $r)
			{
				$if_block = $selected = '';
				if($r->id == $city_id){ $selected = "selected"; }
				if($r->status!=1){$if_block= " [Block]";}
				$result .= '<option value="'.$r->id.'" '.$selected.'>'.$r->name.$if_block.'</option>';
			}
		}
		echo json_encode(array("state_html"=>$result , "state_json"=>$state_data));
	}


}