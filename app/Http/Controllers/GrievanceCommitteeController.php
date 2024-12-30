<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\GrievanceCommittee;
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



class GrievanceCommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->City= new City();
        $this->GrievanceCommittee= new GrievanceCommittee();
        $this->data['main_routes'] = "grievance_committees";
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
		
		$this->data['data_listing'] =$this->GrievanceCommittee->get_data_master($search);
        $rowCount = $this->data['data_listing']->count();
		$r_count = $this->data['row_count'] = $rowCount;
	
        return view('dashboard.committee.index' , $this->data);
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
        $this->data['statename'] = DB::table('states')->get();
        return view('dashboard.committee.create' , $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the input fields
    $validatedData = $request->validate([
        'name' => 'required|string|max:255', // Validate name
        'email' => 'required|email|unique:grievance_committees,email', // Validate unique email
        'designation' => 'required|string|max:255', // Validate designation
        'grievance_related_to' => 'nullable|string|max:255', // Optional field for grievance
        'contact' => 'required|digits_between:10,15', // Validate contact number (10-15 digits)
        'status' => 'required|boolean', // Validate status as 1 or 0
    ], [
        // Custom error messages
        'name.required' => 'The name field is required.',
        'email.required' => 'The email field is required.',
        'email.email' => 'The email must be a valid email address.',
        'email.unique' => 'The email has already been taken.',
        'designation.required' => 'The designation field is required.',
        'contact.required' => 'The contact field is required.',
        'contact.digits_between' => 'The contact number must be between 10 and 15 digits.',
        'status.required' => 'The status field is required.',
    ]);

    // Save data to GrievanceCommittee model
    $this->GrievanceCommittee->name = $validatedData['name'];
    $this->GrievanceCommittee->email = $validatedData['email'];
    $this->GrievanceCommittee->designation = $validatedData['designation'];
    $this->GrievanceCommittee->grievance_related_to = $validatedData['grievance_related_to'] ?? null;
    $this->GrievanceCommittee->contact = $validatedData['contact'];
    $this->GrievanceCommittee->status = $validatedData['status'];
    $this->GrievanceCommittee->slug           = $this->GrievanceCommittee->setTitleAttribute($request->name);

    $this->GrievanceCommittee->added_by = Auth::user()->id;

    // Save the record
    $this->GrievanceCommittee->save();

    // Redirect based on button clicked
    if ($request->save == "save") {
        return redirect()->route('grievance_committees.index')->with('success', 'Grievance Committee record saved successfully!');
    } else {
        return redirect()->route('grievance_committees.create')->with('success', 'Grievance Committee record saved successfully!');
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
        $this->data['view_data']=$GrievanceCommittee = $this->GrievanceCommittee->get_data_master($search);
        if( $GrievanceCommittee->count() > 0) {
            return view('dashboard.committee.show', $this->data);
        } else {
            return redirect()->route('grievance_committees.index')->with('error','something went wrong this may be due to a ID issue..');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GrievanceCommittee $grievance_committees)
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
        return view('dashboard.committee.edit', compact('grievance_committees') ,$this->data);

    }

    /**
     * Update the specified resource in storage.
     */


     public function update(Request $request, GrievanceCommittee $grievance)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'designation' => 'required|string|max:255',
        'grievance_related_to' => 'nullable|string|max:255',
        'contact' => 'required|digits_between:10,15',
        'status' => 'required|in:0,1',
    ], [
        'name.required' => 'Please provide a valid name.',
        'email.required' => 'Please provide an email address.', 
        'email.email' => 'The email must be a valid format.',
        'designation.required' => 'Designation is required.',
        'contact.required' => 'Please provide a contact number.',
        'contact.digits_between' => 'Contact number must be between 10 and 15 digits.',
        'status.required' => 'Please select a valid status.',
    ]);

    // Perform the raw SQL update query
    DB::table('grievance_committees')
        ->where('id', $request->department_id)
        ->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'designation' => $validatedData['designation'],
            'grievance_related_to' => $validatedData['grievance_related_to'] ?? null,
            'contact' => $validatedData['contact'],
            'status' => $validatedData['status'],
            'slug' => $grievance->setTitleAttribute($validatedData['name']),
            'updated_by' => Auth::id(),
            'updated_at' => now(), // Automatically set the updated_at field
        ]);
		//$this->GrievanceCommittee->update_operation(array('table'=>'grievance_committees','condition'=>"id="))

		

    // Redirect based on button action
    $route = $request->save === "save" 
        ? route('grievance_committees.index') 
        : route('grievance_committees.create');

    return redirect($route)->with('success', 'Grievance Committee record updated successfully!');
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
            $response = $this->City->update_operation(array('table'=>"grievance_committees" , 'data'=>$update_data , 'condition'=>$id_arr));
           
            if($response){
                return redirect()->route('grievance_committees.index')->with('success','Status updated successfully');
            }
            elseif($response < 0){
                return redirect()->route('grievance_committees.index')->with('error','NO changes have been made in the form fields');
            }
            else{
                return redirect()->route('grievance_committees.index')->with('error','There seems some error in updating announcement. Please try again');
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
		
		$this->data['department'] =$this->grievance_committees->get_data_master($search);
        return view('dashboard.committee.export' , $this->data);
    }

    public function setPositions()
    {
        return view('dashboard.committee.setPositions' , $this->data );
    }

    function GetCompleteCountryList($banner_id='' , $withPosition='' , $sortByPosition='')
	{
		$search = array();
		if(!empty($_POST['banner_id'])){$banner_id = $_POST['banner_id'];}
		if(!empty($_POST['withPosition'])){$withPosition = $_POST['withPosition'];}
		if(!empty($_POST['sortByPosition'])){$sortByPosition = $_POST['sortByPosition'];}
		$search['id'] = $banner_id;
		$search['withPosition'] = $withPosition;
		$search['sortByPosition'] = $sortByPosition;
		$this->data['department'] =$this->grievance_committees->get_data_master($search);
		// dd($this->data['department']);
        // exit;
		$show='';
		$count=0;
		foreach($this->data['department']as $row)
		{
			$row = (array)$row;
			$count++;
			$link = route('country.show', ['id' => $row['id']]);
			$link1 = route('country.edit', $row['slug']);
			if($row['updated_at'] !='0000-00-00 00:00:00'){$updated_on= date('d-m-Y', strtotime($row['updated_at']));}else{$updated_on='N/A';}
			if($row['name'] ==''){$row['name'];}
			$show.="<tr id='$row[id]'>";
			$show.="<td>$count</td>";
			$show.="<td><label class='custom-control custom-checkbox'><input type='checkbox' class='custom-control-input' name='selectedRecords[]' id='selectedRecords$count' value='$row[id]'><span class='custom-control-indicator'></span></label></td>";
			$show.="<td>$row[name]</td>";
			$show.="<td>$row[slug]</td>";
			if($withPosition==1)
			{
				$show.='<td><span style="cursor: move;" class="fa fa-arrows-alt" ></span> '.$row['position'].'</td>';
			}
			if($row['status']){$show.="<td class='nodrag' align='center'><i class='fa fa-check true-icon'></i><span style='display:none'>Publish</span></td>";}
					else{$show.="<td align='center'><i class='fa fa-close false-icon'></i><span style='display:none'>Un Publish</span></td>";}
			$show.="<td>".date('d-m-Y', strtotime($row['created_at']))."</td>";
			$show.="<td>$updated_on</td>";
			$show.="<td><a class='btn btn-primary' href='$link' style='padding:1px 5px;'><i class='fa fa-eye'></i></a>
			<a class='btn btn-info' href='$link1' style='padding:1px 5px;'><i class='fa fa-edit'></i></a></td>";
			$show.='</tr>';
		}
		echo $show;
	}


    function GetCompleteCategoryListNewPos()
	{
		$search = array();
		$banner_id = '';
		$podId = '';
		$podIdArr = '';
		if(!empty($_POST['banner_id']))
			$banner_id = $_POST['banner_id'];
		if(!empty($_POST['podId']))
		{
			$podId = trim($_POST['podId'] , ',');
			$podIdArr = explode(',' , $podId);
		}
		$this->data['id'] = $banner_id;
		$this->data['podId'] = $podIdArr;
        // dd($podIdArr);
        // exit;
		$search['id'] = $banner_id;
		$search['podId'] = $podIdArr;
		//$search['search_for'] = "count";
		$show = "No Record To Display";
		$this->data['department'] =$this->grievance_committees->get_data_master($search);
		$count=0;
		$countPos=0;
		foreach($podIdArr as $row)
		{
			$countPos++;
			$update_data['position']=$countPos;//$podIdArr[$count];
			$condition = "(id in ($podIdArr[$count]))";
            // dd($podIdArr[$count]);
            // exit;
            DB::table('citys')->where('id', $podIdArr[$count])->update(array('position' => $countPos,'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => Auth::user()->id ));  // update the record in the DB. 
			$count++;
		}
		$this->GetCompleteCountryList($banner_id , 1 , 1);
	}

    public function getState()
	{
		$state_id = $country_id ='0'; 
		if(!empty($_POST['country_id'])){ $country_id = $_POST['country_id']; }
		if(!empty($_POST['state_id'])){ $state_id = $_POST['state_id']; }
            
		$state_data = $this->City->getData(array('select'=>'*' , 'from'=>'states' , 'where'=>"$country_id" , "field"=>"country_id"));
		
        $result = '<option value="">Select State</option>';
		if(!empty($state_data))
		{
			foreach($state_data as $r)
			{
				$if_block = $selected = '';
				if($r->id == $state_id){ $selected = "selected"; }
				if($r->status!=1){$if_block= " [Block]";}
				$result .= '<option value="'.$r->id.'" '.$selected.'>'.$r->name.$if_block.'</option>';
			}
		}
		echo json_encode(array("state_html"=>$result , "state_json"=>$state_data));
	}
	

	// function getCity()
	// {
	// 	$state_id = $city_id ='0'; 
	// 	if(!empty($_POST['city_id'])){ $city_id = $_POST['city_id']; }
	// 	if(!empty($_POST['state_id'])){ $state_id = $_POST['state_id']; }

	// 	$city_data = $this->Common_Model->getData(array('select'=>'*' , 'from'=>'city' , 'where'=>"state_id = $state_id" , "order_by"=>"city_name ASC"));
	// 	$result = '<option value="">Select City</option>';
	// 	if(!empty($city_data))
	// 	{
	// 		foreach($city_data as $r)
	// 		{
	// 			$if_block = $selected = '';
	// 			if($r->city_id == $city_id){ $selected = "selected"; }
	// 			if($r->status!=1){$if_block= " [Block]";}
	// 			$result .= '<option value="'.$r->city_id.'" '.$selected.'>'.$r->city_name.$if_block.'</option>';
	// 		}
	// 	}
	// 	echo json_encode(array("city_html"=>$result , "city_json"=>$city_data));
	// }
	
    
}

