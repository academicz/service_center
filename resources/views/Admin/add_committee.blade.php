@extends('Admin.Layouts.Master')
@section('title')
    Admin | Committee
@endsection
@section('head')
    <script src="{{asset('plugins/chosen/chosen.jquery.min.js')}}"></script>
    <link href="{{asset('plugins/chosen/chosen.min.css') }}" rel="stylesheet">
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Committee</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li class="active">Committee</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-6">

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Committee Member</h3>
                    </div>

                    <!--No Label Form-->
                    <!--===================================================-->
                    <form method="post" action="{{ route('postCommitteeMember') }}"
                          enctype="multipart/form-data">
                        <div class="panel-body">
                            @include('Admin.Includes.msgBox')
                            <div class="form-group">
                                <label for="cFamilyList">Family</label>
                                <select class="form-control" name="family" data-placeholder="Choose a Family"
                                        id="cFamilyList" tabindex="2">
                                    <option value="">Select Family</option>
                                    @foreach($families as $family)
                                        <option @if ($family->id == old('family'))
                                                selected
                                                @endif value="{{ $family->id }}">{{ $family->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first('family') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="famName">Member</label>
                                <select class="form-control" name="member"
                                        id="members">
                                    <option value="">Select Member</option>
                                </select>
                                <small class="text-danger">{{ $errors->first('member') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="famAddress">Designation</label>
                                <select class="form-control" name="designation" data-placeholder="Choose a Designation">
                                    <option value="">Select Designation</option>
                                    @foreach($designations as $designation)
                                        <option @if ($designation->id == old('designation'))
                                                selected
                                                @endif value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first('designation') }}</small>
                            </div>
                        </div>

                        <div class="panel-footer text-right">
                            <button class="btn btn-primary">Add Committee Member</button>
                        </div>
                        {{ csrf_field() }}
                    </form>
                    <!--===================================================-->
                    <!--End No Label Form-->

                </div>
            </div>
            <div class="col-md-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Committee Members</h3>
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Sl.no</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($committies->count())
                                @foreach($committies as $committee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $committee->family_member->name }}</td>
                                        <td>{{ $committee->designation->designation_name }}</td>
                                        <td><a id="delete" data-message="Committee member will be deleted"
                                               data-toogle="tooltip" title="Delete Committee Member"
                                               href="{{ route('deleteCommitteeMember',['id'=>$committee->id]) }}">
                                                <i class="fa fa-trash fa-2x"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No Committee Member Added</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End page content-->
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#cFamilyList').chosen();
        });

    </script>
@endsection