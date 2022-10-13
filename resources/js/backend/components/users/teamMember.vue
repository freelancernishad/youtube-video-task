<template>
  <div>
    <section id="topbar">
      <div class="title">
        <a href="javascript:void(0)" @click="$router.go(-1)"><i class="fa fa-angle-left"></i></a>
        <p>{{ $t('Team_Report.value') }}</p>
        <LanguageComponent/>
      </div>
    </section>
    <section id="listmenus">
      <div id="level">
        <div class="container-fluid">
          <div class="containerBorder">
            <ul class="nav nav-pills mb-3 nav-fill" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link navlinks active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                  type="button" role="tab" aria-controls="pills-home" aria-selected="true">Level 1</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link navlinks" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                  type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Level 2</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link navlinks" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                  type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Level 3</button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">




                <div class="row">
                  <div class="col-md-6" v-for="member in row.level1" :key="'level1'+member.id">
                    <div class="card text-white" :style="{backgroundColor:'#cd4ca9'}" style="margin-bottom:20px">
                      <div class="card-body">
                          <span style="font-size: 21px;"> Username : {{ member.username }} </span> <br />
                          <span> Recharge : <Counting :member-id="member.id" member-type="Recharge"></Counting> </span> <br />
                          <span> Withdraw : <Counting :member-id="member.id" member-type="withdraw"></Counting> </span> <br />
                          <span> Task progress : <Counting :member-id="member.id" member-type="task"></Counting> </span>
                          <br />
                          <span> Join Date : {{ dateformatglobal(member.created_at)[6] }} </span>
                      </div>
                    </div>

                  </div>
                </div>



              </div>
              <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row">
                  <div class="col-md-6" v-for="member in row.level2[0]" :key="'level12'+member.id">
                    <div class="card" :style="{backgroundColor:'#cd4ca9'}" style="margin-bottom:20px">
                      <div class="card-body">
                    <span style="font-size: 21px;"> Username : {{ member.username }} </span> <br />
                    <span> Recharge : <Counting :member-id="member.id" member-type="Recharge"></Counting> </span> <br />
                    <span> Withdraw : <Counting :member-id="member.id" member-type="withdraw"></Counting> </span> <br />
                    <span> Task progress : <Counting :member-id="member.id" member-type="task"></Counting> </span>
                    <br />
                    <span> Join Date : {{ dateformatglobal(member.created_at)[6] }} </span>
                  </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="row">
                  <div class="col-md-6" v-for="member in row.level3[0]" :key="'level3'+member.id">
                    <div class="card" :style="{backgroundColor:'#cd4ca9'}" style="margin-bottom:20px">
                      <div class="card-body">
                    <span style="font-size: 21px;"> Username : {{ member.username }} </span> <br />
                    <span> Recharge : <Counting :member-id="member.id" member-type="Recharge"></Counting> </span> <br />
                    <span> Withdraw : <Counting :member-id="member.id" member-type="withdraw"></Counting> </span> <br />
                    <span> Task progress : <Counting :member-id="member.id" member-type="task"></Counting> </span>
                    <br />
                    <span> Join Date : {{ dateformatglobal(member.created_at)[6] }} </span>
                  </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Counting from './counting.vue';
export default {
  components: {
    Counting
  },
  data() {
    return {
      row: {
        level1: {},
        level2: {},
        level3: {},
      },
      datas: {
        Recharge: 0,
        withdraw: 0,
        task: 0,
      }
    }
  },
  methods: {
    async getData() {
      var id = localStorage.getItem('userid');
      var res = await this.callApi('get', `/api/user/multi/refer?id=${id}`, []);
      this.row = res.data;
    },

    generator(){
        return '#'+(Math.random()*0xFFFFFF<<0).toString(16);
      }

  },
  mounted() {
    this.getData();
    // console.log(this.getRecharge(3,'Recharge'));
    // this.getRecharge(member.id,'Recharge');
    // this.getRecharge(member.id,'withdraw');
    // this.getRecharge(member.id,'task');
  },
}
</script>
<style >
.li1 {
  border-bottom: 2px solid black;
}
.navlinks {
  border: 1px solid black !important;
  border-radius: 0 !important;
}
.navlinks.active {
  border-bottom: 0px !important;
}
.containerBorder {
    border: 1px solid black;
}
</style>
