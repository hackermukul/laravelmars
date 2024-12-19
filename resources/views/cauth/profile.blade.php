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
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{ route('profile') }}" class="text-decoration-none">Profile Overview</a>
                        </li>
                        <li class="list-group-item">
                            <a href="" class="text-decoration-none">Edit Profile</a>
                        </li>
                        <li class="list-group-item">
                            <a href="" class="text-decoration-none">Change Password</a>
                        </li>
                        <li class="list-group-item">
                            <a href="" class="text-decoration-none">Add Course</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                               class="text-decoration-none text-danger">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Profile Content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3>Welcome, {{ $customer['name'] }}!</h3>
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
                    <a href="" class="btn btn-warning">Edit Profile</a>
                    <a href="" class="btn btn-info">Change Password</a>
                    <a href="" class="btn btn-success">Add Course</a>
                </div>
            </div>
        </div>
    </div>
</div>
</x-base-layout>
