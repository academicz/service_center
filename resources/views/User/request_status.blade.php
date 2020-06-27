@extends('User.Layouts.Master')
@section('contents')
    <div class="breadcrumb-area ptb-50">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('myAccount') }}">My Account</a></li>
                    <li class="active">Request Status</li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <div class="log-in pb-50">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="well">
                        <div class="return-customer">
                            <h3 class="mb-10">Service Status</h3>
                            <p class="mb-10"><strong>Service Request</strong></p>
                            @include('Admin.Includes.msgBox')
                            <table class="table table-bordered table-hover">
                                <tbody>
                                <tr>
                                    <th class="bg-success">
                                        Product
                                    </th>
                                    <td class="bg-danger">
                                        {{$serviceRequest->product_name}}
                                    </td>
                                    <th class="bg-success">
                                        Model
                                    </th>
                                    <td class="bg-danger">
                                        {{$serviceRequest->company_name.' '.$serviceRequest->model}}
                                    </td>
                                    <th class="bg-success">
                                        Status
                                    </th>
                                    <td class="bg-danger">
                                        @if ($serviceRequest->status==1)
                                            Unapproved
                                        @elseif($serviceRequest->status==2)
                                            Approved By shop
                                        @elseif($serviceRequest->status==8)
                                            Rejected By shop
                                        @elseif($serviceRequest->status==4)
                                            Work in progress
                                        @elseif($serviceRequest->status==6)
                                            Working Completed And Bill Available
                                        @elseif($serviceRequest->status==7)
                                            Return Info Available
                                        @elseif($serviceRequest->status==5)
                                            Picked Up
                                        @elseif($serviceRequest->status==3)
                                            Service Request Clossed
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="bg-success">
                                        Issue
                                    </th>
                                    <td class="bg-danger">
                                        {{$serviceRequest->issue}}
                                    </td>
                                    <th class="bg-success">
                                        Time of request
                                    </th>
                                    <td class="bg-danger">
                                        {{formattedDate($serviceRequest->created_at).' '.formattedTime($serviceRequest->created_at)}}
                                    </td>
                                    <td colspan="2" class="bg-danger">
                                        @if ($serviceRequest->bill)
                                            <a href="{{route('viewUserBill',['id'=>$serviceRequest->id])}}">View Bill
                                                @if ($serviceRequest->bill->status==1)
                                                    ( Bill Not Payed )
                                                @else
                                               ( Bill Payed)
                                                @endif
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            @if ($serviceRequest->service_response)
                                <p class="mb-10"><strong>Service Response</strong></p>
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                    <tr>
                                        <th class="bg-success">
                                            Pickup Date
                                        </th>
                                        <td class="bg-danger">
                                            {{$serviceRequest->service_response->pickup_date}}
                                        </td>
                                        <th class="bg-success">
                                            Pickup Time
                                        </th>
                                        <td class="bg-danger">
                                            {{$serviceRequest->service_response->pickup_time}}
                                        </td>
                                        <th class="bg-success">
                                            Pickup Address
                                        </th>
                                        <td class="bg-danger">
                                            {{$serviceRequest->service_response->pickup_address}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-success">
                                            Pickup Location
                                        </th>
                                        <td class="bg-danger">
                                            {{$serviceRequest->service_response->pickup_location}}
                                        </td>
                                        <th class="bg-success">
                                            Advance Amount
                                        </th>
                                        <td class="bg-danger">
                                            {{$serviceRequest->service_response->advance_amount}}
                                        </td>
                                        <th class="bg-success">
                                            Expected Return Date
                                        </th>
                                        <td class="bg-danger">
                                            {{$serviceRequest->service_response->expected_return_date}}
                                        </td>

                                    </tr>

                                    </tbody>
                                </table>
                            @endif
                            @if ($serviceRequest->return_info)
                                <table
                                    class="table table-hover table-bordered table-striped product-table text-capitalize">
                                    <tr>
                                        <th colspan="4">Return Info</th>
                                    </tr>
                                    <tr>
                                        <th class="col-md-2">Return Date</th>
                                        <td class="col-md-4">
                                            {{ date('d-m-Y',strtotime($serviceRequest->return_info->return_date))}}
                                        </td>
                                        <th class="col-md-2">Return Time</th>
                                        <td class="col-md-4">  {{date('h:i A',strtotime($serviceRequest->return_info->return_time))}}</td>
                                    </tr>
                                    <tr>
                                        <th class="col-md-2">Return Address</th>
                                        <td class="col-md-4">
                                            {{$serviceRequest->return_info->return_address}}
                                        </td>
                                        <th class="col-md-2">Pickup Location</th>
                                        <td class="col-md-4">  {{$serviceRequest->return_info->return_location}}</td>
                                    </tr>
                                </table>
                            @endif
                            <h4 style="margin:0">Feedback</h4>
                            @if ($serviceRequest->status==3 && !$serviceRequest->service_feedback)

                                <form action="{{route('addFeedback')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Title" name="title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="Description" name="description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="serviceId" value="{{$serviceRequest->id}}" >
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                @elseif($serviceRequest->service_feedback)
                                <div>
                                    <strong>
                                        {{$serviceRequest->service_feedback->title}}
                                    </strong>
                                </div>
                                <div>
                                    {{$serviceRequest->service_feedback->description}}
                                </div>
                            @endif


                            <h4 style="margin:0">Service Request Images</h4>
                            <br>
                            @foreach($serviceRequest->service_request_images as $image)
                                <a target="_blank" href="{{privateAsset($image->image_path)}}">
                                    <img style="width: 20%" src="{{privateAsset($image->image_path)}}" alt="">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Returning Customer End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
@stop
