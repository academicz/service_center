@extends('Shop.Layouts.Master')
@section('title')
    Shop | Service Requests
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Service Requests</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li class="active">Service Requests</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Service Requests</h3>
                    </div>
                    <!--No Label Form-->
                    <!--===================================================-->
                    <div class="panel-body">
                        <table class="table table-hover table-bordered table-striped product-table">
                            <thead>
                            <tr>
                                <th>Sl.no</th>
                                <th>Customer Name</th>
                                <th>Product</th>
                                <th>Issue</th>
                                <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($requests->count())
                                @foreach($requests as $request)
                                    <tr class="clickable-row" id="rowClick"
                                        data-url="{{ route('serviceRequest',['id'=>$request->id]) }}">
                                        <td>{{ $loop->iteration+($requests->perPage()*$requests->currentPage())-$requests->perPage() }}</td>
                                        <td>
                                            {{ $request->registration->name }}
                                        </td>
                                        <td>
                                            {{ $request->company_name.' '.$request->model.' ('.$request->product_name.')' }}
                                        </td>
                                        <td>
                                            {{ $request->issue }}
                                        </td>
                                        <td>{{ $request->registration->phone }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="5">No Service Request Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $requests->links() }}
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