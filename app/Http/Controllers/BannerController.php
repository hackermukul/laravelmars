<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BannerModel;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;

use DB;
use Session;
use App\libraries\FunctionModel;
use App\libraries\User_auth;


class BannerController extends Controller
{
    protected $BannerModel ;
    public function __construct()
    {   
        $this->BannerModel= new BannerModel();

        $this->data['page_module_name'] = "Banner";
        $this->data['main_routes'] = "banner_module";

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
		
		$this->data['banner'] =$this->BannerModel->get_data_master($search);
        $rowCount = $this->data['banner']->count();
		$r_count = $this->data['row_count'] = $rowCount;

        $this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

		
        return view('dashboard.banner.index' , $this->data);
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.banner.create' , $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'name'    => 'required|string|max:255',
        'content' => 'nullable|string',
        'status'  => 'required|boolean',
        'banner'  => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048', // Adjust file types and size as needed
    ]);

    // Instantiate the BannerModel
    $BannerModel = new BannerModel();

    // Assign values to the model properties
    $BannerModel->name      = $request->name;
    $BannerModel->added_by  = Auth::user()->id;
    $BannerModel->title1    = $request->content;
    $BannerModel->status    = $request->status;
    $BannerModel->slug      = $BannerModel->setTitleAttribute($request->name);

    // Handle file upload if a banner is provided
    if ($request->hasFile('banner')) {
        $document = $request->file('banner');
        $destinationPath = base_path('build/assets/uploads/banner');

        // Ensure the directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true); // Create the directory
        }

        // Create a custom filename
        $customName = 'banner_' . Auth::id() . '_' . time() . '.' . $document->getClientOriginalExtension();

        // Move the file to the custom directory
        $document->move($destinationPath, $customName);

        // Save the relative file path to the database
        $BannerModel->image = 'build/assets/uploads/banner/' . $customName;
    }

    // Save the model to the database
    $BannerModel->save();

    // Redirect based on the action
    if ($request->save == "save") {
        return redirect()->route('banner_module.index')->with('success', 'Banner stored successfully!');
    } else {
        return redirect()->route('banner_module.create')->with('success', 'Banner stored successfully!');
    }
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->data['page_module_id'] = $this->data['module_id'];
		$this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id"=>$this->data['page_module_id']));
        $this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;
      

		if(empty($this->data['user_access']))
		{
            return redirect()->route('dashboard.access-denied');
		}

        $search= array();
        $search['id'] = $id;
        $this->data['banner']=$banner =$this->BannerModel->get_data_master($search);
        if( $banner->count() > 0) {
            return view('dashboard.banner.show', $this->data);
        } else {
            return redirect()->route('banner_module.index')->with('error','something went wrong this may be due to a ID issue..');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        // Get the first URI segment
        $uriSegment = $request->segment(3);
        
        // Fetch the banner data based on the URI segment
        $banner = BannerModel::where('slug', $uriSegment)->first();
    
        // Check if the banner exists
        if (!$banner) {
            return redirect()->route('banner_module.index')->with('error', 'Banner not found!');
        }
    
        // Pass the banner data to the view
        $this->data['bannermodel']  = $banner;
    
        return view('dashboard.banner.edit', $this->data);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BannerModel $BannerModel)
{
    // Prepare the data for the update
    
    $data = [
        'name' => $request->name,
        'title1' => $request->content,
        'slug' => Str::slug($request->name, '-'), // Generate slug from name
        'status' => $request->status,
        'updated_at' => now(), // Set current timestamp
        'updated_by' => Auth::id(), // Set updated_by to the logged-in user's ID
    ];

    // Handle file upload if a new banner image is provided
    if ($request->hasFile('banner')) {
        $document = $request->file('banner');
        $destinationPath = base_path('build/assets/uploads/banner');

        // Ensure the directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true); // Create the directory
        }

        // Create a custom filename
        $customName = 'banner_' . Auth::id() . '_' . time() . '.' . $document->getClientOriginalExtension();

        // Move the file to the custom directory
        $document->move($destinationPath, $customName);

        // Add the file path to the data array
        $data['image'] = 'build/assets/uploads/banner/' . $customName;
    }

    // Perform the update query manually using the update() method
    $status = DB::table('banners')
        ->where('id', $request->id) // Ensure we update the correct record based on the id
        ->update($data);

    // Check if the update was successful
    if ($status) {
        if ($request->save == "save") {
            return redirect()->route('banner_module.index')->with('success', 'Banner successfully updated!');
        } else {
            return redirect()->route('banner_module.create')->with('success', 'Banner successfully updated!');
        }
    } else {
        return redirect()->route('banner_module.edit', $BannerModel->id)->with('error', 'Failed to update banner!');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $BannerModel )
    {
        //
    }

     /**
     * Remove the specified resource from storage.
     */
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
            $response = $this->BannerModel->update_operation(array('table'=>"banner" , 'data'=>$update_data , 'condition'=>$id_arr));
           
            if($response){
                return redirect()->route('banner.index')->with('success','banner Status updated successfully');
            }
            elseif($response < 0){
                return redirect()->route('banner.index')->with('error','NO changes have been made in the form fields');
            }
            else{
                return redirect()->route('banner.index')->with('error','There seems some error in updating announcement. Please try again');
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
		
		$this->data['banner'] =$this->BannerModel->get_data_master($search);
        return view('dashboard.banner.export' , $this->data);
    }

    public function setPositions()
    {
        return view('dashboard.banner.setPositions' , $this->data );
    }

    function GetCompleteCategoryList($banner_id='' , $withPosition='' , $sortByPosition='')
	{
		$search = array();
		if(!empty($_POST['banner_id'])){$banner_id = $_POST['banner_id'];}
		if(!empty($_POST['withPosition'])){$withPosition = $_POST['withPosition'];}
		if(!empty($_POST['sortByPosition'])){$sortByPosition = $_POST['sortByPosition'];}
		$search['id'] = $banner_id;
		$search['withPosition'] = $withPosition;
		$search['sortByPosition'] = $sortByPosition;
		$this->data['banner'] =$this->BannerModel->get_data_master($search);
		// dd($this->data['banner']);
        // exit;
		$show='';
		$count=0;
		foreach($this->data['banner']as $row)
		{
			$row = (array)$row;
			$count++;
			$link = route('banner.show', ['id' => $row['id']]);
			$link1 = route('banner.edit', $row['slug']);
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
		$this->data['banner'] =$this->BannerModel->get_data_master($search);
		$count=0;
		$countPos=0;
		foreach($podIdArr as $row)
		{
			$countPos++;
			$update_data['position']=$countPos;//$podIdArr[$count];
			$condition = "(id in ($podIdArr[$count]))";
            // dd($podIdArr[$count]);
            // exit;
            DB::table('banner')->where('id', $podIdArr[$count])->update(array('position' => $countPos,'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => Auth::user()->id ));  // update the record in the DB. 
			$count++;
		}
		$this->GetCompleteCategoryList($banner_id , 1 , 1);
	}



}
