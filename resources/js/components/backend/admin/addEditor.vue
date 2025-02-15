<template>
    <div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10 col-sm-12 my-auto mx-auto p-3">
            
            <div class="p-3 bg-header">
              <div class="card-header bg-header">
                <p class="d-flex align-items-center justify-content-center" style="color: rgb(3, 75, 25); text-align: center; min-height:40px">
                    <Icon type="ios-add-circle" size="30" />
                <span class="ml-2 fw-bolder color-white fs-6">Add Editor</span>
                </p>
              </div>

              <div class="card-body bg-main row">
                <div class="col-md-7 col-sm-12">
                  <div class="col-md-12 p-3">
                      <label for="name" class="form-label fw-bolder color-white">Editor Name</label>
                      <input type="text" name="name" v-model="data.name" class="form-control" id="name" :class="hasError('name') ? 'is-invalid' : '' ">
                      <div class="invalid-feedback" v-if="hasError('name')">{{getError('name')}}</div>
                  </div>

                  <div class="col-md-12 p-3">
                      <label for="email" class="form-label fw-bolder color-white">Editor Email</label>
                      <input type="email" name="email" v-model="data.email" class="form-control" id="email" :class="hasError('email') ? 'is-invalid' : '' ">
                      <div class="invalid-feedback" v-if="hasError('email')">{{getError('email')}}</div>
                  </div>

                  <div class="col-md-12 p-3">
                      <label for="pass" class="form-label fw-bolder color-white">Password</label>
                      <input type="text" name="pass" v-model="data.pass" class="form-control" id="pass" :class="hasError('pass') ? 'is-invalid' : '' ">
                      <div class="invalid-feedback" v-if="hasError('pass')">{{getError('pass')}}</div>
                  </div>
                </div>

                <div class="col-md-5 col-sm-12 bg-header rounded">
                  <h6 class="color-white text-center mt-2 mb-3">Permissions</h6>
                  <hr class="text-success">
                  <div class="d-flex justify-content-between py-2">
                    <p class="color-white fw-bold">Client:</p> <p class="text-primary fw-bold shadow px-3 rounded">"Edit" + "View"</p>
                  </div>
                  <div class="d-flex justify-content-between py-2">
                    <p class="color-white fw-bold">Hotel:</p> <p class="text-primary fw-bold shadow px-3 rounded">"Add" + "Edit"</p>
                  </div>
                  <div class="d-flex justify-content-between py-2">
                    <p class="color-white fw-bold">Booking:</p> <p class="text-primary fw-bold shadow px-3 rounded">"Edit"</p>
                  </div>
                  <div class="d-flex justify-content-between py-2">
                    <p class="color-white fw-bold">Blog:</p> <p class="text-primary fw-bold shadow px-3 rounded">"Add" + "Edit"</p>
                  </div>
                  <div class="d-flex justify-content-between py-2">
                    <p class="color-white fw-bold">Subscriber List:</p> <p class="text-primary fw-bold shadow px-3 rounded">"View"</p>
                  </div>
                  <div class="d-flex justify-content-between py-2">
                    <p class="color-white fw-bold">Ads:</p> <p class="text-primary fw-bold shadow px-3 rounded">"All Permission"</p>
                  </div>
                </div>
              </div>

              <div class="card-footer text-center">
                <a @click="addEditor" class="btn col-3 fw-bold btn-outline-success">Add</a>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
</template>
  
  <script>
  
  
  export default {
    data(){
      return{
        user: this.$store.state.user,
        errors:{},
        data: {
          name: '',
          email: '',
          pass: ''
        },
        editors: [],
      }
    },
  
    methods:{
      async addEditor(){
        //console.log(this.data);
        const res = await this.callApi("post", "editor/store",this.data);
        if(res.status === 200){
            this.successMsg("Editor Added Successfully");
            this.editors = res.data;
            this.$router.push({name: 'All-Editor'});
            this.data = {};
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
  
    // mounted(){
    //   axios.get('/api/user').then((res) => {
    //     this.user = res.data;
    //   })
    // }
  }
  </script>
  
  <style scoped>
  .m-70 {
    margin-top: 100px;
    margin-bottom: 20px;
  }
  </style>