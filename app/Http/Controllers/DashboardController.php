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

		if($this->data['module_master']->count() > 0)
		{
			$this->data['module_id'] = $this->data['module_master'][0]->id;
			$this->data['module_table'] = $this->data['module_master'][0]->table_name;
			$this->data['page_module_name'] = $this->data['module_master'][0]->name;
		}

    }

    public function dashboard()
    {
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
