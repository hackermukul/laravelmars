
         <!-- Header Section -->
         <header class="header text-center">
            <div class="container">
               <h1>Welcome to Online Grievance Software System</h1>
               <p>Online Grievance Software</p>
            </div>
         </header>
         <div class="">
            <div class="">
               <div class="row">
                  <div id="headerImage" class="col-lg-12">
                     <a href="{{ route('home') }}">
                     <!-- Logo Section -->
@if($companyProfile->logo)
    <!-- If logo exists, display it -->
    <img src="{{ asset($companyProfile->logo) }}" class="img-responsive" style="box-shadow: 4px 0px 8px 3px #fff;max-width: 110%;height:161px;">
@else
    <!-- Fallback to a default logo if no logo exists -->
    <img src="https://collegeebook.in/uploads/logos/b4880f34de8954c9fa361f2bf8b9b6c3.png" class="img-responsive" style="box-shadow: 4px 0px 8px 3px #fff;max-width: 110%;height:161px;">
@endif

                     </a>
                  </div>
                  <div>
                     <ul class="nav navbar-nav navbar-right" style="height: 0px;padding-right: 20px;">
                        <li><a style="color:#fff;line-height: 24px;display: block;font - family: 'Roboto Condensed', sans - serif; " href="/Controll" id="loginLink">Log in</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <!-- Navigation Bar -->
         <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                   @if(session()->has('customer'))
                            {{-- Show links for logged-in customers --}}
                            <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profile</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            {{-- Show links for guests --}}
                            <li class="nav-item"><a class="nav-link" href="{{ route('loginForm') }}">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('registration') }}">Registration</a></li>
                           <li class="nav-item">
                              <a class="nav-link" href="http://127.0.0.1:8000/secureRegions">Admin Login</a>
                           </li>
                            <li class="nav-item">
                                 <a class="nav-link" href="{{ route('committee') }}">Grievance Committee</a>
                              </li>
                        @endif

                </ul>

               </div>
            </div>
         </nav>