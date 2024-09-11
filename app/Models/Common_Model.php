<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use DB;
use Session;

class Common_Model extends Model
{
    use HasFactory;

	public $session_uid = '';
	public $session_name = '';
	public $session_company_profile_id = '';
	public $session_email = '';
    
	function __construct() 
	{
		if(isset(Auth::user()->id)){
			$this->session_uid = Auth::user()->id;
			$this->session_name = Auth::user()->name; 
			$this->session_company_profile_id = Auth::user()->company_profile_id; 
			$this->session_email= Auth::user()->email; 
		}

	}

    public function setTitleAttribute($title){
        $this->title = $title;
        return str_slug($this->title , "-");
    }

    public function update_operation($params = array())
	{
		if(empty($params)) return -1; 
        $status = DB::table($params['table'])->whereIn('id', $params['condition'])->update($params['data']);
		return $status;  
	}


    function getData($params = array())
	{
        $query=DB::table($params['from'])
		->select($params['select']);

        $query->where('status', $params['where']);
		
		if(!empty($params['order_by']))
		{
            $query->orderBy($params['order_by']);
		}
		$result = $query->get();
		return $result;
	}

    function add_operation($params = array())
	{
		if(empty($params)) return false;   
        $status=DB::table($params['table'])->insert($params['data']);
		if($status){$status  = DB::getPdo()->lastInsertId(); }
		return $status;   	
	}
    function delete_operation($params = array())
	{
        $status = DB::table($params['table'])->where('user_role_id', $params['where'])->delete();
		return $status;
	}

    function get_admin_user_data($params = array())
	{
		$result='';
		$query=DB::table("users as urm")
		->join('users', 'users.id', '=', 'urm.added_by', 'left')
		->join('users as u', 'u.id', '=', 'urm.user_role_id', 'left')
		->join('role_managers as ur', 'ur.id', '=', 'urm.updated_by', 'left')
        ->join('designations as d', 'd.id', '=', 'urm.designation_id', 'left')
        ->join('department_models as dm', 'dm.id', '=', 'urm.department_id', 'left')
        ->join('countries as c', 'c.id', '=', 'urm.country_id', 'left')
        ->join('states as s', 's.id', '=', 'urm.state_id', 'left')
        ->join('cities as ct', 'ct.id', '=', 'urm.city_id', 'left')
		->limit(1)
		//->select(DB::raw('count(*) as user_count, status,'))
		->select('urm.*', 'users.name as added_by_name','u.name as updated_by_name', 'c.name as country_name', 's.name as state_name','ct.name as city_name', 'd.name as designation_name','dm.name as department_name');
        $query->where("urm.id" ,  $this->session_uid);
        
		$result = $query->get();
		
        if(!empty($result))
		{
			foreach($result as $r)
			{

				$query2=DB::table("admin_user_role as aur")
				->join('role_managers as urm', 'urm.id', '=', 'aur.user_role_id', 'left')
				->join('company_profiles as cp', 'cp.id', '=', 'aur.company_profile_id', 'left')
				->select('aur.*', 'urm.name as user_role_name' , 'cp.unique_name as company_unique_name');
				$query2->where('aur.user_id',$r->id);
				$r->roles = $query2->get();			
			}
			$result = $result[0];

		}
		return $result;

	}


	function get_left_menu($params = array()){

       
		$result='';
		$query=DB::table("module_masters as mm")
		->join('module_permissions as mp', 'mm.id', '=', 'mp.module_id')
        ->join('admin_user_role as au', 'au.user_role_id', '=', 'mp.user_role_id')
		->select('mm.*','au.id as s_slug');

		$query->where("au.company_profile_id" , 1);
		$query->where("au.user_id" ,  $this->session_uid);
		$query->where("mm.is_display" ,  1);
		$query->where("mm.status" ,  1);
		$query->orderBy('mm.position', 'ASC');
           
		
		if(!empty($params['is_master']))
		{
			if($params['is_master']=="zero"){
				$query->where("mm.is_master" ,  0);
			}
			else{
				$query->where("mm.is_master" ,  $params['is_master']);
			}
		}
		
		if(!empty($params['parent_module_id']))
		{
			$query->where("mm.parent_module_id" ,  $params['parent_module_id']);
		}

		$result = $query->get();
	    
		if(!empty($result))
		{
			foreach($result as $r)
			{
				if(!empty($r->direct_db_count) && !empty($r->table_name))
				{
					
					$query1=DB::table("$r->table_name")
					->select(DB::raw('COUNT(*) as row_count'));
                     
					if(!empty($r->count_function_name))
					{
						$query1->where("$r->count_function_name");
					}
					if($r->is_company_profile_id==1)
					{
						$query1->where("company_profile_id" , $this->session_company_profile_id);
					}
					if(in_array($r->id , array(40, 41)))
					{
						if($params['data_view']==1)
						{
							
						}
						else
						{
							$query1->where("assigned_to" , $params['admin_user_id']);
						}
						
					}

					$row_count_result = $query1->get();
			
					$r->data_count = $row_count_result[0]->row_count;

				}
				$r->submenu = $this->get_left_sub_menu(array("is_master"=>"zero" , "parent_module_id"=>$r->id));
			}
		}
		//print_r($result);
		return $result;
	}

	function get_left_sub_menu($params = array()){
		$result='';

		$query=DB::table("module_masters as mm")
		->join('module_permissions as mp', 'mm.id', '=', 'mp.module_id', 'left')
        ->join('admin_user_role as au', 'mp.user_role_id', '=', 'au.user_role_id', 'left')
		->select('mm.*',);

		$query->where("au.company_profile_id" ,  $this->session_company_profile_id);
		$query->where("au.user_id" ,  $this->session_uid);
		$query->where("mm.is_display" ,  1);
		$query->where("mm.status" ,  1);
		$query->orderBy('mm.position', 'ASC');

		
		if(!empty($params['is_master']))
		{
			if($params['is_master']=="zero"){
				$query->where("mm.is_master" ,  0);
			}
			else{
				$query->where("mm.is_master" ,  $params['is_master']);
			}
		}
		
		if(!empty($params['parent_module_id']))
		{
			$query->where("mm.parent_module_id" ,  $params['parent_module_id']);
		}

		$result = $query->get();
		if(!empty($result))
		{
			foreach($result as $r)
			{
				if(!empty($r->direct_db_count) && !empty($r->table_name))
				{
					$query1=DB::table("$r->table_name")
					->select(DB::raw('COUNT(*) as row_count'));
					$row_count_result = $query1->get();
					$r->data_count = $row_count_result[0]->row_count;

				}
			}
		}
		
		return $result;
	}


	function check_user_access($params = array()){
		$result='';
		$query=DB::table("module_masters as mm")
		->join('module_permissions as mp', 'mm.id', '=', 'mp.module_id', 'left')
        ->join('admin_user_role as au', 'mp.user_role_id', '=', 'au.user_role_id', 'left')
		->select('mm.*','mp.add_module','mp.update_module','mp.export_data', 'mp.delete_module', 'mp.view_module');

		$query->where("au.company_profile_id" ,  $this->session_company_profile_id);
		$query->where("au.user_id" ,  $this->session_uid);
		//$query->where("mm.is_display" ,  1);
		$query->where("mm.status" ,  1);
		$query->where("au.status" ,  1);

		if(!empty($params['is_master']))
		{
			if($params['is_master']=="zero"){
				$query->where("mm.is_master" ,  0);
			}
			else{
				$query->where("mm.is_master" ,  $params['is_master']);
			}
		}
		
		if(!empty($params['parent_module_id']))
		{
			$query->where("mm.parent_module_id" ,  $params['parent_module_id']);
		}

		if(!empty($params['module_id']))
		{
			$query->where("mm.id" , $params['module_id']);
		}

		$result =  $query->get();

		if(!empty($result))
		{
			$result = $result[0];
		}
		return $result;
	}

}
