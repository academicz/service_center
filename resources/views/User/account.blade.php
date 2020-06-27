@extends('User.Layouts.Master')
@section('title')
    My Account
@stop
@section('contents')

    <div class="breadcrumb-area ptb-50">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active"><a href="#">My Account</a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->
    <!-- My Account Page Start Here -->
    <div class="my-account white-bg pb-50">
        <div class="container">
            <div class="account-dashboard">
                <div class="dashboard-upper-info">
                    <div class="row no-gutters align-items-center">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="d-single-info">
                                <p class="user-name">Hello <span>{{user()->name}}</span></p>
                                <p>(not {{user()->name}} <a href="{{route('logout')}}">Log Out</a>)</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="d-single-info">
                                <p>Need Assistance? Customer service at.</p>
                                <p>admin@example.com.</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="d-single-info">
                                <p>E-mail them at </p>
                                <p>support@example.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <!-- Nav tabs -->
                        <ul class="nav flex-column dashboard-list" role="tablist">
                            <li class="active"><a data-toggle="tab" href="#dashboard">Dashboard</a></li>
                            <li><a data-toggle="tab" href="#orders">Services</a></li>
                            <li><a data-toggle="tab" href="#address">Account Details</a></li>
                            <li><a href="{{route('logout')}}" href="#logout">logout</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-10 col-md-10">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard-content mt-all-40">
                            <div id="dashboard" class="tab-pane fade in active">
                                <h3>Dashboard </h3>
                                <p>From your account dashboard. you can easily check & view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a></p>
                            </div>
                            <div id="orders" class="tab-pane fade">
                                <h3>Service Requests</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Sl.no</th>
                                            <th>Product</th>
                                            <th>Model</th>
                                            <th>Issue</th>
                                            <th>Date of request</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($serviceRequests as $serviceRequest)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$serviceRequest->product_name}}</td>
                                                <td>{{$serviceRequest->company_name.' '.$serviceRequest->model}}</td>
                                                <td>{{$serviceRequest->issue}}</td>
                                                <td>{{formattedDate($serviceRequest->created_at).' '.formattedTime($serviceRequest->created_at)}}</td>
                                                <td><a class="view" href="{{route('requestStatus',['id'=>$serviceRequest->id])}}">view</a></td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="address" class="tab-pane">
                                <h4 class="billing-address">Account Details</h4>
                                <p>Name: {{user()->name}}</p>
                                <p>Address: {{user()->address.', '.user()->address}}</p>
                                <p>Phone: {{user()->phone}}</p>
                                <p>Email: {{user()->email}}</p>
                                <p>Pincode: {{user()->pin_code}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop