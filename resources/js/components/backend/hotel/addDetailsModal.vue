<template>
    <div>
  
        <!-- Modal -->
        <div class="modal fade" id="addDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="text-center fw-blod text-dark">Add More Information</h5>
                        <p class="fw-bloder text-success ml-3 my-auto" id="exampleModalLabel"> for  "{{ hotels.name }}"</p>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <b-icon-x-lg class="d-inline fw-bold text-danger" width="16" height="16"></b-icon-x-lg>
                        </button>
                    </div>

                    <div class="modal-body text-dark">
                        
                        <div class="accordion" id="accordionExample">

                           
                            <div class="d-flex justify-content-center mx-auto mb-3 border py-3 rounded shadow bg-light border border-bottom-success">

                                <button class="btn bg-light text-dark border shadow fw-bold px-3 mx-2 text-center my-auto" type="button" data-toggle="collapse" data-target="#image" aria-expanded="true" aria-controls="collapseOne">
                                 <b-icon-plus-circle class="d-inline mr-2 text-success" width="16" height="16"></b-icon-plus-circle>Add Hotel Images
                                </button>
                            
                                <button class="btn bg-light text-dark border shadow fw-bold px-3 mx-2 text-center my-auto collapsed" type="button" data-toggle="collapse" data-target="#facelities" aria-expanded="false" aria-controls="collapseTwo">
                                    <b-icon-plus-circle class="d-inline mr-2 text-success" width="16" height="16"></b-icon-plus-circle>Add Hotel facilites
                                </button>
                            
                                <button class="btn bg-light text-dark border shadow fw-bold px-3 mx-2 text-center my-auto collapsed" type="button" data-toggle="collapse" data-target="#payments" aria-expanded="false" aria-controls="collapseThree">
                                    <b-icon-plus-circle class="d-inline mr-2 text-success" width="16" height="16"></b-icon-plus-circle>Add Payment Methods
                                </button>

                            </div>
                                

                            <div class="card">
                                <div id="image" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <form method="POST" class="col-12">
                                            <label for="images" class="form-label fw-bolder text-dark">Hotel Images</label>
                                            <div class="p-3 border bg-white rounded">

                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Upload all Images</label>
                                                    <input multiple class="form-control" type="file" id="file-uplaod-two" @change="fieldChange" :class="hasError('Hotel_Images') ? 'is-invalid' : '' ">
                                                    <div class="invalid-feedback" v-if="hasError('Hotel_Images')">{{getError('Hotel_Images')}}</div>
                                                </div>

                                                <div class="p-3 border rounded" v-show="this.files.length">

                                                    <div class="position-r d-inline-flex mx-3 my-4" v-for="(img,index) in this.files" :key="index">
                                                        <img :src="img" class="rounded border shadow-sm " width="100" alt=""> 
                                                        <div class="position-absolute top-100 start-50 translate-middle text-center text-muted p-2 bg-light w-100 font-sm"><span>{{ this.data.images[index].size }} KB</span></div>
                                                        <a class="position-absolute top-0 start-100 translate-middle bg-white rounded-circle border p-1" @click="deleteImage(index)"><b-icon-x-lg class="text-danger fw-bold" width="18"></b-icon-x-lg></a>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="text-center mt-3">
                                                <a type="submit" @click.prevent="store" class="btn btn-primary col-4"><b-icon-cloud-plus class="d-inline mr-2" width="22" height="22"></b-icon-cloud-plus>Upload All Images</a>
                                            </div>
    
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div id="facelities" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <label for="inputAddress" class="form-label fw-bolder text-dark">Features</label>
                                            <div class="border bg-white rounded p-3" :class="hasError('facilites') ? 'is-invalid' : '' ">

                                                <div class="form-check form-check-inline p-2">
                                                    <input v-model="data.facilites" value="Breakfast Included" class="form-check-input" type="checkbox" id="1">
                                                    <label class="form-check-label" for="1">Breakfast Included</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Kitchen facilities" v-model="data.facilites" type="checkbox" id="2">
                                                    <label class="form-check-label" for="2">Kitchen facilities</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Bar Inside" v-model="data.facilites" type="checkbox" id="3">
                                                    <label class="form-check-label" for="3">Bar Inside</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="5 stars" v-model="data.facilites" type="checkbox" id="4">
                                                    <label class="form-check-label" for="4">5 stars</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Beach View" v-model="data.facilites" type="checkbox" id="5">
                                                    <label class="form-check-label" for="5">Beach View</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Parking Area" v-model="data.facilites" type="checkbox" id="6">
                                                    <label class="form-check-label" for="6">Parking Area</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Free WiFi" v-model="data.facilites" type="checkbox" id="7">
                                                    <label class="form-check-label" for="7">Free WiFi</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Swimming pool" v-model="data.facilites" type="checkbox" id="8">
                                                    <label class="form-check-label" for="8">Swimming pool</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Pet friendly" v-model="data.facilites" type="checkbox" id="10">
                                                    <label class="form-check-label" for="10">Pet friendly</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Kids Zone" v-model="data.facilites" type="checkbox" id="11">
                                                    <label class="form-check-label" for="11">Kids Zone</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Smoking Zone" v-model="data.facilites" type="checkbox" id="12">
                                                    <label class="form-check-label" for="12">Smoking Zone</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Air conditioning" v-model="data.facilites" type="checkbox" id="13">
                                                    <label class="form-check-label" for="13">Air conditioning</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Wheelchair accessibleg" v-model="data.facilites" type="checkbox" id="14">
                                                    <label class="form-check-label" for="14">Wheelchair accessibleg</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Balcony" v-model="data.facilites" type="checkbox" id="15">
                                                    <label class="form-check-label" for="15">Balcony</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Steam room" v-model="data.facilites" type="checkbox" id="16">
                                                    <label class="form-check-label" for="16">Steam room</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Full-body massage" v-model="data.facilites" type="checkbox" id="17">
                                                    <label class="form-check-label" for="17">Full-body massage</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Fitness center" v-model="data.facilites" type="checkbox" id="18">
                                                    <label class="form-check-label" for="18">Fitness center</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Sauna" v-model="data.facilites" type="checkbox" id="19">
                                                    <label class="form-check-label" for="19">Sauna</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Spa facilities" v-model="data.facilites" type="checkbox" id="20">
                                                    <label class="form-check-label" for="20">Spa facilities</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Tourist Info Centre" v-model="data.facilites" type="checkbox" id="21">
                                                    <label class="form-check-label" for="21">Tourist Info Centre</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="No prepayment" v-model="data.facilites" type="checkbox" id="22">
                                                    <label class="form-check-label" for="22">No prepayment</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Free cancellation" v-model="data.facilites" type="checkbox" id="23">
                                                    <label class="form-check-label" for="23">Free cancellation</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Book without credit card" v-model="data.facilites" type="checkbox" id="24">
                                                    <label class="form-check-label" for="24">Book without credit card</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Resort Hotel" v-model="data.facilites" type="checkbox" id="25">
                                                    <label class="form-check-label" for="25">Resort Hotel</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Apart Hotel" v-model="data.facilites" type="checkbox" id="26">
                                                    <label class="form-check-label" for="26">Apart Hotel</label>
                                                </div>
                                                <div class="form-check form-check-inline p-2">
                                                    <input class="form-check-input" value="Hotel"  v-model="data.facilites" type="checkbox" id="27">
                                                    <label class="form-check-label" for="27">Hotel</label>
                                                </div>

                                            </div>

                                            <div class="invalid-feedback" v-if="hasError('facilites')">{{getError('facilites')}}</div>
                                    
                                            <div class="text-center mt-3">
                                                <a @click="storeFacelitiess" class="btn btn-primary col-4"><b-icon-cloud-plus class="d-inline mr-2" width="22" height="22"></b-icon-cloud-plus>Add Facelities</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div id="payments" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                        
                                        <div class="row border p-3 rounded" :class="hasError('payments') ? 'is-invalid' : '' ">
                
                                            <div class="col-md-4 my-auto">
                                                <p for="inputZip" class="text-start fw-bolder my-auto text-dark">Payment Method Accept:</p>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-check form-check-inline bg-white p-2 shadow rounded mx-2 my-1">
                                                    <input v-model="data.paymentType" value="Visa" id="Visa" class="form-check-input" type="checkbox">
                                                    <img src="img/payment/1.png" class="" height="30" width="30" alt="">
                                                </div>
                                                <div class="form-check form-check-inline bg-white p-2 shadow rounded mx-2 my-1">
                                                    <input v-model="data.paymentType" value="UCB" id="UCB" class="form-check-input" type="checkbox">
                                                    <img src="img/payment/2.png" class="" height="30" width="30" alt="">
                                                </div>
                                                <div class="form-check form-check-inline bg-white p-2 shadow rounded mx-2 my-1">
                                                    <input v-model="data.paymentType" value="Exim" id="Exim" class="form-check-input" type="checkbox">
                                                    <img src="img/payment/3.png" class="" height="30" width="30" alt="">
                                                </div>
                                                <div class="form-check form-check-inline bg-white p-2 shadow rounded mx-2 my-1">
                                                    <input v-model="data.paymentType" value="Bkesh" id="Bkesh" class="form-check-input" type="checkbox">
                                                    <img src="img/payment/4.jpg" class="" height="30" width="30" alt="">
                                                </div>
                                                <div class="form-check form-check-inline bg-white p-2 shadow rounded mx-2 my-1">
                                                    <input v-model="data.paymentType" value="DBBL" id="DBBL" class="form-check-input" type="checkbox">
                                                    <img src="img/payment/5.jpg" class="" height="30" width="30" alt="">
                                                </div>
                                                <div class="form-check form-check-inline bg-white p-2 shadow rounded mx-2 my-1">
                                                    <input v-model="data.paymentType" value="MasterCard" id="MasterCard" class="form-check-input" type="checkbox">
                                                    <img src="img/payment/6.png" class="" height="30" width="30" alt="">
                                                </div>
                                                <div class="form-check form-check-inline bg-white p-2 shadow rounded mx-2 my-1">
                                                    <input v-model="data.paymentType" value="PayPal" id="PayPal" class="form-check-input" type="checkbox">
                                                    <img src="img/payment/7.jpg" class="" height="30" width="30" alt="">
                                                </div>
                                                <div class="form-check form-check-inline bg-white p-2 shadow rounded mx-2 my-1">
                                                    <input v-model="data.paymentType" value="Rocket" id="Rocket" class="form-check-input" type="checkbox">
                                                    <img src="img/payment/8.png" class="" height="30" width="30" alt="">
                                                </div>

                                                <div class="invalid-feedback" v-if="hasError('payments')">{{getError('payments')}}</div>

                                            </div>
                                            
                                            <div class="text-center mt-4">
                                                <a type="submit" @click="storePayment" class="btn btn-primary col-4"><b-icon-cloud-plus class="d-inline mr-2" width="22" height="22"></b-icon-cloud-plus>Add Payment Methods</a>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {

    props: ['hotels'],

    data(){
        return{
            errors:{},
            form: new FormData,
            files:[],

            data:{
                images:[],
                facilites:[],
                paymentType:[],
                hotel_id: this.$store.state.hotel_id,
            }
        }
    },

    methods:{
                
        async store(){

            for(let i=0; i<this.data.images.length;i++){
                this.form.append('Hotel_Images[]', this.data.images[i]);
            }
            this.form.append('hotel_id', this.$store.state.hotel_id);

            const config = { headers: { 'Content-Type': 'multipart/form-data' } };
            const res = await this.callApi("post", "hotel/store/image",this.form,config)
            
            if(res.status === 200){
                this.successMsg("Holtel Images Added Successfully");
                this.hotels.images = res.data;
                document.getElementById('file-uplaod-two').value=[];
                this.errors = {};
                this.files = [];
                this.data.images = [];
                this.selectedFiles = [];
                this.$router.go();
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    // this.errorMsg(res.data.errors[i][0])
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },

        async storeFacelitiess(){

            const res = await this.callApi("post", "hotel/store/facelities",{facilites: this.data.facilites,hotel_id: this.$store.state.hotel_id});
            
            if(res.status === 200){
                this.successMsg("Holtel Features Added Successfully");
                this.data.facilites = [];
                this.errors = {};
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    // this.errorMsg(res.data.errors[i][0])
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },

        async storePayment(){

            const res = await this.callApi("post", "hotel/store/payments",{payments: this.data.paymentType,hotel_id: this.$store.state.hotel_id});
            
            if(res.status === 200){
                this.successMsg("Holtel Payment Methods Added Successfully");
                this.data.paymentType = [];;
                this.errors = {};
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    // this.errorMsg(res.data.errors[i][0])
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },

        fieldChange(e){
            let selectedFiles = e.target.files;
            if(!selectedFiles.length){
                return false;
            }
            for(let i=0;i<selectedFiles.length;i++){
                this.data.images.push(selectedFiles[i]);
            }
            if(selectedFiles.length){
                Array.from(selectedFiles).forEach(file => this.addImage(file));
            }
        
            
           // console.log(this.data.images);
            
        },

        addImage(file){
            if(!file.type.match('image.*')){
                this.infoMsg(`${file.name} is not an Image`);
                return;
            }

            //this.data.files.push(file);
            const reader = new FileReader();
            reader.onload = (e) => this.files.push(e.target.result);
            reader.readAsDataURL(file);
            //console.log(file);
        },

        deleteImage(index){
            this.files.splice(index,1);
            this.data.images.splice(index,1);
            this.infoMsg("Image Removed");
        },
    
   
    },

    created(){
       
    }

}
</script>

<style scoped>
 .font-sm{
    font-size: 12px;;
 }
</style>