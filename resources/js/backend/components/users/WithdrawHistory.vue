<template>
    <div>


        <section id="topbar">
            <div class="title">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="fa fa-angle-left"></i></a>
                <p>Withdraw History</p>
            </div>
        </section>




        <section id="listmenu">


            <div role="feed" class="van-list" aria-busy="true">

                <div class="recordDiv p-3" v-for="rech in row" :key="'rech'+rech.id">
                    <h3>Withdraw amount： {{ rech.amount }}</h3>
                    <p>Order Number： {{ rech.trx }}</p>
                    <p>Withdraw status： {{ rech.status }}</p>
                    <p>Date： {{ dateformatglobal(rech.created_at)[6] }}</p>
                    <p>Remarks： - </p>
                </div>

            </div>











            <!-- <div class="not-found">No Data</div> -->
        </section>

    </div>
</template>

<script>
export default {
    data(){
        return {
              row: {},

        }
    },
    methods: {



          async getData() {
   var id = localStorage.getItem('userid');
            var res = await this.callApi('get', `/api/admin/withdrawal?id=${id}`, []);
            this.row = res.data;

        },

    copyURL() {
      var Url = this.$refs.mylink;
      Url.innerHTML = window.location.href;
      console.log(Url.innerHTML)
      Url.select();
      document.execCommand("copy");
    }

    },
    mounted() {
            this.getData();

    },
}
</script>
