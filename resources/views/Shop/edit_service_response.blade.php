@extends('Shop.Layouts.Master')
@section('title')
    Shop | Service Response
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow text-capitalize">Edit Service Response</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('shopHome') }}">Home</a></li>
        <li>
            <a href="{{ route('serviceRequest',['id'=>$response->service_request->id]) }}">{{ $response->service_request->company_name.' '.$response->service_request->model.' ('.$response->service_request->product_name.'), '.$response->service_request->issue }}</a>
        </li>
        <li class="active">Service Response</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-12" id="newProduct">

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Service Response Details</h3>
                    </div>

                    <!--No Label Form-->
                    <!--===================================================-->
                    <form method="post" action="{{route('editServiceResponse')}}">
                        <div class="panel-body">
                            @include('Admin.Includes.msgBox')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pickUpdate">Pickup Date</label>
                                        <input value="{{ old('pickUpdate',$response->pickup_date) }}" type="date" name="pickUpdate"
                                               id="pickUpdate" class="form-control"/>
                                        <small class="text-danger">{{ $errors->first('pickUpdate') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pickUpTime">Pickup Time</label>
                                        <input value="{{old('pickUpTime',$response->pickup_time)}}" type="time" name="pickUpTime"
                                               id="pickUpTime"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('pickUpTime') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pickUpAddress">Pickup Address</label>
                                        <input value="{{old('pickUpAddress',$response->pickup_address)}}" type="text" name="pickUpAddress"
                                               id="pickUpAddress"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('pickUpAddress') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pickUpLocation">Pickup Location</label>
                                        <input value="{{old('pickUpLocation',$response->pickup_location)}}" type="text" name="pickUpLocation"
                                               id="pickUpLocation"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('pickUpLocation') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="advanceAmount">Advance Amount</label>
                                        <input value="{{ old('advanceAmount',$response->advance_amount) }}" type="text" name="advanceAmount"
                                               id="advanceAmount"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('advanceAmount') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="expectedReturnDate">Expected Return Date</label>
                                        <input id="expectedReturnDate" value="{{ old('expectedReturnDate',$response->expected_return_date) }}"
                                               type="date" name="expectedReturnDate"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('expectedReturnDate') }}</small>
                                        <input type="hidden" name="requestId" value="{{$response->service_request->id}}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer text-right">
                            <button class="btn btn-primary">Update Service Response</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}"/>
                    </form>
                    <!--===================================================-->
                    <!--End No Label Form-->
                </div>
            </div>
        </div>


    </div>
    <!--End page content-->
@endsection

@section('scripts')
@endsection