<template>
    <div>
        <!--Page Title-->
        <div id="page-title">
            <h1 class="page-header text-overflow">Particular Categories</h1>
        </div>
        <!--End page title-->

        <!--Breadcrumb-->
        <ol class="breadcrumb">
            <li><a href="">Home</a></li>
            <li class="active">Add Particular Category</li>
        </ol>
        <!--End breadcrumb-->
        <!--Page content-->
        <div id="page-content">

            <div class="row">

                <spinner v-if="loading"></spinner>
                <div class="col-sm-6">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add Particular Category</h3>
                        </div>

                        <!--No Label Form-->
                        <!--===================================================-->
                        <form method="post" @submit.prevent="addParticularCategory">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="pType">Particular Type</label>
                                    <select id="pType" class="form-control" v-model="form.type">
                                        <option value="">Select Type</option>
                                        <option v-for="type in particularTypes" :value="type.value">{{type.label}}
                                        </option>
                                    </select>
                                    <small class="text-danger" v-if="!form.has('type')">{{ form.errors.get('type') }}
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="name">Particular Category Name</label>
                                    <input type="text" id="name" class="form-control" v-model="form.category">
                                    <small class="text-danger" v-if="!form.has('category')">{{
                                        form.errors.get('category') }}
                                    </small>
                                </div>
                            </div>

                            <div class="panel-footer text-right">
                                <button class="btn btn-primary">Add Particular Category</button>
                            </div>
                        </form>
                        <!--===================================================-->
                        <!--End No Label Form-->

                    </div>
                </div>
                <div class="col-sm-6">

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Particular Categories</h3>
                        </div>

                        <!--No Label Form-->
                        <!--===================================================-->

                        <div class="panel-body">
                            <list-count :data="particularCategories"></list-count>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Particular Category</th>
                                    <th>Category Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="particular in particularCategories.data">
                                    <td>{{ particular.name}}</td>
                                    <td>{{ particular.type.label}}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-center margin-top-30">
                                <pagination :data="particularCategories"
                                            @pagination-change-page="getParticularCategories"></pagination>
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
    import Form from '../shared/form';
    import submit from '../http/http';
    import {spinner} from "../mixins/helper";
    import Pagination from './shared/Pagination';
    import ListCount from './shared/PaginationListCount';

    export default {
        name: "ParticularCategories",
        mixins: [spinner],
        components: {
            Pagination,
            ListCount
        },
        data() {
            return {
                form: new Form({
                    category: '',
                    type: '',
                }),
                particularTypes: [],
                particularCategories: {data: []}
            };
        },
        methods: {
            addParticularCategory() {
                submit({
                    type: 'post',
                    url: 'add-particular-category',
                    data: this.form,
                    form: true,
                }).then(({data}) => {
                    this.getParticularCategories({url:'get-particular-category'});
                }).catch(response => {

                });
            },
            getParticularTypes() {
                submit({
                    type: 'get',
                    url: 'get-particular-types',
                }).then(({data}) => {
                    this.particularTypes = data.data.particularTypes;
                }).catch(response => {

                });
            },
            getParticularCategories({url}) {
                submit({
                    type: 'get',
                    url: url,
                }).then(({data}) => {
                    this.particularCategories = data;
                }).catch(response => {

                });
            }
        },
        mounted() {
            this.getParticularTypes();
            this.getParticularCategories({url:'get-particular-category'});
        }
    }
</script>

<style scoped>

</style>