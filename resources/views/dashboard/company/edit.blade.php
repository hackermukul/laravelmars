
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
                    <form method="POST" action="{{ route($main_routes.'.update', $companyProfile->slug) }}"  id="ptype_list_form" name="ptype_list_form" style="" class="form-horizontal" role="form" enctype="multipart/form-data" accept-charset="utf-8">
                     @csrf
                       @method('PUT')
                    <input type="hidden" name="department_id"  value="{{ $companyProfile->id }}">
                     <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}" >
                     <input type="hidden" name="redirect_type" id="redirect_type" value="">  <input type="hidden" name="id" value="0" id="id">
                     <input type="hidden" name="redirect_type" value="" id="redirect_type">
                     <div class="">
                        <div class="form-group row">
                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Unique Name(*)') }}" />
                              <div class="col-sm-12">
                                <x-input id="unique_name" class="block mt-1 w-full" type="text" name="unique_name" :value="$companyProfile->unique_name" required autofocus autocomplete="name" />
                                 <span>
                                    @error('unique_name')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Name(*)') }}" />
                              <div class="col-sm-12">
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$companyProfile->name" required autofocus autocomplete="name" />
                                 <span>
                                    @error('name')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Website(*)') }}" />
                              <div class="col-sm-12">
                                <x-input id="website" class="block mt-1 w-full" type="text" name="website" :value="$companyProfile->website" required autofocus autocomplete="website" />
                                 <span>
                                    @error('website')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div><br><br><br><br>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Email(*)') }}" />
                              <div class="col-sm-12">
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$companyProfile->email" required autofocus autocomplete="email" />
                                 <span>
                                    @error('email')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('First Name') }}" />
                              <div class="col-sm-12">
                                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="$companyProfile->first_name"  autofocus autocomplete="first_name" />
                                 <span>
                                    @error('first_name')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Last Name') }}" />
                              <div class="col-sm-12">
                                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="$companyProfile->last_name"  autofocus autocomplete="last_name" />
                                 <span>
                                    @error('last_name')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div><br><br><br><br>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Mobile No(*)') }}" />
                              <div class="col-sm-12">
                                <x-input id="mobile_no" class="block mt-1 w-full" type="number" name="mobile_no" :value="$companyProfile->mobile_no" required autofocus autocomplete="mobile_no" />
                                 <span>
                                    @error('mobile_no')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Alt Mobile No.') }}" />
                              <div class="col-sm-12">
                                <x-input id="alt_mobile_no" class="block mt-1 w-full" type="number" name="alt_mobile_no" :value="$companyProfile->alt_mobile_no"  autofocus autocomplete="alt_mobile_no" />
                                 <span>
                                    @error('alt_mobile_no')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Description') }}" />
                              <div class="col-sm-12">
                                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$companyProfile->short_description" required autofocus autocomplete="description" />
                                 <span>
                                    @error('description')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div><br><br><br><br>



                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Address') }}" />
                              <div class="col-sm-12">
                                <x-input id="address1" class="block mt-1 w-full" type="text" name="address1" :value="$companyProfile->address1"  autofocus autocomplete="address1" />
                                 <span>
                                    @error('address1')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>

                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Pincode') }}" />
                              <div class="col-sm-12">
                                <x-input id="pincode" class="block mt-1 w-full" type="text" name="pincode" :value="$companyProfile->pincode"  autofocus autocomplete="pincode" />
                                 <span>
                                    @error('pincode')
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
                                       <option value="<?php echo $countryname->id; ?>"<?php
                                          if (isset($country_id) && Input::old('country_id') or $companyProfile->country_id == $countryname->id) 
                                          {
                                             echo 'selected="selected"';
                                          }
                                          ?>>
                                          {{ $countryname->name }}
                                    </option>
                                    <?php endforeach; ?>
                                 </select>
                                 <span>
                                    @error('address1')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div><br><br><br><br>


                           

                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('State') }}" />
                              <div class="col-sm-12">
                                 <select class="block mt-1 w-full select2" id="state_id" name="state_id" style="height:50px;" required onchange ="getCity(this.value, 0)">
                                    <option value="">Please select</option>
                                    
                                 </select>                              
                                 <span>
                                    @error('address1')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>


                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('city') }}" />
                              <div class="col-sm-12">
                                 <select class="block mt-1 w-full select2" id="city_id" name="city_id" style="height:50px;" required > 
                                    <option value="">Please select</option>
                                    
                                 </select>                              
                                 <span>
                                    @error('address1')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>

                           {{-- <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Header Color') }}" />
                              <div class="col-sm-12">
                                <x-input id="header_color" class="block mt-1 w-full" type="color" name="header_color" :value="$companyProfile->header_color"  autofocus autocomplete="header_color" />
                                 <span>
                                    @error('header_color')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div><br><br><br><br>


                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="department" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('footer Color') }}" />
                              <div class="col-sm-12">
                                <x-input id="footer_color" class="block mt-1 w-full" type="color" name="footer_color" :value="$companyProfile->footer_color"  autofocus autocomplete="footer_color" />
                                 <span>
                                    @error('footer_color')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>--}}

                           <div class="col-md-4 col-sm-6">
                              <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Upload logo(*)') }}" />
                              <div class="col-sm-12 d-flex">
                              <input type="file" name="logo" class="form-control">
                                 
                               
                              </div>
                           </div>



                            <div class="col-md-6 col-sm-6">
                              <x-label for="radioSuccess1" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Status(*)') }}" />
                              <div class="col-sm-6">
                                 <div class="form-check" style="">
                                    <div class="form-group clearfix">
                                       <div class="icheck-success d-inline">
                                          <input type="radio" name="status" value="1"  {{ old('status') == $companyProfile->status ? 'checked' : 'checked' }} id="Active" required="required" class="label-active">
                                          <label for="Active">{{ __('Active') }}</label>                                    
                                       </div>
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       <div class="icheck-danger d-inline">
                                          <input type="radio" name="status" value="0" {{ old('status') == $companyProfile->status ? 'checked' : '' }} id="Block" required="required" class="label-block">
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
                              <button type="submit" name="save" onclick="return redirect_type_func('')" value="save" class="btn btn-info">  {{ __('Update') }}</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="submit" name="save" onclick="return redirect_type_func('save-add-new')" value="save-add-new" class="btn btn-default ">{{ __('Update And Add New') }}</button>
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
       window.onload = function() {
   @if($companyProfile->country_id != '' || $companyProfile->state_id != '')
     getState({{ $companyProfile->country_id }} , {{ $companyProfile->state_id }} );
      getCity({{ $companyProfile->state_id }} , {{ $companyProfile->city_id }} );

   @endif
};
 
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

</script>
</x-app-layout>