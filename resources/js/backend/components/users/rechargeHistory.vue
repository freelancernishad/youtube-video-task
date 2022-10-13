<template>
    <div>
        <section id="topbar">
            <div class="title">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="fa fa-angle-left"></i></a>
                <p>{{ $t('Recharge_History.value') }}</p>
                <LanguageComponent/>
            </div>
        </section>
        <section id="listmenus">
            <div role="feed" class="van-list row" aria-busy="true">
                <div class="recordDiv col-md-6" v-for="rech in row" :key="'rech'+rech.id">
                    <div class="card text-white" :style="[rech.status=='pending' ? {'background': 'red'} : {'background': 'green'}]" style="margin-bottom: 20px">
                        <div class="card-header">
                            <h5 class="card-title">{{ $t('Recharge_amount.value') }}: {{ rech.amount }} </h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $t('Order_Number.value') }} : {{ rech.trx }}</p>
                            <p>{{ $t('Recharge_status.value') }} : {{ rech.status }}</p>
                            <p>{{ $t('Date.value') }} : {{ dateformatglobal(rech.created_at)[6] }}</p>
                        </div>
                        <div class="card-footer">
                            <p>{{ $t('Remarks.value') }} :- {{ rech.admin_feedback }}</p>
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
    data() {
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
            var res = await this.callApi('get', `/api/admin/deposit?id=${id}`, []);
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
