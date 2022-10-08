<template>
    <div>

<!--
  <section id="orders">
   <div class="order-record">

    <div class="container-fluid">
      <h2>Order Record</h2>
      <p>This data is provided by Groupon buy official <br><span>Remaining available assets</span></p>

<div id="level">


  <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
        type="button" role="tab" aria-controls="pills-home" aria-selected="true">All</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
        type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Processing</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
        type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Completed</button>
    </li>
  </ul>



  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"></div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"></div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"></div>
  </div>
</div>

    </div>


   </div>
  </section> -->

 <section id="topbar">
            <div class="title">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="fa fa-angle-left"></i></a>
                <p>Order Record</p>
            </div>
        </section>




        <section id="listmenus">


            <div role="feed" class="van-list row" aria-busy="true">

                <div class="col-md-6" v-for="task in row.task" :key="'task'+task.id">

                    <div class="card" :style="{backgroundColor:generator()}" style="margin-bottom: 20px">
<div class="card-body">

                    <p class="text-dark">Date： {{ dateformatglobal(task.created_at)[6] }}</p>
                    <p class="text-dark">Task Comisition：  {{ task.task_comisition }} TK</p>
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
        generator(){
        return '#'+(Math.random()*0xFFFFFF<<0).toString(16);
      },

          async getData() {
   var id = localStorage.getItem('userid');
            var res = await this.callApi('get', `/api/admin/task?id=${id}`, []);
            this.row = res.data;

        },



    },
    mounted() {
            this.getData();

    },
}
</script>

<style>
.recordDiv.p-3 {
  border-bottom: 1px solid white;
}
</style>
