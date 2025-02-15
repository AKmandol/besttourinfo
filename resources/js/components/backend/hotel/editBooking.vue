<template>
    <div>

        <div class="container-fluid">
            <div class="row">

                <div class="text-center p-3 rounded table-border-dark shadow-sm " v-if="this.orderList == ''">
                    <h1 class="color-white1">No Booking Found</h1>
                </div>

                <div class="col-md-12 m-0 p-3 rounded bg-main main-col" v-else>

                    <h5 class="p-3 table-border-dark bg-header color-white text-center fw-bold"><b-icon-pencil class="d-inline text-success mr-3" width="22" height="22"></b-icon-pencil>Edit Hotel Booking Status</h5>

                    <div class="table-responsive mt-3">

                        <table class="table table-striped bg-main rounded color-white text-center">
                            <thead>
                                <tr>
                                    <th class="color-white" scope="col">SL</th>
                                    <th class="color-white" scope="col">Hotel Information</th>
                                    <th class="color-white" scope="col">Client Information</th>
                                    <th class="color-white" scope="col">Total price</th>
                                    <th class="color-white" scope="col">Booking Status</th>
                                    <th class="color-white" scope="col">Action</th>
                                </tr>
                            </thead>
                          
                            <tbody>

                                <tr v-for="(hotel,i) in orderList" :key="i" class="mx-0 px-0 my-auto">
                                    <th scope="row" class="align-middle">{{  pageInfo.from + i }}</th>
                                    <td class="fw-bold align-middle p-2">
                                        
                                        <div class="text-start aling-middle my-2" v-for="(d,i) in hotel.order_details" :key="i">
                                            <span class="color-white fw-bold mr-4">{{++i}}. Name: <span class="color-main">{{ d.hotel_name }}</span></span> <br>
                                            <span class="color-white fw-bold mr-4">Address: <span class="color-main">{{ d.hotel_address }}</span></span> <br>
                                            <span class="color-white mr-4">Phone: <span class="color-main">{{ d.hotel_phone }}</span><b-icon-scissors  @click="copy(d,i)" class="d-inline text-success ml-2" width="14" height="14"></b-icon-scissors></span><br>
                                        </div>

                                    </td>
                    
                                    <td  class="fw-bold align-middle p-2">

                                        <div class="text-start aling-middle">
                                            <span class="color-white fw-bold">Name: <span class="color-main">{{ hotel.user.name }}</span></span> <br>
                                            <span class="color-white" @click="copyThree(hotel, i)">Phone: <span class="color-main">{{ hotel.user.mobile }}</span></span> <br>
                                            <span class="color-white" @click="copyTwo(hotel, i)">Email: <span class="color-main">{{ hotel.user.email }}</span></span>
                                        </div>

                                    </td>

                                    <td  class="align-middle"> <span class="color-main">{{ hotel.backup }} /= </span> </td>

                                    <td  class="align-middle" v-if="hotel.payment_status == 'Pending' "> <span class="badge border border-primary text-primary p-2">{{ hotel.payment_status }}</span> </td>
                                    <td  class="align-middle" v-else-if="hotel.payment_status == 'Processing' "> <span class="badge text-secondary table-border-dark p-2">{{ hotel.payment_status }}</span> </td>
                                    <td  class="align-middle" v-else> <span class="badge text-success border border-success p-2">{{ hotel.payment_status }}</span> </td>

                                    <td  class="align-middle col-2"> 
                                        <div class="px-2">
                                            <a class="mx-2 text-center btn btn-sm color-white bg-dark-custom btn-dark px-2 shadow" @click="show(hotel,i)"><b-icon-shuffle class="d-inline text-success fw-bold" width="16" height="16"></b-icon-shuffle> Change Status </a>
                                        </div>
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



        <!-- Modal -->
        <Modal
            v-model="modal"
            :footer-hide= true
            title="Change Order Status"
            width = "400px"
            >
            <div>
                <select class="form-select" v-model="editData.payment_status"> 
                    <option value="Pending">Pending</option>
                    <option value="Processing">Processing</option>
                    <option value="Completed">Completed</option>
                </select>

                <div class="text-center mt-4">
                    <a class="btn btn-sm btn-outline-primary py-2 px-4 fw-bold shadow" :loading="isLoading" @click="update(hotel,i)"><b-icon-download class="d-inline fw-bold mr-2" width="16" height="16"></b-icon-download> 
                        <span v-if="!isLoading">Update</span>
                        <span v-else>Updating...</span>
                    </a>
                </div>

            </div>


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
            isLoading: false,
            modal:false,
            total:4,
            pageInfo: null,
            index: -1,
            orderList:[],
            payment_status:null,
            editData: {
                id: '',
                payment_status: 'Processing',
                email: '',
                oderId: ''
            },
           
        }

    },

    methods:{

        show(hotel,i){
            this.modal= true;
            this.index = i;
            this.editData.id = hotel.id;
            this.editData.email = hotel.user.email;
            this.editData.payment_status = hotel.payment_status;
            this.editData.oderId = "BTI_H-"+hotel.trasnstion_id;
            //console.log(this.editData)
        },

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

        async emailClient(){
            const res = await this.callApi("post","status/mailsendClient" , {clientEmail: this.editData.email,orerId: this.editData.oderId, status: this.editData.payment_status});
            if (res.status == 200) {
            //this.hotelList = res.data;
            //console.log(this.hotelList)
            } else {
            this.errorMsg();
            }
        },

        async update(hotel,i){
            this.isLoading = true;
            const res = await this.callApi("post","/updateBooking",this.editData);
            if (res.status === 200) {
                this.emailClient();
                this.orderList[this.index].payment_status = this.editData.payment_status;
                this.successMsg("Booking has been Updated successfully");
                this.isLoading = false;
                this.modal = false;
            } else {
                this.errorMsg();
            }
        },

        copy(hotel, i){
            let copyText = hotel.hotel_phone;
            navigator.clipboard.writeText(copyText);
            this.successMsg("Phone Number Copied");
        },

        copyTwo(hotel, i){
            let copyText = hotel.user.email;
            navigator.clipboard.writeText(copyText);
            this.successMsg("Email Address Copied");
        },

        copyThree(hotel, i){
            let copyText = hotel.user.mobile;
            navigator.clipboard.writeText(copyText);
            this.successMsg("Phone Number Copied");
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

