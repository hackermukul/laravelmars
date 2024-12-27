@section('title', 'Manage Grievances')
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

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3>Your Grievances</h3>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card-body">
                    <table class="table table-bordered" id="grievances-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Related To</th>
            <th>Subject</th>
            <th>Grievance</th>
            <th>Document</th>
            <th>Status</th>
            <th>Submitted On</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($grievances as $grievance)
            <tr>
                <td>{{ $grievance->id }}</td>
                <td><a href="{{ route('grievances.show', $grievance->id) }}"> {{ $grievance->related_to }}</a></td>
                <td>{{ $grievance->subject }}</td>
                <td>{{ $grievance->grievance }}</td>
                <td>
                    @if ($grievance->document_path)
                           <a href="{{ asset($grievance->document_path) }}" target="_blank">View Document</a>
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $grievance->status == 0 ? 'Pending' : 'Active' }}</td>

            
               <td>{{ \Carbon\Carbon::parse($grievance->created_at)->format('d M, Y') }}</td>

                
            
            </tr>
        @endforeach
    </tbody>
</table>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables JS and CSS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

<script>
$(document).ready(function() {
    // Initialize the DataTable
    $('#grievances-table').DataTable({
        processing: true,
        serverSide: false,  // Set to true if you want server-side processing for large datasets
        responsive: true,
        order: [[6, 'desc']], // Order by the 'Submitted On' column in descending order
    });
});
</script>
</x-base-layout>
