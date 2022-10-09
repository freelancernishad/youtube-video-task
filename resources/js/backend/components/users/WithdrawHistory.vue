<template>
    <div>


        <section id="topbar">
            <div class="title">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="fa fa-angle-left"></i></a>
                <p>Withdraw History</p>
                <LanguageComponent/>
            </div>
        </section>




        <section id="listmenus">



            <div role="feed" class="van-list row" aria-busy="true">
                <div class="recordDiv col-md-6" v-for="rech in row" :key="'rech'+rech.id">
                    <div class="card text-dark" :style="{backgroundColor:generator()}" style="margin-bottom: 20px">
                        <div class="card-header">
                            <h5 class="card-title">Withdraw amount： {{ rech.amount }} </h5>
                        </div>
                        <div class="card-body">
                            <p>Order Number： {{ rech.trx }}</p>
                    <p>Withdraw status： {{ rech.status }}</p>
                    <p>Date： {{ dateformatglobal(rech.created_at)[6] }}</p>
                        </div>
                        <div class="card-footer">
                            <p>Remarks： - {{ rech.admin_feedback }}</p>
                        </div>
                    </div>
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

        generator() {
            return '#' + (Math.random() * 0xFFFFFF << 0).toString(16);
        },

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
