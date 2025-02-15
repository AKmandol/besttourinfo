<template>
    <div>
        <div class="container-fluid">

            <div class="row bg-main">

                <h5 class="p-3 table-border-dark bg-header color-white text-center fw-bold"><b-icon-list class="d-inline text-success mr-2" width="25" height="25"></b-icon-list>Vat and Tax Manage</h5>

                <div class="col-md-8 mx-auto m-0 p-3">
                    
                    <div class="accordion table-border-dark" id="accordionExample">
  
                        <div class="accordion-item border-0">
                            <h2 class="bg-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsety" aria-expanded="true" aria-controls="collapsety">
                                <b-icon-bank class="d-inline color-main mr-2" width="20" height="20"></b-icon-bank> <span class="color-white">Hotel Vat and Tax</span>
                            </button>
                            </h2>
                            <div id="collapsety" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body bg-main">
                                <div class="table-responsive">

                                    <table class="table rounded color-white text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">Hotel Vat Percentage</th>
                                                <th scope="col" style="width: 200px;">Upadte</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="mx-0 px-0 my-auto" v-for="(vat,i) in vatTax" :key="i">
                                                <td class="fw-bold mx-0 px-0 align-middle">{{ vat.hotel_vat }}% </td>
                                                <td  class="mx-0 px-0 my-auto">
                                                    <a class="mx-2 btn btn-sm btn-outline-primary px-2" data-toggle="modal" data-target="#editModal" @click="updateModelHotel(vat,i)"><b-icon-pencil-square class="d-inline mr-1" width="16" height="16"></b-icon-pencil-square></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0">
                            <h2 class="bg-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefy" aria-expanded="false" aria-controls="collapsefy">
                                <b-icon-truck class="d-inline color-main mr-2" width="20" height="20"></b-icon-truck> <span class="color-white">Car Vat and Tax</span>
                            </button>
                            </h2>
                            <div id="collapsefy" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body bg-main">
                                <div class="table-responsive">

                                    <table class="table rounded color-white text-center">
                                        <thead>
                                            <tr>
                                                <th scope="col">Car Vat Percentage</th>
                                                <th scope="col" style="width: 200px;">Upadte</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="mx-0 px-0 my-auto" v-for="(vat,i) in vatTax" :key="i">
                                                <td class="fw-bold mx-0 px-0 align-middle">{{ vat.car_vat }}%</td>
                                                <td  class="mx-0 px-0 my-auto">
                                                    <a class="mx-2 btn btn-sm btn-outline-primary px-2" data-toggle="modal" data-target="#editModal" @click="updateModelCar(vat,i)"><b-icon-pencil-square class="d-inline mr-1" width="16" height="16"></b-icon-pencil-square></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            </div>
                        </div>
                    
                    </div>
                    
                </div>

            </div>
        </div>

        <!-- Update Modal Hotel -->
        <Modal
        v-model="showUpdateModalHotel"
        :mask-closable="false"
        width="500"
        >
        <template #header>
            <p class="d-flex align-items-center justify-content-center " style="color: rgb(0, 156, 252); text-align: center; min-height:40px">
            <Icon type="ios-home-outline" size="32" />
            <span class="ml-2 color-white fw-bold">Update Hotel Vat</span>
            </p>
        </template>

        <div style="text-align: center;">
            <div class="mb-3 row my-auto">
                <label for="hotel" class="col-sm-4 color-white fw-bold">Hotel VAT</label>
                <div class="col-sm-7">
                    <input type="number" class="form-control" id="hotel" v-model="data.hotelVat" :class="hasError('hotelVat') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('hotelVat')">{{getError('hotelVat')}}</div>
                </div>
                <div class="col-sm-1 my-auto">
                    <p class="color-main">%</p>
                </div>
            </div>
        </div>

        <template #footer>
            <button class="btn btn-sm btn-outline-info" @click="upadteHotelVat()">Update</button>
        </template>
        </Modal>

        <!-- Update Modal Car -->
        <Modal
        v-model="showUpdateModalCar"
        :mask-closable="false"
        width="500"
        >
        <template #header>
            <p class="d-flex align-items-center justify-content-center " style="color: rgb(0, 151, 233); text-align: center; min-height:40px">
            <Icon type="ios-car-outline" size="32" />
            <span class="ml-2 color-white fw-bold">Update Car Vat</span>
            </p>
        </template>

        <div style="text-align: center; color: black">
            <div class="mb-3 row my-auto">
                <label for="hotel" class="col-sm-4 color-white fw-bold">Car VAT</label>
                <div class="col-sm-7">
                    <input type="number" class="form-control" id="hotel" v-model="data.carVat" :class="hasError('carVat') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('carVat')">{{getError('carVat')}}</div>
                </div>
                <div class="col-sm-1 my-auto">
                    <p class="color-main">%</p>
                </div>
            </div>
        </div>

        <template #footer>
            <button class="btn btn-sm btn-outline-info" @click="upadteCarVat()">Update</button>
        </template>
        </Modal>

    </div>
</template>
    
<script>

    export default {

    data(){
        return{
            data:{
                hotelVat: '',
                carVat: '',
                index: '',
                id: '',
            },
            errors: {},
            vatTax: [],
            showUpdateModalHotel: false,
            showUpdateModalCar: false,
        }
    },

    methods:{

        async getVat() {
            const res = await this.callApi("get", "vat/get");
            if (res.status == 200) {
                this.vatTax = res.data;
                //console.log(this.vatTax)
            } else {
                this.errorMsg();
            }
        },

        updateModelHotel(vat,i){
            this.showUpdateModalHotel = true;
            this.data.index = i;
            this.data.id = vat.id;
            this.data.hotelVat = vat.hotel_vat;
        },

        updateModelCar(vat,i){
            this.showUpdateModalCar = true;
            this.data.index = i;
            this.data.id = vat.id;
            this.data.carVat = vat.car_vat;
        },

        async upadteHotelVat(){
            //console.log(this.data)
            const res = await this.callApi("post", "/updateHotel/vat", this.data);
            if (res.status == 200) {
                this.vatTax[0].hotel_vat = this.data.hotelVat;
                this.successMsg("Vat_Tax updated successfully");
                this.showUpdateModalHotel= false;
            } else {
                this.errorMsg();
            } 
        },

        async upadteCarVat(){
            //console.log(this.data)
            const res = await this.callApi("post", "/updateCar/vat", this.data);
            if (res.status == 200) {
                this.vatTax[0].car_vat = this.data.carVat;
                this.successMsg("Vat_Tax updated successfully");
                this.showUpdateModalCar= false;
            } else {
                this.errorMsg();
            } 
        },

        closeModal(){
            this.showDeleteModal= false;
        },

        copy(subscriber, i){
        let copyText = subscriber.email;
        navigator.clipboard.writeText(copyText);
        this.successMsg("Email Address Copied");
        }
    },

    async created() {
        this.getVat();
    },

    }
</script>
  
<style scoped>
  
</style>