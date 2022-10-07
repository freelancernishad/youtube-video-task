<template>
    <div>
        <div data-v-58cf559a="" class="container">
                <div data-v-890639a6="" data-v-58cf559a="" class="title-bar wrap" textcolor="#fff" style="background: var(--defaltColor);">
                    <span data-v-890639a6="" class="back">
                        <img
                            data-v-890639a6=""
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACoAAAAoCAMAAAC/1ZhiAAAAkFBMVEUAAAD///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////+WABnwAAAAL3RSTlMA+3EIA/TRsDP38Onc1cp8WkgrJxoUEAvs5MC2p56VioJDPTog48W+dmllYVIhD58sRNoAAADGSURBVDjL3dO3DoNAFETRJeecswHntP//d9YguWYaN771EULaN+JPKi3D0ihZmFJKlZF5IEl69CHPxA9kJ8hLtS9TD7IjvmnXkJa+L1cXsifkbEAOhEwcyFHs91QgJ0LGmzwQ8q6wb6RKdCNkBKg8aBkLIgOUksIEbXEi5JGEb8ZmzWZLQR+0WfAzCXJ6fNJ/UZMOYZuMsVUL66WM1TrY2qasBetSVu83u1B2gDVmwTTCOgllp83alI2+IyPXkwiu9bqIX/cB5SAfZzO9vJYAAAAASUVORK5CYII="
                            alt=""
                        />
                    </span>
                    <p data-v-890639a6="" class="title">Level1</p>
                    <span data-v-890639a6="" class="right-top-btn"><span data-v-890639a6=""></span><img data-v-890639a6="" src="" alt="" style="display: none;" /></span>
                </div>
               <div data-v-58cf559a="" class="lvs">

               </div>
                <!--      <div data-v-58cf559a="" class="yuan">
                        <div data-v-58cf559a="" class="yuan1"></div>
                        <div data-v-58cf559a="" class="yuan2" style="transform: rotate(36deg);"></div>
                        <div data-v-58cf559a="" class="yuan3" style="transform: rotate(0deg);"></div>
                        <div data-v-58cf559a="" class="cover1"></div>
                        <div data-v-58cf559a="" class="yuan1 yuan11">
                            <div data-v-58cf559a="" class="dots">
                                <div data-v-58cf559a="" class="dot" style="color: rgb(255, 255, 255); transform: rotate(0deg);"><span data-v-58cf559a="" class="nor" style="transform: rotate(180deg);">Level6</span></div>
                                <div data-v-58cf559a="" class="dot" style="color: rgb(255, 255, 255); transform: rotate(-36deg);"><span data-v-58cf559a="" class="nor" style="transform: rotate(216deg);">Level5</span></div>
                                <div data-v-58cf559a="" class="dot" style="color: rgb(255, 255, 255); transform: rotate(-72deg);"><span data-v-58cf559a="" class="nor" style="transform: rotate(252deg);">Level4</span></div>
                                <div data-v-58cf559a="" class="dot" style="color: rgb(255, 255, 255); transform: rotate(-108deg);"><span data-v-58cf559a="" class="nor" style="transform: rotate(288deg);">Level3</span></div>
                                <div data-v-58cf559a="" class="dot" style="color: rgb(255, 255, 255); transform: rotate(-144deg);"><span data-v-58cf559a="" class="next" style="transform: rotate(324deg);">Level2</span></div>
                                <div data-v-58cf559a="" class="dot" style="color: rgb(255, 255, 255); transform: rotate(-180deg);"><span data-v-58cf559a="" class="on" style="transform: rotate(360deg);">Level1</span></div>
                            </div>
                        </div>
                        <div data-v-58cf559a="" class="yuan2 yuan22" style="transform: rotate(36deg);">
                            <div data-v-58cf559a="" class="dots">
                                <div data-v-58cf559a="" class="dot" style="transform: rotate(0deg);"></div>
                                <div data-v-58cf559a="" class="dot" style="transform: rotate(-36deg);"></div>
                                <div data-v-58cf559a="" class="dot" style="transform: rotate(-72deg);"></div>
                                <div data-v-58cf559a="" class="dot" style="transform: rotate(-108deg);"></div>
                                <div data-v-58cf559a="" class="dot" style="transform: rotate(-144deg);"></div>
                                <div data-v-58cf559a="" class="dot" style="transform: rotate(-180deg);"></div>
                            </div>
                        </div>
                        <div data-v-58cf559a="" class="yuan3 yuan33" style="transform: rotate(0deg);">
                            <div data-v-58cf559a="" class="dots">
                                <div data-v-58cf559a="" class="dot" style="transform: rotate(0deg);"></div>
                                <div data-v-58cf559a="" class="dot" style="transform: rotate(-36deg);"></div>
                                <div data-v-58cf559a="" class="dot" style="transform: rotate(-72deg);"></div>
                                <div data-v-58cf559a="" class="dot" style="transform: rotate(-108deg);"></div>
                                <div data-v-58cf559a="" class="dot" style="transform: rotate(-144deg);"></div>
                                <div data-v-58cf559a="" class="dot" style="transform: rotate(-180deg);"></div>
                            </div>
                        </div>
                        <div data-v-58cf559a="" class="cover"></div>
                        <div data-v-58cf559a="" class="money">
                            <p data-v-58cf559a="">148.82</p>
                            <p data-v-58cf559a="">Total amount(৳)</p>
                        </div>
                    </div>
                </div> -->

                <div data-v-58cf559a="" class="lvlist">



                    <div data-v-58cf559a="" class="item" v-for="plan in row" :key="plan.id">
                        <div data-v-58cf559a="" class="lv">{{ plan.name }}</div>
                        <div data-v-58cf559a="" class="mid">

                             <div data-v-58cf559a="" class="mitem">
                                <p data-v-58cf559a="">{{ plan.start_balance }} <span data-v-58cf559a="">৳</span></p>
                                <p data-v-58cf559a="">Start</p>
                            </div>
                            <div data-v-58cf559a="" class="mitem">
                                <p data-v-58cf559a="">{{ plan.end_balance }} <span data-v-58cf559a="">৳</span></p>
                                <p data-v-58cf559a="">End</p>
                            </div>
                            <div data-v-58cf559a="" class="mitem">
                                <p data-v-58cf559a="">{{ parseFloat(plan.comission_rate*plan.totalorder).toFixed(2) }} <span data-v-58cf559a="">%</span></p>
                                <p data-v-58cf559a="">Plan Commission</p>
                            </div>
                        </div>
                        <div data-v-58cf559a="" class="bottom">
                            <div data-v-58cf559a="" class="left">
                                <p data-v-58cf559a="">Upgraded</p>
                                <!---->
                            </div>
                            <router-link :to="{name:'Recharge'}" data-v-58cf559a="" class="lbtn dis">Upgrade Now</router-link>
                        </div>
                    </div>


                </div>
            </div>

    </div>
</template>

<script>
export default {
    created() {
        this.plans();
    },
    data() {
        return {
            row:{},
        }
    },
    methods: {
        async plans(){
            var res = await this.callApi('get',`/api/admin/plan`,[])
            this.row = res.data
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
