@extends('User.Layouts.MasterBill')
@section('title')
    Invoice | Shop
@endsection
@section('contents')
    <!--Page Title-->
    <!--End breadcrumb-->

    <!--Page content-->
    <div id="page-content">
        @if ($request->bill)
            <div class="panel">
                <div class="panel-body">
                    <div class="media-block">
                        <div class="media-left" style="white-space:nowrap">
                            <div class="invoice-logo">
                                <div class="media-body">
                                    <h4 class="h3 mar-no">{{$request->service_center->name}}</h4>
                                    <small>{{$request->service_center->address}}<br>
                                        {{$request->service_center->place}}<br>
                                        {{$request->service_center->email}}
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="media-body text-right">
                            <h3 class="h1 text-uppercase text-normal mar-no">INVOICE</h3>
                        </div>
                    </div>
                    <hr class="new-section-sm bord-no">
                    <div class="row">
                        <div class="col-xs-6">
                            <address>
                                <strong class="text-main">{{ $request->registration->name }}</strong><br>
                                {{ $request->registration->address.' pin:'.$request->registration->name }}<br>
                                {{ $request->registration->place }}<br>
                                {{ $request->registration->email }}
                            </address>
                        </div>
                        <div class="col-xs-6">
                            <table class="pull-right invoice-details">
                                <tbody>
                                <tr>
                                    <td class="text-main text-bold">Invoice #</td>
                                    <td class="text-right text-primary text-bold">{{ $request->bill->id }}</td>
                                </tr>
                                <tr>
                                    <td class="text-main text-bold">Billing Date</td>
                                    <td class="text-right">{{formattedDate($request->bill->created_at)}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="new-section-sm bord-no">
                    <div class="table-responsive">
                        <table class="table table-striped invoice-summary">
                            <thead>
                            <tr class="">
                                <th>Description</th>
                                <th class="min-col text-center">Qty</th>
                                <th class="min-col text-center">Price</th>
                                <th class="min-col text-right">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($request->bill->bill_items as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->description }}</strong>
                                    </td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-center"><i class="fa fa-rupee"></i> {{ $item->price }}</td>
                                    <td class="text-right"><i class="fa fa-rupee"></i> {{ $item->total }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <table class="table invoice-total">
                            <tbody>
                            {{--<tr>--}}
                            {{--<td><strong>Sub Total :</strong></td>--}}
                            {{--<td>$538.06</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                            {{--<td><strong>TAX :</strong></td>--}}
                            {{--<td>$73.98</td>--}}
                            {{--</tr>--}}
                            <tr>
                                <td><strong>TOTAL :</strong></td>
                                <td class="text-bold h4"><i class="fa fa-rupee"></i> {{ $request->bill->total }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right no-print">
                        <a href="javascript:window.print()" class="btn btn-default"><i
                                    class="demo-psi-printer"></i>
                            Print</a>
                        @if ($request->bill->status==1)
                            <a class="btn btn-default" href="{{route('getPayment',['id'=>$request->id])}}">Pay</a>
                        @else
                            Already Payed
                        @endif
                    </div>
                </div>
            </div>

        @endif

    </div>
    <!--End page content-->
@endsection