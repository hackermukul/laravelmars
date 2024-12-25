@section('title', 'Parent Registration')
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
            <h4>I am a parent</h4>
        </div>

        <div class="card-body">
         @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        
            <form method="POST" action="{{ route('registration.parent.submit') }}" enctype="multipart/form-data" id="registrationForm" autocomplete="off" novalidate>
                @csrf
                <hr style="border-bottom: 4px solid #4cc0b0; margin-top: 0px;">
                <div class="row" style="margin-bottom: 11px;">
                    <div class="col-sm-6" style="border-right: 1px solid #d7dedd;">
                        <h4 style="margin-top: 0px; margin-bottom: 20px;">Personal details</h4>
                        
                        <!-- Name Field -->
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Child Name Field -->
                        <div class="form-group row">
                            <label for="child_name" class="col-sm-3 col-form-label">Child Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('child_name') is-invalid @enderror" id="child_name" name="child_name" placeholder="Enter child name" value="{{ old('child_name') }}">
                                @error('child_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Mobile No Field -->
                        <div class="form-group row">
                            <label for="mobile_no" class="col-sm-3 col-form-label">Mobile No</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" id="mobile_no" name="mobile_no" maxlength="10" placeholder="Enter mobile no" value="{{ old('mobile_no') }}">
                                @error('mobile_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <h4 style="margin-top: 0px; margin-bottom: 20px;">Children's Academic details</h4>
                        
                        <!-- Course Field -->
                        <div class="form-group row">
                            <label for="course" class="col-sm-3 col-form-label">Per Course & Major </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('course') is-invalid @enderror" id="course" name="course" placeholder="Enter course" value="{{ old('course') }}">
                                @error('course') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Semester Field -->
                        <div class="form-group row">
                            <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester" placeholder="Enter semester" value="{{ old('semester') }}">
                                @error('semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Roll No Field -->
                        <div class="form-group row">
                            <label for="roll_no" class="col-sm-3 col-form-label">Roll No</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('roll_no') is-invalid @enderror" id="roll_no" name="roll_no" placeholder="Enter Roll No." value="{{ old('roll_no') }}">
                                @error('roll_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Session Field -->
                        <div class="form-group row">
                            <label for="session" class="col-sm-3 col-form-label">Academic Session</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('session') is-invalid @enderror" id="session" name="session" placeholder="Enter Academic Session" value="{{ old('session') }}">
                                @error('session') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="border-top: 1px solid #d7dedd;">
                    <h4 style="margin-top: 10px; margin-bottom: 20px;">Parent's login details</h4>

                    <!-- User Id Field -->
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="user_id" class="col-sm-3 col-form-label">User Id</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" placeholder="Enter user name" value="{{ old('user_id') }}">
                                @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-3 col-form-label">Confirm password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
                                @error('password_confirmation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-sm-12">
                        <input type="submit" class="btn btn-success" value="Register" style="float:right">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


    
</x-base-layout>
