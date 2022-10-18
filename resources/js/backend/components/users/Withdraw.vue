<template>
    <div>
        <section id="topbar">
            <div class="title">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="fa fa-angle-left"></i></a>
                <p>Withdraw</p>
                <LanguageComponent/>
            </div>
        </section>
        <section id="reclist">
            <div class="details">
                <div class="container-fluid">
                    <div v-if="step == 1">

                        <div class="form-group">
                            <label for="">Withdraw Method</label>
                            <select class="form-control" v-model="form.method" @change="charageCount" disabled required>
                                <option value="">Select</option>
                                <option v-for="pay in row" :to="{ name: 'RechargePage', params: { method: pay.id } }"
                                    :key="'pay' + pay.id" :value="pay.id">{{  pay.name  }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Withdraw Amount</label>
                            <input type="tel" class="form-control" @input="checkAmount(form.amount)"
                                v-model="form.amount">
                        </div>
                        <p> Available Balance : {{  user.user.balance - settings.new_regitration  }} </p>
                        <!-- <div class="row">
                            <div class="col-6 amount_item" @click="checkAmount(500)"><span>500</span> </div>
                            <div class="col-6 amount_item" @click="checkAmount(1000)"><span>1000</span></div>
                        </div> -->
                        <div class="form-group mb-3" v-if="gateways">
                            <label for="">{{  gateways.name  }} Number</label>
                            <input type="number" class="form-control" v-model="form.recieved_number" readonly>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-info" v-if="bankcardAlert" disabled >Wait...</button>
                            <button class="btn btn-info" v-else @click="nextFun(2)">Next</button>
                        </div>
                        <p style="color: red;text-align: center;font-size: 17px;">প্রত্যাহার সময় সপ্তাহের সোমবার থেকে শুক্রবার দুপর ০২:০০ থেকে রাত ০৬:০০ টা পর্যন্ত </p>
                        <p style="color: red;text-align: center;font-size: 17px;">প্রত্যাহার প্রসেসিং ফি {{ gateways.percent_charge }}% এবং
                            প্রত্যাহার {{ gateways.processtime }} ঘন্টার মধ্যে একাউন্ট এ পৌছাবে</p>
                    </div>
                    <form @submit.stop.prevent="onSubmit" v-else-if="step == 2">
                        <h4 class="d-block bg-success text-white p-1 my-3">Payment Info</h4>
                        <div class="patment_info">
                            <ul class="list-unstyled">
                                <li class="li"><span>{{  gateways.name  }} Account</span><span>{{  form.recieved_number
                                        }}</span></li>
                                <li class="li"><span>Amount</span><span>{{  form.amount  }}</span></li>
                                <li class="li"><span>Charge</span><span>{{  charge  }}</span></li>
                                <li class="li"><span>Payable Amount</span><span>{{  Payable  }}</span></li>
                                <li class="li"><span>New balance</span><span>{{  balance  }}</span></li>
                            </ul>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-secondary" @click="nextFun(1)">Previous</button>

                            <button class="btn btn-info" type="button" disabled v-if="con">Wait....</button>
                            <button class="btn btn-info" type="submit" v-else>Confirm Withdraw</button>

                        </div>
                    </form>
                    <!-- <router-link v-for="pay in row" :to="{name:'RechargePage',params:{method:pay.id}}" :key="'pay'+pay.id"><img :src="pay.image"></router-link> -->
                </div>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data() {
        return {
            form: {
                method: '',
                amount: '',
                recieved_number: '',
                trx: '',
            },
            settings: {},
            row: {},
            user: {user:{}},
            con: false,
            step: 1,
            gateways: {},
            charge: 0,
            Payable: 0,
            balance: 0,
            copyMessage: '',
            bankcardAlert: true,
        }
    },
    methods: {

        async setting(){
            var resN = await this.callApi('get',`/api/admin/setting`,[])
              this.settings = resN.data
        },
        checkAmount(amount) {
            if (amount > this.user.user.balance - this.settings.new_regitration) {
                Notification.customError(`You can't Withdraw ${amount}.Because your account balance is ${this.user.user.balance - this.settings.new_regitration}`);
                this.form.amount = '';
            } else {
                this.form.amount = amount;
            }
        },
        async charageCount() {
            var res = await this.callApi('get', `/api/admin/withdraw/charge/${this.form.method}`, []);
            this.gateways = res.data;
        },
        FileSelected($event, parent_index) {
            let file = $event.target.files[0];
            if (file.size > 5048576) {
                Notification.image_validation();
            } else {
                let reader = new FileReader;
                reader.onload = event => {
                    this.form[parent_index] = event.target.result
                    // console.log(event.target.result);
                };
                reader.readAsDataURL(file)
            }
            //   console.log($event.target.result);
        },
        async getData() {
            var res = await this.callApi('get', `/api/admin/withdraw/gateway`, []);
            this.row = res.data;
            var id = localStorage.getItem('userid');
            var result = await this.callApi('get', `/api/admin/user/${id}`, []);
            this.user = result.data;
            this.form.method = this.user.user.Bank_Name
            this.form.recieved_number = this.user.user.Bank_account
            this.charageCount()
            this.bankcardAlert = false
        },
        async nextFun(step) {
            if (step == 2) {
                if (this.form.method == '') {
                    Notification.customError('Method is required');
                } else {
                    if (this.form.amount == '') {
                        Notification.customError('Amount is required');
                    } else {

                    if(Number(this.form.amount)<Number(this.gateways.min_amount)) {
                        Notification.customError('Minimum Withdrawal Amount '+this.gateways.min_amount+' BDT');
                    }else {
                        this.step = step;
                        var charge = ((this.form.amount * this.gateways.percent_charge) / 100);
                        // console.log(charge)
                        this.charge = charge;
                        this.Payable = this.form.amount - charge;
                        this.balance = this.user.user.balance - this.form.amount;
                    }


                    }
                }
            } else {
                this.step = step;
            }
        },
        async onSubmit() {
            this.con = true

            if(Number(this.form.amount)<Number(this.gateways.min_amount)) {
                        Notification.customError('Minimum Withdrawal Amount '+this.gateways.min_amount+' BDT');
                    }else {
                        var id = localStorage.getItem('userid');
                        this.form['user_id'] = id;
                        this.form['curency'] = this.gateways.currency;
                        this.form['rate'] = this.gateways.rate;
                        this.form['charge'] = this.charge;
                        this.form['final_amount'] = this.balance;
                        this.form['after_charge'] = this.Payable;
                        var res = await this.callApi('post', `/api/admin/withdrawal`, this.form);
                        if(res.data==422){
                            Notification.customError('Falied! withdraw cant be proccess.You must make a reachage first!');
                        }else if(res.data==444){
                            Notification.customError('Falied! withdraw cant be proccess.');
                        }else{
                            Notification.customSuccess(`Withdraw Successfuly Complete`);
                            this.$router.push({ name: 'WithdrawHistory' });
                        }

                    }


        }
    },
    mounted() {
        this.getData();
        this.setting();



// 10:00<10:01
// console.log(User.dateformat()[9]);




        if(User.dateformat()[9]<=17){
            if(User.dateformat()[9]>=14){

                setTimeout(() => {
                    if(!this.form.method){
                        alert('Please add Bank card first');
                        this.$router.push({ name: 'bankAccount' });
                    }
                }, 5000);
            }else{
            alert('প্রত্যাহার সময় সপ্তাহের সোমবার থেকে শুক্রবার দুপর ০২:০০ থেকে রাত ০৬:০০ টা পর্যন্ত')

                this.$router.push({ name: 'Authuser' });


            }
        }else{
            alert('প্রত্যাহার সময় সপ্তাহের সোমবার থেকে শুক্রবার দুপর ০২:০০ থেকে রাত ০৬:০০ টা পর্যন্ত')
            this.$router.push({ name: 'Authuser' });

        }



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
