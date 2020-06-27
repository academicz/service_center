@extends('Admin.Layouts.Master')
@section('title')
    Admin | New Service Center Registrations
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">New Service Centers</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li class="active"> New Service Center Registrations</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">New Service Center Registrations</h3>
                    </div>
                    <!--No Label Form-->
                    <!--===================================================-->
                    <div class="panel-body">
                        <table class="table table-hover table-bordered table-striped product-table">
                            <thead>
                            <tr>
                                <th>Sl.no</th>
                                <th>Name</th>
                                <th>Place</th>
                                <th>Address</th>
                                <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($centers->count())
                                @foreach($centers as $center)
                                    <tr class="clickable-row" id="rowClick"
                                        data-url="{{ route('serviceCenter',['id'=>$center->id]) }}">
                                        <td>{{ $loop->iteration+($centers->perPage()*$centers->currentPage())-$centers->perPage() }}</td>
                                        <td>
                                            {{ $center->name }}
                                        </td>
                                        <td>
                                            {{ $center->place }}
                                        </td>
                                        <td>
                                            {{ $center->address }}
                                        </td>
                                        <td>{{ $center->phone }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="5">No New Registration Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $centers->links() }}
                        </div>
                    </div>

                    <!--===================================================-->
                    <!--End No Label Form-->

                </div>
            </div>
        </div>


    </div>
    <!--End page content-->
@endsection