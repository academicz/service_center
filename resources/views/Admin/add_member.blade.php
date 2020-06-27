@extends('Admin.Layouts.Master')
@section('title')
    Admin | Family Member
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow text-capitalize">{{$family->name}}, {{$family->address}}
            , {{$family->place}}</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li><a href="{{ route('getFamilies') }}">Families</a></li>
        <li><a href="{{ route('getFamily',['id'=>$family->id,'name'=>urlString($family->name)]) }}">{{$family->name}}</a></li>
        <li class="active">New Family Member</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-12" id="newProduct">

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Member Details</h3>
                    </div>

                    <!--No Label Form-->
                    <!--===================================================-->
                    <form method="post" action="{{ route('addFamilyMemberData') }}"
                          enctype="multipart/form-data">
                        <div class="panel-body">
                            @include('Admin.Includes.msgBox')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="hidden" name="familyId" class="form-control"
                                               value="{{$family->id}}">
                                        <input value="{{ old('name') }}" type="text" name="name" class="form-control"/>
                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nickname</label>
                                        <input value="{{old('nickName')}}" type="text" name="nickName"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('nickName') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option @if (old('gender')=='male')
                                                    selected
                                                    @endif value="male">Male
                                            </option>
                                            <option @if (old('gender')=='female')
                                                    selected
                                                    @endif value="female">Female
                                            </option>
                                        </select>
                                        <small class="text-danger">{{ $errors->first('gender') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Education</label>
                                        <select name="education" class="form-control">
                                            <option value="">Select Education</option>
                                            @foreach($educations as $education)
                                                <option @if (old('education')==$education->id) selected
                                                        @endif value="{{$education->id}}">{{$education->qualification}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger">{{ $errors->first('education') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Relationship type</label>
                                        <select name="relationType" class="form-control">
                                            <option value="">Add Relation</option>
                                            @foreach($relations as $relation)
                                                <option @if (old('relationType')==$relation->id) selected
                                                        @endif value="{{$relation->id}}">{{$relation->relation}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger">{{ $errors->first('relationType') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Relation with</label>
                                        <select name="relationWith" class="form-control">
                                            <option value="">Relation With</option>
                                            @foreach($family->family_members as $member)
                                                <option @if(old('relationWith')==$member->id) selected @endif
                                                value="{{$member->id}}">{{$member->name}}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger">{{ $errors->first('relationWith') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input value="{{ old('dateOfBirth') }}" type="date" name="dateOfBirth"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('dateOfBirth') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Marriage Date</label>
                                        <input value="{{old('marriageDate')}}" type="date" name="marriageDate"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('marriageDate') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Occupation</label>
                                        <input value="{{ old('occupation') }}" type="text" name="occupation"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('occupation') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Present Place</label>
                                        <input value="{{ old('presentPlace') }}" type="text" name="presentPlace"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('presentPlace') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input value="{{ old('phoneNumber') }}" type="number" name="phoneNumber"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('phoneNumber') }}</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>E-Mail</label>
                                        <input value="{{old('emailId')}}" type="text" name="emailId"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('emailId') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <input type="text" value="{{old('remarks')}}" name="remarks"
                                               class="form-control">
                                        <small class="text-danger">{{ $errors->first('remarks') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="panel-footer text-right">
                            <button class="btn btn-primary">Add Member</button>
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