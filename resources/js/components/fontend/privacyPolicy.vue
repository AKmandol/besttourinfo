<template>
  <div>

    <div v-if="isLoading" class="preloader">
        <div class="spinner"></div>
    </div>
    
    <div class="mt-70 container bg-white border p-0 rounded w-100">
        <div class="row p-4">
            
            <span v-for="(p,i) in privacy" :key="i">
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
            privacy:[],
            isLoading: true
        }
    },

    methods: {
        async getAll(){
            const res = await this.callApi("get","home/getAllPrivacy");
            if (res.status == 200) {
                this.privacy = res.data;
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
    margin-left: auto;
    margin-right: auto;
}
.bg-cus1{
    background: #eaeaea;
}

.font{
    font-size: 15px;
}
</style>