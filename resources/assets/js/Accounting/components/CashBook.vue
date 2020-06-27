<template>
    <div>
        <!--Page Title-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Cash Book</h1>
        </div>
        <!--End page title-->

        <!--Breadcrumb-->
        <ol class="breadcrumb">
            <li><a href="">Home</a></li>
            <li class="active">Cashbook</li>
        </ol>
        <!--End breadcrumb-->
        <!--Page content-->
        <div id="page-content">

            <div class="row">

                <spinner v-if="loading"></spinner>
                <div class="col-sm-6">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Cashbook</h3>
                        </div>

                        <!--No Label Form-->
                        <!--===================================================-->
                        <form method="post" @submit.prevent="addCashBookEntry">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Date</label>
                                    <date-picker date-format="YYYY-MM-DD" format="DD-MM-YYYY" width='100%'
                                                 v-model="form.date" lang="en"></date-picker>
                                    <small class="text-danger" v-if="!form.has('date')">{{
                                        form.errors.get('date') }}
                                    </small>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <template v-for="particularType in particularTypes">
                                            <button id="pType" type="button" :data-type="particularType.value"
                                                    style="width: 50%;"
                                                    class="btn btn-default">{{ particularType.label }}
                                            </button>
                                        </template>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <v-select id="category" v-model="form.category"
                                              :options="particularCategories"></v-select>
                                </div>
                                <div class="form-group">
                                    <label for="particular">Particular</label>
                                    <v-select id="particular" v-model="form.particular"
                                              :options="particulars"></v-select>
                                    <small class="text-danger" v-if="!form.has('particular')">{{
                                        form.errors.get('particular') }}
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input id="amount" v-model="form.amount" type="text" class="form-control"/>
                                    <small class="text-danger" v-if="!form.has('amount')">{{
                                        form.errors.get('amount') }}
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="remark">Remarks</label>
                                    <input id="remark" v-model="form.remarks" type="text" class="form-control"/>
                                    <small class="text-danger" v-if="!form.has('remarks')">{{
                                        form.errors.get('remarks') }}
                                    </small>
                                </div>
                            </div>

                            <div class="panel-footer text-right">
                                <button class="btn btn-primary">Add Cashbook Entry</button>
                            </div>
                        </form>
                        <!--===================================================-->
                        <!--End No Label Form-->

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Cashbook</h3>
                        </div>
                        <div class="panel-body">
                            <list-count :data="cashBookData"></list-count>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Sl.no</th>
                                    <th>Particular</th>
                                    <th>Amount</th>
                                    <th>Balance</th>
                                </tr>
                                </thead>
                                <tbody>
                                <template v-if="cashBookData.data.length">
                                    <tr v-for="(cashData,index) in cashBookData.data"
                                        :class="cashData.particularType.value === getConstant('PARTICULAR_TYPE_EXPENSE')?'danger':'success'">
                                        <td>{{ (cashBookData.meta.current_page * cashBookData.meta.per_page) -
                                            cashBookData.meta.per_page + index + 1}}
                                        </td>
                                        <td>{{ cashData.particular.label }}</td>
                                        <td>{{ cashData.amount }}</td>
                                        <td>{{ cashData.balance }}</td>
                                    </tr>
                                </template>
                                <tr v-else>
                                    <td colspan="4" class="text-center">No data Available</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-center margin-top-30">
                                <pagination :data="cashBookData"
                                            @pagination-change-page="getCashBookData"></pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End page content-->
        </div>
    </div>
</template>

<script>
    import $ from 'jquery';
    import DatePicker from 'vue2-datepicker';
    import vSelect from 'vue-select';
    import {spinner} from "../mixins/helper";
    import Form from "../shared/form";
    import submit from '../http/http';
    import {getConstants} from '../constants/constantsMixins';
    import Pagination from './shared/Pagination';
    import ListCount from './shared/PaginationListCount';
    import {INITIAL_AMOUNT_PARTICULAR} from '../constants/constants';

    export default {
        name: "CashBook",
        components: {
            vSelect,
            Pagination,
            ListCount,
            DatePicker
        },
        mixins: [spinner, getConstants],
        data() {
            return {
                form: new Form({
                    particular: '',
                    remarks: '',
                    amount: '',
                    type: '',
                    category: '',
                    date: new Date(),
                }),
                particulars: [{value: '', label: 'Select Particular Category'}],
                particularTypes: [],
                particularCategories: [{value: '', label: 'Select Particular Type'}],
                initialCashBook: false,
                cashBookData: {data: []}
            };
        },
        methods: {
            getCashBookData({url}) {
                submit({
                    type: 'get',
                    url: url,
                }).then(({data}) => {
                    this.cashBookData = data;
                }).catch(response => {

                });
            },
            getFormData({data}) {
                let type = data.type;
                submit({
                    type: 'get',
                    url: 'get-cashbook-form-data',
                    data: data,
                }).then(({data}) => {
                    if (type === 1) {
                        this.particularTypes = data.data.particularTypes;
                    } else if (type === 2) {
                        this.particularCategories = data.data.particularCategories;
                    } else if (type === 3) {
                        this.particulars = data.data.particulars;
                    }
                }).catch(response => {

                });
            },
            addCashBookEntry() {
                let particular = this.form.particular.value === INITIAL_AMOUNT_PARTICULAR;
                submit({
                    type: 'post',
                    url: 'add-cashbook-entry',
                    data: this.form,
                    form: true,
                    clearExcept: ['particular', 'type', 'category', 'date']
                }).then(({data}) => {
                    this.getCashBookData({url: 'get-cashbook-data'});
                    if (particular) {
                        this.getFormData({
                            data: {
                                type: 1,
                            },
                        });
                        this.particulars = [{value: '', label: 'Select Particular Category'}];
                        this.particularCategories = [{value: '', label: 'Select Particular Type'}];
                        this.form.particular = '';
                        this.form.type = '';
                        this.form.category = '';
                    }
                }).catch(response => {

                });
            },
            selectType(type, e) {
                if (this.form.type === '') {
                    this.form.type = type;
                } else {
                    this.form.type = '';
                }

                if (e.target.classList[1] === 'btn-info') {
                    e.target.classList.remove('btn-info');
                    e.target.classList.add('btn-success');
                } else {
                    e.target.classList.add('btn-info');
                    e.target.classList.remove('btn-success');
                }
            }
        },
        watch: {
            'form.type'() {
                this.getFormData({
                    data: {
                        type: 2,
                        particularType: this.form.type,
                    },
                });
                this.form.particular = '';
                this.form.category = '';
            },
            'form.category'() {
                this.getFormData({
                    data: {
                        type: 3,
                        particularCategory: this.form.category.value,
                    },
                });
            }
        },
        mounted() {
            let vue = this;
            this.getFormData({
                data: {
                    type: 1,
                },
            });
            this.getCashBookData({url: 'get-cashbook-data'});
            $(document).on('click', '#pType', function (e) {
                let type = $(this).data('type');
                $(this).addClass('btn-success').siblings().removeClass('btn-success');
                vue.form.type = type;
            });
        },
    }
</script>

<style scoped>

</style>