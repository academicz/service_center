@extends('User.Layouts.Master')
@section('contents')
    <div class="breadcrumb-area ptb-50">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active">Search</li>
                    <li class="active">{{$key}}</li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <div class="log-in pb-50">
        <div class="container">
            <div class="row">
                <!-- New Customer Start -->
                <div class="col-sm-12">
                    {{--<div class="well">--}}
                    {{--<div class="return-customer">--}}
                    {{--<h3 class="mb-10">RETURNING CUSTOMER</h3>--}}
                    {{--<p class="mb-10"><strong>I am a returning customer</strong></p>--}}
                    {{--@include('Admin.Includes.msgBox')--}}
                    {{--<form action="{{ route('postLogin') }}" method="post">--}}
                    {{--{{csrf_field()}}--}}
                    {{--<div class="form-group">--}}
                    {{--<label class="control-label">Enter you email address here...</label>--}}
                    {{--<input type="text" name="email" placeholder="Enter you email address here..."--}}
                    {{--id="input-email" class="form-control">--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                    {{--<label class="control-label">Password</label>--}}
                    {{--<input type="password" name="password" placeholder="Password" id="input-password"--}}
                    {{--class="form-control">--}}
                    {{--</div>--}}
                    {{--<input type="submit" value="Login" class="return-customer-btn">--}}
                    {{--</form>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    @foreach ($serviceCenters as $serviceCenter)
                        <div class="well">
                            <div class="single-product mb-20" style="border-bottom: 1px dashed #ccc">
                                <div class="row">
                                    <div class="col-md-4 col-sm-5 col-xs-4">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="{{route('getServiceCenter',['id'=>$serviceCenter->id])}}">
                                                <img src="{{ privateAsset($serviceCenter->shop_images->first()->image_path) }}"
                                                     alt="single-product">
                                            </a>
                                        </div>
                                        <!-- Product Image End -->
                                    </div>
                                    <div class="col-md-8 col-sm-7 col-xs-8">
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <h3>
                                                <a href="{{route('getServiceCenter',['id'=>$serviceCenter->id])}}">{{$serviceCenter->name}}</a>
                                            </h3>
                                            {{--<div class="product-rating">--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star"></i>--}}
                                            {{--<i class="fa fa-star-o"></i>--}}
                                            {{--<i class="fa fa-star-o"></i>--}}
                                            {{--</div>--}}
                                            <p>
                                                <span class="price">{{ $serviceCenter->address.', '.$serviceCenter->place }}</span>
                                            </p>
                                            <p>{{$serviceCenter->description}}</p>
                                            <div class="home-2-pro-actions">
                                                <div class="actions-primary">
                                                    <a href="{{route('getRequestService',['id'=>$serviceCenter->id])}}"
                                                       data-toggle="tooltip" title="Request Service">Request Service</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Returning Customer End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
@stop