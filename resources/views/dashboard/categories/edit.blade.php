
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
                  <li class="breadcrumb-item"><a href="{{ route('categories.index') }}"> @if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif List</a></li>
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
                    <form method="POST" action="{{ route('categories.update', $category->slug) }}"  id="ptype_list_form" name="ptype_list_form" style="" class="form-horizontal" role="form" enctype="multipart/form-data" accept-charset="utf-8">
                     @csrf
                       @method('PUT')
                    <input type="hidden" name="category_id" id="category_id" value="">
                     <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}" >
                     <input type="hidden" name="redirect_type" id="redirect_type" value="">  <input type="hidden" name="id" value="0" id="id">
                     <input type="hidden" name="redirect_type" value="" id="redirect_type">
                     <div class="">
                        <div class="form-group row">
                           <div class="col-lg-4 col-md-4 col-sm-6">
                            <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Name(*)') }}" />
                              <div class="col-sm-12">
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$category->name" required autofocus autocomplete="name" />
                                 <span>
                                    @error('name')
                                        <div class="error" style="color: red">{{ $errors }}</div>
                                    @enderror
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-4 col-sm-6">
                                <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Content') }}" />
                              <div class="col-sm-12">
                                <x-input id="content" class="block mt-1 w-full" type="text" name="content" :value="$category->content"  autofocus autocomplete="content" />
                                   <span>
                                   @if($errors->has('content'))
                                        <div class="error" style="color: red">{{ $errors->first('content') }}</div>
                                    @endif
                                    <!--@error('content')
                                        <div class="error" style="color: red">{{ $errors }} </div>
                                    @enderror-->
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-4 col-sm-6">
                              <x-label for="Category" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Upload Image(*)') }}" />
                              <div class="col-sm-12 d-flex">
                                 <div class="input-group" style="width:90%">
                                    <div class="custom-file">
                                       <input type="file" name="cover_image" class="custom-file-input" id="files" :value="old('image')" @if($category->image=='') {{ 'required'}} @endif >
                                       <label class="custom-file-label form-control-sm" for="files"></label>
                                        
                                    </div>
                                 </div>
                                 
                                 <div class="custom-file-display">
                                 
                                     	@if($category->image != '')
                                          <span class="pip">
                                          <a target="_blank" href="{{ config('constants.options.MAINSITE').'build/assets/uploads/'.$category->image }}">
                                          <img class="imageThumb" src="{{ config('constants.options.MAINSITE').'build/assets/uploads/'.$category->image }}" />
                                          </a>
                                          </span>
                                        @else 
                                          <span class="pip">
                                          <img class="imageThumb" src="{{ config('constants.options.MAINSITE').'build/assets/uploads/no-img.png' }}" />
                                          </span>
                                       @endif

                                 
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-6 col-sm-6">
                              <x-label for="radioSuccess1" class="ccol-sm-12 label_content px-2 py-0" value="{{ __('Status(*)') }}" />
                              <div class="col-sm-6">
                                 <div class="form-check" style="">
                                    <div class="form-group clearfix">
                                       <div class="icheck-success d-inline">
                                          <input type="radio" name="status" value="1"  {{ old('status') == $category->status ? 'checked' : 'checked' }} id="Active" required="required" class="label-active">
                                          <label for="Active">{{ __('Active') }}</label>                                    
                                       </div>
                                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       <div class="icheck-danger d-inline">
                                          <input type="radio" name="status" value="0" {{ old('status') == $category->status ? 'checked' : '' }} id="Block" required="required" class="label-block">
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
</x-app-layout>