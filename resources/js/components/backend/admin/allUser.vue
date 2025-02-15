<template>
    <div>

      <div class="container-fluid">
        <div class="row">
          
            <div class="col-md-12 rounded bg-main m-0 p-3"> 

                <h5 class="p-3 bg-header color-white table-border-dark d-flex aling-items-center justify-content-center fw-bold aling-middle"><b-icon-people class="d-inline text-success mr-2" width="22" height="22"></b-icon-people>Customer List</h5>

                <div class="table-responsive">

                    <table class="table mt-3 table-striped rounded text-dark text-center">
                        <thead>
                            <tr>
                                <th class="color-white" scope="col">SL</th>
                                <th class="color-white" scope="col">Customer Name</th>
                                <th class="color-white" scope="col">Customer Email</th>
                                <th class="color-white" scope="col">Customer Phone</th>
                                <th class="color-white" scope="col">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>

                          <tr class="mx-0 px-0 my-auto" v-for="(user,i) in allUser" :key="i">
                              <th scope="row" class="align-middle color-main">{{  pageInfo.from + i }}</th>
                              <td class="fw-bold mx-0 px-0 align-middle color-main">{{ user.name }}</td>
                              <td  class="mx-0 px-0 align-middle color-main">{{ user.email }}</td>
                              <td  class="mx-0 px-0 align-middle color-main">{{ user.mobile ? user.mobile : 'N/A' }}</td>
                              <td  class="mx-0 px-0 my-auto">
                                  <a @click="changePass(user,i)" class="mx-2 btn btn-sm btn-outline-primary border-warning px-2 m-1"><b-icon-arrow-repeat class="d-inline mr-1" width="16" height="16"></b-icon-arrow-repeat>Change Password</a>
                                  <a @click="view(user,i)" class="mx-2 btn btn-sm btn-outline-secondary px-2 m-1"><b-icon-eye class="d-inline mr-1" width="16" height="16"></b-icon-eye></a>
                                  <a @click="deleteUser(user,i)" class="mx-2 btn btn-sm btn-outline-danger px-2"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                              </td>
                          </tr>
                            
                        </tbody>
                    </table>

                </div>

                <div class="d-flex justify-content-between my-3">
                    <div class="text-start">
                      <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.allUser != ''" @on-change="getUser" />
                    </div>
                    <div class="text-end d-flex">
                        <label for="perPage" class="col-form-label color-white text-end mr-3">Show List</label>
                        <select id="perPage" class="form-select-sm form-select col bg-body" v-model="this.total" @change="this.getUser()">
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
          v-model="showViewModal"
          :mask-closable="false"
          width="650"
          footer-hide	
          >
          <template #header>
              <p class="d-flex align-items-center justify-content-center" style="color: rgb(0, 99, 7); text-align: center; min-height:40px">
              <Icon type="ios-information-circle-outline" size="34" />
              <span class="ml-2 fw-bolder color-white fs-6">User Information</span>
              </p>
          </template>

          <div class="row p-2" v-for="(u, i) in singleUser" :key="i">
            <!-- Left Column -->
            <div class="col-md-6 border-md-end">
              <div class="d-flex justify-content-between py-2" v-for="(label, key) in {
                'Name': u.name,
                'Email': u.email,
                'Phone': u.mobile,
                'Date Of Birth': u.date_of_birth,
                'NID': u.nid,
                'Marital Status': u.marital_status
              }" :key="key">
                <span class="color-white">{{ key }}:</span>
                <span class="color-main">{{ label || 'N/A' }}</span>
              </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
              <div class="d-flex justify-content-between py-2" v-for="(label, key) in {
                'Gender': u.gender,
                'Passport No': u.passport_no,
                'Passport Expiry Date': u.passport_expiry_date,
                'Language': u.language,
                'Religion': u.religion
              }" :key="key">
                <span class="color-white">{{ key }}:</span>
                <span class="color-main">{{ label || 'N/A' }}</span>
              </div>

            <!-- Profile Image -->
            <div class="d-flex align-items-center py-2">
                <span class="color-white">Profile Image:</span>
                <a target="_blank" :href="u.image || defaultImage"><img :src="u.image || defaultImage" width="40" class="ms-2 rounded-circle" alt="User Image"></a>
              </div>
            </div>

            <!-- Address Section -->
            <div class="col-12 p-3 table-border-dark rounded">
              <div class="d-flex justify-content-between py-2">
                <span class="color-white">Present Address:</span>
                <span class="color-main">
                  {{ u.house_number || '' }}, {{ u.street_name || '' }}, {{ u.city || '' }}, {{ u.postal_code || '' }}
                </span>
              </div>
              <div class="d-flex justify-content-between py-2">
                <span class="color-white">Permanent Address:</span>
                <span class="color-main">
                  {{ u.permanent_house_number || '' }}, {{ u.permanent_street_name || '' }}, {{ u.permanent_city || '' }}, {{ u.permanent_postal_code || '' }}
                </span>
              </div>
            </div>
          </div>
      </Modal>

       <!-- Edit Moadal -->
       <Modal
          v-model="showEditModal"
          :mask-closable="false"
          width="600"
          >
          <template #header>
              <p class="d-flex align-items-center justify-content-center" style="color: rgb(3, 75, 25); text-align: center; min-height:40px">
                  <Icon type="ios-create" color="green" size="30" />
              <span class="ml-2 fw-bolder color-white fs-6">Update User Password</span>
              </p>
          </template>


          <div class="row">
              
            <div class="col-md-12 p-3">
                <label for="pass" class="form-label fw-bolder color-white">Password</label>
                <input type="text" name="pass" v-model="editData.pass" class="form-control" id="pass" :class="hasError('pass') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('pass')">{{getError('pass')}}</div>
            </div>

          </div>


          <template #footer>
              <button @click="updateUser()" class="btn btn-outline-success px-3">Update</button>
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
              <p>Are you sure you want to delete this User ?</p>
          </div>
          <template #footer>
              <button type="default" class="btn btn-outline-secondary btn-sm" @click="this.showDeleteModal = false">Close</button>
              <button @click="UserDelete()" class="btn btn-outline-danger btn-sm">Delete</button>
          </template>
      </Modal>

    </div>
</template>
  
  <script>
  
  
  export default {
    data(){
      return{
        user: this.$store.state.user,
        errors: {},
        allUser: [],
        total:8,
        pageInfo: null,
        showDeleteModal: false,
        showViewModal: false,
        showEditModal: false,
        defaultImage: 'img/no-image.png',
        deleteUserData:{
          id: ''
        },
        editData:{
          pass: ''
        },
        singleUser: [],
      }
    },
  
    methods:{

      async getUser(page){
        const res = await this.callApi("get",`/get_all_User?total=${this.total}&page=${page}`);
        if (res.status == 200) {
            this.allUser = res.data.data;
            this.pageInfo = res.data;
            //console.log(this.pageInfo);
        } else {
            this.errorMsg();
        }
      },

      deleteUser(user,i) {
        this.deleteUserData.id = user.id;
        this.showDeleteModal = true; 
      },

      async view(user,i) {
        const res = await this.callApi("get",`/get_one_User?id=${user.id}`);
        if (res.status == 200) {
            this.singleUser = res.data
            this.showViewModal = true;
            //console.log(this.singleUser)
        } else {
            this.errorMsg();
        }
      },

      async UserDelete(){
        //console.log(this.deleteUserData);
        const res = await this.callApi("post", "user/delete",this.deleteUserData);
        if(res.status === 200){
            this.successMsg("User Deleted Successfully");
            this.allUser = res.data.data;
            this.pageInfo = res.data;
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

      changePass(user,i){
        this.editData.id = user.id,
        this.showEditModal = true;
        this.errors= {};
      },

      async updateUser(){
        //console.log(this.editData)
        const res = await this.callApi("post", "user/update",this.editData);
        if(res.status === 200){
            this.successMsg("User Information Updated Successfully");
            this.allUser = res.data.data;
            this.pageInfo = res.data;
            this.editData = {};
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
      }


    },
  
    mounted(){
      this.getUser();
    }
  }
  </script>
  
  <style scoped>
  .m-70 {
    margin-top: 100px;
    margin-bottom: 20px;
  }
  </style>