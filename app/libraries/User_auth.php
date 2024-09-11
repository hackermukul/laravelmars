<?php  
namespace App\libraries; // defines the Helpers namespace under App namespace.
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Common_Model;

use Session;
class User_auth
{
	private $CI;
	public $session_uid = '';
	public $session_name = '';
	public $session_email = '';
	function __construct() 
	{
		if(isset(Auth::user()->id)){
			$this->Common_Model = new Common_Model();
			$this->session_uid = Auth::user()->email;
			$this->session_name = Auth::user()->name; 
		}
	}

	function check_user_status()
	{
		$this->data['user_data']='';
		if($this->session_uid > 0 && !empty($this->session_name))
		{ 
            
			$this->data['user_data'] = $this->Common_Model->get_admin_user_data(array());
            
			if(!empty($this->data['user_data']))
			{
				if($this->data['user_data']->status!=1)
				{
					Session::forget('key');
                    Session::flash('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-ban"></i> You are blocked by University Management.
					</div>!');
                   //return redirect()->away('https://www.google.com')->send();

                   // return redirect()->away('http://127.0.0.1:8000/logout')->send();

				}
			}
			else
			{
               
				return redirect('/secureRegions');
			}
			
		}
		else
		{
			
			return redirect('/secureRegions');
		}

		$screen_lock = Session::get('screen_lock');
		if(!empty($screen_lock))
		{
			//REDIRECT(MAINSITE_Admin.'Screen-Lock');
		}
		
		return $this->data['user_data'];
	}
	
	function get_user_()
	{
		$this->data['user_data']='';
		
	}

	
	function get_left_menu($is_master , $params = array())
	{
		
		if(!empty($is_master))
		{
			
			$menu = $this->Common_Model->get_left_menu(array("is_master"=>$is_master, "data_view"=>$this->data['user_data']->data_view, "admin_user_id"=>$this->data['user_data']->id));
			 
	
			$display_menu="";
            

			foreach($menu as $m)
			{
				if($m->submenu->count() > 0)
				{
					$display_menu.=$this->get_main_menu_html($m , $params);
				}
				else
				{
					
					$display_menu.=$this->get_sub_menu_html($m , $params);
				}
			}

			return $display_menu;
		}
		else
		{
			return false;
		}
	}

	function get_main_menu_html($obj , $params){
		$active = "";
		$is_menu = '';
		$link = route($obj->class_name.'.index');
        
		$html ='<li class="nav-item'.$is_menu.'">
			<a href="'.$link.'" class="nav-link '.$active.'">
				<i class="nav-icon fas fa-circle"></i>
				<p>
				'.$obj->name;
		if($obj->submenu->count() > 0 ){
	      $html .='<i class="right fas fa-angle-left"></i>';
		}
		if(!empty($obj->data_count))
		{
			$html .='<span class="badge badge-info right">'.$obj->data_count.'</span>';
		}
		$html .='</p></a><ul class="nav nav-treeview">';
			foreach($obj->submenu as $s)
			{   
				$html .= $this->get_sub_menu_html($s , $params);
			}
		$html .= "</ul></li>";
		return $html;
	}

	function get_sub_menu_html($obj , $params){
		$active = "";
		if(!empty($params['page_module_id']))
		{
			if($params['page_module_id'] == $obj->module_id)
			{
				$active = "active";
			}
		}
		$link = route($obj->class_name.'.index');
		$html = '<li class="nav-item"><a href="'.$link.'" class="nav-link '.$active.'">';
		if(!empty($obj->icon))
		{
			$nav_icon = $obj->icon.'&nbsp;&nbsp;&nbsp;';
			$nav_icon = str_replace('#mainsite#' , base_url() , $nav_icon);
			$html .= $nav_icon;
		}
		else
			{$html .= '<i class="nav-icon fas fa-circle"></i>';}
		$html .= '<p>'.$obj->name; 
		if(!empty($obj->data_count))
		{
			$html .='<span class="badge badge-info right">'.$obj->data_count.'</span>';
		}
		$html .="</p></a></li>";
		return $html;
	}

	function check_user_access($params = array())
	{
		if(!empty($params))
		{
			$menu = $this->Common_Model->check_user_access($params);
			return $menu;
		}
		else
		{
			return false;
		}
	}
	
	
	function getData($params = array())
	{
		$this->CI->db->select($params['select']);
		$this->CI->db->from($params['from']);
		$this->CI->db->where("($params[where])");
		if(!empty($params['limit']))
		{
			$this->CI->db->limit($params['limit']);
		}
		if(!empty($params['order_by']))
		{
			$this->CI->db->order_by($params['order_by']);
		}
		$query_get_list = $this->CI->db->get();
		return $query_get_list->result();
	}

	function add_operation($params = array())
	{
		if(empty($params)) return false;   
		$status = $this->CI->db->insert($params['table'], $params['data']);
		if($status){$status = $status = $this->CI->db->insert_id();}
		return $status;   	
	}

    public function getFiscalYear()
    {
		$result = array();
        $start='';
        $end='';
		$s_start='';
        $s_end='';
		if (date('m') < 4) {//Upto march 
			$start=date('Y')-1;
       		$end=date('Y');
			$s_start=date('y')-1;
       		$s_end=date('y');
		} else {//form April 
			$start=date('Y');
       		$end=date('Y') + 1;
			$s_start=date('y');
       		$s_end=date('y') + 1;
		
		}

		$work_year = date('Y');
        $result['work_year'] = $work_year;
		$result['start'] = $start;
		$result['end'] = $end;
		$result['short_start'] = $s_start;
		$result['short_end'] = $s_end;
		$result['financial_year'] = $work_year;
		$result['short_financial_year'] = $s_start.'-'.$s_end;
		
        return (object)$result;
	}
	
	
}
