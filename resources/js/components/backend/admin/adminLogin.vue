<template>
  <div>
    <section>
      <div class="container">
        <div class="row d-flex justify-content-center align-items-center login">
          <div class="col-md-7 col-lg-6 col-xl-5 pb-5 px-0 px-md-3">
            <div class="card bg-card shadow text-white rounded-3 position-relative">

              <img src="/img/logo.png" class="py-2 px-4 shadow image bg-header table-border-dark position-absolute top-0 start-50 translate-middle" height="80" alt="">

              <div class="card-body py-5 px-4 text-center">

                <h2 class="fw-bold mb-2 text-info">Admin Login</h2>
                <p class="text-white-60 mb-5">Please enter your login and password!</p>

                <div class="form-floating mb-4">
                  <input type="email" v-model="data.email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                  <label for="floatingInput" class="color-white">Email address</label>
                  <div class="text-danger text-start mt-2" v-if="errors['email']">
                    {{errors['email'][0]}}
                  </div>
                </div>

                <div class="input-group mb-3 w-100">
                  <div class="form-floating w-custom text-start">
                    <input v-model="data.password" name="password" :type="showPassword ? 'text' : 'password'" class="form-control round" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword" class="color-white">Password</label>
                  </div>
                  <div class="input-group-text bg-transparent table-border-dark" @click="showPassword = !showPassword"><b-icon-eye v-if="!showPassword" class="d-inline text-secondary mx-auto" width="15" height="15"></b-icon-eye><b-icon-eye-slash v-if="showPassword" class="d-inline text-secondary mx-auto" width="15" height="15"></b-icon-eye-slash></div>
                  
                  <div class="text-danger text-start mt-2" v-if="errors['password']">
                    {{errors['password'][0]}}
                  </div>
                </div>

                <p class="small mb-2 pb-lg-2"><a class="text-white-50" href="#" target="_blank">Forgot password?</a></p>

                <button @click.prevent="loginAdmin" class="btn btn-dark col-5 fw-bold py-2 table-border" type="submit">
                    <span v-if="loading">Entering....</span>
                    <span v-else>Login</span>
                </button>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
    data(){
      return{
        showPassword: false,
        data:{
          email:'',
          password:'',
        },
        errors:[],
        loading: false

      }
    },

    methods:{
      async loginAdmin(){
        try {
          this.loading = true;
          // Make the API call
          const res = await this.callApi("post", "app/admin_login", this.data);

          // Handle successful login
          if (res.status === 200 || res.status === 302) {
              this.successMsg(res.data.msg);
              window.location = '/dashboard'
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

.round{
  border-top-right-radius: 0 !important;
  border-bottom-right-radius: 0 !important;
}
.w-custom{
  width: 90%;
}
.w-custom2{
  width: 10%;
}
.image {
  border-radius: 10px;
}
.bg-card {
  background-color: #010c2e3d;
  background-image: linear-gradient(180deg, rgb(1, 10, 3) 10%, #1b0d01 100%);
  background-size: cover;
}
 
.login{
  height: 93vh;
}

.table-border{
    border: 1px solid #003e41;;
}
</style>