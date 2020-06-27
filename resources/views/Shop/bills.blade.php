@extends('Shop.Layouts.Master')
@section('title')
    Shop | Bills
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Bills</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li class="active">Bills</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Service Bills</h3>
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
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($bills->count())
                                @foreach($bills as $bill)
                                    <tr class="clickable-row" id="rowClick"
                                        data-url="{{ route('viewBill',['id'=>$bill->service_request->id]) }}">
                                        <td>{{ $loop->iteration+($bills->perPage()*$bills->currentPage())-$bills->perPage() }}</td>
                                        <td>
                                            {{ $bill->service_request->registration->name }}
                                        </td>
                                        <td>
                                            {{ $bill->service_request->company_name.' '.$bill->service_request->model.' ('.$bill->service_request->product_name.')' }}
                                        </td>
                                        <td>
                                            {{ $bill->service_request->issue }}
                                        </td>
                                        <td>{{ $bill->service_request->registration->phone }}</td>
                                        <td>
                                            @if ($bill->status==1)
                                                Not Payed
                                            @else
                                                Payed
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="5">No Bills Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $bills->links() }}
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