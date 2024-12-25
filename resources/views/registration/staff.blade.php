@section('title', 'Staff Registration')
<x-base-layout>
<style>
/* General Styling */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f2f8f5;
    padding: 0;
    margin: 0;
}

/* Container */
.container {
    margin-top: 50px;
}

/* Card Styling */
.card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Header Styling */
.card-header {
    background-color: #ffffff;
    padding: 20px;
    text-align: center;
}

.card-header img {
    max-width: 80px;
    border-radius: 50%;
}

.card-header h4 {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

/* Form Fields */
.form-group label {
    font-weight: bold;
}

.form-control {
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 12px;
    font-size: 16px;
    margin-bottom: 15px;
    background-color: #f9f9f9;
    transition: border 0.3s ease;
}

.form-control:focus {
    border-color: #6c9a8b;
    box-shadow: 0 0 5px rgba(108, 154, 139, 0.5);
}

.invalid-feedback {
    font-size: 12px;
    color: #e74c3c;
}

/* Button Styling */
.btn-success {
    background-color: #6c9a8b;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.btn-success:hover {
    background-color: #4e7a63;
}

/* Text Alignment */
.text-end {
    margin-top: 20px;
}

/* Ensure that login details are aligned properly on smaller screens */
@media (max-width: 768px) {
    .row {
        flex-direction: column;
    }

    .form-group {
        margin-bottom: 10px;
    }
}

/* Ensuring the form fits nicely on the screen */
.container {
    margin-top: 50px;
}

.card-header {
    background-color: #ffffff;
    padding: 20px;
    text-align: center;
}

.card-body {
    padding: 30px;
}

.row {
    display: flex;
    justify-content: space-between;
}

/* Form Group Styling */
.form-group {
    margin-bottom: 20px;
}

.form-control {
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 12px;
    font-size: 16px;
}

/* Ensure that labels are bold */
.form-group label {
    font-weight: bold;
}

/* Responsive Styles for smaller screens */
@media (max-width: 768px) {
    .row {
        flex-direction: column;
    }

    .col-md-4 {
        width: 100%;
    }

    .btn-success {
        width: 100%;
    }
}

/* Button Styling */
.btn-success {
    background-color: #6c9a8b;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.btn-success:hover {
    background-color: #4e7a63;
}


</style>
   <div class="container">
    <div class="card">
        <div class="card-header text-center">
            <img src="{{ asset('images/staff-icon.png') }}" alt="Staff Icon" class="img-fluid rounded-circle" style="max-width: 80px;">
            <h4>I am a staff</h4>
        </div>

        <div class="card-body">
         @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('registration.staff.submit') }}" method="POST">
    @csrf
    <div class="row">
        <!-- Personal details -->
        <div class="col-md-4 col-12">
            <h5>Personal details</h5>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter name">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="father_name">Father Name</label>
                <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror" value="{{ old('father_name') }}" placeholder="Enter father name">
                @error('father_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="mobile">Mobile No</label>
                <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}" placeholder="Enter mobile number">
                @error('mobile')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter email">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- Academic details -->
        <div class="col-md-4 col-12">
            <h5>Academic details</h5>
            <div class="form-group">
                <label for="department">Department</label>
                <input type="text" name="department" class="form-control @error('department') is-invalid @enderror" value="{{ old('department') }}" placeholder="Enter department">
                @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- Login details (Stay on the same row for larger screens) -->
        <div class="col-md-4 col-12">
            <h5>Staff's login details</h5>
            <div class="form-group">
                <label for="user_id">User Id</label>
                <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror" value="{{ old('user_id') }}" placeholder="Enter user id">
                @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
            </div>
        </div>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-success">Register</button>
    </div>
</form>

        </div>
    </div>
</div>
</x-base-layout>
