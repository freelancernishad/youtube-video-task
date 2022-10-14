<template>
    <div>
        <h1 v-if="Frontloader">loading....</h1>

    <!-- <section id="call">
      <img :src="$asseturl+'frontend/img/phone.png'" alt="phone" />
    </section> -->

        <slot></slot>

<section style="padding: 40px;"></section>
        <section id="menus">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 p-0" style="width: 20% !important;">
                        <div class="menu">
                            <router-link :to="{name:'Authuser'}">
                                <img :src="$asseturl+'frontend/img/home.png?ver=1.0'" alt="Home">
                                <p>Home</p>
                            </router-link>
                        </div>
                    </div>
                    <div class="col-3 p-0" style="width: 20% !important;">
                        <div class="menu">
                            <router-link :to="{name:'UserTeam'}">
                                <img :src="$asseturl+'frontend/img/team.png?ver=1.0'" alt="Home">
                                <p>Team</p>
                            </router-link>
                        </div>
                    </div>
                    <div class="col-3 p-0" style="width: 20% !important;">
                        <div class="menu" style="position: relative;">
                            <router-link :to="{name:'Usertask'}" style="position: absolute;bottom: -37px;left: 13%;background: white;padding: 6px;border-top-left-radius: 30px;border-top-right-radius: 30px;">
                                <img style="width: 46px;height: 42px;" :src="$asseturl+'frontend/img/Task.png?ver=1.0'" alt="Home">
                                <p>Earn</p>
                            </router-link>
                        </div>
                    </div>
                    <div class="col-3 p-0" style="width: 20% !important;">
                        <div class="menu">
                            <a :href="$asseturl+'JMY_EARN_MONEY_16135694.apk'">
                                <img :src="$asseturl+'frontend/img/android.png?ver=1.0'" alt="Home">
                                <p>App</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-3 p-0" style="width: 20% !important;">
                        <div class="menu">
                            <router-link :to="{name:'Useraccount'}">
                                <img :src="$asseturl+'frontend/img/profile.png?ver=1.0'" alt="Home">
                                <p>Account</p>
                            </router-link>
                        </div>
                    </div>


                </div>
            </div>
        </section>

    </div>
</template>
<script>
  export default {
    created() {
                this.createlink('frontend/css/bootstrap.min.css');
        this.createlink('frontend/css/style.css');
        this.createlink('frontend/css/font-awesome.min.css');

        this.createscript('frontend/js/bootstrap.bundle.min.js');
        this.createscript('frontend/js/bootstrap.min.js');
    },
    data(){
        return {

        }},
    watch: {
        '$route': {
            handler(newValue, oldValue) {
                window.scrollTo(0,0);
            },
            deep: true
        }
    },
    mounted() {


    },
    methods: {
        createlink(url=''){
            let recaptchaScript = document.createElement('link')
            recaptchaScript.setAttribute('href', this.$asseturl+url)
            recaptchaScript.setAttribute('rel', 'stylesheet')
            document.head.appendChild(recaptchaScript)
        },
        createscript(url=''){
            let recaptchaScript = document.createElement('script')
            recaptchaScript.setAttribute('src', this.$asseturl+url)
            document.body.appendChild(recaptchaScript)
        }
    }
  }
</script>
<style>
.col-6.amount_item span {
  border: 2px solid #e8ba31;
  display: block;
  text-align: center;
  margin: 6px 0px;
  padding: 4px 3px;
  cursor: pointer;
}
</style>
