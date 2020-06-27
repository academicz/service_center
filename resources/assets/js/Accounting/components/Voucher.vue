<template>
    <div>
        <div class="col-sm-12">

            <div class="panel">
                <div class="panel-heading print-none">
                    <h3 class="panel-title">Voucher</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 print-none">
                            <form action="">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="category">Category</label>
                                            <v-select id="category" v-model="particular"
                                                      :options="expenditures"></v-select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input id="amount" v-model.number="amount" type="number"
                                                   class="form-control"/>
                                            <!--<small class="text-danger" v-if="!form.has('amount')">{{-->
                                            <!--form.errors.get('amount') }}-->
                                            <!--</small>-->
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="remark">Remarks</label>
                                            <input id="remark" v-model="remarks" type="text" class="form-control"/>
                                            <!--<small class="text-danger" v-if="!form.has('remarks')">{{-->
                                            <!--form.errors.get('remarks') }}-->
                                            <!--</small>-->
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button @click.prevent="subDivide"
                                                    class="btn full-width btn-warning">
                                                Add Particular
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12 print-none" v-if="divide">
                            <div class="row">
                                <form action="">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <input ref="im" v-model="item" placeholder="Item" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input v-model.number="itemAmount" placeholder="Amount" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <button @click.prevent="addItem" class="btn btn-primary full-width">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="voucher-box">
                                <div class="title">{{getConstant('CHURCH_NAME')}}</div>
                                <div class="voucher-head"><span>വൗച്ചർ</span></div>
                                <div class="box">
                                    <div class="pull-left">
                                        No: {{slNo}}
                                    </div>
                                    <div class="pull-right">
                                        {{ date }}
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="inner-box">
                                        <table class="table table-bordered" style="border: 2px solid #ccc;">
                                            <thead>
                                            <tr>
                                                <th class="col-sm-9 text-center"
                                                    style="border-bottom: 2px solid #ccc;border-right: 2px solid #ccc">
                                                    Item
                                                </th>
                                                <th class="col-sm-3 text-center"
                                                    style="border-bottom: 2px solid #ccc">
                                                    Amount
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-if="items.length===0 && particular!==''">
                                                <td class="col-sm-9 border-off right-brd-2px">
                                                    {{particular.label}}
                                                </td>
                                                <td class="col-sm-3 border-off text-right">
                                                    {{amount}}
                                                </td>
                                            </tr>
                                            <template v-else-if="particular!==''">
                                                <tr>
                                                    <td class="col-sm-9 border-off right-brd-2px">
                                                        {{particular.label}}
                                                    </td>
                                                    <td class="col-sm-3 border-off">

                                                    </td>
                                                </tr>
                                                <tr v-for="(item,index) in items">
                                                    <td class="col-sm-9 border-off right-brd-2px"
                                                        style="text-indent: 50px">
                                                        <li>{{ item.item}}</li>
                                                        <span style="text-indent: 0" @click="items.splice(index, 1)"
                                                              class="print-none label label-danger pull-right">Remove Item</span>
                                                    </td>
                                                    <td class="col-sm-3 border-off text-right">
                                                        {{item.amount}}
                                                    </td>
                                                </tr>
                                            </template>
                                            <tr>
                                                <th class="col-sm-9 text-right"
                                                    style="border-top: 2px solid #ccc;border-right: 2px solid #ccc">
                                                    Total
                                                </th>
                                                <td class="col-sm-3 text-right"
                                                    style="border-top: 2px solid #ccc">
                                                    {{ amount }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="bottom text-capitalize">
                                            Rupees {{ amoundWord }} Received
                                        </div>
                                        <div class="bottom text-capitalize text-right">
                                           Name and Signature
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer print-none text-right">
                    <button @click.prevent="saveVoucher" class="btn btn-primary">Save and Print</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import vSelect from 'vue-select';
    import converter from 'number-to-words';
    import 'animate.css';
    import Form from "../shared/form";
    import submit from '../http/http';
    import alerts from '../shared/alert';
    import {getConstants} from '../constants/constantsMixins';

    export default {
        name: "Voucher",
        mixins: [getConstants],
        components: {
            vSelect
        },
        data() {
            return {
                slNo: '',
                remarks: '',
                amount: '',
                particular: '',
                items: [],
                expenditures: [],
                divide: false,
                item: '',
                itemAmount: '',
            };
        },
        methods: {
            getSerialNumber() {
                submit({
                    type: 'get',
                    url: 'get-voucher-number',
                }).then(({data}) => {
                    this.slNo = data.data.slNo;
                }).catch(response => {
                });
            },
            saveVoucher() {
                if (this.amount > 0 && this.particular !== '') {
                    submit({
                        type: 'post',
                        url: 'add-voucher',
                        data: {
                            particular: this.particular,
                            amount: this.amount,
                            items: this.items,
                            remarks: this.remarks,
                        }
                    }).then(({data}) => {
                        window.print();
                        this.item = '';
                        this.itemAmount = '';
                        this.items = [];
                        this.divide = false;
                        this.getSerialNumber();
                    }).catch(response => {

                    });
                } else {
                    alerts({
                        options: {
                            title: "Please Check",
                            text: 'Please enter correct details',
                            icon: "warning",
                            dangerMode: true,
                        },
                    });
                }
            },
            getExpenditures() {
                submit({
                    type: 'get',
                    url: 'get-cashbook-form-data',
                    data: {type: 4}
                }).then(({data}) => {
                    this.expenditures = data.data.particulars;
                }).catch(response => {

                });
            },
            subDivide() {
                if (this.particular === '') {
                    alerts({
                        options: {
                            title: "Please Check",
                            text: 'Please select category',
                            icon: "warning",
                            dangerMode: true,
                        },
                    });
                } else {
                    this.divide = this.divide === false;
                }
            },
            addItem() {
                if (this.item === '' || this.itemAmount === '' || !Number.isInteger(parseInt(this.itemAmount))) {
                    alerts({
                        options: {
                            title: "Please Check",
                            text: 'Please select item and amount',
                            icon: "warning",
                            dangerMode: true,
                        },
                    });
                    this.$refs.im.focus();
                } else {
                    this.items.push({item: this.item, amount: this.itemAmount});
                    this.item = '';
                    this.itemAmount = '';
                    this.$refs.im.focus();
                }
            },
            removeItem(index) {
                alert(index);
                this.items.splice(index, 1);
            }
        },
        computed: {
            date() {
                return new Date().toLocaleDateString()
            },
            amoundWord() {
                return this.amount !== '' ? converter.toWords(this.amount) : '';
            }
        },
        watch: {
            items() {
                this.amount = this.items.reduce((total, element) => total += parseInt(element.amount), 0);
            }
        },
        mounted() {
            this.getExpenditures();
            this.getSerialNumber();
        }
    }
</script>

<style scoped>
    .voucher-box {
        border: 1px dashed #ccc;
        padding: 15px;
    }

    .voucher-box .title {
        font-size: 30px;
        font-weight: 600;
        text-align: center;
    }

    .voucher-box .voucher-head {
        text-align: center;
    }

    .voucher-box .voucher-head span {
        display: inline-block;
        font-size: 25px;
        line-height: 28px;
        padding: 0 6px 0 6px;
    }

    .voucher-box .box {
        margin: 10px 100px 0 100px;
    }

    .voucher-box .box .inner-box {
        margin-top: 10px;
    }

    .voucher-box .box .inner-box table {
        margin: 0;
    }

    .voucher-box .box .inner-box table li {
        display: inline;
        list-style-type: disc;
    }

    .border-off {
        border-bottom: none !important;
        border-top: none !important;
    }

    .right-brd-2px {
        border-right: 2px solid #ccc !important;
    }

    .voucher-box .inner-box .bottom {
        padding-top: 10px;
    }

    .label {
        cursor: pointer;
    }

    @media print {
        .voucher-box {
            /*border: 1px dashed #ccc;*/
            border: none;
            padding: 0;
        }

        .voucher-box .box {
            margin: 0 1cm 0 1cm;
        }

        .page-content {
            padding: 0;
            margin: 0;
        }

        @page {
            margin: 0mm;
            padding: 0;
            size: A4; /* DIN A4 standard, Europe */
        }

        html {
            background-color: #FFFFFF;
            margin: 0px; /* this affects the margin on the HTML before sending to printer */
        }
    }
</style>