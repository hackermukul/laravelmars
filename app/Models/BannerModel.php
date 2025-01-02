<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Carbon\Carbon;

use DB;
use Session;
class BannerModel extends Model
{
    use HasFactory;

    protected $table = "banners";
    protected $fillable = ['name', 'added_by', 'title1', 'status', 'slug', 'image'];

    public function setTitleAttribute($title){
        $this->title = $title;
        return str_slug($this->title , "-");
    }

    public function update_operation($params = array())
    {
        if (empty($params)) return -1;
        return DB::table($params['table'])->whereIn('id', $params['condition'])->update($params['data']);
    }

    public function get_data_master($params = array())
    {
        $query = DB::table("banners as urm")
            ->leftJoin('users', 'users.id', '=', 'urm.added_by')
            ->leftJoin('users as u', 'u.id', '=', 'urm.updated_by')
            ->select('urm.*', 'users.name as added_by_name', 'u.name as updated_by_name');

        if (!empty($params['sortByPosition'])) {
            $query->orderBy('urm.position', 'ASC');
        } elseif (!empty($params['order_by'])) {
            $query->orderBy($params['order_by']);
        } else {
            $query->orderBy('urm.position', 'DESC');
        }

        if (!empty($params['id'])) {
            $query->where("urm.id", $params['id']);
        }

        if (!empty($params['start_date'])) {
            $query->where('created_at', '>=', Carbon::parse($params['start_date'])->startOfDay());
        }

        if (!empty($params['end_date'])) {
            $query->where('created_at', '<=', Carbon::parse($params['end_date'])->endOfDay());
        }

        if (!empty($params['record_status'])) {
            $query->where('urm.status', $params['record_status'] === 'zero' ? 0 : $params['record_status']);
        }

        if (!empty($params['field_value']) && !empty($params['field_name'])) {
            $query->where($params['field_name'], 'like', '%' . $params['field_value'] . '%');
        }

        return $query->get();
    }
}
