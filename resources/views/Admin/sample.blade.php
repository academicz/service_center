@extends('Admin.Layouts.Master')
@section('title')
    Admin | Home
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">News</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li class="active">Add News</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add News</h3>
                    </div>

                    <!--No Label Form-->
                    <!--===================================================-->
                    <form name="listing" method="post" class="form-horizontal" action="#"
                          enctype="multipart/form-data">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4 mar-btm">
                                    <input type="text" name="n_title" class="form-control" placeholder="Title">
                                </div>
                            </div>
                            <textarea placeholder="Message" name="n_content" rows="13" class="form-control"></textarea>
                        </div>
                        <div class="panel-footer text-right">
                            <button class="btn btn-primary">Save</button>
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