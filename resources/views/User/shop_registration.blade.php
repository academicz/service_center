@extends('User.Layouts.Master')
@section('title')
    Register Shop
@stop
@section('contents')
    <div class="breadcrumb-area ptb-50">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="active">Register Shop</li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->
    <!-- Register Account Start -->
    <div class="register-account pb-50">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="register-title">
                        <h3 class="mb-10">REGISTER YOUR SHOP</h3>
                        <p class="mb-10">If you already have an account with us, please login at the login page.</p>
                    </div>
                </div>
            </div>
            <!-- Row End -->
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <form class="form-horizontal" action="{{route('postShopRegister')}}" enctype="multipart/form-data"
                          method="post">
                        <fieldset>
                            <legend>Shop Details</legend>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="shopName"><span
                                            class="require">*</span>Shop Name</label>
                                <div class="col-sm-9">
                                    <input value="{{ old('shopName') }}" name="shopName" type="text"
                                           class="form-control" id="shopName"
                                           placeholder="Shop Name">
                                    <small class="text-danger">{{ $errors->first('shopName') }}</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="shopType"><span
                                            class="require">*</span>Shop Type</label>
                                <div class="col-sm-9">
                                    <select name="shopType" class="form-control" id="shopType">
                                        <option value="">Select Shop Type</option>
                                        @foreach($shopTypes as $shopType)
                                            <option value="{{$shopType->id}}">{{$shopType->shop_type}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{ $errors->first('shopType') }}</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="l-name"><span class="require">*</span>Address</label>
                                <div class="col-sm-9">
                                    <input value="{{ old('address') }}" type="text" class="form-control" id="l-name"
                                           placeholder="Address"
                                           name="address">
                                    <small class="text-danger">{{ $errors->first('address') }}</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="number"><span
                                            class="require">*</span>Phone</label>
                                <div class="col-sm-9">
                                    <input value="{{ old('phone') }}" type="text" class="form-control" id="number"
                                           placeholder="Phone"
                                           name="phone">
                                    <small class="text-danger">{{ $errors->first('phone') }}</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email"><span
                                            class="require">*</span>Email</label>
                                <div class="col-sm-9">
                                    <input value="{{ old('email') }}" type="email" class="form-control" name="email"
                                           id="email"
                                           placeholder="Email">
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email"><span
                                            class="require">*</span>Place</label>
                                <div class="col-sm-9">
                                    <input value="{{ old('place') }}" type="text" class="form-control" name="place"
                                           id="email"
                                           placeholder="Place">
                                    <small class="text-danger">{{ $errors->first('place') }}</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email"><span
                                            class="require">*</span>Pin Code</label>
                                <div class="col-sm-9">
                                    <input value="{{ old('pinCode') }}" type="text" class="form-control" name="pinCode"
                                           id="email"
                                           placeholder="Pin code">
                                    <small class="text-danger">{{ $errors->first('pinCode') }}</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="shopImage"><span
                                            class="require">*</span>Shop Images</label>
                                <div class="col-sm-9">
                                    <input accept="image/*" type="file" multiple class="form-control" name="shopImage[]"
                                           id="shopImage">
                                    <small class="text-danger">{{ $errors->first('shopImage') }}</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="description"><span
                                            class="require">*</span>Description</label>
                                <div class="col-sm-9">
                                    <textarea type="file" class="form-control" name="description"
                                              id="description">
                                    </textarea>
                                    <small class="text-danger">{{ $errors->first('shopImage') }}</small>
                                </div>
                            </div>

                        </fieldset>
                        <fieldset>
                            <legend>Your Password</legend>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="pwd"><span class="require">*</span>Password:</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password" id="pwd"
                                           placeholder="Password">
                                    <small class="text-danger">{{ $errors->first('password') }}</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="pwd-confirm"><span class="require">*</span>Confirm
                                    Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="pwd-confirm"
                                           placeholder="Confirm password" name="confirmPassword">
                                    <small class="text-danger">{{ $errors->first('confirmPassword') }}</small>
                                </div>
                            </div>
                        </fieldset>
                        <div class="buttons newsletter-input">
                            <div class="pull-right">
                                <input type="submit" value="Continue" class="newsletter-btn">
                            </div>
                        </div>
                        {{csrf_field()}}
                    </form>
                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
@stop