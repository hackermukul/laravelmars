@section('title', 'Parent Registration')
<x-base-layout>
   <style>


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
    max-width: 600px; /* Set a max-width for the form container */
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
            <h4>Student/Staff/Parent Login </h4>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('customer_login') }}" method="post" id="loginForm" novalidate="novalidate" style="margin-top:25px" autocomplete="off">
                    @csrf
                    <div class="input-group" style="margin-bottom: 20px;">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" placeholder="Enter user id" name="user_id" value="{{ old('user_id') }}" autocomplete="off">
                        @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="input-group" style="margin-bottom: 20px;">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" name="password" autocomplete="off">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="input-group" style="margin-bottom: 20px; float:right">
                        <button type="submit" class="btn btn-success btn-block" style="padding: 7px 20px;">Login</button>
                    </div>

                    <div class="text-end">
                        <p>If not registered, <a href="{{ route('registration') }}">Click Here for Registration</a></p>
                        <p><a href="">Forgot user id or password?</a></p>
                    </div>
                </form>

        </div>
    </div>
</div>

</x-base-layout>
