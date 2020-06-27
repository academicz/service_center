@extends('Shop.Layouts.Master')
@section('title')
    Shop | Reports
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Reports</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li class="active">Reports</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reports</h3>
                    </div>
                    <!--No Label Form-->
                    <!--===================================================-->
                    <div class="panel-body">
                        <table class="table table-hover table-bordered table-striped product-table">
                            <tr>
                                <th>Total Service Requests</th>
                                <td>{{$requests->count()}}</td>
                                <th>Completed Requests</th>
                                <td>{{$requests->where('status',\App\Constants\Constants::$CLOSED_REQUEST)->count()}}</td>
                                <th>Now Working on</th>
                                <td>{{$requests->where('status',\App\Constants\Constants::$WORKING_ON_IT)->count()}} Devices</td>
                            </tr>
                            <tr>
                                <th>Total Billed Amount</th>
                                <td>Rs {{$bills->sum('total')}}</td>
                                <th>Total Payed Amount</th>
                                <td>Rs {{$bills->where('status',2)->sum('total')}}</td>
                                <th>Total Pending Amount</th>
                                <td>Rs {{$bills->where('status',1)->sum('total')}}</td>
                            </tr>
                            <tr>
                                <th>Total Amount To E2CARE</th>
                                <td>Rs {{$requests->where('status',\App\Constants\Constants::$CLOSED_REQUEST)->count()*50}} for {{$requests->where('status',\App\Constants\Constants::$CLOSED_REQUEST)->count()}} service through portal</td>
                            </tr>
                        </table>
                    </div>

                    <!--===================================================-->
                    <!--End No Label Form-->

                </div>
            </div>
        </div>


    </div>
    <!--End page content-->
@endsection