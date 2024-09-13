<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Laravel</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="google-signin-client_id" content="737684399884-c82ithmhgo2pcpkm46eemrrnpgplks1e">
      <link rel="shortcut icon" type="image/x-icon" href="assets/front/img/fav.png">
      <!-- Place favicon.ico in the root directory -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])
      <!-- CSS here -->
      <link rel="stylesheet" href="{{ config('constants.options.Website_Files').'css/bootstrap.min.css' }}" />
      <link rel="stylesheet" href="{{ config('constants.options.Website_Files').'css/animate.min.css' }}" />
      <link rel="stylesheet" href="{{ config('constants.options.Website_Files').'fontawesome/css/all.min.css' }}" />
      <link rel="stylesheet" href="{{ config('constants.options.Website_Files').'css/dripicons.css' }}" />
      <link rel="stylesheet" href="{{ config('constants.options.Website_Files').'css/slick.css' }}" />
      <link rel="stylesheet" href="{{ config('constants.options.Website_Files').'css/meanmenu.css' }}" />
      <link rel="stylesheet" href="{{ config('constants.options.Website_Files').'css/default.css' }}" />
      <link rel="stylesheet" href="{{ config('constants.options.Website_Files').'css/style.css' }} " />
      <link rel="stylesheet" href="{{ config('constants.options.Website_Files').'css/responsive.css' }} " />
      <link rel="stylesheet" href="assets/front/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/front/css/animate.min.css">
      <link rel="stylesheet" href="assets/front/css/magnific-popup.css">
      <link rel="stylesheet" href="assets/front/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="assets/front/css/dripicons.css">
      <link rel="stylesheet" href="assets/front/css/slick.css">
      <link rel="stylesheet" href="assets/front/css/meanmenu.css">
      <link rel="stylesheet" href="assets/front/css/default.css">
      <link rel="stylesheet" href="assets/front/css/style.css">
      <link rel="stylesheet" href="assets/front/css/responsive.css">
      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.bunny.net">
      <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
      <!-- Styles -->
      <style>
         /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */*,::after,::before{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}::after,::before{--tw-content:''}:host,html{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,pre,samp{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}[type=button],[type=reset],[type=submit],button{-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dd,dl,figure,h1,h2,h3,h4,h5,h6,hr,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}menu,ol,ul{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}[role=button],button{cursor:pointer}:disabled{cursor:default}audio,canvas,embed,iframe,img,object,svg,video{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]{display:none}*, ::before, ::after{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }::backdrop{--tw-border-spacing-x:0;--tw-border-spacing-y:0;--tw-translate-x:0;--tw-translate-y:0;--tw-rotate:0;--tw-skew-x:0;--tw-skew-y:0;--tw-scale-x:1;--tw-scale-y:1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness:proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width:0px;--tw-ring-offset-color:#fff;--tw-ring-color:rgb(59 130 246 / 0.5);--tw-ring-offset-shadow:0 0 #0000;--tw-ring-shadow:0 0 #0000;--tw-shadow:0 0 #0000;--tw-shadow-colored:0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: }.absolute{position:absolute}.relative{position:relative}.-left-20{left:-5rem}.top-0{top:0px}.-bottom-16{bottom:-4rem}.-left-16{left:-4rem}.-mx-3{margin-left:-0.75rem;margin-right:-0.75rem}.mt-4{margin-top:1rem}.mt-6{margin-top:1.5rem}.flex{display:flex}.grid{display:grid}.hidden{display:none}.aspect-video{aspect-ratio:16 / 9}.size-12{width:3rem;height:3rem}.size-5{width:1.25rem;height:1.25rem}.size-6{width:1.5rem;height:1.5rem}.h-12{height:3rem}.h-40{height:10rem}.h-full{height:100%}.min-h-screen{min-height:100vh}.w-full{width:100%}.w-\[calc\(100\%\+8rem\)\]{width:calc(100% + 8rem)}.w-auto{width:auto}.max-w-\[877px\]{max-width:877px}.max-w-2xl{max-width:42rem}.flex-1{flex:1 1 0%}.shrink-0{flex-shrink:0}.grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.flex-col{flex-direction:column}.items-start{align-items:flex-start}.items-center{align-items:center}.items-stretch{align-items:stretch}.justify-end{justify-content:flex-end}.justify-center{justify-content:center}.gap-2{gap:0.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.self-center{align-self:center}.overflow-hidden{overflow:hidden}.rounded-\[10px\]{border-radius:10px}.rounded-full{border-radius:9999px}.rounded-lg{border-radius:0.5rem}.rounded-md{border-radius:0.375rem}.rounded-sm{border-radius:0.125rem}.bg-\[\#FF2D20\]\/10{background-color:rgb(255 45 32 / 0.1)}.bg-white{--tw-bg-opacity:1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gradient-to-b{background-image:linear-gradient(to bottom, var(--tw-gradient-stops))}.from-transparent{--tw-gradient-from:transparent var(--tw-gradient-from-position);--tw-gradient-to:rgb(0 0 0 / 0) var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), var(--tw-gradient-to)}.via-white{--tw-gradient-to:rgb(255 255 255 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #fff var(--tw-gradient-via-position), var(--tw-gradient-to)}.to-white{--tw-gradient-to:#fff var(--tw-gradient-to-position)}.stroke-\[\#FF2D20\]{stroke:#FF2D20}.object-cover{object-fit:cover}.object-top{object-position:top}.p-6{padding:1.5rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-10{padding-top:2.5rem;padding-bottom:2.5rem}.px-3{padding-left:0.75rem;padding-right:0.75rem}.py-16{padding-top:4rem;padding-bottom:4rem}.py-2{padding-top:0.5rem;padding-bottom:0.5rem}.pt-3{padding-top:0.75rem}.text-center{text-align:center}.font-sans{font-family:Figtree, ui-sans-serif, system-ui, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji}.text-sm{font-size:0.875rem;line-height:1.25rem}.text-sm\/relaxed{font-size:0.875rem;line-height:1.625}.text-xl{font-size:1.25rem;line-height:1.75rem}.font-semibold{font-weight:600}.text-black{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.underline{-webkit-text-decoration-line:underline;text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.shadow-\[0px_14px_34px_0px_rgba\(0\2c 0\2c 0\2c 0\.08\)\]{--tw-shadow:0px 14px 34px 0px rgba(0,0,0,0.08);--tw-shadow-colored:0px 14px 34px 0px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)}.ring-1{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.ring-transparent{--tw-ring-color:transparent}.ring-white\/\[0\.05\]{--tw-ring-color:rgb(255 255 255 / 0.05)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.06\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.06));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.drop-shadow-\[0px_4px_34px_rgba\(0\2c 0\2c 0\2c 0\.25\)\]{--tw-drop-shadow:drop-shadow(0px 4px 34px rgba(0,0,0,0.25));filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.transition{transition-property:color, background-color, border-color, fill, stroke, opacity, box-shadow, transform, filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;transition-property:color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter, -webkit-text-decoration-color, -webkit-backdrop-filter;transition-timing-function:cubic-bezier(0.4, 0, 0.2, 1);transition-duration:150ms}.duration-300{transition-duration:300ms}.selection\:bg-\[\#FF2D20\] *::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white *::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.selection\:bg-\[\#FF2D20\]::selection{--tw-bg-opacity:1;background-color:rgb(255 45 32 / var(--tw-bg-opacity))}.selection\:text-white::selection{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.hover\:text-black:hover{--tw-text-opacity:1;color:rgb(0 0 0 / var(--tw-text-opacity))}.hover\:text-black\/70:hover{color:rgb(0 0 0 / 0.7)}.hover\:ring-black\/20:hover{--tw-ring-color:rgb(0 0 0 / 0.2)}.focus\:outline-none:focus{outline:2px solid transparent;outline-offset:2px}.focus-visible\:ring-1:focus-visible{--tw-ring-offset-shadow:var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow:var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)}.focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}@media (min-width: 640px){.sm\:size-16{width:4rem;height:4rem}.sm\:size-6{width:1.5rem;height:1.5rem}.sm\:pt-5{padding-top:1.25rem}}@media (min-width: 768px){.md\:row-span-3{grid-row:span 3 / span 3}}@media (min-width: 1024px){.lg\:col-start-2{grid-column-start:2}.lg\:h-16{height:4rem}.lg\:max-w-7xl{max-width:80rem}.lg\:grid-cols-3{grid-template-columns:repeat(3, minmax(0, 1fr))}.lg\:grid-cols-2{grid-template-columns:repeat(2, minmax(0, 1fr))}.lg\:flex-col{flex-direction:column}.lg\:items-end{align-items:flex-end}.lg\:justify-center{justify-content:center}.lg\:gap-8{gap:2rem}.lg\:p-10{padding:2.5rem}.lg\:pb-10{padding-bottom:2.5rem}.lg\:pt-0{padding-top:0px}.lg\:text-\[\#FF2D20\]{--tw-text-opacity:1;color:rgb(255 45 32 / var(--tw-text-opacity))}}@media (prefers-color-scheme: dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:bg-black{--tw-bg-opacity:1;background-color:rgb(0 0 0 / var(--tw-bg-opacity))}.dark\:bg-zinc-900{--tw-bg-opacity:1;background-color:rgb(24 24 27 / var(--tw-bg-opacity))}.dark\:via-zinc-900{--tw-gradient-to:rgb(24 24 27 / 0)  var(--tw-gradient-to-position);--tw-gradient-stops:var(--tw-gradient-from), #18181b var(--tw-gradient-via-position), var(--tw-gradient-to)}.dark\:to-zinc-900{--tw-gradient-to:#18181b var(--tw-gradient-to-position)}.dark\:text-white\/50{color:rgb(255 255 255 / 0.5)}.dark\:text-white{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-white\/70{color:rgb(255 255 255 / 0.7)}.dark\:ring-zinc-800{--tw-ring-opacity:1;--tw-ring-color:rgb(39 39 42 / var(--tw-ring-opacity))}.dark\:hover\:text-white:hover{--tw-text-opacity:1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:hover\:text-white\/70:hover{color:rgb(255 255 255 / 0.7)}.dark\:hover\:text-white\/80:hover{color:rgb(255 255 255 / 0.8)}.dark\:hover\:ring-zinc-700:hover{--tw-ring-opacity:1;--tw-ring-color:rgb(63 63 70 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-\[\#FF2D20\]:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 45 32 / var(--tw-ring-opacity))}.dark\:focus-visible\:ring-white:focus-visible{--tw-ring-opacity:1;--tw-ring-color:rgb(255 255 255 / var(--tw-ring-opacity))}}
      </style>
   </head>
   <body>
      <!-- header -->
      @include('inc.header')
      <!-- header-end -->
      <!-- offcanvas-area -->
      <!-- offcanvas-end -->
      <!-- main-area -->
      <main>
         <!-- slider-area -->
         <section id="home" class="slider-area fix p-relative">
            <div class="slider-active" style="background: #141b22;">
               <div class="single-slider slider-bg" style="background-image: url(assets/front/img/slider/slider_bg_01.png); background-size: cover;">
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-7 col-md-7">
                           <div class="slider-content s-slider-content mt-200">
                              <h5 data-animation="fadeInUp" data-delay=".4s"></h5>
                              <h2 data-animation="fadeInUp" data-delay=".4s">Welcome To <br>Radiant Transcript</h2>
                              <p data-animation="fadeInUp" data-delay=".6s">India's Leading and Trusted Transcripts Service Providers</p>
                              <div class="slider-btn mt-30">
                                 <a href="#" class="btn ss-btn mr-15" data-animation="fadeInLeft" data-delay=".4s">Discover More <i class="fal fa-long-arrow-right"></i></a>
                                 <a href="#" class="btn ss-btn active" data-animation="fadeInLeft" data-delay=".4s">Contact Us <i class="fal fa-long-arrow-right"></i></a>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-5 col-md-5 p-relative">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="single-slider slider-bg" style="background-image: url(assets/front/img/slider/slider_bg.png); background-size: cover;">
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-7 col-md-7">
                           <div class="slider-content s-slider-content mt-200">
                              <h5 data-animation="fadeInUp" data-delay=".4s"></h5>
                              <h2 data-animation="fadeInUp" data-delay=".4s">Welcome To <br>Radiant Transcript</h2>
                              <p data-animation="fadeInUp" data-delay=".6s">India's Leading and Trusted Transcripts Service Providers</p>
                              <div class="slider-btn mt-30">
                                 <a href="#" class="btn ss-btn mr-15" data-animation="fadeInLeft" data-delay=".4s">Discover More <i class="fal fa-long-arrow-right"></i></a>
                                 <a href="#" class="btn ss-btn active" data-animation="fadeInLeft" data-delay=".4s">Contact Us <i class="fal fa-long-arrow-right"></i></a>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-5 col-md-5 p-relative">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- slider-area-end -->
         <!-- service-area -->
         <section class="service-details-two p-relative">
            <div class="container">
               <div class="row">
                  <div class="col-lg-4 col-md-12 col-sm-12">
                     <div class="services-box07">
                        <div class="sr-contner">
                           <div class="icon">
                              <img src="assets/front/img/icon/sve-icon4.png" alt="icon01">
                           </div>
                           <div class="text"
                              <h5><a href="#">Knowledge          jj Bureau</a></h5>
                              <p>Accurate information to satisfy all the needs of our clients.</p>
                           </div>

                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-12 col-sm-12">
                     <div class="services-box07 active">
                        <div class="sr-contner">
                           <div class="icon">
                              <img src="assets/front/img/icon/sve-icon5.png" alt="icon01">
                           </div>
                           <div class="text">
                              <h5><a href="#">Client Oriented</a></h5>
                              <p>We are customer attentive and deliver the best service with confidentiality and appropriate.</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-12 col-sm-12">
                     <div class="services-box07">
                        <div class="sr-contner">
                           <div class="icon">
                              <img src="assets/front/img/icon/sve-icon6.png" alt="icon01">
                           </div>
                           <div class="text">
                              <h5><a href="#">Achievements</a></h5>
                              <p>Our Success rate is almost 100% from applying to completion of the process.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- service-details2-area-end -->
         <!-- about-area -->
         <section class="about-area about-p pt-120 pb-120 p-relative fix" style="background: #eff7ff;">
            <div class="animations-02"><img src="assets/front/img/bg/an-img-02.png" alt="contact-bg-an-01"></div>
            <div class="container">
               <div class="row justify-content-center align-items-center">
                  <div class="col-lg-6 col-md-12 col-sm-12">
                     <div class="s-about-img p-relative  wow fadeInLeft animated" data-animation="fadeInLeft" data-delay=".4s">
                        <img src="assets/front/img/features/about_img_02.png" alt="img">
                        <div class="about-text second-about">
                           <span>5 <sub>+</sub></span>
                           <p>Years of Experience</p>
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-lg-6 col-md-12 col-sm-12">
                     <div class="about-content s-about-content pl-15 wow fadeInRight  animated" data-animation="fadeInRight" data-delay=".4s">
                        <div class="about-title second-title pb-25">
                           <h5><i class="fal fa-graduation-cap"></i> About Our  Transcripts</h5>
                           <h2>A Few Words About</h2>
                        </div>
                        <p class="txt-clr">Radiant Transcripts is one of the leading and best academic certificate attestations Company based in Bangalore and having its wings spread across all over India. Radiant Transcripts has been and will continue to be a pillar of trust for our valued customers. The streamlined process makes our users to experience a transparent process evading chaos, who are unable to visit Universities due to their personal and professional engagements. Radiant Transcripts takes care of your documentation needs without any hassles by saving your valuable time and energy, while you work on your for immigration process, We help in procuring credential verification / attestation / transcripts for ECE, WES, IQAS, ICES, CES, ICAS, PEBEC, NDEB, NASBA, etc.,
                        </p>
                        <div class="about-content2">
                           <div class="row">
                              <div class="col-md-12">
                                 <ul class="green2">
                                    <li>
                                       <div class="abcontent">
                                          <div class="ano"><span>01</span></div>
                                          <div class="text">
                                             <h3> Degrees</h3>
                                             <p>Education is the best key success in life</p>
                                          </div>
                                       </div>
                                    </li>
                                    <li>
                                       <div class="abcontent">
                                          <div class="ano"><span>02</span></div>
                                          <div class="text">
                                             <h3>Global Students</h3>
                                             <p>Better Education for Beautiful World</p>
                                          </div>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class="slider-btn mt-20">
                           <a href="#" class="btn ss-btn smoth-scroll">Read More <i class="fal fa-long-arrow-right"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- about-area-end -->
         <!-- courses-area -->
         <section class="courses pt-120 pb-120 p-relative fix">
            <div class="animations-01"><img src="assets/front/img/bg/an-img-03.png" alt="an-img-01"></div>
            <div class="container">
               <div class="row">
                  <div class="col-lg-12 p-relative">
                     <div class="section-title center-align mb-50 wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                        <h5><i class="fal fa-graduation-cap"></i> What We Offer</h5>
                        <h2>
                           Our Services
                        </h2>
                     </div>
                  </div>
               </div>
               <div class="row class-active">
                  <div class="col-lg-4 col-md-6 ">
                     <div class="courses-item mb-30 hover-zoomin">
                        <div class="thumb fix">
                           <a href="#"><img src="assets/front/img/s1.jpg" alt="contact-bg-an-01"></a>
                        </div>
                        <div class="courses-content">
                           <div class="cat"><i class="fal fa-graduation-cap"></i> Radiant Transcripts</div>
                           <h3><a href="#">Credential Assessments</a></h3>
                           <p>Radiant will collect the sealed transcripts from your university depending on the geographical location and the authorization of the University.</p>
                           <a href="#" class="readmore">Read More <i class="fal fa-long-arrow-right"></i></a>
                        </div>
                        <div class="icon">
                           <img src="assets/front/img/icon/cou-icon.png" alt="img">
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 ">
                     <div class="courses-item mb-30 hover-zoomin">
                        <div class="thumb fix">
                           <a href="#"><img src="assets/front/img/s2.jpg" alt="contact-bg-an-01"></a>
                        </div>
                        <div class="courses-content">
                           <div class="cat"><i class="fal fa-graduation-cap"></i> Radiant Transcripts</div>
                           <h3><a href="#"> Medium Of Instruction</a></h3>
                           <p>The medium of instruction certificate is an officially recognized letter which confirms the medium in which one has studied.</p>
                           <a href="#" class="readmore">Read More <i class="fal fa-long-arrow-right"></i></a>
                        </div>
                        <div class="icon">
                           <img src="assets/front/img/icon/cou-icon.png" alt="img">
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 ">
                     <div class="courses-item mb-30 hover-zoomin">
                        <div class="thumb fix">
                           <a href="#"><img src="assets/front/img/s3.jpg" alt="contact-bg-an-01"></a>
                        </div>
                        <div class="courses-content">
                           <div class="cat"><i class="fal fa-graduation-cap"></i> Radiant Transcripts</div>
                           <h3><a href="#"> Syllabus Copy</a></h3>
                           <p>Radiant will get the Syllabus Copy attested from the University/College upon receiving the copy from the candidate.</p>
                           <a href="#" class="readmore">Read More <i class="fal fa-long-arrow-right"></i></a>
                        </div>
                        <div class="icon">
                           <img src="assets/front/img/icon/cou-icon.png" alt="img">
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 ">
                     <div class="courses-item mb-30 hover-zoomin">
                        <div class="thumb fix">
                           <a href="#"><img src="assets/front/img/s14.jpg" alt="contact-bg-an-01"></a>
                        </div>
                        <div class="courses-content">
                           <div class="cat"><i class="fal fa-graduation-cap"></i> Radiant Transcripts</div>
                           <h3><a href="#"> Degree Certificate / Convocation</a></h3>
                           <p>The candidates who have not collected their convocation or have lost their degree certificate/convocation,</p>
                           <a href="#" class="readmore">Read More <i class="fal fa-long-arrow-right"></i></a>
                        </div>
                        <div class="icon">
                           <img src="assets/front/img/icon/cou-icon.png" alt="img">
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 ">
                     <div class="courses-item mb-30 hover-zoomin">
                        <div class="thumb fix">
                           <a href="#"><img src="assets/front/img/s15.jpg" alt="contact-bg-an-01"></a>
                        </div>
                        <div class="courses-content">
                           <div class="cat"><i class="fal fa-graduation-cap"></i> Radiant Transcripts</div>
                           <h3><a href="#"> Provisional Degree Certificate</a></h3>
                           <p>A Temporary (Provisional) Degree Certificate is a document issued by an institution to a student</p>
                           <a href="#" class="readmore">Read More <i class="fal fa-long-arrow-right"></i></a>
                        </div>
                        <div class="icon">
                           <img src="assets/front/img/icon/cou-icon.png" alt="img">
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6 ">
                     <div class="courses-item mb-30 hover-zoomin">
                        <div class="thumb fix">
                           <a href="#"><img src="assets/front/img/s6.jpg" alt="contact-bg-an-01"></a>
                        </div>
                        <div class="courses-content">
                           <div class="cat"><i class="fal fa-graduation-cap"></i> Radiant Transcripts</div>
                           <h3><a href="#"> Hrd Attestation </a></h3>
                           <p>HRD attestation is a legalization process done to authenticate an educational document.</p>
                           <a href="#" class="readmore">Read More <i class="fal fa-long-arrow-right"></i></a>
                        </div>
                        <div class="icon">
                           <img src="assets/front/img/icon/cou-icon.png" alt="img">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- courses-area -->
         <!-- steps-area -->
         <section class="steps-area p-relative"  style="background-color: #032e3f;">
            <div class="animations-10"><img src="assets/front/img/bg/an-img-10.png" alt="an-img-01"></div>
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-lg-6 col-md-12">
                     <div class="section-title mb-35 wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                        <h2>Why You Choose Radiant Transcript Services?</h2>
                        <p>Radiant Transcripts Services always ensures and cherishes to treat every client the way they like to be treated. We believe what is good for the customer is good for us and we try to function from a their point of view or the way they prefer – on – time completion of tasks, regular status updates on the requests, providing clarifications at all times. Our clients can reach us any time as per their personal schedule and we would be happy to assist.</p>
                     </div>
                     <ul class="pr-20">
                        <li>
                           <div class="step-box wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                              <div class="dnumber">
                                 <div class="date-box"><img src="assets/front/img/icon/fea-icon01.png" alt="icon"></div>
                              </div>
                              <div class="text">
                                 <h3>Skilled Teachers</h3>
                              </div>
                           </div>
                        </li>
                        <li>
                           <div class="step-box wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                              <div class="dnumber">
                                 <div class="date-box"><img src="assets/front/img/icon/fea-icon02.png" alt="icon"></div>
                              </div>
                              <div class="text">
                                 <h3>Affordable Price</h3>
                              </div>
                           </div>
                        </li>
                        <li>
                           <div class="step-box wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                              <div class="dnumber">
                                 <div class="date-box"><img src="assets/front/img/icon/fea-icon03.png" alt="icon"></div>
                              </div>
                              <div class="text">
                                 <h3>Efficient & Flexible</h3>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </div>
                  <div class="col-lg-6 col-md-12">
                     <div class="step-img wow fadeInLeft animated" data-animation="fadeInLeft" data-delay=".4s">
                        <img src="assets/front/img/bg/steps-img.png" alt="class image">
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- steps-area-end -->
         <!-- event-area -->
         <section class="event pt-120 pb-90 p-relative fix">
            <div class="animations-06"><img src="assets/front/img/bg/an-img-06.png" alt="an-img-01"></div>
            <div class="animations-07"><img src="assets/front/img/bg/an-img-07.png" alt="contact-bg-an-01"></div>
            <div class="animations-08"><img src="assets/front/img/bg/an-img-08.png" alt="contact-bg-an-01"></div>
            <div class="animations-09"><img src="assets/front/img/bg/an-img-09.png" alt="contact-bg-an-01"></div>
            <div class="container">
               <div class="row">
                  <div class="col-lg-12 p-relative">
                     <div class="section-title center-align mb-50 text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                        <h5><i class="fal fa-graduation-cap"></i> Radiant Transcripts</h5>
                        <h2>
                           Latest Blogs
                        </h2>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-4 col-md-6  wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                     <div class="event-item mb-30 hover-zoomin">
                        <div class="thumb">
                           <a href="#"><img src="assets/front/img/bg/evn-img-1.jpg" alt="contact-bg-an-01"></a>
                        </div>
                        <div class="event-content">
                           <div class="date"><strong>18</strong> June, 2024</div>
                           <h3><a href="#"> Basic UI & UX Design for new development</a></h3>
                           <div class="time">3:30 pm - 4:30 pm <i class="fal fa-long-arrow-right"></i> <strong>India</strong></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6  wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                     <div class="event-item mb-30 hover-zoomin">
                        <div class="thumb">
                           <a href="#"><img src="assets/front/img/bg/evn-img-2.jpg" alt="contact-bg-an-01"></a>
                        </div>
                        <div class="event-content">
                           <div class="date"><strong>20</strong> June, 2024</div>
                           <h3><a href="#">Digital Education Market Briefing: Minnesota 2023</a></h3>
                           <div class="time">3:30 pm - 4:30 pm <i class="fal fa-long-arrow-right"></i> <strong>India</strong></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6  wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                     <div class="event-item mb-30 hover-zoomin">
                        <div class="thumb">
                           <a href="#"><img src="assets/front/img/bg/evn-img-3.jpg" alt="contact-bg-an-01"></a>
                        </div>
                        <div class="event-content">
                           <div class="date"><strong>22</strong> June, 2024</div>
                           <h3><a href="#"> Learning Network Webinars for Music Teachers</a></h3>
                           <div class="time">3:30 pm - 4:30 pm <i class="fal fa-long-arrow-right"></i> <strong>India</strong></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6  wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                     <div class="event-item mb-30 hover-zoomin">
                        <div class="thumb">
                           <a href="#"><img src="assets/front/img/bg/evn-img-4.jpg" alt="contact-bg-an-01"></a>
                        </div>
                        <div class="event-content">
                           <div class="date"><strong>22</strong> June, 2024</div>
                           <h3><a href="#"> Next-Gen Higher Education Students Have Arrived?</a></h3>
                           <div class="time">3:30 pm - 4:30 pm <i class="fal fa-long-arrow-right"></i> <strong>India</strong></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6  wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                     <div class="event-item mb-30 hover-zoomin">
                        <div class="thumb">
                           <a href="#"><img src="assets/front/img/bg/evn-img-5.jpg" alt="contact-bg-an-01"></a>
                        </div>
                        <div class="event-content">
                           <div class="date"><strong>24</strong> June, 2024</div>
                           <h3><a href="#"> Digital Art & 3D Model – a future for film company</a></h3>
                           <div class="time">3:30 pm - 4:30 pm <i class="fal fa-long-arrow-right"></i> <strong>India</strong></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6  wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                     <div class="event-item mb-30 hover-zoomin">
                        <div class="thumb">
                           <a href="#"><img src="assets/front/img/bg/evn-img-6.jpg" alt="contact-bg-an-01"></a>
                        </div>
                        <div class="event-content">
                           <div class="date"><strong>30</strong> June, 2024</div>
                           <h3><a href="#"> Conscious Discipline Summer Institute</a></h3>
                           <div class="time">3:30 pm - 4:30 pm <i class="fal fa-long-arrow-right"></i> <strong>India</strong></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- courses-area -->
         <!-- cta-area -->
         <section class="cta-area cta-bg pt-50 pb-50" style="background-image:url(assets/front/img/bg/cta_bg02.png)">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-lg-8">
                     <div class="section-title cta-title wow fadeInLeft animated" data-animation="fadeInDown animated" data-delay=".2s">
                        <h2>Join Us</h2>
                        <p>Radiant Transcripts is one of the leading and best academic certificate attestations Company based in Bangalore and having its wings spread across all over India.</p>
                     </div>
                  </div>
                  <div class="col-lg-4 text-right">
                     <div class="cta-btn s-cta-btn wow fadeInRight animated mt-30" data-animation="fadeInDown animated" data-delay=".2s">
                        <a href="#" class="btn ss-btn smoth-scroll">Contact Us <i class="fal fa-long-arrow-right"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- cta-area-end -->
         <!-- frequently-area -->
         <section class="faq-area pt-120 pb-120 p-relative fix">
            <div class="animations-10"><img src="assets/front/img/bg/an-img-04.png" alt="an-img-01"></div>
            <div class="animations-08"><img src="assets/front/img/bg/an-img-05.png" alt="contact-bg-an-01"></div>
            <div class="container">
               <div class="row justify-content-center  align-items-center">
                  <div class="col-lg-7">
                     <div class="section-title wow fadeInLeft animated" data-animation="fadeInDown animated" data-delay=".2s">
                        <h2>How It Works</h2>
                        <!--  <p>A business or organization established to provide a particular service, typically one that involves a organizing transactions.</p> -->
                     </div>
                     <div class="faq-wrap mt-30 pr-30 wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                        <div class="accordion" id="accordionExample">
                           <div class="card">
                              <div class="card-header" id="headingThree">
                                 <h2 class="mb-0">
                                    <button class="faq-btn" type="button" data-bs-toggle="collapse"
                                       data-bs-target="#collapseThree"  >
                                    Order Placement
                                    </button>
                                 </h2>
                              </div>
                              <div id="collapseThree" class="collapse show"
                                 data-bs-parent="#accordionExample">
                                 <div class="card-body">
                                    <ul class="arrow">
                                       <li>Select your service location.</li>
                                       <li>Fill the Application form and place an order.</li>
                                       <li>Make a payment online.</li>
                                       <li>You will receive a list of required documents and further process within 24 to 48 hours.</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header" id="headingOne">
                                 <h2 class="mb-0">
                                    <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse"
                                       data-bs-target="#collapseOne"  >
                                    Verification and Processing
                                    </button>
                                 </h2>
                              </div>
                              <div id="collapseOne" class="collapse" data-bs-parent="#accordionExample">
                                 <div class="card-body">
                                    <ul class="arrow">
                                       <li>Our team will review and verify the received documents.</li>
                                       <li>Application is processed according to the applied service.</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-header" id="headingTwo">
                                 <h2 class="mb-0">
                                    <button class="faq-btn collapsed" type="button" data-bs-toggle="collapse"
                                       data-bs-target="#collapseTwo"  >
                                    Delivery
                                    </button>
                                 </h2>
                              </div>
                              <div id="collapseTwo" class="collapse" data-bs-parent="#accordionExample">
                                 <div class="card-body">
                                    <ul class="arrow">
                                       <li>Prompt Status updates at various stages.</li>
                                       <li>Document/Transcript delivered to your address or directly to Assessment agencies like WES directly from Universities.</li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-5">
                     <div class="contact-bg02">
                        <div class="section-title wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                           <h2>
                              Make An Contact
                           </h2>
                        </div>
                        <form action="#" method="post" class="contact-form mt-30 wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="contact-field p-relative c-name mb-20">
                                    <input type="text" id="firstn" name="firstn" placeholder="First Name" required>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="contact-field p-relative c-subject mb-20">
                                    <input type="text" id="email" name="email" placeholder="Email" required>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="contact-field p-relative c-subject mb-20">
                                    <input type="text" id="phone" name="phone" placeholder="Phone No." required>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="contact-field p-relative c-message mb-30">
                                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Write comments"></textarea>
                                 </div>
                                 <div class="slider-btn">
                                    <button class="btn ss-btn" data-animation="fadeInRight" data-delay=".8s"><span>Submit Now</span> <i class="fal fa-long-arrow-right"></i></button>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- frequently-area-end -->
         <!-- video-area -->
         <section class="cta-area cta-bg pt-160 pb-160" style="background-image:url(assets/front/img/bg/cta_bg.png)">
            <div class="container">
               <div class="row justify-content-center  align-items-center">
                  <div class="col-xl-6 col-lg-6 col-md-12">
                     <div class="section-title cta-title video-title wow fadeInLeft animated" data-animation="fadeInDown animated" data-delay=".2s">
                        <h2> We're <span>Radiant Transcipts</span> & We're Different</h2>
                        <p>Our community is being called to reimagine the future. As the only Radiant Transcipts </p>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-2">
                  </div>
                  <div class="col-lg-4">
                     <div class="s-video-content">
                        <!--  <a href="https://www.youtube.com/watch?v=gyGsPlt06bo" class="popup-video mb-50"><img src="https://radianttranscripts.com/assets/front/img/bg/play-button.png" alt="circle_right"></a>
                           -->
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- video-area-end -->
         <!-- testimonial-area -->
         <section class="testimonial-area pt-120 pb-115 p-relative fix">
            <div class="animations-01"><img src="assets/front/img/bg/an-img-03.png" alt="an-img-01"></div>
            <div class="animations-02"><img src="assets/front/img/bg/an-img-04.png" alt="contact-bg-an-01"></div>
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="section-title text-center mb-50 wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                        <h5><i class="fal fa-graduation-cap"></i> Testimonial</h5>
                        <h2>
                           What Our Clients Says
                        </h2>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="testimonial-active wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                        <div class="single-testimonial text-center">
                           <div class="qt-img">
                              <img src="assets/front/img/testimonial/qt-icon.png" alt="img">
                           </div>
                           <p>Amazing service from Radiant, I had to talk to them only once for my Bangalore University and Madurai Kamaraj university transcripts. Highly skilled professionals, I was recommended by my friend and it was the best decision.</p>
                           <div class="testi-author">
                              <!-- <img src="https://radianttranscripts.com/assets/front/img/testimonial/testi_avatar.png" alt="img"> -->
                           </div>
                           <div class="ta-info">
                              <h6> Shruthi K</h6>
                           </div>
                        </div>
                        <div class="single-testimonial text-center">
                           <div class="qt-img">
                              <img src="assets/front/img/testimonial/qt-icon.png" alt="img">
                           </div>
                           <p>Thanks a tonne to Radiant Transcripts; I had contacted so many consultants for KSOU Mysore transcripts. You are the only one who committed and succeeded to provide my transcripts. I can't thank you much, it really means a lot.</p>
                           <div class="testi-author">
                              <!-- <img src="https://radianttranscripts.com/assets/front/img/testimonial/testi_avatar_02.png" alt="img"> -->
                           </div>
                           <div class="ta-info">
                              <h6>Aastha Kaur</h6>
                           </div>
                        </div>
                        <div class="single-testimonial text-center">
                           <div class="qt-img">
                              <img src="assets/front/img/testimonial/qt-icon.png" alt="img">
                           </div>
                           <p>Thank you so much Guys, You made my day. I received my WES evaluation reports. Amazing, stupendous, awesome, marvelous and I can go on.. I recommend everyone on Google to take your services.</p>
                           <div class="testi-author">
                              <!-- <img src="https://radianttranscripts.com/assets/front/img/testimonial/testi_avatar_03.png" alt="img"> -->
                           </div>
                           <div class="ta-info">
                              <h6> Afsana Khan</h6>
                           </div>
                        </div>
                        <div class="single-testimonial text-center">
                           <div class="qt-img">
                              <img src="assets/front/img/testimonial/qt-icon.png" alt="img">
                           </div>
                           <p>I was referred to by a family friend in Canada. Their family got transcripts done from Radiant. Upon choosing Radiant I could realistically feel whatever they told about the company was true. Highly appreciate the efficiency and suggest others to avail their services!.</p>
                           <div class="testi-author">
                              <!-- <img src="https://radianttranscripts.com/assets/front/img/testimonial/testi_avatar.png" alt="img"> -->
                           </div>
                           <div class="ta-info">
                              <h6>Jasmine Jose</h6>
                           </div>
                        </div>
                        <div class="single-testimonial text-center">
                           <div class="qt-img">
                              <img src="assets/front/img/testimonial/qt-icon.png" alt="img">
                           </div>
                           <p>These guys are very professional and time management is at par. Work done effectively from Pune University. Thank you Radiant Transcripts Services.</p>
                           <div class="testi-author">
                              <!-- <img src="https://radianttranscripts.com/assets/front/img/testimonial/testi_avatar_02.png" alt="img"> -->
                           </div>
                           <div class="ta-info">
                              <h6>Sheetal Joshi</h6>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- testimonial-area-end -->
         <!-- search-area -->
         <!-- newslater-area -->
      </main>
      <!-- main-area-end -->
      <!-- footer -->
      <footer class="footer-bg footer-p pt-90" style="background-color: #125875; background-image: url(assets/front/img/bg/footer-bg.png);">
         <div class="footer-top pb-70">
            <div class="container">
               <div class="row justify-content-between">
                  <div class="col-xl-4 col-lg-4 col-sm-6">
                     <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                           <h2>Address</h2>
                        </div>
                        <div class="f-contact">
                           {{ config('constants.options.__project_address__') }}
                        </div>
                        <div class="footer-social mt-10">
                           <a href="https://www.facebook.com/radiantts" target="_blank"><i class="fab fa-facebook-f"></i></a>
                           <a target="_blank" href="https://www.linkedin.com/company/radianttranscriptsservices/?viewAsMember=true"><i class="fab fa-linkedin"></i></a>
                           <a target="_blank" href="https://twitter.com/RadiantTrans"><i class="fab fa-twitter"></i></a>
                           <a target="_blank" href="https://radianttranscriptsservices.quora.com/"><i class="fab fa-quora"></i></a>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-2 col-lg-2 col-sm-6">
                     <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                           <h2>Our Links</h2>
                        </div>
                        <div class="footer-link">
                           <ul>
                              <li><a href="about.html">About Us</a></li>
                              <li><a href="university.html">Universities</a></li>
                              <li><a href="services.html">Services</a></li>
                              <li><a href="Login.html">Apply Now</a></li>
                              <li><a href="contact-us.html">Contact Us</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-sm-6">
                     <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                           <h2>Latest Post</h2>
                        </div>
                        <div class="recent-blog-footer">
                           <ul>
                              <li>
                                 <div class="thum"> <img src="assets/front/img/blog/s-blogimg-01.png" alt="img"></div>
                                 <div class="text"> <a href="#">Nothing impossble to need hard work</a>
                                    <span>June, 2024</span>
                                 </div>
                              </li>
                              <li>
                                 <div class="thum"> <img src="assets/front/img/blog/s-blogimg-02.png" alt="img"></div>
                                 <div class="text"> <a href="#">Nothing impossble to need hard work</a>
                                    <span>June, 2024</span>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-sm-6">
                     <div class="footer-widget mb-30">
                        <div class="f-widget-title">
                           <h2>Contact Us</h2>
                        </div>
                        <div class="f-contact">
                           <ul>
                              <li>
                                 <i class="icon fal fa-phone"></i>
                                 <span><a href="tel:{{ config('constants.options.__projectcontact__') }}">{{ config('constants.options.__projectcontact__') }}</a><br><a href="tel:{{ config('constants.options.__projectcontact__') }}"> {{ config('constants.options.__projectcontact__') }}</a></span>
                              </li>
                              <li>
                                 <i class="icon fal fa-envelope"></i>
                                 <span>
                                    <a href="{{ config('constants.options.__projectemail__') }}">{{ config('constants.options.__projectemail__') }}</a>
                                    <br>
                                    <!-- <a href="mailto:contact@radianttranscripts.com">contact@radianttranscripts.com</a> -->
                                 </span>
                              </li>
                              <!-- <li>
                                 <i class="icon fal fa-map-marker-check"></i>
                                 <span>No.34, Shop No.2, Ground Floor, Fatma Manor, 5th Cross Road, Maruthi Extension, New Gurrapanapalya, BTM 1st Stage Bangaluru, Karnataka 560029</span>
                                 </li> -->
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="copyright-wrap">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-lg-12 text-center ">
                     Copyright &copy; {{ config('constants.options._project_complete_name_') }} {{ date('Y')}}  {{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}). All rights reserved.
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <!-- footer-end -->
      <!-- JS here -->
      <script src="assets/front/js/vendor/modernizr-3.5.0.min.js"></script>
      <script src="assets/front/js/vendor/jquery-3.6.0.min.js"></script>
      <script src="assets/front/js/popper.min.js"></script>
      <script src="assets/front/js/bootstrap.min.js"></script>
      <script src="assets/front/js/slick.min.js"></script>
      <script src="assets/front/js/ajax-form.js"></script>
      <script src="assets/front/js/paroller.js"></script>
      <script src="assets/front/js/wow.min.js"></script>
      <script src="assets/front/js/js_isotope.pkgd.min.js"></script>
      <script src="assets/front/js/imagesloaded.min.js"></script>
      <script src="assets/front/js/parallax.min.js"></script>
      <script src="assets/front/js/jquery.waypoints.min.js"></script>
      <script src="assets/front/js/jquery.counterup.min.js"></script>
      <script src="assets/front/js/jquery.scrollUp.min.js"></script>
      <script src="assets/front/js/jquery.meanmenu.min.js"></script>
      <script src="assets/front/js/parallax-scroll.js"></script>
      <script src="assets/front/js/jquery.magnific-popup.min.js"></script>
      <script src="assets/front/js/element-in-view.js"></script>
      <script src="assets/front/js/main.js"></script>
   </body>
</html>