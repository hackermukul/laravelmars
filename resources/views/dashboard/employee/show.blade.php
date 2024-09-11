<x-app-layout>
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">@if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif </h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="">Home</a></li>
               <li class="breadcrumb-item"><a href="{{ route($main_routes.'.index') }}">  @if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif  List</a></li>
               <li class="breadcrumb-item">Add New Record</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<section class="content">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">@if($data_view[0]->name) {{ $data_view[0]->name}} @else {{'N/A'}} @endif</h3>
               <div class="float-right">
               @if($user_access->add_module==1)	
                       <a href="{{ route($main_routes.'.create') }}"> 
                  <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add
                  New</button></a>
                        @endif
                   @if($user_access->update_module==1)
                  <a href="{{ route($main_routes.'.edit', $data_view[0]->slug) }}"> 
                  <button type="button" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Update</button>
                  </a>
                  @endif
                  
               </div>
            </div>
            <!-- /.card-header -->
               @if($user_access->view_module==1)
             <div class="card-body card-primary card-outline">
                    <form action="" name="ptype_list_form" method="post" class="form-horizontal" role="form">
                        <input type="hidden" name="task" id="task" value="" />

                        <table id="" class="table table-bordered table-hover myviewtable responsiveTableNewDesign">
                            <tbody>
                                <tr>
                                    <td>
                                        <strong class="full">Data Base Id</strong>
                                         @if($data_view[0]->id) {{ $data_view[0]->id}} @else {{'N/A'}} @endif   
                                    </td>
                                    <td>
                                        <strong class="full">Name</strong>
                                        @if($data_view[0]->name) {{ $data_view[0]->name}} @else {{'N/A'}} @endif                                   
                                    </td>
                                    <td>
                                        <strong class="full">Email</strong>
                                         @if($data_view[0]->email) {{ $data_view[0]->email}} @else {{'N/A'}} @endif 
                                    </td>
                                    <td>
                                        <strong class="full">Phone</strong>
                                       @if($data_view[0]->mobile_no) {{ $data_view[0]->mobile_no}} @else {{'N/A'}} @endif 
                                    </td>
                                    <td>
                                        <strong class="full">Department</strong>
                                       @if($data_view[0]->department_name) {{ $data_view[0]->department_name}} @else {{'N/A'}} @endif 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong class="full">Designations</strong>
                                       @if($data_view[0]->designation_name) {{ $data_view[0]->designation_name}} @else {{'N/A'}} @endif 
                                    </td>
                                    <td>
                                        <strong class="full">Email Id</strong>
                                       @if($data_view[0]->email) {{ $data_view[0]->email}} @else {{'N/A'}} @endif 
                                    </td>
                                    <td>
                                        <strong class="full">Admin Access</strong>
                                          @if($data_view[0]->admin_access ==1)
                                    <i class="fas fa-check btn-success btn-sm "></i>Active
                                    @else
                                    <i class="fas fa-ban btn-danger btn-sm "></i>Block
                                 @endif

                                    </td>
                                    <td>
                                        <strong class="full">Password</strong>
                                       @if($data_view[0]->show_password) {{ $data_view[0]->show_password}} @else {{'N/A'}} @endif 

                                    </td>
                                    <td>
                                        <strong class="full">Role</strong>
                                        @if(!empty($data_view[0]->roles))
                                       
                                       @foreach($data_view[0]->roles as $r)
                                           @if(!empty($r->user_role_name)){{$r->user_role_name}} @else {{'N/A'}} @endif
                                       @endforeach
                                    @else
                                      
                                    @endif
                                    </td>
                                    	
                                </tr>
                                <tr>
                                    <td>
                                        <strong class="full">Joining Date</strong>
                                       @if(!empty($data_view[0]->joining_date)) {{ date('d-m-Y H:i:s A', strtotime($data_view[0]->joining_date)) }}  @else {{'N/A'}} @endif                               

                                    </td>
                                    <td>
                                        <strong class="full">Country</strong>
                                         @if($data_view[0]->country_name) {{ $data_view[0]->country_name}} @else {{'N/A'}} @endif 

                                    </td>
                                     <td>
                                        <strong class="full">State</strong>
                                         @if($data_view[0]->state_name) {{ $data_view[0]->state_name}} @else {{'N/A'}} @endif 

                                    </td>
                                     <td>
                                        <strong class="full">City</strong>
                                         @if($data_view[0]->city_name) {{ $data_view[0]->city_name}} @else {{'N/A'}} @endif 

                                    </td>
                                    <td>
                                        <strong class="full">Profile</strong>
                                        <span class="pip">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                             <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                                             @else
                                             <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                                             @endif
                                           
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <strong class="full">Added On</strong>
                                          @if(!empty($data_view[0]->created_at)) {{ date('d-m-Y H:i:s A', strtotime($data_view[0]->created_at)) }}  @else {{'N/A'}} @endif                               

                                    </td>
                                    <td>
                                        <strong class="full">Added By</strong>
                                       @if($data_view[0]->added_by_name) {{ $data_view[0]->added_by_name}} @else {{'N/A'}} @endif                                      

                                    </td>
                                    <td>
                                        <strong class="full">Updated On</strong>
                                          @if(!empty($data_view[0]->updated_at)) {{ date('d-m-Y H:i:s A', strtotime($data_view[0]->updated_at)) }}  @else {{'N/A'}} @endif                               
                                    </td>
                                    <td>
                                        <strong class="full">Updated By</strong>
                                     @if($data_view[0]->updated_by_name) {{ $data_view[0]->updated_by_name}} @else {{'N/A'}} @endif                                      

                                    </td>
                                    <td>
                                        <strong class="full">Status</strong>
                                        @if($data_view[0]->status ==1)
                                    <i class="fas fa-check btn-success btn-sm "></i>Active
                                    @else
                                    <i class="fas fa-ban btn-danger btn-sm "></i>Block
                                 @endif
                                    </td>
                                </tr>

                                 <tr>
                                    <td >
										<strong class="full">Last Login IP</strong>

										</td>
										<td >
										<strong class="full">Last Login On</strong>
                                        </td>
                                    <td>
                                        <strong class="full">Updated On</strong>
                                          @if(!empty($data_view[0]->updated_at)) {{ date('d-m-Y H:i:s A', strtotime($data_view[0]->updated_at)) }}  @else {{'N/A'}} @endif                               
                                    </td>
                                    <td colspan="2">
										<strong class="full">Files</strong>
										@if(!empty($data_view[0]->files))
                                                <ol>
                                                @foreach($data_view[0]->files as $f)
                                                <li> {{ $f->file_title }}  &nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="{{ config('constants.options.MAINSITE').'build/assets/uploads/employee_file/'.$f->file_name }}" >View</a></li>
                                                @endforeach
                                                </ol>
                                        @else 
                                        {{ "-" }}
                                        @endif
                                        </td>

                                   
                                </tr>

                            </tbody>
                        </table>
                    </form>
                </div>
            <!-- /.card-body -->
            @else
                  <center>
                       <x-denied />
                  </center>                
                  @endif
         </div>
      </div>
   </div>
</section>
</x-app-layout>