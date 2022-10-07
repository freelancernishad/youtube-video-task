<template>
    <div>
        <div class="breadcrumbs-area">
            <h3>Deposit</h3>
            <ul>
                <li>
                    <router-link to="/dashboard/adddmin">Dashboard</router-link>
                </li>
                <li>Deposit</li>
            </ul>
            <button @click="$router.go(-1)" class="btn-fill-md radius-4 text-light bg-orange-red">Back</button>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-50 border-bottom pb-2">Method Information</h5>
                        <form  @submit.stop.prevent="onSubmit">
                        <div class="row mt-4">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" v-model="form.name" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Currency</label>
                                            <input type="text" v-model="form.currency" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Min Amount</label>
                                            <input type="number" v-model="form.min_amount" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Max Amount</label>
                                            <input type="number" v-model="form.max_amount" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Percent Charge</label>
                                            <input type="number" v-model="form.percent_charge" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Process Time</label>
                                            <input type="number" v-model="form.processtime" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Receive Number</label>
                                            <input type="number" v-model="form.number" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group ">
                                        <label class="form-control-label font-weight-bold">Status </label>
                                       <select class="form-control" v-model="form.status" >
                                        <option value="active">Active</option>
                                        <option value="deactive">Deactive</option>
                                       </select>
                                    </div>
                                </div>
                            <div class="col-md-12 mt-4">

                                <button type="submit" class="btn-fill-lmd text-light gradient-dodger-blue">Submit</button>

                            </div>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    created() {
        this.getData();
    },data() {
        return {
            form:{
                name:'',
                currency:'',
                min_amount:'',
                max_amount:'',
                percent_charge:'',
                processtime:'',
                number:'',
                status:'',
            }
        }
    },
    methods: {
        async getData(){
            var id = this.$route.params.id;
            var res = await this.callApi('get',`/api/admin/withdraw/gateway/${id}`,[]);
            this.form = res.data;
        },

        async onSubmit(){
            var id = this.$route.params.id;
            var res = await this.callApi('put', `/api/admin/withdraw/gateway/${id}`, this.form);
             Notification.customSuccess(`Your data has been Updated`);
             this.$router.push({name:'withdrawlMethods'});
            // this.getData();
        }
    },
}
</script>
