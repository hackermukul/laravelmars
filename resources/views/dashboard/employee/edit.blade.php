
<x-app-layout>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">  @if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route($main_routes.'.index') }}">@if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif  List</a></li>
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
                  <h3 class="card-title"> <small>Add New Record</small></h3>
               </div>
               @if(Session::has('success'))
                     <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>{{ Session::get('success') }} </div>
                  @elseif(Session::has('error'))
                     <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i>{{ Session::get('error') }} </div>
                  @endif
               <!-- /.card-header -->
               <div class="card-body">
                    <form method="POST" action="{{ route($main_routes.'.update', $data_view->slug) }}"  id="ptype_list_form" name="ptype_list_form" style="" class="form-horizontal" role="form" enctype="multipart/form-data" accept-charset="utf-8">
                     @csrf
                      @method('PUT')
                    <input type="hidden" name="id"  value="{{ $data_view->id }}">
                     <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}" >
                     <input type="hidden" name="redirect_type" id="redirect_type" value="">  
                     <input type="hidden" name="redirect_type" value="" id="redirect_type">
                     <div class="">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-6">
                               <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('User Role(*)') }}" />
                              @if(!empty($company_profiles))
                                                          @foreach ($company_profiles as $row) 

                              <input type="hidden" name="company_profile_id[]" value="<?=$row->id?>">
                                          @endforeach
                              @endif
                              <div class="col-sm-12">
                                 <select class="block mt-1 w-full select2" id="user_role_id" name="user_role_id[]" style="height:50px;" required  >
                                    <option value="">Please select</option>
                                       <?php foreach ($role_managers as $key=>$role_managers): ?>
                                        
                                       <option value="<?php echo $role_managers->id; ?>" @if ($data_view->user_role_id == $role_managers->id ) {{ "selected"; }}@endif >
                                          {{ $role_managers->name }}
                                    </option>
                                    <?php endforeach; ?>
                                 </select>
                                 <span>
                                       @error('user_role_id')
                                          <div class="error" style="color: red">{{ $errors }}</div>
                                       @enderror
                                    </span>
                              </div>
                           </div>

                            <div class="col-lg-4 col-md-4 col-sm-6">
                               <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Designation(*)') }}" />
                              <div class="col-sm-12">
                                 <select class="block mt-1 w-full select2" id="designation_id" name="designation_id" style="height:50px;" required >
                                    <option value="">Please select</option>
                                       <?php foreach ($designations as $key=>$designations): ?>
                                         @if (old('designation_id')==$designations->id)
                                                <option value={{$designations->id}} {{ old('designation_id') == $designations->id ? "selected" : "" }} > {{ $designations->name }}</option>
                                          @else
                                                 <option value="<?php echo $designations->id; ?>" {{ $data_view->designation_id  == $designations->id ? "selected" : "" }}>
                                                      {{ $designations->name }}
                                                </option>
                                          @endif
                              
                                    <?php endforeach; ?>
                                 </select>
                                  <span>
                                       @error('designation_id')
                                          <div class="error" style="color: red">{{ $errors }}</div>
                                       @enderror
                                    </span>
                              </div>
                           </div>

                            <div class="col-lg-4 col-md-4 col-sm-6">
                               <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Department(*)') }}" />
                              <div class="col-sm-12">
                                 <select class="block mt-1 w-full select2" id="department_id" name="department_id" style="height:50px;" required ">
                                    <option value="">Please select</option>
                                       <?php foreach ($department_models as $key=>$department_models): ?>
                                       @if (old('designation_id')==$designations->id)
                                        <option value="<?php echo $department_models->id; ?>" {{ old('department_id') == $department_models->id ? "selected" : "" }}>
                                          {{ $department_models->name }} </option>
                                          @else
                                                 <option value="<?php echo $department_models->id; ?>" {{ $data_view->department_id  == $department_models->id ? "selected" : "" }}>
                                                      {{ $department_models->name }}
                                                </option>
                                       @endif
                                    <?php endforeach; ?>
                                 </select>
                              </div>
                           </div><br><br><br><br>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                              <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Full Name(*)') }}" />
                                 <div class="col-sm-12">
                                 <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{old('name') ?? $data_view?->name ?? '' }}" required autofocus autocomplete="name" />
                                    <span>
                                       @error('name')
                                          <div class="error" style="color: red">{{ $errors }}</div>
                                       @enderror
                                    </span>
                                 </div>
                           </div>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                              <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Email(*)') }}" />
                                 <div class="col-sm-12">
                                 <x-input id="email" class="block mt-1 w-full" type="text" name="email" value="{{old('email') ?? $data_view?->email ?? '' }}" required   />
                                    <span>
                                       @error('email')
                                          <div class="error" style="color: red">{{ $errors }}</div>
                                       @enderror
                                    </span>
                                 </div>
                           </div>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                              <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Password(*)') }}" />
                                 <div class="col-sm-12">
                                 <x-input id="password" class="block mt-1 w-full" type="password" name="password" value="{{old('password') ?? $data_view?->show_password ?? '' }}" required />
                                    <span>
                                       @error('password')
                                          <div class="error" style="color: red">{{ $errors }}</div>
                                       @enderror
                                    </span>
                                 </div>
                           </div><br><br><br><br>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                              <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Mobile No(*)') }}" />
                                 <div class="col-sm-12">
                                 <x-input id="mobile_no" class="block mt-1 w-full" type="number" name="mobile_no" value="{{old('mobile_no') ?? $data_view?->mobile_no ?? '' }}" required autofocus autocomplete="mobile_no" />
                                    <span>
                                       @error('mobile_no')
                                          <div class="error" style="color: red">{{ $errors }}</div>
                                       @enderror
                                    </span>
                                 </div>
                           </div>
                           
                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Country') }}" />
                              <div class="col-sm-12">
                                 <select class="block mt-1 w-full select2" id="country_id" name="country_id" style="height:50px;" required onchange ="getState(this.value, 0)">
                                    <option value="">Please select</option>
                                       <?php foreach ($countryname as $key=>$countryname): ?>

                                        @if (old('designation_id')==$designations->id)
                                        <option value="<?php echo $countryname->id; ?>" {{ old('country_id') == $countryname->id ? "selected" : "" }}>
                                          {{ $countryname->name }}
                                       
                                         </option>
                                       
                                          @else
                                                 <option value="<?php echo $countryname->id; ?>" {{ $data_view->country_id  == $countryname->id ? "selected" : "" }}>
                                                      {{ $countryname->name }}
                                                </option>
                                          @endif
                              
                                       
                                    <?php endforeach; ?>
                                 </select>
                                 <span>
                                    @error('country_id')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>


                           

                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('State') }}" />
                              <div class="col-sm-12">
                                 <select class="block mt-1 w-full select2" id="state_id" name="state_id" style="height:50px;" required onchange ="getCity(this.value, 0)">
                                    <option value="">Please select</option>
                                    
                                 </select>                              
                                 <span>
                                    @error('state_id')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div><br><br><br><br>


                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('City') }}" />
                              <div class="col-sm-12">
                                 <select class="block mt-1 w-full select2" id="city_id" name="city_id" style="height:50px;" required > 
                                    <option value="">Please select</option>
                                    
                                 </select>                              
                                 <span>
                                    @error('city_id')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                              <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Joining Date(*)') }}" />
                                 <div class="col-sm-12">
                                 <x-input id="joining_date" class="block mt-1 w-full" type="date" name="joining_date"  value="{{ old('joining_date', date('Y-m-d', strtotime($data_view->joining_date))) }}" required autofocus autocomplete="name" />
                                    <span>
                                       @error('joining_date')
                                          <div class="error" style="color: red">{{ $errors }}</div>
                                       @enderror
                                    </span>
                                 </div>
                           </div>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                              <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Termination Date') }}" />
                                 <div class="col-sm-12">
                                 <x-input id="termination_date" class="block mt-1 w-full" type="date" name="termination_date" :value="old('termination_date')"  autofocus autocomplete="termination_date" />
                                    <span>
                                       @error('termination_date')
                                          <div class="error" style="color: red">{{ $errors }}</div>
                                       @enderror
                                    </span>
                                 </div>
                           </div>

                           <div class="col-lg-6 col-md-8 col-sm-6">
                              <div class="card-body py-0 px-2" >
                                 <table class="table table-sm">
                                    <thead>
                                       <tr>
                                             <th>#</th>
                                             <th width="25%">File Title</th>
                                             <th>File</th>
                                             <th></th>
                                       </tr>
                                    </thead>
                                    <tbody class="RFQDetailBody">
                                    @include('dashboard.employee.file_line_add_more')
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <td colspan="9"><button type="button" onclick="addNewRFQDeatilLine(0)" class="btn btn-block btn-default">Add New Line</button><td>
                                       </tr>
                                    </tfoot>
                                 </table> 
                              </div>
								   </div>
                           <div class="col-lg-3 col-md-3 col-sm-6">
                              <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Give Admin Access') }}" />
                                 <div class="col-sm-12">
                                    <div class="form-check" style="margin-top:12px">
                                       <div class="form-group clearfix">
                                          <div class="icheck-success d-inline">
                                             <input type="radio" name="admin_access"  value="1" @if(old('admin_access',$data_view->admin_access)=="1") checked @endif  id="admin_access1">
                                             <label for="admin_access1"> Yes
                                             </label>
                                          </div>
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          <div class="icheck-danger d-inline">
                                             <input type="radio" name="admin_access" value="0" @if(old('admin_access',$data_view->admin_access)=="0") checked @endif id="admin_access2">
                                             <label for="admin_access2"> No
                                             </label>
                                          </div>
                                       </div>
                                    </div>
                                    <span>
                                       @error('admin_access')
                                          <div class="error" style="color: red">{{ $errors }}</div>
                                       @enderror
                                    </span>
                                 </div>
                           </div>

                            <div class="col-lg-3 col-md-3 col-sm-6">
                              <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Approval Access') }}" />
                                 <div class="col-sm-12">
                                    <div class="form-check" style="margin-top:12px">
                                       <div class="form-group clearfix">
                                          <div class="icheck-success d-inline">
                                             <input type="radio" name="approval_access"  @if(old('approval_access',$data_view->approval_access)=="1") checked @endif  value="1" id="approval_access1">
                                             <label for="approval_access1"> Yes
                                             </label>
                                          </div>
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          <div class="icheck-danger d-inline">
                                             <input type="radio" name="approval_access" @if(old('approval_access',$data_view->approval_access)=="0") checked @endif  value="0" id="approval_access2">
                                             <label for="approval_access2"> No
                                             </label>
                                          </div>
                                       </div>
                                    </div>
                                    <span>
                                       @error('approval_access')
                                          <div class="error" style="color: red">{{ $errors }}</div>
                                       @enderror
                                    </span>
                                 </div>
                           </div><br><br><br><br>

                            <div class="col-lg-3 col-md-3 col-sm-6">
                              <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Data View') }}" />
                                 <div class="col-sm-12">
                                    <div class="form-check" style="margin-top:12px">
                                       <div class="form-group clearfix">
                                          <div class="icheck-success d-inline">
                                             <input type="radio" name="data_view"  value="1"  @if(old('data_view',$data_view->data_view)=="1") checked @endif id="data_view1">
                                             <label for="data_view1"> Yes
                                             </label>
                                          </div>
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          <div class="icheck-danger d-inline">
                                             <input type="radio" name="data_view" value="0" @if(old('data_view',$data_view->data_view)=="0") checked @endif id="data_view1">
                                             <label for="data_view1"> No
                                             </label>
                                          </div>
                                       </div>
                                    </div>
                                    <span>
                                       @error('data_view')
                                          <div class="error" style="color: red">{{ $errors }}</div>
                                       @enderror
                                    </span>
                                 </div>
                           </div>

                          <div class="col-md-6 col-sm-6">
                              <x-label for="radioSuccess1" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Status(*)') }}" />
                              <div class="col-sm-6">
                                 <div class="form-check" style="">
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

   <script type="text/javascript">
       window.onload = function() {

   @if(old('country_id') != '' || old('state_id') != '')
     getState({{ old('country_id') }} , {{ old('state_id') }} );
     getCity({{ old('state_id')}} , {{ old('city_id') }} );
   @elseif($data_view->country_id != '' || $data_view->state_id != '' )
     getState({{ $data_view->country_id }} , {{ $data_view->state_id }} );
     getCity({{ $data_view->state_id }} , {{ $data_view->city_id }} );
   @endif
};
 
</script>
   <script>
      function redirect_type_func(data)
      {
      	document.getElementById("redirect_type").value = data;
      	return true;
      }
      window.addEventListener('load' , function(){
        if (window.File && window.FileList && window.FileReader) {
          $("#files").on("change", function(e) {
            var files = e.target.files,
              filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
              var f = files[i]
              var fileReader = new FileReader();
              fileReader.onload = (function(e) {
                var file = e.target;
      		  //customized code
      		  $(".pip").remove();
                $(".custom-file-display").html("<span class=\"pip\">" +
                  "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" + "</span>");
              });
              fileReader.readAsDataURL(f);
            }
          });
        } else {
          alert("Your browser doesn't support to File API")
        }
      
      });
   </script>

   <script type="text/javascript">

   function getState(country_id , state_id=0)
	{  
		$('#loader1').show();
		$("#state_id").html( '' );
		if(country_id > 0)
		{
			Pace.restart();
			$.ajax({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
				url: "{{ route('city.getState') }}",
				type: 'post',
				dataType: "json",
				data: {	'country_id' : country_id , 'state_id' : state_id,'_token':"{{ csrf_token() }}" },
				success: function( response ) {
					$("#state_id").html( response.state_html );
				},
				error: function (request, error) {
					toastrDefaultErrorFunc("Unknown Error. Please Try Again");
					$("#quick_view_model").html( 'Unknown Error. Please Try Again' );
				}
			});
		}
	}

     function getCity(state_id, city_id = 0 )
	{  
		$('#loader1').show();
		$("#city_id").html( '' );
		if(state_id > 0)
		{
			Pace.restart();
			$.ajax({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
				url: "{{ route('company.getCity') }}",
				type: 'post',
				dataType: "json",
				data: {	'city_id' : city_id , 'state_id' : state_id,'csrf-token':"{{ csrf_token() }}" },
				success: function( response ) {
					$("#city_id").html( response.state_html );
				},
				error: function (request, error) {
					toastrDefaultErrorFunc("Unknown Error. Please Try Again");
					$("#quick_view_model").html( 'Unknown Error. Please Try Again' );
				}
			});
		}
	}
   

var append_id = 1;
function addNewRFQDeatilLine(id=0)
{
	append_id++;
	Pace.restart();
	$.ajax({
     headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
		url: "{{ route('employee.addNewFileLine') }}",
		type: 'post',
		dataType: "json",
		data: { 'id':id	, 'append_id':append_id,'csrf-token':"{{ csrf_token() }}"},
		success: function( response ) {
			$(".RFQDetailBody").append( response.template );
			set_qe_sub_table_count();
			set_qe_sub_table_remove_btn();
			calculate_qe_sub_table_price();
			set_input_element_functions()
			
			$('.custom-file-input').on('change', function () {
				let fileName = Array.from(this.files).map(x => x.name).join(', ')
				$(this).siblings('.custom-file-label').addClass("selected").html(fileName);
			});
		},
		error: function (request, error) {
			toastrDefaultErrorFunc("Unknown Error. Please Try Again");
		}
	});
}


function set_qe_sub_table_count()
{
	var count=0;
	$('.qe_sub_table_count').each(function(index, value) {
		count++;
	  $(this).html(count+'.');
	});
}

function set_qe_sub_table_remove_btn()
{
	$('.qe_sub_table_remove_td').html('');
	var count=0;
	$('.qe_sub_table_remove_td').each(function(index, value) {
		count++;
	});
	if(count>1)
	{
		$('.qe_sub_table_remove_td').html('<button class="btn btn-outline-danger btn-xs" onclick="remove_qe_sub_table_row($(this))" title="remove"><i class="fas fa-trash"></i></button>');
	}
}

function remove_qe_sub_table_row(row)
{
	row.closest('tr').remove();
	set_qe_sub_table_remove_btn();
	set_qe_sub_table_count();
}


</script>
</x-app-layout>