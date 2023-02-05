<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">
    
<head>
        <meta charset="UTF-8" />
        <title>Pengaduan</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta content="Tailwind CSS Saas & Software Landing Page Template" name="description" />
        <meta name="author" content="#" />
        <meta name="website" content="#" />
        <meta name="email" content="#" />
        <meta name="version" content="1.3.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico" />

        <!-- Css -->
        <link href="assets/libs/tiny-slider/tiny-slider.css" rel="stylesheet">
        <link href="assets/libs/tobii/css/tobii.min.css" rel="stylesheet">
        <!-- Main Css -->
        <link href="assets/libs/%40iconscout/unicons/css/line.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/icons.min.css" />
        <link rel="stylesheet" href="assets/css/tailwind.min.css" />

    </head>
    
    <body class="font-nunito text-base text-black dark:text-white dark:bg-slate-900">

        <!-- Loader Start -->
        <!-- <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        </div> -->
        <!-- Loader End -->
        
        <!-- Start Navbar -->
       @livewire('navbar')
        <!-- End Navbar -->

        <main>
            @yield('content')
    
            @isset($slot)
                {{ $slot }}
            @endisset
        </main>

        <!-- Footer Start -->
        @livewire('footer')
        <!-- Footer End -->

        <!-- Start Cookie Popup -->
        {{-- <div class="cookie-popup fixed max-w-lg bottom-3 right-3 left-3 sm:left-0 sm:right-0 mx-auto bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 rounded-md py-5 px-6 z-10">
            <p class="text-slate-400">This website uses cookies to provide you with a great user experience. By using it, you accept our <a href="https://shreethemes.in/" target="_blank" class="text-emerald-600 dark:text-emerald-500 font-semibold">use of cookies</a></p>
            <div class="cookie-popup-actions text-right">
                <button class="absolute border-none bg-none p-0 cursor-pointer font-semibold top-2 right-2"><i class="uil uil-times text-dark dark:text-slate-200 text-2xl"></i></button>
            </div>
        </div> --}}
        <!--Note: Cookies Js including in plugins.init.js (path like; assets/js/plugins.init.js) and Cookies css including in _helper.scss (path like; scss/_helper.scss)-->
        <!-- End Cookie Popup -->

        <!-- Back to top -->
        <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 right-5 h-9 w-9 text-center bg-indigo-600 text-white leading-9"><i class="uil uil-arrow-up"></i></a>
        <!-- Back to top -->

        <!-- Switcher -->
        <div class="fixed top-1/4 -right-1 z-3">
            <span class="relative inline-block rotate-90">
                <input type="checkbox" class="checkbox opacity-0 absolute" id="chk" />
                <label class="label bg-slate-900 dark:bg-white shadow dark:shadow-gray-800 cursor-pointer rounded-full flex justify-between items-center p-1 w-14 h-8" for="chk">
                    <i class="uil uil-moon text-[20px] text-yellow-500"></i>
                    <i class="uil uil-sun text-[20px] text-yellow-500"></i>
                    <span class="ball bg-white dark:bg-slate-900 rounded-full absolute top-[2px] left-[2px] w-7 h-7"></span>
                </label>
            </span>
        </div>
        <!-- Switcher -->

        <!-- JAVASCRIPTS -->
        <script src="assets/libs/tiny-slider/min/tiny-slider.js"></script>
        <script src="assets/libs/tobii/js/tobii.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <script src="assets/js/plugins.init.js"></script>
        <script src="assets/js/app.js"></script>
        <!-- JAVASCRIPTS -->
    </body>
</html>