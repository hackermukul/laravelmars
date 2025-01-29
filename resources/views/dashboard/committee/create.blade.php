<x-app-layout>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">
                  @if($page_module_name != '' )
                     {{ $page_module_name }}
                  @else 
                     {{ 'NONE'}}
                  @endif
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route($main_routes.'.index') }}">
                     @if($page_module_name != '' ) {{ $page_module_name }} @else {{ 'NONE' }} @endif List
                  </a></li>
                  <li class="breadcrumb-item">Add New Record</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <section class="content">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title"><small>Add New Record</small></h3>
               </div>
               @if(Session::has('success'))
                  <div class="alert alert-success alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                     <i class="icon fas fa-check"></i>{{ Session::get('success') }}
                  </div>
               @elseif(Session::has('error'))
                  <div class="alert alert-danger alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                     <i class="icon fas fa-ban"></i>{{ Session::get('error') }}
                  </div>
               @endif
               <div class="card-body">
                  <form method="POST" action="{{ route($main_routes.'.store') }}" id="ptype_list_form" class="form-horizontal" role="form" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group row">
                        <!-- Name Field -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                           <x-label for="name" class="label_content px-2 py-0" value="Committee Name (*)" />
                           <x-input id="name" type="text" name="name" :value="old('name')" required autofocus class="block mt-1 w-full" />
                           @error('name')
                              <div class="error" style="color: red">{{ $message }}</div>
                           @enderror
                        </div>
                        
                        <!-- Designation Field -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                           <x-label for="designation" class="label_content px-2 py-0" value="Committee head (*)" />
                           <x-input id="designation" type="text" name="designation" :value="old('designation')" required class="block mt-1 w-full" />
                           @error('designation')
                              <div class="error" style="color: red">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Grievance Related To Field -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                           <x-label for="grievance_related_to" class="label_content px-2 py-0" value="Committee Members(*)" />
                           <x-input id="grievance_related_to" type="text" name="grievance_related_to" :value="old('grievance_related_to')" required class="block mt-1 w-full" />
                           @error('grievance_related_to')
                              <div class="error" style="color: red">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Contact Field -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                           <x-label for="contact" class="label_content px-2 py-0" value="Contact (*)" />
                           <x-input id="contact" type="text" name="contact" :value="old('contact')" required class="block mt-1 w-full" />
                           @error('contact')
                              <div class="error" style="color: red">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                           <x-label for="email" class="label_content px-2 py-0" value="Email (*)" />
                           <x-input id="email" type="email" name="email" :value="old('email')" required class="block mt-1 w-full" />
                           @error('email')
                              <div class="error" style="color: red">{{ $message }}</div>
                           @enderror
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
                     <!-- Submit Buttons -->
                     <div class="card-footer">
                        <center>
                           <button type="submit" name="save" class="btn btn-info">Save</button>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <button type="submit" name="save-add-new" value="save-add-new" class="btn btn-default">Save And Add New</button>
                        </center>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</x-app-layout>
