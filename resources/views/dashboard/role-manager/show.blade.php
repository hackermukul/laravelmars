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
                  <h3 class="card-title">@if($users_role_master_data[0]->name) {{ $users_role_master_data[0]->name}} @else {{'N/A'}} @endif</h3>
                  <div class="float-right">
                        @if($user_access->add_module==1)	
                  <a href="{{ route($main_routes.'.create') }}"> 
                  <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add
                  New</button></a>
                   @endif
                   @if($user_access->update_module==1)
                  <a href="{{ route($main_routes.'.edit', $users_role_master_data[0]->slug) }}"> 
                  <button type="button" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Update</button>
                  </a>
                   @endif
                  
                  </div>
               </div>
               <!-- /.card-header -->
                @if($user_access->view_module==1)
               <div class="card-body">
                  <form action=""
                     name="ptype_list_form" method="post" class="form-horizontal" role="form">
                     <input type="hidden" name="task" id="task" value="" />
                     <div class="form-group row table-responsive">
                        <table id="" class="table table-bordered table-hover " style="font-size:medium" >
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Role</th>
                                 <th>All</th>
                                 <th>View</th>
                                 <th>Add</th>
                                 <th>Update</th>
                                 <th style="display:none">Import</th>
                                 <th>Export</th>
                              </tr>
                           </thead>
                           <tbody >
                             @php($count=0)
                              @foreach ($module_data as $md) @php($count++)
                              
                                  @php($all_checked = $view_checked = $add_checked = $update_checked = $delete_checked = $approval_checked = $import_checked = $export_checked ='btn-danger')
                                  @php($sts = 'Denied')
                                       
                                 @if(!empty($module_permission_data))
												@foreach($module_permission_data as $mpd)
												
													@if($md->id == $mpd->module_id)
                                         
                                          @if(!empty($mpd->view_module))
                                             @php($view_checked = $all_checked = 'btn-success')
                                             @php($sts = 'Access')
                                          @endif

                                          @if(!empty($mpd->add_module))
                                             @php($add_checked = $all_checked = 'btn-success')
                                             @php($sts = 'Access')
                                          @endif

                                          @if(!empty($mpd->update_module))
                                             @php($update_checked = $all_checked = 'btn-success')
                                             @php($sts = 'Access')
                                          @endif

                                          @if(!empty($mpd->export_data))
                                             @php($export_checked = $all_checked = 'btn-success')
                                             @php($sts = 'Access')
                                          @endif
																									
												   @endif
												@endforeach
											@endif
										
                              <tr>
                                 <td>{{ $count }}.</td>
                                 <td>{{ $md->name }} [ {{ $master_name[$md->is_master] }} ]</td>
                                 <td >
                                   <button type="button" class="btn btn-sm btn-block {{$all_checked }}" > @if($sts == "Access") <i class="fa fa-universal-access" aria-hidden="true"></i> @else <i class="fa fa-ban" aria-hidden="true"></i> @endif {{ $sts}}</button>
                                 </td>
                                 <td>
                                    <button type="button" class="btn btn-sm btn-block {{$view_checked }}" >@if($sts == "Access") <i class="fa fa-universal-access" aria-hidden="true"></i> @else <i class="fa fa-ban" aria-hidden="true"></i> @endif {{ $sts}}</button>
                                 </td>
                                 <td>
                                    <button type="button" class="btn btn-sm btn-block {{$add_checked }}" checked> @if($sts == "Access") <i class="fa fa-universal-access" aria-hidden="true"></i> @else <i class="fa fa-ban" aria-hidden="true"></i> @endif {{ $sts}}</button>
                                 </td>
                                 <td>
                                    <button type="button" class="btn btn-sm btn-block {{$update_checked }}" checked> @if($sts == "Access") <i class="fa fa-universal-access" aria-hidden="true"></i> @else <i class="fa fa-ban" aria-hidden="true"></i> @endif{{ $sts}}</button>
                                 </td>
                                
                                 <td style="display:none">
                                    
                                 </td>
                                 <td>
                                     <button type="button" class="btn btn-sm btn-block {{$export_checked }}" checked> @if($sts == "Access") <i class="fa fa-universal-access" aria-hidden="true"></i> @else <i class="fa fa-ban" aria-hidden="true"></i> @endif {{ $sts}}</button>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                     <div class="row">
                        <table id="" class="table table-bordered table-hover myviewtable responsiveTableNewDesign">
                           <tbody>
                              <tr>
                                 <td>
                                    <strong class="full">Data Base Id</strong>
                                    @if(!empty($users_role_master_data[0]->added_by_name)){{$users_role_master_data[0]->added_by_name}} @else {{'N/A'}} @endif
                                 </td>
                                 <td>
                                    <strong class="full">User Role Name</strong>
                                    @if(!empty($users_role_master_data[0]->name)){{$users_role_master_data[0]->name}} @else {{'N/A'}} @endif
                                 </td>
                                 <td>
                                    <strong class="full">Added On</strong>
                                    @if(!empty($users_role_master_data[0]->created_at)){{ date('d-m-Y h:i:s A', strtotime($users_role_master_data[0]->created_at)) }} @else {{'N/A'}} @endif
                                 </td>
                                 <td class="full">
                                    <strong class="full">Added By</strong>
                                    @if(!empty($users_role_master_data[0]->added_by_name)){{$users_role_master_data[0]->added_by_name}} @else {{'N/A'}} @endif
                                 </td>
                                 <td>
                                    <strong class="full">Updated On</strong>
                                    @if(!empty($users_role_master_data[0]->updated_at)){{$users_role_master_data[0]->updated_at}} @else {{'N/A'}} @endif
                                 </td>
                                 <td>
                                    <strong class="full">Updated By</strong>
                                    @if(!empty($users_role_master_data[0]->updated_by_name)){{$users_role_master_data[0]->updated_by_name}} @else {{'N/A'}} @endif
                                 </td>
                                 <td >
                                    <strong  class="full">Status</strong>
                                    @if($users_role_master_data[0]->status==1) Active <i class="fas fa-check btn-success btn-sm "></i>
                                    @else Block <i class="fas fa-ban btn-danger btn-sm "></i> Block
                                   @endif
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </form>
               </div>
                 @else
                  <center>
                       <x-denied />
                  </center>                
                  @endif
               <!-- /.card-body -->
            </div>
         </div>
      </div>
   </section>
</x-app-layout>