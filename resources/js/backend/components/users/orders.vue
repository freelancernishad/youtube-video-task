<template>
    <div>
        <section id="topbar">
            <div class="title">
                <a href="javascript:void(0)" @click="$router.go(-1)"><i class="fa fa-angle-left"></i></a>
                <p>{{ $t('Order_Record.value') }}</p>
                <LanguageComponent />
            </div>
        </section>
        <section id="listmenus">
            <div role="feed" class="van-list row" aria-busy="true">
                <div class="col-md-6" v-for="task in row.task" :key="'task'+task.id">
                    <div class="card" :style="{backgroundColor:'#0c407a'}" style="margin-bottom: 20px">
                        <div class="card-body">
                            <p class="text-white">Date： {{ dateformatglobal(task.created_at)[6] }}</p>
                            <p class="text-white">Task Comisition： {{ task.task_comisition }} TK</p>
                        </div>
                    </div>
                </div>
            </div>
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
