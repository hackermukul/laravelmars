<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Common_Model;


use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;

use DB;
use Session;
use App\libraries\FunctionModel;
use App\libraries\User_auth;
use App\Models\GrievanceModel;




class DashboardController extends Controller
{
    protected $layout = 'layouts.app';

    protected $Category;
    public function __construct()
    {   
        $this->categoryModel= new Category();
        $this->commonModel= new Common_Model();

        $this->data['page_module_name'] = "Category";

        $this->data['master'] =  new FunctionModel();
		$this->data['module_master'] = $module_master=$this->data['master']->getModule_details();

        $this->data['User_auth_obj'] = new User_auth();
		$this->data['user_data'] = $this->data['User_auth_obj']->check_user_status();
        $this->GrievanceModel= new GrievanceModel();


		if($this->data['module_master']->count() > 0)
		{
			$this->data['module_id'] = $this->data['module_master'][0]->id;
			$this->data['module_table'] = $this->data['module_master'][0]->table_name;
			$this->data['page_module_name'] = $this->data['module_master'][0]->name;
            $this->data['main_routes'] = $this->data['module_master'][0]->class_name;

		}

    }

    public function dashboard()
    {
        $user = Auth::user();
        $search['related_to'] = $user->department_id;
        $search['super_to'] = $user->id;
    
        if($user->id == 1){
            $this->data['data_listing'] = $this->data['replies'] = DB::table('grievance_replies')
                ->join('grievances', 'grievances.id', '=', 'grievance_replies.grievance_id')
                ->join('department_models', 'grievances.related_to', '=', 'department_models.id')
                ->join('registrations', 'registrations.id', '=', 'grievances.registrations_id')
                ->select('grievance_replies.*', 'department_models.name as related_to', 'grievances.subject as subject', 'grievances.status as sts',  'registrations.name as customer_name', 'grievances.id as g_id', 'department_models.name as realted_to')
                ->orderBy('grievance_replies.created_at', 'desc')  // Order by created_at in descending order
                ->take(7)  // Get the last 4 records
                ->get();
        } else {
            $this->data['data_listing'] = $this->data['replies'] = DB::table('grievance_replies')
                ->join('grievances', 'grievances.id', '=', 'grievance_replies.grievance_id')
                 ->join('registrations', 'registrations.id', '=', 'grievances.registrations_id')
                ->join('department_models', 'grievances.related_to', '=', 'department_models.id')
                ->where('grievances.related_to', $user->department_id)
                ->select('grievance_replies.*', 'department_models.name as related_to', 'grievances.subject as subject', 'grievances.status as sts',  'registrations.name as customer_name', 'grievances.id as g_id', 'department_models.name as realted_to')
                ->orderBy('grievance_replies.created_at', 'desc')  // Order by created_at in descending order
                ->take(7)  // Get the last 4 records
                ->get();
        }
    
        return view('dashboard.index', $this->data);
    }
    

    public function logout()
    {
        return view('dashboard.logout');
    }
    public function access_denied()
    {
        return view('dashboard.access_denied');
    }
}
