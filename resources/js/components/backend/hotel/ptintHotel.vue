<template>
    <div>

        <div class="container-fluid">
            <div class="row">

                <div class="text-center p-3 rounded table-border-dark shadow-sm " v-if="this.orderList == ''">
                    <h1 class="color-white1">No Booking Found</h1>
                </div>

                <div class="col-md-12 bg-main rounded m-0 p-3 main-col" v-else>
                    <h5 class="p-3 bg-header color-white table-border-dark d-flex aling-items-center justify-content-center fw-bold aling-middle"><b-icon-printer class="d-inline text-success mr-2" width="22" height="22"></b-icon-printer>Print Hotel Booking</h5>
                    <div class="table-responsive mt-3">

                        <table class="table table-striped rounded text-center">
                            <thead>
                                <tr>
                                    <th class="color-white" scope="col">Order ID</th>
                                    <th class="color-white" scope="col">Hotel Name</th>
                                    <th class="color-white" scope="col">Client Name</th>
                                    <th class="color-white" scope="col">Cost</th>
                                    <th class="color-white" scope="col">Booking Status</th>
                                    <th class="color-white" scope="col" style="width: 120px;">Action</th>
                                </tr>
                            </thead>
                          
                            <tbody>

                                <tr v-for="(hotel,i) in orderList" :key="i" class="mx-0 px-0 my-auto">
                                    <th scope="row" class="align-middle color-white">
                                        {{  hotel.trasnstion_id }}
                                    </th>
                                    <td class="fw-bold text-center px-2 align-middle"> 
                
                                        <div class="text-center aling-middle" v-for="(d,j) in hotel.order_details" :key="j">
                                            <span class="color-main"><span class="color-white">{{++j}}.</span> {{ d.hotel_name }}</span>
                                        </div>

                                    </td>
                            
                                    <td  class="fw-bold mx-0 px-2 align-middle">

                                        <div class="text-center aling-middle">
                                            <span class="color-main">{{ hotel.user.name }}</span>
                                        </div>

                                    </td>
                            
                                    <td  class="fw-bold mx-0 px-2 align-middle">
                                    
                                        <div class="text-center aling-middle">
                                            <span class="color-white">{{ hotel.backup }} /=</span>
                                        </div>
                                    
                                    </td>

                                    <td  class="mx-0 px-0 align-middle" v-if="hotel.payment_status == 'Pending' "> <span class="badge text-primary border border-primary p-2">{{ hotel.payment_status }}</span> </td>
                                    <td  class="mx-0 px-0 align-middle" v-else-if="hotel.payment_status == 'Processing' "> <span class="badge text-secondary table-border-dark p-2">{{ hotel.payment_status }}</span> </td>
                                    <td  class="mx-0 px-0 align-middle" v-else> <span class="badge text-success border border-success p-2">{{ hotel.payment_status }}</span> </td>
                                    
                                    <td  class="mx-0 px-0 align-middle">
                                        <a class="mx-2 text-center btn btn-sm btn-outline-secondary px-2 shadow" @click="showViewModal(hotel,i)"><b-icon-eye class="d-inline" width="16" height="16"></b-icon-eye></a>
                                        <a class="mx-2 text-center btn btn-sm btn-outline-success px-2 shadow"  @click="print(hotel)"><b-icon-printer class="d-inline" width="16" height="16"></b-icon-printer></a>
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
            total:10,
            pageInfo: null,
            orderList:[],
            singleBooking:[],
            singleBookingUser:[],
            viewModal: false,
        }
    },

    methods:{

        print(hotel) {
            let hotelDetails = hotel.order_details.map(d => `
                <span style="text-align:left;color:blue; width:50%">
                    <p style="text-align:left;color:dark; margin:0;padding:0">Hotel Name: <span style="text-align:center;color:gray">${d.hotel_name}</span> </p>
                    <p style="text-align:left;color:dark; margin:0;padding:0">Hotel Address: <span style="text-align:center;color:gray">${d.hotel_address}</span> </p>
                    <p style="text-align:left;color:dark; margin:0;padding:0">Hotel Contact: <span style="text-align:center;color:gray">${d.hotel_phone}</span> </p>
                    <p style="text-align:left;color:dark; margin:0;padding:0">Room Type: <span style="text-align:center;color:gray">${d.room_type}</span> </p>
                    <p style="text-align:left;color:dark; margin:0;padding:0">Rent Per Night: <span style="text-align:center;color:gray">${d.room_type_price}</span> </p>
                </span>
            `).join('');

            const printContent = `
            <!DOCTYPE html>
            <html>
                <body style="background-color:#fff;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
                <div style="width:720px;border-radius:7px;margin:0 auto;border: .1px solid green;">
                    <table style="width:670px;margin:10px auto 10px;padding:5px;border-radius:7px;background: #f1f1f1;">
                        <thead> 
                            <tr>
                                <th style="text-align:left;"><img style="max-width: 180px;" src="https://besttourinfo.com/img/logo.png" alt="Besttourinfo.com"></th>
                                <th style="text-align:right;font-weight:500;font-size:15px">${hotel.booking_date}</th>
                            </tr>
                        </thead>
                    </table>

                    <h4 style="width:670px;text-align:center;margin:20px auto;color:#E06100">Booking Details <span style="color:black">BTI_H-${hotel.trasnstion_id}</span></h4>
                    <hr style="width:50%;height:1px;text-align:center;margin:0 auto;background-color:green">

                    <table style="width:670px;margin:10px auto 10px;padding:5px 20px;border-radius: 7px;">
                        <thead> 
                            <tr>
                                <th style="text-align:left;font-weight:600;font-size:15px;color:#000;width:50%">Booking Details:</th>
                                <th style="text-align:left;font-weight:600;font-size:15px;color:#000;width:50%">Hotel Information:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align:left;color:blue; width:50%">
                                    <p style="text-align:left;color:dark; margin:0;padding:0">Booking Status: <span style="text-align:center;color:gray">${hotel.payment_status}</span> </p>
                                    <p style="text-align:left;color:dark; margin:0;padding:0">Check In Date: <span style="text-align:center;color:gray">${hotel.check_in}</span> </p>
                                    <p style="text-align:left;color:dark; margin:0;padding:0">Check Out Date: <span style="text-align:center;color:gray">${hotel.check_out}</span> </p>
                                    <p style="text-align:left;color:dark; margin:0;padding:0">Number of Adults: <span style="text-align:center;color:gray">${hotel.no_of_adult}</span> </p>
                                    <p style="text-align:left;color:dark; margin:0;padding:0">Number of Children: <span style="text-align:center;color:gray">${hotel.no_of_child}</span> </p>
                                    <p style="text-align:left;color:dark; margin:0;padding:0">Amount to Pay: <span style="text-align:center;color:red;font-weight:500">${hotel.total_price}</span> tk </p>
                                </td>
                                <td style="text-align:left;color:blue; width:50%">
                                    ${hotelDetails}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table style="width:670px;margin:60px auto 20px;background-color:#fff;padding:15px;color:#000;">
                        <tfoot>
                            <tr>
                                <td colspan="2" style="font-size:14px;padding:15px 15px 0 15px;text-align:left;">
                                    <strong style="display:block;margin:0 0 10px 0;">Regards,</strong> 
                                    <span style="color:rgb(0, 132, 0);font-size:16px; font-weight: bold">BestTourInfo.com</span> <br> 
                                    3 No Circle Area, Bandarban Sadar, Bandarban, Bangladesh<br><br>
                                    <b>Phone:</b> +8801718-274787<br>
                                    <b>Email:</b> info@besttourinfo.com
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <table style="width:670px;margin:10px auto 10px;padding:10px 5px;border-radius:7px;background: #f1f1f1;">
                        <thead> 
                            <tr>
                                <th style="text-align:left;font-weight:600;font-size:15px;color:#000;">
                                    <a href="https://besttourinfo.com/about" style="font-size:14px;text-decoration:none;font-weight:bold;padding:0 10px;">About us</a>
                                </th>
                                <th style="text-align:center;font-weight:600;font-size:15px;color:#000;">
                                    <a href="https://besttourinfo.com/contact" style="font-size:14px;text-decoration:none;font-weight:bold;padding:0 10px;">Contact us</a>
                                </th>
                                <th style="text-align:right;font-weight:600;font-size:15px;color:#000;">
                                    <a href="https://besttourinfo.com/refund-policies" style="font-size:14px;text-decoration:none;font-weight:bold;padding:0 10px;">Refund Policy</a>
                                </th>
                                <th style="text-align:right;font-weight:600;font-size:15px;color:#000;">
                                    <a href="https://besttourinfo.com/cancelation-policies" style="font-size:14px;text-decoration:none;font-weight:bold;padding:0 10px;">Cancellation Policy</a>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                </body>
            </html>
            `;

            const printWindow = window.open("", "_blank");
            printWindow.document.write(printContent);
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();

            this.infoMsg("Print tab opened successfully");
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

