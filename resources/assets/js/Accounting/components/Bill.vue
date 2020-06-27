<template>
    <div>
        <div class="col-sm-12">

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Bill</h3>
                </div>

                <!--No Label Form-->
                <!--===================================================-->
                <form method="post" @submit.prevent="addCashBookEntry">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input id="amount" v-model="form.amount" type="text" class="form-control"/>
                            <!--<small class="text-danger" v-if="!form.has('amount')">{{-->
                            <!--form.errors.get('amount') }}-->
                            <!--</small>-->
                        </div>
                        <div class="form-group">
                            <label for="remark">Remarks</label>
                            <input id="remark" v-model="form.remarks" type="text" class="form-control"/>
                            <!--<small class="text-danger" v-if="!form.has('remarks')">{{-->
                            <!--form.errors.get('remarks') }}-->
                            <!--</small>-->
                        </div>
                    </div>

                    <div class="panel-footer text-right">
                        <button class="btn btn-primary">Save Bill</button>
                    </div>
                </form>
                <!--===================================================-->
                <!--End No Label Form-->

            </div>
        </div>
    </div>
</template>

<script>
    import Form from "../shared/form";

    export default {
        name: "Bill",
        data() {
            return {
                form: new Form({
                    remarks: '',
                    amount: '',
                })
            }
        }
    }
</script>

<style scoped>

</style>