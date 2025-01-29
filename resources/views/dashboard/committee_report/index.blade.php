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
                  <div  style="">
                     <div class="card-body">
                        <form action="{{ route($main_routes.'.search') }}" method="post" id="search_report_form" name="search_report_form" style="" class="form-horizontal" role="form" accept-charset="utf-8">
                           @csrf
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-3">
                                   <div class="form-group">
                                        <x-label for="Category" class="col-sm-12 label_content px-2 py-0" value="{{ __('Related To') }}" />
                                        
                                        <select class="block mt-1 w-full select2" id="department" name="department" style="height:50px;" required>
                                            <option value="">Please select</option>
                                            
                                            <?php foreach ($department_models as $department): ?>
                                                <option value="<?php echo $department->id; ?>" 
                                                    <?php if (isset($department_id) && old('department') == $department->id) { echo 'selected="selected"'; } ?>>
                                                    {{ $department->name }}
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                        </div>
                                 <!-- /.col -->
                                
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
                                    <button type="submit" class="btn btn-info" id="search_report_btn" name="search_report_btn" value="1">Download</button>
                                    &nbsp;&nbsp;<button type="reset" class="btn btn-default">Reset</button>
                                 </center>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>

                <div class="card card-primary">
                  <div class="card-header">
                     <h4 class="card-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" aria-expanded="false">
                        Search Panel
                        </a>
                     </h4>
                  </div>
                  <div  style="">
                     <div class="card-body">
                        <form action="{{ route($main_routes.'.chat') }}" method="post" id="search_report_form" name="search_report_form" style="" class="form-horizontal" role="form" accept-charset="utf-8">
                           @csrf
                           <div class="card-body">
                              <div class="row">
                                 <div class="col-md-3">
                                   <div class="form-group">
                                        <x-label for="Category" class="col-sm-12 label_content px-2 py-0" value="{{ __('Grievance') }}" />
                                        
                                       <select class="block mt-1 w-full select2" id="grievance" name="grievance" style="height:50px;" required>
                                        <option value="">Please select</option>

                                        @foreach ($grievance_replies as $grievance)
                                            <option value="{{ $grievance->id }}" 
                                                @selected(old('grievance') == $grievance->id)>
                                              {{ $grievance->id }} ({{ $grievance->subject }})
                                            </option>
                                        @endforeach
                                    </select>


                                    </div>
                                        </div>
                                 <!-- /.col -->
                                
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
                                 
                              </div>
                              <div class="panel-footer">
                                 <center>
                                    <button type="submit" class="btn btn-info" id="search_report_btn" name="search_report_btn" value="1">Export Chat</button>
                                    &nbsp;&nbsp;<button type="reset" class="btn btn-default">Reset</button>
                                 </center>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>

               <div class="card">
                 
                  
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
      			
      		$('#search_report_form').attr('action', '{{ route('department.export-excel') }}');
      		$('#search_report_form').attr('target', '_blank');
      		$('#search_report_btn').click();
      		
      		$('#search_report_form').attr('action', '');
      		$('#search_report_form').attr('target', '');
      	})
      })
   </script>
</x-app-layout>