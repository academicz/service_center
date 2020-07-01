@extends('Shop.Layouts.Master')
@section('title')
    Invoice | Shop
@endsection
@section('contents')
    <!--Page Title-->
    <div id="page-title">
        <h1 class="page-header print-none text-overflow">Generate Bill</h1>
    </div>
    <!--End page title-->

    <!--Breadcrumb-->
    <ol class="breadcrumb print-none">
        <li><a href="{{ route('shopHome') }}">Home</a></li>
        <li><a href="{{ route('serviceRequest',['id'=>$request->id]) }}">Service Request</a></li>
        <li class="active">Generate Bill</li>
    </ol>
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
                                    <h4 class="h3 mar-no">{{shop()->name}}</h4>
                                    <small>{{shop()->address}}<br>
                                        {{shop()->place}}<br>
                                        {{shop()->email}}
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
                    </div>
                </div>
            </div>
        @else
            <div class="panel" id="invoice">
                <div class="panel-body">
                    <div class="media-block">
                        <div class="media-left" style="white-space:nowrap">
                            <div class="invoice-logo">
                                <div class="media-body">
                                    <h4 class="h3 mar-no">{{shop()->name}}</h4>
                                    <small>{{shop()->address}}<br>
                                        {{shop()->place}}<br>
                                        {{shop()->email}}
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
                                    <td class="text-right text-primary text-bold">@{{ invoiceId }}</td>
                                </tr>
                                <tr>
                                    <td class="text-main text-bold">Billing Date</td>
                                    <td class="text-right">{{date('M d Y')}}</td>
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
                            <tr v-for="invoice in invoices">
                                <td>
                                    <strong>@{{ invoice.description }}</strong>
                                </td>
                                <td class="text-center">@{{ invoice.quantity }}</td>
                                <td class="text-center"><i class="fa fa-rupee"></i> @{{ invoice.price }}</td>
                                <td class="text-right"><i class="fa fa-rupee"></i> @{{ invoice.total }}</td>
                            </tr>
                            <tr class="print-none">
                                <td>
                                    <input placeholder="Description" type="text" class="form-control"
                                           v-model="description">
                                </td>
                                <td class="text-center">
                                    <input placeholder="Quantity" type="number" class="form-control" v-model="quantity">
                                </td>
                                <td class="text-center">
                                    <input placeholder="Price" type="number" class="form-control" v-model="price">
                                </td>
                                <td class="text-right">
                                    <button class="btn btn-success" @click="addEntry">ADD</button>
                                </td>
                            </tr>
                            <tr class="print-none">
                                <td>
                                    <select class="form-control" v-model="description2">
                                        <option :value="item" v-for="(item,index) in stocks">@{{item.item}}</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <input placeholder="Quantity" type="number" class="form-control" v-model="quantity2">
                                </td>
                                <td class="text-center">
                                    <input placeholder="Price" readonly type="number" class="form-control" v-model="description2.amount">
                                </td>
                                <td class="text-right">
                                    <button class="btn btn-success" @click="addEntry2">ADD</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table invoice-total">
                            <tbody>

                            <tr>
                                <td><strong>TOTAL :</strong></td>
                                <td class="text-bold h4"><i class="fa fa-rupee"></i> @{{ total }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right no-print">
                        <button v-if="this.invoiceId===''" class="btn btn-primary" @click="saveInvoice">Save</button>
                        <a v-else href="javascript:window.print()" class="btn btn-default"><i
                                    class="demo-psi-printer"></i>
                            Print</a>
                    </div>
                </div>
            </div>
        @endif

    </div>
    <!--End page content-->

    <script>
      const app = new Vue({
        el: '#invoice',
        data: {
          invoiceId: '',
          description: '',
          description2: '',
          quantity: '',
          quantity2: '',
          price: '',
          price2: '',
            item2:'',
          invoices: [],

            stocks:[],
        },
        methods: {
          addEntry2() {
            this.invoices.push({
              description:  this.description2.item,
              quantity: this.quantity2,
              price: this.description2.amount,
              total: this.quantity2 * this.description2.amount,
                item: this.description2.id,
            });
            this.description = '';
            this.quantity = '';
            this.price = '';
              this.item2 = '';
          },
            addEntry() {
            this.invoices.push({
              description: this.description,
              quantity: this.quantity,
              price: this.price,
              total: this.quantity * this.price,

                item:0,
            });
            this.description = '';
            this.quantity = '';
            this.price = '';

          },
          saveInvoice() {
            axios.post('/shop/close-service-entry', {
              params: {
                invoices: this.invoices,
                request: '{{$request->id}}',
                total: this.total,
              }
            })
              .then(({data}) => {
                this.invoiceId = data.invoiceId;
              })
              .catch(function (error) {
                console.log(error);
              })
          },
          get_stock() {
            axios.get('/shop/stock', {
              params: {
                json:true,
              }
            })
              .then(({data}) => {
               this.stocks = data.stocks;
                // this.price2 = this.stocks[0].amount;
              })
              .catch(function (error) {
                console.log(error);
              })
          }
        },
        computed: {
          total() {
            if (this.invoices.length) {
              let total = 0;
              for (let el in this.invoices) {
                total += this.invoices[el].total;
              }
              return total;
            }
            return 0;
          }
        },
          mounted(){
            this.get_stock();
          }
      })
    </script>
@endsection
