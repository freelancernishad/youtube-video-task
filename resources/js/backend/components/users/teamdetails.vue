<template>
    <div>


        <section id="topbar">
            <div class="title">
                       <a href="javascript:void(0)" @click="$router.go(-1)" ><i class="fa fa-angle-left"></i></a>
                <p>Team Report</p>
            </div>
        </section>

        <section id="listmenu">
            <div class="details">
                <div class="container">
                    <div class="detail">
                        <p>Total of Recharge</p>
                        <span>{{ row.depositamount }}</span>
                    </div>
                    <div class="detail">
                        <p>Direct Invites</p>
                        <span>{{ row.Direct_Invites }}</span>
                    </div>
                    <div class="detail">
                        <p>Members</p>
                        <span>{{ row.total_member }}</span>
                    </div>
                    <div class="detail">
                        <p>Active Members</p>
                        <span>{{ row.total_ActiveMember }}</span>
                    </div>
                    <div class="detail">
                        <p> Team task bonus </p>
                        <span>{{ parseFloat(row.refer_task_bonus).toFixed(2)  }}</span>
                    </div>
                    <div class="detail">
                        <p> Team Recharge Bonus </p>
                        <span>{{ parseFloat(row.refer_commisition).toFixed(2)  }}</span>
                    </div>

                </div>
            </div>
        </section>




    </div>
</template>
<script>
export default {
    data(){
        return {
            row:{},
        }
    },
    methods: {
         async getData(){
            var id = localStorage.getItem('userid');
            var res = await this.callApi('get',`/api/front/teamdetails?id=${id}`,[]);
            this.row = res.data;
        },
    },
    mounted() {
            this.getData();

    },
}
</script>
