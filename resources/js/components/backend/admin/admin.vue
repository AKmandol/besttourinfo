<template>
    <div>
      <div class="container">
        <div class="row">
          <div class="col-8 my-auto mx-auto p-3 shadow text-center color-main bg-main rounded">

            <div class="d-flex justify-content-between p-3 bg-header rounded shadow">
                <h4 class="color-white fw-bold my-auto"><b-icon-code-square class="text-success mr-2 d-inline" width="30" height="30"></b-icon-code-square>Admin Type</h4>
                <h6 class="color-main my-auto">{{ user.role }}</h6>
            </div>
            
            <div class="p-3 mt-3 bg-main rounded color-main">
                <div class="d-flex justify-content-between">
                    <p class="color-white fw-bold">Name:</p>
                    <p class="color-main my-auto"> {{user.name}}</p>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <p class="color-white fw-bold">Eamil:</p>
                    <p class="color-main my-auto">{{user.email}}</p>
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
      }
    },
  
    methods:{
      logout(){
        axios.post('/app/admin_logout').then((res) => {
          this.$router.push({ name: "LoginUser"});
      })
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
  .bg-dark1 {
    background: #000;
  }
  </style>