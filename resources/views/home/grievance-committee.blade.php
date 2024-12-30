@section('title', 'Parent Registration')
<x-base-layout>
 
<br><br><br>
   <div class="container">
       <div class="card">
           <div class="card-header text-center">
               <h4>Grievance Committee</h4>
           </div>
           <div class="card-body">
               @if(session('success'))
                   <div class="alert alert-success">{{ session('success') }}</div>
               @endif

               <div class="table-responsive">
                   <table class="table custom-table" aria-label="Grievance Committee Members">
                       <thead class="table-light">
                           <tr>
                               <th>Name</th>
                               <th>Designation</th>
                               <th>Grievance Related to</th>
                               <th>Contact</th>
                               <th>Email</th>
                           </tr>
                       </thead>
                      <tbody>
    @if ($committeeMembers->isNotEmpty())
        @foreach ($committeeMembers as $member)
            <tr>
                <td>{{ $member->name }}</td>
                <td>{{ $member->designation }}</td>
                <td>{{ $member->grievance_related_to }}</td>
                <td>{{ $member->contact }}</td>
                <td>{{ $member->email }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5" class="text-center">No committee members found.</td>
        </tr>
    @endif
</tbody>

                   </table>
               </div>
           </div>
       </div>
   </div><br><br><br>
</x-base-layout>
