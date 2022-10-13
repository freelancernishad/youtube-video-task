<template>
    <div>



        <section id="bigbg" style="background: #3838a3 !important;" class="qr">
            <div class="container-fluid">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="fa fa-angle-left"></i></a>
                <div class="QR  text-center">
                    <!-- <img src="img/QR.png"> -->
                    <img :src="'https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl='+ref+'&choe=UTF-8'" :alt='ref'/>
                </div>
                <form action="" class="link">
                    <div class="row">
                        <input disabled type="url" v-model="ref">
                        <input type="button" value="copy" class="copy" @click="copyref">
                    </div>
                </form>


                <div class="copyPopup" v-if="popup">
                    <span> Refer link copied success</span>
                </div>
                <!-- <div class="download-link">
                    <a href="download.html" class="download"><i class="fa fa-shopping-bag"></i> Download address </a>
                </div> -->
            </div>
        </section>


    </div>
</template>

<script>
export default {
    created() {
        this.getData()
    },
    data() {
        return {
            ref: '',
            row:{},
            popup:false
        }
    },
    methods: {

          async getData() {
             var id = localStorage.getItem('userid');
            var res = await this.callApi('get', `/api/admin/user/${id}`, []);
                this.ref = 'https://jmyearnmoney.com/register?ref='+res.data.user.username
            this.row = res.data;

        },


        copyref() {


            navigator.clipboard.writeText(this.ref);
          this.popup = true

            setTimeout(() => {
                this.popup = false
            }, 1000);
        }
    },
}
</script>
<style>

.copyPopup {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  background: #000000b5;
  padding: 27px;
}
.copyPopup span {
  display: block;
  font-size: 25px;
  color: white;
}
</style>
