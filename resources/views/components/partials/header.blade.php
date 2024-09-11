<header class="header-area header-three">
           <div class="header-top second-header d-none d-md-block">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-4 d-none d-lg-block ">
                           <div class="header-social">
                                <span>
                                    Follow us:-
                                    <a href="https://www.facebook.com/radiantts" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    <a target="_blank" href="https://www.linkedin.com/company/radianttranscriptsservices/?viewAsMember=true"><i class="fab fa-linkedin"></i></a>
                                    <a target="_blank" href="https://twitter.com/RadiantTrans"><i class="fab fa-twitter"></i></a>
                                    <a target="_blank" href="https://radianttranscriptsservices.quora.com/"><i class="fab fa-quora"></i></a>
                                   </span>
                                   <!--  /social media icon redux -->
                            </div>
                        </div>
                          <div class="col-lg-8 col-md-8 d-none d-lg-block text-right">
                              <div class="header-cta">
                                <ul>
                                   <li>
                                      <div class="call-box">
                                         <div class="icon">
                                            <img src="assets/front/img/icon/phone-call.png" alt="img">
                                         </div>
                                         <div class="text">
                                            <span>Call Now !</span>
                                            <strong><a href="tel:{{ config('constants.options.__projectemail__') }}">+91–9886674457 | +91–9886643436</a></strong>
                                         </div>
                                      </div>
                                   </li>
                                   <li>
                                      <div class="call-box">
                                         <div class="icon">
                                            <img src="assets/front/img/icon/mailing.png" alt="img">
                                         </div>
                                         <div class="text">
                                            <span>Email Now</span>
                                            <strong><a href="mailto:{{ config('constants.options.__projectemail__') }}"> {{ config('constants.options.__projectemail__') }} </a></strong>
                                         </div>
                                      </div>
                                   </li>
                                </ul>
                             </div>
                        </div>

                    </div>
                </div>
            </div>
			  <div id="header-sticky" class="menu-area">
                <div class="container">
                    <div class="second-menu">
                        <div class="row align-items-center">
                             <div class="col-xl-3 col-lg-3">
                                <div class="logo">
                                    <a href="{{ config('constants.options.MAINSITE') }}"><img src="assets/front/img/rad.png" alt="logo"></a>
                                </div>
                            </div>
                           <div class="col-xl-7 col-lg-7">

                                <div class="main-menu text-right text-xl-right">
                                    <nav id="mobile-menu">
                                          <ul>
                                             <li><a href="{{ config('constants.options.MAINSITE') }}">Home</a>

                                            </li>
                                            <li><a href="{{ route('about') }}">About Us</a></li>
                                            <li><a href="university.html">Universities</a></li>
                                            <li><a href="services.html">Services</a></li>
                                                                                          <li><a href="Login.html">Apply Now</a></li>

                                                                                          <li><a href="orders.html">Order Status</a></li>
                                            <li><a href="blog.html">Blog</a></li>
                                                                                        <!-- <li><a href="#">Contact Us</a></li>                                                -->
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                             <div class="col-xl-2 col-lg-2 text-right d-none d-lg-block text-right text-xl-right">
                                 <div class="login">
                                    <ul>

                                        <li>
                                            <div class="second-header-btn">
                                               <a href="contact-us.html" class="btn">Contact Us</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                                <div class="col-12">
                                    <div class="mobile-menu"></div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>