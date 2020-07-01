@extends('Shop.Layouts.Master')
@section('title')
    Shop | Stock
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Stocks</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb">
        <li><a href="{{ route('adminHome') }}">Home</a></li>
        <li class="active">Stock</li>
    </ol>
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">

        <div class="row">
            <div class="col-sm-6">

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Stock</h3>
                    </div>

                    <!--No Label Form-->
                    <!--===================================================-->
                    <form method="post" action="{{ route('saveStock') }}">
                        <div class="panel-body">
                            @include('Admin.Includes.msgBox')
                            <div class="form-group">
                                <label for="typeName">Item</label>
                                <input type="text" name="item" value="{{  old('item') }}" id="typeName"
                                       class="form-control">
                                <small class="text-danger">{{ $errors->first('item') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="typeName">Amount</label>
                                <input type="text" name="amount" value="{{  old('amount') }}" id="typeName"
                                       class="form-control">
                                <small class="text-danger">{{ $errors->first('amount') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="typeName">Amount</label>
                                <input type="text" name="stock" value="{{  old('stock') }}" id="typeName"
                                       class="form-control">
                                <small class="text-danger">{{ $errors->first('stock') }}</small>
                            </div>
                        </div>

                        <div class="panel-footer text-right">
                            <button class="btn btn-primary">Add Item</button>
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
                        <h3 class="panel-title">Available Items</h3>
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Sl.no</th>
                                <th>Item</th>
                                <th>Amount(Rs)</th>
                                <th>Stock</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($stocks->count())
                                @foreach($stocks as $stock)
                                    <tr>
                                        <td>{{ $loop->iteration+($stocks->perPage()*$stocks->currentPage())-$stocks->perPage() }}</td>
                                        <td>{{ $stock->item }}</td>
                                        <td>{{ $stock->amount }}</td>
                                        <td>{{ $stock->stock }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No Item Added</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{$stocks->links()}}
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
