@extends('User.Layouts.Master')
@section('contents')
    <div class="breadcrumb-area ptb-50">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('myAccount') }}">My Account</a></li>
                    <li><a href="{{ route('requestStatus',['id'=>$serviceRequest->id]) }}">Service</a></li>
                    <li class="active">Login</li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <div class="log-in pb-50">
        <div class="container">
            <div class="row">
                <!-- New Customer Start -->
                <!-- Returning Customer Start -->
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="well">
                        <div class="return-customer">
                            <h3 class="mb-10">Payment Details</h3>
                            @include('Admin.Includes.msgBox')
                            <form action="{{ route('postPayment') }}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="control-label">Card Number</label>
                                    <input value="{{ old('cardNumber') }}"  type="text" name="cardNumber"
                                           id="input-email" class="form-control">
                                    <small class="text-danger">{{ $errors->first('cardNumber') }}</small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Name On Card</label>
                                    <input value="{{ old('name') }}"  type="text" name="name" id="input-password"
                                           class="form-control">
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">CVV</label>
                                    <input value="{{ old('cvv') }}"  type="text" name="cvv" id="input-password"
                                           class="form-control">
                                    <small class="text-danger">{{ $errors->first('cvv') }}</small>
                                </div>
                                <input type="hidden" name="request" value="{{ $serviceRequest->id }}">
                                <input type="submit" value="Pay" class="return-customer-btn">
                            </form>
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