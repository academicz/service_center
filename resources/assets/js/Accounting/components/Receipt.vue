<template>
    <div>
        <!--Page Title-->
        <div id="page-title">
            <h1 class="page-header text-overflow print-none">Print Receipts</h1>
        </div>
        <!--End page title-->

        <!--Breadcrumb-->
        <ol class="breadcrumb print-none">
            <li><a href="">Home</a></li>
            <li class="active">Print Receipts</li>
        </ol>
        <!--End breadcrumb-->
        <!--Page content-->
        <div id="page-content">

            <div class="row">

                <spinner v-if="loading"></spinner>
                <div class="col-sm-12">

                    <div class="panel">
                        <div class="panel-heading print-none">
                            <h3 class="panel-title">Receipts</h3>
                        </div>

                        <!--No Label Form-->
                        <!--===================================================-->
                        <!--<form method="post" @submit.prevent="addCashBookEntry">-->
                        <div class="panel-body">
                            <div class="form-group print-none">
                                <div class="row">
                                    <template v-for="type in receiptTypes">
                                        <div class="col-sm-3">
                                            <router-link tag="button"
                                                         class="btn btn-success full-width"
                                                         :to="{name:type.url}">
                                                {{ type.label }}
                                            </router-link>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div class="row">
                                <router-view></router-view>
                            </div>
                        </div>

                        <!--</form>-->
                        <!--===================================================-->
                        <!--End No Label Form-->

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
    import {INITIAL_AMOUNT_PARTICULAR, RECEIPT_TYPES} from '../constants/constants';

    export default {
        name: "Receipt",
        components: {
            vSelect,
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
                receiptTypes: RECEIPT_TYPES,
                particularCategories: [{value: '', label: 'Select Particular Type'}],
                initialCashBook: false,
                cashBookData: {data: []},
                receiptType: 0,
            };
        },
        methods: {
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
            },
        },
        mounted() {
            let vue = this;
            this.getFormData({
                data: {
                    type: 1,
                },
            });
            $(document).on('click', '#pType', function (e) {
                let type = $(this).data('type');
                $(this).addClass('btn-success').siblings().removeClass('btn-success');
                vue.form.type = type;
            });
        },
    }
</script>

<style scoped>
    .btn-success.active {
        background-color: green;
    }

    @media print {
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