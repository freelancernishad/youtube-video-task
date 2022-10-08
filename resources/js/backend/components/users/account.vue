<template>
    <div>


        <section id="topbar">
            <div class="title">
                <a href="javascript:void(0)" @click="$router.go(-1)" ><i class="fa fa-angle-left"></i></a>
                <p>My Account</p>
            </div>
        </section>


        <section class="accontDetails">
            <div class="row">
                <div class="col-md-6">


                            <h6 class="card-title">Name : {{ row.user.name }}</h6>
                            <h6 class="card-title">Plan : {{ row.plans.name }}</h6>
                            <h6 class="card-title">Invitation code : {{ row.user.username }}</h6>

                </div>
                <div class="col-md-6">

                            <h6 class="card-title">Task income : {{ parseFloat(row.taskearn).toFixed(2) }}</h6>
                            <h6 class="card-title">Balance : {{ parseFloat(row.user.balance).toFixed(2) }}</h6>


                </div>
            </div>
        </section>





        <section id="btn-area">

            <div class="row">
                <div class="col-6 p-0"> <router-link :to="{name:'Recharge'}">Recharge</router-link></div>
                <div class="col-6 p-0"> <router-link :to="{name:'Withdraw'}">Withdraw</router-link></div>
            </div>


        </section>
        <section id="accounDetlist">
            <!-- <div class="container-fluid"> -->

                <ul>
                    <li><router-link :to="{name:'license'}" class="accountList listCompanny" ><img src="https://petpat.lv/wp-content/uploads/2018/12/license-icon-27934542-2.png">
                            <p>Company Profiles</p></router-link>
                    </li>

                    <li><router-link :to="{name:'information'}" class="accountList listInformaion"><img :src="$asseturl+'frontend/img/inf.png'">
                            <p>Information</p>
                        </router-link></li>
                    <li><router-link :to="{name:'orders'}" class="accountList listorder"><img :src="$asseturl+'frontend/img/order.png'">
                            <p>Order Record</p>
                        </router-link></li>
                    <li><router-link :to="{name:'rechargeHistory'}" class="accountList listReHis"><img :src="$asseturl+'frontend/img/rech.png'">
                            <p>Recharge History</p>
                        </router-link></li>
                    <li><router-link :to="{name:'WithdrawHistory'}" class="accountList listWithHis"><img :src="$asseturl+'frontend/img/with.png'">
                            <p>Withdraw History</p>
                        </router-link></li>
                    <!-- <li><router-link :to="{name:'help'}"><img :src="$asseturl+'frontend/img/ann.png'">
                            <p>Announcement</p>
                        </router-link></li> -->

                    <li><router-link :to="{name:'invite'}" class="accountList listInvite"><img :src="$asseturl+'frontend/img/5811623.png'">
                            <p>Invite</p>
                        </router-link></li>

                    <li><a href="https://t.me/+iO84tmrv8JNkZTRl" class="accountList listTeleGroup" target="_blank"><img :src="$asseturl+'frontend/img/Telegram.png'">
                            <p>Official Telegram Group</p>
                        </a></li>

                    <li><a href="https://t.me/DreamlandCustomersurvice" class="accountList listCus1" target="_blank"><img :src="$asseturl+'frontend/img/aGroup.jpeg'">
                            <p>Customer Service 1</p></a>
                    </li>

                    <li><a href="https://t.me/Dreamland_Millye" class="accountList listCus2" target="_blank"><img src="https://cdn5.vectorstock.com/i/1000x1000/01/69/businesswoman-character-avatar-icon-vector-12800169.jpg">
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
            <!-- </div> -->


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

<style>

section.accontDetails {
    background: #008dff;
    color: white;
    padding: 32px 16px;
    margin-top: -40px;
}

a.accountList {
    color: white !important;
}


a.accountList.listCompanny {
    background: #af1616 !important;
}

a.accountList.listInformaion {}

a.accountList.listInformaion {
    background: #af165b !important;
}

a.accountList.listorder {
    background: #9516af !important;
}

a.accountList.listReHis {
    background: #5616af !important;
}

a.accountList.listWithHis {
    background: #2716af !important;
}

a.accountList.listInvite {
    background: #1653af !important;
}

a.accountList.listCus1 {
    background: #16af56 !important;
}

a.accountList.listTeleGroup {
    background: #1692af !important;
}

a.accountList.listCus2 {
    background: #82af16 !important;
}




a.accountList.listCompanny:hover {
    background: #d51919 !important;
}



a.accountList.listInformaion:hover {
    background: #d7186e !important;
}

a.accountList.listorder:hover {
    background: #bd1cde !important;
}

a.accountList.listReHis:hover {
    background: #6719d4 !important;
}

a.accountList.listWithHis:hover {
    background: #2f17e2 !important;
}

a.accountList.listInvite:hover {
    background: #1c69dc !important;
}

a.accountList.listCus1:hover {
    background: #19d969 !important;
}

a.accountList.listTeleGroup:hover {
    background: #1ab3d5 !important;
}

a.accountList.listCus2:hover {
    background: #97cc1a !important;
}




</style>
