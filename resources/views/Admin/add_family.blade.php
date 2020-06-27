@extends('Admin.Layouts.Master')
@section('title')
    Admin | Add Family
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Family</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li class="active">New Family</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-12" id="newProduct">

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Family</h3>
                    </div>

                    <!--No Label Form-->
                    <!--===================================================-->
                    <form method="post" action="{{ route('postNewFamily') }}"
                          enctype="multipart/form-data">
                        <div class="panel-body">
                            @include('Admin.Includes.msgBox')
                            <div class="form-group">
                                <label for="famName">Prayer Group</label>
                                <select name="prayerGroup" class="form-control">
                                    <option value="">Select Prayer Group</option>
                                    @foreach($prayerGroups as $prayerGroup)
                                        <option @if ($prayerGroup->id == old('prayerGroup'))
                                            selected
                                        @endif value="{{ $prayerGroup->id }}">{{ $prayerGroup->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first('prayerGroup') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="famName">Family Name</label>
                                <input value="{{ old('familyName') }}" type="text" name="familyName" id="famName"
                                       class="form-control">
                                <small class="text-danger">{{ $errors->first('familyName') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="famAddress">Address</label>
                                <input type="text" value="{{ old('address') }}" name="address" id="famAddress"
                                       class="form-control">
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="famPlace">Place</label>
                                <input type="text" value="{{ old('place') }}" name="place" class="form-control"
                                       id="name">
                                <small class="text-danger">{{ $errors->first('place') }}</small>
                            </div>

                        </div>

                        <div class="panel-footer text-right">
                            <button class="btn btn-primary">Add Family</button>
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