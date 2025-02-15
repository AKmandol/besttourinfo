<template>
    <div>
        <div  v-if="orderModal" class="modal fade m-70 over" data-bs-backdrop="static" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable modal-fullscreen-lg-down">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-dark fw-bolder text-center w-100" id="exampleModalLabel">Your Hotel Booking</h1>
                    <span type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
                </div>

                <div class="modal-body bg-white" v-if="orderList != ''">
                
                    <div class="d-none d-md-block">

                        <table class="table table-bordered rounded text-dark text-center">
                            <thead>
                                <tr class="border border-success">
                                    <th scope="col">SL</th>
                                    <th scope="col">Hotel Information</th>
                                    <th scope="col">Other Information</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>

                                <tr v-for="(hotel,i) in orderList" :key="i" class="mx-0 px-0 my-auto">
                                    <th scope="row" class="align-middle">{{ i+1 }}</th>
                                    <td class="mx-0 px-1 align-middle text-start fw-bold">
                                        <span class="my-2" v-for="(h,i) in hotel.order_details" :key="i">
                                            {{++i}}. Name: <span class="fw-normal">{{ h.hotel_name }}</span><br>
                                            Room Type: <span class="fw-normal">{{ h.room_type }}</span><br>
                                            Email: <span class="fw-normal">{{ h.hotel_email }}</span> <br>
                                            Phone: <span class="fw-normal">{{ h.hotel_phone }}</span> <br>
                                            Rooms: <span class="fw-normal">{{ h.room_no }}</span><br>
                                            Rent: <span class="fw-normal">({{ h.room_type_price }} X {{ h.room_no }}) = {{ parseInt(h.room_no * h.room_type_price) + parseInt(((h.room_no * h.room_type_price)/100)) * this.vatTax[0].hotel_vat }} ৳</span><br>
                                        </span>
                                    </td>
                                    <td  class="mx-0 px-1 align-middle text-start fw-bold"> 
                                        Check In: <span class="float-end fw-normal">{{ hotel.check_in }}</span><br>
                                        Check Out: <span class="float-end fw-normal">{{ hotel.check_out }}</span><br>
                                        Total Adult: <span class="float-end fw-normal">{{ hotel.no_of_adult }}</span> <br>
                                        Total Children: <span class="float-end fw-normal">{{ hotel.no_of_child }}</span>
                                    </td>
                                    <!-- <td  class="mx-0 px-0 align-middle">
                                        ({{ hotel.room_type_price }} X {{ hotel.room_no }}) = {{ parseInt(hotel.room_no * hotel.room_type_price) + parseInt(((hotel.room_no * hotel.room_type_price)/100)) * this.vatTax[0].hotel_vat }} ৳ <br>
                                        <span class="text-sm text-muted"> (Include VAT)</span>
                                    </td> -->
                                    <td  class="mx-0 px-0 align-middle"> <span class="px-1"> {{ hotel.payment_status }} </span></td>
                                    <td  class="mx-0 px-0 my-auto align-middle" v-if="hotel.payment_status =='Pending'">
                                        <a class="m-1 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#view" @click="edit(hotel,i)"><b-icon-eye class="d-inline mr-1 text-dark" width="16" height="16"></b-icon-eye></a>
                                        <a class="m-1 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#editOrder" @click="edit(hotel,i)"><b-icon-pencil-square class="d-inline mr-1 text-primary" width="16" height="16"></b-icon-pencil-square></a>
                                        <a class="m-1 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#modalOrder" @click="DeleteModal(hotel,i)"><b-icon-trash class="d-inline mr-1 text-danger" width="16" height="16"></b-icon-trash></a>
                                    </td>
                                    <td  class="mx-0 px-0 my-auto align-middle col-3"  v-else-if="hotel.payment_status =='Completed'">
                                        <p class="text-sm text-center text-success shadow-sm p-2 mx-2 bg-white rounded">Order Completed.</p>
                                    </td>
                                    <td  class="mx-0 px-0 my-auto align-middle col-3" v-else-if="hotel.payment_status =='Processing'">
                                        <p class="text-sm text-center text-primary p-2 mx-2 shadow-sm bg-white rounded">Order is Processing,Can't modify now. Please contact our Support Team.</p>
                                    </td>
                                    <td  class="mx-0 px-0 my-auto align-middle col-3 text-dark1" v-else>
                                        Payment Failed <a class="m-1 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#modalOrder" @click="DeleteModal(hotel,i)"><b-icon-trash class="d-inline mr-1 text-danger" width="16" height="16"></b-icon-trash></a>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        
                        <span>
                            <div class="float-end px-4 py-2 d-inline">
                                <h6 class="text-dark fw-bold d-inline mr-2">Subtotal:<span class="text-color fw-normal mr-2">(Include VAT)</span> </h6>
                                <h6 class="text-danger fw-bold d-inline ml-2">{{this.total}} <small>৳</small></h6>
                                <!-- <h6 class="text-dark fw-bold d-inline ml-2">{{hotel.total_price}} ৳</h6> -->
                            </div>
                        </span>
       
                    </div>

                    <div class="d-md-none d-sm-block">

                        <table class="table table-bordered rounded text-dark text-center">
                            <thead>
                                <tr class="border border-success">
                                    <th scope="col">SL</th>
                                    <th scope="col">Booking Information</th>
                                </tr>
                            </thead>
                            <!-- <tbody class="text-center border my-auto" v-show="hotelList ==[]">
                                <tr>
                                    <span class="text-center py-3">No Data Found</span>
                                </tr>
                            </tbody> -->
                            <tbody>

                                <tr v-for="(hotel,i) in orderList" :key="i" class="mx-0 px-0 my-auto">
                                    <th scope="row" class="align-middle">{{ i+1 }}</th>
                                    <td class="mx-0 px-1 align-middle text-start fw-bold">

                                        <span class="my-2" v-for="(h,i) in hotel.order_details" :key="i">
                                            {{++i}}. Name: <span class="fw-normal">{{ h.hotel_name }}</span><br>
                                            Room Type: <span class="fw-normal">{{ h.room_type }}</span><br>
                                            Email: <span class="fw-normal">{{ h.hotel_email }}</span> <br>
                                            Phone: <span class="fw-normal">{{ h.hotel_phone }}</span> <br>
                                            Rooms: <span class="fw-normal">{{ h.room_no }}</span><br>
                                            Rent: <span class="fw-normal">({{ h.room_type_price }} X {{ h.room_no }}) = {{ parseInt(h.room_no * h.room_type_price) + parseInt(((h.room_no * h.room_type_price)/100)) * this.vatTax[0].hotel_vat }} ৳</span><br>
                                        </span>

                                        Check In: <span class="fw-normal">{{ hotel.check_in }}</span><br>
                                        Check Out: <span class="fw-normal">{{ hotel.check_out }}</span><br>
                                        Adult: <span class="ml-3 fw-bold">{{ hotel.no_of_adult }}</span> <br>
                                        Children: <span class="ml-3 fw-bold">{{ hotel.no_of_child }}</span><br>
                                        <!-- Sub total: <span class="ml-3 fw-bold text-danger">{{ this.singleTotalCost }} </span> ৳<br> -->
                                        Payment Status: <span class="px-1"> {{ hotel.payment_status }} </span><br>
                                        <div  class="mx-0 px-0 my-auto align-middle" v-if="hotel.payment_status =='Pending'">
                                            <a class="m-1 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#view" @click="view(hotel,i)"><b-icon-eye class="d-inline mr-1 text-dark" width="16" height="16"></b-icon-eye></a>
                                            <a class="m-1 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#editOrder" @click="edit(hotel,i)"><b-icon-pencil-square class="d-inline mr-1 text-primary" width="16" height="16"></b-icon-pencil-square></a>
                                            <a class="m-1 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#modalOrder" @click="DeleteModal(hotel,i)"><b-icon-trash class="d-inline mr-1 text-danger" width="16" height="16"></b-icon-trash></a>
                                        </div>
                                        <div  class="mx-0 px-0 my-auto align-middle"  v-else-if="hotel.payment_status =='Completed'">
                                            <p class="text-sm text-success p-2 mx-2 bg-white rounded">Order Completed.</p>
                                        </div>
                                        <div  class="mx-0 px-0 my-auto align-middle" v-else-if="hotel.payment_status =='Processing'">
                                            <p class="text-sm text-primary p-2 mx-2 shadow-sm bg-white rounded">Order is Processing,Can't modify now. <br> Please contact our Support Team.</p>
                                        </div>  
                                        <div  class="mx-0 px-0 my-auto align-middle" v-else>
                                            <a class="m-1 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#modalOrder" @click="DeleteModal(hotel,i)"><b-icon-trash class="d-inline mr-1 text-danger" width="16" height="16"></b-icon-trash></a>
                                        </div>  
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        
                        <span>
                            <div class="float-end px-4 py-2 d-inline">
                                <h6 class="text-dark fw-bold d-inline mr-2">Subtotal:<span class="text-color fw-normal mr-2">(Include VAT)</span> </h6>
                                <h6 class="text-danger fw-bold d-inline ml-2">{{this.total}} <small>৳</small></h6>
                                <!-- <h6 class="text-dark fw-bold d-inline ml-2">{{hotel.total_price}} ৳</h6> -->
                            </div>
                        </span>
       
                    </div>
                    
                
                </div>

                <div class="modal-body bg-white m-0 p-0" v-else>
                
                   
                    <h6 class="p-3 fw-bold text-center text-warning my-3">Booking List Empty</h6>
             
                </div>

                <div class="modal-footer justify-content-end border-top mt-2">
                <button type="button" class="btn btn-secondary btn-sm float-end col-3 py-2 btn-dark1 border-0 fw-bold" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
            </div>

        </div>

        <!-- View Modal -->
        <div class="modal fade m-70 height-fixed" id="view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
            <div class="modal-header text-center justify-content-center">
                <h5 class="ml-2 fw-bolder text-dark">Your Booking</h5>
            </div>

            <div class="modal-body">

                <div class="text-center text-dark border bg-white rounded py-3 mb-2">
                    <span class="my-2" v-for="(h,i) in editData.details" :key="i">
                        <p class="text-dark fw-bold text-center mx-2"><b-icon-house-heart class="text-primary d-inline mr-2" width="15" height="15"></b-icon-house-heart>{{++i}}. Hotel Name:<span class="fw-normal ml-2">{{ h.hotel_name }}</span></p>
                        <p class="text-dark text-center mx-2"><b-icon-bank class="text-warning d-inline mr-2" width="15" height="15"></b-icon-bank>Room Type:<span class="fw-normal ml-2">{{ h.room_type }}</span></p>
                        <p class="text-dark py-2 fw-bold mx-2"><b-icon-geo-alt-fill class="text-success d-inline mr-2" width="15" height="15"></b-icon-geo-alt-fill>Hotel Address:<span class="fw-normal ml-2">{{ h.hotel_address }}</span></p>
                        <p class="text-dark py-2 mx-2"><b-icon-coin class="text-danger d-inline mr-2" width="15" height="15"></b-icon-coin><span class="mr-2 fw-bold">Total:</span>({{ h.room_type_price }} X {{ h.room_no }}) =  {{ h.room_type_price  *  h.room_no }}৳  </p>
                    </span>
                </div>

                <div class="text-center border bg-white rounded py-3 mb-2">
                    <p class="text-dark fw-bold text-center mx-2"><b-icon-coin class="text-info d-inline mr-2" width="15" height="15"></b-icon-coin>Sub total:<span class="fw-normal ml-2">{{ this.singleTotalCost }}</span></p>
                </div>

                <div class="border bg-white rounded p-3 mt-4">

                    <div class="text-center text-dark d-flex justify-content-between border-success border-bottom mb-2">
                        <p class="text-dark1 fw-bold text-center mx-2">Total Adult:<span class="fw-normal ml-2">{{ editData.adult }}</span></p>
                        <p class="text-dark1 fw-bold text-center mx-2">Total Child:<span class="fw-normal ml-2">{{ editData.child }}</span></p>
                    </div>

                    <div class="text-center text-dark d-flex justify-content-between border-success border-bottom mb-2">
                        <p class="text-dark1 fw-bold text-center mx-2">Check in:<span class="fw-normal ml-2">{{ editData.check_in }}</span></p>
                        <p class="text-dark1 fw-bold text-center mx-2">Check out:<span class="fw-normal ml-2">{{ editData.check_out }}</span></p>
                    </div>
                    <div class="text-center text-dark d-flex justify-content-between border-success border-bottom mb-2">
                        <p v-if="editData.payment" class="text-dark1 fw-bold text-center mx-2">Payment Type:<span class="fw-normal ml-2">{{ editData.payment }}</span></p>
                        <p v-else class="text-dark1 fw-bold mx-2"><span class="text-center fw-bold justify-content-center">No Payment get yet</span></p>
                        <p v-if="editData.transtion" class="text-dark1 fw-bold text-center mx-2">Booking Id<span class="fw-normal ml-2">BTI_H-{{ editData.transtion }}</span></p>
                    </div>

                </div>

                

            </div>

            <div class="modal-footer justify-content-between m-0 p-0 border-0">
                <button type="button" class="btn btn-sm btn-secondary col-12 mx-0 px-0 rounded-0 py-3" data-bs-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade m-70 height-fixed" id="editOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header text-center justify-content-center py-4">
                <h5 class="ml-2 fw-bolder text-dark">Edit Your Booking</h5>
            </div>

            <div class="modal-body">

                <div class="text-center text-dark border bg-white rounded py-3 mb-2">
                    <span class="my-2" v-for="(h,i) in editData.details" :key="i">
                        <p class="text-dark fw-bold text-center mx-2"><b-icon-house-heart class="text-primary d-inline mr-2" width="15" height="15"></b-icon-house-heart>{{++i}}. Hotel Name:<span class="fw-normal ml-2">{{ h.hotel_name }}</span></p>
                        <p class="text-dark text-center mx-2"><b-icon-bank class="text-warning d-inline mr-2" width="15" height="15"></b-icon-bank>Room Type:<span class="fw-normal ml-2">{{ h.room_type }}</span></p>
                        <p class="text-dark py-2 fw-bold mx-2"><b-icon-geo-alt-fill class="text-success d-inline mr-2" width="15" height="15"></b-icon-geo-alt-fill>Hotel Address:<span class="fw-normal ml-2">{{ h.hotel_address }}</span></p>
                        <p class="text-dark py-2 mx-2"><b-icon-coin class="text-danger d-inline mr-2" width="15" height="15"></b-icon-coin><span class="mr-2 fw-bold">Total:</span>({{ h.room_type_price }} X {{ h.room_no }}) = {{ h.room_type_price  *  h.room_no }}৳  </p>
                    </span>
                </div>

                <div class="col-12">
                    <div class="p-3 border rounded">
                        <!-- <div class="row mb-3">
                            <span class="col-6 col-form-label">
                                <b-icon-house class="d-inline text-primary mr-2" width="15" height="15"></b-icon-house>
                                <label class="d-inline text-dark textt-small">No of Rooms:</label>
                            </span>
                            <div class="col-6 my-auto">
                                <InputNumber class="ml-1 rounded text-end float-end" :max=10 :min="1" v-model="editData.room" controls-outside />
                            </div>
                        </div> -->

                        <div class="row mb-3">
                            <span class="col-6 col-form-label">
                                <b-icon-person class="d-inline text-primary mr-2" width="15" height="15"></b-icon-person>
                                <label class="d-inline text-dark textt-small">No of Adults:</label>
                            </span>
                            <div class="col-6 my-auto">
                                <InputNumber class="ml-1 rounded text-end float-end" :max="10" :min="1" v-model="editData.adult" controls-outside />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <span class="col-6 col-form-label">
                                <b-icon-person class="d-inline text-primary mr-2" width="15" height="15"></b-icon-person>
                                <label class="d-inline text-dark textt-small">No of Children:  <small class="text-dark fw-bold">(Age below 12)</small></label>
                            </span>
                            <div class="col-6 my-auto">
                                <InputNumber class="ml-1 rounded text-end float-end" :min="0" :max="10" v-model="editData.child" controls-outside />
                            </div>
                        </div>

                        <div class="row mb-3">

                            <span class="col-6 col-form-label">
                                <b-icon-calendar2-plus class="d-inline text-primary mr-2" width="15" height="15"></b-icon-calendar2-plus>
                                <label class="d-inline text-dark textt-small">Check In:</label>
                            </span>
                            <div class="col-6 my-auto">
                                <input  @change="fieldChange" v-model="editData.check_in" type="date" class="form-control bg-light form-control-sm border-0" :class="hasError('check_in') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('check_in')">{{getError('check_in')}}</div>
                            </div>
                            <span class="col-6 col-form-label">
                                <b-icon-calendar2-plus class="d-inline text-primary mr-2" width="15" height="15"></b-icon-calendar2-plus>
                                <label class="d-inline text-dark textt-small">Check Out:</label>
                            </span>
                            <div class="col-6 my-auto">
                                <input @change="fieldChange" type="date" v-model="editData.check_out" class="form-control bg-light form-control-sm border-0" :class="hasError('check_out') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('check_out')">{{getError('check_out')}}</div>
                            </div>
                            <div class="col-12 text-end mt-4">
                                <h6 class="fw-bold text-dark">Sub Total: <span class="text-danger ml-3">{{ this.singleTotalCost }} ৳</span></h6>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer justify-content-between m-0 p-0 border-0">
                <button type="button" class="btn btn-sm btn-secondary col-6 mx-0 px-0 rounded-0 py-3" data-bs-dismiss="modal">Don't Save</button>
                <button type="button" class="btn btn-sm btn-success col-6 mx-0 px-0 rounded-0 py-3" @click="updateOrder">Update</button>
            </div>

            </div>
        </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade m-70" id="modalOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md-fixed">
            <div class="modal-content">
            <div class="modal-header justify-content-center aling-items-center">
                <div class="d-inline">
                    <b-icon-recycle class="d-inline mr-3 text-danger" width="45" height="45"></b-icon-recycle>
                    <h5 class="ml-2 fw-bolder text-dark d-inline">Delete confirmation</h5>
                </div>
            </div>

            <div class="modal-body">

                <div class="text-center text-dark py-3">
                    <p>Are you sure you want to Remove your Booking ?</p>
                </div>

            </div>

            <div class="modal-footer justify-content-between m-0 p-0 border-0">
                <button type="button" class="btn btn-sm btn-secondary col-6 mx-0 px-0 rounded-0 py-3" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-danger col-6 mx-0 px-0 rounded-0 py-3" @click="deleteOrder"><b-icon-trash class="d-inline mr-2 text-white" width="16" height="16"></b-icon-trash>Understood</button>
            </div>
            </div>
        </div>
        </div>

    </div>
</template>
  
<script>
export default {

    data(){
        return{
            errors:{},
            orderList:[],
            orderList2:[],
            vatTax:[],
            orderModal:true,
            total: '',
            data:{
                order_id:'',
            },

            totalAdultPer: null,
            singleTotalCost: 0,

            editData:{
                personQty:'',
                order_id:'',
                hotel_name:'',
                hotel_address:'',
                room: 1,
                adult:1,
                child:0,
                check_in:'',
                check_out:'',
                room_type_price:'',
                total: '',
                payment: '',
                transtion: '',
                room_type: '',
                total_price: '',
                booking_date: '',
                details:'',
                in:'',
            }
        }
    },

    methods: {
        fieldChange(){
            const today = new Date();
            const startTimestamp = new Date(this.editData.check_in);
            const endTimestamp = new Date(this.editData.check_out);

            if( startTimestamp < today ){
                this.errors = { check_in: ["Invalid Date ! Hotel Check In Date Can't be Less than Todays Date"] };
                this.editData.check_in = '';
                this.editData.total = 0;
            }

            if( endTimestamp <= startTimestamp ){
                this.errors = { check_out: ["Invalid Date ! Hotel Check In Date Less than Hotel Check Out Date."] };
                this.editData.check_out = '';
                this.editData.total = 0;
            }else{
                this.errors['check_out'] = [];
            }


            const millisecondsPerDay = 1000 * 60 * 60 * 24; 
            const differenceInDays = Math.floor((endTimestamp - startTimestamp) / millisecondsPerDay);
            
            this.singleTotalCost =  this.editData.details.reduce((acc, item) => {
                return acc + (item.room_type_price * item.room_no) * differenceInDays;
            }, 0);
        },

        async getHotelList(){
            const res = await this.callApi("get","/get_orderList");
            if (res.status == 200) {
                this.orderList = res.data;
                this.totalPrice();
                //console.log(this.orderList)
            } else {
                this.errorMsg();
            }
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
            const data = this.orderList.filter(destination => destination.payment_status == 'Processing');
            this.orderList2 = data;
            //console.log(this.orderList2)
            this.total = this.orderList2.reduce( (acc, item) => {
                return acc + ( 1 * item.backup) + Math.floor((item.backup / 100) * this.vatTax[0].hotel_vat);
            }, 0);
        },

        DeleteModal(hotel,i){
            this.data.order_id = hotel.id;
        },

        async deleteOrder(){
            const res = await this.callApi("post","/delete_orderList",this.data);
            if (res.status == 200) {
                this.infoMsg("Your Booking Has Been Removed")
                this.$router.go();
               // this.pageInfo = res.data;
            } else {
                this.errorMsg();
            }
        },

        async view(hotel,i){
            this.editData.details = hotel.order_details;
            this.editData.adult = hotel.no_of_adult;
            this.editData.child = hotel.no_of_child;
            this.editData.check_in = hotel.check_in;
            this.editData.in = hotel.check_in;
            this.editData.check_out = hotel.check_out;
            this.editData.payment = hotel.payment_type;
            this.editData.transtion = hotel.trasnstion_id;
            setTimeout(() => {
                this.singleTotal();
            }, 500);
        },

        async edit(hotel,i){
            this.editData.order_id = hotel.id;
            this.editData.personQty = hotel.hotel_id;
            this.editData.hotel_name = hotel.hotel_name;
            this.editData.hotel_address = hotel.hotel_address;
            this.editData.room = hotel.room_no;
            this.editData.adult = hotel.no_of_adult;
            this.editData.child = hotel.no_of_child;
            this.editData.check_in = hotel.check_in;
            this.editData.check_out = hotel.check_out;
            this.editData.payment = hotel.payment_type;
            this.editData.transtion = hotel.trasnstion_id;
            this.editData.room_type_price = hotel.room_type_price;
            this.editData.room_type = hotel.room_type;
            this.editData.total_price = hotel.total_price;
            this.editData.booking_date = hotel.booking_date;
            this.editData.details = hotel.order_details;
            setTimeout(() => {
                this.singleTotal();
            }, 500);
        },

        async totalAdult(){
            this.totalAdultPer = this.orderList.reduce( (acc, item) => {
                return acc + ( 1 * item.hotel_id * item.room_no);
            }, 0)
        },

        singleTotal() {
            const startTimestamp = new Date(this.editData.check_in);
            const endTimestamp = new Date(this.editData.check_out);
            const millisecondsPerDay = 1000 * 60 * 60 * 24; 
            const differenceInDays = Math.floor((endTimestamp - startTimestamp) / millisecondsPerDay);
            this.singleTotalCost = this.editData.details.reduce((acc, item) => {
                return acc + (item.room_type_price * item.room_no) * differenceInDays;
            }, 0);
        },


        async updateOrder(){
            //this.editData.total = this.editData.total;
            //console.log(this.editData)
            const res = await this.callApi("post","/update_orderList",this.editData);
            if (res.status == 200) {
                this.successMsg("Your Booking Details Has been Updated")
                this.$router.go();
               // this.pageInfo = res.data;
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
        }
    },

    mounted(){
        this.getVat();
        this.getHotelList();
        setTimeout(() => {
            this.totalPrice();
            this.totalAdult();
        },500); 
        
    }

}
</script>

<style scoped> 
.text-color{
    color: #3d3d3d;
    font-size: 12px;
}
.over {
    max-height: 60vh !important;
    overflow-y: scroll !important;
    width: 100% !important;
}
.modal-md-fixed{
    width: 380px !important;
}
.modal-footer>* {
    margin: 0 !important;
}
.m-70 {
  margin-top: 90px;
  margin-bottom: 10px;
}

</style>