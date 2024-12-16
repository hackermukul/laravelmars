<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ config('constants.options.__IMAGE__').'rad.png' }}" type="image/x-icon">
<link rel="icon" href="{{ config('constants.options.__IMAGE__').'rad.png' }}" type="image/x-icon">
<!-- <title>{{ config('constants.options._project_name_', 'Online Grievance Redressal System') }}</title> -->
<title>{{ config('constants.options._project_name_', 'College Management') }} | @yield('title')  </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
         <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
         <style>
           /* General Styling */
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    height: 100%;
}

/* Header Section */
.header {
    background: linear-gradient(90deg, #007bff, #6610f2);
    color: white;
    padding: 20px 0;
    text-align: center;
}

.header h1 {
    font-weight: bold;
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
}

.header p {
    margin: 0;
}

/* Navigation Bar */
.navbar {
    background-color: #fff;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.navbar .nav-link {
    color: #333 !important;
    font-weight: 500;
}

.navbar .nav-link:hover {
    color: #007bff !important;
}

/* Content Section */
.content-section {
    padding: 0;
    margin: 0;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
    width: 100%;
}

.content-section .container {
    max-width: 100%;
    padding: 0;
    margin: 0;
}

/* Card Styling */
.content-section .p-4 {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 2rem;
    background: linear-gradient(to right, #6a11cb, #2575fc);
    color: white;
}

/* Typography */
h3 {
    font-size: 2rem;
    font-weight: 700;
}

h4 {
    font-size: 1.5rem;
    font-weight: 600;
}

p {
    font-size: 1rem;
    line-height: 1.6;
}

ul {
    padding-left: 1.5rem;
}

ul li {
    margin-bottom: 0.5rem;
}

/* Links */
a {
    text-decoration: none;
}

a.text-warning {
    color: #ffc107;
    font-weight: 500;
    transition: color 0.3s;
}

a.text-warning:hover {
    color: #ffca2c;
}

/* Carousel */
.carousel-inner img {
    border-radius: 10px;
    width: 100%;
    height: 400px;
    object-fit: cover;
}

.carousel-indicators [data-bs-target] {
    background-color: #ffffff;
    width: 10px;
    height: 10px;
    border-radius: 50%;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    filter: invert(100%);
}

/* Footer */
.footer {
    background-color: #343a40;
    color: white;
    padding: 20px 0;
    text-align: center;
}

.footer p {
    margin-bottom: 0.5rem;
}

.footer a {
    color: #f8f9fa;
    text-decoration: none;
}

.footer a:hover {
    color: #007bff;
    text-decoration: underline;
}

/* Images */
.img-responsive {
    width: 100% !important;
}

img {
    vertical-align: middle;
    border-style: none;
}

/* Buttons */
button {
    outline: none;
    border: none;
    transition: all 0.3s ease;
}

/* Responsive Design */
@media (max-width: 768px) {
    h3 {
        font-size: 1.8rem;
    }

    h4 {
        font-size: 1.3rem;
    }

    p {
        font-size: 0.9rem;
    }

    .carousel-inner img {
        max-height: 300px;
    }

    .content-section .p-4 {
        padding: 1rem;
    }
}

/* Reset Global Margins and Padding */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* General Styling */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f8f9fa;
    height: 100%;
}

/* Header Section */
.header {
    background: linear-gradient(90deg, #007bff, #6610f2);
    color: white;
    padding: 20px 0;
    text-align: center;
}

/* Remove Top & Bottom Margins for Content */
.content-section {
    padding: 0; /* No padding for content */
    margin: 0;  /* Ensures no margin on top or bottom */
    height: 100vh; /* Use viewport height for consistent sizing */
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
    width: 100%;
}

/* Footer */
.footer {
    background-color: #343a40;
    color: white;
    padding: 20px 0;
    text-align: center;
    margin: 0; /* Removes top and bottom margins */
}

         </style>
         <style>
            .img-responsive {
            width: 100% !important;
            }
            img {
            vertical-align: middle;
            border-style: none;
            }
         </style>