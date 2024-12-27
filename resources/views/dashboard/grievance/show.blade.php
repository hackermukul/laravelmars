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
                                    <span class="badge badge-success">
                                       <i class="fas fa-check"></i> Active
                                    </span>
                                 @elseif($view_data[0]->status ==0)
                                    <span class="badge badge-danger">
                                       <i class="fas fa-ban"></i> Blocked
                                    </span>
                                 @elseif($view_data[0]->status ==2)
                                    <span class="badge badge-warning">
                                       <i class="fas fa-archive"></i> Closed
                                    </span>
                                 @else
                                    <span class="badge badge-secondary">
                                       Unknown
                                    </span>
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
   <section class="content">
      <div class="row">
         <div class="col-12">
            <div class="card">
               @if(session('success'))
               <div class="alert alert-success">
                  {{ session('success') }} - 
                  {{ \Carbon\Carbon::parse(session('timestamp'))->diffForHumans() }}
               </div>
               @endif
               @if($user_access->view_module == 1)
               <div class="card">
                  <div class="card-body">
<h5 class="mt-4">Previous Replies</h5>
@foreach($replies as $reply)
   <div class="d-flex justify-content-{{ isset($reply->management_id) ? 'end' : 'start' }} mb-2">
      <div class="card w-75 {{ isset($reply->management_id) ? 'bg-light' : 'bg-white' }}">
         <div class="card-body">
            <p>{{ $reply->reply }}</p>
            @if($reply->attachment)
               <a href="{{ asset($reply->attachment) }}" target="_blank">View Attachment</a>
            @endif
            <span class="text-muted small float-right timestamp">
               {{ \Carbon\Carbon::parse($reply->created_at)->diffForHumans() }}
            </span>
         </div>
      </div>
   </div>
@endforeach



                     <form action="{{ route($main_routes.'.updateReply') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <textarea name="reply" required class="form-control" rows="4" placeholder="Enter your reply"></textarea>
                        <div class="mt-2">
                           <input type="hidden" name="id" value=" {{ $view_data[0]->id}}" class="form-control">
                           
                           <input type="file" name="attachment" class="form-control">
                        </div>
                        <div class="mt-2">
                           <label for="status">Status:</label>
                           <select name="status" required class="form-control">
                           <option value="0" {{ $view_data[0]->status == '0' ? 'selected' : '' }}>Pending</option>
                           <option value="1" {{ $view_data[0]->status == '1' ? 'selected' : '' }}>In Process</option>
                           <option value="2" {{ $view_data[0]->status == '2' ? 'selected' : '' }}>Closed</option>
                           </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit Reply</button>
                     </form>
                    
                  </div>
               </div>
               @else
               <center>
                  <x-denied />
               </center>
               @endif
            </div>
         </div>
      </div>
   </section>
</x-app-layout>