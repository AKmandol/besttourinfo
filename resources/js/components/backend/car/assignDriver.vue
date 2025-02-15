<template>

    <div>

      <div class="container-fluid">
        <div class="row">

            <div class="text-center p-3 rounded table-border-dark shadow-sm " v-if="this.carOrder == ''">
                <h1 class="color-white mt-2">No Order made Yet</h1>
            </div>

            <div class="col-md-12 rounded bg-main main-col m-0 p-3" v-else>
                <h5 class="p-3 table-border-dark bg-header color-white d-flex aling-items-center justify-content-center fw-bold aling-middle"><b-icon-pen class="d-inline text-primary mr-2" width="22" height="22"></b-icon-pen>Update Car Rental Order</h5>
                
                <div class="table-responsive mt-2">

                    <table class="table table-striped rounded color-white text-center">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Booking Information</th>
                                <th scope="col">User Information</th>
                                <th scope="col">Driver Information</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>

                            <tr class="mx-0 px-0 my-auto" v-for="(order,i) in carOrder" :key="i" >
                                <th scope="row" class="align-middle">{{  pageInfo.from + i }}</th>   

                                <td class="fw-bold text-start px-2 align-middle"> 
                                    <div class="text-start aling-middle">
                                        <span class="color-white fw-bold mr-3">Packeage Name: <span class="fw-normal">{{ order.packeage_name }}</span></span> <br>
                                        <span class="color-white fw-bold mr-3">Car Type: <span class="fw-normal">{{ order.car_type }}</span></span> <br>
                                        <span class="color-white fw-bold mr-3">Pick Up Location: <span class="fw-normal">{{ order.pick_up_location }}</span></span> <br>
                                        <span class="color-white fw-bold mr-3">Pick Up Date Time: <span class="fw-normal">{{ order.pick_up_date }}</span></span> <br>
                                        <span class="color-white fw-bold mr-3">Drop up Location: <span class="fw-normal">{{ order.drop_off_location }}</span></span> <br>
                                        <span v-if="order.drop_off_date" class="color-white fw-bold mr-3">Return up Date Time: <span class="fw-normal">{{ order.drop_off_date }}</span></span>
                                    </div>
                                </td>

                                <td class="fw-bold text-start px-2 align-middle"> 
                                    <div class="text-start aling-middle">
                                        <span class="color-white fw-bold mr-3">Name: <span class="fw-normal">{{ order.user_name }}</span></span> <br>
                                        <span class="color-white fw-bold mr-3">Phone: <span class="fw-normal">{{ order.user_phone }}</span></span> <br>
                                        <span class="color-white fw-bold mr-3">Email: <span class="fw-normal">{{ order.user_email }}</span></span>
                                    </div>
                                </td>

                                <td class="fw-bold text-center px-2 align-middle"> 
                    
                                    <div class="aling-middle text-center" v-if="order.car_driver_id != 0">
                                        <a @click="viewOrderDriver(order,i)"  class="btn btn-sm btn-outline-secondary px-2 mx-2"><b-icon-eye class="d-inline mr-2 text-white" width="16" height="16"></b-icon-eye>View</a>
                                    </div>

                                    <div class="aling-middle text-center" v-else>
                                        <a @click="editDriver(order,i)" class="btn btn-sm bg-dark-custom text-info  fw-bold px-2 mx-2"><b-icon-pencil-square class="d-inline mr-2 text-white" width="16" height="16"></b-icon-pencil-square>Assign</a>
                                    </div>
                                    
                                </td>

                                <td class="fw-bold text-center px-2 align-middle"> 
                                    <p v-if="order.payment_status == 'Processing' " class="rounded text-primary px-2 py-1 table-border-dark">{{ order.payment_status }}</p>
                                    <p v-if="order.payment_status == 'Pending' " class="rounded color-white px-2 py-1 table-border-dark">{{ order.payment_status }}</p>
                                    <p v-if="order.payment_status == 'Completed' " class="rounded text-success px-2 py-1 table-border-dark">{{ order.payment_status }}</p>
                                </td>

                                <td class="fw-bold text-center px-2 align-middle"> 
                                    <a @click="editDriver(order,i)" class="shadow btn btn-sm table-border-dark text-info  fw-bold px-2 m-2"><b-icon-pencil-square class="d-inline mr-2 text-white" width="16" height="16"></b-icon-pencil-square>Assign Driver</a>
                                    <a @click="editStatus(order,i)" class="shadow btn btn-sm table-border-dark fw-bold px-2 m-2"><b-icon-pen class="d-inline mr-2 text-white" width="16" height="16"></b-icon-pen><span class="color-white">Change Status</span></a>
                                </td>

                            </tr>
                            
                        </tbody>
                    </table>

                </div>

                <div class="row mt-2">

                    <div class="text-center col-md-12 col-lg-4 my-1">
                        <div class="row height d-flex justify-content-start align-items-center">

                            <div class="col-md-12">

                                <div class="search">
                                    <i class="fa fa-search"></i>
                                    <input type="text" class="form-control form-control-sm" v-model="this.search"  placeholder="Search by Packeage Name or Client Name">
                                    <button  @click="searhOrderCar" class="btn btn-primary d-flex justify-content-center align-items-center">Search</button>
                                </div>
                            
                            </div>

                        </div>
                    </div>


                    <div class="text-center col-md-12 col-lg-4 my-1">
                        <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.carOrder != ''" @on-change="getCarOrder" />
                    </div>


                    <div class="text-end col-md-12 col-lg-4 my-1">
                        <div class="d-flex">
                            <label for="perPage" class="col-form-label color-white text-end mr-3">Show List</label>
                            <select id="perPage" class="form-select-sm form-select col" v-model="this.total" @change="this.getCarOrder()">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="3000">All</option>
                            </select>
                        </div>
                    </div>

                </div>

            </div> 

        </div>
      </div>

         <!-- View Moadal Driver-->
         <Modal
            v-model="showDriverModal"
            :mask-closable="false"
            width="650"
            footer-hide
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center" style="color: rgb(0, 0, 0); text-align: center; min-height:40px">
                <Icon type="ios-alert-outline" size="34" color="blue" />
                <span class="ml-2 fw-bolder text-warnning fs-6">Driver Information</span>
                </p>
            </template>

            <div class="mb-1 color-white row p-3 table-border-dark table-border-dark-success rounded" v-for="(d,i) in driver" :key="i">
                <div class="col-8 my-auto">
                    <p class="fw-bold color-white">Driver name: <span class="ml-3 fw-normal"> {{ d.driver_name }} </span> </p>
                    <p class="fw-bold color-white">Driver Age: <span class="ml-3 fw-normal"> {{ d.driver_age }} </span> </p>
                    <p class="fw-bold color-white">Driver Address: <span class="ml-3 fw-normal"> {{ d.driver_address }} </span> </p>
                    <p class="fw-bold color-white">Driver phone: <span class="ml-3 fw-normal"> {{ d.driver_phone }} </span> </p>
                    <p class="fw-bold color-white">Driver Car type: <span class="ml-3 fw-normal"> {{ d.driver_car_type }} </span> </p>
                    <p class="fw-bold color-white">Driver NID No: <span class="ml-3 fw-normal"> {{ d.driver_nid_no }} </span> </p>
                    <p class="fw-bold color-white mb-3">Driver license No: <span class="ml-3 fw-normal"> {{ d.driver_license }} </span> </p>
                </div>
                <div class="col-4 text-center my-auto">
                <img :src="d.driver_img" class="img-fluid rounded" alt="">
                </div>

                <div class="col-12 text-center my-auto mt-2">
                    <img :src="d.driver_license_img" class="img-fluid rounded" alt="">
                </div>

                <div class="text-center mt-3">
                    <a @click="driverRemove" class="btn btn-sm btn-outline-danger">Remove Driver</a>
                </div>
            </div>
            
         </Modal>

         <!-- change Driver -->
        <Modal
            v-model="changeDriver"
            :mask-closable="false"
            width="50vw"
            footer-hide
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center" style="color: rgb(0, 0, 0); text-align: center; min-height:40px">
                <Icon type="ios-build-outline" size="24" color="blue" />
                <span class="ml-2 fw-bolder text-warnning fs-6">Assign Driver</span>
                </p>
            </template>

           
            <div class="row">
            
          
            <div class="clo-12">

                <div class="mb-3 row">

                    <div class="col">
                        
                        <table class="table table-table-border-darked rounded color-white text-center">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Driver Information</th>
                                    <th scope="col">Driver Contact</th>
                                    <th scope="col">Driver Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>

                                <tr class="mx-0 px-0 my-auto" v-for="(order,i) in carDriver" :key="i" >
                                    <th scope="row" class="align-middle">{{  pageInfo.from + i }}</th>   


                                    <td class="fw-bold text-center px-2 align-middle"> 
                                        <div class="text-start aling-middle">
                                            <span class="color-white fw-bold mr-3">Name: <span class="fw-normal">{{ order.driver_name }}</span></span> <br>
                                            <span class="color-white fw-bold mr-3">Address: <span class="fw-normal">{{ order.driver_address }}</span></span> <br>
                                            <span class="color-white fw-bold mr-3">Age: <span class="fw-normal">{{ order.driver_age }}</span></span>
                                        </div>
                                    </td>

                                    <td class="fw-bold text-center px-2 align-middle"> 
                                        <div class="text-start aling-middle">
                                            <span class="color-white fw-bold mr-3">Email: <span class="fw-normal">{{ order.driver_email }}</span></span> <br>
                                            <span class="color-white fw-bold mr-3">Phone: <span class="fw-normal">{{ order.driver_phone }}</span></span> <br>
                                        </div>
                                    </td>

                                    <td class="fw-bold text-center px-2 align-middle"> 
                                        <img :src="order.driver_img" alt="driverImg" width="50">
                                    </td>

                                    <td class="fw-bold text-center px-2 align-middle"> 
                                        <a @click="updateDriver(order,i)" class="shadow btn btn-sm btn-outline-success my-3 px-3">Assign</a>
                                    </td>

                                </tr>
                                
                            </tbody>
                        </table>

                        <div class="text-center my-4">
                            <Page :total="pageInfo2.total" :current="pageInfo2.current_page" :page-size="parseInt(pageInfo2.per_page)" v-if="this.carDriver != ''" @on-change="getDriver" />
                        </div>
                        
                    </div>
                </div>

            </div>


        </div>
          
        </Modal>

        <!-- Change Status -->
        <Modal
        v-model="changeStatus"
        :mask-closable="false"
        width="450"
        footer-hide
        >
        <template #header>
            <p class="d-flex align-items-center justify-content-center" style="color: rgb(0, 0, 0); text-align: center; min-height:40px">
            <Icon type="ios-shuffle" size="34" color="blue" />
            <span class="ml-2 fw-bolder text-warnning fs-6">Change Status</span>
            </p>
        </template>

    
        <div class="row">
            
          
            <div class="clo-12">
                <label for="exampleFormControlInput1" class="form-label color-white fw-bold">Change Booking status</label>
                <select class="form-select" v-model="data.status" :class="hasError('status') ? 'is-invalid' : '' ">
                <option disabled>Change Booking Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Processing">Processing</option>
                    <option value="Completed">Completed</option>
                </select>
                <div class="invalid-feedback" v-if="hasError('status')">{{getError('status')}}</div>
                <div class="text-center">
                    <a @click="changeStatusValue" class="btn btn-outline-success my-3 px-3 shadow">Update Status</a>
                </div>
            </div>


        </div>
        
        
        </Modal>

    </div>
    
</template>
  
<script>

export default {  

    data(){
        return{
            search: '',
            total:3,
            pageInfo: null,
            pageInfo2: null,
            carOrder:[],
            driver:[],
            carDriver:[],
            finalCarDriver:[],
            errors:{},
            showDriverModal: false,
            changeDriver: false,
            changeStatus: false,
            editData:{
                id: '',
                pick_up_location:'',
                drop_off_location:'',
                pick_up_date:'',
                drop_off_date:'',
                pick_up_time:'',
                drop_off_time:'',
                car_type: '',
                between_location:'',
                cost:'',
            },
            data: {
                id: '',
                status: 'Processing',
                driver_id: '',
                driver: '',
                car_type:'',
                email:'',
                orderId: ''
            },
            index: '',
            deleteData:{
                id:'',
            },
            deletingIndex: -1,

            }

    },

    methods:{

        async searhOrderCar(page){
            const res = await this.callApi("get",`/car/getSearch/orderCar?search=${this.search}&total=${this.total}&page=${page}`);
            if (res.status == 200) {
                this.carOrder = res.data.data;
                this.pageInfo = res.data;
                //console.log(this.orderList)
            } else {
                this.errorMsg();
            }
        },

        async getCarOrder(page){
            const res = await this.callApi("get", `/car/get_orderList?total=${this.total}&page=${page}`);
            if (res.status == 200) {
                this.carOrder = res.data.data;
                this.pageInfo = res.data;
            } else {
                this.errorMsg();
            }
        },

        async getDriver(page){
            const res = await this.callApi("get", `/driver/get_type_by?total=${this.total}&page=${page}&carType=${this.data.car_type}`);
            if (res.status == 200) {
                this.carDriver = res.data.data;
                this.pageInfo2 = res.data;
            } else {
                this.errorMsg();
            }
        },

        async viewOrderDriver(order,i){
            this.data.id = order.id;
            this.index = i;
            const id = order.car_driver_id;
            const res = await this.callApi("get", `/car/get_orderDrivert?id=${id}`);
            if (res.status == 200) {
                this.driver = res.data;
                //console.log(this.driver)
                this.showDriverModal = true; 
            } else {
                this.errorMsg();
            }
        },

        editDriver(order,i){
            this.data.id = order.id;
            this.data.car_type = order.car_type;
            this.getDriver();
            this.index = i;
            this.changeDriver = true;
        },

        async updateDriver(order,i){
            this.data.driver_id = order.id;
            const res = await this.callApi("post", "car/assign_driver/update",this.data);
            if(res.status === 200){
                this.successMsg("Car Driver Added Successfully");
                this.carOrder[this.index].car_driver_id = this.data.driver_id;
                this.data = {};
                this.changeDriver = false;
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

        async driverRemove(){
            //console.log(this.data);
            const res = await this.callApi("post", "car/assign_driver/remove",this.data);
            if(res.status === 200){
                this.successMsg("Car Driver Removed Successfully");
                this.carOrder[this.index].car_driver_id = 0;
                this.data = {};
                this.showDriverModal = false;
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

        async emailClient(){
            const res = await this.callApi("post","status/mailsendClient" , {clientEmail: this.data.email,orerId: this.data.orderId, status: this.data.status});
            if (res.status == 200) {
            //this.hotelList = res.data;
            //console.log(this.hotelList)
            } else {
            this.errorMsg();
            }
        },

        editStatus(order,i){
            //console.log(order);
            this.data.email = order.user_email;
            this.data.orderId = "BTI_C-"+order.extra_three;
            this.data.id = order.id;
            this.index = i;
            this.changeStatus = true;
            this.data.status = order.payment_status;
        },

        async changeStatusValue(){
            const res = await this.callApi("post", "car/status/update",this.data);
            if(res.status === 200){
                this.successMsg("Car Status Updated Successfully");
                this.carOrder[this.index].payment_status = this.data.status;
                this.emailClient();
                // this.carType[this.index].title_image = this.editData.title_image;
                this.data = {};
                this.changeStatus = false;
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
        
    },

    mounted(){
        this.getCarOrder();
    },

    created(){
        this.token = window.laravel.csrfToken;
    }
}

</script>

<style scoped>

</style>