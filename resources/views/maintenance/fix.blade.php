<!DOCTYPE html>
<html>
<head>
	<title></title>
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
    <!-- <link href="/dark/css/style.css" rel="stylesheet"> -->
    <!-- You can change the theme colors from here -->
    <!-- <link href="/dark/css/colors/blue-dark.css" id="theme" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="/css/custom.css?{{time()}}">
    <link href="/dark/plugins/toast-master/css/jquery.toast.css" rel="stylesheet">
</head>
<body class="fix-header fix-sidebar card-no-border">
    <div id="main-wrapper">
        <div class="page-wrapper" style="margin-top:1em">
        	<div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary btn-check-order btn-block" data-url="{{route('check.fix.order')}}">Check Unresolved Order</button>
                            </div>
                            <div class="card-body checker-container">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body form-body">
                                <form class="form-submit row" action="{{route('check.order.number')}}" method="POST">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Input Order Number here</label>
                                            <input type="text" class="form-control" name="order_number" required>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-submit btn-block" type="submit">Check</button>
                                        </div>
                                    </div>
                                   
                                </form>
                                <div class="card">
                                    <div class="card-body submit-result"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Fix Order here</h4>
                            </div>
                            <div class="card-body">
                                <form class="form-submit row" action="{{route('check.order.fix')}}" method="POST">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Order Number Here</label>
                                            <input type="text" class="form-control" name="order_number" required>
                                        </div>
                                        <div class="form-group">
                                             <button class="btn btn-primary btn-submit btn-block" type="submit">Check</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="card">
                                    <div class="card-body submit-result"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
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
    <script type="text/javascript" src="/js/fix-order.js?{{time()}}"></script>
</html>