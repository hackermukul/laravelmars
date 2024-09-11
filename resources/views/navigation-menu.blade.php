<nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
           
               <li class="nav-item">
                  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
               </li>
               <li class="nav-item d-none d-sm-inline-block">
                  <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
               </li>
               <li class="nav-item d-none d-sm-inline-block">
                  <a href="#" class="nav-link">Contact</a>
               </li>
            </ul>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu ">
               <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
               @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                     <img src="{{ Auth::user()->profile_photo_url }}" class="user-image img-circle elevation-2" alt="{{ Auth::user()->name }}">
                    @else
                    <img src="{{ Auth::user()->profile_photo_url }}" class="user-image img-circle elevation-2" alt="{{ Auth::user()->name }}">
                    @endif
               </a>
               <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right card-primary card-outline" style="left: inherit; right: 0px; padding: 5px;
                  border-radius: 5%;">
                  <!-- User image -->
                  <li class="user-header ">
                  <div class="image">
                   @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                     <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                    @else
                    <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                    @endif
                     <p>
                        {{ Auth::user()->name }}
                        <small>Member since </small>
                     </p>
                  </li>
                  <!-- Menu Footer-->
                  <form method="POST" action="{{ route('logout') }}" x-data>
                  @csrf
                  <li class="user-footer">
                     <a href="{{ route('profile.show') }}" class="btn btn-primary "><b> {{ __('Profile') }}</b></a>
                     <!-- Authentication -->
                     <a href="{{ route('logout') }}" class="btn btn-primary" @click.prevent="$root.submit();"><b>{{ __('Log Out') }}</b></a>
                    </form>
                  </li>
               </ul>
            </li>
            </ul>
        </nav>