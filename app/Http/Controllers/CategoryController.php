<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
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


class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    // this variable is used to store authenticationModel object
    protected $Category;
    public function __construct()
    {   
        $this->categoryModel= new Category();

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
		
		$this->data['categories'] =$this->categoryModel->get_data_master($search);
        $rowCount = $this->data['categories']->count();
		$r_count = $this->data['row_count'] = $rowCount;

        $this->data['page_is_master'] = $this->data['user_access']->is_master;
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;

		// unset($search['search_for']);
        //dd(session()->all());
        // $users = DB::table('categories')
        //     ->join('users', 'users.id', '=', 'contacts.user_id')
        //     //->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('categories.*', 'users.phone', 'orders.price')
        //     ->get();
        //$categories = DB::table('categories')->get();
        //dd($students);
        //exit;
        //$categories = Category::with(subcategories)->whereNull('parent_id')->get(),
        return view('dashboard.categories.index' , $this->data);
    }

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create' , $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    { 
        // dd(request()->post());
        // exit;
        // $request->validate([
        //     'name' => 'required|max:32',
        //     'content' => 'required|content',
        //     //'message' => 'required|string|required|max:255'
        // ]);
        $Category = new Category();
        //$Category->name = $request->input('name');
        $Category->name       = $request->name;
        $Category->added_by   = Auth::user()->id;
        $Category->content    = $request->content;
        $Category->status     = $request->status;
        $Category->slug       = $this->categoryModel->setTitleAttribute($request->name);

        if($request->hasFile('cover_image')) {

            $file = $request->file('cover_image');
            //$image=$file->getClientOriginalName();
            $image = time().'.'.$file->getClientOriginalExtension();
            $destinationPath ='build/assets/uploads/';
            $file->move($destinationPath,$image);
            //echo  $destinationPath;exit();
            $Category->image = $image;
        };
        $Category->save();
        // Additional logic or redirection after successful data storage
        if($request->save =="save"){
           return redirect()->route('categories.index')->with('success', 'Category stored successfully!');
        }else{
            return redirect()->route('categories.create')->with('success', 'Category stored successfully!');
        }

        //return redirect()->back()->with('success', 'Comment stored successfully!');
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
        $this->data['categories']=$categories =$this->categoryModel->get_data_master($search);
        if( $categories->count() > 0) {
            return view('dashboard.categories.show', $this->data);
        } else {
            return redirect()->route('categories.index')->with('error','something went wrong this may be due to a ID issue..');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category') ,$this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            //'name'          => ['required', 'unique:categories'],
            'content'     => ['sometimes', 'nullable'],
        ]);
        
        $category->name           = $request->name;
        $category->content        = $request->content;
        $category->slug           = $this->categoryModel->setTitleAttribute($request->name);
        $category->status         = $request->status;
        $category->updated_at     = date("Y-m-d");
        $category->updated_by     = Auth::user()->id;

        if ($request->hasFile('cover_image')) {
            $oldFileName    = $category->image;
            $image_path ='build/assets/uploads/'.$oldFileName;
            if (File::exists($image_path)) {
                //File::delete($image_path);
               // unlink($image_path);
            }
            $file = $request->file('cover_image');
            //$image=$file->getClientOriginalName();
            $image = time().'.'.$file->getClientOriginalExtension();
            $destinationPath ='build/assets/uploads/';
            $file->move($destinationPath,$image);
            //echo  $destinationPath;exit();
            $category->image = $image;
            //File::delete(storage_path('app/public/images/' . $oldFileName));
        };
        $category->status         = $request->status;
        $category->updated_at     = date("Y-m-d");
        $category->updated_by     = Auth::user()->id;
        $category->save();
        if($request->save =="save"){
            return redirect()->route('categories.index')->with('success', 'Category succesfully updated!');
        }else{
             return redirect()->route('categories.create')->with('success', 'Category succesfully updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
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
            $response = $this->categoryModel->update_operation(array('table'=>"categories" , 'data'=>$update_data , 'condition'=>$id_arr));
           
            if($response){
                return redirect()->route('categories.index')->with('success','categories Status updated successfully');
            }
            elseif($response < 0){
                return redirect()->route('categories.index')->with('error','NO changes have been made in the form fields');
            }
            else{
                return redirect()->route('categories.index')->with('error','There seems some error in updating announcement. Please try again');
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
		
		$this->data['categories'] =$this->categoryModel->get_data_master($search);
        return view('dashboard.categories.export' , $this->data);
    }

    public function setPositions()
    {
        return view('dashboard.categories.setPositions' , $this->data );
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
		$this->data['categories'] =$this->categoryModel->get_data_master($search);
		// dd($this->data['categories']);
        // exit;
		$show='';
		$count=0;
		foreach($this->data['categories']as $row)
		{
			$row = (array)$row;
			$count++;
			$link = route('categories.show', ['id' => $row['id']]);
			$link1 = route('categories.edit', $row['slug']);
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
		$this->data['categories'] =$this->categoryModel->get_data_master($search);
		$count=0;
		$countPos=0;
		foreach($podIdArr as $row)
		{
			$countPos++;
			$update_data['position']=$countPos;//$podIdArr[$count];
			$condition = "(id in ($podIdArr[$count]))";
            // dd($podIdArr[$count]);
            // exit;
            DB::table('categories')->where('id', $podIdArr[$count])->update(array('position' => $countPos,'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => Auth::user()->id ));  // update the record in the DB. 
			$count++;
		}
		$this->GetCompleteCategoryList($banner_id , 1 , 1);
	}



}
