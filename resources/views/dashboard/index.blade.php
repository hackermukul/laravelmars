<x-app-layout>
   <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
         {{ __('Dashboard') }}
      </h2>
   </x-slot>
   <div class="py-12">
   <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
         <!--<x-welcome />-->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1 class="m-0">Notification</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                     </ol>
                  </div>
                  <!-- /.col -->
               </div>
               <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
         </div>
         <section class="content">
            <div class="container-fluid">
               <!-- Small boxes (Stat box) -->
            
               <!-- /.row -->
               <!-- Main row -->
               <div class="row">
                  <!-- Left col -->
                  <section class="col-lg-12 connectedSortable ui-sortable">
                    
                     <!-- /.card -->
                     <!-- DIRECT CHAT -->
                     <div class="card direct-chat direct-chat-primary">
                        <!-- /.card-header -->
                        <div class="card-body">
                           <div class="card-body">
                              
                                 <input type="hidden" name="task" id="task" value ="" />
                                 <table id="example1" class="table table-bordered table-hover table-striped">
                                    <thead>
                                       <tr>
                                          <th>#</th>
                                        
                                             <th>Customer Name</th>
                                             <th>Reply</th>
                                          <th>Subject</th>
                                          <th>Related </th>
                                          <th>Grievance ID</th>
                                         
                                          <th>Document</th>
                                          <th>Messages Ago</th>
                                         
                                          <th>Status</th>
                                       </tr>
                                    </thead>
                                    @if(!empty($data_listing))
                                    <tbody>
                                       @php($count = 0)
                                       @foreach ($data_listing as $row)
                                       @php($count++)
                                       <tr class="">
                                          <td>{{ $count }}</td>
                                          
                                        <td><a href="{{ route('grievance.show', ['id' => $row->g_id]) }}">
                                            {{ $row->customer_name ?: 'N/A' }}
                                        </a></td>
                                         <td>{{ $row->reply ?: 'N/A' }}</td>
                                        <td>{{ $row->subject ?: 'N/A' }}</td>
                                        

                                          <td>{{ $row->realted_to ?: 'N/A' }}</td>
                                          <td>{{ $row->id ?: 'N/A' }}</td>
                                          <td>@if($row->attachment)
               <a href="{{ asset($row->attachment) }}" target="_blank">View Attachment</a>
            @endif</td>
                          
                                         
                                           <td>
<?php
      // Parse the created_at timestamp to Carbon instance
      $created_at = \Carbon\Carbon::parse($row->created_at);

      // Calculate the difference in days
      $diffInDays = $created_at->diffInDays();

      // Get the human-readable time difference
      $diff = $created_at->diffForHumans();

      // Determine the color class based on how old the message is
      $colorClass = 'text-success'; // Default to green (new)

      // Check the difference in days to set colors
      if ($created_at->isToday()) {
          $colorClass = 'text-success'; // Green for today
      } elseif ($diffInDays <= 7) {
          $colorClass = 'text-warning'; // Yellow for within a week
      } elseif ($diffInDays > 7 && $diffInDays <= 30) {
          $colorClass = 'text-primary'; // Blue for within a month
      } else {
          $colorClass = 'text-danger'; // Red for older than a month
      }
   ?>

   <!-- Display the "Messages Ago" with color -->
   <span class="{{ $colorClass }}">{{ $diff }}</span>
</td>


                                          <td>
                                            <?php if($row->status == 0) { ?>
    <button class="btn btn-warning blinking-button">New Message</button>
<?php } ?> 
                                             @switch($row->sts)
                                             @case(1)
                                             <span class="badge badge-success">
                                             <i class="fas fa-check"></i> In Process
                                             </span>
                                             @break
                                             @case(0)
                                             <span class="badge badge-danger">
                                             <i class="fas fa-ban"></i> Pending
                                             </span>
                                             @break
                                             @case(2)
                                             <span class="badge badge-warning">
                                             <i class="fas fa-archive"></i> Closed
                                             </span>
                                             @break
                                             @default
                                             <span class="badge badge-secondary">Unknown</span>
                                             @endswitch
                                          </td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                    @endif
                                 </table>
                             
                           </div>
                           <!-- /.card-body -->
                           
                           <!-- /.card-footer-->
                        </div>
                        <!--/.direct-chat -->
                        <!-- TO DO List -->
                        <!-- /.card -->
                  </section>
                  <!-- /.Left col -->
                  </div>
                  <!-- /.row (main row) -->
               </div>
               <!-- /.container-fluid -->
         </section>
         </div>
      </div>
   </div>
<!-- Blinking Effect CSS -->
   <style>
     /* Define the blinking effect */
@keyframes blink {
    0% {
        background-color: #ffcc00; /* Yellow background */
    }
    50% {
        background-color: #ff6600; /* Orange background */
    }
    100% {
        background-color: #ffcc00; /* Yellow background */
    }
}

/* Apply the blinking effect to the button */
.blinking-button {
    animation: blink 1s infinite; /* Blink every 1 second */
    color: white; /* Text color */
    border: none; /* Remove default border */
    padding: 5px 15px; /* Smaller padding (height reduced) */
    font-size: 14px; /* Smaller font size */
    border-radius: 5px; /* Rounded corners */
}


   </style>
</x-app-layout>