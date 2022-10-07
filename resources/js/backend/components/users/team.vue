<template>
    <div>


        <section id="topbar">
            <div class="title">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="fa fa-angle-left"></i></a>
                <p>Team Report</p>
            </div>
        </section>

        <section id="listmenu">
            <div class="container-fluid">
                <div class="row mt-5">
                    <div class="col-md-6">


                        <router-link :to="{ name: 'teamdetails' }">
                            <div class="card">
                                <div class="card-body">
                                    Team details
                                </div>
                            </div>
                        </router-link>


                    </div>
                    <div class="col-md-6">


                        <router-link :to="{ name: 'teamMember' }">
                            <div class="card">
                                <div class="card-body">
                                    Team members
                                </div>
                            </div>
                        </router-link>


                    </div>
                    <!-- <li><router-link :to="{name:'teamIntro'}">Team Introduction</router-link></li> -->
                </div>
            </div>
        </section>


    </div>
</template>
