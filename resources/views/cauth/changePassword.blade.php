@section('title', 'Change Password')
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
                            <a href="{{ route('editProfile') }}" class="text-decoration-none">Edit Profile</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('changePassword') }}" class="text-decoration-none">Change Password</a>
                        </li>
                       <li class="list-group-item">
                            <a href="#grievance-tab" data-bs-toggle="tab" class="text-decoration-none">Grievance</a>
                            <ul class="list-group mt-2">
                                <li class="list-group-item {{ request()->routeIs('addGrievance') ? 'active' : '' }}">
                                    <a href="{{ route('addGrievance') }}" class="text-decoration-none">Add Grievance</a>
                                </li>
                                <li class="list-group-item {{ request()->routeIs('viewGrievance') ? 'active' : '' }}">
                                    <a href="{{ route('viewGrievance') }}" class="text-decoration-none">View Grievance</a>
                                </li>
                            </ul>
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

        <!-- Main Content for Change Password -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3>Change Password</h3>
                </div>
                <div class="card-body">
                    <!-- Display Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Change Password Form -->
                    <form action="{{ route('updatePassword') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                            @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" required>
                            @error('new_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="new_password_confirmation">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" required>
                            @error('new_password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Change Password</button>
                        <a href="{{ route('profile') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-base-layout>
