<template>
  <div>
    <section>
      <div class="container-fluid bg-container p-0">
        <div class="container py-5 h-100 px-2">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-sm-12 col-md-8 col-lg-6 col-xl-5 mt-5">
              <div class="card bg-card shadow text-white mt-70">

                <img src="/img/logo.png" class="px-4 image position-absolute start-50 translate-middle" height="70" alt="">
                <h3 class="fw-bold mb-2 text-dark p-3 text-center rounded-two bg-white">Register Your Account</h3>

                <div class="card-body p-5 text-center p-0">

                  <div class="mb-md-2 mt-md-2 p-0 mx-0">

                    <p class="text-light"><span class="text-danger">* </span> Please Enter All Information Correctly <span class="text-danger"> *</span></p>

                    <div class="form-floating mb-3 mt-5">
                      <input type="text" v-model="data.name" name="name" class="form-control rounded" id="floatingInput" placeholder="Md Jahid Hasan">
                      <label for="floatingInput" max="20" class="text-dark">Full Name <span class="text-danger">*</span></label>
                      <div class="text-danger text-start mt-2" v-if="errors['name']">
                        {{errors['name'][0]}}
                      </div>
                    </div>

                    <div class="form-floating mb-3">
                      <input type="email" v-model="data.email" name="email" class="form-control rounded" id="floatingInput" placeholder="name@example.com">
                      <label for="floatingInput" class="text-dark">Email address <span class="text-danger">*</span></label>
                      <div class="text-danger text-start mt-2" v-if="errors['email']">
                        {{errors['email'][0]}}
                      </div>
                    </div>

                    <div class="form-floating mb-3">
                      <input type="text" v-model="data.mobile" name="mobile" class="form-control rounded" id="floatingInput" placeholder="+8801733454648">
                      <label for="floatingInput" class="text-dark">Mobile Number<span class="text-danger">*</span></label>
                      <div class="text-danger text-start mt-2" v-if="errors['mobile']">
                        {{errors['mobile'][0]}}
                      </div>
                    </div>

                    <div class="form-floating mb-4">
                      <input type="text" v-model="data.password" name="password" class="form-control rounded" id="floatingPassword" placeholder="Password">
                      <label for="floatingPassword" class="text-dark">Choose a Password<span class="text-danger">*</span></label>
                      <div class="text-danger text-start mt-2" v-if="errors['password']">
                        {{errors['password'][0]}}
                      </div>
                    </div>

                    <button @click="register" class="btn btn-success btn-lg px-5 fw-bold" type="submit">
                      <span v-if="this.loading2">Confirm</span>
                      <span v-else>Please Wait...</span>
                    </button>

                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Subscriber  Modal -->
    <Modal v-model="confirmationModal"  :mask-closable="false"  class="vertical-modal" width="500" footer-hide>
        <div class="p-3 text-center">
          <p class="text text-white p-3">We have sent you a confirmation code to this <span class="text-primary fw-bold">{{ data.email }}</span> email address. Please verify your email address and continue register. </p>
          <div class="form-floating m-3">
            <input type="text" v-model="data.confirmation_code_match" name="confirmation_code_match" class="form-control form-control-sm" id="confirmation_code_match" placeholder="Enter Confirmation Code">
            <label for="confirmation_code_match" max="20" class="text-dark">Enter Confirmation Code<span class="text-danger">*</span></label>
            <div class="text-danger text-start mt-2" v-if="errors['confirmation_code_match']">
              {{errors['confirmation_code_match'][0]}}
            </div>
          </div>

          <button @click.prevent="confirm" class="btn btn-primary px-5 fw-bold mt-3" type="submit">
            <span v-if="this.loading">Register</span>
            <span v-else>Saving Account</span>
          </button>

        </div>
    </Modal>


  </div>
</template>

<script>
import { result } from 'lodash';
export default {
    data(){
      return{
        data:{
          confirmation_code: '',
          confirmation_code_match: '',
          name:'',
          email:'',
          mobile:'',
          password:''
        },
        errors:[],
        loading: true,
        loading2: true,
        confirmationModal: false,
      }
    },

    methods:{

      async confirm(){
        this.loading = false;
        const res = await this.callApi("post", "/api/registerAccountConfirm", this.data);
          if(res.status === 200){
              this.successMsg("Your Account Has Been Registered");
              this.confirmationModal = false;
              this.errors= {};
              this.loading = true;
              window.location = '/user-login';
          }else {
              if(res.status === 401){
                  this.loading = true;
                  this.errorMsg(res.data.msg);
              }else if (res.status === 422) {
                  this.loading = true;
                  for(let i in res.data.errors){
                  this.errors = res.data.errors
                }
              }
              else {
                this.loading = true;
                this.errorMsg('Something went wrong! Reload the Page and try again');
              }
          }
      },
      
      async register(){
        this.loading2 = false;
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let result = "";
        for (let i = 0; i < 6; i++) {
          result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        this.data.confirmation_code = result;

        const res = await this.callApi("post", "/api/registerAccount", this.data);
          if(res.status === 200){
              console.log(res.data)
              this.confirmationModal = true;
              this.loading2 = true;
              this.errors= {};
          }else {
              if(res.status === 401){
                  this.errorMsg(res.data.msg);
                  this.loading2 = true;
              }else if (res.status === 422) {
                  for(let i in res.data.errors){
                  this.errors = res.data.errors
                }
                this.loading2 = true;
              }
              else {
                this.loading2 = true;
                this.errorMsg('Something went wrong! Reload the Page and try again');
              }
          }
        }
      
      


    }    
}
</script>

<style scoped>
.image {
  top: -35px;
  background: #ffffff;
  border-top-right-radius: 15px;
  border-top-left-radius: 15px;
  border-top: 3px solid rgb(122, 122, 10);
}
.bg-container {
  background-repeat: no-repeat;
  background-position: center center;
  background:linear-gradient(0deg, rgba(0, 0, 0, 0.558), rgba(0, 0, 0, 0.558)), url("/img/regiserBack.webp");
}
.otherLogin:hover{
  background: rgba(0, 0, 0, 0.862) !important;
  cursor: pointer;
}
.otherLogin:hover .otherText{
  color: aliceblue !important;
}

.mt-70{
  margin-top: 70px;
}
.bg-card {
  background-repeat: no-repeat;
  background-position: center center;
  background:linear-gradient(0deg, rgba(0, 0, 0, 0.703), rgba(0, 0, 0, 0.741)), url("/img/regiserBack.webp");
  border: 3px solid rgb(122, 122, 10);
  position: relative;
  border-radius: 15px;
}

.rounded-two{
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
}

</style>