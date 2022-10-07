<template>
    <div>


    <section id="topbar">
        <div class="title">
           <a href="javascript:void(0)" @click="$router.go(-1)" ><i class="fa fa-angle-left"></i></a>
            <p>Bank Card</p>
        </div>
    </section>

    <section id="account-form">
        <form @submit.stop.prevent="onSubmit">
            <div class="long-title">
                <p>Please enter your identity information</p>
            </div>

            <div class="container-fluid">
                <div class="form-group">

                <label><span class="require">*</span> Your real name</label>
                <input type="text" class="form-control" v-model="row.user.name" placeholder="Your real name" :readonly="readonly" required>
                </div>
            </div>
            <div class="long-title">
                <p>Please input bank account information </p>
            </div>
            <div class="container-fluid">
                <div class="form-group">
                <label>Bank Name</label>
                <select v-model="row.user.Bank_Name"  class="form-control" :disabled="readonly" required>
                    <option value="">Select</option>
                    <option v-for="get in getways" :key="'pay' + get.id" :value="get.id">{{ get.name }}</option>
                </select>
                </div>
            </div>
            <div class="container-fluid">
                <div class="form-group">
                <label><span class="require">*</span> Bank account (Bkash/Nagod/USDT)</label>
                <input type="text" v-model="row.user.Bank_account"  class="form-control" placeholder="Please add an account" :readonly="readonly" required>
</div>


            </div>
            <div class="long-title">
                <p>Verify withdrawal password</p>  </div>
                <div class="container-fluid">
                    <div class="form-group">
                    <label><span class="require">*</span>Withdrawal password</label>
                    <input type="text" v-model="row.user.withdrawpass"  class="form-control" placeholder="" :readonly="readonly" required>
</div>
                    <input type="checkbox" class="checkbox"><span>I have agreed to the service agreement</span>
                    <p class="det">প্রিয় সদস্য আপনি শুধু মাত্র একবার আপনার ব্যাংক কার্ড সেটিং করতে পারবেন। তাই সাবমিট করার পূবে ভালো করে দেখে নিন। </p>

                            <input type="submit" class="savedata" value="Save information">

                </div>


        </form>

    </section>


    </div>
</template>
<script>
export default {

    created() {

    },

    data(){
        return {
            readonly:false,
            getways:{},
            row: {
                deposit:{},
                depositamount:0,
                user:{},
                withdraw:{},
                withdrawamount:0,
                refercount:0,
            },
        }
    },
    methods: {
          async getData() {
             var id = localStorage.getItem('userid');
            var res = await this.callApi('get', `/api/admin/user/${id}`, []);
            this.row = res.data;


            var getway = await this.callApi('get', `/api/admin/withdraw/gateway`, []);
            this.getways = getway.data;

        if(this.row.user.Bank_account==null || this.row.user.Bank_Name==null){
            this.readonly = false;
        }else if(this.row.user.Bank_account=='' || this.row.user.Bank_Name==''){
            this.readonly = false;
        }else{

            this.readonly = true;
        }


        },
        async onSubmit(){
            var id = localStorage.getItem('userid');
            var res = await this.callApi('put', `/api/admin/user/${id}`, this.row.user);
             Notification.customSuccess(`Your data has been Updated`);
            this.getData();
        }


    },
    mounted() {
            this.getData();

    },
}
</script>
<style>

.long-title {
  margin-top: 22px;
}
.long-title p {
  font-size: 17px !important;
}
</style>
