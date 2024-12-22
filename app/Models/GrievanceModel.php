<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

use DB;
use Session;



class GrievanceModel extends Model
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
        ->select('urm.*', 'users.name as added_by_name', 'u.name as updated_by_name', 'r.name as customer_name');

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

    if (!empty($params['related_to'])) {
        $query->where("urm.related_to", $params['related_to']);
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

    // Filter by field value and name
    if (!empty($params['field_value']) && !empty($params['field_name'])) {
        $query->where($params['field_name'], 'like', '%' . $params['field_value'] . '%');
    }

    // Return the result of the query
    return $query->get();
}


}
