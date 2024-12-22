@section('title', 'Registration')

<x-base-layout>
<style>
/* General body styling */
body {
    background-color: #d8f0e8; /* Light greenish background */
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

/* Center container and title */
.container {
    text-align: center;
}

/* Cards container styling */
.row {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 30px;
}

/* Card styling */
.card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    width: 250px;
    padding: 20px 10px;
    text-align: center;
    cursor: pointer;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Image styling */
.card img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0 auto 15px;
    display: block;
    border: 3px solid #f1f1f1;
    transition: border-color 0.3s;
}

.card:hover img {
    border-color: #6c757d;
}

/* Button styling */
.card a {
    display: inline-block;
    font-size: 1rem;
    font-weight: 600;
    color: #fff;
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 5px;
    width: 100%;
    margin-top: 10px;
}

.card .btn-success {
    background-color: #28a745; /* Green */
}

.card .btn-success:hover {
    background-color: #218838;
}

.card .btn-danger {
    background-color: #dc3545; /* Red */
}

.card .btn-danger:hover {
    background-color: #c82333;
}

.card .btn-primary {
    background-color: #007bff; /* Blue */
}

.card .btn-primary:hover {
    background-color: #0056b3;
}

/* Responsive design */
@media (max-width: 768px) {
    .row {
        flex-direction: column;
        gap: 15px;
    }

    .card {
        width: 90%;
        margin: 0 auto;
    }
}
</style>

<div class="container mt-5 text-center">
    <h1 class="fw-bold">Registration</h1>
    <p><em>Select a type</em></p>

    <div class="row justify-content-center mt-4">
        <!-- Student Card -->
        <div class="col-md-3">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <img src="https://via.placeholder.com/100/28a745/FFFFFF?text=Student" alt="Student" class="img-fluid rounded-circle mx-auto d-block" style="width: 100px;">
                <div class="card-body text-center">
                    <a href="{{ route('registration.student') }}" class="btn btn-success w-100">I am a student</a>
                </div>
            </div>
        </div>

        <!-- Staff Card -->
        <div class="col-md-3">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <img src="https://via.placeholder.com/100/dc3545/FFFFFF?text=Staff" alt="Staff" class="img-fluid rounded-circle mx-auto d-block" style="width: 100px;">
                <div class="card-body text-center">
                    <a href="{{ route('registration.staff') }}" class="btn btn-danger w-100">I am a Staff</a>
                </div>
            </div>
        </div>

        <!-- Alumni Card -->
        <div class="col-md-3">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <img src="https://via.placeholder.com/100/dc3545/FFFFFF?text=Alumni" alt="Alumni" class="img-fluid rounded-circle mx-auto d-block" style="width: 100px;">
                <div class="card-body text-center">
                    <a href="{{ route('registration.alumni') }}" class="btn btn-danger w-100">I am an Alumni</a>
                </div>
            </div>
        </div>

        <!-- Parent Card -->
        <div class="col-md-3">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <img src="https://via.placeholder.com/100/007bff/FFFFFF?text=Parent" alt="Parent" class="img-fluid rounded-circle mx-auto d-block" style="width: 100px;">
                <div class="card-body text-center">
                    <a href="{{ route('registration.parent') }}" class="btn btn-primary w-100">I am a parent</a>
                </div>
            </div>
        </div>
    </div>
</div>

</x-base-layout>
