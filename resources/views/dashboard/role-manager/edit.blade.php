
<x-app-layout>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">  @if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif </h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('department.index') }}"> @if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif List</a></li>
                  <li class="breadcrumb-item">{{ __('Update New Record') }}</li>
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
                  <h3 class="card-title"> <small>{{ __('Update New Record') }}</small></h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                    <form method="POST" action="{{ route('role-manager.update', $roleManager->slug) }}"  id="ptype_list_form" name="ptype_list_form" style="" class="form-horizontal" role="form" enctype="multipart/form-data" accept-charset="utf-8">
                     @csrf
                       @method('PUT')
                    <input type="hidden" name="user_role_id"  value="{{ $roleManager->id }}">
                     <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}" >
                     <input type="hidden" name="redirect_type" id="redirect_type" value="">  <input type="hidden" name="id" value="0" id="id">
                     <input type="hidden" name="redirect_type" value="" id="redirect_type">
                    <div class="">
                        <div class="">
                        <div class="form-group row">
                           <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Role Name(*)') }}" />
                           <div class="col-sm-10">
                              <x-input id="name" class="block mt-1 w-full  @error('name') is-invalid @enderror" type="text" name="name"  value="{{isset($roleManager->name) ? $roleManager->name:old('name')}}" required placeholder="Enter Role Name" autofocus autocomplete="name" />
                                 <span>
                                    @error('user_role_name')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                           </div>
                        </div>
                        <div class="form-group row ">
                           <table id="" class="table table-bordered table-hover" style="font-size:medium" >
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>All</th>
                                    <th>View</th>
                                    <th>Add</th>
                                    <th>Update</th>
                                    <th style="display:none">Import</th>
                                    <th >Export</th>
                                 </tr>
                              </thead>
                              <tbody >
                                 @php($count=0)
                                     @foreach ($module_data as $md) @php($count++)
                                 
                                  @php($all_checked = $view_checked = $add_checked = $update_checked = $delete_checked = $approval_checked = $import_checked = $export_checked ='')
                                                                        
                                    @if(!empty($module_permission_data))
                                       @foreach($module_permission_data as $mpd)
                                       
                                          @if($md->id == $mpd->module_id)
                                             
                                             @if(!empty($mpd->view_module))
                                                @php($view_checked = $all_checked = 'checked')
                                             @endif

                                             @if(!empty($mpd->add_module))
                                                @php($add_checked = $all_checked = 'checked')
                                             @endif

                                             @if(!empty($mpd->update_module))
                                                @php($update_checked = $all_checked = 'checked')
                                             @endif

                                              @if(!empty($mpd->export_data))
                                                @php($export_checked = $all_checked = 'checked')
                                             @endif


                                          @endif
                                       @endforeach
                                    @endif

                                 <tr>
                                    <td>{{$count}}.</td>
                                    <td>{{ $md->name }} [ {{ $master_name[$md->is_master] }} ]</td>
                                    <td>
                                    	
                                       <input type="checkbox" value="{{ $md->id }}" name="module_ids[]" class="module_all m_check_all_{{$md->id }}" data-module_id="{{ $md->id }}"  {{ $all_checked }} data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Yes" data-off-text="No" >

                                    </td>
                                    <td>
                                       <input type="checkbox" value="1" name="view_{{ $md->id }}" class="module_field m_check_field_{{ $md->id }}" data-module_id="{{ $md->id }}" {{ $view_checked }} data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Yes" data-off-text="No" >
                                    </td>
                                    <td>
                                       <input type="checkbox" value="1" name="add_{{ $md->id }}" class="module_field m_check_field_{{ $md->id }}" data-module_id="{{ $md->id }}" {{ $add_checked }} data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Yes" data-off-text="No" >
                                    </td>
                                    <td>
                                       <input type="checkbox" value="1" name="update_{{ $md->id }}" class="module_field m_check_field_{{ $md->id }}" data-module_id="{{ $md->id }}" {{ $update_checked }} data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Yes" data-off-text="No" >
                                    </td>
                                   
                                    <td>
                                       <input type="checkbox" value="1" name="export_{{ $md->id }}" class="module_field m_check_field_{{ $md->id }}" data-module_id="{{ $md->id }}"  {{ $export_checked }} data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Yes" data-off-text="No" >
                                    </td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                        <div class="form-group row">
                           <label for="radioSuccess1" class="col-sm-2 col-form-label-lg">Status</label>
                           <div class="col-sm-10">
                              <div class="form-check" style="margin-top:12px">
                                 <div class="form-group clearfix">
                                    <div class="icheck-success d-inline">
                                       <input type="radio" name="status" value="1"  {{ old('status') == '1' ? 'checked' : 'checked' }} id="Active" required="required" class="label-active">
                                          <label for="Active">{{ __('Active') }}</label>        
                                    </div>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <div class="icheck-danger d-inline">
                                       <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }} id="Block" required="required" class="label-block">
                                          <label for="Block">{{ __('Block') }}</label>						<span>
                                          </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                           <center>
                              <button type="submit" name="save" onclick="return redirect_type_func('')" value="save" class="btn btn-info"> {{ __('Save') }}</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="submit" name="save" onclick="return redirect_type_func('save-add-new')" value="save-add-new" class="btn btn-default ">{{ __('Save And Add New') }}</button>
                            </center>
                        </div>
                        <!-- /.card-footer -->
                     </div>
                     
                  </form>

                  <!-- /.card-body -->
               </div>
            </div>
         </div>
      </div>
   </section>
  <script>
	function redirect_type_func(data)
	{
		document.getElementById("redirect_type").value = data;
		return true;
	}
window.addEventListener('load' , function(){
	var approve_all = false;	
	var approve_field = false;	
	$('.module_all').on('switchChange.bootstrapSwitch', function (event, state) {
		if(approve_field){return false;}
		console.log(state);
		var module_id = $(this).attr("data-module_id");
		approve_all = true;
		$( ".m_check_field_"+module_id ).each(function( index ) {
			$( this ).bootstrapSwitch('state', state);
		});
		approve_all = false;
	});

	$('.module_field').on('switchChange.bootstrapSwitch', function (event, state) {//alert('dgf');
		if(approve_all){return false;}
		approve_field = true;
		var module_id = $(this).attr("data-module_id");
		var status = false;
		var total_count = 0;
		var true_count = 0;
		var false_count = 0;
		$( ".m_check_field_"+module_id ).each(function( index ) {
			total_count++;
			if($( this ).bootstrapSwitch('state'))
			{ true_count++; }
			else
			{ false_count++; }
		});
		if(true_count == total_count)
		{
			$( ".m_check_all_"+module_id ).bootstrapSwitch('state', true);
		}

		else if(false_count == total_count)
		{
			$( ".m_check_all_"+module_id ).bootstrapSwitch('state', false);
		}
		else 
		{
			$( ".m_check_all_"+module_id ).bootstrapSwitch('state', true);
		}
	//	console.log(true_count+' : '+false_count+' : '+total_count);
		approve_field = false;
	});
})
</script>
</x-app-layout>