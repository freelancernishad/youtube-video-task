<template>
    <div>
        <div class="breadcrumbs-area">
            <h3>Settings</h3>
            <ul>
                <li>
                    <router-link to="/dashboard/adddmin">Dashboard</router-link>
                </li>
                <li>Settings</li>
            </ul>
            <button @click="$router.go(-1)" class="btn-fill-md radius-4 text-light bg-orange-red">Back</button>
        </div>
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-50 border-bottom pb-2">Settings Information</h5>
                        <form  @submit.stop.prevent="onSubmit">
                        <div class="row mt-4">





                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Notice</label>
                                            <!-- <vue-editor v-model="form.notice"></vue-editor> -->
                                            <textarea v-model="form.notice" class="form-control" style="resize:none;height:100px;border: 1px solid #262528;"> </textarea>

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">New Registration Bonus</label>
                                            <!-- <vue-editor v-model="form.notice"></vue-editor> -->
                                            <input v-model="form.new_regitration" class="form-control"/>

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Refer Bonus</label>
                                            <!-- <vue-editor v-model="form.notice"></vue-editor> -->
                                            <input v-model="form.refer_bonus" class="form-control"/>

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Min Deposit</label>
                                            <!-- <vue-editor v-model="form.notice"></vue-editor> -->
                                            <input v-model="form.min_deposit" class="form-control"/>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Telegram Group</label>
                                            <!-- <vue-editor v-model="form.notice"></vue-editor> -->
                                            <input v-model="form.telegroup" class="form-control"/>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Telegram Support 1</label>
                                            <!-- <vue-editor v-model="form.notice"></vue-editor> -->
                                            <input v-model="form.telesupport1" class="form-control"/>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Telegram Support 2</label>
                                            <!-- <vue-editor v-model="form.notice"></vue-editor> -->
                                            <input v-model="form.telesupport2" class="form-control"/>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Telegram Support 3</label>
                                            <!-- <vue-editor v-model="form.notice"></vue-editor> -->
                                            <input v-model="form.telesupport3" class="form-control"/>

                                        </div>
                                    </div>

                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Withdraw Text</label>
                                            <input v-model="form.withdrawtext" class="form-control"/>
                                        </div>
                                    </div> -->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Recharge Text</label>
                                            <!-- <vue-editor v-model="form.notice"></vue-editor> -->
                                            <input v-model="form.recharagetext" class="form-control"/>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Task Time</label>
                                            <!-- <vue-editor v-model="form.notice"></vue-editor> -->
                                            <input v-model="form.worktime" class="form-control"/>

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
    mounted() {
        this.getData();
    },data() {
        return {
            form:{
                notice:'',
                new_regitration:'',
                refer_bonus:'',
                min_deposit:'',

            }
        }
    },
    methods: {
        async getData(){

            var res = await this.callApi('get',`/api/admin/setting/1`,[]);
            this.form = res.data;
        },

        async onSubmit(){
            var res = await this.callApi('put', `/api/admin/setting/1`, this.form);
             Notification.customSuccess(`Your data has been Updated`);

            this.getData();
        }
    },
}
</script>
