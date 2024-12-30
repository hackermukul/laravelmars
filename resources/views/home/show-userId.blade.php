@section('title', 'Retrieve User ID')
<x-base-layout>
   <style>
        /* General Styling */
        .container {
            max-width: 600px;
            margin: auto;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #ffffff;
            padding: 20px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }

        .card-body {
            padding: 30px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px;
            font-size: 16px;
            background-color: #f9f9f9;
            transition: border 0.3s ease;
        }

        .form-control:focus {
            border-color: #6c9a8b;
            box-shadow: 0 0 5px rgba(108, 154, 139, 0.5);
        }

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

        .alert {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .text-end {
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .btn-success {
                width: 100%;
            }
        }
    </style>

    <div class="container">
        <div class="card">
            <div class="card-header">
                Retrieve User ID
            </div>

            <div class="card-body">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Input Form -->
                <form action="{{ route('showuserId.reset.direct') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="phone">Mobile Number</label>
        <input 
            type="text" 
            name="phone" 
            id="phone" 
            class="form-control @error('phone') is-invalid @enderror" 
            value="{{ old('phone') }}" 
            required
        >
        @error('phone') 
            <span class="text-danger">{{ $message }}</span> 
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input 
            type="email" 
            name="email" 
            id="email" 
            class="form-control @error('email') is-invalid @enderror" 
            value="{{ old('email') }}" 
            required
        >
        @error('email') 
            <span class="text-danger">{{ $message }}</span> 
        @enderror
    </div>

    <br><br>

    <button type="submit" class="btn btn-success">Show User ID</button>
</form>


                <!-- Links for Registration -->
                <div class="text-end">
                    <p>If not registered, <a href="{{ route('registration') }}">Click Here for Registration</a></p>
                    <p><a href="{{ route('userId.request') }}">Check user ID?</a></p>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>
