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


abstract class Controller
{
    protected $commonModel;
    public function __construct()
    {   
        $this->categoryModel= new Category();
        $this->commonModel= new Common_Model();

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
    
    function get_header()
	{
		
	}

    function get_left_nav()
	{
		$page_is_master = "";
		$page_parent_module_id = "";
		$page_module_id = "";

		if(!empty($this->data['page_is_master'])){
			$page_is_master = $this->data['page_is_master'];
		}

		if(!empty($this->data['page_parent_module_id'])){
			$page_parent_module_id = $this->data['page_parent_module_id'];
		}

		if(!empty($this->data['page_module_id'])){
			$page_module_id = $this->data['page_module_id'];
		}

		$params_arr = array(
			"page_is_master"=>$page_is_master ,
			"page_parent_module_id"=>$page_parent_module_id ,
			"page_module_id"=>$page_module_id
		);

		$this->data['left_menu_master'] = $this->data['User_auth_obj']->get_left_menu( 1 , $params_arr);
		$this->data['left_menu_employee'] = $this->data['User_auth_obj']->get_left_menu( 2 , $params_arr);
		$this->data['left_menu_company_profile'] = $this->data['User_auth_obj']->get_left_menu( 3 , $params_arr);
		$this->data['banner_menu'] = $this->data['User_auth_obj']->get_left_menu( 6, $params_arr);
		$this->data['processes_menu'] = $this->data['User_auth_obj']->get_left_menu( 7 , $params_arr);

        return view('dashboard.inc.left_nav', $this->data);
	}

	function get_footer()
	{
		//$this->load->view('admin_view/inc/footer', $this->data);
	}


}
