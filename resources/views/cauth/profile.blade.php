@section('title', 'Parent Registration')
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

        <!-- Main Profile Content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3>Welcome, {{ $customer['name'] }}!</h3>
                     @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        
                </div>
                <div class="card-body">
                    <h5>Your Profile</h5>
                    <hr>
                    <ul class="list-group">
    <!-- General Information -->
    <li class="list-group-item">
        <strong>User ID:</strong> {{ $customer['user_id'] }}
    </li>
    <li class="list-group-item">
        <strong>Name:</strong> {{ $customer['name'] }}
    </li>
    @if($customer['registrations_type'] == 'student' || $customer['registrations_type'] == 'staff' || $customer['registrations_type'] == 'alumni')
     <li class="list-group-item">
            <strong>Father Name:</strong> {{ $customer['father_name'] ?? 'N/A' }}
        </li>
    @endif
    

    
    <li class="list-group-item">
        <strong>Email:</strong> {{ $customer['email'] }}
    </li>
    <li class="list-group-item">
        <strong>Phone:</strong> {{ $customer['mobile_no'] }}
    </li>

    <!-- Conditional Data -->
    @if($customer['registrations_type'] == 'student' || $customer['registrations_type'] == 'alumni')
        <li class="list-group-item">
            <strong>Course:</strong> {{ $customer['course'] ?? 'N/A' }}
        </li>
         @if($customer['registrations_type'] == 'student' )
        <li class="list-group-item">
            <strong>Semester:</strong> {{ $customer['semester'] ?? 'N/A' }}
        </li>
        @endif
        <li class="list-group-item">
            <strong>Roll No:</strong> {{ $customer['roll_no'] ?? 'N/A' }}
        </li>
        <li class="list-group-item">
            <strong>Academic Session:</strong> {{ $customer['academic_session'] ?? 'N/A' }}
        </li>
       
    @elseif($customer['registrations_type'] == 'parent')
        <li class="list-group-item">
            <strong>Course:</strong> {{ $customer['course'] ?? 'N/A' }}
        </li>
        <li class="list-group-item">
            <strong>Semester:</strong> {{ $customer['semester'] ?? 'N/A' }}
        </li>
        <li class="list-group-item">
            <strong>Roll No:</strong> {{ $customer['roll_no'] ?? 'N/A' }}
        </li>
        <li class="list-group-item">
            <strong>Academic Session:</strong> {{ $customer['academic_session'] ?? 'N/A' }}
        </li>
        <li class="list-group-item">
            <strong>Child Name:</strong> {{ $customer['child_name'] ?? 'N/A' }}
        </li>
    @elseif($customer['registrations_type'] == 'staff')
       
        <li class="list-group-item">
            <strong>Department:</strong> {{ $customer['department'] ?? 'N/A' }}
        </li>
    @endif

    
</ul>

                    <hr>
                    <a href="{{ route('editProfile') }}" class="btn btn-warning">Edit Profile</a>
                    <a href="{{ route('changePassword') }}" class="btn btn-info">Change Password</a>
                    <a href="{{ route('addGrievance') }}" class="btn btn-success">Add Grievance</a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-base-layout>
