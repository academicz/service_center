@extends('User.Layouts.Master')
@section('contents')
    <div class="breadcrumb-area ptb-50">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
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
                <div class="col-sm-6">
                    <div class="well">
                        <div class="new-customer">
                            <h3>NEW CUSTOMER</h3>
                            <p class="mtb-10"><strong>Register</strong></p>
                            <p>By creating an account you will be able to service your device, be up to date on an order's
                                status, and keep track of the orders you have previously made</p>
                            <a class="customer-btn" href="{{route('register')}}">continue</a>
                        </div>
                    </div>
                </div>
                <!-- New Customer End -->
                <!-- Returning Customer Start -->
                <div class="col-sm-6">
                    <div class="well">
                        <div class="return-customer">
                            <h3 class="mb-10">RETURNING CUSTOMER</h3>
                            <p class="mb-10"><strong>I am a returning customer</strong></p>
                            @include('Admin.Includes.msgBox')
                            <form action="{{ route('postLogin') }}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="control-label">Enter you email address here...</label>
                                    <input type="text" name="email" placeholder="Enter you email address here..."
                                           id="input-email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input type="password" name="password" placeholder="Password" id="input-password"
                                           class="form-control">
                                </div>
                                <input type="submit" value="Login" class="return-customer-btn">
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