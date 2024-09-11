
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
                    <form method="POST" action="{{ route($main_routes.'.store') }}"  id="ptype_list_form" name="ptype_list_form" style="" class="form-horizontal" role="form" enctype="multipart/form-data" accept-charset="utf-8">
                     @csrf
                    <input type="hidden" name="id" id="id" value="">
                     <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}" >
                     <input type="hidden" name="redirect_type" id="redirect_type" value="">  <input type="hidden" name="id" value="0" id="id">
                     <input type="hidden" name="redirect_type" value="" id="redirect_type">
                     <div class="">
                        <div class="form-group row">
                           <div class="col-lg-4 col-md-4 col-sm-6">
                               <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Country(*)') }}" />
                              <div class="col-sm-12">
                                 <select class="block mt-1 w-full select2" id="country_id" name="country_id" style="height:50px;" required  onchange="getState(this.value ,0)">
                                    <option value="">Please select</option>
                                       <?php foreach ($countryname as $key=>$countryname): ?>
                                       <option value="<?php echo $countryname->id; ?>"<?php
                                          if (isset($country_id) && Input::old('country_id') == $countryname->id) 
                                          {
                                             echo 'selected="selected"';
                                          }
                                          ?>>
                                          {{ $countryname->name }}
                                    </option>
                                    <?php endforeach; ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-lg-4 col-md-4 col-sm-6">
                               <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('State(*)') }}" />
                              <div class="col-sm-12">
                                 <select name="state_id" id="state_id" class="block mt-1 w-full select2">

                                 </select>
                              </div>
                           </div>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Name(*)') }}" />
                              <div class="col-sm-12">
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                 <span>
                                    @error('name')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>
                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('City Code') }}" />
                              <div class="col-sm-12">
                                <x-input id="city_code" class="block mt-1 w-full" type="text" name="city_code" :value="old('city_code')" autofocus autocomplete="name" />
                                 <span>
                                    @error('city_code')
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
				url: "{{ route($main_routes.'.getState') }}",
				type: 'post',
				dataType: "json",
				data: {	'country_id' : country_id , 'state_id' : state_id,'csrf-token':"{{ csrf_token() }}" },
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
</x-app-layout>