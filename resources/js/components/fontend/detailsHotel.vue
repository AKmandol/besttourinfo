<template>
    <div>
    <!-- Details Modal -->
        <div class="p-3 rounded"  v-for="(h,i) in hotel" :key="i"> 
            <div class="text-center p-3 mt-2">
                <h3 class="text-dark fw-bold border-bottom py-3">Hotel Details</h3>
            </div>

            <div class="row p-3 rounded">

                <div class="col-md-12 col-sm-12 mb-3">
                    <div class="bg-light rounded d-flex justify-content-between aling-items-center">
                        <div class="my-auto">
                        <h5 class="p-3 rounded text-start fw-bold text-primary aling-middle"><b-icon-house-heart-fill class="d-inline text-success mr-2" width="22" height="22"></b-icon-house-heart-fill>{{ h.name }}</h5>
                        </div>
                        <div class="my-auto p-3">
                        <span v-if="h.stars == '1'">
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                        </span>
                        <span v-if="h.stars == '2'">
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                        </span>
                        <span v-if="h.stars == '3'">
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                        </span>
                        <span v-if="h.stars == '4'">
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                        </span>
                        <span v-if="h.stars == '5'">
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                            <b-icon-star-fill class="text-warning mx-1 d-inline shadow" width="17" height="17"></b-icon-star-fill>
                        </span>
                        </div>
                        <div class="my-auto">
                        <span class="p-3 rounded text-start fw-bold text-dark"><b-icon-geo-alt class="d-inline text-success mr-2" width="17" height="17"></b-icon-geo-alt>{{ h.address }}</span>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-8 col-sm-13">

                            <vueper-slides 
                                :infinite="true" 
                                :bullets="false"
                                fixed-height="350px"
                                class="p-2"
                                >
                            
                                <template #arrow-left>
                                    <b-icon-chevron-left class="my-auto text-dark p-0" width="40" height="40"></b-icon-chevron-left>
                                </template>

                                <template #arrow-right>
                                    <b-icon-chevron-right class="my-auto text-dark p-0" width="40" height="40"></b-icon-chevron-right>
                                </template>

                                <vueper-slide 
                                v-for="(img,i) in h.images" :key="i" 
                                :image="'/hotel_images/'+img.hotel_image" 
                                class="h-100 rounded image"
                                >
                                </vueper-slide>
                            
                            </vueper-slides>

                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="row p-3 rounded bg-light h-fixed mt-2">
                                <div class="col-4 text-center" v-for="(url, index) in h.images" :key="index">
                                    <img :src="'/hotel_images/'+url.hotel_image" class="img-fluid my-2 rounded" />
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>

                <div class="col-md-8 col-sm-12 mt-3">
                <h6 class="p-3 bg-card rounded text-start fw-bold text-primary">Basic Information</h6>
                <p class="p-3 bg-light mt-3 fw-bold rounded">
                    {{ h.description }}
                </p>
                <div class="table-responsive mt-3 rounded">
                    <table class="table table-borderless">
                    <tbody class="rounded">
                        <tr class="aling-middle">
                            <td class="d-flex align-items-center"><b-icon-house-heart class="text-success d-inline mr-2" width="17" height="17"></b-icon-house-heart>Hotel Name:</td>
                            <td class="fw-bold">{{ h.name }}</td>
                            <td class="d-flex align-items-center"><b-icon-geo-alt class="text-success d-inline mr-2" width="17" height="17"></b-icon-geo-alt>Hotel Address:</td>
                            <td class="fw-bold">{{ h.address }}</td>
                        </tr>
                        <tr class="aling-middle">
                            <td class="d-flex align-items-center"><b-icon-telephone-plus class="text-success d-inline mr-2" width="17" height="17"></b-icon-telephone-plus>Phone Number:</td>
                            <td class="fw-bold">{{ h.phone }}</td>
                            <td class="d-flex align-items-center"><b-icon-envelope class="text-success d-inline mr-2" width="17" height="17"></b-icon-envelope>Email Address:</td>
                            <td class="fw-bold">{{ h.email }}</td>
                        </tr>
                        <tr class="aling-middle">
                            <td class="d-flex align-items-center"><b-icon-aspect-ratio class="text-success d-inline mr-2" width="17" height="17"></b-icon-aspect-ratio>City:</td>
                            <td class="fw-bold">{{ h.city }}</td>
                            <td class="d-flex align-items-center"><b-icon-activity class="text-success d-inline mr-2" width="17" height="17"></b-icon-activity>Country:</td>
                            <td class="fw-bold">{{ h.country }}</td>
                        </tr>
                        <tr class="aling-middle">
                            <td class="d-flex align-items-center"><b-icon-cash-coin class="text-success d-inline mr-2" width="17" height="17"></b-icon-cash-coin>Rate:</td>
                            <td class="fw-bold"><del class="text-danger">{{ h.offerRegularPrice }} ৳</del>  {{ h.offerDiscpuntPrice }} ৳ <small>per night</small></td>
                            <td class="d-flex align-items-center"><b-icon-info-circle class="text-success d-inline mr-2" width="17" height="17"></b-icon-info-circle>Basic Include:</td>
                            <td>One room/One bed</td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                
                <h6 class="p-3 bg-card rounded text-start fw-bold text-primary mt-2">Hotel Rules And Policy</h6>
                <div class="p-3 mt-2 border rounded">
                    <div class="table-responsive">
                    <table class="table table-borderless">
                        <tbody class="rounded">
                            <tr class="aling-middle">
                                <td class="d-flex align-items-center"><b-icon-stopwatch class="text-success d-inline mr-2" width="17" height="17"></b-icon-stopwatch>Check In Time:</td>
                                <td class="fw-bold">{{ h.checkIn }}</td>
                                <td class="d-flex align-items-center"><b-icon-stopwatch class="text-success d-inline mr-2" width="17" height="17"></b-icon-stopwatch>Check Out Time:</td>
                                <td class="fw-bold">{{ h.checkOut }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row my-auto">
                    <span class="fw-bold text-dark col-md-3 my-auto">House Rules:</span>
                    <p class="col-md-9 text-justify">{{h.houseRules}}</p>
                </div>
                <div class="row my-auto mt-3">
                    <span class="fw-bold text-dark col-md-3 my-auto">Kids Policy:</span>
                    <p class="col-md-9 text-justify">{{h.kidsPolicy}}</p>
                </div>
                <div class="row my-auto mt-3">
                    <span class="fw-bold text-dark col-md-3 my-auto">Pet Policy:</span>
                    <p class="col-md-9 text-justify">{{h.petPolicy}}</p>
                </div>

                </div>
                
                </div>

                <div class="col-md-4 col-sm-12 mt-2">
                    <h6 class="p-3 bg-card rounded text-start fw-bold text-primary mt-2">Hootel Facilities</h6>
                    <div class="p-3 mt-2 border rounded">
                        <div class="d-flex aling-items-center ml-2 mt-2 bg-light d-inline-flex p-2 rounded" v-for="(f,j) in h.features" :key="j">
                            <b-icon-fan class="d-inline my-auto mr-2 text-success" width="15" height="15"></b-icon-fan>
                            <p class="text-dark fw-bolder text-sm">{{ f.hotel_feature }}</p>
                        </div>
                    </div>

                    <h6 class="p-3 bg-card rounded text-start fw-bold text-primary mt-2">Payment Method Accept</h6>
                    <div class="p-3 mt-2 border rounded">
                        <div class="d-flex aling-items-center ml-2 mt-2 bg-light d-inline-flex p-2 rounded" v-for="(p,j) in h.payments" :key="j">
                            <b-icon-cash-coin class="d-inline my-auto mr-2 text-success" width="15" height="15"></b-icon-cash-coin>
                            <p class="text-dark fw-bolder text-sm">{{ p.payment_method }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row p-3 rounded">

                <div class="col-md-8 col-sm-12">
                    <h6 class="p-3 bg-card rounded text-start fw-bold text-primary mb-3">Book Now</h6>
                    <div class="p-3 border rounded">
                        <div class="row mb-3">
                            <span class="col-6 col-form-label">
                                <b-icon-house-heart class="d-inline text-success mr-2" width="15" height="15"></b-icon-house-heart>
                                <label class="d-inline text-dark textt-small">No of Rooms:</label>
                            </span>
                            <div class="col-6 my-auto">
                                <InputNumber class="ml-1 rounded text-end float-end" :max="10" :min="1" v-model="data.room" controls-outside />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <span class="col-6 col-form-label">
                                <b-icon-person-hearts class="d-inline text-success mr-2" width="15" height="15"></b-icon-person-hearts>
                                <label class="d-inline text-dark textt-small">No of Adults:</label>
                            </span>
                            <div class="col-6 my-auto">
                                <InputNumber class="ml-1 rounded text-end float-end" :max="10" :min="1" v-model="data.adult" controls-outside />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <span class="col-6 col-form-label">
                                <b-icon-person-hearts class="d-inline text-success mr-2" width="15" height="15"></b-icon-person-hearts>
                                <label class="d-inline text-dark textt-small">No of Children:  <small class="text-dark fw-bold">(Age below 12)</small></label>
                            </span>
                            <div class="col-6 my-auto">
                                <InputNumber class="ml-1 rounded text-end float-end" :max="10" :min="0" v-model="data.child" controls-outside />
                            </div>
                        </div>

                        <div class="row mb-3">

                            <span class="col-lg-3 col-md-6 col-form-label">
                                <b-icon-calendar2-plus class="d-inline text-success mr-2" width="15" height="15"></b-icon-calendar2-plus>
                                <label class="d-inline text-dark textt-small">Check In Date:</label>
                            </span>
                            <div class="col-lg-3 col-md-6 my-auto">
                                <input v-model="data.inDate" type="date" class="form-control bg-light form-control-sm border-0" :class="hasError('inDate') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('inDate')">{{getError('inDate')}}</div>
                            </div>
                            <span class="col-lg-3 col-md-6 col-form-label">
                                <b-icon-calendar2-plus class="d-inline text-success mr-2" width="15" height="15"></b-icon-calendar2-plus>
                                <label class="d-inline text-dark textt-small">Check Out Date:</label>
                            </span>
                            <div class="col-lg-3 col-md-6 my-auto">
                                <input type="date" v-model="data.outDate" class="form-control bg-light form-control-sm border-0" :class="hasError('outDate') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('outDate')">{{getError('outDate')}}</div>
                            </div>

                            <div class="col-12 text-end mt-4">
                                <h6 class="fw-bold text-dark">Sub Total: <span class="text-danger ml-3">{{ data.room * h.offerDiscpuntPrice }}৳</span></h6>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <a @click="confirmBooking(h,i)" class="col-6 btn btn-primary py-2 my-2">Confirm Booking</a>
                        </div>
                    </div>

                </div>

                <div class="col-md-4 col-sm-12">
                    <h6 class="p-3 bg-card rounded text-start fw-bold text-primary mb-3">Your Information</h6>
                    <div v-if="this.$store.state.client.name">
                        <div class="table-responsive mt-3 rounded">
                            <table class="table table-borderless">
                                <tbody class="border rounded">
                                <tr class="aling-middle">
                                    <td class="d-flex align-items-center"><b-icon-person-check class="text-primary d-inline mr-2" width="17" height="17"></b-icon-person-check>Name:</td>
                                    <td class="fw-bold">{{ this.$store.state.client.name }}</td>
                                </tr>
                                <tr class="aling-middle">
                                    <td class="d-flex align-items-center"><b-icon-telephone-plus-fill class="text-primary d-inline mr-2" width="17" height="17"></b-icon-telephone-plus-fill>Phone Number:</td>
                                    <td class="fw-bold">{{ this.$store.state.client.mobile }}</td>
                                </tr>
                                <tr class="aling-middle">
                                    <td class="d-flex align-items-center"><b-icon-envelope-check class="text-primary d-inline mr-2" width="17" height="17"></b-icon-envelope-check>Rate:</td>
                                    <td class="fw-bold">{{ this.$store.state.client.email }}</td>
                                </tr>
                                <tr class="text-center">
                                    <td colspan="2"><router-link class="p-1 border bg-light rounded text-dark" to="/profile">Change Information</router-link></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="p-3 bg-card rounded text-center fw-bold text-dark">Booking History</p>

                        <div class="table-responsive mt-2 rounded" v-if="bookingHistory">
                            <table class="table table-borderless">
                                <tbody class="border rounded">
                                <tr class="aling-middle">
                                    <td  colspan="2" class="d-flex align-items-center"><b-icon-house-heart class="text-muted d-inline mr-2" width="17" height="17"></b-icon-house-heart>Hotel Name:</td>
                                    <td class="fw-bold">Hotel Sinhai <span class="float-end text-muted">25/08/23</span></td>
                                </tr>
                                <tr class="aling-middle">
                                    <td  colspan="3" class="text-center text-primary">Thanks for stays with us.</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive mt-2 rounded" v-else>
                            <table class="table table-borderless">
                                <tbody class="border rounded">
                                
                                    <p class="text-center p-3">We don't found any booking record</p>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div v-else>
                        <div class="text-center p-3 bg-light rounded">
                            <h6 class="text-danger fw-bold">You are not Logged In </h6>
                            <p class="text-muted text-sm">Please Log in or Register</p>
                        </div>
                        <div class="row p-3 text-center my-2">
                            <a href="/user-login" class="col py-3 bg-primary border rounded">
                                <b-icon-box-arrow-right class="d-inline text-white" width="25" height="25"></b-icon-box-arrow-right>
                                <span class="d-inline ml-2 text-white my-auto fw-bold">Login</span>
                            </a>
                            <div class="text-dark my-2">or</div>
                            <a href="/register" class="col py-3 bg-dark border rounded">
                                <b-icon-chat-square-text class="d-inline text-white" width="25" height="25"></b-icon-chat-square-text>
                                <span class="d-inline ml-2 text-white my-auto fw-bold">Register</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <!-- Confirm Order Modal -->
        <Modal
            v-model="confirmModal"
            footer-hide
        >
            
            <div class="p-3 rounded">

            <div class="text-center p-3 bg-light rounded">
                <h6 class="text-success fw-bold">Your Booking Has been Recived </h6>
                <p class="text-dark text-sm">Let us check the hotel availability </p>
            </div>

            <div class="row p-3 text-center my-2">
                <div class="col-md-6 my-auto">
                <a href="/profile" class="py-2 px-2 bg-primary border rounded">
                    <b-icon-box-arrow-right class="d-inline text-white" width="15" height="15"></b-icon-box-arrow-right>
                    <span class="d-inline ml-2 text-white my-auto fw-bold">Booking Details</span>
                </a>
                </div>
                <div class="col-md-6 my-auto">
                <div class="p-2 border rounded text-center">
                    <small class="text-dark">We will contact you through email or phone number.</small>
                    <p class="text-sm text-success">We Will Let You Know Shortly.</p>
                </div>
                </div>
            </div>

            </div>
        </Modal>

    </div>
</template>

<script>

import { VueperSlides, VueperSlide } from 'vueperslides';
import 'vueperslides/dist/vueperslides.css';

export default {
    props:['hotel'],
    components:{
        VueperSlides,
        VueperSlide
    },
    data(){
        return{
            bookingHistory:false,
            confirmModal: false,
            user: this.$store.state.client,
            hotelDetails:false,
            errors:{},
            urlList:[],
            data:{
                room: 1,
                adult:1,
                child:0,
                booking_date: new Date(),
                inDate:'',
                outDate:'',
                hotel_name:'',
                hotel_address: '',
                hotel_phone: '',
                hotel_email: '',
                hotel_price: '',
                id:'',
                rank:'',

            }
        }
    },

    methods: {

        async confirmEmail(){
            const res = await this.callApi("get","order/mailsend");
            if (res.status == 200) {
            //this.hotelList = res.data;
            //console.log(this.hotelList)
            } else {
            this.errorMsg();
            }
        },
        
        async confirmBooking(h,i){
            if(!this.user){
                //window.location('/user-login');
                //this.$router.push('/user-login');
                this.infoMsg("Please Log in or Register First");
            }
            else{
                this.data.id = h.id;
                this.data.hotel_name = h.name;
                this.data.hotel_address = h.address;
                this.data.hotel_phone = h.phone;
                this.data.hotel_email = h.email;
                this.data.rank =h.offerDiscpuntPrice;
                this.data.hotel_price =h.offerDiscpuntPrice * this.data.room;
                //console.log(this.data)
                const res = await this.callApi("post","home/order", this.data);
                if(res.status === 200){
                    this.successMsg("Your Booking Has Been Placed");
                    this.errors = {};
                    this.$store.state.popMoadal = false;
                    this.confirmModal = true;
                    this.confirmEmail();

                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg('Something went wrong! Reload the Page and try again');
                }
            }
        }
              
    }
}
</script>

<style scoped>
.h-fixed{
    height: 350px;
    overflow-y: auto;
}

</style>