<template>
    <div class="bg-white">

        <div v-if="isLoading" class="preloader">
            <div class="spinner"></div>
        </div>
       
        <div class="container-fluid main bg-dark mb-5 position-relative mt-50">


            <h1 class="display-4 text-danger fw-bold text-center position-absolute top-50 start-50 translate-middle">Transction Failed</h1>

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white shadow border-bottom rounded position-absolute top-100 start-50 translate-middle">
                    <div class="d-flex justify-content-center aling-items-center p-2">
                        
                        <router-link to="/" class="nav-link bg-white border shadow rounded">
                            <b-icon-grid-fill class="d-inline nav-icon" width="15" height="15"></b-icon-grid-fill>
                            <span class="d-inline ml-2 text-dark1 fw-bold mr-2">Home</span>
                        </router-link>

                        <span class="text-secondary my-auto mx-sm-2 mx-md-4"><b-icon-arrow-bar-left class="d-inline nav-icon" width="25" height="25"></b-icon-arrow-bar-left></span>
                        
                        <router-link to="/profile" class="nav-link bg-white border shadow rounded">
                            <b-icon-cart class="d-inline text-success" width="15" height="15"></b-icon-cart>
                            <span class="d-inline text-dark1 fw-bold ml-2">See Details</span>
                        </router-link>

                    </div>
                </div>
            </div>

        </div>
       
       <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <span v-for="(p,i) in refund" :key="i">
                    <h6 class="fw-bold mt-4 text-dark mb-2">{{ p.title }}</h6>
                    <p class="text-dark ml-4" v-html="p.text"></p>
                </span>
            </div>
            <div class="col-12">
                 
                <div class="row">
                    <h4 class="fw-bold mt-4 text-dark mb-2 text-center"> You can see also...</h4>
                    
                    <div class="col-md-4 col-sm-6">
                        <router-link to="/posts" class="py-3 nav-link bg-white border shadow rounded text-center">
                            <b-icon-newspaper class="text-dark mx-auto" width="25" height="25"></b-icon-newspaper>
                            <p class="text-dark1 fw-bold pt-3">Latest Blog</p>
                        </router-link>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <router-link to="/hotel" class="py-3 nav-link bg-white border shadow rounded text-center">
                            <b-icon-hospital class="text-success mx-auto" width="25" height="25"></b-icon-hospital>
                            <p class="text-dark1 fw-bold pt-3">Nearby Hotels</p>
                        </router-link>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <router-link to="/car" class="py-3 nav-link bg-white border shadow rounded text-center">
                            <b-icon-truck class="text-primary mx-auto" width="25" height="25"></b-icon-truck>
                            <p class="text-dark1 fw-bold pt-3">Rent a Car</p>
                        </router-link>
                    </div>
                </div>

            </div>
        </div>
       </div>
        
       
         
    

    </div>
</template>

<script>
import CarSearch from '../search/carSearch.vue';
export default {

    components: {
        CarSearch
    },

    data() {
        return {
            isLoading: true,
            refund: '',
        }
        

    },

    
    methods:{
         
        async getAll(){
            const res = await this.callApi("get","home/getAllRefund");
            if (res.status == 200) {
                this.refund = res.data;
            } else {
                this.errorMsg();
            }
        }
       
    },

    mounted(){
        this.getAll();
        setTimeout(() => {
            this.isLoading = false;
        }, 1000); 
    }
}
</script>

<style scoped>

.main {
    height: 200px;
    padding: 350px 0;
    background-color: #003d38;
    opacity: 0.8;
    background-image:  repeating-radial-gradient( circle at 0 0, transparent 0, #3808008a 5px ), repeating-linear-gradient( #0000009f, #9242008e );
}


</style>