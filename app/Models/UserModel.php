<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

use DB;
use Session;


class UserModel extends Model
{
    use HasFactory;
    
    protected $table="users";


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

    function delete_operation($params = array())
	{
        $status = DB::table($params['table'])->where('user_id', $params['where'])->delete();
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
		
		$query=DB::table("users as urm")
		->join('users', 'users.id', '=', 'urm.added_by', 'left')
		->join('users as u', 'u.id', '=', 'urm.updated_by', 'left')
        ->join('designations as d', 'd.id', '=', 'urm.designation_id', 'left')
        ->join('department_models as dm', 'dm.id', '=', 'urm.department_id', 'left')
        ->join('countries as c', 'c.id', '=', 'urm.country_id', 'left')
        ->join('states as s', 's.id', '=', 'urm.state_id', 'left')
        ->join('cities as ct', 'ct.id', '=', 'urm.city_id', 'left')
		//->select(DB::raw('count(*) as user_count, status,'))
		->select('urm.*', 'users.name as added_by_name','u.name as updated_by_name', 'c.name as country_name', 's.name as state_name','ct.name as city_name', 'd.name as designation_name','dm.name as department_name');

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
        
        if(!empty($params['slug']))	
		{
            $query->where("urm.slug" ,  $params['slug']);
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
        if(!empty($result))
		{
			if(!empty($params['details']))
			{
				foreach($result as $r)
				{

                    $query2=DB::table("admin_user_role as aur")
                    ->join('role_managers as urm', 'urm.id', '=', 'aur.user_role_id', 'left')
                    ->join('company_profiles as cp', 'cp.id', '=', 'aur.company_profile_id', 'left')
                    ->select('aur.*', 'urm.name as user_role_name' , 'cp.unique_name as company_unique_name');
                    $query2->where('aur.user_id',$r->id);
                    $r->roles = $query2->get();
		
                    $query1=DB::table("user_file as auf")
                    ->select('auf.*',);
                    $query1->where('auf.user_id',$r->id);
					$r->files = $query1->get();
					
				}
			}
			
		}
		return $result;
	}
}
