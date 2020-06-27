@extends('Shop.Layouts.Master')
@section('title')
    Shop | Return Product
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow text-capitalize">Service Response</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('shopHome') }}">Home</a></li>
        <li>
            <a href="{{ route('serviceRequest',['id'=>$request->id]) }}">{{ $request->company_name.' '.$request->model.' ('.$request->product_name.'), '.$request->issue }}</a>
        </li>
        <li class="active">Return Product</li>
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
                    <form method="post" action="{{route('postEntry')}}">
                        <div class="panel-body">
                            @include('Admin.Includes.msgBox')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="returnDate">Return Date</label>
                                        <input value="{{ old('returnDate') }}" type="date" name="returnDate"
                                               id="returnDate" class="form-control"/>
                                        <small class="text-danger">{{ $errors->first('returnDate') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="returnTime">Return Time</label>
                                        <input value="{{old('returnTime')}}" type="time" name="returnTime"
                                               id="returnTime"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('returnTime') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="returnAddress">Return Address</label>
                                        <input value="{{old('returnAddress')}}" type="text" name="returnAddress"
                                               id="returnAddress"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('returnAddress') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="returnLocation">Pickup Location</label>
                                        <input value="{{old('returnLocation')}}" type="text" name="returnLocation"
                                               id="returnLocation"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('returnLocation') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="returnLocation">Status</label>
                                        <input value="{{old('status')}}" type="text" name="status"
                                               id="status"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('status') }}</small>
                                    </div>
                                    <input value="{{$request->id}}" type="hidden" name="requestId">
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer text-right">
                            <button class="btn btn-primary">Submit Service Response</button>
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