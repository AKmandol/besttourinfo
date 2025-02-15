<template>

    <div>

      <div class="container-fluid">
        <div class="row">

            <div class="text-center p-3 rounded table-border-dark shadow-sm " v-if="this.carType == ''">
                <h1 class="color-white1 mt-2">No Car Type Found</h1>
                <a @click="showAddModal = true" class="shadowcolor-white1 btn btn-sm btn-outline-primary m-4"><b-icon-plus class="d-inline text-success mr-2" width="22" height="22"></b-icon-plus>Add New Car Type</a>

            </div>

            <div class="col-md-12 rounded bg-main main-col m-0 p-3" v-else>
                <h5 class="p-3 table-border-dark bg-header color-white d-flex aling-items-center justify-content-center fw-bold aling-middle"><b-icon-signpost-2 class="d-inline text-success mr-2" width="22" height="22"></b-icon-signpost-2>All Car Type</h5>

                <a @click="showAddModal = true" class="color-white1 btn btn-sm btn-outline-primary m-2"><b-icon-plus class="d-inline text-success mr-2" width="22" height="22"></b-icon-plus>Add New Car Type</a>
                
                <div class="table-responsive">

                    <table class="table table-striped rounded color-white text-center">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Car Type</th>
                                <th scope="col">Title Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>

                            <tr class="mx-0 px-0 my-auto" v-for="(car,i) in carType" :key="i">
                                <th scope="row" class="align-middle">{{  pageInfo.from + i }}</th>                               
                                <td class="fw-bold mx-0 px-0 align-middle">{{ car.car_type }}</td>
                                <td  class="mx-0 px-0 align-middle">
                                    <img :src="car.title_image" alt="carImage" width="80">
                                </td>
                                
                                <td class="mx-0 px-0 align-middle">
                                    <a @click="editCarType(car,i)" class="shadow mx-2 btn btn-sm btn-outline-primary px-2 m-1" data-toggle="modal" data-target="#editModal"><b-icon-pencil-square class="d-inline mr-1" width="16" height="16"></b-icon-pencil-square></a>
                                    <a @click="deleteCar(car,i)" v-if="this.$store.state.user.userType == 'admin' || this.$store.state.user.userType == 'super'" class="shadow mx-2 btn btn-sm btn-outline-danger px-2"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>

                </div>

                <div class="d-flex justify-content-between my-3">
                    <div class="text-start">
                        <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.carType != ''" @on-change="getCar" />
                    </div>
                    <div class="text-end d-flex">
                        <label for="perPage" class="col-form-label color-white text-end mr-3">Show List</label>
                        <select id="perPage" class="form-select-sm form-select col" v-model="this.total" @change="this.getCar()">
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

        <!-- Add Moadal -->
        <Modal
            v-model="showAddModal"
            :mask-closable="false"
            width="600"
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center" style="color: rgb(3, 75, 25); text-align: center; min-height:40px">
                    <Icon type="ios-add-circle" size="30" />
                <span class="ml-2 fw-bolder text-warnning fs-6">Add New Car Type</span>
                </p>
            </template>


            <div class="row">
                <div class="col-md-12 p-3">
                    <label for="car_type" class="form-label fw-bolder color-white">Car Type</label>
                    <input type="text" name="car_type" v-model="data.car_type" class="form-control" id="car_type" :class="hasError('car_type') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('car_type')">{{getError('car_type')}}</div>
                </div>

                <div class="col-md-12">
                    <label for="titleImage" class="form-label fw-bolder color-white">Title Image</label>

                    <Upload
                        :class="hasError('title_image') ? 'is-invalid' : '' "
                        :headers="{
                            'x-csrf-token': token,
                            'X-Requested-With': 'XMLHttpRequest',
                        }"
                        :show-upload-list="false"
                        type="drag"
                        action="/car/title/uploads"
                        ref="uploads"
                        :on-success="handleSuccess"
                        :format="['jpg', 'jpeg', 'png']"
                        :max-size="2048"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        >
                        <div style="padding: 20px 0">
                            <Icon
                            type="ios-cloud-upload"
                            size="52"
                            style="color: #3399ff"
                            ></Icon>
                            <p>Click or drag Title Car-Image here to upload (<span class="text-sm text-primary">200x200 px</span>)</p>
                        </div>
                    </Upload>

                    <div class="p-3 table-border-dark rounded position-relative mt-2" v-show="data.title_image">
                    <img class="rounded p-2 table-border-dark" width="120" :src="`${data.title_image}`" />
                    <span class="position-absolute top-50 start-50 translate-middle">
                        <Icon type="ios-trash-outline" size="24" color="red" @click="deleteImage" />
                    </span>
                    </div>

                    <div class="invalid-feedback" v-if="hasError('title_image')">{{getError('title_image')}}</div>

                </div>

            </div>


            <template #footer>
                <button @click="addCar()" class="btn btn-outline-success px-3 shadow">Add</button>
            </template>
        </Modal>

         <!-- Edit Moadal -->
         <Modal
            v-model="showEditModal"
            :mask-closable="false"
            width="600"
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center" style="color: rgb(3, 75, 25); text-align: center; min-height:40px">
                    <Icon type="ios-create" size="30" />
                <span class="ml-2 fw-bolder text-warnning fs-6">Update Car Type</span>
                </p>
            </template>


            <div class="row">
                <div class="col-md-12 p-3">
                    <label for="car_type" class="form-label fw-bolder color-white">Car Type</label>
                    <input type="text" name="car_type" v-model="editData.car_type" class="form-control" id="car_type" :class="hasError('car_type') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('car_type')">{{getError('car_type')}}</div>
                </div>

                <div class="col-md-12">
                    <label for="titleImage" class="form-label fw-bolder color-white">Title Image</label>

                    <Upload
                        :class="hasError('title_image') ? 'is-invalid' : '' "
                        :headers="{
                            'x-csrf-token': token,
                            'X-Requested-With': 'XMLHttpRequest',
                        }"
                        :show-upload-list="false"
                        type="drag"
                        action="/car/title/uploads"
                        ref="uploads"
                        :on-success="handleSuccessNew"
                        :format="['jpg', 'jpeg', 'png']"
                        :max-size="2048"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        >
                        <div style="padding: 20px 0">
                            <Icon
                            type="ios-cloud-upload"
                            size="52"
                            style="color: #3399ff"
                            ></Icon>
                            <p>Click or drag Title Car-Image here to upload (<span class="text-sm text-primary">200x200 px</span>)</p>
                        </div>
                    </Upload>

                    <div class="p-3 table-border-dark rounded position-relative mt-2" v-show="editData.title_image_old">
                        <p class="text-primary mb-3 fw-bold">Old Title Image:</p>
                        <img class="rounded p-2 table-border-dark" width="120" :src="`${editData.title_image_old}`" />
                        <span class="position-absolute top-50 start-50 translate-middle">
                            <Icon type="ios-trash-outline" size="24" color="red" @click="deleteImage()" />
                        </span>
                    </div>

                    <div class="p-3 table-border-dark rounded position-relative mt-2" v-show="editData.title_image">
                        <p class="text-success mb-3 fw-bold">New Title Image:</p>
                        <img class="rounded p-2 table-border-dark" width="120" :src="`${editData.title_image}`" />
                        <span class="position-absolute top-50 start-50 translate-middle">
                            <Icon type="ios-trash-outline" size="24" color="red" @click="deleteImage()" />
                        </span>
                    </div>

                    <div class="invalid-feedback" v-if="hasError('title_image')">{{getError('title_image')}}</div>

                </div>
            </div>


            <template #footer>
                <button @click="updateCar()" class="btn btn-outline-primary px-3 shadow">Update</button>
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
                <p>Are you sure you want to delete this Car Type ?</p>
            </div>
            <template #footer>
                <button type="default" class="btn btn-outline-secondary btn-sm" @click="this.showDeleteModal = false">Close</button>
                <button @click="carDeelete()" class="btn btn-outline-danger btn-sm">Delete</button>
            </template>
        </Modal>

    </div>
    
</template>
  
<script>

export default {  

    data(){
        return{
            total:5,
            pageInfo: null,
            carType:[],
            errors:{},
            showDeleteModal: false,
            showAddModal: false,
            showEditModal: false,
            data:{
                car_type:'',
                title_image:'',
            },
            editData:{
                id: '',
                car_type:'',
                title_image_old:'',
                title_image:'',
            },
            deleteData:{
                id:'',
                title_image:'',
            },
            deletingIndex: -1,
            index: -1,
            }

    },

    methods:{

        handleSuccess(res, file) {
            res = `/car_title_image/${res}`;
            this.data.title_image = res;
        },

        handleSuccessNew(res, file) {
            res = `/car_title_image/${res}`;
            this.editData.title_image = res;
        },

        handleFormatError (file) {
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
            });
        },

        handleMaxSize (file) {
            this.$Notice.warning({
                title: 'Exceeding file size limit',
                desc: 'File  ' + file.name + ' is too large, no more than 2M.'
            });
        },

        deleteImage(index){
            this.data.title_image = '';
            this.editData.title_image = '';
            this.editData.title_image_old = '';
            this.infoMsg("Image Removed");
        },

        async getCar(page){
            const res = await this.callApi("get", `/car/get_all?total=${this.total}&page=${page}`);
            if (res.status == 200) {
                this.carType = res.data.data;
                this.pageInfo = res.data;
            } else {
                this.errorMsg();
            }
        },

        async addCar() {
            const res = await this.callApi("post", "car/store",this.data);
            if(res.status === 201){
                this.successMsg("Car Has Been Added Successfully");
                this.carType.unshift(res.data);
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

        deleteCar(car,i){
            this.deleteData.id = car.id;
            this.deleteData.title_image = car.title_image,
            this.showDeleteModal = true;
            this.deletingIndex = i;
        },

        async carDeelete(){
            const res = await this.callApi("post", "car/delete",this.deleteData);
            if(res.status === 200){
                this.successMsg("Car Type Deleted Successfully");
                this.carType.splice(this.deletingIndex,1);
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

        editCarType(car,i){
            this.index = i,
            this.editData.id = car.id;
            this.editData.car_type = car.car_type;
            this.editData.title_image_old = car.title_image;
            this.editData.title_image = '';
            this.errors = {};
            this.showEditModal = true;
        },

        async updateCar(){
            if(this.editData.title_image == ''){
                this.editData.title_image = this.editData.title_image_old;
            }
            const res = await this.callApi("post", "car/update",this.editData);
            if(res.status === 200){
                this.successMsg("Car Type Updated Successfully");
                this.carType[this.index].car_type = this.editData.car_type;
                this.carType[this.index].title_image = this.editData.title_image;
                this.errors = {};
                this.showEditModal = false;
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
        this.getCar();
    },

    created(){
        this.token = window.laravel.csrfToken;
    }
}

</script>

<style scoped>

</style>