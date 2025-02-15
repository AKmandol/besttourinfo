<template>
    <div class="bg-white">
    
       
        <div class="container-fluid main bg-dark mb-5 position-relative mt-50">

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white shadow border-bottom rounded position-absolute top-100 start-50 translate-middle">
                    <div class="d-flex justify-content-center aling-items-center p-2">
                        <router-link to="/" class="nav-link bg-white border shadow rounded">
                            <b-icon-grid-fill class="d-inline nav-icon" width="15" height="15"></b-icon-grid-fill>
                            <span class="d-inline ml-2 text-dark fw-bold mr-2">Home</span>
                        </router-link>
                        <span class="text-secondary my-auto mx-sm-2 mx-md-4"><b-icon-arrow-bar-left class="d-inline nav-icon" width="25" height="25"></b-icon-arrow-bar-left></span>
                        <router-link to="/flight" class="nav-link bg-white border shadow rounded">
                            <b-icon-lightning-charge class="d-inline nav-icon" width="15" height="15"></b-icon-lightning-charge>
                            <span class="d-inline text-dark fw-bold ml-2">Flights</span>
                        </router-link>
                    </div>
                </div>
            </div>

        </div>
       
        <div class="container-fluid main-first">

            <div class="container position-relative bg-white border shadow rounded py-4 px-0 px-md-2">

                <div class="accordion" id="accordionExample">

                    <div class="border p-3 d-flex flex-row shadow bg-light rounded-3 position-absolute top-0 start-50 translate-middle">

                        
                        <div class="accordion-header" id="headingOne">
                            <a class="accordion-button rounded-3 bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <img src="/img/icon/plane.png" class="border rounded-circle p-2 d-inline" width="40" height="40" alt="">
                                <span class="ml-2 mr-2 text-center text-dark fw-bold fs-6 d-none d-md-block">Flight Booking</span>
                            </a>
                        </div>

                    </div>

                    <FilghtSearch></FilghtSearch>

                </div>

            </div>  

        </div>

        <!-- Modal -->
        <Modal
            v-model="modal"
            footer-hide
        >
            
            <div class="p-3 container-main">

            <div class="text-center p-3 bg-light rounded">
                <h6 class="text-danger fw-bold"> Flight Booking System is Under Constraction </h6>
                <p class="text-success text-sm"> We will be Back With Full Features Shortly </p>
            </div>

            <div class="row p-3 text-center my-2">
                <div class="col-12 my-auto">
                <a href="/hotel" class="py-2 px-2 bg-primary border rounded">
                    <b-icon-box-arrow-left class="d-inline text-white" width="15" height="15"></b-icon-box-arrow-left>
                    <span class="d-inline ml-2 text-white my-auto fw-bold">Back To Hotel Booking</span>
                </a>
                </div>
            </div>

            </div>
        </Modal>

    </div>
</template>

<script>
import FilghtSearch from '../search/flightSearch.vue';
export default {

    components: {
      FilghtSearch
    },

    data() {
        return {
            modal: true,
            adult:1,
            child:0,
            senior:0,
            baby:0,
            date:  new Date(),
            date2:  new Date(),
        }
    }
}
</script>

<style scoped>

.main {
    height: 200px;
    padding: 200px 0;
    background-color: #27003d;
    opacity: 0.8;
    background-image:  repeating-radial-gradient( circle at 0 0, transparent 0, #00000098 5px ), repeating-linear-gradient( #0000009f, #070e958e );
}
.main-first {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 350px;
  width: 100%;
  background: #fff !important;
  background-size: cover !important;
  background-repeat: no-repeat !important;
}
</style>