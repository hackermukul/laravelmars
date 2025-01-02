<x-app-layout>

   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark"> @if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif <small>List</small></h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">Home</a></li>
                  <li class="breadcrumb-item active"> @if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif</li>
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
            <div id="accordion">
               <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->
               <div class="card card-primary">
                  <div class="card-header">
                     <h4 class="card-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" aria-expanded="false">
                        Search Panel
                        </a>
                     </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse" style="">
                     <div class="card-body">                   
                        <form action="{{ route('banner_module.search') }}" method="post" id="search_report_form" name="search_report_form" style="" class="form-horizontal" role="form" accept-charset="utf-8">
                           @csrf
                             <div class="card-body">
                              <div class="row">
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Field') }}" />
                                       <select name="field_name" id="field_name" title="Field" class="form-control" style="width:100%">
                                          <option value="urm.name" {{old('field_name',$field_name)=="urm.name"? 'selected':''}} >Name</option>
                                       </select>
                                    </div>
                                 </div>
                                 <!-- /.col -->
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label for="field_name">Field Value</label>
                                       <input type="text" name="field_value" value="{{ $field_value }}" id="field_value" title="Field Value" class="form-control" style="width:100%">
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label for="field_name">Start Date</label>
                                       <input type="date" name="start_date" id="start_date" title="Start Date" value="{{ $start_date }}" class="form-control" style="width:100%">
                                    </div>
                                 </div>
                                 <!-- /.col -->
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label for="field_name">End Date</label><input type="date" name="end_date" value="{{ $end_date }}" id="end_date" title="End Date" value="{{ $end_date }}" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label for="record_status">Status</label>
                                       <select name="record_status" id="record_status" title="Status" class="form-control" style="width:100%">
                                          <option value="" {{old('record_status',$record_status)==""? 'selected':''}} >Active/Block</option>
                                          <option value="1" {{old('record_status',$record_status)=="1"? 'selected':''}}>Active</option>
                                          <option value="zero" {{old('record_status',$record_status)=="zero"? 'selected':''}}>Block</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="panel-footer">
                                 <center>
                                    <button type="submit" class="btn btn-info" id="search_report_btn" name="search_report_btn" value="1">Search</button>
                                    &nbsp;&nbsp;<button type="reset" class="btn btn-default">Reset</button>
                                 </center>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title"><span style="color:#FF0000;">Total Records: {{$row_count;}}</span></h3>
                     <div class="float-right">
                     
								@if($user_access->add_module==1)	
                        <a href="{{ route('banner_module.create') }}"> 
                        <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add
                        New</button></a>
                        @endif
                
							   @if($user_access->update_module==1)
                       
                        <button type="button" class="btn btn-success btn-sm" onclick="validateRecordsActivate()"><i class="fas fa-check"></i> Active</button>
                        <button type="button" class="btn btn-dark btn-sm" onclick="validateRecordsBlock()"><i class="fas fa-ban"></i> Block</button>
                        @endif

                      
                        
                     </div>
                  </div>
                  <!-- /.card-header -->
                  @if(Session::has('success'))
                     <div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check"></i>{{ Session::get('success') }} </div>
                  @elseif(Session::has('error'))
                     <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i>{{ Session::get('error') }} </div>
                  @endif

                  @if($user_access->view_module==1)
                  <div class="card-body">
                     <form method="POST" action="{{ route('categories.updateStatus') }}"  id="ptype_list_form" name="ptype_list_form" style="" class="form-horizontal" role="form" enctype="multipart/form-data" accept-charset="utf-8">
                     @csrf
                        <input type="hidden" name="task" id="task" value ="" />
                        <table id="example1" class="table table-bordered table-hover table-striped">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th width="4%"><input type="checkbox" name="main_check" id="main_check"
                                    onclick="check_uncheck_All_records()" value="" /></th>
                                 <th>Name</th>
                                 <th>Added On</th>
                                 <th>Added By</th>
                                 <th>Updated By</th>
                                 <th>Status</th>
                              </tr>
                           </thead>
                          @if(!empty($banner))
                           <tbody>
                           @php($count=0)
                            @foreach ($banner as $row) @php($count++)
                              <tr>
                                 <td>{{$count}}</td>
                                 <td><input type="checkbox" name="sel_recds[]"
                                    id="sel_recds{{$count}}"
                                    value="{{$count}}" /></td>
                                 <td><a href="{{ route($main_routes.'.show', ['id' => $row->id]) }}">@if(!empty($row->name)){{$row->name}} @else {{'N/A'}} @endif </a></td>
                                 <td>@if(!empty($row->created_at)) {{ date('M d/Y', strtotime($row->created_at)) }}  @else {{'N/A'}} @endif</td>
                                 <td>@if(!empty($row->added_by_name)){{$row->added_by_name}} @else {{'N/A'}} @endif</td>
                                 <td>@if(!empty($row->updated_by_name)){{$row->updated_by_name}} @else {{'N/A'}} @endif</td>

                                 <td>
                                 @if($row->status ==1)
                                    <i class="fas fa-check btn-success btn-sm "></i>
                                    @else
                                    <i class="fas fa-ban btn-danger btn-sm "></i>
                                 @endif
                                 </td>
                              </tr>
                               @endforeach
                           </tbody>
                        @endif

                        </table>
                     </form>
                     <center>
                        <div class="pagination_custum"></div>
                     </center>
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
      </div>
   </section>
   <script type="application/javascript">
      function check_uncheck_All_records() // done
      {
          var mainCheckBoxObj = document.getElementById("main_check");
          var checkBoxObj = document.getElementsByName("sel_recds[]");
      
          for (var i = 0; i < checkBoxObj.length; i++) {
              if (mainCheckBoxObj.checked)
                  checkBoxObj[i].checked = true;
              else
                  checkBoxObj[i].checked = false;
          }
      }
      
      function validateCheckedRecordsArray() // done
      {
          var checkBoxObj = document.getElementsByName("sel_recds[]");
          var count = true;
      
          for (var i = 0; i < checkBoxObj.length; i++) {
              if (checkBoxObj[i].checked) {
                  count = false;
                  break;
              }
          }
      
          return count;
      }
      
      function validateRecordsActivate() // done
      {
          if (validateCheckedRecordsArray()) {
              //alert("Please select any record to activate.");
              toastrDefaultErrorFunc("Please select any record to activate.");
              document.getElementById("sel_recds1").focus();
              return false;
          } else {
              document.ptype_list_form.task.value = 'active';
              document.ptype_list_form.submit();
          }
      }
      
      function validateRecordsBlock() // done
      {
          if (validateCheckedRecordsArray()) {
              //alert("Please select any record to block.");
              toastrDefaultErrorFunc("Please select any record to block.");
              document.getElementById("sel_recds1").focus();
              return false;
          } else {
              document.ptype_list_form.task.value = 'block';
              document.ptype_list_form.submit();
          }
      }
   </script>
   <script>
window.addEventListener('load' , function(){

	$( ".paginationClass" ).click(function() {
		// console.log($(this).data('ci-pagination-page'));
		// console.log($(this));
		// console.log($(this).attr('href'));//alert();
		//alert(this.data('ci-pagination-page'));
		$('#search_report_form').attr('action', $(this).attr('href'));
		$('#search_report_form').submit();
		return false ;
	});
	$('#reservationdate').datetimepicker({
        format: 'DD-MM-YYYY'
	});
	$('#reservationdate1').datetimepicker({
        format: 'DD-MM-YYYY'
	});
	
	$(".export_excel").bind("click" , function(){
			
		$('#search_report_form').attr('action', '{{ route('categories.export-excel') }}');
		$('#search_report_form').attr('target', '_blank');
		$('#search_report_btn').click();
		
		$('#search_report_form').attr('action', 'https://dietdighi.in/setup/admin/master/Department-Module/department-list');
		$('#search_report_form').attr('target', '');
	})
})
</script>

</x-app-layout>