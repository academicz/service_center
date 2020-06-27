<template>
    <div>
        <!--Page Title-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Particulars</h1>
        </div>
        <!--End page title-->

        <!--Breadcrumb-->
        <ol class="breadcrumb">
            <li><a href="">Home</a></li>
            <li class="active">Add Particular</li>
        </ol>
        <!--End breadcrumb-->
        <!--Page content-->
        <div id="page-content">

            <div class="row">

                <spinner v-if="loading"></spinner>
                <div class="col-sm-6">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add Particular</h3>
                        </div>

                        <!--No Label Form-->
                        <!--===================================================-->
                        <form method="post" @submit.prevent="addParticular">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="category">Particular Category</label>
                                    <v-select id="category" v-model="form.category"
                                              :options="particularCategories"></v-select>
                                    <small class="text-danger" v-if="!form.has('category')">{{
                                        form.errors.get('category') }}
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="name">Particular Name</label>
                                    <input type="text" id="name" class="form-control" v-model="form.particularName">
                                    <small class="text-danger" v-if="!form.has('particularName')">
                                        {{ form.errors.get('particularName') }}
                                    </small>
                                </div>
                            </div>

                            <div class="panel-footer text-right">
                                <button class="btn btn-primary">Add Particular</button>
                            </div>
                        </form>
                        <!--===================================================-->
                        <!--End No Label Form-->

                    </div>
                </div>
                <div class="col-sm-6">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Particulars</h3>
                        </div>

                        <!--No Label Form-->
                        <!--===================================================-->

                        <div class="panel-body">
                            <list-count :data="particulars"></list-count>
                            <table class="table table-bordered table-hover text-capitalize">
                                <tbody>
                                <template v-for="particularCat in particulars.data">
                                    <tr>
                                        <th>{{ particularCat.name+' ('+particularCat.type.label+' )'}}</th>
                                    </tr>
                                    <tr v-for="particular in particularCat.particulars">
                                        <td>
                                           <li> {{ particular.label }}</li>
                                        </td>
                                    </tr>
                                </template>
                                </tbody>
                            </table>
                            <div class="text-center margin-top-30">
                                <pagination :data="particulars"
                                            @pagination-change-page="getParticulars"></pagination>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!--End page content-->
    </div>

</template>

<script>
    import vSelect from 'vue-select';
    import Form from '../shared/form';
    import submit from '../http/http';
    import {spinner} from "../mixins/helper";
    import Pagination from './shared/Pagination';
    import ListCount from './shared/PaginationListCount';


    export default {
        name: "Particulars",
        components: {
            vSelect,
            Pagination,
            ListCount
        },
        mixins: [spinner],
        data() {
            return {
                form: new Form({
                    particularName: '',
                    category: '',
                }),
                particularCategories: [],
                particulars: {data: []}
            };
        },
        methods: {
            addParticular() {
                submit({
                    type: 'post',
                    url: 'add-particular',
                    data: this.form,
                    form: true,
                }).then(({data}) => {
                    this.getParticulars({url: 'get-particulars'});
                }).catch(response => {

                });
            },
            getParticularCategories() {
                submit({
                    type: 'get',
                    url: 'get-form-particular-category',
                }).then(({data}) => {
                    this.particularCategories = data.data.categories;
                }).catch(response => {

                });
            },
            getParticulars({url}) {
                submit({
                    type: 'get',
                    url: url,
                }).then(({data}) => {
                    this.particulars = data;
                }).catch(response => {

                });
            }
        },
        mounted() {
            this.getParticularCategories();
            this.getParticulars({url: 'get-particulars'});
        }
    }
</script>

<style scoped>

</style>