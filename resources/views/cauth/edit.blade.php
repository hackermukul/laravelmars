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
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $customer['name'] ?? '') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $customer['email'] ?? '') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone">Phone (Optional)</label>
                                <input type="text" name="mobile_no" id="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror" value="{{ old('mobile_no', $customer['mobile_no'] ?? '') }}">
                                @error('mobile_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="father_name">Father's Name</label>
                                <input type="text" name="father_name" id="father_name" class="form-control @error('father_name') is-invalid @enderror" value="{{ old('father_name', $customer['father_name'] ?? '') }}" placeholder="Enter father's name">
                                @error('father_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- Dynamic Fields Based on Registration Type -->
                            @if($customer['registrations_type'] == "student" || $customer['registrations_type'] == "alumni" || $customer['registrations_type'] == "parent")
                                <div class="form-group mb-3">
                                    <label for="course">Course</label>
                                    <input type="text" name="course" id="course" class="form-control @error('course') is-invalid @enderror" value="{{ old('course', $customer['course'] ?? '') }}" placeholder="Enter course">
                                    @error('course')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="semester">Semester</label>
                                    <input type="text" name="semester" id="semester" class="form-control @error('semester') is-invalid @enderror" value="{{ old('semester', $customer['semester'] ?? '') }}" placeholder="Enter semester">
                                    @error('semester')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="roll_no">Roll No</label>
                                    <input type="text" name="roll_no" id="roll_no" class="form-control @error('roll_no') is-invalid @enderror" value="{{ old('roll_no', $customer['roll_no'] ?? '') }}" placeholder="Enter roll no">
                                    @error('roll_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="academic_session">Academic Session</label>
                                    <input type="text" name="academic_session" id="academic_session" class="form-control @error('academic_session') is-invalid @enderror" value="{{ old('academic_session', $customer['academic_session'] ?? '') }}" placeholder="Enter academic session">
                                    @error('academic_session')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            @endif

                            @if($customer['registrations_type'] == "staff")
                                <div class="form-group mb-3">
                                    <label for="child_name">Child Name</label>
                                    <input type="text" name="child_name" id="child_name" class="form-control @error('child_name') is-invalid @enderror" value="{{ old('child_name', $customer['child_name'] ?? '') }}" placeholder="Enter child's name">
                                    @error('child_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            @endif

                            @if($customer['registrations_type'] == "parent")
                                <div class="form-group mb-3">
                                    <label for="department">Department</label>
                                    <input type="text" name="department" id="department" class="form-control @error('department') is-invalid @enderror" value="{{ old('department', $customer['department'] ?? '') }}" placeholder="Enter department">
                                    @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            <a href="{{ route('profile') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-base-layout>
