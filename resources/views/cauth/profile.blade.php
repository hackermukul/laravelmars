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
                        <li class="list-group-item">
                            <strong>User ID:</strong> {{ $customer['user_id'] }}
                        </li>
                        <li class="list-group-item">
                            <strong>Name:</strong> {{ $customer['name'] }}
                        </li>
                        <li class="list-group-item">
                            <strong>Email:</strong> {{ $customer['email'] }}
                        </li>
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
