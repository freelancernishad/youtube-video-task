<template>
    <div>


        <section id="topbar">
            <div class="title">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="fa fa-angle-left"></i></a>
                <p>Password management</p>
                <LanguageComponent/>
            </div>
        </section>

        <section id="account-form">

                <div class="long-title">
                    <p>Change the login password</p>
                </div>

                <div class="container-fluid">
                     <form @submit.stop.prevent="accountPassChange">
                    <label> Old password:</label>
                    <input type="password" class="form-control" v-model="accountPass.old" required placeholder="Please enter the old password">


                    <label>New password:</label>
                    <input type="password" class="form-control" v-model="accountPass.newpass" required placeholder="Please enter new login password">


                    <label>Confirm password:</label>
                    <input type="password" class="form-control" v-model="accountPass.confirm" required placeholder="Please enter new password again">

                    <input type="submit" class="savedata" value="Confirm to modify the login password">

</form>
                </div>
                <div class="long-title">
                    <p>Change withdrawal password</p>
                </div>
                <div class="container-fluid">
<form @submit.stop.prevent="withdrawPassChange">
                    <label>Please enter old withdrawal password (উইথড্র  পাসওয়ার্ড দিয়ে না থাকলে old passward হিসেবে 123456 ব্যবহার করুন  )</label>
                    <input type="password" class="form-control" v-model="withdarawPass.old" required placeholder="Please enter old withdrawal password">


                    <label>Please enter new withdrawal password</label>
                    <input type="password" class="form-control" v-model="withdarawPass.newpass" required placeholder="Please enter new withdrawal password">

                    <input type="submit" class="savedata" value="Confirm to modify the withdrawal password">
</form>
                </div>



        </section>


    </div>
</template>

<script>
export default {
    data() {
        return {
            accountPass: {
                old: '',
                newpass: '',
                confirm: '',
            },
            withdarawPass: {
                old: '',
                newpass: ''
            }
        }
    },
    methods: {


        async accountPassChange(){
            if(this.accountPass.newpass===this.accountPass.confirm){
                var id = localStorage.getItem('userid');
                var res = await this.callApi('post', `/api/admin/user/password/change?id=${id}&type=account`, this.accountPass);
                if(res.data==0){
                    Notification.customError(`Old Password cant be macth`);
                }else{
                    Notification.customSuccess(`Password has been Updated`);
                    this.$router.push({name:'information'});

                }


            }else{
                Notification.customError(`New Password and confirm password cant be macth`);
            }
        },


        async withdrawPassChange(){
            var id = localStorage.getItem('userid');
            var res = await this.callApi('post', `/api/admin/user/password/change?id=${id}&type=withdraw`, this.withdarawPass);

                if(res.data==0){
                    Notification.customError(`Old Password cant be macth`);
                }else{
                    Notification.customSuccess(`Password has been Updated`);
                    this.$router.push({name:'information'});

                }

        }


    },


}
</script>
