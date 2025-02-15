<template>
    <div>

        <div class="container-fluid">
            <div class="row">

                <div class="text-center p-3 rounded table-border-dark shadow-sm " v-if="this.orderList == ''">
                    <h1 class="color-white1">No Booking Found</h1>
                </div>

                <div class="col-md-12 bg-main rounded m-0 p-3 main-col" v-else>
                    <h5 class="p-3 bg-header table-border-dark color-white d-flex aling-items-center justify-content-center fw-bold aling-middle"><b-icon-cart-check class="d-inline text-success mr-2" width="22" height="22"></b-icon-cart-check>All Hotel Booking</h5>
                    <div class="table-responsive mt-3">

                        <table class="table table-striped rounded text-center">
                            <thead>
                                <tr>
                                    <th class="color-white" scope="col">SL</th>
                                    <th class="color-white" scope="col">Hotel Information</th>
                                    <th class="color-white" scope="col">Booking Information</th>
                                    <th class="color-white" scope="col">Booking Status</th>
                                    <th class="color-white" scope="col" style="width: 120px;">Action</th>
                                </tr>
                            </thead>
                          
                            <tbody>

                                <tr v-for="(hotel,i) in orderList" :key="i" class="mx-0 px-0 my-auto">
                                    <th scope="row" class="align-middle color-white">{{  pageInfo.from + i }}</th>
                                    <td class="fw-bold text-start px-2 align-middle"> 
                
                                        <div class="text-start aling-middle my-2" v-for="(d,j) in hotel.order_details" :key="j">
                                            <span class="color-white fw-bold mr-4">{{++j}}. Name: <span class="color-main">{{ d.hotel_name }}</span></span> <br>
                                            <span class="color-white fw-bold mr-4">Room Type: <span class="color-main">{{ d.room_type }}</span></span> <br>
                                            <span class="color-white fw-bold mr-4">Address: <span class="color-main">{{ d.hotel_address }}</span></span> <br>
                                            <span class="color-white mr-4">Phone: <span class="color-main">{{ d.hotel_phone }}</span></span> <br>
                                            <span class="color-white mr-4">Email: <span class="color-main">{{ d.hotel_email }}</span><b-icon-scissors  @click="copy(d,j)" class="d-inline text-success ml-2" width="14" height="14"></b-icon-scissors></span><br>
                                            <span class="color-white mr-4">No of Room: <span class="color-main">{{ d.room_no }}</span></span> <br>
                                            <span class="color-white mr-4">Price per night: <span class="color-main">{{ d.room_type_price }}</span></span>
                                        </div>

                                    </td>
                            
                                    <td  class="fw-bold mx-0 px-2 align-middle">
                                    
                                        <div class="text-start aling-middle">
                                            <span class="color-white fw-bold mr-4">Order ID: <span class="color-main">BTI_H-{{ hotel.trasnstion_id }}</span></span> <br>
                                            <span class="color-white fw-bold mr-4">Name: <span class="color-main">{{ hotel.user.name }}</span></span> <br>
                                            <span class="color-white mr-4">Phone: <span class="color-main">{{ hotel.user.mobile }}</span></span> <br>
                                            <span class="color-white mr-4">Email: <span class="color-main">{{ hotel.user.email }}</span><b-icon-scissors  @click="copyTwo(hotel, i)" class="d-inline text-success ml-2" width="14" height="14"></b-icon-scissors></span><br>
                                            <span class="color-white mr-4">Check in Date: <span class="color-main">{{ hotel.check_in }}</span></span> <br>
                                            <span class="color-white mr-4">Check out Date: <span class="color-main">{{ hotel.check_out }}</span></span> <br>
                                            <span class="color-white mr-4">Total Price : <span class="color-white">{{ hotel.backup }} /=</span></span>
                                        </div>
                                    
                                    </td>

                                    <td  class="mx-0 px-0 align-middle" v-if="hotel.payment_status == 'Pending' "> <span class="badge text-primary border border-primary p-2">{{ hotel.payment_status }}</span> </td>
                                    <td  class="mx-0 px-0 align-middle" v-else-if="hotel.payment_status == 'Processing' "> <span class="badge text-secondary table-border-dark p-2">{{ hotel.payment_status }}</span> </td>
                                    <td  class="mx-0 px-0 align-middle" v-else> <span class="badge text-success border border-success p-2">{{ hotel.payment_status }}</span> </td>
                                    
                                    <td  class="mx-0 px-0 align-middle">
                                        <a class="mx-2 text-center btn btn-sm btn-outline-secondary px-2 shadow" @click="showViewModal(hotel,i)"><b-icon-eye class="d-inline" width="16" height="16"></b-icon-eye></a>
                                        <a v-if="this.$store.state.user.userType == 'admin' || this.$store.state.user.userType == 'super'" class="mx-2 text-center btn btn-sm btn-outline-danger px-2 shadow" @click="deleteModal(hotel,i)"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>

                    </div>
                </div> 

                <div class="row px-0 mx-auto pb-3 bg-main">

                    <div class="text-center col-md-12 col-lg-4 my-1">
                        <div class="row height d-flex justify-content-start align-items-center">

                            <div class="col-md-12">

                                <div class="search">
                                    <i class="fa fa-search"></i>
                                    <input type="text" class="form-control form-control-sm" v-model="this.search"  placeholder="Search by Hotel name or Client Name">
                                    <button  @click="searhOrder" class="btn btn-primary d-flex justify-content-center align-items-center">Search</button>
                                </div>
                            
                            </div>

                        </div>
                    </div>


                    <div class="text-center col-md-12 col-lg-4 my-1">
                        <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.orderList != ''" @on-change="getOrderList" />
                    </div>

                
                    <div class="text-end col-md-12 col-lg-4 my-1">
                        <div class="d-flex">
                            <label for="perPage" class="col-form-label color-white text-end mr-3">Show List</label>
                            <select id="perPage" class="form-select-sm form-select col" v-model="this.total" @change="this.getOrderList()">
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
                <p>Are you sure you want to delete this Order ?</p>
            </div>
            <template #footer>
                <button type="default" class="btn btn-outline-secondary btn-sm" @click="this.showDeleteModal = false">Close</button>
                <button @click="deleteHotel()" class="btn btn-outline-danger btn-sm">Delete</button>
            </template>
        </Modal>

        <!-- View Moadal -->
        <Modal
            v-model="viewModal"
            :mask-closable="false"
            width="760"
            >
            <template #header>
                <h5 class="d-flex align-items-center justify-content-center" style="text-align: center; min-height:40px">
                <span class="ml-2 fw-bolder color-white fs-6">Booking Full Details</span>
                </h5>
            </template>
            <div class="p-1 aling-middle">
                
                <h6 class="d-flex align-items-center justify-content-start mb-2 color-white"><Icon type="ios-home-outline" size="25" class="mr-1 text-primary" />Hotel Information</h6>
                <div class="row p-3 bg-main rounded table-border-dark mb-4">
                    <span class="row m-0 p-0" v-for="(d,i) in singleBooking.order_details" :key="i">
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">{{++i}}.Hotel Name:</p>
                            <span class="color-white">{{ d.hotel_name }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Hotel Address:</p>
                            <span class="color-white">{{ d.hotel_address }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Phone Number:</p>
                            <span class="color-white">{{ d.hotel_phone }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Email Address:</p>
                            <span class="color-white">{{ d.hotel_email }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Room Type:</p>
                            <span class="color-white">{{ d.room_type }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">No of Room:</p>
                            <span class="color-white">{{ d.room_no }}</span>
                        </div>
                    </div>
                    </span>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Booking Date:</p>
                            <span class="color-white">{{ singleBooking.booking_date }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Payment Type:</p>
                            <span class="color-white">{{ singleBooking.payment_type?singleBooking.payment_type:"Not Made" }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Order ID:</p>
                            <span class="color-white">BTI_H-{{ singleBooking.trasnstion_id }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Payment Status:</p>
                            <span class="color-white">{{ singleBooking.payment_status }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">No of Adult:</p>
                            <span class="color-white">{{ singleBooking.no_of_adult }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">No of Child:</p>
                            <span class="color-white">{{ singleBooking.no_of_child }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Check In:</p>
                            <span class="color-white">{{ singleBooking.check_in }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Check Out:</p>
                            <span class="color-white">{{ singleBooking.check_out }}</span>
                        </div>
                    </div>
                    <div class="col-12 my-4 mx-auto">
                        <div class="d-flex justify-content-center table-border-dark bg-main shadow-sm rounded py-2">
                            <p class="color-white fw-bold mr-2">Total Price:</p>
                            <span class="color-white fw-bolder">{{ singleBooking.backup }} /=</span>
                        </div>
                    </div>
                    
                </div>
                
                <h6 class="d-flex align-items-center justify-content-start mb-2 color-white"><Icon type="ios-contact-outline" size="25" class="mr-1 text-primary" />Client Information</h6>
                <div class="row p-3 bg-main rounded mb-4 table-border-dark">
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Client Name:</p>
                            <span class="color-white">{{ singleBookingUser.name }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Phone Number:</p>
                            <span class="color-white">{{ singleBookingUser.mobile }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Email Address:</p>
                            <span class="color-white">{{ singleBookingUser.email }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Marital Status:</p>
                            <span class="color-white">{{ singleBookingUser.marital_status }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Date Of Birth:</p>
                            <span class="color-white">{{ singleBookingUser.date_of_birth }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Passport No:</p>
                            <span class="color-white">{{ singleBookingUser.passport_no }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Gender:</p>
                            <span class="color-white">{{ singleBookingUser.gender }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Religion:</p>
                            <span class="color-white">{{ singleBookingUser.religion }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">Language:</p>
                            <span class="color-white">{{ singleBookingUser.language }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-2">
                        <div class="d-flex justify-content-start">
                            <p class="color-white fw-bold mr-2">City:</p>
                            <span class="color-white">{{ singleBookingUser.city }}</span>
                        </div>
                    </div>
                    
                </div>

            </div>
            <template #footer>
                <button type="default" class="btn btn-outline-secondary shadow btn-sm" @click="this.viewModal = false">Close</button>
            </template>
        </Modal>

    </div>

    
</template>

<script>

export default {

    components: {
        
    },

    data(){
        return{
            search: '',
            total:4,
            pageInfo: null,
            orderList:[],
            singleBooking:[],
            singleBookingUser:[],
            showDeleteModal: false,
            viewModal: false,
            deleteItem: {},
            deletingIndex: -1,
            index: -1,
            editData: {
                id: "",
                payment_status: "",
            },

        }
    },

    methods:{

        async searhOrder(page){
            const res = await this.callApi("get",`/hotel/getSearch/order?search=${this.search}&total=${this.total}&page=${page}`);
            if (res.status == 200) {
                this.orderList = res.data.data;
                this.pageInfo = res.data;
                //console.log(this.orderList)
            } else {
                this.errorMsg();
            }
        },

        async getOrderList(page){
            const res = await this.callApi("get",`/get_orderLists?total=${this.total}&page=${page}`);
            if (res.status == 200) {
                this.orderList = res.data.data;
                this.pageInfo = res.data;
                //console.log(this.orderList)
            } else {
                this.errorMsg();
            }
        },

        async showViewModal(hotel, i) {
           this.viewModal = true;
           const id = hotel.id;
            //const id = parseInt(hotel.id);
            const res = await this.callApi("get",`/full/details_booking?id=${id}`);
            if (res.status == 200) {
                this.singleBooking = res.data;
                this.singleBookingUser = res.data.user;
                //console.log(this.singleBooking)
                //console.log(this.singleBookingUser)
            } else {
                this.errorMsg();
            }
        },
       
        deleteModal(hotel,i){
            this.showDeleteModal = true;
            this.deleteItem = hotel;
            this.deletingIndex = i;
        },

        async deleteHotel(){
            //console.log(this.deleteItem);
            const res = await this.callApi("post","info/delete_order", this.deleteItem);
            if (res.status == 200) {
                this.orderList.splice(this.deletingIndex,1);
                this.successMsg("Booking has been deleted successfully");
                this.showDeleteModal= false;
            } else {
                this.errorMsg();
            }
        },

        copy(hotel, i){
            let copyText = hotel.hotel_email;
            navigator.clipboard.writeText(copyText);
            this.successMsg("Email Address Copied");
        },

        copyTwo(hotel, i){
            let copyText = hotel.user.email;
            navigator.clipboard.writeText(copyText);
            this.successMsg("Email Address Copied");
        }

    },

    async created() {
        this.getOrderList();
    },
   
}
</script>

<style scoped>
.main-col{
    max-height: 70vh;
    overflow-y: scroll;
}

</style>

