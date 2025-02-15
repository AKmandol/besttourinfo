<template>

    <div>

      <div class="container-fluid">
        <div class="row">

            <div class="text-center p-3 rounded table-border-dark shadow-sm " v-if="this.carDriver == ''">
                <h1 class="color-white1 mt-2">No Driver Registered Yet</h1>
                <a @click="showAddModal = true" class="color-white1 btn btn-sm btn-outline-primary m-4"><b-icon-plus class="d-inline text-success mr-2" width="22" height="22"></b-icon-plus>Add New Driver</a>

            </div>

            <div class="col-md-12 rounded bg-main main-col m-0 p-3" v-else>
                <h5 class="p-3 table-border-dark bg-header color-white d-flex aling-items-center justify-content-center fw-bold aling-middle"><b-icon-clipboard-data class="d-inline text-success mr-2" width="22" height="22"></b-icon-clipboard-data>All Car Driver</h5>

                <a @click="showAddModal = true" class="shadow color-white btn btn-sm btn-outline-primary m-2"><b-icon-plus class="d-inline text-success mr-2" width="22" height="22"></b-icon-plus>Add New Driver</a>
                
                <div class="table-responsive">

                    <table class="table table-striped rounded color-white text-center">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Driver Name</th>
                                <th scope="col">Driver Car Type</th>
                                <th scope="col">Driver Address</th>
                                <th scope="col">Driver Phone</th>
                                <th scope="col">Driver Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>

                            <tr class="mx-0 px-0 my-auto" v-for="(driver,i) in carDriver" :key="i">
                                <th scope="row" class="align-middle">{{  pageInfo.from + i }}</th>                               
                                <td class="fw-bold mx-0 px-0 align-middle">{{ driver.driver_name }}</td>
                                <td class="fw-bold mx-0 px-0 align-middle">{{ driver.driver_car_type }}</td>
                                <td class="fw-bold mx-0 px-0 align-middle">{{ driver.driver_address }}</td>
                                <td class="fw-bold mx-0 px-0 align-middle">{{ driver.driver_phone }}</td>
                                <td  class="mx-0 px-0 align-middle">
                                    <img :src="driver.driver_img" alt="carImage" width="80">
                                </td>
                                
                                <td  class="mx-0 px-0 my-auto align-middle">
                                    <a @click="viewDriver(driver,i)" class="shadow mx-2 btn btn-sm btn-outline-secondary px-2 m-1" data-toggle="modal" data-target="#editModal"><b-icon-eye class="d-inline mr-1" width="16" height="16"></b-icon-eye></a>
                                    <a @click="editDriver(driver,i)" class="shadow mx-2 btn btn-sm btn-outline-primary px-2 m-1" data-toggle="modal" data-target="#editModal"><b-icon-pencil-square class="d-inline mr-1" width="16" height="16"></b-icon-pencil-square></a>
                                    <a @click="deleteDriver(driver,i)" v-if="this.$store.state.user.userType == 'admin' || this.$store.state.user.userType == 'super'" class="shadow mx-2 btn btn-sm btn-outline-danger px-2"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>

                </div>

                <div class="d-flex justify-content-between my-3">
                    <div class="text-start">
                        <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.carDriver != ''" @on-change="getDriver" />
                    </div>
                    <div class="text-end d-flex">
                        <label for="perPage" class="col-form-label color-white text-end mr-3">Show List</label>
                        <select id="perPage" class="form-select-sm form-select col" v-model="this.total" @change="this.getDriver()">
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
            width="850"
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center" style="text-align: center; min-height:40px">
                    <Icon type="ios-add-circle" class="text-success" size="30" />
                <span class="ml-2 fw-bolder text-warnning fs-6">Add New Driver</span>
                </p>
            </template>


            <div class="row">
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="driver_name" class="form-label fw-bolder color-white">Driver Name</label>
                    <input type="text" name="driver_name" v-model="data.driver_name" class="form-control" id="driver_name" :class="hasError('driver_name') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_name')">{{getError('driver_name')}}</div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="driver_age" class="form-label fw-bolder color-white">Driver Age</label>
                    <input type="text" name="driver_age" v-model="data.driver_age" class="form-control" id="driver_age" :class="hasError('driver_age') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_age')">{{getError('driver_age')}}</div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="driver_phone" class="form-label fw-bolder color-white">Driver Phone</label>
                    <input type="text" name="driver_phone" v-model="data.driver_phone" class="form-control" id="driver_phone" :class="hasError('driver_phone') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_phone')">{{getError('driver_phone')}}</div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="driver_email" class="form-label fw-bolder color-white">Driver Email <span class="text-sm text-muted">(Optional)</span> </label>
                    <input type="text" name="driver_email" v-model="data.driver_email" class="form-control" id="driver_email" :class="hasError('driver_email') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_email')">{{getError('driver_email')}}</div>
                </div>
                <div class="col-md-12 p-3">
                    <label for="driver_address" class="form-label fw-bolder color-white">Driver Address</label>
                    <input type="text" name="driver_address" v-model="data.driver_address" class="form-control" id="driver_address" :class="hasError('driver_address') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_address')">{{getError('driver_address')}}</div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="driver_nid_no" class="form-label fw-bolder color-white">Driver NID Number</label>
                    <input type="text" name="driver_nid_no" v-model="data.driver_nid_no" class="form-control" id="driver_nid_no" :class="hasError('driver_nid_no') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_nid_no')">{{getError('driver_nid_no')}}</div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="driver_car_type" class="form-label fw-bolder color-white">Driver Car Type</label>
                    <select class="form-select form-select-sm" aria-label="Default select example" v-model="data.driver_car_type" :class="hasError('driver_car_type') ? 'is-invalid' : '' ">
                        <option value="0" disabled selected>Select a Car Type</option>
                        <option v-for="(car,i) in carTypes" :key="i" :value="car.car_type">{{ car.car_type }}</option>
                    </select>
                    <div class="invalid-feedback" v-if="hasError('driver_car_type')">{{getError('driver_car_type')}}</div>
                </div>

                <div class="col-md-12">
                    <label for="driver_img" class="form-label fw-bolder color-white">Driver Image</label>

                    <Upload
                        :class="hasError('driver_img') ? 'is-invalid' : '' "
                        :headers="{
                            'x-csrf-token': token,
                            'X-Requested-With': 'XMLHttpRequest',
                        }"
                        :show-upload-list="false"
                        type="drag"
                        action="/driver/img/uploads"
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
                            <p>Click or drag Title Car-Image here to upload (<span class="text-sm text-primary">300x300 px</span>)</p>
                        </div>
                    </Upload>

                    <div class="p-3 table-border-dark rounded position-relative mt-2" v-show="data.driver_img">
                    <img class="rounded p-2 table-border-dark" width="120" :src="`${data.driver_img}`" />
                    </div>

                    <div class="invalid-feedback" v-if="hasError('driver_img')">{{getError('driver_img')}}</div>

                </div>

                <div class="col-md-12 p-3">
                    <label for="driver_license" class="form-label fw-bolder color-white">Driver License Number</label>
                    <input type="text" name="driver_license" v-model="data.driver_license" class="form-control" id="driver_license" :class="hasError('driver_license') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_license')">{{getError('driver_license')}}</div>
                </div>

                <div class="col-md-12">
                    <label for="driver_license_img" class="form-label fw-bolder color-white">Lisense Image</label>

                    <Upload
                        :class="hasError('driver_license_img') ? 'is-invalid' : '' "
                        :headers="{
                            'x-csrf-token': token,
                            'X-Requested-With': 'XMLHttpRequest',
                        }"
                        :show-upload-list="false"
                        type="drag"
                        action="/driver/license/uploads"
                        ref="uploads"
                        :on-success="handleSuccessLicense"
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
                            <p>Click or drag Title Car-Image here to upload (<span class="text-sm text-primary">500x500 px</span>)</p>
                        </div>
                    </Upload>

                    <div class="p-3 table-border-dark rounded position-relative mt-2" v-show="data.driver_license_img">
                    <img class="rounded p-2 table-border-dark" width="120" :src="`${data.driver_license_img}`" />

                    </div>

                    <div class="invalid-feedback" v-if="hasError('driver_license_img')">{{getError('driver_license_img')}}</div>

                </div>

            </div>


            <template #footer>
                <div class="text-center py-2"><button @click="addDriver()" class="shadow btn btn-outline-success col-3">Add Driver</button></div>
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
                <span class="ml-2 fw-bolder color-white fs-6">Update Deiver Information</span>
                </p>
            </template>


            <div class="row">
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="driver_name" class="form-label fw-bolder color-white">Driver Name</label>
                    <input type="text" name="driver_name" v-model="editData.driver_name" class="form-control" id="driver_name" :class="hasError('driver_name') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_name')">{{getError('driver_name')}}</div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="driver_age" class="form-label fw-bolder color-white">Driver Age</label>
                    <input type="text" name="driver_age" v-model="editData.driver_age" class="form-control" id="driver_age" :class="hasError('driver_age') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_age')">{{getError('driver_age')}}</div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="driver_phone" class="form-label fw-bolder color-white">Driver Phone</label>
                    <input type="text" name="driver_phone" v-model="editData.driver_phone" class="form-control" id="driver_phone" :class="hasError('driver_phone') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_phone')">{{getError('driver_phone')}}</div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="driver_email" class="form-label fw-bolder color-white">Driver Email <span class="text-sm text-muted">(Optional)</span> </label>
                    <input type="text" name="driver_email" v-model="editData.driver_email" class="form-control" id="driver_email" :class="hasError('driver_email') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_email')">{{getError('driver_email')}}</div>
                </div>
                <div class="col-md-12 p-3">
                    <label for="driver_address" class="form-label fw-bolder color-white">Driver Address</label>
                    <input type="text" name="driver_address" v-model="editData.driver_address" class="form-control" id="driver_address" :class="hasError('driver_address') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_address')">{{getError('driver_address')}}</div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="driver_nid_no" class="form-label fw-bolder color-white">Driver NID Number</label>
                    <input type="text" name="driver_nid_no" v-model="editData.driver_nid_no" class="form-control" id="driver_nid_no" :class="hasError('driver_nid_no') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_nid_no')">{{getError('driver_nid_no')}}</div>
                </div>
                <div class="col-md-6 col-sm-12 p-3">
                    <label for="driver_car_type" class="form-label fw-bolder color-white">Driver Car Type</label>
                    <select class="form-select form-select-sm" aria-label="Default select example" v-model="editData.driver_car_type" :class="hasError('driver_car_type') ? 'is-invalid' : '' ">
                        <option value="0" disabled selected>Select a Car Type</option>
                        <option v-for="(car,i) in carTypes" :key="i" :value="car.car_type">{{ car.car_type }}</option>
                    </select>
                    <div class="invalid-feedback" v-if="hasError('driver_car_type')">{{getError('driver_car_type')}}</div>
                </div>

                <div class="col-md-12">
                    <label for="driver_img" class="form-label fw-bolder color-white">Driver Image</label>

                    <Upload
                        :class="hasError('driver_img') ? 'is-invalid' : '' "
                        :headers="{
                            'x-csrf-token': token,
                            'X-Requested-With': 'XMLHttpRequest',
                        }"
                        :show-upload-list="false"
                        type="drag"
                        action="/driver/img/uploads"
                        ref="uploads"
                        :on-success="handleSuccessEdit"
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
                            <p>Click or drag Title Car-Image here to upload (<span class="text-sm text-primary">300x300 px</span>)</p>
                        </div>
                    </Upload>

                    <div class="p-3 table-border-dark rounded position-relative mt-2" v-show="editData.driver_img_old">
                        <p class="text-primary mb-3 fw-bold">Old Driver Image:</p>
                        <img class="rounded p-2 table-border-dark" width="120" :src="`${editData.driver_img_old}`" />
                        <span class="position-absolute top-50 start-50 translate-middle">
                            <Icon type="ios-trash-outline" size="24" color="red" @click="deleteImage()" />
                        </span>
                    </div>

                    <div class="p-3 table-border-dark rounded position-relative mt-2" v-show="editData.driver_img">
                        <p class="text-success mb-3 fw-bold">New Driver Image:</p>
                        <img class="rounded p-2 table-border-dark" width="120" :src="`${editData.driver_img}`" />
                        <span class="position-absolute top-50 start-50 translate-middle">
                            <Icon type="ios-trash-outline" size="24" color="red" @click="deleteImage()" />
                        </span>
                    </div>

                    <div class="invalid-feedback" v-if="hasError('driver_img')">{{getError('driver_img')}}</div>

                </div>

                <div class="col-md-12 p-3">
                    <label for="driver_license" class="form-label fw-bolder color-white">Driver License Number</label>
                    <input type="text" name="driver_license" v-model="editData.driver_license" class="form-control" id="driver_license" :class="hasError('driver_license') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('driver_license')">{{getError('driver_license')}}</div>
                </div>

                <div class="col-md-12">
                    <label for="driver_license_img" class="form-label fw-bolder color-white">Lisense Image</label>

                    <Upload
                        :class="hasError('driver_license_img') ? 'is-invalid' : '' "
                        :headers="{
                            'x-csrf-token': token,
                            'X-Requested-With': 'XMLHttpRequest',
                        }"
                        :show-upload-list="false"
                        type="drag"
                        action="/driver/license/uploads"
                        ref="uploads"
                        :on-success="handleSuccessLicenseEdit"
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
                            <p>Click or drag Title Car-Image here to upload (<span class="text-sm text-primary">500x500 px</span>)</p>
                        </div>
                    </Upload>

                    <div class="p-3 table-border-dark rounded position-relative mt-2" v-show="editData.driver_license_img_old">
                        <p class="text-primary mb-3 fw-bold">Old Driver License Image:</p>
                        <img class="rounded p-2 table-border-dark" width="120" :src="`${editData.driver_license_img_old}`" />
                        <span class="position-absolute top-50 start-50 translate-middle">
                            <Icon type="ios-trash-outline" size="24" color="red" @click="deleteImageLicense()" />
                        </span>
                    </div>

                    <div class="p-3 table-border-dark rounded position-relative mt-2" v-show="editData.driver_license_img">
                        <p class="text-success mb-3 fw-bold">New Driver License Image:</p>
                        <img class="rounded p-2 table-border-dark" width="120" :src="`${editData.driver_license_img}`" />
                        <span class="position-absolute top-50 start-50 translate-middle">
                            <Icon type="ios-trash-outline" size="24" color="red" @click="deleteImageLicense()" />
                        </span>
                    </div>

                    <div class="invalid-feedback" v-if="hasError('driver_license_img')">{{getError('driver_license_img')}}</div>

                </div>

            </div>


            <template #footer>
                <div class="text-center py-2">
                    <button @click="updateDriver()" class="shadow btn btn-outline-primary px-3">Update</button>
                </div>
            </template>
        </Modal>

         <!-- View Moadal -->
         <Modal
            v-model="showViewModal"
            :mask-closable="false"
            width="800"
            footer-hide	
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center" style="color: rgb(3, 75, 25); text-align: center; min-height:40px">
                    <Icon type="ios-eye" size="40" />
                <span class="ml-2 fw-bolder text-warnning fs-6">Deiver Information</span>
                </p>
            </template>


            <div class="row">
               
                <div class="col-md-8 col-sm-12 p-3 table-border-dark rounded">
                    <div class="d-flex mb-2">
                        <h6 class="justify-content-start fw-bold text-start color-white">Driver Name:</h6>
                        <h6 class="justify-content-canter color-white ml-3"> {{ this.editData.driver_name }} </h6>
                    </div>
                    <div class="d-flex">
                        <p class="justify-content-start fw-bold text-start color-white">Driver Car Type:</p>
                        <p class="justify-content-canter color-white ml-3"> {{ this.editData.driver_car_type }} </p>
                    </div>
                    <div class="d-flex">
                        <p class="justify-content-start fw-bold text-start color-white">Driver Address:</p>
                        <p class="justify-content-canter color-white ml-3"> {{ this.editData.driver_address }} </p>
                    </div>
                    <div class="d-flex">
                        <p class="justify-content-start fw-bold text-start color-white">Driver Phone:</p>
                        <p class="justify-content-canter color-white ml-3"> {{ this.editData.driver_phone }} </p>
                    </div>
                    <div class="d-flex">
                        <p class="justify-content-start fw-bold text-start color-white">Driver Email:</p>
                        <p class="justify-content-canter color-white ml-3"> {{ this.editData.driver_email }} </p>
                    </div>
                    <div class="d-flex">
                        <p class="justify-content-start fw-bold text-start color-white">Driver Age:</p>
                        <p class="justify-content-canter color-white ml-3"> {{ this.editData.driver_age }} </p>
                    </div>
                    <div class="d-flex">
                        <p class="justify-content-start fw-bold text-start color-white">Driver NID Number:</p>
                        <p class="justify-content-end color-white ml-3"> {{ this.editData.driver_nid_no }} </p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-12 text-end">
                    <img :src="editData.driver_img_old" height="150" class="rounded" width="150" alt="driverImg">
                </div>

                <div class="col-md-12 text-center p-3 bg-header my-3 rounded table-border-dark">
                    <div class="d-flex w-100">
                        <h6 class="justify-content-start fw-bold text-start color-white">Driver License Number:</h6>
                        <h6 class="justify-content-end color-white ml-3"> {{ this.editData.driver_license }} </h6>
                    </div>
                    <img :src="editData.driver_license_img_old" class="rounded img-fluid p-3" alt="driverImg">
                </div>
               

              

            </div>

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
                <p>Are you sure you want to delete this Driver Information ?</p>
            </div>
            <template #footer>
                <button type="default" class="btn btn-outline-secondary btn-sm" @click="this.showDeleteModal = false">Close</button>
                <button @click="driverDelete()" class="btn btn-outline-danger btn-sm">Delete</button>
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
            carTypes:[],
            carDriver:[],
            errors:{},
            showDeleteModal: false,
            showAddModal: false,
            showEditModal: false,
            showViewModal: false,
            data:{
                driver_name:'',
                driver_phone:'',
                driver_email:'',
                driver_address:'',
                driver_car_type: 'CNG',
                driver_age:'',
                driver_nid_no:'',
                driver_img:'',
                driver_license:'',
                driver_license_img:'',
            },
            editData:{
                id: '',
                driver_name:'',
                driver_phone:'',
                driver_email:'',
                driver_address:'',
                driver_car_type: '',
                driver_age:'',
                driver_nid_no:'',
                driver_img:'',
                driver_img_old: '',
                driver_license:'',
                driver_license_img:'',
                driver_license_img_old:'',
            },
            deleteData:{
                id:'',
                driver_img:'',
                driver_license_img:'',
            },
            deletingIndex: -1,
            index: -1,
            }

    },

    methods:{


        handleSuccess(res, file) {
            res = `/car_driver_image/${res}`;
            this.data.driver_img = res;
        },

        handleSuccessLicense(res, file) {
            res = `/driver_license_image/${res}`;
            this.data.driver_license_img = res;
        },

        handleSuccessEdit(res, file) {
            res = `/car_driver_image/${res}`;
            this.editData.driver_img = res;
        },

        handleSuccessLicenseEdit(res, file) {
            res = `/driver_license_image/${res}`;
            this.editData.driver_license_img = res;
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
            this.editData.driver_img = '';
            this.editData.driver_img_old = '';
            this.infoMsg("Image Removed");
        },

        deleteImageLicense(index){
            this.editData.driver_license_img = '';
            this.editData.driver_license_img_old = '';
            this.infoMsg("Image Removed");
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

        async getDriver(page){
            const res = await this.callApi("get", `/driver/get_all?total=${this.total}&page=${page}`);
            if (res.status == 200) {
                this.carDriver = res.data.data;
                this.pageInfo = res.data;
            } else {
                this.errorMsg();
            }
        },

        async addDriver() {
            //console.log(this.data)
            const res = await this.callApi("post", "drive/store",this.data);
            if(res.status === 201){
                this.successMsg("Car Driver Added Successfully");
                this.carDriver.unshift(res.data);
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

        deleteDriver(driver,i){
            this.deleteData.id = driver.id;
            this.deleteData.driver_img = driver.driver_img,
            this.deleteData.driver_license_img = driver.driver_license_img,
            this.showDeleteModal = true;
            this.deletingIndex = i;
        },

        async driverDelete(){
            const res = await this.callApi("post", "driver/delete",this.deleteData);
            if(res.status === 200){
                this.successMsg("Driver Info Deleted Successfully");
                this.carDriver.splice(this.deletingIndex,1);
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

        viewDriver(driver,i){
            this.editData.id = driver.id;
            this.editData.driver_name = driver.driver_name;
            this.editData.driver_phone = driver.driver_phone;
            this.editData.driver_email = driver.driver_email;
            this.editData.driver_address = driver.driver_address;
            this.editData.driver_age = driver.driver_age;
            this.editData.driver_car_type = driver.driver_car_type;
            this.editData.driver_nid_no = driver.driver_nid_no;
            this.editData.driver_license = driver.driver_license;
    
            this.editData.driver_img_old = driver.driver_img;
            this.editData.driver_img = '';

            this.editData.driver_license_img_old = driver.driver_license_img;
            this.editData.driver_license_img = '';

            this.showViewModal = true;
        },

        editDriver(driver,i){
            this.index = i,
            this.editData.id = driver.id;
            this.editData.driver_name = driver.driver_name;
            this.editData.driver_phone = driver.driver_phone;
            this.editData.driver_email = driver.driver_email;
            this.editData.driver_address = driver.driver_address;
            this.editData.driver_age = driver.driver_age;
            this.editData.driver_car_type = driver.driver_car_type;
            this.editData.driver_nid_no = driver.driver_nid_no;
            this.editData.driver_license = driver.driver_license;
    
            this.editData.driver_img_old = driver.driver_img;
            this.editData.driver_img = '';

            this.editData.driver_license_img_old = driver.driver_license_img;
            this.editData.driver_license_img = '';

            this.showEditModal = true;
        },

        async updateDriver(){

            if(this.editData.driver_img == ''){
                this.editData.driver_img = this.editData.driver_img_old;
            }
            if(this.editData.driver_license_img == ''){
                this.editData.driver_license_img = this.editData.driver_license_img_old;
            }

            const res = await this.callApi("post", "driver/update",this.editData);
            if(res.status === 200){
                this.successMsg("Car Type Updated Successfully");
                this.carDriver[this.index].driver_name = this.editData.driver_name;
                this.carDriver[this.index].driver_car_type = this.editData.driver_car_type;
                this.carDriver[this.index].driver_address = this.editData.driver_address;
                this.carDriver[this.index].driver_phone = this.editData.driver_phone;
                this.carDriver[this.index].driver_email = this.editData.driver_email;
                this.carDriver[this.index].driver_img = this.editData.driver_img;
                this.carDriver[this.index].driver_nid_no = this.editData.driver_nid_no;
                this.carDriver[this.index].driver_age = this.editData.driver_age;
                this.carDriver[this.index].driver_license = this.editData.driver_license;
                this.carDriver[this.index].driver_license_img = this.editData.driver_license_img;
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
        this.getCarType();
        this.getDriver();
    },

    created(){
        this.token = window.laravel.csrfToken;
    }
}

</script>

<style scoped>

</style>