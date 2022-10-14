<template>
    <div>


        <section id="topbar">
            <div class="title">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="fa fa-angle-left"></i></a>
                <p>{{ $t('Recharge.value') }}</p>
                <LanguageComponent/>
            </div>
        </section>

        <section id="reclist">
            <div class="details">
                <div class="container-fluid">


                    <form @submit.stop.prevent="onSubmit">


                        <div class="form-group">
                            <label for="">{{ $t('Recharge_Amount.value') }}</label>
                            <input type="tel" class="form-control" v-model="form.amount" >
                        </div>

                        <p style="color: red;text-align: center;font-size: 17px;">{{ settings.recharagetext }}</p>

                        <button class="btn btn-info" type="button" disabled v-if="con">Wait...</button>
                        <button class="btn btn-info" type="submit" v-else>Submit</button>

                    </form>





                    <!-- <router-link v-for="pay in row" :to="{name:'RechargePage',params:{method:pay.id}}" :key="'pay'+pay.id"><img :src="pay.image"></router-link> -->

                </div>
            </div>
        </section>


                <div class="copyPopup" v-if="popup">
                    <span> Number copied success</span>
                </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
               popup:false,
            form: {
                amount: '',
            },
            row: {},
            settings: {},
            payMethods: '',
            amount: 0,
            step: 1,
            copyMessage:'',
            rates:'',
            con:false,
        }
    },
    methods: {

        async setting(){
            var resN = await this.callApi('get',`/api/admin/setting`,[])
              this.settings = resN.data
        },

        async onSubmit() {


            if(this.settings.min_deposit>Number(this.form.amount)){
                Notification.customError(`Minimum deposit amount ${this.settings.min_deposit}`);
            }else{
                this.form['userid'] = localStorage.getItem('userid')
                var res = await this.callApi('post', `/api/pay`, this.form);
                window.location.href=res.data
            }



        },
    },
    mounted() {
        this.setting();

    },
}
</script>
<style>
.mainitem {
    display: flex !important;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
}


</style>
