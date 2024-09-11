<?php

namespace App\Http\Controllers;

use App\Models\RoleManager;
use App\Models\UserRoleSettings;
use Illuminate\Http\Request;

use App\Http\Requests\RulesRoleManagerRequest;
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

class RoleManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $RoleManager;
    public function __construct()
    {   
        $this->RoleManager = new RoleManager();
        $this->data['main_routes'] = "role-manager";
        $this->data['page_module_name'] = "Role Permission";
        
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

        $this->data['master_name'] = array(
			"1"=>"Master",
			"2"=>"Company",
			"3"=>"Employee",
			"4"=>"Reports",
			"5"=>"External Share Links",
			"6"=>"Website",
			"7"=>"Update",
			"8"=>"Customer",
			"9"=>"Enquiry",
			"10"=>"NULL",
			"11"=>"NULL",
			"12"=>"NULL"
		);
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
		
		$this->data['data_listing'] = $this->RoleManager->get_data_master($search);
        $rowCount = $this->data['data_listing']->count();
		$r_count = $this->data['row_count'] = $rowCount;
	
        return view('dashboard.role-manager.index' , $this->data);

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


        $this->data['module_data'] = $this->RoleManager->getData(array('select'=>'*' , 'from'=>'module_masters' , 'where'=>'1'));
        $search = array();
        
        //$this->data['module_data'] =$this->RoleManager->get_data_master($search);
       
        return view('dashboard.role-manager.create' , $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RulesRoleManagerRequest $request)
    {
        // dd($request->post());
        // exit;

        $request_data['name']        = $request->name;
        $request_data['slug']        = $this->RoleManager->setTitleAttribute($request->name);
        $request_data['added_by']    = Auth::user()->id;
        $request_data['status']      = $request->status;
        $request_data['created_at']    = date("Y-m-d H:i:s");
        $user_role_id= $this->RoleManager->add_operation(array('table'=>'role_managers' , 'data'=>$request_data));
        if($user_role_id>0)
		{
			$this->RoleManager->delete_operation(array('table'=>'module_permissions' , 'where'=>$user_role_id));
			if(!empty($_POST['module_ids']))
			{
				$module_id_arr = $_POST['module_ids'];
				foreach($module_id_arr as $module_id)
				{
					$is_insert = false;
					$module_permission_data['module_id'] = $module_id;
					$module_permission_data['user_role_id'] = $user_role_id;
					$module_permission_data['view_module'] = 0;
					$module_permission_data['add_module'] = 0;
					$module_permission_data['update_module'] = 0;
					$module_permission_data['delete_module'] = 0;
					$module_permission_data['approval_module'] = 0;
					$module_permission_data['import_data'] = 0;
					$module_permission_data['export_data'] = 0;

                    $module_permission_data['created_at']    = date("Y-m-d H:i:s");
                    $module_permission_data['added_by']      = Auth::user()->id;
                    $module_permission_data['status']        = $request->status;  

					
					if(!empty($_POST['view_'.$module_id]))
					{ $module_permission_data['view_module'] = 1;			$is_insert = true; }

					if(!empty($_POST['add_'.$module_id]))
					{ $module_permission_data['add_module'] = 1;			$is_insert = true; }

					if(!empty($_POST['update_'.$module_id]))
					{ $module_permission_data['update_module'] = 1;			$is_insert = true; }

					if(!empty($_POST['delete_'.$module_id]))
					{ $module_permission_data['delete_module'] = 1;			$is_insert = true; }

					if(!empty($_POST['approve_'.$module_id]))
					{ $module_permission_data['approval_module'] = 1;		$is_insert = true; }

					if(!empty($_POST['import_'.$module_id]))
					{ $module_permission_data['import_data'] = 1;			$is_insert = true; }

					if(!empty($_POST['export_'.$module_id]))
					{ $module_permission_data['export_data'] = 1;			$is_insert = true; }

					if($is_insert)
					{
                         DB::table('module_permissions')->insert($module_permission_data);
					}
				}
			}
		}
        // Additional logic or redirection after successful data storage
        if($request->save =="save"){
           return redirect()->route('role-manager.index')->with('success', 'Role stored successfully!');
        }else{
            return redirect()->route('role-manager.create')->with('success', 'Role stored successfully!');
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
        $this->data['users_role_master_data']=$users_role_master_data =$this->RoleManager->get_data_master($search);
        $this->data['module_data'] = $this->RoleManager->getData(array('select'=>'*' , 'from'=>'module_masters' , 'where'=>'1'));
        $this->data['module_permission_data'] = $this->RoleManager->getModulePermissions($search);
        if($users_role_master_data->count() > 0) {
            return view('dashboard.role-manager.show', $this->data);
        } else {
            return redirect()->route('role-manager.index')->with('error','something went wrong this may be due to a ID issue..');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoleManager $roleManager)
    { 
        $id= $roleManager->id;
        $this->data['module_data'] = $this->RoleManager->getData(array('select'=>'*' , 'from'=>'module_masters' , 'where'=>'1'));
        $search= array();
        $search['id'] = $id;
        $this->data['module_permission_data'] = $this->RoleManager->getModulePermissions($search);
        return view('dashboard.role-manager.edit', compact('roleManager') ,$this->data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoleManager $roleManager)
    {
        $request->validate([
            'name' => 'required|unique:role_managers,name,'.$request->user_role_id,
            'status'          => 'required',

        ]);
        
        $user_role_id                = $request->user_role_id;
        $roleManager->name           = $request->name;
        $roleManager->slug           = $this->RoleManager->setTitleAttribute($request->name);
        $roleManager->status         = $request->status;
        $roleManager->updated_by     = Auth::user()->id;
        $roleManager->save();

        if($user_role_id>0)
		{
            
			$this->RoleManager->delete_operation(array('table'=>'module_permissions' , 'where'=>$user_role_id ));
			if(!empty($_POST['module_ids']))
			{
				$module_id_arr = $_POST['module_ids'];
                //dd($module_id_arr);
				foreach($module_id_arr as $module_id)
				{
					$is_insert = false;
					$module_permission_data['module_id'] = $module_id;
					$module_permission_data['user_role_id'] = $user_role_id;
					$module_permission_data['view_module'] = 0;
					$module_permission_data['add_module'] = 0;
					$module_permission_data['update_module'] = 0;
					$module_permission_data['delete_module'] = 0;
					$module_permission_data['approval_module'] = 0;
					$module_permission_data['import_data'] = 0;
					$module_permission_data['export_data'] = 0;

                    $module_permission_data['created_at']    = date("Y-m-d H:i:s");
                    $module_permission_data['added_by']      = Auth::user()->id;
                    $module_permission_data['status']        = $request->status;  

					
					if(!empty($_POST['view_'.$module_id]))
					{ $module_permission_data['view_module'] = 1;			$is_insert = true; }

					if(!empty($_POST['add_'.$module_id]))
					{ $module_permission_data['add_module'] = 1;			$is_insert = true; }

					if(!empty($_POST['update_'.$module_id]))
					{ $module_permission_data['update_module'] = 1;			$is_insert = true; }

					if(!empty($_POST['delete_'.$module_id]))
					{ $module_permission_data['delete_module'] = 1;			$is_insert = true; }

					if(!empty($_POST['approve_'.$module_id]))
					{ $module_permission_data['approval_module'] = 1;		$is_insert = true; }

					if(!empty($_POST['import_'.$module_id]))
					{ $module_permission_data['import_data'] = 1;			$is_insert = true; }

					if(!empty($_POST['export_'.$module_id]))
					{ $module_permission_data['export_data'] = 1;			$is_insert = true; }

					if($is_insert)
					{
                         DB::table('module_permissions')->insert($module_permission_data);
					}
				}
                // Additional logic or redirection after successful data storage
                if($request->save =="save"){
                    return redirect()->route('role-manager.index')->with('success', 'Role stored successfully!');
                }else{
                    return redirect()->route('role-manager.create')->with('success', 'Role stored successfully!');
                }
			}
            else{
                return redirect()->route('role-manager.index')->with('error','something went wrong this may be due to a ID issue..');
             }

		}
        else{
            return redirect()->route('role-manager.index')->with('error','something went wrong this may be due to a ID issue..');
         } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoleManager $roleManager)
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
            $response = $this->RoleManager->update_operation(array('table'=>"role_managers" , 'data'=>$update_data , 'condition'=>$id_arr));
           
            if($response){
                return redirect()->route('role-manager.index')->with('success','Status updated successfully');
            }
            elseif($response < 0){
                return redirect()->route('role-manager.index')->with('error','NO changes have been made in the form fields');
            }
            else{
                return redirect()->route('role-manager.index')->with('error','There seems some error in updating announcement. Please try again');
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
		
		$this->data['department'] =$this->RoleManager->get_data_master($search);
        return view('dashboard.designation.export' , $this->data);
    }

    public function setPositions()
    {
        return view('dashboard.designation.setPositions' , $this->data );
    }

    function GetCompleteCategoryList($banner_id='' , $withPosition='' , $sortByPosition='')
	{
		$search = array();
		if(!empty($_POST['banner_id'])){$banner_id = $_POST['banner_id'];}
		if(!empty($_POST['withPosition'])){$withPosition = $_POST['withPosition'];}
		if(!empty($_POST['sortByPosition'])){$sortByPosition = $_POST['sortByPosition'];}
		$search['id'] = $banner_id;
		$search['withPosition'] = $withPosition;
		$search['sortByPosition'] = $sortByPosition;
		$this->data['department'] =$this->RoleManager->get_data_master($search);
		// dd($this->data['department']);
        // exit;
		$show='';
		$count=0;
		foreach($this->data['department']as $row)
		{
			$row = (array)$row;
			$count++;
			$link = route('designation.show', ['id' => $row['id']]);
			$link1 = route('designation.edit', $row['slug']);
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
		$this->data['department'] =$this->RoleManager->get_data_master($search);
		$count=0;
		$countPos=0;
		foreach($podIdArr as $row)
		{
			$countPos++;
			$update_data['position']=$countPos;//$podIdArr[$count];
			$condition = "(id in ($podIdArr[$count]))";
            // dd($podIdArr[$count]);
            // exit;
            DB::table('role-manager')->where('id', $podIdArr[$count])->update(array('position' => $countPos,'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => Auth::user()->id ));  // update the record in the DB. 
			$count++;
		}
		$this->GetCompleteCategoryList($banner_id , 1 , 1);
	}

}
