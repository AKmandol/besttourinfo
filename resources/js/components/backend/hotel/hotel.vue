<template>
    <div>

        <div class="container-fluid">
            <div class="row bg-main">

                <div class="text-center p-3 rounded border shadow-sm" v-if="this.hotelList == ''">
                    <h1 class="color-white">No Hotel Added Yet</h1>
                </div>

                <div class="col-md-12 rounded  main-col m-0 p-3" v-else>
                    <h4 class="table p-3 bg-header table-border-dark text-center d-flex aling-items-center justify-content-center fw-bold aling-middle"><b-icon-house-heart class="d-inline text-success mr-2" width="22" height="22"></b-icon-house-heart> <span class="color-white">All Hotel</span></h4>
                    <div class="row m-0 p-0 d-flex justify-content-between">
                        <div class="col px-3">
                            <router-link class="color-white btn btn-sm btn-outline-primary" to="/add-hotel"><b-icon-plus class="d-inline text-success mr-2" width="22" height="22"></b-icon-plus>Add Hotel</router-link>
                        </div>
                        <div class="col px-3 text-end">
                            <b-icon-arrow-clockwise @click="reload" class="btn rounded shadow-sm text-primary p-1" width="30" height="30"></b-icon-arrow-clockwise>
                        </div>
                    </div>
                    <div class="table-responsive pb-2 mt-2">

                        <table class="table table-striped rounded text-center border-0">
                            <thead>
                                <tr>
                                    <th  class="color-white" scope="col">SL</th>
                                    <th  class="color-white" scope="col">Hotel Name</th>
                                    <th  class="color-white" scope="col" style="width: 250px;">Address</th>
                                    <th  class="color-white" scope="col">Phone</th>
                                    <th  class="color-white" scope="col">Email</th>
                                    <th  class="color-white" scope="col" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <!-- <tbody class="text-center border my-auto" v-show="hotelList ==[]">
                                <tr>
                                    <span class="text-center py-3">No Data Found</span>
                                </tr>
                            </tbody> -->
                            <tbody>

                                <tr v-for="(hotel,i) in hotelList" :key="i" class="mx-0 px-0 my-auto">
                                    <th scope="row" class="align-middle color-main">{{  pageInfo.from + i }}</th>
                                    <td class="fw-bold mx-0 px-0 align-middle color-main">{{hotel.name}}</td>
                                    <td  class="mx-0 px-0 align-middle color-main">{{ hotel.address }}</td>
                                    <td  class="mx-0 px-0 align-middle color-main">{{ hotel.phone }}</td>
                                    <td @click="copy(hotel, i)" class="mx-0 px-0 align-middle color-main">{{ hotel.email }}</td>
                                    <td  class="mx-0 px-0 my-auto">
                                        <a class="mx-2 btn btn-sm btn-outline-secondary px-2 shadow" data-toggle="modal" data-target="#view" @click="view(hotel,i)"><b-icon-eye class="d-inline" width="16" height="16"></b-icon-eye></a>
                                        <a class="mx-2 btn btn-sm btn-outline-primary px-2 shadow" data-toggle="modal" data-target="#editModal" @click="edit(hotel,i)"><b-icon-pencil-square class="d-inline mr-1" width="16" height="16"></b-icon-pencil-square></a>
                                        <a v-if="this.$store.state.user.userType == 'admin' || this.$store.state.user.userType == 'super'" class="mx-2 btn btn-sm btn-outline-danger px-2 shadow" @click="deleteModal(hotel,i)"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>

                    </div>
                </div> 

                <div class="row mt-2 pb-3">

                    <div class="text-center col-md-12 col-lg-4 my-1">
                        <div class="row height d-flex justify-content-start align-items-center">

                            <div class="col-md-12">

                                <div class="search">
                                    <i class="fa fa-search"></i>
                                    <input type="text" class="form-control form-control-sm" v-model="this.search"  placeholder="Search by Hotel name or Client Name">
                                    <button  @click="searhHotel" class="btn btn-primary d-flex justify-content-center align-items-center">Search</button>
                                </div>
                            
                            </div>

                        </div>
                    </div>


                    <div class="text-center col-md-12 col-lg-4 my-1">
                        <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.hotelList != ''" @on-change="getHotelList" />
                    </div>


                    <div class="text-end col-md-12 col-lg-4 my-1">
                        <div class="d-flex">
                            <label for="perPage" class="col-form-label color-white text-end mr-3">Show List</label>
                            <select id="perPage" class="form-select-sm form-select col" v-model="this.total" @change="this.getHotelList()">
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
        
        <!-- Edit Your Information Modal -->
        <EditModal :hotels = "hotel"></EditModal>
        <viewModal :hotels = "hotel"></viewModal>

        
        <!-- delete Moadal -->
        <Modal
            v-model="showDeleteModal"
            :mask-closable="false"
            width="360"
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center" style="color: red; text-align: center; min-height:40px">
                    <Icon type="md-alert" size="34" />
                    <span class="ml-2 fw-bolder text-danger fs-5">Delete confirmation</span>
                </p>
            </template>
            <div class="color-white">
                <p>Are you sure you want to delete this Hotel ?</p>
            </div>
            <template #footer>
                <button type="default" class="btn btn-outline-secondary btn-sm" @click="this.showDeleteModal = false">Close</button>
                <button @click="deleteHotel()" class="btn btn-outline-danger btn-sm">Delete</button>
            </template>
        </Modal>

    </div>

    
</template>

<script>

import EditModal from "./editModal.vue"
import viewModal from "./viewModal.vue"

export default {

    components: {
        EditModal,
        viewModal,
    },

    data(){
        return{
            search: '',
            showDeleteModal: false,
            hotelId: '',
            user: this.$store.state.user,
            hotelList: [],
            hotel: [],
            pageInfo: null,
            total: 8,
            deleteItem: {},
            deletingIndex: -1,
        }
    },

    methods:{

        async getHotelList(page){
            const res = await this.callApi("get",`/get_hotelList?total=${this.total}&page=${page}`);
            if (res.status == 200) {
                this.hotelList = res.data.data;
                this.pageInfo = res.data;
            } else {
                this.errorMsg();
            }
        },

        async searhHotel(page){
            const res = await this.callApi("get",`/back/getSearch?search=${this.search}&total=${this.total}&page=${page}`);
            if (res.status == 200) {
                this.hotelList = res.data.data;
                this.pageInfo = res.data;
                //console.log(this.search)
            } else {
                this.errorMsg();
            }
        },

        async view(hotel,i){
            const id = hotel.id;
            //const id = parseInt(hotel.id);
            const res = await this.callApi("get",`/full/details_hotel?id=${id}`);
            if (res.status == 200) {
                this.hotel = res.data;
                //console.log(this.hotel)
            } else {
                this.errorMsg();
            }
        },

        async edit(hotel,i){
            const id = hotel.id;
            //const id = parseInt(hotel.id);
            const res = await this.callApi("get",`/full/details_hotel?id=${id}`);
            if (res.status == 200) {
                this.hotel = res.data;
                //console.log(this.hotel)
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
            const res = await this.callApi("post","info/delete_hotel", this.deleteItem);
            if (res.status == 200) {
                this.hotelList.splice(this.deletingIndex,1);
                this.successMsg("Hotel Details has been deleted successfully");
                this.showDeleteModal= false;
                //this.$router.go();
            } else {
                this.errorMsg();
            }
        },
        
        reload(){
            this.$router.go();
        },

        copy(hotel, i){
            let copyText = hotel.email;
            navigator.clipboard.writeText(copyText);
            this.successMsg("Email Address Copied");
        }

    },

    async created() {
        this.getHotelList();
    },
}
</script>

<style scoped>
.main-col{
    max-height: 70vh;
    overflow-y: scroll;
}

.border-btn{
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.border-btn1{
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

</style>

