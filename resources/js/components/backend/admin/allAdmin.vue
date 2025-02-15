<template>
    <div>

      <div class="container-fluid">
        <div class="row">
          
            <div class="col-md-12 bg-main rounded m-0 p-3"> 

                <h5 class="p-3 bg-header table-border-dark color-white d-flex aling-items-center justify-content-center fw-bold aling-middle"><b-icon-person-workspace class="d-inline text-success mr-2" width="22" height="22"></b-icon-person-workspace>All Admin</h5>

                <div class="table-responsive">

                    <a v-if="this.$store.state.user.userType == 'super'" @click="showAddModal = true" class="shadow color-white btn btn-sm btn-outline-info m-2"><b-icon-plus class="d-inline text-success mr-2" width="22" height="22"></b-icon-plus>Add Admin</a>

                    <table class="table table-striped rounded text-center border-0">
                        <thead>
                            <tr>
                                <th scope="col" class="color-white">SL</th>
                                <th scope="col" class="color-white">Admin Name</th>
                                <th scope="col" class="color-white">Admin Email</th>
                                <th scope="col" class="color-white">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>

                            <tr class="mx-0 px-0 my-auto" v-for="(man,i) in admin" :key="i">
                                <th   class="align-middle color-main">{{ i+1 }}</th>
                                <td class="fw-bold mx-0 px-0 align-middle color-main">{{ man.name }}</td>
                                <td  class="mx-0 px-0 align-middle color-main">{{ man.email }}</td>
                                <td  class="mx-0 px-0 my-auto color-main" v-if="this.$store.state.user.userType == 'super' || this.$store.state.user.name == man.name">
                                    <a @click="editAdmin(man,i)" class="shadow mx-2 btn btn-sm btn-outline-info px-2 m-1"><b-icon-pencil-square class="d-inline mr-1" width="16" height="16"></b-icon-pencil-square></a>
                                    <a @click="deleteAdmin(man,i)" class="shadow mx-2 btn btn-sm btn-outline-warning px-2"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                                </td>
                                <td  class="mx-0 px-0 my-auto color-main" v-else>
                                    <p class="p-2 fw-bold"><span class="text-danger">"</span>Can't Edit/Delete this Admin <span class="text-danger">"</span></p>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>

                </div>

            </div> 

        </div>


        <!-- Edit Moadal -->
        <Modal
            v-model="showEditModal"
            :mask-closable="false"
            width="600"
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center" style="color: rgb(3, 75, 25); text-align: center; min-height:40px">
                    <Icon type="ios-create-outline" class="color-success" size="30" />
                <span class="ml-2 fw-bolder color-white fs-6">Update Admin</span>
                </p>
            </template>


            <div class="row">
                <div class="col-md-12 p-3">
                    <label for="name" class="form-label fw-bolder color-white">Admin Name</label>
                    <input type="text" name="name" v-model="editData.name" class="form-control" id="name" :class="hasError('name') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('name')">{{getError('name')}}</div>
                </div>

                <div class="col-md-12 p-3">
                    <label for="email" class="form-label fw-bolder color-white">Admin Email</label>
                    <input type="email" name="email" v-model="editData.email" class="form-control" id="email" :class="hasError('email') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('email')">{{getError('email')}}</div>
                </div>

                <div class="col-md-12 p-3">
                    <label for="pass" class="form-label fw-bolder color-white">Password</label>
                    <input type="text" name="pass" v-model="editData.pass" class="form-control" id="pass" :class="hasError('pass') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('pass')">{{getError('pass')}}</div>
                </div>
            </div>


            <template #footer>
                <button @click="updateAmin()" class="btn btn-outline-success px-3 shadow">Update</button>
            </template>
        </Modal>

        <!-- Add Moadal -->
        <Modal
            v-model="showAddModal"
            :mask-closable="false"
            width="600"
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center" style="color: rgb(3, 75, 25); text-align: center; min-height:40px">
                    <Icon type="ios-add-circle" class="color-success" size="30" />
                <span class="ml-2 fw-bolder color-white fs-6">Add Admin</span>
                </p>
            </template>


            <div class="row">
                <div class="col-md-12 p-3">
                    <label for="name" class="form-label fw-bolder color-white">Admin Name</label>
                    <input type="text" name="name" v-model="data.name" class="form-control" id="name" :class="hasError('name') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('name')">{{getError('name')}}</div>
                </div>

                <div class="col-md-12 p-3">
                    <label for="email" class="form-label fw-bolder color-white">Admin Email</label>
                    <input type="email" name="email" v-model="data.email" class="form-control" id="email" :class="hasError('email') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('email')">{{getError('email')}}</div>
                </div>

                <div class="col-md-12 p-3">
                    <label for="pass" class="form-label fw-bolder color-white">Password</label>
                    <input type="text" name="pass" v-model="data.pass" class="form-control" id="pass" :class="hasError('pass') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('pass')">{{getError('pass')}}</div>
                </div>
            </div>


            <template #footer>
                <button @click="addAmin()" class="btn btn-outline-success px-3 shadow">Add</button>
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
            <div class="text-center color-white">
                <p>Are you sure you want to delete this Admin ?</p>
            </div>
            <template #footer>
                <button type="default" class="btn btn-outline-secondary btn-sm" @click="this.showDeleteModal = false">Close</button>
                <button @click="adminDelete()" class="btn btn-outline-danger btn-sm">Delete</button>
            </template>
        </Modal>

      </div>

    </div>
</template>
  
  <script>
  
  
  export default {
    data(){
      return{
        errors:{},
        user: this.$store.state.user,
        admin: [],
        showDeleteModal: false,
        showAddModal: false,
        showEditModal: false,
        data:{
            name:'',
            email:'',
            pass:'',
        },
        editData:{
            name:'',
            email:'',
            pass:'',
            id:''
        },
        deleteData:{
            id:''
        },
        deletingIndex: -1,
      }
    },
  
    methods:{

      async getAdmin(){
        const res = await this.callApi("get","/get_all_Admin");
        if (res.status == 200) {
            this.admin = res.data;
        } else {
            this.errorMsg();
        }
      },

      async addAmin(){
        //console.log(this.data);
        const res = await this.callApi("post", "admin/store",this.data);
        if(res.status === 200){
            this.successMsg("Admin Added Successfully");
            this.admin = res.data;
            this.showAddModal = false;
            this.$router.go();
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

      async deleteAdmin(man,i){
        this.deleteData = {};
        this.deleteData.id = man.id;
        this.showDeleteModal = true;
        this.deletingIndex = i;
      },

      async editAdmin(man,i){
        this.editData = {};
        this.editData.name = man.name;
        this.editData.email = man.email;
        //this.editData.pass = man.password;
        this.editData.id = man.id;
        this.showEditModal = true;
      },

      async updateAmin(){
        const res = await this.callApi("post", "admin/update",this.editData);
        if(res.status === 200){
            this.admin = res.data;
            this.successMsg("Admin Updated Successfully");
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

      async adminDelete(){
        //console.log(this.deleteData);
        const res = await this.callApi("post", "admin/delete",this.deleteData);
        if(res.status === 200){
            this.successMsg("Admin Deleted Successfully");
            this.admin.splice(this.deletingIndex,1);
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

    



    },
  
    mounted(){
      this.getAdmin();
    }
  }
  </script>
  
  <style scoped>
  
  </style>