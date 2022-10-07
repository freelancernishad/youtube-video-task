<template>
    <div>

        <section id="account-area">
            <div class="container-fluid">
                <div class="settings">
                  <a href="javascript:void(0)" @click="$router.go(-1)" >
                    <img style="width: 46px;float: right;" :src="$asseturl+'frontend/img/logos.png'" alt="">
                  <i class="fa fa-angle-left"></i></a>
                </div>
                <div class="acc-details"><img :src="$asseturl+'frontend/img/avater.png'">
                    <p>{{ row.user.name }} <br>{{ row.plans.name }} <br> Invitation code: {{ row.user.username }}</p>
                </div>
            </div>
            <div class="imagesection">
                <div class="taka">
                    <div class="row">
                        <div class="col-6" style="text-align: center;padding: 20px 2px;">
                            <p> Task income: </p><span>TK{{ parseFloat(row.taskearn).toFixed(2) }}</span>
                        </div>
                        <div class="col-6" style="text-align: center;padding: 20px 2px;">
                            <p> balance: </p><span>TK{{ parseFloat(row.user.balance).toFixed(2) }}</span>
                        </div>

                    </div>
                </div>
                <!-- <img :src="$asseturl+'frontend/img/bg2.png'"> -->
            </div>
        </section>


        <section id="btn-area">

            <div class="row">
                <div class="col-6 p-0"> <router-link :to="{name:'Recharge'}">Recharge</router-link></div>
                <div class="col-6 p-0"> <router-link :to="{name:'Withdraw'}">Withdraw</router-link></div>
            </div>


        </section>
        <section id="accounDetlist">
            <div class="container-fluid">
                <ul>
                    <li><router-link :to="{name:'license'}" ><img src="https://petpat.lv/wp-content/uploads/2018/12/license-icon-27934542-2.png">
                            <p>Company Profiles</p></router-link>
                    </li>

                    <li><router-link :to="{name:'information'}"><img :src="$asseturl+'frontend/img/inf.png'">
                            <p>Information</p>
                        </router-link></li>
                    <li><router-link :to="{name:'orders'}"><img :src="$asseturl+'frontend/img/order.png'">
                            <p>Order Record</p>
                        </router-link></li>
                    <li><router-link :to="{name:'rechargeHistory'}"><img :src="$asseturl+'frontend/img/rech.png'">
                            <p>Recharge History</p>
                        </router-link></li>
                    <li><router-link :to="{name:'WithdrawHistory'}"><img :src="$asseturl+'frontend/img/with.png'">
                            <p>Withdraw History</p>
                        </router-link></li>
                    <!-- <li><router-link :to="{name:'help'}"><img :src="$asseturl+'frontend/img/ann.png'">
                            <p>Announcement</p>
                        </router-link></li> -->

                    <li><router-link :to="{name:'invite'}"><img :src="$asseturl+'frontend/img/5811623.png'">
                            <p>Invite</p>
                        </router-link></li>

                    <li><a href="https://t.me/+iO84tmrv8JNkZTRl" target="_blank"><img :src="$asseturl+'frontend/img/Telegram.png'">
                            <p>Official Telegram Group</p>
                        </a></li>

                    <li><a href="https://t.me/DreamlandCustomersurvice" target="_blank"><img :src="$asseturl+'frontend/img/aGroup.jpeg'">
                            <p>Customer Service 1</p></a>
                    </li>

                    <li><a href="https://t.me/Dreamland_Millye" target="_blank"><img src="https://cdn5.vectorstock.com/i/1000x1000/01/69/businesswoman-character-avatar-icon-vector-12800169.jpg">
                            <p>Customer Service 2</p></a>
                    </li>


<!--
                    <li><a href="https://t.me/DreamlandcustomerSurvice2" target="_blank"><img :src="$asseturl+'frontend/img/supGroup.jpeg'">
                            <p>Customer Service 2</p></a>
                    </li> -->

                    <!-- <li><a href="https://t.me/markosuportmanager" target="_blank"><img :src="$asseturl+'frontend/img/supGroup.jpeg'">
                            <p>Support Manager</p>
                        </a></li> -->


                </ul>
                <router-link :to="{name:'logout'}" class="logout">Log out</router-link>
            </div>


        </section>

    </div>
</template>
<script>
export default {
    data(){
        return {
              row: {
                plans:{},
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

        },



    },
    mounted() {
            this.getData();

    },
}
</script>
