<template>
    <section id="bigbg">

        <div class="form">



<div style="width:100%;overflow: hidden;">
<div class="languagechange">
<LanguageComponent/>
</div>
</div>
            <div class="text-center">
                <img style="width: 126px;margin-bottom: 20px;;float: center;" :src="$asseturl+'frontend/img/logos.png?ver=1.0'" alt="">
            </div>
            <h2 class="text-center" style="font-size:30px;    margin-bottom: 16px;">{{ $t('Register.value') }}</h2>

            <form @submit.prevent='register' style="padding-bottom: 70px;">

                <input type="text" v-model="form.name" :placeholder="$t('Please_enter_Name.value')" required></input>

                <!-- <input type="text" v-model="form.country" placeholder="Please Your Country" required> -->
                <select v-model="form.country" class="form-control" :placeholder="$t('Please_select_Your_Country.value')"
                    @change="addcountry" required>
                    <option value="">Select</option>
                    <option v-for="code in codes" :value="code.dial_code">{{ code.name }}</option>
                </select>

                <!-- <span style="color:red" v-if="usernameMatch==0">Username Field is Required!</span>
                <span style="color:red" v-else-if="usernameMatch==1">Opps,Username Already exist,please Enter deferent username</span>
                <span style="color:green" v-else-if="usernameMatch==2">Congratulations,Username is Available</span> -->
                <!-- <input type="text" v-model="form.username" placeholder="Please enter username" @input="usernamecheck" required> -->


                <div class="tel">

                    <span style="width: 55px;padding: 1px 0px 0 4px;">{{ mobileCode }}</span>

                    <input type="tel" style="text-align: left !important;padding-left: 50px;" v-model="form.mobile"
                        :placeholder="$t('Please_enter_a_10_digit_phone_number.value')" required>
                    <!-- <span style="width:10%">+880</span> -->
                </div>




                <div class="d-flex position-relative">
                    <input type="password" v-if="showPassword" name="password" v-model="form.password" required="true"
                    :placeholder="$t('Please_enter_login_password.value')" class="contact-frm active">
                    <input type="text" v-else v-model="form.password" name="password" required="true"
                    :placeholder="$t('Please_enter_login_password.value')" class="contact-frm active">
                    <button class="button position-absolute top-15 end-0" type="button"
                        style="background: transparent;border: 0;"
                        @click="showPassword ? showPassword = false : showPassword = true"><span
                            class="icon is-small is-right">
                            <i class="fas" :class="{ 'fa-eye-slash': showPassword, 'fa-eye': !showPassword }"></i>
                        </span>
                    </button>
                </div>
                <div class="d-flex position-relative">
                    <input type="password" v-if="CshowPassword" name="password" v-model="form.password_confirmation"
                        required="true" :placeholder="$t('Confirm_login_password.value')" class="contact-frm active">
                    <input type="text" v-else v-model="form.password_confirmation" name="password" required="true"
                    :placeholder="$t('Confirm_login_password.value')" class="contact-frm active">
                    <button class="button position-absolute top-15 end-0" type="button"
                        style="background: transparent;border: 0;"
                        @click="CshowPassword ? CshowPassword = false : CshowPassword = true"><span
                            class="icon is-small is-right">
                            <i class="fas" :class="{ 'fa-eye-slash': CshowPassword, 'fa-eye': !CshowPassword }"></i>
                        </span>
                    </button>
                </div>
                <!-- <div class="d-flex position-relative">
<input type="password" v-if="WshowPassword" name="password" v-model="form.withdrawpass"
    required="true" maxlength="6"
    placeholder="Please enter a 6-digit withdrawal password"
    class="contact-frm active">
<input type="text" v-else v-model="form.withdrawpass" name="password" required="true"
    maxlength="6"
    placeholder="Please enter a 6-digit withdrawal password" class="contact-frm active">
<button class="button position-absolute top-15 end-0" type="button" style="background: transparent;border: 0;"
    @click="WshowPassword ? WshowPassword = false : WshowPassword = true"><span
        class="icon is-small is-right">
        <i class="fas"
            :class="{ 'fa-eye-slash': WshowPassword, 'fa-eye': !WshowPassword }"></i>
    </span>
</button>
</div> -->
                <!-- <span style="color:red" v-if="refer==0">Refer Code Field is Required!</span>
                <span style="color:green" v-else-if="refer==1">Congratulations,Refer code is Valid</span>
                <span style="color:red" v-else-if="refer==2">Opps,Refer code is Invalid</span>
                <input type="test" v-model="form.ref_by" placeholder="Please enter recommendation code" @input="refercheck" required > -->
                <div class="d-flex position-relative">
                    <input type="text" v-model="captcha" required="true" :placeholder="$t('Enter_Captcha.value')"
                        class="contact-frm active">
                    <button class="button position-absolute top-15 end-0" type="button"
                        style="    background: #1250c3; border: 0px; color: white;">
                        <span class="icon is-small is-right" style="    font-size: 25px;">
                            {{ genaratedCaptcha }}
                        </span>
                    </button>
                </div>
                <!-- <button class="button" v-bind:disabled="btndis" v-on:click="clicked">Submit</button> -->
                <input type="checkbox" class="checkbox" checked> <span> {{ $t('Rgis_Terms.value') }}</span>
                <input type="submit" :value="$t('Register.value')" class="submit">

                <router-link :to="{name:'/login'}" class="reg">{{ $t('Rgis_Login.value') }}</router-link>

                <!-- <router-link :to="{name:'/login'}">You have an account. Log in now</router-link> -->
            </form>
        </div>
    </section>
</template>
<script>

export default {
    created() {
        this.genaratedCaptcha = Math.random().toString(36).substring(2, 6 + 2);
        // if (User.loggedIn()) {
        //     this.$router.push({ name: 'home' })
        // }
        // localStorage.setItem('dmdevice',1)
        // console.log(this.$route.query.ref);
        if (this.$route.query.ref) {
            this.form.ref_by = this.$route.query.ref;
            this.refer = 1
        } else {
            this.form.ref_by = '1234'
            this.refercheck();
        }
        this.form.country = '+880'
        this.countryList();
        this.addcountry()
    },
    data() {
        return {


            btndis: true,
            captcha: '',
            genaratedCaptcha: '',
            mobileCode: null,
            form: {
                country: null,
                name: null,
                username: null,
                mobile: null,
                password: null,
                password_confirmation: null,
                withdrawpass: '123456',
                ref_by: null,
            },
            usernameMatch: 1,
            refer: 0,
            errors: {},
            codes: {},
            showPassword: true,
            CshowPassword: true,
            WshowPassword: true,
        }
    },
    methods: {
        // setLang(){
        //     localStorage.setItem('language',this.$i18n.locale)
        // },


        async usernamecheck() {
            if (this.form.username == '') {
                this.usernameMatch = 0;
            } else {
                var res = await this.callApi('get', `/api/count/username/check?username=${this.form.username}`, []);
                if (res.data == 0) {
                    this.usernameMatch = 2
                } else {
                    this.usernameMatch = 1
                }
            }
        },
        async countryList() {
            var res = await this.callApi('get', `${this.$asseturl}CountryCodes.json`, []);
            // console.log(res)
            this.codes = res.data
        },
        async addcountry() {
            // this.form.mobile = this.form.country
            this.mobileCode = this.form.country
        },
        async refercheck() {
            if (this.form.ref_by == '') {
                this.refer = 0;
            } else {
                var res = await this.callApi('get', `/api/count/username/check?username=${this.form.ref_by}`, []);
                if (res.data == 0) {
                    this.refer = 2
                } else {
                    this.refer = 1
                }
            }
        },
        register() {
            // if(localStorage.getItem('dmdevice')){
            //     Notification.customError(`This device has already have an account!`);
            // }else{
            if (this.genaratedCaptcha === this.captcha) {
                // if(this.usernameMatch!=2){
                //     Notification.customError('please Enter deferent username');
                // }else{
                if (this.refer != 1) {
                    Notification.customError('Opps,Refer code is Invalid');
                } else {
                    if (this.form.password === this.form.password_confirmation) {
                        axios.post('api/auth/register', this.form)
                            .then(res => {
                                if (res.data == 422) {
                                    Notification.customError('This Phone Number Already Exist');
                                } else if (res.data == 444) {
                                    Notification.customError(`This device has already have an account!`);
                                    localStorage.setItem('dmdevice', 1)
                                } else {
                                    // console.log(res)
                                    if (res.status == 201) {
                                        Notification.customSuccess('Registration Success');
                                        localStorage.setItem('dmdevice', 1)
                                        this.$router.push({ name: '/login' })
                                    } else {
                                        Notification.customError('Something want wrong. Please Try again or contact with admin');
                                    }
                                    // User.responseAfterLogin(res)
                                }
                                // console.log(res.data)
                                // User.responseAfterLogin(res)
                            })
                            .catch(error => this.errors = error.response.data.errors)
                    } else {
                        Notification.customError('Password and Confirm password does not match');
                    }
                }
                // }
            } else {
                Notification.customError('Captcha does not match!');
            }
            // }
        }
    }
}
</script>
<style lang="css" scoped>

.languagechange {
    width: 100px;
    float: right;
}
button.button {
    padding: 7px 5px;
}
</style>
