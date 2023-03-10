<div>
    <nav id="topnav" class="defaultscroll is-sticky">
        <div class="container">
            <!-- Logo container-->
            <a class="logo" href="index.html">
                <span class="inline-block dark:hidden">
                    <img src="{{asset('assets/images/logo-dark.png')}}" class="l-dark" height="24" alt="">
                    <img src="{{asset('assets/images/logo-light.png')}}" class="l-light" height="24" alt="">
                </span>
                <img src="{{asset('assets/images/logo-light.png')}}" height="24" class="hidden dark:inline-block" alt="">
            </a>

            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <!--Login button Start-->
            {{-- <ul class="buy-button list-none mb-0">
                <li class="inline mb-0">
                    <a href="#">
                        <span class="login-btn-primary"><span class="btn btn-icon rounded-full bg-indigo-600/5 hover:bg-indigo-600 border-indigo-600/10 hover:border-indigo-600 text-indigo-600 hover:text-white"><i data-feather="settings" class="h-4 w-4"></i></span></span>
                        <span class="login-btn-light"><span class="btn btn-icon rounded-full bg-gray-50 hover:bg-gray-200 dark:bg-slate-900 dark:hover:bg-gray-700 hover:border-gray-100 dark:border-gray-700 dark:hover:border-gray-700"><i data-feather="settings" class="h-4 w-4"></i></span></span>
                    </a>
                </li>
        
                <li class="inline pl-1 mb-0">
                    <a href="https://1.envato.market/techwind" target="_blank">
                        <div class="login-btn-primary"><span class="btn btn-icon rounded-full bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white"><i data-feather="shopping-cart" class="h-4 w-4"></i></span></div>
                        <div class="login-btn-light"><span class="btn btn-icon rounded-full bg-gray-50 hover:bg-gray-200 dark:bg-slate-900 dark:hover:bg-gray-700 hover:border-gray-100 dark:border-gray-700 dark:hover:border-gray-700"><i data-feather="shopping-cart" class="h-4 w-4"></i></span></div>
                    </a>
                </li>
            </ul> --}}
            <!--Login button End-->

            <div id="navigation">
                <!-- Navigation Menu-->   
                <ul class="navigation-menu nav-light">
                    <li><a href="{{route('home')}}" class="sub-menu-item">Home</a></li>
                    <li class="has-submenu parent-menu-item">
                        <a href="javascript:void(0)">Docs</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="/notfound" class="sub-menu-item">Documentation</a></li>
                            <li><a href="/notfound" class="sub-menu-item">Changelog</a></li>
                            <li><a href="/notfound" class="sub-menu-item">Widget</a></li>
                        </ul>
                    </li>
                    <li><a href="/notfound" class="sub-menu-item">Contact</a></li>
                </ul><!--end navigation menu-->
            </div><!--end navigation-->
        </div><!--end container-->
    </nav><!--end header-->
</div>
