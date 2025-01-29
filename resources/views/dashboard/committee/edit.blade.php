<x-app-layout>
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">
                  @if($page_module_name != '') 
                     {{ $page_module_name }}
                  @else 
                     {{ 'NONE' }} 
                  @endif
               </h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('department.index') }}">
                     @if($page_module_name != '') 
                        {{ $page_module_name }} 
                     @else 
                        {{ 'NONE' }} 
                     @endif List</a>
                  </li>
                  <li class="breadcrumb-item">{{ __('Update New Record') }}</li>
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
                  <h3 class="card-title">
                     <small>{{ __('Update New Record') }}</small>
                  </h3>
               </div>
               <div class="card-body">
                  <form method="POST" action="{{ route('grievance_committees.update', $grievance_committees->slug) }}" id="ptype_list_form" class="form-horizontal" enctype="multipart/form-data">
                     @csrf
                     @method('PUT')

                     <input type="hidden" name="department_id" value="{{ $grievance_committees->id }}">
                     <input type="hidden" name="user_name" value="{{ Auth::user()->name }}">
                     <input type="hidden" name="redirect_type" id="redirect_type" value="">

                     <div class="form-group row">
                        <!-- Name Field -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                     <x-label for="name" class="label_content px-2 py-0" value="Committee Name (*)" />

                           <x-input id="name" type="text" name="name" :value="$grievance_committees->name" required class="block mt-1 w-full" />
                           @error('name')
                              <div class="error text-danger">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Designation Field -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                           <x-label for="designation" class="label_content px-2 py-0" value="Committee head (*)" />
                           <x-input id="designation" type="text" name="designation" :value="old('designation', $grievance_committees->designation ?? '')" required class="block mt-1 w-full" />
                           @error('designation')
                              <div class="error text-danger">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Grievance Related To Field -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                           <x-label for="grievance_related_to" class="label_content px-2 py-0" value="Committee Members(*)" />
                           <x-input id="grievance_related_to" type="text" name="grievance_related_to" :value="old('grievance_related_to', $grievance_committees->grievance_related_to ?? '')" required class="block mt-1 w-full" />
                           @error('grievance_related_to')
                              <div class="error text-danger">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Contact Field -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                           <x-label for="contact" class="label_content px-2 py-0" value="Contact (*)" />
                           <x-input id="contact" type="text" name="contact" :value="old('contact', $grievance_committees->contact ?? '')" required class="block mt-1 w-full" />
                           @error('contact')
                              <div class="error text-danger">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                           <x-label for="email" class="label_content px-2 py-0" value="Email (*)" />
                           <x-input id="email" type="email" name="email" :value="old('email', $grievance_committees->email ?? '')" required class="block mt-1 w-full" />
                           @error('email')
                              <div class="error text-danger">{{ $message }}</div>
                           @enderror
                        </div>

                        <!-- Status Radio Buttons -->
                        <div class="col-md-6 col-sm-12">
                           <x-label for="status" class="label_content px-2 py-0" value="{{ __('Status(*)') }}" />
                           <div class="form-check">
                              <div class="form-group clearfix">
                                 <div class="icheck-success d-inline">
                                    <input type="radio" name="status" value="1" {{ $grievance_committees->status == 1 ? 'checked' : '' }} id="Active" required>
                                    <label for="Active">{{ __('Active') }}</label>
                                 </div>
                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 <div class="icheck-danger d-inline">
                                    <input type="radio" name="status" value="0" {{ $grievance_committees->status == 0 ? 'checked' : '' }} id="Block" required>
                                    <label for="Block">{{ __('Block') }}</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <!-- Submit Buttons -->
                     <div class="card-footer">
                        <center>
                           <button type="submit" name="save" onclick="return redirect_type_func('')" value="save" class="btn btn-info">{{ __('Update') }}</button>
                           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <button type="submit" name="save" onclick="return redirect_type_func('save-add-new')" value="save-add-new" class="btn btn-default">{{ __('Update And Add New') }}</button>
                        </center>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- JavaScript -->
   <script>
      function redirect_type_func(data) {
         document.getElementById("redirect_type").value = data;
         return true;
      }

    
   </script>
</x-app-layout>
