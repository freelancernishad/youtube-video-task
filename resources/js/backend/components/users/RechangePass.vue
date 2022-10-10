<template>
    <div>


        <section id="topbar">
            <div class="title">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="fa fa-angle-left"></i></a>
                <p>{{ $t('Password_Management.value') }}</p>
                <LanguageComponent/>
            </div>
        </section>

        <section id="account-form">

                <div class="long-title">
                    <p style="    background: red;
    color: white;">{{ $t('Change_the_login_password.value') }}</p>
                </div>

                <div class="container-fluid">
                     <form @submit.stop.prevent="accountPassChange">
                    <label> {{ $t('Old_password.value') }}</label>
                    <input type="password" class="form-control" v-model="accountPass.old" required :placeholder="$t('Please_enter_the_old_password.value')">


                    <label>{{ $t('New_password.value') }}</label>
                    <input type="password" class="form-control" v-model="accountPass.newpass" required :placeholder="$t('Please_enter_new_login_password.value')">


                    <label>{{ $t('Confirm_password.value') }}</label>
                    <input type="password" class="form-control" v-model="accountPass.confirm" required :placeholder="$t('Please_enter_new_password_again.value')">

                    <input type="submit" class="savedata" :value="$t('Confirm_to_modify_the_login_password.value')">

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
