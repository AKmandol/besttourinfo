<template>
<div>

    <div v-if="isLoading" class="preloader">
        <div class="spinner"></div>
    </div>
    
    <div class="mt-70 container bg-white border p-0 rounded w-100">
        <div class="row p-5">
            
            <span v-for="(p,i) in refund" :key="i">
                <h6 class="fw-bold mt-4 text-dark mb-2">{{ p.title }}</h6>
                <p class="font" v-html="p.text"></p>
            </span>

        </div>
    </div>

</div>
</template>

<script>
export default {

    data(){
        return{
            refund:[],
            isLoading: true
        }
    },

    methods: {
        async getAll(){
            const res = await this.callApi("get","home/getAllRefund");
            if (res.status == 200) {
                this.refund = res.data;
            } else {
                this.errorMsg();
            }
        }
    },
    created(){
        this.getAll();
        setTimeout(() => {
            this.isLoading = false;
        }, 1000); 
    }

}
</script>

<style scoped>
.mt-70{
    margin-top: 80px;
    margin-bottom: 50px;
    width: 70vw;
    margin-left: auto;
    margin-right: auto;
}
</style>