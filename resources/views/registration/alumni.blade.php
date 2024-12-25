@section('title', 'Student Registration')
<x-base-layout>
<style>


/* Card Styling */
.card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.card-header {
    background-color: #ffffff;
    border-bottom: 1px solid #e0e0e0;
    padding: 20px;
}

.card-header img {
    max-width: 80px;
    margin-bottom: 10px;
}

.card-header h4 {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

/* Form section styling */
h5 {
    font-size: 20px;
    margin-bottom: 15px;
    color: #333;
}

/* Form controls */
.form-control {
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 10px;
    font-size: 16px;
    background-color: #f9f9f9;
    transition: border 0.3s ease;
}

.form-control:focus {
    border-color: #6c9a8b;
    box-shadow: 0 0 5px rgba(108, 154, 139, 0.5);
    background-color: #ffffff;
}

/* Error message */
.invalid-feedback {
    font-size: 12px;
    color: #e74c3c;
}

/* Submit button styling */
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

/* Aligning the form fields */
.row .col-md-6 {
    padding: 10px;
}

.row .col-md-4 {
    padding: 10px;
}

.text-end {
    margin-top: 20px;
}

/* Success message styling */
.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
}


</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header text-center bg-white">
            <h4>I am a Alumni</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('registration.alumni.submit') }}" method="POST">
                @csrf
               <input type="hidden" name="registrations_type" value="alumni">
                <div class="row">
                    <!-- Personal Details -->
                    <div class="col-md-6">
                        <h5>Personal details</h5>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter name">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="father_name" class="form-label">Father Name</label>
                            <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror" value="{{ old('father_name') }}" placeholder="Enter father name">
                            @error('father_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="mobile_no" class="form-label">Mobile No</label>
                            <input type="text" name="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror" value="{{ old('mobile_no') }}" placeholder="Enter mobile no">
                            @error('mobile_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Enter email">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Academic Details -->
                    <div class="col-md-6">
                        <h5>Academic details</h5>
                        <div class="mb-3">
                            <label for="course" class="form-label">Per Course & Hons</label>
                            <input type="text" name="course" class="form-control @error('course') is-invalid @enderror" value="{{ old('course') }}" placeholder="Enter course">
                            @error('course') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="roll_no" class="form-label">Roll No</label>
                            <input type="text" name="roll_no" class="form-control @error('roll_no') is-invalid @enderror" value="{{ old('roll_no') }}" placeholder="Enter roll no">
                            @error('roll_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="academic_session" class="form-label">Academic Session</label>
                            <input type="text" name="academic_session" class="form-control @error('academic_session') is-invalid @enderror" value="{{ old('academic_session') }}" placeholder="Enter academic session">
                            @error('academic_session') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Login Details -->
                <h5>Student's login details</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Alumni ID</label>
                            <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror" value="{{ old('user_id') }}" placeholder="Enter user ID">
                            @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-end">
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-base-layout>
