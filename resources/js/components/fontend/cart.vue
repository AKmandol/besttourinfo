<template>
    <div>
        

        <div v-if="isLoading" class="preloader">
            <div class="spinner"></div>
        </div>

        <div class="container-fluid main px-0">
            <div class="container-main container position-relative bg-white border shadow rounded py-4 px-2">

                <div class="accordion" id="accordionExample">

                    <div class="border container-main p-3 d-flex flex-row shadow bg-light rounded-3 position-absolute top-0 start-50 translate-middle">

                        
                        <div class="accordion-header container-main" id="headingOne">
                            <a class="accordion-button rounded-3 bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <!-- <b-icon-house-heart class="text-success d-inline" width="25" height="25"></b-icon-house-heart> -->
                                <img src="/img/icon/bed.png" class="border rounded-circle p-2 d-inline" width="40" height="40" alt="">
                                <span class="ml-2 mr-2 text-center text-dark fw-bold fs-6 d-none d-md-block">Hotel Booking</span>
                            </a>
                        </div>

                    </div>


                    <HotelSearch></HotelSearch>

                </div>

            </div>  
        </div>
        
        <div class="row p-0 container-cus mt-2" v-if="cartItem.length">

            <div class="col-lg-8 col-md-12">
                <h5 class="p-3 bg-card-bg text-center fw-bold text-dark1">Booking Information</h5>

                <div class="p-3 mt-3 border rounded">

                    <div class="row p-3 position-relative" v-for="(cart,i) in cartItem" :key="i">
                        
                        <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                            <div class="row d-flex flex-row">
                                <span class="col-auto aling-middle"><b-icon-house-heart class="text-success d-inline mr-2" width="20" height="20"></b-icon-house-heart>Hotel Name:</span>
                                <span class="col-auto text-dark fw-bold d-inline">{{ cart.hotel_name }}</span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                            <span class="aling-middle"><b-icon-bank class="text-success d-inline mr-2" width="17" height="17"></b-icon-bank>Room Type:<span class="text-dark fw-bold ml-2 text-end">{{ cart.room_type }}</span></span>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                            <span class="aling-middle d-flex"><b-icon-grid-1x2 class="text-success d-inline mr-2" width="17" height="17"></b-icon-grid-1x2>Room No: <span class="text-dark fw-bold ml-2 text-end">{{ cart.room_no }}</span> 
                                <div class="d-flex ml-4">
                                    <b-icon-dash-circle class="btn2-hover text-secondary mx-2 my-auto d-inline" width="18" height="18" @click="roomremove(cart,i)"></b-icon-dash-circle>
                                    <b-icon-plus-circle class="btn2-hover text-success mx-2 my-auto d-inline" width="18" height="18" @click="roomAdd(cart,i)"></b-icon-plus-circle>
                                </div>
                            </span>
                        </div>

                        <div class="col-lg-6 col-md-12 col-sm-12 my-2">
                            <span class="aling-middle"><b-icon-currency-dollar class="text-success d-inline mr-2" width="17" height="17"></b-icon-currency-dollar>Price: <span class="text-muted fw-bold ml-2 text-end text-sm">({{ cart.price_original }} X {{ cart.room_no }}) = <span class="text-dark fw-bold ml-2 h6">{{ cart.price_original*cart.room_no }} ৳</span> <small class="text-dark">per night</small></span></span>
                        </div>

                        <hr class="text-success col-10 mx-auto">

                        <b-icon-trash class="btn-hover text-danger mt-3" width="18" height="18" @click="deleteItem(cart,i)"></b-icon-trash>
                        
                    </div>

                </div>

                <!-- <h6 v-if="this.book.outDate == ''" class="fw-bold text-dark text-end mr-3 mt-1 mb-3">Sub Total:<span class="text-color fw-normal mr-2">(Include VAT)</span> ৳ <span class="text-success">{{ this.total }}</span> <span class="text-dark">/=</span> </h6> -->
                <h6 class="fw-bold text-dark text-end mr-3 mt-1 mb-3">Sub Total:<span class="text-color fw-normal mr-2">(Include VAT)</span>  ৳ <span class="text-success">{{ this.total }}</span> <span class="text-dark">/=</span> </h6>
                

                <div class="p-2 bg2 rounded mt-3 border">

                    <div class="row mb-3 p-3">
                        <span class="col-md-6 col-sm-12 col-form-label">
                            <b-icon-person-hearts class="d-inline text-success mr-2" width="15" height="15"></b-icon-person-hearts>
                            <label class="d-inline text-dark textt-small">No of Adults: <small class="text-dark fw-bold">(Max: {{this.totalAdultPer}})</small> <span class="text-danger">*</span> </label>
                        </span>
                        <div class="col-md-6 col-sm-12 my-auto">
                            <InputNumber class="ml-1 rounded w-100" :min="1" :max="this.totalAdultPer ? this.totalAdultPer : 0" v-model="book.adult" controls-outside :class="hasError('adult') ? 'is-invalid' : '' " />
                            <div class="invalid-feedback" v-if="hasError('adult')">{{getError('adult')}}</div>
                        </div>
                    </div>

                    <div class="row mb-3 p-3">
                        <span class="col-md-6 col-sm-12 col-form-label">
                            <b-icon-person-hearts class="d-inline text-success mr-2" width="15" height="15"></b-icon-person-hearts>
                            <label class="d-inline text-dark textt-small">No of Children:  <small class="text-dark fw-bold">(Age below 12)</small> <span class="text-danger">*</span></label>
                        </span>
                        <div class="col-md-6 col-sm-12 my-auto">
                            <InputNumber class="ml-1 rounded w-100" :max="10" :min="0" v-model="book.child" controls-outside />
                        </div>
                    </div>

                    <div class="row mb-3 p-3">
                        <span class="col-md-6 col-sm-12 col-form-label">
                            <b-icon-calendar2-plus class="d-inline text-success mr-2" width="15" height="15"></b-icon-calendar2-plus>
                            <label class="d-inline text-dark textt-small">Check In Date: <span class="text-danger">*</span> </label>
                        </span>
                        <div class="col-md-6 col-sm-12 my-auto">
                            <input @change="fieldChange" v-model="book.inDate" type="date" class="form-control form-control-sm border-0" :class="hasError('inDate') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('inDate')">{{getError('inDate')}}</div>
                        </div>
                        <span class="col-md-6 col-sm-12 col-form-label">
                            <b-icon-calendar2-plus class="d-inline text-success mr-2" width="15" height="15"></b-icon-calendar2-plus>
                            <label class="d-inline text-dark textt-small">Check Out Date: <span class="text-danger">*</span> </label>
                        </span>
                        <div class="col-md-6 col-sm-12 my-auto">
                            <input type="date" v-model="book.outDate" class="form-control form-control-sm border-0" @change="fieldChange" :class="hasError('outDate') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('outDate')">{{getError('outDate')}}</div>
                        </div>
                    </div>

                    <div class="px-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="term" value="1" v-model="book.terms" :class="hasError('terms') ? 'is-invalid' : '' ">
                            <label class="form-check-label text-small text-dark ml-2 align-middle" for="term">Please accept our <a target="_blank" href="https://besttourinfo.com/terms-and-condition">Tearms and Conditions</a>, <a target="_blank" href="https://besttourinfo.com/privacy-policy">Privacy Policy</a> and <a target="_blank" href="https://besttourinfo.com/refund-policies">Return Refund Policy</a> </label>
                            <div class="invalid-feedback" v-if="hasError('terms')">{{getError('terms')}}</div>
                        </div>
                    </div>

                    <div class="text-center mt-4 mx-auto">

                        
                        <a v-if="this.transction_id == '' " @click="confirmBooking" class="col-md-4 col-sm-12 m-2 btn-dark1 shadow btn">
                            <span v-if="!loadingPay" class="fw-bold text-warning"><b-icon-caret-right-square class="d-inline text-danger mr-2" width="17" height="17"></b-icon-caret-right-square>Check Now</span>
                            <span v-else>Loading...</span>
                        </a>

                        <a v-show="this.transction_id" class="fw-bold btn btn-dark1 shadow text-warning px-2" @click="sslHotelOrder" id="sslczPayBtn"
                            postdata=" "
                            order=" "
                            endpoint="/pay-via-ajax-ssl"> <span class="text-light mr-2">৳</span>Make Payment
                        </a>

                    <!-- <a @click="confirmBooking2" class="col-md-4 col-sm-12 m-2 btn-dark1 shadow btn">
                    <span v-if="!loadingPay" class="fw-bold text-warning"><b-icon-caret-right-square class="d-inline text-danger mr-2" width="17" height="17"></b-icon-caret-right-square>Pay Now</span>
                    <span v-else>Loading...</span>
                    </a> -->

                    </div>

                </div>              
            </div>

            <div class="col-md-4 col-sm-12 d-none d-lg-block">
                <h6 class="p-3 bg-card-bg text-center fw-bold text-dark1">Your Information</h6>
                <div class="table-responsive border rounded py-2 my-3">
                    <table class="table table-borderless text-center">
                        <tbody>
                            <tr class="aling-middle">
                                <td class="d-flex align-items-center justify-content-center"><b-icon-person-check class="text-success d-inline mr-2" width="17" height="17"></b-icon-person-check>Your Name:</td>
                            </tr>
                            <tr class="aling-middle">
                                <td class="fw-bold">{{ this.$store.state.client.name }}</td>
                            </tr>
                            <tr class="aling-middle" v-if="this.$store.state.client.mobile">
                                <td class="d-flex align-items-center justify-content-center"><b-icon-telephone-plus-fill class="text-success d-inline mr-2" width="17" height="17"></b-icon-telephone-plus-fill>Phone Number:</td>
                            </tr>
                            <tr class="aling-middle" v-if="this.$store.state.client.mobile">
                                <td class="fw-bold ml-4">{{ this.$store.state.client.mobile }}</td>
                            </tr>
                            <tr class="aling-middle">
                                <td class="d-flex align-items-center justify-content-center"><b-icon-envelope-check class="text-success d-inline mr-2" width="17" height="17"></b-icon-envelope-check>Your Email Email:</td>
                            </tr>
                            <tr class="aling-middle">
                                <td class="fw-bold ml-4">{{ this.$store.state.client.email }}</td>
                            </tr>
                            <tr class="text-center mt-3">
                                <td colspan="3"><a class="mt-3 p-2 border bg fw-bold rounded text-white" href="/profile">Change Information</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    <img src="img/Payment Banner_Jan23_V2-01.jpg" class="img-fluid rounded" alt="">
                </div>

            </div>

        </div>

        <div class="row p-3 container-cus my-auto mt-2" v-else>
            
            <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white shadow border-bottom rounded">
                    <div class="d-flex justify-content-center aling-items-center p-2">
                        <a @click="backOne" class="nav-link bg-white border shadow rounded">
                            <b-icon-cart class="d-inline nav-icon" width="18" height="18"></b-icon-cart>
                            <span class="d-inline ml-2 text-dark fw-bold mr-2">Back to Booking</span>
                        </a>
                        <span class="text-secondary my-auto mx-4"><b-icon-arrow-bar-left class="d-inline nav-icon" width="25" height="25"></b-icon-arrow-bar-left></span>
                        <router-link to="/" class="nav-link bg-white border shadow rounded">
                            <b-icon-grid-fill class="d-inline nav-icon" width="15" height="15"></b-icon-grid-fill>
                            <span class="d-inline text-dark fw-bold ml-2">Home</span>
                        </router-link>
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

import { Time } from 'view-ui-plus';
import $ from 'jquery';
import HotelSearch from '../search/hotelSearch.vue';
import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'

export default {

    components: {
        VueperSlides,
        VueperSlide,
        HotelSearch
    },

    data () {
        return {
            payRadio: 1,
            vatTax: '',
            loading2: false,
            loadingPay: false,
            isLoading: true,
            user: this.$store.state.client,
            errors:{},
            modal: false,
            Roommodal: false,
            orderModal: false,
            confirmModal: false,
            rfId: '',
            total: '', 
            subTotal: '', 
            cartId: '',
            totalAdultPer:'',
            transction_id:'',
            postdata: {},
            cartItem: [{
            }],
            book:{
                adult:1,
                child:0,
                booking_date: new Date(),
                inDate:'',
                outDate:'',
                payment_type:'',
                transction_no:'',
                terms:'',
            },
           
            bookTime: 1,
            csrf: ''
            
        }
    },

    methods: {

        async sslHotelOrder(){
            
            var obj = {};
            obj.cartItem = this.cartItem;
            obj.adult = this.book.adult;
            obj.booking_date = this.book.booking_date;
            obj.inDate = this.book.inDate;
            obj.outDate = this.book.outDate;
            obj.terms = this.book.terms;
            obj.amount = this.total;
            obj.transction_id =  this.transction_id;
            obj.shipping_method =  "NO";
            obj.product_name =  "Hotel_Rent";
            obj.product_category =  "Travel";
            obj.product_profile =  "Virtual";
            $('#sslczPayBtn').prop('postdata', obj);
 
        },

        backOne(){
            setTimeout(() => {
                window.location='hotel';
        }, 500); 
        },

        errAd(){
        if(this.totalAdultPer <= this.book.adult){
            this.errorMsg('Number of Room Needed to Expand');
        }
        },

        fieldChange(){
            this.loading2 = false;
            const today = new Date();
            const startTimestamp = new Date(this.book.inDate);
            const endTimestamp = new Date(this.book.outDate);

            if( startTimestamp < today ){
                this.errors = { inDate: ["Invalid Date ! Hotel Check In Date Can't be Less than Todays Date"] };
                this.book.inDate = '';
                this.total = 0;
            }

            if( endTimestamp <= startTimestamp ){
                this.errors = { outDate: ["Invalid Date ! Hotel Check In Date Less than Hotel Check Out Date."] };
                this.book.outDate = '';
                this.total = 0;
            }

            else {
                const millisecondsPerDay = 1000 * 60 * 60 * 24; 
                const differenceInDays = Math.floor((endTimestamp - startTimestamp) / millisecondsPerDay);
                this.bookTime = differenceInDays;
                return this.totalPrice();
            }           
        },

        async getCart() {
            const res = await this.callApi("get","home/getCart");
            if (res.status == 200) {
                this.cartItem = res.data;
            } else {
                this.errorMsg();
            }

            this.csrf = document.head.querySelector('meta[name="csrf-token"]').content;

        },

        async getVat() {
            const res = await this.callApi("get", "vat/get");
            if (res.status == 200) {
                this.vatTax = res.data;
                //console.log(this.vatTax)
            } else {
                this.errorMsg();
            }
        },

        async totalPrice(){
            this.total = this.cartItem.reduce( (acc, item) => {
                return acc + ( 1 * item.price * this.bookTime) + Math.floor((item.price / 100) * this.vatTax[0].hotel_vat);
            }, 0);
        },

        async totalAdult(){
            this.book.adult = 1;
            this.totalAdultPer = this.cartItem.reduce( (acc, item) => {
                return acc + ( 1 * item.hotel_id * item.room_no);
            }, 0);
        },

        async booking(room,i) {

            if(!this.user){
                this.modal = true;
            }
            else{
                this.cart = true;
                
                this.cartItem.push({
                    room_id : room.id,
                    hotel_id : room.totalPerson,
                    hotel_name : room.hotel_name,
                    hotel_address : room.hotel_address,
                    hotel_phone : room.hotel_phone,
                    hotel_email : room.hotel_email,
                    room_type : room.offerTitle,
                    room_no: 1,
                    price : room.offerDiscpuntPrice,
                    price_original : room.offerDiscpuntPrice,
                })
                const res = await this.callApi("post","home/cart", {cartItem: this.cartItem,total: this.total});
                if(res.status === 200){
                    this.successMsg("Item Added to cart, Please continue for confirm booking.");
                    this.cartItem = res.data;
                    this.totalPrice();
                }else {
                    this.errorMsg('Something went wrong! Please try again');
                }
            
            }

        },

        async roomAdd(item,i){
            this.cartId = item.id;
            item.room_no++
            const res = await this.callApi("post","home/roomAdd", {id: this.cartId, room: item.room_no, price_original: item.price_original});
            if (res.status == 200) {
                this.cartItem = res.data;
                this.totalAdult();
                this.totalPrice();
            } else {
                this.errorMsg();
            }
            
        },

        async roomremove(item,i){
            this.cartId = item.id;
            if(item.room_no > 1){
                item.room_no--
            }
            const res = await this.callApi("post","home/roomRemove", {id: this.cartId, room: item.room_no, price_original: item.price_original});
            if (res.status == 200) {
                this.cartItem = res.data;
                this.totalAdult();
                this.totalPrice();
            } else {
                this.errorMsg();
            }
            
        },

        async deleteItem(item,i){
            this.cartId = item.id;
            const res = await this.callApi("post","home/delete_cart", item);
            if (res.status == 200) {
                this.cartItem.splice(i,1);
                this.totalPrice();
                this.successMsg("Cart Item deleted Successfully.");
            } else {
                this.errorMsg();
            }
            
        },

        async confirmEmail(){
            const res = await this.callApi("post","order/mailsend", {tarns: this.transction_id, clientEmail: this.user.email,clientPhone: this.user.mobile,clientName: this.user.name,sub: this.total,cartItem: this.cartItem,adult: this.book.adult,child: this.book.child,booking_date: this.book.booking_date,inDate: this.book.inDate,outDate: this.book.outDate,payment_type: this.book.payment_type,transction_no: this.book.transction_no});
            if (res.status == 200) {
            } else {
            this.errorMsg();
            }
        },

        async confirmEmailClient(){
            const res = await this.callApi("post","order/mailsendClient" , {tarns: this.transction_id, clientEmail: this.user.email,clientPhone: this.user.mobile,clientName: this.user.name,sub: this.total,cartItem: this.cartItem,adult: this.book.adult,child: this.book.child,booking_date: this.book.booking_date,inDate: this.book.inDate,outDate: this.book.outDate,payment_type: this.book.payment_type,transction_no: this.book.transction_no});
            if (res.status == 200) {
            } else {
            this.errorMsg();
            }
        },

        async confirmBooking(){

            if(this.book.inDate == ''){
                this.errors = { inDate: ["Please Select a Arrival Date."] };
                return;
            }
            if(this.book.outDate == ''){
                this.errors = { outDate: ["Please Select a Check Out Date."] };
                return;
            }
            if(this.book.terms ==  ''){
                this.errors = { terms: ["Please accept our Tearms and Conditions."] };
                return;
            }else{
                this.loading2 = true;
                this.isLoading = true;
                const res = await this.callApi("post","home/order", {adultPer:this.totalAdultPer, price: this.total2,cartItem: this.cartItem,adult: this.book.adult,child: this.book.child,booking_date: this.book.booking_date,inDate: this.book.inDate,outDate: this.book.outDate,payment_type: this.book.payment_type,transction_no: this.book.transction_no,terms:this.book.terms});
                if(res.status === 200){
                    this.transction_id = res.data;
                    this.errors = {};
                    this.cart = false;
                    setTimeout(() => {
                        this.isLoading = false;
                    },1000); 
                    setTimeout(() => {
                        this.confirmEmail();
                        this.confirmEmailClient();
                    },1000); 
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    this.errors = res.data.errors
                    }
                    this.loading2 = false;
                    this.isLoading = false;
                }
                else {
                    this.errorMsg('Something went wrong! Please try again');
                    this.isLoading = false;
                }
            }
        },

        
        async payNow(){
            this.loadingPay = true;
        },

        async confirmBooking2() {
            // <a @click="confirmBooking" class="col-md-4 col-sm-12 m-2 btn-dark1 shadow btn">
            //                 <span v-if="!loadingPay" class="fw-bold text-warning"><b-icon-caret-right-square class="d-inline text-danger mr-2" width="17" height="17"></b-icon-caret-right-square>Pay Now</span>
            //                 <span v-else>Loading...</span>
            //             </a>
            // if (this.book.inDate === '') {
            //     this.errors = { inDate: ["Please select check-in date."] };
            //     return;
            // }
            // if (this.book.outDate === '') {
            //     this.errors = { outDate: ["Please select check-out date."] };
            //     return;
            // }
            // if (this.book.terms  === '') {
            //     this.errors = { terms: ["Please accept our Tearms and Conditions."] };
            //     return;
            // }
            // if (this.totalAdultPer < this.book.adult) {
            //     this.errors = { adult: ["Maximum number of person exceeded."] };
            //     return;
            // }

            try {
                // Show loading spinner
                this.isLoading = true;

                // API call to initiate payment
                const res = await this.callApi("post", "/payment-initiate", {
                    adultPer: this.totalAdultPer,
                    price: this.total2,
                    cartItem: this.cartItem,
                    adult: this.book.adult,
                    child: this.book.child,
                    booking_date: this.book.booking_date,
                    inDate: this.book.inDate,
                    outDate: this.book.outDate,
                    payment_type: this.book.payment_type,
                    transction_no: this.book.transction_no,
                    terms: this.book.terms,
                }, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                console.log("res");
                console.log(res);
                if (res.status == 200) {
                    const gatewayPageURL = res.data?.GatewayPageURL;
                    if (gatewayPageURL) {
                        window.location.href = gatewayPageURL;
                    } else {
                        throw new Error("Invalid Gateway URL received.");
                    }
                } else if (res.status === 422) {
                    this.errorMsg('Validation Error. Please review your input.');
                    this.errors = res.data.errors || {};
                } else {
                    this.errorMsg('Something went wrong! Please try again');
                }
            } catch (error) {
                console.error('Error during booking confirmation:', error);
                this.errorMsg(error.message || 'An unexpected error occurred.');
            } finally {
                // Hide loading spinner
                this.isLoading = false;
            }
        },

    },

    created(){
        this.getCart();
        this.getVat();
        setTimeout(() => {
            this.isLoading = false;
            this.totalPrice();
            this.totalAdult();
        }, 1000); 
    },
}
</script>
  
<style scoped>

td{
 border: 0;
}

.text-small{
    font-size: 13px;
}
.text-color{
    color: #3d3d3d;
    font-size: 12px;
}
.btn-hover{
    position: absolute;
    top: 100;
    right: 10px;
    width: max-content;
}

.btn-hover:hover{
    cursor: pointer;
    color: red !important;
}
.btn2-hover:hover{
    border: 1px solid rgba(255, 0, 0, 0);
    cursor: pointer;
}
.bg-cart {
    background: #002c3e;
}

.bg-cart2 {
    background: #ffffff;
}

.cart-main{
    position: fixed;
    top: 29%;
    right: 0;
    max-height: 350px;
    width: 325px;
    background: #093f56e7;
    border-radius: 7px;
    overflow-y: auto;
    overflow-x: hidden;
}

.text-dark{
    color: #000;
}
.cart-icon{
    position: fixed;
    top: 20%;
    right: 0;
    background: linear-gradient(0.25turn, #3f87a6, #1e4600, #834400);
    border-radius: 7px;
    transition: transform .3s;
    border: 1px solid #fff;
}
.cart-icon:hover{
    background: #000 !important;
    transform: scale(1.05);
}

.btn-cart{
    background: #021f2b;
    padding: 7px 15px;
    border-radius: 7px;
    color: #efededd9;
    font-weight: bold;
    border-bottom: .5px solid #ffffffc3;
    transition: transform .3s;
}

.btn-cart:hover{
    background: linear-gradient(0.25turn, #3f87a6, #1e4600, #834400);
    color: #efeded;
    font-weight: bold;
    border-bottom: .5px solid #ffffffc3;
    transform: scale(1.05);
}

.text-btn{
    background: linear-gradient(0.25turn, #3f87a6, #1e4600, #834400);
    padding: 10px 18px;
    border-radius: 10px;
    color: #efeded;
    font-weight: bolder;
}
.text-btn:hover{
    background: linear-gradient(0.25turn,#834400,#3f87a6,#1e4600);
    padding: 9px 17px;
    border-radius: 10px;
    color: #ffffff;
    font-weight: bolder;
}
.widthCus{
    width: 100px;
}
.container-cus{
    width: 90%;
    margin-left: auto;
    margin-right: auto;
    padding-bottom: 50px !important;
}
.main {
  padding-top: 180px;
  padding-bottom: 70px;
  background-image:  repeating-radial-gradient( circle at 0 0, transparent 0, #626262b0 5px ), repeating-linear-gradient( #093200bb, #000000c2 );
  margin-bottom: 25px;
}
.image-main {
  border-radius: 7px;
}
.container-main {
  border-radius: 7px;
}

.image-main {
  position: relative;
  padding: 2px 0px;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
  border-radius: 7px;
}

.rounded-cos{
  /* opacity: .8;  
  border-radius: 8px;
  font-size: 11px;
  background: linear-gradient(0.25turn,#763d00, #000000, #1f4800);
  color: #fff;
  font-weight: bolder; */
  margin-right: 3px;
  margin-bottom: 3px;
  padding: 5px;
  
}
.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.image-main:hover .image {
  transform: scale(1.02); 
}

.image-main:hover .middle {
  opacity: 1;
}
.text {
  background: linear-gradient(0.25turn, #3f87a6, #398300, #f69d3c);
  color: white;
  font-weight: 600;
  font-size: 15px;
  padding: 3px 10px;
  border-radius: 8px;
  cursor: pointer;
}

.max-height{
    height: 500px;
}

.bg{
    background: linear-gradient(0.25turn, #093f56, #714e02, #9b5203);
}
.bg2{
    padding: 15px !important;
    background: linear-gradient(0.25turn,#ddfbc612, #f69c3c23, #3f87a63a) !important;
}
.bg-card-bg{
    background: #3f87a61e;
    border-radius: 5px;
}
.border-cus{
    border: 1px solid #4a7f9649;
    background: linear-gradient(0.25turn,#ddfbc63c, #f69c3c52, #3f87a670) !important;
}

.input-group-text {
  border-left: 0 !important;
  
}

#floatingPassword{
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

</style>