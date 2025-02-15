<template>
  <div>
    
    <div class="container-fluid bg-container p-0">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-sm-12 col-md-8 col-lg-6 col-xl-5 p-0 mt-5">
            
            <div class="card bg-card shadow text-white shadow position-relative mt-70">
              <div class="card-body pb-5 px-4 text-center">

                <img src="/img/logo.png" class="py-2 px-4" height="90" alt="">

                <div class="mb-md-3 mt-md-4">

                  <!-- <h3 class="fw-bolder mb-3 text-dark1 p-3 shadow-sm bg-light rounded">Login Here</h3> -->
                  <p class="text-light my-4 p-0">Please enter your login Email and Password!</p>

                  <div class="form-floating my-4">
                    <input type="email" v-model="data.email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput" class="text-dark">Email address</label>
                    <div class="text-danger text-start mt-2" v-if="errors['email']">
                      {{errors['email'][0]}}
                    </div>
                  </div>

                  <div class="input-group mb-3 w-100">
                    <div class="form-floating col">
                      <input v-model="data.password" name="password" :type="showPassword ? 'text' : 'password'" class="form-control custom-pass" id="floatingPassword" placeholder="Password">
                      <label for="floatingPassword" class="text-dark">Password</label>
                    </div>
                    <span @click="showPassword = !showPassword" class="input-group-text bg-white col-auto custom-pass2"><b-icon-eye v-if="!showPassword" class="d-inline text-secondary" width="15" height="15"></b-icon-eye><b-icon-eye-slash v-if="showPassword" class="d-inline text-secondary" width="15" height="15"></b-icon-eye-slash></span>
                    
                    <div class="text-danger text-start mt-2 col-12" v-if="errors['password']">
                      {{errors['password'][0]}}
                    </div>
                  </div>

                  <p class="small mb-5 pb-lg-2"><a class="text-light" href="https://besttourinfo.com/contact" target="_blank">Forgot password? <a class="text-primary" @click.prevent="emailLogin">Click here</a> or Contact Our Support Team.</a></p>

                  <button @click.prevent="loginUser" class="btn btn-success col-5 fw-bold py-2" type="submit">
                    <span v-if="loading">Entering....</span>
                    <span v-else>Login</span>
                  </button>

                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
    
    <Modal v-model="confirmationModalEmail"  :mask-closable="false"  class="vertical-modal" width="500" footer-hide>
        <div class="p-3 text-center">
          <div class="form-floating m-3">
            <input type="text" v-model="data.forgot_email" name="forgot_email" class="form-control form-control-sm" id="forgot_email" placeholder="Enter Your Log in Email">
            <label for="forgot_email" max="20" class="text-dark">Enter Your Log in Email<span class="text-danger">*</span></label>
            <div class="text-danger text-start mt-2" v-if="errors['forgot_email']">
              {{errors['forgot_email'][0]}}
            </div>
          </div>

          <button @click.prevent="confirm" class="btn btn-primary px-5 fw-bold mt-3" type="submit">
            <span v-if="this.loadingOne">Please Wait</span>
            <span v-else>Send Code</span>
          </button>

        </div>
    </Modal>

    <Modal v-model="confirmationModal"  :mask-closable="false"  class="vertical-modal" width="500" footer-hide>
        <div class="p-3 text-center">
          <p class="text-white p-3">We have sent you a confirmation code to this <span class="text-primary fw-bold">{{ data.forgot_email }}</span> email address. Please verify your email address and CONFIRM. </p>
          <div class="form-floating form-floating-sm m-3">
            <input type="text" v-model="data.confirmation_code_match" name="confirmation_code_match" class="form-control form-control-sm" id="confirmation_code_match" placeholder="Enter Confirmation Code">
            <label for="confirmation_code_match" max="20" class="text-dark">Enter Confirmation Code<span class="text-danger">*</span></label>
            <div class="text-danger text-start mt-2" v-if="errors['confirmation_code_match']">
              {{errors['confirmation_code_match'][0]}}
            </div>
          </div>

          <button @click.prevent="changePass" class="btn btn-primary px-5 fw-bold mt-3" type="submit">
            <span v-if="this.loadingOne">Please Wait</span>
            <span v-else>Confirm</span>
          </button>

        </div>
    </Modal>

    <Modal v-model="confirmationModalPassword"  :mask-closable="false"  class="vertical-modal" width="600" footer-hide>
        <div class="p-3 text-center mt-4">

          <h6 class="text-white p-3">Please Login with this <span class="text-primary fw-bold">{{ data.forgot_email }}</span> email address and <span class="text-primary fw-bold">Password</span> you CONFIRM. </h6>

          <div class="form-floating my-4">
            <input type="text" v-model="data.changedPassword" name="changedPassword" class="form-control" id="changedPassword" placeholder="Choose a Password">
            <label for="changedPassword" class="text-dark">Choose Password<span class="text-danger">*</span></label>
            <div class="text-danger text-start mt-2" v-if="errors['changedPassword']">
              {{errors['changedPassword'][0]}}
            </div>
          </div> 

          <div class="form-floating mb-2">
            <input type="text" v-model="data.cpassword" name="cpassword" class="form-control" id="cpassword" placeholder="Confirm Password">
            <label for="floatingPassword" class="text-dark">Confirm Password<span class="text-danger">*</span></label>
            <div class="text-danger text-start mt-2" v-if="errors['cpassword']">
              {{errors['cpassword'][0]}}
            </div>
          </div> 
        

          <button @click.prevent="confirmChangePass" class="btn btn-primary px-5 fw-bold mt-3" type="submit">
            <span v-if="this.loadingOne">Please Wait</span>
            <span v-else>Confirm Password</span>
          </button>

        </div>
    </Modal>


  </div>
</template>

<script>
export default {
    data(){
      return{
        showPassword: false,
        confirmationModalEmail: false,
        confirmationModal: false,
        confirmationModalPassword: false,
        loadingOne: false,
        
        data:{
          email:'',
          password:'',
          changedPassword:'',
          cpassword:'',
          forgot_email: '',
          confirmation_code: '',
          confirmation_code_match: '',
        },
        errors:[],
        loading: false,
      }
    },

    methods:{
      emailLogin(){
        this.confirmationModalEmail = true;
      },

      async confirm(){
        this.loadingOne = true;
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let result = "";
        for (let i = 0; i < 6; i++) {
          result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        this.data.confirmation_code = result;

        const res = await this.callApi("post", "/api/forgot", this.data);
          if(res.status === 200){
              this.loadingOne = false;
              this.errors= {};
              this.confirmationModalEmail = false;
              this.confirmationModal = true;
          }else {
              if(res.status === 401){
                  this.errorMsg(res.data.msg);
                  this.loadingOne = false;
              }else if (res.status === 422) {
                  for(let i in res.data.errors){
                  this.errors = res.data.errors
                }
                this.loadingOne = false;
              }
              else {
                this.loadingOne = false;
                this.errorMsg('Something went wrong! Reload the Page and try again');
              }
          }
        



      },

      async changePass(){
        this.loadingOne = true;
        
        const res = await this.callApi("post", "/api/changePassword", this.data);
          if(res.status === 200){
              this.loadingOne = false;
              this.errors= {};
              this.confirmationModal = false;
              this.confirmationModalPassword = true;
          }else {
              if(res.status === 401){
                  this.errorMsg(res.data.msg);
                  this.loadingOne = false;
              }else if (res.status === 422) {
                  for(let i in res.data.errors){
                  this.errors = res.data.errors
                }
                this.loadingOne = false;
              }
              else {
                this.loadingOne = false;
                this.errorMsg('Something went wrong! Reload the Page and try again');
              }
          }
      },

      async confirmChangePass(){
        this.loadingOne = true;
        
        const res = await this.callApi("post", "/api/confirmChangePassword", this.data);
          if(res.status === 200){
              this.successMsg("Your Password has been changed");
              this.loadingOne = false;
              this.errors= {};
              this.confirmationModalPassword = false;
              setTimeout(() => {
                this.$router.go();
              }, 600);
          }else {
              if(res.status === 401){
                  this.errorMsg(res.data.msg);
                  this.loadingOne = false;
              }else if (res.status === 422) {
                  for(let i in res.data.errors){
                  this.errors = res.data.errors
                }
                this.loadingOne = false;
              }
              else {
                this.loadingOne = false;
                this.errorMsg('Something went wrong! Reload the Page and try again');
              }
          }

      },

      async loginUser() {
      try {
          this.loading = true;
          // Make the API call
          const res = await this.callApi("post", "/user-login", this.data);

          // Handle successful login
          if (res.status === 200 || res.status === 302) {
              this.successMsg(res.data.msg);
              window.location = '/profile';
          } 
          // Handle validation errors
          else if (res.status === 422) {
              this.errors = res.data.errors;
          } 
          // Handle other errors
          else {
              this.errors = { password: ["Invalid Email Password"] };
          }
      } catch (error) {
          // Log or display unexpected errors
          this.errors = { general: ["An unexpected error occurred"] };
      } finally {
          // Ensure loading is turned off regardless of the outcome
          this.loading = false;
      }
    }

      
      


    }    
}
</script>

<style scoped>
/* .image {
  background: #fff;
  border-radius: 10px;
  border-top: 3px solid #000;
} */
.bg-container {
  background-repeat: no-repeat !important;
  background-size: cover !important;
  background-position: center center !important;
  background:linear-gradient(0deg, rgba(166, 42, 42, 0.381), rgba(0, 0, 0, 0.392)), url("/img/constration.jpg");
}
.bg-card {
  background-repeat: no-repeat !important;
  background-size: cover !important;
  background:linear-gradient(0deg, rgba(0, 0, 0, 0.83), rgba(94, 21, 21, 0.585)), url("/img/constration.jpg");
  border: 3px solid rgba(20, 67, 1, 0.882);
  border-radius: 30px;
}
.mt-70{
  margin-top: 70px;
}

.custom-pass{
  border-top-right-radius: 0 !important;
  border-bottom-right-radius: 0 !important;
}

.custom-pass2{
  border-top-left-radius: 0 !important;
  border-bottom-left-radius: 0 !important;
}

</style>