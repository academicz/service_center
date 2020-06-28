@extends('Shop.Layouts.Master')
@section('title')
    Shop | Service Request
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Service Request</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('shopHome') }}">Home</a></li>
        <li class="active">Service Request</li>
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
                        <h3 class="panel-title">Service Request Details</h3>
                    </div>
                    <!--No Label Form-->
                    <!--===================================================-->
                    <div class="panel-body">
                        @include('Admin.Includes.msgBox')
                        <table class="table table-hover table-bordered table-striped product-table text-capitalize">
                            <tr>
                                <th class="col-md-2">Customer Name</th>
                                <td class="col-md-4">
                                    {{$request->registration->name}}
                                </td>
                                <th class="col-md-2">Customer Phone</th>
                                <td class="col-md-4">  {{$request->registration->phone}}</td>
                            </tr>
                            <tr>
                                <th class="col-md-2">Address</th>
                                <td class="col-md-4">
                                    {{$request->registration->address}}
                                </td>
                                <th class="col-md-2">Product</th>
                                <td class="col-md-4">
                                    {{ $request->company_name.' '.$request->model.' ('.$request->product_name.')' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="col-md-2">Issue</th>
                                <td class="col-md-4">{{$request->issue}}</td>
                                <td colspan="2" class="col-md-6">
                                    @if ($request->status==App\Constants\Constants::$UNAPPROVED_REQUEST)
                                        <a href="{{route('acceptServiceRequestPage',['id'=>$request->id])}}">
                                            <button class="btn btn-success">Accept Request</button>
                                        </a>
                                        <a href="{{route('changeRequestStatus',['id'=>$request->id,'status'=>\App\Constants\Constants::$REJECTED_REQUEST])}}">
                                            <button class="btn btn-danger">Reject Request</button>
                                        </a>
                                    @elseif ($request->status==App\Constants\Constants::$REJECTED_REQUEST)
                                        Rejected
                                    @endif
                                    @if ($request->bill)
                                        <strong> {{$request->bill->status==1?'Not Payed':'Payment Completed'}}</strong>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        @if ($request->service_response)
                            <hr>
                            <table class="table table-hover table-bordered table-striped product-table text-capitalize">
                                <tr>
                                    <th colspan="4">Response Details</th>
                                </tr>
                                <tr>
                                    <th class="col-md-2">Pickup Date</th>
                                    <td class="col-md-4">
                                        {{ date('d-m-Y',strtotime($request->service_response->pickup_date))}}
                                    </td>
                                    <th class="col-md-2">Pickup Time</th>
                                    <td class="col-md-4">  {{date('h:i A',strtotime($request->service_response->pickup_time))}}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">Pickup Address</th>
                                    <td class="col-md-4">
                                        {{$request->service_response->pickup_address}}
                                    </td>
                                    <th class="col-md-2">Pickup Location</th>
                                    <td class="col-md-4">  {{$request->service_response->pickup_location}}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">Advance Amount</th>
                                    <td class="col-md-4">
                                    {{$request->service_response->advance_amount}}
                                    <th class="col-md-2">Expected Return Rate</th>
                                    <td class="col-md-4">  {{date('d-m-Y',strtotime($request->service_response->expected_return_date))}}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        @if($request->status==App\Constants\Constants::$APPROVED_REQUEST)
                                            <a href="{{route('getEditServiceResponse',['id'=>$request->id])}}">
                                                <button class="btn btn-info">Edit Response</button>
                                            </a>
                                            <a href="{{route('changeRequestStatus',['id'=>$request->id,'status'=>\App\Constants\Constants::$PICKED_UP])}}">
                                                <button class="btn btn-primary">Mark Pickup</button>
                                            </a>
                                        @elseif($request->status==App\Constants\Constants::$WORKING_ON_IT)
                                            <a href="{{route('generateBill',['id'=>$request->id])}}">
                                                <button class="btn btn-warning">Generate Bill</button>
                                            </a>
                                        @elseif($request->status==App\Constants\Constants::$BILL_GENERATED)
                                            <a href="{{route('viewBill',['id'=>$request->id])}}">
                                                <button class="btn btn-success">View Bill</button>
                                            </a>
                                            <a href="{{route('closeServiceEntry',['id'=>$request->id])}}">
                                                <button class="btn btn-danger">Close Entry</button>
                                            </a>
                                        @elseif($request->status==App\Constants\Constants::$RETURN_INFORMED)
                                            <a href="{{route('changeRequestStatus',['id'=>$request->id,'status'=>\App\Constants\Constants::$CLOSED_REQUEST])}}">
                                                <button class="btn btn-danger">Mark Delivery</button>
                                            </a>
                                            <a href="{{route('viewBill',['id'=>$request->id])}}">
                                                <button class="btn btn-success">View Bill</button>
                                            </a>
                                        @elseif($request->status==App\Constants\Constants::$PICKED_UP)
                                            <a href="{{route('changeRequestStatus',['id'=>$request->id,'status'=>\App\Constants\Constants::$WORKING_ON_IT])}}">
                                                <button class="btn btn-warning">Start Work</button>
                                            </a>
                                        @elseif($request->status==App\Constants\Constants::$CLOSED_REQUEST)
                                            Request Closed on {{date('d-m-Y h:i A',strtotime($request->updated_at))}}
                                            <a href="{{route('viewBill',['id'=>$request->id])}}">
                                                <button class="btn btn-success">View Bill</button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @if($request->status==App\Constants\Constants::$CLOSED_REQUEST && $request->service_feedback->replay!='' )
                                    <tr>
                                        <td colspan="4">
                                            <div class="form-group">
                                            <strong>Feedback</strong>  {{$request->service_feedback->title}}:{{$request->service_feedback->description}}
                                            </div>

                                                @if($request->service_feedback->replay=='0')
                                                <form action="{{route('addServiceReplay')}}" method="post">
                                                    {{csrf_field()}}
                                                    <div class="form-group">
                                                        <textarea placeholder="Feedback Replay" type="text" name="replay" class="form-control"></textarea>
                                                    </div>
                                                    <input type="hidden" name="id" value="{{$request->service_feedback->id}}">
                                                    <div class="form-group">
                                                    <button class="btn btn-success">Add Feedback Replay</button>
                                                    </div>
                                                </form>
                                                    @else
                                                    <strong>Replay</strong>: {{$request->service_feedback->replay}}
                                            @endif

                                        </td>
                                    </tr>
                                @endif
                            </table>
                        @endif
                        @if ($request->return_info)
                            <hr>
                            <table class="table table-hover table-bordered table-striped product-table text-capitalize">
                                <tr>
                                    <th colspan="4">Return Info</th>
                                </tr>
                                <tr>
                                    <th class="col-md-2">Return Date</th>
                                    <td class="col-md-4">
                                        {{ date('d-m-Y',strtotime($request->return_info->return_date))}}
                                    </td>
                                    <th class="col-md-2">Return Time</th>
                                    <td class="col-md-4">  {{date('h:i A',strtotime($request->return_info->return_time))}}</td>
                                </tr>
                                <tr>
                                    <th class="col-md-2">Return Address</th>
                                    <td class="col-md-4">
                                        {{$request->return_info->return_address}}
                                    </td>
                                    <th class="col-md-2">Pickup Location</th>
                                    <td class="col-md-4">  {{$request->return_info->return_location}}</td>
                                </tr>
                            </table>
                        @endif
                        <hr>
                        <div class="col-sm-12">
                            <h4 style="margin:0">Service Request Images</h4>
                            @foreach($request->service_request_images as $image)
                                <a target="_blank" href="{{privateAsset($image->image_path)}}">
                                    <img style="width: 20%" src="{{privateAsset($image->image_path)}}" alt="">
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!--===================================================-->
                    <!--End No Label Form-->
                </div>
            </div>
        </div>
    </div>
    <!--End page content-->
@endsection
