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
    
        <!-- Start -->
        <section class="relative bg-indigo-600/5">
            <div class="container-fluid relative">
                <div class="grid grid-cols-1">
                    <div class="flex flex-col min-h-screen justify-center md:px-10 py-10 px-4">
                        <div class="text-center">
                            <a href="{{route('home')}}"><img src="assets/images/logo-icon-64.png" class="mx-auto" alt=""></a>
                        </div>
                        <div class="title-heading text-center my-auto">
                            <img src="assets/images/error.png" class="mx-auto" alt="">
                            <h1 class="mt-3 mb-6 md:text-5xl text-3xl font-bold">Page Not Found?</h1>
                            <p class="text-slate-400">Whoops, this is embarassing. <br> Looks like the page you were looking for wasn't found.</p>
                            
                            <div class="mt-4">
                                <a href="{{route('home')}}" class="btn bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md">Back to Home</a>
                            </div>
                        </div>
                        {{-- <div class="text-center">
                            <p class="mb-0 text-slate-400">© <script>document.write(new Date().getFullYear())</script> Techwind. Design with <i class="mdi mdi-heart text-red-600"></i> by <a href="https://shreethemes.in/" target="_blank" class="text-reset">Shreethemes</a>.</p>
                        </div> --}}
                    </div>
                </div><!--end grid-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- End -->

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
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <script src="assets/js/plugins.init.js"></script>
        <script src="assets/js/app.js"></script>
        <!-- JAVASCRIPTS -->
    </body>
</html>