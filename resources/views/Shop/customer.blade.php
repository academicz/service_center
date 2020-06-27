@extends('Shop.Layouts.Master')
@section('title')
    Shop | Customer | {{$customer->name}}
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Customer</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li><a href="{{ route('getCustomers') }}">Customers</a></li>
        <li class="active">{{$customer->name}}</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Customers</h3>
                    </div>
                    <!--No Label Form-->
                    <!--===================================================-->
                    <div class="panel-body">
                        <table class="table table-hover table-bordered table-striped product-table">
                            <tr>
                                <th>Name</th>
                                <td>{{$customer->name}}</td>
                                <th>Address</th>
                                <td>{{$customer->address}}</td>
                            </tr>
                            <tr>
                                <th>Place</th>
                                <td>{{$customer->place}}</td>
                                <th>Pin Code</th>
                                <td>{{$customer->pin_code}}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{$customer->phone}}</td>
                                <th>Email</th>
                                <td>{{$customer->email}}</td>
                            </tr>
                        </table>

                        <h4>
                            Previous Service Details
                        </h4>
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