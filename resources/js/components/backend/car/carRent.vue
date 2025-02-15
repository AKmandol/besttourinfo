<template>

    <div>

      <div class="container-fluid">
        <div class="row">

            <div class="text-center p-3 rounded table-border-dark shadow-sm " v-if="this.carOrder == ''">
                <h1 class="color-white mt-2">No Order made Yet</h1>
            </div>

            <div class="col-md-12 rounded bg-main main-col m-0 p-3" v-else>
                <h5 class="p-3 table-border-dark bg-header color-white d-flex aling-items-center justify-content-center fw-bold aling-middle"><b-icon-clipboard-data class="d-inline text-success mr-2" width="22" height="22"></b-icon-clipboard-data>All Car Order</h5>
                
                <div class="table-responsive mt-2">

                    <table class="table table-striped rounded color-white text-center">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Booking Information</th>
                                <th scope="col">User Information</th>
                                <th scope="col">Places Between</th>
                                <th scope="col">Rent</th>
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
                                <td class="fw-bold mx-0 px-0 align-middle">{{ order.location_between }}</td>
                                <td class="fw-bold mx-0 px-0 align-middle text-danger">{{ order.cost }} <small>tk</small> </td>
                                <td class="fw-bold text-center px-2 align-middle"> 
                
                                <a @click="viewOrderDriver(order,i)" class="btn btn-sm btn-outline-info px-2"><b-icon-eye class="d-inline mr-2 color-white" width="16" height="16"></b-icon-eye>Driver Info</a>

                                </td>
                                <td class="fw-bold mx-0 px-0 align-middle">
                                    <span class="p-1 rounded" :class="{
                                    'border border-secondary': order.payment_status === 'Processing',
                                    'border border-success': order.payment_status === 'Success',
                                    'border border-success': order.payment_status === 'Completed',
                                    'border border-primary': order.payment_status === 'Pending'
                                    }">
                                    {{ order.payment_status }}
                                    </span> 
                                </td>
                                <td  class="mx-0 px-0 my-auto align-middle">
                                    <a @click="viewOrder(order,i)" class="shadow mx-2 btn btn-sm btn-outline-secondary px-2 m-1" data-toggle="modal" data-target="#editModal"><b-icon-eye class="d-inline mr-1" width="16" height="16"></b-icon-eye></a>
                                    <a @click="deleteOrder(order,i)" v-if="this.$store.state.user.userType == 'admin' || this.$store.state.user.userType == 'super'" class="shadow mx-2 btn btn-sm btn-outline-danger px-2"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
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
 

        <!-- View Moadal Order-->
        <Modal
            v-model="showviewModal"
            :mask-closable="false"
            width="550"
            footer-hide
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center bg-header" style="text-align: center; min-height:40px;">
                <Icon type="ios-alert-outline" size="34" color="green" />
                <span class="ml-2 fw-bolder color-white fs-6">Order Information</span>
                </p>
            </template>

            <div class="mb-2 color-white">
                <div class="p-3 table-border-dark rounded">
                    <h6 class="text-center color-white p-2 rounded mb-2 table-border-dark-bottom">User Information</h6>
                    <p class="fw-bold color-white">User name: <span class="ml-3 fw-normal"> {{ viewData.user_name }} </span> </p>
                    <p class="fw-bold color-white">User phone: <span class="ml-3 fw-normal"> {{ viewData.user_phone }} </span> </p>
                    <p class="fw-bold color-white">User email: <span class="ml-3 fw-normal"> {{ viewData.user_email }} </span> </p>
                </div>
            </div>

            <div class="mb-2 color-white">
                <div class="p-3 table-border-dark rounded">
                    <h6 class="text-center color-white p-2 rounded mb-2 table-border-dark-bottom">Rent Information</h6>
                    <p class="fw-bold color-white">Order ID: <span class="ml-3 fw-normal"> BTI_C-{{ viewData.extra_three }} </span> </p>
                    <p class="fw-bold color-white">Pick Up Location: <span class="ml-3 fw-normal"> {{ viewData.pick_up_location }} </span> </p>
                    <p class="fw-bold color-white">Pick Up Date Time: <span class="ml-3 fw-normal"> {{ viewData.pick_up_date }} </span> </p>
                    <p class="fw-bold color-white">Drop up Location: <span class="ml-3 fw-normal"> {{ viewData.drop_off_location }} </span> </p>
                    <p class="fw-bold color-white" v-if="viewData.drop_off_date" >Return Date Time: <span class="ml-3 fw-normal"> {{ viewData.drop_off_date }} </span> </p>
                    <p class="fw-bold color-white">Car Type: <span class="ml-3 fw-normal"> {{ viewData.car_type }} </span> </p>
                    <p class="fw-bold color-white">Status: <span class="ml-3 fw-normal"> {{ viewData.payment_status }} </span> </p>
                    <p class="fw-bold color-white">Rent: <span class="ml-3 fw-normal"> {{ viewData.cost }} </span> </p>

                    <p class="fw-bold color-white py-2">Places Between: <span class="ml-3 fw-normal"> {{ viewData.between_location }} </span> </p>
                </div>
            </div>
            
            
        </Modal>

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

            <span v-if="driver.length">
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
                </div>
            </span>

            <span v-else>
                <div class="color-white row p-3">
                    <div class="col-12 my-auto text-center">
                        <p class="fw-bold color-white text-center mb-2"> Driver isn't Assign Yet</p>
                        <router-link to="assign-driver" class="text-center rounded table-border-dark fw-bold px-3 py-1">
                            Assign driver
                        </router-link>
                    </div>
                </div>
            </span>
            
        </Modal>

        <!-- delete Moadal -->
        <Modal
            v-model="showDeleteModal"
            :mask-closable="false"
            width="360"
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center" style="color: red; text-align: center; min-height:40px">
                <Icon type="md-alert" size="34" />
                <span class="ml-2 fw-bolder text-warnning fs-6">Delete confirmation</span>
                </p>
            </template>
            <div class="color-white">
                <p>Are you sure you want to delete this Destination Information ?</p>
            </div>
            <template #footer>
                <button type="default" class="btn btn-outline-secondary btn-sm" @click="this.showDeleteModal = false">Close</button>
                <button @click="orderDelete()" class="btn btn-outline-danger btn-sm">Delete</button>
            </template>
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
            carOrder:[],
            driver:[],
            errors:{},
            showviewModal: false,
            showDriverModal: false,
            showDeleteModal: false,
           
            viewData:{
                id: '',
                pick_up_location:'',
                drop_off_location:'',
                pick_up_date:'',
                drop_off_date:'',
                pick_up_time:'',
                drop_off_time:'',
                car_type: '',
                between_location:'',
                payment_status: '',
                cost:'',
                extra_three:'',
            },

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

        deleteOrder(order,i){
            this.deleteData.id = order.id;
            this.showDeleteModal = true;
            this.deletingIndex = i;
        },

        async orderDelete(){
            const res = await this.callApi("post", "car/oder/delete",this.deleteData);
            if(res.status === 200){
                this.successMsg("Order Deleted Successfully");
                this.carOrder.splice(this.deletingIndex,1);
                this.carOrder = res.data.data;
                this.showDeleteModal = false;
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

        viewOrder(order,i){
            this.showviewModal = true;
            this.viewData.user_name = order.user_name;
            this.viewData.user_phone = order.user_phone;
            this.viewData.user_email = order.user_email;
            this.viewData.pick_up_location = order.pick_up_location;
            this.viewData.pick_up_date = order.pick_up_date;
            this.viewData.drop_off_location = order.drop_off_location;
            this.viewData.drop_off_date = order.drop_off_date;
            this.viewData.car_type = order.car_type;
            this.viewData.cost = order.cost;
            this.viewData.payment_status = order.payment_status;
            this.viewData.between_location = order.location_between;
            this.viewData.extra_three = order.extra_three;
        },

        async viewOrderDriver(order,i){
            const id = order.car_driver_id;
            const res = await this.callApi("get", `/car/get_orderDrivert?id=${id}`);
            if (res.status == 200) {
                this.driver = res.data;
                //console.log(this.driver)
                this.showDriverModal = true; 
            } else {
                this.errorMsg();
            }
        }

        
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