<template>

    <div>

      <div class="container-fluid">
        <div class="row">

            <div class="text-center p-3 rounded table-border-dark shadow-sm " v-if="this.carDestination == ''">
                <h1 class="color-white mt-2">No Destination Registered Yet</h1>
                <a @click="showAddModal = true" class="shadow color-white btn btn-sm btn-outline-primary m-4"><b-icon-plus class="d-inline text-success mr-2" width="22" height="22"></b-icon-plus>Add New Destination</a>

            </div>

            <div class="col-md-12 rounded bg-main main-col m-0 p-3" v-else>
                <h5 class="p-3 table-border-dark bg-header color-white d-flex aling-items-center justify-content-center fw-bold aling-middle"><b-icon-clipboard-data class="d-inline text-success mr-2" width="22" height="22"></b-icon-clipboard-data>All Car Destination</h5>

                <a @click="showAddModal = true" class="color-white btn btn-sm btn-outline-primary m-2"><b-icon-plus class="d-inline text-success mr-2" width="22" height="22"></b-icon-plus>Add New Destination</a>
                
                <div class="table-responsive">

                    <table class="table table-striped rounded color-white text-center">
                        <thead>
                            <tr>
                                <th scope="col" class="no-line-break">SL</th>
                                <th scope="col" class="no-line-break">Packeage Name</th>
                                <th scope="col" class="no-line-break">Pick Up Location</th>
                                <th scope="col" class="no-line-break">Drop Off Location</th>
                                <th scope="col" class="no-line-break">Car Type</th>
                                <th scope="col" class="no-line-break">Places Between</th>
                                <th scope="col" class="no-line-break">Cost</th>
                                <th scope="col" class="no-line-break">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>

                            <tr class="mx-0 px-0 my-auto" v-for="(destination,i) in carDestination" :key="i">
                                <th scope="row" class="align-middle">{{  pageInfo.from + i }}</th>                               
                                <td class="fw-bold mx-0 px-0 align-middle">{{ destination.extra_one }}</td>
                                <td class="fw-bold mx-0 px-0 align-middle">{{ destination.pick_up_location }}</td>
                                <td class="fw-bold mx-0 px-0 align-middle">{{ destination.drop_off_location }}</td>
                                <td class="fw-bold mx-0 px-0 align-middle">{{ destination.car_type }}</td>
                                <td class="fw-bold mx-0 px-0 align-middle">{{ destination.between_location }}</td>
                                <td class="fw-bold align-middle nowrap">{{ destination.cost }} <span class="text-sm text-muted">tk</span> </td>
                                
                                <td  class="mx-0 px-0 my-auto align-middle d-flex">
                                    <a @click="editDriver(destination,i)" class="shadow mx-2 btn btn-sm btn-outline-primary px-2 m-1" data-toggle="modal" data-target="#editModal"><b-icon-pencil-square class="d-inline mr-1" width="16" height="16"></b-icon-pencil-square></a>
                                    <a @click="deleteDriver(destination,i)" v-if="this.$store.state.user.userType == 'admin' || this.$store.state.user.userType == 'super'" class="shadow mx-2 btn btn-sm btn-outline-danger px-2 m-1"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>

                </div>

                <div class="row mt-2">

                    <div class="text-start col-md-12 col-lg-4 my-1">
                        <div class="row height d-flex justify-content-start align-items-center">

                            <div class="col-md-12">

                                <div class="search">
                                    <i class="fa fa-search"></i>
                                    <input type="text" class="form-control form-control-sm" v-model="this.search"  placeholder="Search by Packeage Name or Pick Up Location">
                                    <button  @click="searhPackeage" class="btn btn-primary d-flex justify-content-center align-items-center">Search</button>
                                </div>
                            
                            </div>

                        </div>
                    </div>


                    <div class="text-center col-md-12 col-lg-4 my-1">
                        <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.carDestination != ''" @on-change="getDestination" />
                    </div>


                    <div class="text-end col-md-12 col-lg-4 my-1">
                        <div class="d-flex">
                            <label for="perPage" class="col-form-label color-white text-end mr-3">Show List</label>
                            <select id="perPage" class="form-select-sm form-select col" v-model="this.total" @change="this.getDestination()">
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

        <!-- Add Moadal -->
        <Modal
            v-model="showAddModal"
            :mask-closable="false"
            width="850"
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center" style="text-align: center; min-height:40px">
                    <Icon type="ios-add-circle" class="text-success" size="30" />
                <span class="ml-2 fw-bolder color-white fs-6">Add New Destination</span>
                </p>
            </template>


            <div class="row">
                <div class="col-md-12 p-3">
                    <label for="extra_one" class="form-label fw-bolder color-white">Packeage Name</label>
                    <input type="text" name="extra_one" v-model="data.extra_one" class="form-control" id="extra_one" :class="hasError('extra_one') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('extra_one')">{{getError('extra_one')}}</div>
                    <span class="text-sm text-primary">This Field must be Unique. eg: "Dhaka to Bandarban by Private Car"</span>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="pick_up_location" class="form-label fw-bolder color-white">Pick Up Location</label>
                    <input type="text" name="pick_up_location" v-model="data.pick_up_location" class="form-control" id="pick_up_location" :class="hasError('pick_up_location') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('pick_up_location')">{{getError('pick_up_location')}}</div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="drop_off_location" class="form-label fw-bolder color-white">Drop Off Location</label>
                    <input type="text" name="drop_off_location" v-model="data.drop_off_location" class="form-control" id="drop_off_location" :class="hasError('drop_off_location') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('drop_off_location')">{{getError('drop_off_location')}}</div>
                </div>
                
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="car_type" class="form-label fw-bolder color-white">Car Type</label>
                    <select class="form-select form-select-sm" aria-label="Default select example" v-model="data.car_type" :class="hasError('car_type') ? 'is-invalid' : '' ">
                        <option value="0" disabled selected>Select a Car Type</option>
                        <option v-for="(car,i) in carTypes" :key="i" :value="car.car_type">{{ car.car_type }}</option>
                    </select>
                    <div class="invalid-feedback" v-if="hasError('car_type')">{{getError('car_type')}}</div>
                </div>

                <div class="col-md-6 col-sm-12 p-3">
                    <label for="cost" class="form-label fw-bolder color-white">Cost</label>
                    <input type="cost" name="cost" v-model="data.cost" class="form-control" id="cost" :class="hasError('cost') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('cost')">{{getError('cost')}}</div>
                </div>
              
                <div class="col-md-12 p-3">
                    <label for="between_location" class="form-label fw-bolder color-white">Place Between</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="data.between_location" :class="hasError('between_location') ? 'is-invalid' : '' "></textarea>
                    <div class="invalid-feedback" v-if="hasError('between_location')">{{getError('between_location')}}</div>
                </div>


            </div>


            <template #footer>
                <div class="shadow text-center py-2"><button @click="addDestination()" class="btn btn-outline-success col-3">Add Destination</button></div>
            </template>
        </Modal>

         <!-- Edit Moadal -->
         <Modal
            v-model="showEditModal"
            :mask-closable="false"
            width="850"
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center" style="text-align: center; min-height:40px">
                    <Icon type="ios-create" class="text-success" size="30" />
                <span class="ml-2 fw-bolder color-white fs-6">Update Destination Information</span>
                </p>
            </template>


            <div class="row">
                <div class="col-md-8 col-sm-12 p-3">
                    <label for="extra_one" class="form-label fw-bolder color-white">Packeage Name</label>
                    <input type="text" name="extra_one" v-model="editData.extra_one" class="form-control" id="pick_up_location" :class="hasError('extra_one') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('extra_one')">{{getError('extra_one')}}</div>
                    <span class="text-sm text-primary">This Field must be Unique. eg: "Dhaka to Bandarban by Private Car"</span>
                </div>
                <div class="col-md-4 col-sm-12 p-3">
                    <label for="pick_up_location" class="form-label fw-bolder color-white">Pick Up Location</label>
                    <input type="text" name="pick_up_location" v-model="editData.pick_up_location" class="form-control" id="pick_up_location" :class="hasError('pick_up_location') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('pick_up_location')">{{getError('pick_up_location')}}</div>
                </div>
                <div class="col-md-4 col-sm-12 p-3">
                    <label for="drop_off_location" class="form-label fw-bolder color-white">Drop Off Location</label>
                    <input type="text" name="drop_off_location" v-model="editData.drop_off_location" class="form-control" id="drop_off_location" :class="hasError('drop_off_location') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('drop_off_location')">{{getError('drop_off_location')}}</div>
                </div>

                <div class="col-md-4 col-sm-12 p-3">
                    <label for="cost" class="form-label fw-bolder color-white">Cost</label>
                    <input type="cost" name="cost" v-model="editData.cost" class="form-control" id="cost" :class="hasError('cost') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('cost')">{{getError('cost')}}</div>
                </div>

                <div class="col-md-4 col-sm-12 p-3">
                    <label for="car_type" class="form-label fw-bolder color-white">Car Type</label>
                    <select name="car_type" class="form-select form-select-sm" aria-label="Default select example" v-model="editData.car_type" :class="hasError('car_type') ? 'is-invalid' : '' ">
                        <option disabled selected>Select a Car Type</option>
                        <option v-for="(car,i) in carTypes" :key="i" :value="car.car_type">{{ car.car_type }}</option>
                    </select>
                    <div class="invalid-feedback" v-if="hasError('car_type')">{{getError('car_type')}}</div>
                </div>
              
                <div class="col-md-12 p-3">
                    <label for="between_location" class="form-label fw-bolder color-white">Places Between</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="editData.between_location" :class="hasError('between_location') ? 'is-invalid' : '' "></textarea>
                    <div class="invalid-feedback" v-if="hasError('between_location')">{{getError('between_location')}}</div>
                </div>


            </div>


            <template #footer>
                <div class="text-center py-2">
                    <button @click="updateDriver()" class="shadow btn btn-outline-primary px-3">Update</button>
                </div>
            </template>
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
                <button @click="destinationDelete()" class="btn btn-outline-danger btn-sm">Delete</button>
            </template>
        </Modal>

    </div>
    
</template>
  
<script>

export default {  

    data(){
        return{
            search:'',
            total:5,
            pageInfo: null,
            carTypes:[],
            carDestination:[],
            errors:{},
            showDeleteModal: false,
            showAddModal: false,
            showEditModal: false,
            data:{
                pick_up_location:'',
                drop_off_location:'',
                pick_up_date:'',
                drop_off_date:'',
                pick_up_time:'',
                drop_off_time:'',
                car_type: 'CNG',
                between_location:'',
                extra_one:'',
                cost:'',
            },
            editData:{
                id: '',
                extra_one:'',
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
            deleteData:{
                id:'',
            },
            deletingIndex: -1,
            index: -1,
            }

    },

    methods:{

        async searhPackeage(page){
            const res = await this.callApi("get",`/car/getSearch/packeage?search=${this.search}&total=${this.total}&page=${page}`);
            if (res.status == 200) {
                this.carDestination = res.data.data;
                this.pageInfo = res.data;
                //console.log(this.orderList)
            } else {
                this.errorMsg();
            }
        },

        async getCarType(page){
          const res = await this.callApi("get", "/car/get_all");
          if (res.status == 200) {
              this.carTypes = res.data;
              //console.log(this.carTypes)
          } else {
              this.errorMsg();
          }
        },

        async getDestination(page){
            const res = await this.callApi("get", `/destination/get_all?total=${this.total}&page=${page}`);
            if (res.status == 200) {
                this.carDestination = res.data.data;
                this.pageInfo = res.data;
            } else {
                this.errorMsg();
            }
        },

        async addDestination() {
            //console.log(this.data)
            const res = await this.callApi("post", "destination/store",this.data);
            if(res.status === 201){
                this.successMsg("Car Destination Added Successfully");
                this.carDestination.unshift(res.data);
                this.data = {};
                this.errors = {};
                this.showAddModal = false;
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

        deleteDriver(destination,i){
            this.deleteData.id = destination.id;
            this.showDeleteModal = true;
            this.deletingIndex = i;
        },

        async destinationDelete(){
            const res = await this.callApi("post", "destination/delete",this.deleteData);
            if(res.status === 200){
                this.successMsg("Destination Info Deleted Successfully");
                this.carDestination.splice(this.deletingIndex,1);
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

        editDriver(destination,i){
            this.index = i,
            this.editData.id = destination.id;
            this.editData.extra_one = destination.extra_one;
            this.editData.pick_up_location = destination.pick_up_location;
            this.editData.drop_off_location = destination.drop_off_location;
            this.editData.drop_off_date = destination.drop_off_date;
            this.editData.pick_up_date = destination.pick_up_date;
            this.editData.pick_up_time = destination.pick_up_time;
            this.editData.drop_off_time = destination.drop_off_time;
            this.editData.car_type = destination.car_type;
            this.editData.between_location = destination.between_location;
            this.editData.cost = destination.cost;
            this.showEditModal = true;
        },

        async updateDriver(){

            const res = await this.callApi("post", "destination/update",this.editData);
            if(res.status === 200){
                this.successMsg("Destination Info Updated Successfully");
                this.carDestination[this.index].pick_up_location = this.editData.pick_up_location;
                this.carDestination[this.index].drop_off_location = this.editData.drop_off_location;
                this.carDestination[this.index].extra_one = this.editData.extra_one;
                this.carDestination[this.index].car_type = this.editData.car_type;
                this.carDestination[this.index].between_location = this.editData.between_location;
                this.carDestination[this.index].cost = this.editData.cost;
                this.showEditModal = false;
                this.errors = {};
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
                    this.errors['car_type'] =  true;
                }
            }
        },


        
        
    },

    mounted(){
        this.getCarType();
        this.getDestination();
    },

    created(){
        this.token = window.laravel.csrfToken;
    }
}

</script>

<style scoped>

</style>