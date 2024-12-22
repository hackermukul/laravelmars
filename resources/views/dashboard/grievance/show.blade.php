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
               <li class="breadcrumb-item"><a href="{{ route($main_routes.'.index') }}">  @if($page_module_name != '' ) {{ $page_module_name; }} @else {{ 'NONE'}} @endif  List</a></li>
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
               <h3 class="card-title">@if($view_data[0]->customer_name) {{ $view_data[0]->customer_name}} @else {{'N/A'}} @endif</h3>
               <div class="float-right">
               @if($user_access->add_module==1)	
                     
                        @endif
                  @if($user_access->update_module==1)
                  
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
                            @if($view_data[0]->id) {{ $view_data[0]->id}} @else {{'N/A'}} @endif                            
                        </div>
                        <div class="table_col">
                           <label class="label_content_br">Name <span class="colen">:</span></label>
                            @if($view_data[0]->customer_name) {{ $view_data[0]->customer_name}} @else {{'N/A'}} @endif                                   
                        </div>
                        
                        <div class="table_col">
                           <label class="label_content_br">subject <span class="colen">:</span></label>
                         @if($view_data[0]->subject) {{ $view_data[0]->subject}} @else {{'N/A'}} @endif                                   
                
                                    
                        </div>
                     </div>
                      <div class="TableRow">
                         <div class="table_col">
                           <label class="label_content_br">Grievance <span class="colen">:</span></label>
                         @if($view_data[0]->grievance) {{ $view_data[0]->grievance}} @else {{'N/A'}} @endif                                   
                
                                    
                        </div>
                        
                     </div>

                     <div class="TableRow">
                        <div class="table_col">
                           <label class="label_content_br">Added By <span class="colen">:</span></label>
                            @if($view_data[0]->added_by_name) {{ $view_data[0]->added_by_name}} @else {{'N/A'}} @endif                                      
                                    
                        </div>
                        

                         
                         <div class="table_col">
                           <label class="label_content_br">Added On <span class="colen">:</span></label>
                          @if(!empty($view_data[0]->created_at)) {{ date('d-m-Y H:i:s A', strtotime($view_data[0]->created_at)) }}  @else {{'N/A'}} @endif                               
                        </div>

                        <div class="table_col">
                           <label class="label_content_br">Status <span class="colen">:</span></label>
                             @if($view_data[0]->status ==1)
                                    <i class="fas fa-check btn-success btn-sm "></i>Active
                                    @else
                                    <i class="fas fa-ban btn-danger btn-sm "></i>Block
                                 @endif
                        </div>
                     </div>
                  </div>
                  
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