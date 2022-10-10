<template>
    <div>
        <section id="topbar">
            <div class="title">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="fa fa-angle-left"></i></a>
                <p>{{ $t('Bank_Card.value') }}</p>
                <LanguageComponent />
            </div>
        </section>
        <section id="account-form">
            <form @submit.stop.prevent="onSubmit">


                <div class="long-title">
                    <p style="    background: red;
    color: white;">{{ $t('Please_input_bank_account_information.value') }} </p>
                </div>
                <div class="container-fluid">
                    <div class="form-group">
                        <label>{{ $t('Bank_Name.value') }}</label>
                        <select v-model="row.user.Bank_Name" class="form-control" :disabled="readonly" required>
                            <option value="">Select</option>
                            <option v-for="get in getways" :key="'pay' + get.id" :value="get.id">{{ get.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="form-group">
                        <label><span class="require">*</span> {{ $t('Bank_account.value') }} (Bkash/Nagod/USDT)</label>
                        <input type="text" v-model="row.user.Bank_account" class="form-control"
                            placeholder="Please add an account" :readonly="readonly" required>
                    </div>
                </div>

                <div class="container-fluid">

                    <input type="checkbox" class="checkbox"><span>{{ $t('agr.value') }}</span>
                    <p class="det">{{ $t('BW.value') }}</p>
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
    data() {
        return {
            readonly: false,
            getways: {},
            row: {
                deposit: {},
                depositamount: 0,
                user: {},
                withdraw: {},
                withdrawamount: 0,
                refercount: 0,
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
            if (this.row.user.Bank_account == null || this.row.user.Bank_Name == null) {
                this.readonly = false;
            } else if (this.row.user.Bank_account == '' || this.row.user.Bank_Name == '') {
                this.readonly = false;
            } else {
                this.readonly = true;
            }
        },
        async onSubmit() {
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
