<template>
    <div>
        <section id="orderpage">
            <div class="container-fluid">
                <h2></h2>
            </div>
        </section>
        <section id="topbar">
            <div class="title">
                <p>Orders</p>
                <router-link :to="{name:'orders'}"><img :src="$asseturl + 'frontend/img/tasks.png'" alt="logo"></router-link>
            </div>
        </section>



        <section>
            <div class="row">

                <div class="col-md-12"><iframe width="100%" height="400px" src="https://www.youtube.com/embed/QNUSIOMb6vI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <div class="col-md-12"><iframe width="100%" height="400px" src="https://www.youtube.com/embed/QNUSIOMb6vI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <div class="col-md-12"><iframe width="100%" height="400px" src="https://www.youtube.com/embed/QNUSIOMb6vI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <div class="col-md-12"><iframe width="100%" height="400px" src="https://www.youtube.com/embed/QNUSIOMb6vI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <div class="col-md-12"><iframe width="100%" height="400px" src="https://www.youtube.com/embed/QNUSIOMb6vI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <div class="col-md-12"><iframe width="100%" height="400px" src="https://www.youtube.com/embed/QNUSIOMb6vI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <div class="col-md-12"><iframe width="100%" height="400px" src="https://www.youtube.com/embed/QNUSIOMb6vI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>


            </div>

        </section>








    </div>
</template>
<script>
export default {
    created() {
        this.getData();



    },
    data() {
        return {
            receive: false,
            orderpage: false,
            random: 0,
            row: {
                user:{},
            },
            form: {
                task_comisition: 0
            },
            products: [
                // 'mainproduct.jpeg',
                '1.jpeg',
                '2.jpeg',
                '3.jpeg',
                '4.jpeg',
                '5.jpeg',
                '6.jpeg',
                '7.jpeg',
                '8.jpeg',
                '9.jpeg',
                '10.jpeg',
                '11.jpeg',
            ],
            taskProduct:'',
        }
    },
    methods: {
        TryAgain() {
            this.receive = false;
            this.orderpage = false;
            this.getData();
        },
        recievefun() {
            this.receive = true
            if (Number(this.row.user.task) < 1) {
                Notification.customError(`You Can't Complete any order Today`);
                this.receive = false
            } else {

                let randomnumber = setInterval(() => {
                    this.random = Math.floor(Math.random() * (1000000000000 - 1 + 1)) + 1
                }, 50);
                setTimeout(() => {
                    this.random = Math.floor(Math.random() * (this.row.user.balance - 1 + 1)) + 1
                    clearInterval(randomnumber);
                    this.orderpage = true
                    var task_comisition = ((this.row.user.balance * this.row.plans.comission_rate) / 100);
                    this.form.task_comisition = parseFloat(task_comisition).toFixed(2)

const random = Math.floor(Math.random() * this.products.length);
    this.taskProduct = this.$asseturl + 'img/'+this.products[random];
// console.log(random, this.products[random]);

                }, 3000);
            }
        },
        async getData() {
            var id = localStorage.getItem('userid');
            var res = await this.callApi('get', `/api/admin/user/${id}`, []);
            this.row = res.data;
        },


    async orderSubmit(){
        this.form['user_id'] = this.row.user.id;
        var res = await this.callApi('post',`/api/admin/task`,this.form);
        if(res.data==444){

            Notification.customError(`You Can't Complete any order Today`);
        }else{

            Notification.customSuccess('Task Completed');
        }

        this.TryAgain();
    }



    },
}
</script>
<style>
button.OrderReceive {
    border: 0;
    background: linear-gradient(90deg, #9b057a, #00c56a);
    color: white;
    display: block;
    width: 100%;
    font-size: 22px;
    padding: 8px 5px;
    margin: 16px 0px;
}
.orderamount {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    border: 2px solid #478fa5;
    background: #000000b8;
    font-size: 25px;
    padding: 11px 15px;
}
</style>
