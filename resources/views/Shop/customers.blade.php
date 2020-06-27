@extends('Shop.Layouts.Master')
@section('title')
    Shop | Customers
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Customers</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li class="active">Customers</li>
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
                            <thead>
                            <tr>
                                <th>Sl.no</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($customers->count())
                                @foreach($customers as $customer)
                                    <tr class="clickable-row" id="rowClick"
                                        data-url="{{ route('getCustomer',['id'=>$customer->id]) }}">
                                        <td>{{ $loop->iteration+($customers->perPage()*$customers->currentPage())-$customers->perPage() }}</td>
                                        <td>
                                            {{ $customer->name }}
                                        </td>
                                        <td>
                                            {{ $customer->address }}
                                        </td>
                                        <td>
                                            {{ $customer->phone }}
                                        </td>
                                        <td>{{ $customer->email }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="5">No Customers Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $customers->links() }}
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