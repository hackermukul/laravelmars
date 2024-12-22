@section('title', 'Edit Profile')
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

        <!-- Main Content for Edit Profile -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Your Profile</h3>
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

                    <!-- Edit Profile Form -->
                    <form action="{{ route('updateProfile') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $customer['name']) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $customer['email']) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Phone (Optional)</label>
                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $customer['phone'] ?? '') }}">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address (Optional)</label>
                            <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror">{{ old('address', $customer['address'] ?? '') }}</textarea>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- New Department Field -->
                        <div class="form-group mb-3">
                            <label for="department">Department</label>
                            <input type="text" name="department" id="department" class="form-control @error('department') is-invalid @enderror" value="{{ old('department', $customer['department'] ?? '') }}" placeholder="Enter department">
                            @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('profile') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-base-layout>
