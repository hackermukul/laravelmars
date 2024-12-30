@section('title', 'Add Grievance')
<x-base-layout>
   <div class="container">
      <div class="row">
         <!-- Dashboard Sidebar Menu -->
         <div class="col-md-3">
            <div class="card">
               <div class="card-header">
                  <h4>Dashboard Menu</h4>
               </div>
               @include('cauth.dashboard-menu')
            </div>
         </div>

         <!-- Main Content for Grievance's Reply -->
         <div class="col-md-9">
            <div class="card">
               <div class="card-header">
                  <h3>Grievance's Reply</h3>
               </div>
               <div class="card-body">
                  <div class="container">
                     <!-- Grievance Details -->
                     <div class="card mb-3">
                        <div class="card-header">
                           <h4>{{ $grievance->subject }} ({{ $grievance->related_to }})</h4>
                        </div>
                        <div class="card-body">
                           <p>{{ $grievance->grievance }}</p>
                             @if ($grievance->document_path)
                           <a href="{{ asset($grievance->document_path) }}" target="_blank">View Document</a>
                                @else
                                    N/A
                                @endif
                        </div>
                     </div>

                     <!-- Replies Section -->
                     <div class="mb-3">
   <h5>Replies</h5>
   @foreach ($replies as $reply)
      @php
         // Get the time difference for the reply
         $diff = Carbon\Carbon::parse($reply->created_at)->diffForHumans();

         // Set a default color class
         $colorClass = 'text-muted';  // Default color

         // Check the reply's creation time and assign color classes based on that
         $created_at = Carbon\Carbon::parse($reply->created_at);
         if ($created_at->isToday()) {
             $colorClass = 'text-success';  // Green for today's reply
         } elseif ($created_at->isThisWeek()) {
             $colorClass = 'text-primary';  // Blue for this week's replies
         } elseif ($created_at->isLastWeek()) {
             $colorClass = 'text-warning';  // Yellow for last week's replies
         } elseif ($created_at->isYesterday()) {
             $colorClass = 'text-danger';  // Red for yesterday's replies
         }
      @endphp

      <div class="card mb-2">
         <div class="card-header">
          <small class="{{ $colorClass }}">
    Reply  
    @if(isset($reply->management_id))
        received from Committee
    @else
        sent to Committee
    @endif
    {{ $diff }}
</small>


         </div>
         <div class="card-body">
            <p>{{ $reply->reply }}</p>
            @if ($reply->attachment)
                 <a href="{{ asset($reply->attachment) }}" target="_blank">View Document</a>
            @endif
         </div>
      </div>
   @endforeach
</div>


                     <!-- Form to Submit Reply -->
                     <form action="{{ route('grievances.reply.store', $grievance->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="grievance_id" value="{{ $grievance->id }}">
                        <!-- Reply Textarea -->
                        <div class="form-group">
                           <label for="reply">Reply</label>
                           <textarea name="reply" id="reply" class="form-control" rows="4" required></textarea>
                        </div>

                        <!-- Attachment Input -->
                        <div class="form-group">
                           <label for="attachment">Attachment</label>
                           <input type="file" name="attachment" id="attachment" class="form-control">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Reply</button>
                     </form>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</x-base-layout>
