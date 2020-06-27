@extends('Admin.Layouts.Master')
@section('title')
    Admin | Service Center
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Service Center</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li class="active">Service Center</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-control">

                        </div>
                        <h3 class="panel-title">Service Center Details</h3>
                    </div>
                    <!--No Label Form-->
                    <!--===================================================-->
                    <div class="panel-body">
                        @include('Admin.Includes.msgBox')
                        <table class="table table-hover table-bordered table-striped product-table text-capitalize">
                            <tr>
                                <th class="col-md-2">Name</th>
                                <td class="col-md-4">
                                    {{$center->name}}
                                </td>
                                <th class="col-md-2">Shop Type</th>
                                <td class="col-md-4">{{$center->shop_type->shop_type}}</td>
                            </tr>
                            <tr>
                                <th class="col-md-2">Place</th>
                                <td class="col-md-4">
                                    {{$center->place}}
                                </td>
                                <th class="col-md-2">Address</th>
                                <td class="col-md-4">{{$center->address}}</td>
                            </tr>
                            <tr>
                                <th class="col-md-2">Phone</th>
                                <td class="col-md-4">{{ $center->phone }}</td>
                                <th class="col-md-2">Email</th>
                                <td class="col-md-4">{{ $center->email }}</td>
                            </tr>
                            <tr>
                                <th class="col-md-2">Pin Code</th>
                                <td class="col-md-4">{{ $center->pin_code }}</td>
                                <td colspan="2" class="col-md-6">
                                    @if ($center->status==App\Constants\Constants::$NEW_CENTER)
                                        <a href="{{route('centerStatus',['id'=>$center->id])}}">
                                            <button class="btn btn-success">Approve Registration</button>
                                        </a>
                                    @elseif($center->status==App\Constants\Constants::$APPROVED_CENTER)
                                        <a href="{{route('centerStatus',['id'=>$center->id])}}">
                                            <button class="btn btn-danger">Suspend Shop</button>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <h4>Reports</h4>
                        <table class="table table-hover table-bordered table-striped product-table text-capitalize">
                            <tr>
                                <th class="col-md-2">All Service Request</th>
                                <td class="col-md-4">
                                    {{$center->service_request->count()}}
                                </td>
                                <th class="col-md-2">Completed Services</th>
                                <td class="col-md-4">{{$center->service_request->where('status',\App\Constants\Constants::$CLOSED_REQUEST)->count()}}</td>
                            </tr>
                            <tr>
                                <th class="col-md-2">Total Fees</th>
                                <td class="col-md-4">
                                   Rs {{$center->service_request->where('status',\App\Constants\Constants::$CLOSED_REQUEST)->count()*50}}
                                </td>
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