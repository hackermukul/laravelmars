
<x-app-layout>

@php
    $slug_url=$meta_title=$meta_keywords=$meta_description=$meta_others="";
    $banner_id=0;
    $status=1;
    $banner_for=1;
@endphp

<script>
 
   	window.addEventListener("load", function(){
   $(document).ready(function() {
   	$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    type: "POST",
   	url:'{{ route('department.GetCompleteCategoryList') }}',
      //dataType : "json",
      data : {"banner_id" : '{{ $banner_id }}' , "withPosition" : 1  , 'sortByPosition':1 , 'csrf-token': "{{ csrf_token() }}" },
      success : function(result){
   	    //alert(result);
   		$('#bannerList').html(result);
   		//ArrangeTable();
   		dragEvent();
   	   }
      });
   });
   });

</script>
<style>
   body{
   overflow-x: hidden;
   }
</style>

   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">@if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('department.index') }}">@if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif  List</a></li>
                  <li class="breadcrumb-item">{{ __('Update New Record') }}</li>
               </ol>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- Main content -->
   <div class="row card">
      <div class="col-md-12 card-body ">
         <div class="box box-primary">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
               <link rel="stylesheet" href="{{ asset('css/tablednd.css') }}" type="text/css"/>
               <div class="tableDemo">
                  <table class="table table-striped" id="table-2">
                     <thead>
                        <tr>
                           <th>Slno.</th>
                           <th><input type="checkbox" name="main_check" id="main_check" onclick="check_uncheck_All_records()" value="Checkbox" /><span style="display:none">Checkbox</span></th>
                           <th> Name</th>
                           <th>Slug Url</th>
                           <th>Position</th>
                           <th>Published</th>
                           <th>Added On</th>
                           <th>Updated On</th>
                           <th>Edit</th>
                        </tr>
                     </thead>
                     <tbody id="bannerList">
                        <tr>
                           <td colspan="10">
                              <div class="clearfix text-center" >
                                 <img  src="{{ asset('css/load.gif') }}" />
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <div class="result"></div>
               </div>
           
               <script src="{{ asset('css/jquery.tablednd.js') }}" type="text/javascript"></script>
               <script>
                  function dragEvent()
                  {
                  table_2 = $("#table-2");
                  table_2.find("tr:even").addClass("alt");
                  
                  $("#table-2").tableDnD({
                    onDragClass: "myDragClass",
                  onDrop: function(table, row) {
                  	var rows = table.tBodies[0].rows;
                  		var podId = '';
                  	for (var i=0; i<rows.length; i++) {
                  	podId+= rows[i].id+",";
                  	}
                  
                  	$('#bannerList').html('<tr><td colspan="10"> <div class="clearfix text-center" ><img  src="{{ asset('css/load.gif') }}" /></div></td></tr>');
                  	$.ajax({
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                     url: '{{ route('department.GetCompleteCategoryListNewPos') }}',
                     //dataType : "json",
                     data : {"banner_id" : '{{ $banner_id }}' ,'podId':podId, 'csrf-token': "{{ csrf_token() }}" },
                     success : function(result){
                  	  // alert(result);
                  		$('#bannerList').html(result);
                  		$(table).parent().find('.result').text("Order Changed Successfully");
                  		dragEvent();
                  		}
                     });
                  
                  },
                  onDragStart: function(table, row) {
                  $(table).parent().find('.result').text("Started dragging row id "+row.id);
                  
                  },
                  
                  });
                  
                  }
                  
                  
               </script>
            </div>
         </div>
      </div>
   </div>
   <!-- /.content -->
   </x-app-layout>
