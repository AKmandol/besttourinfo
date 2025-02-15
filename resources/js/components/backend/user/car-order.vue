<template>
    <div>
        <div  v-if="orderModal" class="modal fade m-70 over modal-xxl" data-bs-backdrop="static" id="carOderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable modal-fullscreen-lg-down">
            <div class="modal-content">

                <div class="modal-header">
                <h1 class="modal-title fs-5 text-dark fw-bolder text-center w-100" id="exampleModalLabel">Your Car Booking</h1>
                <span type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
                </div>

                <div class="modal-body bg-white" v-if="orderList != ''">
                
                    <div class="d-none d-md-block">

                        <table class="table table-bordered rounded text-dark text-center">
                            <thead>
                                <tr class="border border-success">
                                    <th scope="col">SL</th>
                                    <th scope="col">Booking Information</th>
                                    <th scope="col">Cost</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Driver info</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>

                                <tr v-for="(car,i) in orderList" :key="i" class="mx-0 px-0 my-auto">
                                    <th scope="row" class="align-middle">{{ i+1 }}</th>
                                    <td class="mx-0 px-1 align-middle text-start fw-bold">
                                        Packeage Name: <span class="ml-3 fw-normal">{{ car.packeage_name }}</span><br>
                                        Car Type: <span class="ml-3 fw-normal">{{ car.car_type }}</span><br>
                                        pick Location: <span class="ml-3 fw-normal">{{ car.pick_up_location }}</span> <br>
                                        Drop Location: <span class="flml-3 fw-normal">{{ car.drop_off_location }}</span><br>
                                        Place Between: <span class="flml-3 fw-normal">{{ car.location_between }}</span><br>
                                        Pick Date Time: <span class="flml-3 fw-normal">{{ car.pick_up_date }}</span><br>
                                       <span v-if="car.drop_off_date">
                                        Return Date Time: <span class="flml-3 fw-normal">{{ car.drop_off_date }}</span><br>
                                       </span>
                                    </td>
                                    <td v-if="car.drop_off_date" class="mx-0 px-1 align-middle text-start text-danger text-center"> {{ car.cost * 2 }}<small>tk</small> </td>
                                    <td v-else class="mx-0 px-1 align-middle text-start text-danger text-center"> {{ car.cost }}<small>tk</small> </td>
                                    <td  class="mx-0 px-0 align-middle"> <span class="px-1"> {{ car.payment_status }} </span></td>
                                    <td  class="mx-0 px-0 align-middle">
                                        <p class="text-sm fw-bold" v-if="car.car_driver_id == 0">Not Assign Yet</p>
                                        <a v-else class="mx-2 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#modalView" @click="view(car,i)"><b-icon-eye class="d-inline mr-1 text-dark" width="16" height="16"></b-icon-eye></a>
                                    </td>
                                    <td  class="mx-0 px-0 my-auto align-middle" v-if="car.payment_status =='Pending'">
                                        <a class="mx-2 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#editCarOrder" @click="edit(car,i)"><b-icon-pencil-square class="d-inline mr-1 text-primary" width="16" height="16"></b-icon-pencil-square></a>
                                        <a class="mx-2 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#modalCarOrder" @click="DeleteModal(car,i)"><b-icon-trash class="d-inline mr-1 text-danger" width="16" height="16"></b-icon-trash></a>
                                    </td>
                                    <td  class="mx-0 px-0 my-auto align-middle col-3"  v-else-if="car.payment_status =='Completed'">
                                        <p class="text-sm text-center text-success shadow-sm p-2 mx-2 bg-white rounded">Order Completed.</p>
                                    </td>
                                    <td  class="mx-0 px-0 my-auto align-middle col-3" v-else-if="car.payment_status =='Processing'">
                                        <p class="text-sm text-primary p-2 mx-2 shadow-sm bg-white rounded">Order is Processing,Can't modify now. Please contact our Support Team.</p>
                                    </td>
                                    <td  class="mx-0 px-0 my-auto align-middle col-3" v-else>
                                        <p class="text-sm p-2 mx-2 bg-white rounded text-dark1">
                                            Payment Failed
                                            <a class="mx-2 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#modalCarOrder" @click="DeleteModal(car,i)"><b-icon-trash class="d-inline mr-1 text-danger" width="16" height="16"></b-icon-trash></a>
                                        </p>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        
                        <span>
                            <div class="float-end px-4 py-2 d-inline">
                                <h6 class="text-dark fw-bold d-inline mr-2">Subtotal <span class="text-sm text-muted">(Include VAT)</span> :</h6>
                                <!-- <h6 class="text-danger fw-bold d-inline ml-2">{{this.total * 2}} <small>৳</small></h6> -->
                                <h6 class="text-danger fw-bold d-inline ml-2">{{ parseInt(this.total) +  Math.floor((parseInt(this.total) / 100) * this.vatTax[0].car_vat) }} <small>৳</small></h6>
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
                            
                            <tbody>

                                <tr v-for="(car,i) in orderList" :key="i" class="mx-0 px-0 my-auto">
                                    <th scope="row" class="align-middle">{{ i+1 }}</th>
                                    <td class="mx-0 px-1 align-middle text-start fw-bold">
                                        Packeage Name: <span class="ml-3 fw-normal">{{ car.packeage_name }}</span><br>
                                        Car Type: <span class="ml-3 fw-normal">{{ car.car_type }}</span><br>
                                        pick Location: <span class="ml-3 fw-normal">{{ car.pick_up_location }}</span> <br>
                                        Drop Location: <span class="ml-3 fw-normal">{{ car.drop_off_location }}</span><br>
                                        Place Between: <span class="ml-3 fw-normal">{{ car.location_between }}</span><br>
                                        Pick Date Time: <span class="ml-3 fw-normal">{{ car.pick_up_date }}</span><br>
                                       <span v-if="car.drop_off_date">
                                        Return Date Time: <span class="fml-3 fw-normal">{{ car.drop_off_date }}</span><br>
                                       </span>
                                        Booking Status: <span class="ml-3 fw-normal">{{ car.payment_status }}</span><br>
                                        View Driver Info: <span class="ml-3 fw-normal">
                                            <p class="text-sm fw-bold" v-if="car.car_driver_id == 0">Not Assign Yet</p>
                                            <a v-else class="mx-2 btn btn-sm shadow-sm border px-2 ml-4" data-bs-toggle="modal" data-bs-target="#modalView" @click="view(car,i)"><b-icon-eye class="d-inline mr-1 text-dark" width="16" height="16"></b-icon-eye></a>
                                        </span><br>

                                        Cost: <span  v-if="car.drop_off_date" class="ml-3-end fw-normal text-danger"> {{ car.cost * 2 }} <small>tk</small></span> <span v-else class="ml-3-end fw-normal text-danger"> {{ car.cost }} <small>tk</small></span><br>
                                    
                                        Payment Status: <span class="mx-0 px-0 align-middle"> {{ car.payment_status }}</span><br>
                                        <div  class="mx-0 px-0 my-auto align-middle" v-if="car.payment_status =='Pending'">
                                            <a class="mx-2 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#editCarOrder" @click="edit(car,i)"><b-icon-pencil-square class="d-inline mr-1 text-primary" width="16" height="16"></b-icon-pencil-square></a>
                                            <a class="mx-2 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#modalCarOrder" @click="DeleteModal(car,i)"><b-icon-trash class="d-inline mr-1 text-danger" width="16" height="16"></b-icon-trash></a>
                                        </div>
                                        <div  class="mx-0 px-0 my-auto align-middle"  v-else-if="car.payment_status =='Completed'">
                                            <p class="text-sm text-success p-2 mx-2 bg-light rounded">Order Completed.</p>
                                        </div>
                                        <div  class="mx-0 px-0 my-auto align-middle" v-else-if="car.payment_status =='Processing'">
                                            <p class="text-sm text-primary p-2 mx-2 shadow-sm bg-light rounded">Order is Processing,Can't modify now. Please contact our Support Team.</p>
                                        </div>
                                        <div  class="mx-0 px-0 my-auto align-middle" v-else>
                                            <a class="mx-2 btn btn-sm shadow-sm border px-2" data-bs-toggle="modal" data-bs-target="#modalCarOrder" @click="DeleteModal(car,i)"><b-icon-trash class="d-inline mr-1 text-danger" width="16" height="16"></b-icon-trash></a>
                                        </div>
                                    </td>
                                    
                                    
                                </tr>
                                
                            </tbody>
                        </table>
                        
                        <span>
                            <div class="float-end px-4 py-2 d-inline">
                                <h6 class="text-dark fw-bold d-inline mr-2">Subtotal <span class="text-sm text-muted">(Include VAT)</span> :</h6>
                                <!-- <h6 class="text-danger fw-bold d-inline ml-2">{{this.total * 2}} <small>৳</small></h6> -->
                                <h6 class="text-danger fw-bold d-inline ml-2">{{ parseInt(this.total) +  Math.floor((parseInt(this.total) / 100) * this.vatTax[0].car_vat) }} <small>৳</small></h6>
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
        <div class="modal fade m-70" id="modalView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header text-center justify-content-center">
                <h5 class="ml-2 fw-bolder text-dark">Your Driver Information</h5>
            </div>

            <div class="modal-body">

                <span v-for="(driver,i) in driverList" :key="i">

                    <div class="row">

                        <div class="col-md-8 col-sm-12">
                            <div class="text-center text-dark border bg-white rounded py-3 d-flex justify-content-between mb-2">
                                <p class="text-dark fw-bold text-center mx-2"><b-icon-person-check class="text-primary d-inline mr-2" width="15" height="15"></b-icon-person-check>Driver Name:<span class="fw-normal ml-2">{{ driver.driver_name }}</span></p>
                            </div>

                            <div class="text-center text-dark border bg-white rounded py-3 d-flex justify-content-between mb-2">
                                <p class="text-dark fw-bold text-center mx-2"><b-icon-truck class="text-primary d-inline mr-2" width="15" height="15"></b-icon-truck>Car Type:<span class="fw-normal ml-2">{{ driver.driver_car_type }}</span></p>
                            </div>

                            <div class="text-center text-dark border bg-white rounded py-3 d-flex justify-content-between mb-2">
                                <p class="text-dark fw-bold text-center mx-2"><b-icon-geo class="text-primary d-inline mr-2" width="15" height="15"></b-icon-geo>Driver Address:<span class="fw-normal ml-2">{{ driver.driver_address }}</span></p>
                            </div>

                            <div class="text-dark border bg-white rounded py-3 mb-2">
                                <p class="text-dark py-2 mx-2"><b-icon-eye class="text-success d-inline mr-2" width="15" height="15"></b-icon-eye><span class="mr-2 fw-bold">Driver Age:</span>{{ driver.driver_age }}</p>
                                <p class="text-dark py-2 fw-bold mx-2"><b-icon-telephone class="text-success d-inline mr-2" width="15" height="15"></b-icon-telephone>Driver Phone:<span class="fw-normal ml-2">{{ driver.driver_phone }}</span></p>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="border bg-white rounded p-3 mt-4 text-center">
                                <img :src="driver.driver_img" class="img-fluid" alt="driver_img">
                            </div>
                        </div>

                    </div>   

                </span>

            </div>

            <div class="modal-footer justify-content-between m-0 p-0 border-0">
                <button type="button" class="btn btn-sm btn-secondary col-12 mx-0 px-0 rounded-0 py-3" data-bs-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade m-70" id="editCarOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center justify-content-center py-4">
                    <h5 class="ml-2 fw-bolder text-dark">Edit Your Car Booking</h5>
                </div>

                <div class="modal-body">

                    <div class="col-12 mb-3">
                        <div class="p-3 border rounded">
                            
                            <div class="row mb-3">

                                <span class="col-md-6 col-sm-12 col-form-label">
                                    <b-icon-calendar2-plus class="d-inline text-primary mr-2" width="15" height="15"></b-icon-calendar2-plus>
                                    <label class="d-inline text-dark textt-small">Pick up Date Time:</label>
                                </span>
                                <div class="col-md-6 col-sm-12 my-auto">
                                    <v-date-picker v-model="editData.pick_up_date" mode="dateTime">
                                        <template v-slot="{ inputValue, inputEvents }">
                                            <div class="d-flex justify-content-center aling-items-center">
                                            <div class="col w-100">
                                                <input :value="inputValue" v-on="inputEvents" class="form-control textt-small" :class="hasError('pick_up_date') ? 'is-invalid' : ''" />
                                                <div class="invalid-feedback" v-if="hasError('pick_up_date')">{{getError('pick_up_date')}}</div>
                                            </div>
                                            </div>
                                        </template>
                                    </v-date-picker>  
                                </div>

                                
                                <span class="col-md-6 col-sm-12 col-form-label mt-2">
                                    <b-icon-calendar2-plus v-if="editData.drop_off_date" class="d-inline text-primary mr-2" width="15" height="15"></b-icon-calendar2-plus>
                                    <input v-else class="form-check-input mr-2" type="checkbox" value="1" v-model="checked" id="flexCheckDefault">
                                    <label class="d-inline text-dark textt-small">Return Date Time: <span class="text-sm text-primary">(If needed)</span> </label>
                                </span>
                                <div class="col-md-6 col-sm-12 my-auto mt-2" v-if="editData.drop_off_date || this.checked == 1">
                                    <v-date-picker v-model="editData.drop_off_date" mode="dateTime">
                                        <template v-slot="{ inputValue, inputEvents }">
                                            <div class="d-flex justify-content-center aling-items-center">
                                            <div class="col-1 my-auto">
                                                <b-icon-trash @click="dateDelete()" class="d-inline mr-2 text-danger" width="18" height="18"></b-icon-trash>
                                            </div>
                                            <div class="col">
                                                <input :value="inputValue" v-on="inputEvents" class="form-control textt-small" :class="hasError('drop_off_date') ? 'is-invalid' : ''" />
                                                <div class="invalid-feedback" v-if="hasError('drop_off_date')">{{getError('drop_off_date')}}</div>
                                            </div>
                                            </div>
                                        </template>
                                    </v-date-picker>  
                                </div>
                                
                                <div class="col-12 text-end mt-4">
                                    <h6 class="fw-bold text-dark">Sub Total <span class="text-sm text-muted">(Include VAT)</span>: 
                                        <span v-if="checked" class="text-danger ml-3">{{ (parseInt(editData.cost) +  Math.floor((parseInt(editData.cost) / 100) * this.vatTax[0].car_vat)) * 2 }} ৳</span> 
                                        <span v-else-if="editData.pick_up_date" class="text-danger ml-3">{{ parseInt(editData.cost) +  Math.floor((parseInt(editData.cost) / 100) * this.vatTax[0].car_vat) }} ৳</span>
                                    </h6>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="text-dark border bg-white rounded py-3 mb-2">
                        <p class="text-dark text-md-center py-1 mx-2"><b-icon-house-heart class="text-success d-inline mr-2" width="20" height="20"></b-icon-house-heart><span class="mr-2 fw-bold">Packeage Name:</span>{{ editData.packeage_name }}</p>
                        <p class="text-dark text-md-center py-1 mx-2"><b-icon-coin class="text-success d-inline mr-2" width="18" height="18"></b-icon-coin><span class="mr-2 fw-bold">One-Way Price:</span> {{ editData.cost}} ৳</p>
                    </div>

                    <div class="text-dark border bg-white rounded py-3 d-md-flex justify-content-between mb-2">
                        <p class="text-dark py-1 mx-2"><b-icon-truck class="text-success d-inline mr-2" width="18" height="18"></b-icon-truck><span class="mr-2 fw-bold">Car type:</span>{{ editData.car_type }}</p>
                        <p class="text-dark py-1 mx-2"><b-icon-bank class="text-success d-inline mr-2" width="18" height="18"></b-icon-bank><span class="mr-2 fw-bold">Status:</span>{{ editData.payment_status }}</p>
                    </div>

                    <div class="text-dark border bg-white rounded p-3 mb-2">
                        <div class="row mb-2">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label">Pick Up Location:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" v-model="editData.pick_up_location">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label">Drop Off Location:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" v-model="editData.drop_off_location">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footers justify-content-between m-0 p-0 border-0">
                    <button type="button" class="btn btn-sm btn-secondary col-6 mx-0 px-0 rounded-0 py-3" data-bs-dismiss="modal">Don't Save</button>
                    <button type="button" class="btn btn-sm btn-success col-6 mx-0 px-0 rounded-0 py-3" @click="updateOrder">Update</button>
                </div>

            </div>
        </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade m-70" id="modalCarOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    <p>Are you sure you want to Remove your Car Booking ?</p>
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
            driverList:[],
            checked: '',
            orderModal:true,
            total: '',
            total2:'',
            data:{
                order_id:'',
            },

            totalAdultPer: null,
            vatTax:  [],

            editData:{
                id: '',
                car_driver_id:'',
                user_id:'',
                packeage_name:'',
                cost:'',
                car_type:'',
                pick_up_location: '',
                pick_up_date:'',
                drop_off_date: Date(),
                drop_off_location:'',
                location_between: '',
                payment_status: '',
                extra_two: '',
            }
        }
    },

    methods: {

        fieldCng(){
            //this.editData.extra_two  * 2;
            if(this.checked){
                this.total2 = parseInt(this.editData.extra_two * 2)
            }else{
                this.total2 =  this.editData.extra_two;
            }
            
        },

        dateDelete(){
            this.editData.drop_off_date = '';
            this.checked = 0 ;
        },

        async getOrderList(){
            const res = await this.callApi("get","/car/get_orderList");
            if (res.status == 200) {
                this.orderList = res.data;
                this.totalPrice();
                //console.log(this.orderList)
            } else {
                this.errorMsg();
            }
        },

        async totalPrice(){
            
            const data = this.orderList.filter(destination => destination.payment_status == 'Processing');
            this.orderList2 = data;

            this.total = this.orderList2.reduce( (acc, item) => {
                if(item.drop_off_date){
                    return acc + ( 1 * item.extra_two * 2);
                }else{
                    return acc + ( 1 * item.extra_two);
                }
            }, 0);
        },

        DeleteModal(car,i){
            this.total2 =this.data.order_id = car.id;
        },

        async deleteOrder(){
            //console.log(this.data)
            const res = await this.callApi("post","/delete_carOrderList",this.data);
            if (res.status == 200) {
                this.infoMsg("Your Booking Has Been Removed")
                this.$router.go();
            } else {
                this.errorMsg();
            }
        },

        async view(car,i){
            const id = car.car_driver_id;
            const res = await this.callApi("post","/car/get_driver",{id:id});
            if (res.status == 200) {
                this.driverList = res.data;
                //console.log(this.driverList)
            } else {
                this.errorMsg();
            }
        },

        async edit(car,i){
            this.editData.id = car.id;
            this.editData.user_id = car.extra_one;
            this.editData.car_driver_id = car.car_driver_id;
            this.editData.packeage_name = car.packeage_name;
            this.editData.cost = car.cost;
            this.editData.car_type = car.car_type;
            this.editData.pick_up_location = car.pick_up_location;
            this.editData.drop_off_location = car.drop_off_location;
            this.editData.pick_up_date = car.pick_up_date;
            this.editData.drop_off_date = car.drop_off_date;
            this.editData.location_between = car.location_between;
            this.editData.payment_status = car.payment_status;
            this.editData.extra_two = car.extra_two;
            console.log(this.editData)
        },

        async updateOrder(){

            console.log(this.editData)
            const pick = this.editData.pick_up_date.toDateString()+' , '+this.editData.pick_up_date.toLocaleTimeString();
            if(this.editData.drop_off_date){
                this.editData.drop_off_date = this.editData.drop_off_date.toDateString()+' , '+this.editData.drop_off_date.toLocaleTimeString();
            }else{
                this.editData.drop_off_date = '';
            }
                
            const res = await this.callApi("post","/update_car_OrderList", {id:this.editData.id, pick_up:pick, drop_off:this.editData.drop_off_date, pick_up_location: this.editData.pick_up_location, drop_off_location: this.editData.drop_off_location, cost:this.editData.cost });
            if (res.status == 200) {
                this.successMsg("Your Booking Details Has been Updated")
                this.$router.go();
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
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
    },

    mounted(){
        this.getVat();
        setTimeout(() => {
            this.getOrderList();
            this.totalPrice();
        },500); 
        
    }

}
</script>

<style scoped> 

.over {
    max-height: 60vh !important;
    overflow-y: scroll !important;
}

.modal-md-fixed{
    width: 380px !important;
}

.modal-footer>* {
    margin: 0 !important;
}

.modal-footers>* {
    margin: 0 !important;
    z-index: 10 !important;
}
.m-70 {
  margin-top: 80px;
  max-height:  80vh !important;
}

</style>