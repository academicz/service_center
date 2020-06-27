@extends('Admin.Layouts.Master')
@section('title')
    Admin | Shope Types
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Shope Types</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li class="active">Shope Types</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-6">

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add New Type</h3>
                    </div>

                    <!--No Label Form-->
                    <!--===================================================-->
                    <form method="post" action="{{ route('postShopType') }}">
                        <div class="panel-body">
                            @include('Admin.Includes.msgBox')
                            <div class="form-group">
                                <label for="typeName">Shop Type Name</label>
                                <input type="text" name="typeName" value="{{  old('typeName') }}" id="typeName"
                                       class="form-control">
                                <small class="text-danger">{{ $errors->first('typeName') }}</small>
                            </div>
                        </div>

                        <div class="panel-footer text-right">
                            <button class="btn btn-primary">Add Shop Type</button>
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
                        <h3 class="panel-title">Shop Types</h3>
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Sl.no</th>
                                <th>Shop Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($shopTypes->count())
                                @foreach($shopTypes as $shopType)
                                    <tr>
                                        <td>{{ $loop->iteration+($shopTypes->perPage()*$shopTypes->currentPage())-$shopTypes->perPage() }}</td>
                                        <td>{{ $shopType->shop_type }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No Prayer Group Added</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{$shopTypes->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!--End page content-->
@endsection

@section('scripts')
@endsection