<template>
    <div>

      <div class="container-fluid">
        <div class="row">
          
            <div class="col-md-12 bg-main rounded m-0 p-3"> 

                <h5 class="p-3 bg-header color-white table-border-dark d-flex aling-items-center justify-content-center fw-bold aling-middle"><b-icon-person-badge-fill class="d-inline text-success mr-2" width="22" height="22"></b-icon-person-badge-fill>All Editor</h5>

                <div class="table-responsive">

                    <router-link to="/add-editor" v-if="this.$store.state.user.userType == 'super'" @click="showAddModal = true" class="shadow color-white btn btn-sm btn-outline-info m-2"><b-icon-plus class="d-inline text-success mr-2" width="22" height="22"></b-icon-plus>Add Editor</router-link>

                    <table class="table table-striped rounded text-center border-0">
                        <thead>
                            <tr>
                                <th class="color-white" scope="col">SL</th>
                                <th class="color-white" scope="col">Editor Name</th>
                                <th class="color-white" scope="col">Editor Email</th>
                                <th class="color-white" scope="col">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>

                            <tr class="mx-0 px-0 my-auto" v-for="(editor,i) in editors" :key="i">
                                <th scope="row" class="align-middle color-main">{{i+1}}</th>
                                <td class="fw-bold mx-0 px-0 align-middle color-main">{{ editor.name }}</td>
                                <td  class="mx-0 px-0 align-middle color-main">{{ editor.email }}</td>
                                <td  class="mx-0 px-0 my-auto" v-if="this.$store.state.user.userType != 'editor' || this.$store.state.user.name == editor.name">
                                    <a @click="editEditor(editor,i)" class="mx-2 btn btn-sm btn-outline-info px-2 m-1" data-toggle="modal" data-target="#editModal"><b-icon-pencil-square class="d-inline mr-1" width="16" height="16"></b-icon-pencil-square></a>
                                    <a @click="deleteEditor(editor,i)" class="mx-2 btn btn-sm btn-outline-warning px-2"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                                </td>
                                <td  class="mx-0 px-0 my-auto" v-else>
                                    <p class="p-2 fw-bold"><span class="color-main">"</span>Can't Edit/Delete this Editor <span class="text-danger">"</span></p>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>

                </div>

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
              <span class="ml-2 fw-bolder color-white fs-6">Update Editor</span>
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
              <button @click="updateEditor()" class="btn btn-outline-success px-3">Update</button>
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
            <p>Are you sure you want to delete this Editor ?</p>
        </div>
        <template #footer>
            <button type="default" class="btn btn-outline-secondary btn-sm" @click="this.showDeleteModal = false">Close</button>
            <button @click="editorDelete()" class="btn btn-outline-danger btn-sm">Delete</button>
        </template>
    </Modal>

    </div>
</template>
  
  <script>
  
  
  export default {
    data(){
      return{
        user: this.$store.state.user,
        showEditModal: false,
        showDeleteModal: false,
        errors: {},
        editors: [],
        editData: {
          name: '',
          email: '',
          pass: '',
          id: ''
        },
        deleteData: {
          id: ''
        }
        ,
        deletingIndex: -1
      }
    },
  
    methods:{
      async getEditor(){
        const res = await this.callApi("get","/get_all_editors");
        if (res.status == 200) {
            this.editors = res.data;
            //console.log(this.editors);
        } else {
            this.errorMsg();
        }
      },

      editEditor(editor,i){
        this.editData = {};
        this.editData.id = editor.id,
        this.editData.name = editor.name,
        this.editData.email = editor.email,
        this.editData.pass = '',
        this.showEditModal = true;
      },

      deleteEditor(editor,i){
        this.deleteData = {};
        this.deleteData.id = editor.id;
        this.showDeleteModal = true;
        this.deletingIndex = i;
      },

      async updateEditor(){
        //console.log(this.editData);
        const res = await this.callApi("post", "editor/update",this.editData);
        if(res.status === 200){
            this.editors = res.data;
            this.successMsg("Editor Updated Successfully");
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

      async editorDelete(){
        //console.log(this.deleteData);
        const res = await this.callApi("post", "editor/delete",this.deleteData);
        if(res.status === 200){
            this.successMsg("Editor Deleted Successfully");
            this.editors.splice(this.deletingIndex,1);
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
      }

    },
  
    mounted(){
      this.getEditor();
    }
  }
  </script>
  
  <style scoped>
  .m-70 {
    margin-top: 100px;
    margin-bottom: 20px;
  }
  </style>