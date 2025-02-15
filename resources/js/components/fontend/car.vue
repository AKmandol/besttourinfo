<template>
    <div class="bg-white">

        <div v-if="isLoading" class="preloader">
            <div class="spinner"></div>
        </div>
       
        <div class="container-fluid main bg-dark mb-5 position-relative mt-50">

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white shadow border-bottom rounded position-absolute top-100 start-50 translate-middle">
                    <div class="d-flex justify-content-center aling-items-center p-2">
                        <router-link to="/" class="nav-link bg-white border shadow rounded">
                            <b-icon-grid-fill class="d-inline nav-icon" width="15" height="15"></b-icon-grid-fill>
                            <span class="d-inline ml-2 text-dark fw-bold mr-2">Home</span>
                        </router-link>
                        <span class="text-secondary my-auto mx-sm-2 mx-md-4"><b-icon-arrow-bar-left class="d-inline nav-icon" width="25" height="25"></b-icon-arrow-bar-left></span>
                        <router-link to="/car" class="nav-link bg-white border shadow rounded">
                            <b-icon-truck class="d-inline nav-icon" width="15" height="15"></b-icon-truck>
                            <span class="d-inline text-dark fw-bold ml-2">Car Rentals</span>
                        </router-link>
                    </div>
                </div>
            </div>

        </div>
       
        <div class="container-fluid main-first p-0">
           
            <div class="container w-md-100 child position-relative border shadow rounded  px-0 container-main">
            
                <div class="accordion" id="accordionExample">

                    <div class="d-flex flex-row shadow bg-white position-absolute top-0 start-50 translate-middle container-main">

                        
                        <div class="accordion-header p-1" id="headingTwo">
                            <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <img src="/img/icon/car2.png" class="border rounded-circle p-2 d-inline" width="40" height="40" alt="">
                                <span class="ml-2 mr-2 text-center text-dark fw-bold fs-6 d-none d-md-block">Car Rentals</span>
                            </a>
                        </div>

                    </div>

                
                    <CarSearch></CarSearch>


                </div>

            </div>  
            
        </div>
       
        <div class="container-fluid bg-light py-5">

            <div class="container">
            
                <div class="row">

                    <div class="col-md-6 col-sm-12 text-center text-md-start my-auto">

                        <div class="text-center text-md-start mb-4">
                            <h4 class="text-dark1 fw-bold">How to Book:</h4>
                        </div>

                        <h6 class="fw-bold text-dark1 my-4">
                            <span class="border border-success rounded-3 p-2  mr-2">1</span> Choose Pick Up Location <b-icon-check-lg class="d-inline text-success ml-2" width="30" height="30"></b-icon-check-lg>
                        </h6>
                        <h6 class="fw-bold text-dark1 my-4">
                            <span class="border border-success rounded-3 p-2  mr-2">2</span> Choose Drop Off Location <b-icon-check-lg class="d-inline text-success ml-2" width="30" height="30"></b-icon-check-lg>
                        </h6>
                        <h6 class="fw-bold text-dark1 my-4">
                            <span class="border border-success rounded-3 p-2  mr-2">3</span> Seletct Pick-Up Date and Time <b-icon-check-lg class="d-inline text-success ml-2" width="30" height="30"></b-icon-check-lg>
                        </h6>
                        <h6 class="fw-bold text-dark1 my-4">
                            <span class="border border-success rounded-3 p-2  mr-2">4</span> Seletct Return Date and Time <b-icon-check-lg class="d-inline text-success ml-2" width="30" height="30"></b-icon-check-lg>
                        </h6>
                        <h6 class="fw-bold text-dark1 my-4">
                            <span class="border border-success rounded-3 p-2  mr-2">5</span> Proceed to Next <b-icon-check-lg class="d-inline text-success ml-2" width="30" height="30"></b-icon-check-lg>
                        </h6>

                    </div>
            
                    <div class="col-md-6 col-sm-12">

                        <div class="row">
                            <div class="col-12">
                                <h4 class="text-center text-dark1 fw-bold">Our Vehicles</h4>
                                <hr class="text-success w-50 mx-auto mb-4 mt-2">
                            </div>
                        
                        
                        
                            <div class="col-lg-3 col-6 text-center" v-for="(car,i) in carType" :key="i">
                                <img :src="car.title_image" class="rounded-3 m-2 shadow bg-white border hover-car" width="100" alt="">
                                <p class="text-center text-dark1">{{ car.car_type }}</p>
                            </div>
                          
                            

                            <div class="text-center my-4">
                                <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.carType != ''" @on-change="getCar" />
                            </div>

                           
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
            total:8,
            pageInfo: null,
            carType: [],
            destinations: [],
            data:{
            car_type: '',
            pick_up: '',
            drop_off: '',
            pick_up_date: new Date(),
            drop_off_date: new Date(),
          }
        } 

    },

    
    methods:{
        async getCar(page){
            this.isLoading = true;
            const res = await this.callApi("get", `/car/get_all?total=${this.total}&page=${page}`);
            if (res.status == 200) {
                this.carType = res.data.data;
                this.pageInfo = res.data;
                setTimeout(() => {
                this.isLoading = false;
                }, 300);
            } else {
                this.errorMsg();
            }
        }, 

       
    },

    mounted(){
        this.getCar();
        setTimeout(() => {
            this.isLoading = false;
        }, 1000); 
    }
}
</script>

<style scoped>

.hover-car:hover{
    border: 1px solid green !important;
    padding: 3px !important;
}
.main {
    height: 200px;
    padding: 200px 0;
    background-color: #003d38;
    opacity: 0.8;
    background-image:  repeating-radial-gradient( circle at 0 0, transparent 0, #00000098 5px ), repeating-linear-gradient( #0000009f, #5c00928e );
}

.main-first {
  display: flex;
  justify-content: center;
  align-items: center;
  background: #fff !important;
  background-size: cover !important;
  background-repeat: no-repeat !important;
  margin-top: 150px !important;
  margin-bottom: 100px !important;
}
</style>