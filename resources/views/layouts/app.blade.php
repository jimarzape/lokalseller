<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/images/logo.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap Core CSS -->
    <link href="/dark/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="/dark/plugins/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/dark/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="/dark/css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/custom.css?{{time()}}">
    <link href="/dark/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    @yield('css')
</head>

<body class="fix-header fix-sidebar card-no-border">
    <div id="app">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{route('home')}}">
                            <!-- Logo icon --><b>
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <img src="/dark/images/logo-icon.png" alt="homepage" class="dark-logo img-40" />
                                <!-- Light Logo icon -->
                                <img src="/dark/images/logo-icon.png" alt="homepage" class="light-logo img-40" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text --><span>
                             <!-- dark Logo text -->
                             <img src="/dark/images/logo-text.png" alt="homepage" class="dark-logo" />
                             <!-- Light Logo text -->    
                             <img src="/dark/images/logo-text.png" class="light-logo" alt="homepage" /></span> </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-collapse">
                        <!-- ============================================================== -->
                        <!-- toggle and nav items -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav mr-auto mt-md-0">
                            <!-- This is  -->
                            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                            <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                            <!-- ============================================================== -->
                            <!-- Comment -->
                            <!-- ============================================================== -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell"></i>
                                    <!-- <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div> -->
                                </a>
                                <div class="dropdown-menu mailbox animated slideInUp">
                                    <ul>
                                        <li>
                                            <div class="drop-title">Notifications</div>
                                        </li>
                                        <li>
                                            <div class="message-center">
                                               
                                            </div>
                                        </li>
                                       <!--  <li>
                                            <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                        </li> -->
                                    </ul>
                                </div>
                            </li>
                            <!-- ============================================================== -->
                            <!-- End Comment -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- Messages -->
                            <!-- ============================================================== -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                    <!-- <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div> -->
                                </a>
                                <div class="dropdown-menu mailbox animated slideInUp" aria-labelledby="2">
                                    <ul>
                                        <li>
                                            <div class="drop-title">You have 0 message</div>
                                        </li>
                                        <li>
                                            <div class="message-center">
                                               
                                            </div>
                                        </li>
                                        <!-- <li>
                                            <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a>
                                        </li> -->
                                    </ul>
                                </div>
                            </li>
                           
                        </ul>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav my-lg-0">
                        
                           
                           
                            <!-- ============================================================== -->
                            <!-- Profile -->
                            <!-- ============================================================== -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/images/black-user.png" alt="user" class="profile-pic" /></a>
                                <div class="dropdown-menu dropdown-menu-right scale-up">
                                    <ul class="dropdown-user">
                                        <li>
                                            <div class="dw-user-box">
                                                <div class="u-img"><img src="/images/gold-user.png" alt="user"></div>
                                                <div class="u-text">
                                                    <h4>{{ Auth::user()->name }}</h4>
                                                    <p class="text-muted">{{ Auth::user()->email }}</p>
                                                    <a href="#" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                            </div>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                                        <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"><i class="fa fa-power-off" ></i> {{ __('Logout') }}</a>
                                        </li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- User profile -->
                    <div class="user-profile">
                        <!-- User profile image -->
                        <div class="profile-img"> <img src="/images/gold-user.png" alt="user" />
                            <!-- this is blinking heartbit-->
                            <!-- <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div> -->
                        </div>
                        <!-- User profile text-->
                        <div class="profile-text">
                            <h5>{{ Auth::user()->name }}</h5>
                            <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                            <a href="#" class="" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                            <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" 
                                        class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
                            <div class="dropdown-menu animated flipInY">
                                <!-- text-->
                                <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                                <!-- text-->
                                <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                <!-- text-->
                            </div>
                        </div>
                    </div>
                    <!-- End User profile text-->
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <li class="nav-devider"></li>
                            @foreach($_pages['pages'] as $pages)
                                
                                    <li class="" >
                                        <a href="{{$pages['url']}}" class="{{$pages['class']}}  waves-effect waves-dark" aria-expanded="false">
                                            <i class="{{$pages['icon']}}"></i>
                                            <span class="hide-menu">{{$pages['title']}}</span>
                                            @if($pages['has_sub'])
                                            @endif
                                        </a>
                                        @if($pages['has_sub'])
                                            <ul aria-expanded="false" class="collapse">
                                                @foreach($pages['sub'] as $sub)
                                                        <li class="{{$sub['status']}}">
                                                            <a href="{{$sub['url']}}">
                                                                <span class="pcoded-mtext" data-i18n="{{$sub['desc']}}">{{$sub['title']}}</span>
                                                            </a>
                                                        </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                            @endforeach
                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper">
                <main class="py-4">
                    <div class="row page-titles">
                        <div class="col-md-5 align-self-center">
                            <h3 class="text-themecolor">{{$_pages['active_title']}}</h3>
                        </div>
                        <div class="col-md-7 align-self-center">
                            <ol class="breadcrumb">
                                @foreach($_pages['active'] as $key => $crumbs)
                                    @php
                                        $active = $key == (count($_pages['active']) - 1) ? 'active' : '';
                                    @endphp
                                    @if($active == 'active')
                                    <li class="breadcrumb-item {{$active}}">
                                        {{$crumbs['active_title']}}
                                    </li>
                                    @else
                                    <li class="breadcrumb-item {{$active}}">
                                        <a href="{{$crumbs['active_url']}}">{{$crumbs['active_title']}}</a>
                                    </li>
                                    @endif
                                @endforeach
                            </ol>
                        </div>
                        
                    </div>
                    @yield('content')
                </main>
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="/dark/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="/dark/plugins/popper/popper.min.js"></script>
    <script src="/dark/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="/dark/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="/dark/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="/dark/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="/dark/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="/dark/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <script src="/dark/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--morris JavaScript -->
    <script src="/dark/plugins/raphael/raphael-min.js"></script>
    <script src="/dark/plugins/morrisjs/morris.min.js"></script>
    <!-- Chart JS -->
    <script src="/dark/js/dashboard1.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <!-- <script src="/dark/plugins/styleswitcher/jQuery.style.switcher.js"></script> -->
    <script src="/dark/plugins/toast-master/js/jquery.toast.js"></script>
    <script type="text/javascript" src="/js/global.js"></script>
    @yield('js')
</body>

</html>