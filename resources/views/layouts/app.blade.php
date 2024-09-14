<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" href="{{ config('constants.options.__IMAGE__').'rad.png' }}" type="image/x-icon">
      <link rel="icon" href="{{ config('constants.options.__IMAGE__').'rad.png' }}" type="image/x-icon">
      <title>{{ config('constants.options._project_name_', 'College Management') }}</title>
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
      <!-- Scripts -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <!-- Styles -->
      @livewireStyles
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'plugins/fontawesome-free/css/all.min.css' }}">
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'plugins/icheck-bootstrap/icheck-bootstrap.min.css' }}">
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'dist/css/adminlte.min2167.css?v=3.2.0' }}">
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'plugins/overlayScrollbars/css/OverlayScrollbars.min.css' }}">
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'plugins/daterangepicker/daterangepicker.css' }}">
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'plugins/summernote/summernote-bs4.min.css' }}">
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'plugins/select2/css/select2.min.css' }}">
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'plugins/select2-bootstrap4.min.css' }}">
      <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <!-- DataTables -->
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'dataTables.bootstrap4.min.css' }}">
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'responsive.bootstrap4.min.css' }} ">
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'OverlayScrollbars.min.css' }}">
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'pace-theme-flat-top.css' }}">
      <!-- Toastr -->
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'toastr.min.css'}}">
      <link rel="stylesheet" href="{{ config('constants.options.MAINSITE_Admin').'adminlte.min.css' }}">
      <script src="{{ config('constants.options.MAINSITE_Admin').'plugins/jquery/jquery.min.js' }}"></script>
 
 
      
      <!-- Theme style -->
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
            </div> -->
         @livewire('navigation-menu')
         <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="brand-link">
            <img src="{{ config('constants.options.MAINSITE_Admin').'dist/img/AdminLTELogo.png' }}" alt="{{ config('constants.options._brand_name_') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('constants.options._brand_name_') }}</span>
            </a>
            <div class="sidebar">
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                     @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                     <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                     @else
                     <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
                     @endif
                  </div>
                  <div class="info">
                     <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                  </div>
               </div>
               <form method="get" class="sidebar-form" id="sidebar-form" autocomplete="on" onsubmit="return false">
                  <div class="form-inline">
                     <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search"  name="q" autocomplete="off" aria-label="Search" id="search-input">
                        <div class="input-group-append">
                           <button class="btn btn-sidebar">
                           <i class="fa fa-search fa-fw"></i>
                           </button>
                        </div>
                     </div>
                  </div>
               </form>
               <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column sidebar-menu tree" data-widget="treeview" role="menu" data-accordion="false">
                     <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                           <i class="nav-icon fa fa-tachometer-alt"></i>
                           <p>
                              {{ __('Dashboard') }} 
                           </p>
                        </a>
                     </li>
                      @if($left_menu_employee!= '')
                      
                        <?php
                           $is_open = "";
                           $active = "";
                           if(!empty($page_is_master))
                           {
                              if($page_is_master==3)
                              {
                                 $is_open = "menu-open";
                                 $active = "active";
                              }
                           }
                           ?>
                        <li class="nav-item has-treeview <?=$is_open?>">
                           <a href="#" class="nav-link <?=$active?>">
                               <i class="nav-icon fa fa-th" style="font-size: 23px;"></i>
                           <p>
                                 Application Setup
                                 <i class="fa fa-angle-left right"></i>
                                 <!-- <span class="badge badge-info right">6</span> -->
                              </p>
                           </a>
                           <ul class="nav nav-treeview">
                              <?=$left_menu_employee?>
                           </ul>
                        </li>
                       @endif

                    
                     @if($left_menu_company_profile!= '')
                     <?php
                        $is_open = "";
                        $active = "";
                        if(!empty($page_is_master))
                        {
                        
                           if($page_is_master==2)
                           {
                              $is_open = "menu-open";
                              $active = "active";
                           }
                        }
                        ?>
                     <li class="nav-item has-treeview <?=$is_open?>">
                        <a href="#" class="nav-link <?=$active?>">
                           <i class="nav-icon fa fa-th" style="font-size: 23px;"></i>
                           <p>
                              Company Profile
                              <i class="fa fa-angle-left right"></i>
                              <!-- <span class="badge badge-info right">6</span> -->
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <?=$left_menu_company_profile?>
                        </ul>
                     </li>
                     @endif
                    

                      @if($left_menu_master!= '')
                        <?php
                           $is_open = "menu-open";
                           $active = "active";
                           if(!empty($page_is_master))
                           {
                              if($page_is_master==1)
                              {
                                 $is_open = "menu-open";
                                 $active = "active";
                              }
                           }
                     ?>
                     <li class="nav-item <?=$is_open?>">
                        <a href="#" class="nav-link <?=$active?>">
                           <i class="nav-icon fa fa-th" style="font-size: 23px;"></i>
                           <p>
                            {{ __('Masters') }}
                              <i class="fa fa-angle-left right"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <?=$left_menu_master?>
                        </ul>
                     </li>
                    @endif


                     <!--<li class="nav-item menu-is-opening menu-open">
                        
                        <a href="#" class="nav-link">
                           <i class="nav-icon fas fa-th" style="font-size: 26px;"></i>
                           <p>
                              {{ __('Masters') }}
                              <i class="fas fa-angle-left right"></i>
                           </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="{{ route('role-manager.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('Role Permission') }}</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('categories.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('Categories') }}</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('department.index') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('Department') }}</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('designation.index') }}" :active="request()->routeIs('designation.index')" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('Designation') }}</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('country.index') }}" :active="request()->routeIs('country.index')" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('Country') }}</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('state.index') }}" :active="request()->routeIs('state.index')" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('State') }}</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{ route('city.index') }}" :active="request()->routeIs('city.index')" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p> {{ __('City') }}</p>
                              </a>
                           </li>

                        </ul>
                     </li>-->

                     
                  </ul>
               </nav>
            </div>
         </aside>
         <div class="content-wrapper">
            {{ $slot }}
         </div>
         <footer class="main-footer">
            <strong>  Copyright &copy; {{ config('constants.options._project_complete_name_') }} {{ date('Y')}} . All rights reserved.</strong>
            <div class="float-right d-none d-sm-inline-block">
               <b>Version</b> {{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
         </footer>
         <aside class="control-sidebar control-sidebar-dark">
         </aside>
      </div>
      <script src="https://dietdighi.in/assets/admin/lte/js/alert.js"></script>
      <script src="https://dietdighi.in/assets/admin/lte/plugins/toastr/toastr.min.js"></script>
      <script src="{{ config('constants.options.MAINSITE_Admin').'plugins/bootstrap/js/bootstrap.bundle.min.js' }}"></script>
      <script src="{{ config('constants.options.MAINSITE_Admin').'plugins/sparklines/sparkline.js' }}"></script>
      <script src="{{ config('constants.options.MAINSITE_Admin').'plugins/moment/moment.min.js' }}"></script>
      <script src="{{ config('constants.options.MAINSITE_Admin').'plugins/daterangepicker/daterangepicker.js' }}"></script>
      <script src="{{ config('constants.options.MAINSITE_Admin').'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js' }}"></script>
      <script src="{{ config('constants.options.MAINSITE_Admin').'plugins/summernote/summernote-bs4.min.js' }}"></script>
      <script src="{{ config('constants.options.MAINSITE_Admin').'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js' }}"></script>
      <script src="{{ config('constants.options.MAINSITE_Admin').'dist/js/adminlte2167.js?v=3.2.0' }}"></script>
      <!-- DataTables -->
      <script src="https://www.nfees.org/assets/admin/lte/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="https://www.nfees.org/assets/admin/lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="https://www.nfees.org/assets/admin/lte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
      <script src="https://www.nfees.org/assets/admin/lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="https://www.nfees.org/assets/admin/lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
      <script src="https://dietdighi.in/assets/admin/lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
      <script src="https://dietdighi.in/assets/admin/lte/plugins/pace-progress/pace.min.js"></script>
      <script src="https://dietdighi.in/assets/admin/lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
      <script src="{{ config('constants.options.MAINSITE_Admin').'plugins/select2/js/select2.full.min.js' }}"></script>

      <!-- Toastr -->
      <!-- AdminLTE for demo purposes -->
      <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
</script>
      <script>
      
         $("input[data-bootstrap-switch]").each(function(){
              $(this).bootstrapSwitch('state', $(this).prop('checked'));
          });
          $(function () {
           
         var table = $('#example1').DataTable({
         	 aLengthMenu: [
         		[25, 50, 100, 200, -1],
         		[25, 50, 100, 200, "All"]
         	],
         	iDisplayLength: 100
         });
         if ( $("*").is("#example1") ) {
         new $.fn.dataTable.FixedHeader( table, {
            "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": true,
           //"scrollX": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
           fixedHeader:true,
         
         
         
         } );
         }
             /*$('#example2').DataTable({
               "paging": true,
               "lengthChange": false,
               "searching": false,
               "ordering": true,
               "info": true,
               "autoWidth": false,
               "responsive": true,
             });*/
         
         	bsCustomFileInput.init();
         	$('.summernote').summernote({toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname', 'fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['view', ['fullscreen', 'codeview']]
          ]});//for text editor
          });
         
      </script>
     
      <script src="https://dietdighi.in/assets/admin/lte/js/common.js"></script>
   </body>
</html>