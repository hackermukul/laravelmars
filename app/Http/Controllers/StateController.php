<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

use App\Http\Requests\StoreStateRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Validator;

use Intervention\Image\Facades\Image as Image;

use DB;
use Session;

use App\libraries\FunctionModel;
use App\libraries\User_auth;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->State= new State();
        $this->data['main_routes'] = "state";
        $this->data['page_module_name'] = "State";
        
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
       //return $this->middleware('auth')->only(['index']);
       
    }
    public function index()
    {

        $this->data['page_module_id'] = $this->data['module_id'];
		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
    
		if(empty($this->data['user_access']))
		{
            return redirect()->route('dashboard.access-denied');
		}
        $this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

        $search = array();
		$field_name = '';
		$field_value = '';
		$end_date = '';
		$start_date = '';
		$record_status="";

		if(!empty($_REQUEST['field_name']))
			$field_name = $_POST['field_name'];
		else if(!empty($field_name))	
			$field_name = $field_name;
			
		if(!empty($_REQUEST['field_value']))
			$field_value = $_POST['field_value'];
		else if(!empty($field_value))	
			$field_value = $field_value;
			
		if(!empty($_POST['end_date']))
			$end_date = $_POST['end_date'];
		
	    if(!empty($_POST['start_date']))
			$start_date = $_POST['start_date'];
        // dd($start_date);
        // exit;
			 
		if(!empty($_POST['record_status']))
			$record_status = $_POST['record_status'];
				 
		$this->data['field_name'] = $field_name;
		$this->data['field_value'] = $field_value;
		$this->data['end_date'] = $end_date;
		$this->data['start_date'] = $start_date;
		$this->data['record_status'] = $record_status;
		
		$search['end_date'] = $end_date;
		$search['start_date'] = $start_date;
		$search['field_value'] = $field_value;
		$search['field_name'] = $field_name;
		$search['record_status'] = $record_status;
        //dd($record_status);
		//$search['search_for'] = "count";
		
		$this->data['data_listing'] =$this->State->get_data_master($search);
        $rowCount = $this->data['data_listing']->count();
		$r_count = $this->data['row_count'] = $rowCount;
	
        return view('dashboard.state.index' , $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['page_module_id'] = $this->data['module_id'];
		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
    
		if(empty($this->data['user_access']))
		{
            return redirect()->route('dashboard.access-denied');
		}
        $this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;


        $this->data['countryname'] = DB::table('countries')->get();
        return view('dashboard.state.create' , $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStateRequest $request)
    {
       
        $this->State->name       = $request->name;
        $this->State->country_id = $request->country_id;
        $this->State->slug       = $this->State->setTitleAttribute($request->name);
        $this->State->added_by   = Auth::user()->id;
        $this->State->status     = $request->status;
        $this->State->save();
        // Additional logic or redirection after successful data storage
        if($request->save =="save"){
           return redirect()->route('state.index')->with('success', 'state stored successfully!');
        }else{
            return redirect()->route('state.create')->with('success', 'state stored successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->data['page_module_id'] = $this->data['module_id'];
		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
    
		if(empty($this->data['user_access']))
		{
            return redirect()->route('dashboard.access-denied');
		}
        $this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

        
        $search= array();
        $search['id'] = $id;
        $this->data['view_data']=$state = $this->State->get_data_master($search);
        if( $state->count() > 0) {
            return view('dashboard.state.show', $this->data);
        } else {
            return redirect()->route('state.index')->with('error','something went wrong this may be due to a ID issue..');
        }

       // return view('dashboard.country.show', compact('country'), $this->data);
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        $this->data['countryname'] = DB::table('countries')->get();
        return view('dashboard.state.edit', compact('state') ,$this->data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $state)
    {
        $request->validate([
            'name' => 'required|unique:states,name,'.$request->department_id,
            'status'          => 'required',
            //'state_code'          => 'required',

        ]);
      
        $state->name           = $request->name;
        $state->country_id = $request->country_id;
        $state->slug           = $this->State->setTitleAttribute($request->name);
        $state->status         = $request->status;
        $state->updated_by     = Auth::user()->id;
        $state->save();
        if($request->save =="save"){
            return redirect()->route('state.index')->with('success', 'state succesfully updated!');
        }else{
             return redirect()->route('state.create')->with('success', 'state succesfully updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        //
    }



    public function updateStatus(Request $request)
    {
        $task = $_POST['task'];
		$id_arr = $_POST['sel_recds'];
        $update_data = array();
        if(!empty($id_arr))
        {
            $action_taken = "";
            $ids = implode(',' , $id_arr);
           
            if($task=="active")
            {
                $update_data['status'] = 1;
                $action_taken = "Activate";
            }
            if($task=="block")
            {
                $update_data['status'] = 0;
                $action_taken = "Blocked";
            }
            $update_data['updated_at'] = date("Y-m-d H:i:s");
            $update_data['updated_by'] = Auth::user()->id;
            $response = $this->State->update_operation(array('table'=>"states" , 'data'=>$update_data , 'condition'=>$id_arr));
           
            if($response){
                return redirect()->route('state.index')->with('success','Status updated successfully');
            }
            elseif($response < 0){
                return redirect()->route('state.index')->with('error','NO changes have been made in the form fields');
            }
            else{
                return redirect()->route('state.index')->with('error','There seems some error in updating announcement. Please try again');
            }
        }
       
    }

    public function export_excel()
    { 

        $search = array();
		$field_name = '';
		$field_value = '';
		$end_date = '';
		$start_date = '';
		$record_status="";

		if(!empty($_REQUEST['field_name']))
			$field_name = $_POST['field_name'];
		else if(!empty($field_name))	
			$field_name = $field_name;
			
		if(!empty($_REQUEST['field_value']))
			$field_value = $_POST['field_value'];
		else if(!empty($field_value))	
			$field_value = $field_value;
			
		if(!empty($_POST['end_date']))
			$end_date = $_POST['end_date'];
		
	    if(!empty($_POST['start_date']))
			$start_date = $_POST['start_date'];
        // dd($start_date);
        // exit;
			 
		if(!empty($_POST['record_status']))
			$record_status = $_POST['record_status'];
				 
		
		$this->data['field_name'] = $field_name;
		$this->data['field_value'] = $field_value;
		$this->data['end_date'] = $end_date;
		$this->data['start_date'] = $start_date;
		$this->data['record_status'] = $record_status;
		
		$search['end_date'] = $end_date;
		$search['start_date'] = $start_date;
		$search['field_value'] = $field_value;
		$search['field_name'] = $field_name;
		$search['record_status'] = $record_status;
        //dd($record_status);
		//$search['search_for'] = "count";
		
		$this->data['department'] =$this->State->get_data_master($search);
        return view('dashboard.state.export' , $this->data);
    }

    public function setPositions()
    {
        return view('dashboard.state.setPositions' , $this->data );
    }

    function GetCompleteCountryList($banner_id='' , $withPosition='' , $sortByPosition='')
	{
		$search = array();
		if(!empty($_POST['banner_id'])){$banner_id = $_POST['banner_id'];}
		if(!empty($_POST['withPosition'])){$withPosition = $_POST['withPosition'];}
		if(!empty($_POST['sortByPosition'])){$sortByPosition = $_POST['sortByPosition'];}
		$search['id'] = $banner_id;
		$search['withPosition'] = $withPosition;
		$search['sortByPosition'] = $sortByPosition;
		$this->data['department'] =$this->State->get_data_master($search);
		// dd($this->data['department']);
        // exit;
		$show='';
		$count=0;
		foreach($this->data['department']as $row)
		{
			$row = (array)$row;
			$count++;
			$link = route('country.show', ['id' => $row['id']]);
			$link1 = route('country.edit', $row['slug']);
			if($row['updated_at'] !='0000-00-00 00:00:00'){$updated_on= date('d-m-Y', strtotime($row['updated_at']));}else{$updated_on='N/A';}
			if($row['name'] ==''){$row['name'];}
			$show.="<tr id='$row[id]'>";
			$show.="<td>$count</td>";
			$show.="<td><label class='custom-control custom-checkbox'><input type='checkbox' class='custom-control-input' name='selectedRecords[]' id='selectedRecords$count' value='$row[id]'><span class='custom-control-indicator'></span></label></td>";
			$show.="<td>$row[name]</td>";
			$show.="<td>$row[slug]</td>";
			if($withPosition==1)
			{
				$show.='<td><span style="cursor: move;" class="fa fa-arrows-alt" ></span> '.$row['position'].'</td>';
			}
			if($row['status']){$show.="<td class='nodrag' align='center'><i class='fa fa-check true-icon'></i><span style='display:none'>Publish</span></td>";}
					else{$show.="<td align='center'><i class='fa fa-close false-icon'></i><span style='display:none'>Un Publish</span></td>";}
			$show.="<td>".date('d-m-Y', strtotime($row['created_at']))."</td>";
			$show.="<td>$updated_on</td>";
			$show.="<td><a class='btn btn-primary' href='$link' style='padding:1px 5px;'><i class='fa fa-eye'></i></a>
			<a class='btn btn-info' href='$link1' style='padding:1px 5px;'><i class='fa fa-edit'></i></a></td>";
			$show.='</tr>';
		}
		echo $show;
	}


    function GetCompleteCategoryListNewPos()
	{
		$search = array();
		$banner_id = '';
		$podId = '';
		$podIdArr = '';
		if(!empty($_POST['banner_id']))
			$banner_id = $_POST['banner_id'];
		if(!empty($_POST['podId']))
		{
			$podId = trim($_POST['podId'] , ',');
			$podIdArr = explode(',' , $podId);
		}
		$this->data['id'] = $banner_id;
		$this->data['podId'] = $podIdArr;
        // dd($podIdArr);
        // exit;
		$search['id'] = $banner_id;
		$search['podId'] = $podIdArr;
		//$search['search_for'] = "count";
		$show = "No Record To Display";
		$this->data['department'] =$this->State->get_data_master($search);
		$count=0;
		$countPos=0;
		foreach($podIdArr as $row)
		{
			$countPos++;
			$update_data['position']=$countPos;//$podIdArr[$count];
			$condition = "(id in ($podIdArr[$count]))";
            // dd($podIdArr[$count]);
            // exit;
            DB::table('states')->where('id', $podIdArr[$count])->update(array('position' => $countPos,'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => Auth::user()->id ));  // update the record in the DB. 
			$count++;
		}
		$this->GetCompleteCountryList($banner_id , 1 , 1);
	}
    
}

