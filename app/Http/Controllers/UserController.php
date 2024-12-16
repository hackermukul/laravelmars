<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Helpers\MyFuncs;
use App\libraries\FunctionModel;


///use App\Models\User;

use Illuminate\Http\Request;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Validator;

use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;


use Intervention\Image\Facades\Image as Image;

use DB;
use Session;
use App\libraries\User_auth;

 

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->UserModel= new UserModel();
        $this->data['main_routes'] = "employee";
        $this->data['page_module_name'] = "User";
		//$statusList = MyFuncs::getStatusesList();
		$this->MyFuncs = new MyFuncs();

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
        $search['details'] = 1;
        //dd($record_status);
		//$search['search_for'] = "count";
		
		$this->data['data_listing'] = $this->UserModel->get_data_master($search);
       
        
        $rowCount = $this->data['data_listing']->count();
		$r_count = $this->data['row_count'] = $rowCount;
	                

        return view('dashboard.employee.index' , $this->data);
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
        $this->data['role_managers'] = DB::table('role_managers')->get();
        $this->data['designations'] = DB::table('designations')->get();
        $this->data['countryname'] = DB::table('countries')->get();
        $this->data['statename'] = DB::table('states')->get();
        $this->data['cityname'] = DB::table('cities')->get();
        $this->data['department_models'] = DB::table('department_models')->get();
        $this->data['company_profiles'] = DB::table('company_profiles')->get();
        return view('dashboard.employee.create' , $this->data);
    }
    /**
     * Store a newly created resource in storage.
     */
    //<option value="{{ $version->id }}" {{ old('version_id', $apps->version_id) == $version->id ? 'selected' : null}}>{{ $version->name }}</option>

    public function store(StoreUserRequest $request)
    {  

        

        $enter_data['admin_access'] = trim($_POST['admin_access']);
		$enter_data['email'] = $_POST['email'];
		$enter_data['show_password'] = $_POST['password'];
		$enter_data['password'] = Hash::make($_POST['password']);
		$enter_data['first_name'] = trim($_POST['name']);
        $enter_data['name'] = trim($_POST['name']);
		$enter_data['mobile_no'] = trim($_POST['mobile_no']);
		$enter_data['country_id'] = $request->country_id;
		$enter_data['state_id'] = $request->state_id;
		$enter_data['city_id'] = $request->city_id;
		$enter_data['name'] = $request->name;;
		$enter_data['status'] = $request->status; 
		$enter_data['designation_id'] = $_POST['designation_id'];
		$enter_data['department_id'] = $_POST['department_id'];
		$enter_data['joining_date'] = date("Y-m-d" , strtotime($_POST['joining_date']));
		if(!empty($_POST['termination_date']))
		$enter_data['termination_date'] = date("Y-m-d" , strtotime($_POST['termination_date']));
        
		$enter_data['user_role_id'] = $_POST['user_role_id'][0];
		$enter_data['approval_access'] = $_POST['approval_access'];
		$enter_data['data_view'] = $_POST['data_view'];
		$enter_data['created_at'] = date("Y-m-d H:i:s");
        $enter_data['slug'] = $this->UserModel->setTitleAttribute($request->name);
		$enter_data['added_by'] = Auth::user()->id;

        $insertStatus  =DB::table('users')->insert($enter_data);
        $admin_user_id= $insertStatus = DB::getPdo()->lastInsertId();
        if($insertStatus>0)
		{
			$user_role_id_arr = $_POST['user_role_id'];
			$company_profile_id_arr = $_POST['company_profile_id'];
			$this->upload_employee_file($admin_user_id);
		
			if(!empty($user_role_id_arr) && !empty($company_profile_id_arr))
			{
                $this->UserModel->delete_operation(array('table'=>'admin_user_role' , 'where'=>$admin_user_id ));
				for($i = 0 ; $i < count($user_role_id_arr) ; $i++)
				{
					if(!empty($user_role_id_arr))
					{
						$admin_user_role_data['user_id'] = $admin_user_id;
						$admin_user_role_data['user_role_id'] = $user_role_id_arr[$i];
						$admin_user_role_data['company_profile_id'] = $company_profile_id_arr[$i];
                        $admin_user_role_data['status'] = 1;
                        $admin_user_role_data['added_by'] = Auth::user()->id;
                        $admin_user_role_data['created_at'] = date("Y-m-d H:i:s");
                        DB::table('admin_user_role')->insert($admin_user_role_data);
					}
				}
			}
			
		}
        
        // Additional logic or redirection after successful data storage
        if($request->save =="save"){
           return redirect()->route('employee.index')->with('success', 'employee stored successfully!');
        }else{
            return redirect()->route('employee.create')>with('success', 'employee stored successfully!');
        }
    }

    function upload_employee_file($admin_user_id)
	{
		$logo_file_name = "";
		$count=0;
		if(!empty($_FILES["file"]['name'])){
			if (!is_dir('build/assets/uploads/employee_file')) {
				mkdir('./build/assets/uploads/employee_file', 0777, TRUE);
			}
			
		$file_title = $_POST['file_title'];
		//echo count($_FILES["file"]['name']);
			for($i=0 ; $i< count($_FILES["file"]['name']) ; $i++){
				if(isset($_FILES["file"]['name'][$i]) && !empty($_FILES["file"]['name'][$i])){
					$count++;
					$timg_name = $_FILES['file']['name'][$i];
					$temp_var = explode(".",strtolower($timg_name));
					$timage_ext = end($temp_var);
					$timage_name_new = $temp_var[0].'_'.$admin_user_id.'_'.$count.".".$timage_ext; 
					$img_data['file_title'] = $file_title[$i];
					$img_data['user_id'] = $admin_user_id;
					$img_data['file_name'] = $timage_name_new;
                    $img_data['status'] = 1;
                    $img_data['added_by'] = Auth::user()->id;
                    $img_data['created_at'] = date("Y-m-d H:i:s");
                    $imginsertStatus=DB::table('user_file')->insert($img_data);
					if($imginsertStatus > 0){
						move_uploaded_file ($_FILES['file']['tmp_name'][$i],"build/assets/uploads/employee_file/".$timage_name_new);
						$logo_file_name = $timage_name_new;
					}
				} 
			}
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
        $search= array();
        $search['id'] = $id;
        $search['details'] = 1;
        $this->data['data_view']=$data_view =$this->UserModel->get_data_master($search);
        if( $data_view->count() > 0) {
            
            return view('dashboard.employee.show', $this->data);
        } else {
            return redirect()->route('employee.index')->with('error','something went wrong this may be due to a ID issue..');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
		$this->data['page_module_id'] = $this->data['module_id'];
		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
    
		if(empty($this->data['user_access']))
		{
            return redirect()->route('dashboard.access-denied');
		}
        $search= array();
        $this->data['role_managers'] = DB::table('role_managers')->get();
        $this->data['designations'] = DB::table('designations')->get();
        $this->data['countryname'] = DB::table('countries')->get();
        $this->data['statename'] = DB::table('states')->get();
        $this->data['cityname'] = DB::table('cities')->get();
        $this->data['department_models'] = DB::table('department_models')->get();
        $this->data['company_profiles'] = DB::table('company_profiles')->get();
        $search['slug'] = $slug;
        $this->data['data_view'] ="";
        $data_view =$this->UserModel->get_data_master($search);
        if(!empty($data_view)){
            $this->data['data_view']= $data_view[0];
            return view('dashboard.employee.edit',$this->data);
        } 
        else{
            return redirect()->route('employee.index')->with('error','There seems some error in updating announcement. Please try again');
        }
        
       
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserModel $userModel)
    {
		
        $request->validate([
            'user_role_id' => 'required|not_in:-- Choose User Role --',
            'designation_id' => 'required|not_in:-- Choose designation --',
            'department_id' => 'required|not_in:-- Choose department --',
            'country_id'  =>'required|max:200',
            'email' => 'required|unique:users,email,'.$request->id,
            'password' => 'required|string|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'mobile_no' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
            'status'          => 'required',
        ]);
        
        $id =$admin_user_id= trim($_POST['id']);
        $enter_data = array();
        $enter_data['admin_access'] = trim($_POST['admin_access']);
		$enter_data['email'] = $_POST['email'];
		$enter_data['show_password'] = $_POST['password'];
		$enter_data['password'] = Hash::make($_POST['password']);
		$enter_data['first_name'] = trim($_POST['name']);
        $enter_data['name'] = trim($_POST['name']);
		$enter_data['mobile_no'] = trim($_POST['mobile_no']);
		$enter_data['country_id'] = $request->country_id;
		$enter_data['state_id'] = $request->state_id;
		$enter_data['city_id'] = $request->city_id;
		$enter_data['name'] = $request->name;;
		$enter_data['status'] = $request->status; 
		$enter_data['designation_id'] = $_POST['designation_id'];
		$enter_data['department_id'] = $_POST['department_id'];
		$enter_data['joining_date'] = date("Y-m-d" , strtotime($_POST['joining_date']));
		if(!empty($_POST['termination_date']))
		$enter_data['termination_date'] = date("Y-m-d" , strtotime($_POST['termination_date']));

		$enter_data['user_role_id'] = $_POST['user_role_id'][0];
		$enter_data['approval_access'] = $_POST['approval_access'];
		$enter_data['data_view'] = $_POST['data_view'];
		$enter_data['updated_at'] = date("Y-m-d H:i:s");
        $enter_data['slug'] = $this->UserModel->setTitleAttribute($request->name);
		$enter_data['updated_by'] = Auth::user()->id;
        
        if($request->id == ""){
            return redirect()->route('employee.index')->with('error','something went wrong this may be due to a ID issue..');
        }

        $insertStatus = DB::table('users')->where('id', $id)->update($enter_data);  

       
        if($insertStatus>0)
		{
			$user_role_id_arr = $_POST['user_role_id'];
			$company_profile_id_arr = $_POST['company_profile_id'];
			$this->upload_employee_file($admin_user_id);
		
			if(!empty($user_role_id_arr) && !empty($company_profile_id_arr))
			{
                $this->UserModel->delete_operation(array('table'=>'admin_user_role' , 'where'=>$admin_user_id ));
				for($i = 0 ; $i < count($user_role_id_arr) ; $i++)
				{
					if(!empty($user_role_id_arr))
					{
                        
						$admin_user_role_data['user_id'] = $admin_user_id;
						$admin_user_role_data['user_role_id'] = $user_role_id_arr[$i];
						$admin_user_role_data['company_profile_id'] = $company_profile_id_arr[$i];
                        $admin_user_role_data['status'] = 1;
                        $admin_user_role_data['added_by'] = Auth::user()->id;
                        $admin_user_role_data['created_at'] = date("Y-m-d H:i:s");
                        DB::table('admin_user_role')->insert($admin_user_role_data);
					}
				}
			}
			
		}
        
        // Additional logic or redirection after successful data storage
        return $request->save === "save"
        ? redirect()->route('employee.index')->with('success', 'Employee updated successfully!')
        : redirect()->route('employee.create')->with('success', 'Employee updated successfully!');
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserModel $userModel)
    {
        //
    }

    public function addNewFileLine()
	{
        $this->data['append_id']="";
		if(!empty($_POST['append_id']))
		{
			$this->data['append_id'] = $_POST['append_id'];
		}
      
        //$scores = DB::table('scores')->select('teamname', 'score')->get();
        $template = view('dashboard.employee.file_line_add_more', $this->data )->render();
       
        return response()->json(['succes' => true, 'template' => $template]);
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
            $response = $this->UserModel->update_operation(array('table'=>"users" , 'data'=>$update_data , 'condition'=>$id_arr));
           
            if($response){
                return redirect()->route('employee.index')->with('success','Status updated successfully');
            }
            elseif($response < 0){
                return redirect()->route('employee.index')->with('error','NO changes have been made in the form fields');
            }
            else{
                return redirect()->route('employee.index')->with('error','There seems some error in updating announcement. Please try again');
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
		
		$this->data['department'] =$this->UserModel->get_data_master($search);
        return view('dashboard.employee.export' , $this->data);
    }

    public function setPositions()
    {
        return view('dashboard.employee.setPositions' , $this->data );
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
		$this->data['department'] =$this->UserModel->get_data_master($search);
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
		$this->data['department'] =$this->UserModel->get_data_master($search);
		$count=0;
		$countPos=0;
		foreach($podIdArr as $row)
		{
			$countPos++;
			$update_data['position']=$countPos;//$podIdArr[$count];
			$condition = "(id in ($podIdArr[$count]))";
            // dd($podIdArr[$count]);
            // exit;
            DB::table('states')->where('id', $podIdArr[$count])->update(array('position' => $countPos,'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => Auth::user()->id ));  // update the record in the DB. 
			$count++;
		}
		$this->GetCompleteCountryList($banner_id , 1 , 1);
	}
    
}
