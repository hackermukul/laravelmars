@section('title', 'Home Page')
<x-base-layout>

<section class="content-section py-5">
    <div class="container text-center">
        <div class="p-4 rounded shadow" style="background: linear-gradient(to right, #6a11cb, #2575fc); color: white;">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h3 class="fw-bold">Online Grievance Software System</h3>
                    <hr class="bg-light">
                    <p class="mb-4">Follow these simple steps to post a grievance:</p>

                    <h4 class="fw-semibold">Step 1: Registration</h4>
                    <p class="text-start">
                        Already registered? Click <a href="member-login.php" class="text-warning">LOGIN</a>.
                    </p>
                    <ul class="text-start">
                        <li><a href="registration.php" class="text-warning">Register Here</a> and fill in the required details.</li>
                        <li>Click the SUBMIT button after completing the form.</li>
                        <li>Once registered, you can post grievances.</li>
                    </ul>

                    <h4 class="fw-semibold">Step 2: Post Grievance</h4>
                    <ul class="text-start">
                        <li><a href="#" class="text-warning">Post Grievance</a> after logging in or registering.</li>
                        <li>Provide grievance details, including the subject and relation.</li>
                        <li>Click the "Post Grievance" button to submit.</li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <div id="grievanceCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#grievanceCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                            <button type="button" data-bs-target="#grievanceCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#grievanceCarousel" data-bs-slide-to="2"></button>
                        </div>

                        <div class="carousel-inner rounded">
                            <div class="carousel-item active">
                                <img src="banner/1535606622.jpg" class="d-block w-100" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Streamline Your Grievance Process</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="banner/sample2.jpg" class="d-block w-100" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Efficient and User-Friendly System</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="banner/sample3.jpg" class="d-block w-100" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Your Voice, Our Responsibility</h5>
                                </div>
                            </div>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#grievanceCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#grievanceCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</x-base-layout>
