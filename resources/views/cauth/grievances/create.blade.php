@section('title', 'Add Grievance')
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

        <!-- Main Content for Add Grievance -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h3>Submit Your Grievance</h3>
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

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Add Grievance Form -->
                    <form action="{{ route('submitGrievance') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Grievance Related To -->
                        <div class="form-group mb-3">
                            <label for="related_to">Grievance Related To</label>
                            
                            <select name="related_to" id="related_to" class="form-control @error('related_to') is-invalid @enderror" required>
                                <option value="" disabled selected>Select</option>

                                <!-- Loop through the departments array and display them -->
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('related_to') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Error message for validation -->
                            @error('related_to')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <!-- Subject -->
                        <div class="form-group mb-3">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="Enter Subject" required>
                            @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- Grievance -->
                        <div class="form-group mb-3">
                            <label for="grievance">Grievance</label>
                            <textarea name="grievance" id="grievance" class="form-control @error('grievance') is-invalid @enderror" placeholder="Enter Grievance" required>{{ old('grievance') }}</textarea>
                            @error('grievance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <!-- Upload Document -->
                        <div class="form-group mb-3">
                            <label for="document">Upload Document (Optional)</label>
                            <input type="file" name="document" id="document" class="form-control @error('document') is-invalid @enderror" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
                            @error('document')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Grievance</button>
                        <a href="{{ route('profile') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-base-layout>
