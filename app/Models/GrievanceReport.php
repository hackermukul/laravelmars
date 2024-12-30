<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use DB;
use Session;
class GrievanceReport extends Model
{
    use HasFactory;

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

    function get_data_master($params = array())
{
    $query = DB::table("grievances as urm")
        ->join('users', 'users.id', '=', 'urm.added_by', 'left')
        ->join('users as u', 'u.id', '=', 'urm.updated_by', 'left')
        ->join('department_models as c', 'c.id', '=', 'urm.related_to', 'left')
        ->join('registrations as r', 'r.id', '=', 'urm.registrations_id', 'left')
        ->select('urm.*', 'users.name as added_by_name', 'u.name as updated_by_name', 'r.name as customer_name','c.name as realted_to');

    // If search parameter is present, count the results
    if (!empty($params['search_for'])) {
        return DB::table("grievances as urm")
            ->join('users', 'users.id', '=', 'urm.added_by', 'left')
            ->join('users as u', 'u.id', '=', 'urm.updated_by', 'left')
            ->join('department_models as c', 'c.id', '=', 'urm.related_to', 'left')
            ->join('registrations as r', 'r.id', '=', 'urm.registrations_id', 'left')
            ->where($params['field_name'], 'like', '%' . $params['search_for'] . '%')
            ->count('urm.id');
    }

    // Sorting logic
    if (!empty($params['sortByPosition'])) {
        $query->orderBy('urm.position', 'ASC');
    } elseif (!empty($params['order_by'])) {
        $query->orderBy($params['order_by']);
    } else {
        $query->orderBy('urm.id', 'desc');
    }

    // Filter by ID
    if (!empty($params['id'])) {
        $query->where("urm.id", $params['id']);
    }

    // if (!empty($params['related_to'])) {
    //         if ($params['super_to'] != 1) {
    //             $query->where("urm.related_to", $params['related_to']);
    //         }
    // }

    if (!empty($params['department'])) {
        $query->where("urm.related_to", $params['department']);
    }


    // Filter by start date
    if (!empty($params['start_date'])) {
        $startDate = Carbon::createFromFormat('Y-m-d', $params['start_date'])->startOfDay();
        $query->where('created_at', '>=', $startDate);
    }

    // Filter by end date
    if (!empty($params['end_date'])) {
        $endDate = Carbon::createFromFormat('Y-m-d', $params['end_date'])->endOfDay();
        $query->where('created_at', '<=', $endDate);
    }

    // Filter by record status
    if (!empty($params['record_status'])) {
        if ($params['record_status'] == 'zero') {
            $query->where('urm.status', 0);
        } else {
            $query->where("urm.status", $params['record_status']);
        }
    }

    
    // Return the result of the query
    return $query->get();
}



function get_data_master_grievance($params = array())
{
    // Base query setup
    $query = DB::table("grievance_replies as urm")
        ->join('grievances as g', 'g.id', '=', 'urm.grievance_id', 'left')
        ->join('users', 'users.id', '=', 'urm.added_by', 'left')
        ->join('users as u', 'u.id', '=', 'urm.updated_by', 'left')
        ->join('department_models as c', 'c.id', '=', 'g.related_to', 'left')
        ->join('registrations as r', 'r.id', '=', 'g.registrations_id', 'left')
        ->select('urm.*', 'users.name as added_by_name', 'u.name as updated_by_name', 'r.name as customer_name', 'c.name as related_to','g.subject as subject','g.status as sts');

    // If search parameter is present, apply the where condition
    

    // Sorting logic
    if (!empty($params['sortByPosition'])) {
        $query->orderBy('urm.position', 'ASC');
    } elseif (!empty($params['order_by'])) {
        $query->orderBy($params['order_by']);
    } else {
        $query->orderBy('urm.id', 'desc');
    }

    // Filter by ID
    if (!empty($params['id'])) {
        $query->where("urm.id", $params['id']);
    }

    // Filter by grievance ID
    if (!empty($params['grievance'])) {
        $query->where("g.id", $params['grievance']);
    }

    // Filter by start date
    if (!empty($params['start_date'])) {
        $startDate = Carbon::createFromFormat('Y-m-d', $params['start_date'])->startOfDay();
        $query->where('created_at', '>=', $startDate);
    }

    // Filter by end date
    if (!empty($params['end_date'])) {
        $endDate = Carbon::createFromFormat('Y-m-d', $params['end_date'])->endOfDay();
        $query->where('created_at', '<=', $endDate);
    }

    // Filter by record status
    if (!empty($params['record_status'])) {
        if ($params['record_status'] == 'zero') {
            $query->where('urm.status', 0);
        } else {
            $query->where("urm.status", $params['record_status']);
        }
    }

    // If 'count' is requested, return count of records
    if (!empty($params['count']) && $params['count'] == true) {
        return $query->count('urm.id');
    }

    // Return the result of the query
    return $query->get();
}






}
