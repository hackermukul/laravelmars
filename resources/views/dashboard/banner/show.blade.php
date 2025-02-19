<x-app-layout>
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">@if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif </h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="">Home</a></li>
               <li class="breadcrumb-item"><a href="{{ route('banner_module.index') }}">  @if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif  List</a></li>
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
               <h3 class="card-title">@if($banner[0]->name) {{ $banner[0]->name}} @else {{'N/A'}} @endif</h3>
               <div class="float-right">
               @if($user_access->add_module==1)	
                  <a href="{{ route('banner_module.create') }}"> 
                  <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add
                  New</button></a>
                   @endif
                   @if($user_access->update_module==1)
                  <a href="{{ route('banner_module.edit', $banner[0]->slug) }}"> 
                  <button type="button" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Update</button>
                  </a>
                    @endif
                  
               </div>
            </div> 
                 @if($user_access->view_module==1)
            <!-- /.card-header -->
            <div class="card-body">
               <form action="" name="ptype_list_form" method="post" class="form-horizontal" role="form">
                  <input type="hidden" name="task" id="task" value="">
                  <div class="divTable">
                     <div class="TableRow">
                        <div class="table_col">
                           <label class="label_content_br">Data Base Id <span class="colen">:</span></label>
                            @if($banner[0]->id) {{ $banner[0]->id}} @else {{'N/A'}} @endif                            
                        </div>
                        <div class="table_col">
                           <label class="label_content_br">Name <span class="colen">:</span></label>
                            @if($banner[0]->name) {{ $banner[0]->name}} @else {{'N/A'}} @endif                                   
                        </div>
                        <div class="table_col">
                           <label class="label_content_br">Short Content <span class="colen">:</span></label>
                            @if($banner[0]->title1) {{ $banner[0]->title1}} @else {{'N/A'}} @endif                                      
                        </div>
                        <div class="table_col">
                           <label class="label_content_br">Position <span class="colen">:</span></label>
                            @if($banner[0]->position) {{ $banner[0]->position}} @else {{'N/A'}} @endif                                      
                                    
                        </div>
                        <div class="table_col">
                           <label class="label_content_br">Added On <span class="colen">:</span></label>
                          @if(!empty($banner[0]->created_at)) {{ date('d-m-Y H:i:s A', strtotime($banner[0]->created_at)) }}  @else {{'N/A'}} @endif                               
                        </div>
                     </div>
                     <div class="TableRow">
                        <div class="table_col">
                           <label class="label_content_br">Added By <span class="colen">:</span></label>
                            @if($banner[0]->added_by_name) {{ $banner[0]->added_by_name}} @else {{'N/A'}} @endif                                      
                                    
                        </div>
                        <div class="table_col">
                           <label class="label_content_br">Slug Url <span class="colen">:</span></label>
                            @if($banner[0]->slug) {{ $banner[0]->slug}} @else {{'N/A'}} @endif                                      
                                    
                        </div>

                         <div class="table_col">
                           <label class="label_content_br">Cover Image<span class="colen">:</span></label>
                              @if($banner[0]->image)
                                 <img src="{{ asset($banner[0]->image) }}" style="height:200px;">
                              @endif
                        </div>
                        
                        <div class="table_col">
                           <label class="label_content_br">Status <span class="colen">:</span></label>
                             @if($banner[0]->status ==1)
                                    <i class="fas fa-check btn-success btn-sm "></i>Active
                                    @else
                                    <i class="fas fa-ban btn-danger btn-sm "></i>Block
                                 @endif
                        </div>
                     </div>
                  </div>
                  <table id="" class="table table-bordered table-hover myviewtable" style="display:none;">
                     <tbody>
                        <tr>
                           <td>
                              <strong class="full">Data Base Id</strong>
                              {{ $banner[0]->id}}
                           </td>
                           <td>
                              <strong class="full">Country</strong>
                              
                           </td>
                           <td>
                              <strong class="full">Short Name</strong>
                              92
                           </td>
                           <td>
                              <strong class="full">Country Code</strong>
                              012
                           </td>
                           <td>
                              <strong class="full">Added On</strong>
                              10-10-2023 11:48:18 PM
                           </td>
                           <td>
                              <strong class="full">Added By</strong>
                              test
                           </td>
                           <td>
                              <strong class="full">Updated On</strong>
                              17-08-2024 03:59:44 PM
                           </td>
                           <td>
                              <strong class="full">Updated By</strong>
                              test
                           </td>
                           <td>
                              <strong class="full">Status</strong>
                              Block <i class="fas fa-ban btn-danger btn-sm "></i> Block
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </form>
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
</section>
</x-app-layout>