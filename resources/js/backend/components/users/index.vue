<template>
  <div>



    <section id="topbar">
            <div class="title">
                <a href="javascript:void(0)" @click="$router.go(-1)"></a>
                <p></p>
                <LanguageComponent/>
            </div>
        </section>


<!--
    <section id="slider">
        <img width="100%" :src="slideimage" alt="">
    </section> -->


    <section id="marquee">
      <div class="container-fluid">
        <div class="marquee-area">
          <div class="left-img">
            <img :src="$asseturl+'frontend/img/notice_icon.png'" alt="icon" />
          </div>
          <marquee>{{ settings.notice }}</marquee
          >
          <div class="button right">Notice</div>
        </div>
      </div>
    </section>





    <section id="aui">
      <div class="container-fluid">
        <div class="row">



            <div class="col-md-6">
                <router-link :to="{name:'Recharge'}">
                <div class="card" style="    background: #b0b00a; margin-bottom: 22px;">
                    <div class="card-body">
                        <img width="100%" :src="$asseturl+'frontend/img/recharge.png'" alt="tab" />
                        <h5 class="card-title text-white">{{ $t('Recharge.value') }}</h5>
                    </div>
                </div>
            </router-link>
            </div>




            <div class="col-md-6">
                <router-link :to="{name:'Withdraw'}">
                <div class="card" style="    background: #960baf; margin-bottom: 22px;">
                    <div class="card-body">
                        <img width="100%" :src="$asseturl+'frontend/img/withdraw.png'" alt="tab" />
                        <h5 class="card-title text-white">{{ $t('Withdraw.value') }}</h5>
                    </div>
                </div>
            </router-link>
            </div>

            <div class="col-md-6">
                <router-link :to="{name:'invite'}">
                <div class="card" style="    background: #0b37a6bf; margin-bottom: 22px;">
                    <div class="card-body">
                        <img width="100%" :src="$asseturl+'frontend/img/invite.png'" alt="tab" />
                        <h5 class="card-title text-white">{{ $t('Invite.value') }}</h5>
                    </div>
                </div>
            </router-link>
            </div>


            <div class="col-md-6"  v-if="settings.telegroup">
                <a :href="settings.telegroup">
                <div class="card" style="    background: #0baf4a; margin-bottom: 22px;">
                    <div class="card-body">
                        <img width="100%" :src="$asseturl+'frontend/img/Telegram.png'" alt="tab" />
                        <h5 class="card-title text-white">{{ $t('Official_Telegram_Group.value') }}</h5>
                    </div>
                </div>
            </a>
            </div>


            <div class="col-md-6" v-if="settings.telesupport1">
                <a :href="settings.telesupport1">
                <div class="card" style="    background: #0084d9; margin-bottom: 22px;">
                    <div class="card-body">
                        <img width="100%" :src="$asseturl+'frontend/img/customerSupport.png'" alt="tab" />
                        <h5 class="card-title text-white">{{ $t('elpLine_Support.value') }}</h5>
                    </div>
                </div>
            </a>
            </div>


            <div class="col-md-6" v-if="settings.telesupport2">
                <a :href="settings.telesupport2">
                <div class="card" style="    background: #0084d9; margin-bottom: 22px;">
                    <div class="card-body">
                        <img width="100%" :src="$asseturl+'frontend/img/customerSupport.png'" alt="tab" />
                        <h5 class="card-title text-white">{{ $t('elpLine_Support.value') }}</h5>
                    </div>
                </div>
            </a>
            </div>


            <div class="col-md-6" v-if="settings.telesupport3">
                <a :href="settings.telesupport3">
                <div class="card" style="    background: #0084d9; margin-bottom: 22px;">
                    <div class="card-body">
                        <img width="100%" :src="$asseturl+'frontend/img/customerSupport.png'" alt="tab" />
                        <h5 class="card-title text-white">{{ $t('elpLine_Support.value') }}</h5>
                    </div>
                </div>
            </a>
            </div>



        </div>
      </div>
    </section>






    <section id="announcement">
      <div class="container-fluid">
        <!-- <h3>IDG ID (ID:30369)</h3> -->
        <div class="row">


          <div class="col-12 p-0" v-for="plan in row" :key="plan.id">
            <div class="card" :style="{background: 'linear-gradient(rgb(197 25 25 / 91%), rgb(58 8 8 / 59%)),url('+$asseturl+'frontend/img/vipBg.png)',backgroundPosition: 'center center',backgroundSize: 'contain'}"  style="margin-bottom: 20px;">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title text-white">{{ plan.name }}</h5>
                    <p class="text-white">{{ plan.totalorder }} Orders</p>
                </div>
                <div class="card-body">
                    <span class="planPack text-white"  style="width:40%">কমিশন রেট {{ parseFloat(plan.comission_rate*plan.totalorder).toFixed(2) }}% ({{ plan.start_balance }}TK-{{ plan.end_balance }}TK)</span>

                </div>
            </div>




          </div>

<!--
          <div class="col-md-12">
            <h3 class="text-center">Our Partners</h3>
            <hr>
            <img width="100%" :src="$asseturl+'frontend/img/partners.jpeg'" alt="">
          </div> -->

        </div>
      </div>
    </section>


    <div class="notice" v-if="notice">

<p> <h3>Welcome</h3>
    <br>
    <p v-html="settings.notice"></p>
</p>

        <button class="closebtn" @click="closeNotice">Close</button>
    </div>




  </div>
</template>

<script>


export default {
    created() {
        if(localStorage.getItem('notice')==1){
             this.notice = false
        }
        this.getplans()
        // console.log(this.slider.length)
        var indexx = 1;
        this.slideimage = this.slider[0]
        setInterval(() => {
            if(indexx===this.slider.length)indexx = 0;
            // console.log(indexx);
            this.slideimage = this.slider[indexx]
            indexx++
        }, 5000);

    },
    data(){
        return {
            row:{},
            notice:true,
            slideimage:'',
            settings:{},
            user:{
                user:{}
            },
            slider:[
            this.$asseturl+'frontend/img/Daily-Task-Commisson-Chart.png',
            this.$asseturl+'frontend/img/Refar-Deposit-Bonus.png',
            this.$asseturl+'frontend/img/Refar-Task-income.png',
            this.$asseturl+'frontend/img/Self-Deposit.png'
            ]
        }
    },
    methods: {
        generator(){
        return '#'+(Math.random()*0xFFFFFF<<0).toString(16);
      },

        closeNotice(){
            this.notice = false

        localStorage.setItem('notice',1)

        },

       async getplans(){

        var resN = await this.callApi('get',`/api/admin/setting`,[])
              this.settings = resN.data


            var res = await this.callApi('get',`/api/admin/plan`,[])
            this.row = res.data


             var id = localStorage.getItem('userid');
            var results = await this.callApi('get', `/api/admin/user/${id}`, []);
            this.user = results.data;


        }
    },

}
</script>
<style>

section#topbar .title {
    display: flex !important;
    justify-content: space-between;
    padding: 0 18px;
}

#marquee {
  margin: 24px 0;
}

    .reImage {
        padding: 6px;
background: #e1e1e1;
box-shadow: 0px 0px 10px 0px #0000008c;
    }
    .notice {
    width: 340px;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    background: #f0f0f0;
    padding: 52px 11px;
    z-index: 99;
    border-radius: 10px;
    text-align: center;
}

.closebtn {
  position: absolute;
  bottom: 7px;
  background: transparent;
  border: 2px solid #7683aa;
  border-radius: 6px;
  right: 23px;
}
.plansdesign{
    display: flex;
justify-content: space-between;
}

/* .planPack {
  width: 30%;
} */

</style>
