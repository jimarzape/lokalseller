@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="m-b-0"><i class="mdi mdi-package-variant-closed text-info"></i></h2>
                        <h3 class="">{{number_format($new)}}</h3>
                        <h6 class="card-subtitle">New Orders</h6></div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="m-b-0"><i class="mdi mdi-truck text-success"></i></h2>
                        <h3 class="">{{number_format($toship)}}</h3>
                        <h6 class="card-subtitle">To Ships</h6></div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 40%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="m-b-0"><i class="mdi mdi-cart text-purple"></i></h2>
                        <h3 class="">{{number_format($success)}}</h3>
                        <h6 class="card-subtitle">Total Success Orders</h6></div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 56%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h2 class="m-b-0"><i class="mdi mdi-buffer text-warning"></i></h2>
                        <h3 class="">₱&nbsp;{{number_format($net, 2)}}</h3>
                        <h6 class="card-subtitle">Total Earnings</h6></div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-8 col-xlg-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex flex-wrap">
                                <div>
                                    <h4 class="card-title">Yearly Earning</h4>
                                </div>
                                <div class="ml-auto">
                                    <ul class="list-inline">
                                        <li>
                                            <h6 class="text-muted text-success"><i class="fa fa-circle font-10 m-r-10 "></i>Sales</h6> </li>
                                        <li>
                                            <h6 class="text-muted  text-info"><i class="fa fa-circle font-10 m-r-10"></i>Earning ($)</h6> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div id="earning" style="height: 355px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-lg-4 col-xlg-3">
            <div class="card card-inverse card-info">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="m-r-20 align-self-center">
                            <h1 class="text-white"><i class="ti-light-bulb"></i></h1></div>
                        <div>
                            <h3 class="card-title">Sales Analytics</h3>
                            <h6 class="card-subtitle">{{date('F Y')}}</h6> </div>
                    </div>
                    <div class="row">
                        <div class="col-6 align-self-center">
                            <h2 class="font-light text-white"><sup><small><i class="ti-arrow-up"></i></small></sup>{{number_format($monthly, 2)}}</h2>
                        </div>
                        <div class="col-6 p-t-10 p-b-20 text-right">
                            <div class="spark-count" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-inverse card-success">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="m-r-20 align-self-center">
                            <h1 class="text-white"><i class="mdi mdi-package-variant"></i></h1></div>
                        <div>
                            <h3 class="card-title">Total Products</h3>
                            <h6 class="card-subtitle">Total brands {{number_format($brands)}}</h6> </div>
                    </div>
                    <div class="row">
                        <div class="col-6 align-self-center">
                            <h2 class="font-light text-white">{{number_format($products)}}</h2>
                        </div>
                        <div class="col-6 p-t-10 p-b-20 text-right align-self-center">
                            <div class="spark-count2" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
    <!-- Row -->
    <!-- Row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex no-block">
                        <h4 class="card-title">Top 10 Products</h4>
                        <div class="ml-auto">
                            <span>{{date('F Y')}}</span>
                        </div>
                    </div>
                    <h6 class="card-subtitle">Most sold products of the month</h6>
                </div>
               
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover earning-box">
                          
                            <tbody>
                                @foreach($_top as $top)
                                <tr>
                                    <td style="width:50px;"><span class="round" style='background-image: url("{{$top->product_image}}"); background-size:contain'></span></td>
                                    <td>
                                        <h6>{{$top->product_name}}</h6><small class="text-muted">{{$top->brand_name}}</small></td>
                                    <td class="text-gold text-right">{{number_format($top->total_sold)}}</td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <!-- Column -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Recent Orders</h4>
                    <h6 class="card-subtitle">Latest orders</h6> 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover earning-box text-gold">
                            @foreach($_orders as $orders)
                            <tr>
                                <td>
                                    <h6><a href="{{route('orders.view',Crypt::encrypt($orders->seller_order_id))}}">{{$orders->order_number}}</a></h6>
                                    <small class="text-muted">{{$orders->status_name}}</small></td>
                                </td>
                                <td class="text-right">
                                    {{number_format($orders->seller_total, 2)}}
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Column -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <div class="right-sidebar">
        <div class="slimscrollright">
            <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
            <div class="r-panel-body">
                <ul id="themecolors" class="m-t-20">
                    <li><b>With Light sidebar</b></li>
                    <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                    <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                    <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                    <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
                    <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                    <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                    <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                    <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                    <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                    <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                    <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme working">10</a></li>
                    <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                    <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme">12</a></li>
                </ul>
                <ul class="m-t-20 chatonline">
                    <li><b>Chat option</b></li>
                    <li>
                        <a href="javascript:void(0)"><img src="/dark/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/dark/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/dark/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/dark/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/dark/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/dark/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/dark/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0)"><img src="/dark/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
@endsection
