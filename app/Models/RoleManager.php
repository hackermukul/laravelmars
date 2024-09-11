<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use DB;
use Session;

class RoleManager extends Model
{
    use HasFactory;

    public function setTitleAttribute($title){
        $this->title = $title;
        return str_slug($this->title , "-");
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


    public function update_operation($params = array())
	{
		if(empty($params)) return -1; 
        $status = DB::table($params['table'])->whereIn('id', $params['condition'])->update($params['data']);
		return $status;  
	}

    function get_data_master($params = array())
	{
		$result='';
		if(!empty($params['search_for']))
		{
			DB::select("count(urm.id) as counts");
		}
		else
		{
		 //$query->select('urm.*');
		}
		
		$query=DB::table("role_managers as urm")
		->join('users', 'users.id', '=', 'urm.added_by', 'left')
		->join('users as u', 'u.id', '=', 'urm.updated_by', 'left')
		->select('urm.*', 'users.name as added_by_name','u.name as updated_by_name');

		if(!empty($params['sortByPosition']))
		{ 
			$query->orderBy('urm.position', 'ASC');
			
		}
		else if(!empty($params['order_by'])){
			$query->orderBy($params['order_by']);
		}
		else { 
			$query->orderBy('urm.position', 'desc');
		}
        //$query->orderBy("urm.id desc");
		if(!empty($params['id']))	
		{
            $query->where("urm.id" ,  $params['id']);
		}

		if(!empty($params['start_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['start_date']));
            $startDate = Carbon::createFromFormat('Y-m-d', $temp_date)->startOfDay();
			$query->where('created_at', '>=', $startDate);
		}
		
		if(!empty($params['end_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['end_date']));
            $endDate = Carbon::createFromFormat('Y-m-d', $temp_date)->endOfDay();
			$query->where('created_at', '<=', $endDate);
		}

		if(!empty($params['record_status']))
		{
			if($params['record_status']=='zero')
			{
				$query->where('urm.status',0);
			}
			else
			{
				$query->where("urm.status" ,  $params['record_status']);
			}
		}
		if(!empty($params['field_value']) && !empty($params['field_name']))
		{
            $query->where($params['field_name'], 'like', '%' . $params['field_value'] . '%');
		}
		$result = $query->get();
		return $result;
	}
    

    function getModulePermissions($params = array())
	{
		$result='';
		if(!empty($params['search_for']))
		{
			DB::select("count(urm.id) as counts");
		}
		else
		{
		 //$query->select('urm.*');
		}
		
		$query=DB::table("module_permissions as urm")
		->join('users', 'users.id', '=', 'urm.added_by', 'left')
		->join('users as u', 'u.id', '=', 'urm.updated_by', 'left')
		->select('urm.*', 'users.name as added_by_name','u.name as updated_by_name');

		if(!empty($params['sortByPosition']))
		{ 
			$query->orderBy('urm.position', 'ASC');
			
		}
		
        //$query->orderBy("urm.id desc");
		if(!empty($params['id']))	
		{
            $query->where("urm.user_role_id" ,  $params['id']);
		}

		if(!empty($params['start_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['start_date']));
            $startDate = Carbon::createFromFormat('Y-m-d', $temp_date)->startOfDay();
			$query->where('created_at', '>=', $startDate);
		}
		
		if(!empty($params['end_date']))
		{
			$temp_date = date('Y-m-d' , strtotime($params['end_date']));
            $endDate = Carbon::createFromFormat('Y-m-d', $temp_date)->endOfDay();
			$query->where('created_at', '<=', $endDate);
		}

		if(!empty($params['record_status']))
		{
			if($params['record_status']=='zero')
			{
				$query->where('urm.status',0);
			}
			else
			{
				$query->where("urm.status" ,  $params['record_status']);
			}
		}
		if(!empty($params['field_value']) && !empty($params['field_name']))
		{
            $query->where($params['field_name'], 'like', '%' . $params['field_value'] . '%');
		}
		$result = $query->get();
		return $result;
	}



}
