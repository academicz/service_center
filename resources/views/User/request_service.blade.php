@extends('User.Layouts.Master')
@section('contents')
    <div class="breadcrumb-area ptb-50">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>
                        <a href="{{ route('getServiceCenter',['id'=>$serviceCenter->id]) }}">{{ $serviceCenter->name }}</a>
                    </li>
                    <li class="active">Request Service</li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <div class="log-in pb-50">
        <div class="container">
            <div class="row">
                <!-- Returning Customer Start -->
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="well">
                        <div class="return-customer">
                            <h3 class="mb-10">Request Service</h3>
                            @include('Admin.Includes.msgBox')
                            <form action="{{ route('postRequestService') }}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="control-label">Product Name</label>
                                    <input type="text" name="productName" placeholder="Product Name"
                                           id="input-email" class="form-control">
                                    <small class="text-danger">{{ $errors->first('productName') }}</small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Model</label>
                                    <input type="text" name="model" placeholder="Model" id="input-password"
                                           class="form-control">
                                    <small class="text-danger">{{ $errors->first('model') }}</small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Company Name</label>
                                    <input value="{{ old('companyName') }}" type="text" class="form-control"
                                           name="companyName" id="email"
                                           placeholder="Place">
                                    <small class="text-danger">{{ $errors->first('companyName') }}</small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Images</label>
                                    <input accept="image/*" multiple type="file" class="form-control"
                                           name="images[]" id="email"
                                    >
                                    <small class="text-danger">{{ $errors->first('images') }}</small>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Issue</label>
                                    <textarea class="form-control"
                                              name="issue"
                                              placeholder="Issue">
                                        {{ old('issue') }}
                                    </textarea>
                                    <small class="text-danger">{{ $errors->first('issue') }}</small>
                                </div>
                                <input type="hidden" name="serviceCenter" value="{{$serviceCenter->id}}">
                                <input type="submit" value="Submit" class="return-customer-btn">
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