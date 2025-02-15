<template>
  <div>

    <div class="container-fluid">

      <div class="row mb-3">

        <div class="col-lg-3 col-md-6 co-sm-12 mx-auto p-4">
          <div class="row p-4 shadow bg-one rounded col-hover">
            <div class="col-md-10 col-sm-12 my-auto">
                <h3 class="color-white fw-bold my-auto"><b-icon-gear-wide-connected class="text-success mr-3 d-inline" width="30" height="30"></b-icon-gear-wide-connected>Admins</h3>
            </div>
            <div class="col-md-2 col-sm-12 my-auto">
              <h1 class="shadow text-color text-center fw-bold" v-if="data.admin">{{ data.admin }}</h1>
              <h1 class="shadow text-color text-center fw-bold" v-else>0</h1>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 co-sm-12 mx-auto p-4">
          <div class="row p-4 shadow bg-one rounded col-hover">
            <div class="col-md-10 col-sm-12 my-auto">
                <h3 class="color-white fw-bold my-auto"><b-icon-gear-wide-connected class="text-success mr-3 d-inline" width="30" height="30"></b-icon-gear-wide-connected>Editors</h3>
            </div>
            <div class="col-md-2 col-sm-12 my-auto">
              <h1 class="shadow text-color text-center fw-bold" v-if="data.editor">{{ data.editor }}</h1>
              <h1 class="shadow text-color text-center fw-bold" v-else>0</h1>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 co-sm-12 mx-auto p-4">
          <div class="row p-4 shadow bg-two rounded col-hover">
            <div class="col-md-10 col-sm-12 my-auto">
                <h3 class="color-white fw-bold my-auto"><b-icon-people class="text-warning mr-3 d-inline" width="30" height="30"></b-icon-people>Customers</h3>
            </div>
            <div class="col-md-2 col-sm-12 my-auto">
              <h1 class="shadow text-color text-center fw-bold" v-if="data.client">{{ data.client }}</h1>
              <h1 class="shadow text-color text-center fw-bold" v-else>0</h1>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 co-sm-12 mx-auto p-4">
          <div class="row p-4 shadow bg-six rounded col-hover">
            <div class="col-md-10 col-sm-12 my-auto">
                <h3 class="color-white fw-bold my-auto"><b-icon-people class="text-warning mr-3 d-inline" width="30" height="30"></b-icon-people>Subscribers</h3>
            </div>
            <div class="col-md-2 col-sm-12 my-auto">
              <h1 class="shadow text-color text-center fw-bold" v-if="data.subscriberList">{{ data.subscriberList }}</h1>
              <h1 class="shadow text-color text-center fw-bold" v-else> 0 </h1>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-12 co-sm-12 mx-auto p-4">
          <div class="row p-4 shadow bg-three rounded text-center col-hover">
            <b-icon-hospital class="text-success" width="25" height="25"></b-icon-hospital>
            <h5 class="color-white fw-bold my-auto py-2">Total Hotels</h5>
            <h1 class="shadow text-info text-center fw-bold" v-if="data.hotel">{{ data.hotel }}</h1>
            <h1 class="shadow text-info text-center fw-bold" v-else>0</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-12 co-sm-12 mx-auto p-4">
          <div class="row p-4 shadow bg-three rounded text-center col-hover">
            <b-icon-basket class="text-success" width="25" height="25"></b-icon-basket>
            <h5 class="color-white fw-bold my-auto py-2">Total Hotel Booking</h5>
            <h1 class="shadow text-info text-center fw-bold" v-if="data.hotelOrder">{{ data.hotelOrder }}</h1>
            <h1 class="shadow text-info text-center fw-bold" v-else>0</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-12 co-sm-12 mx-auto p-4">
          <div class="row p-4 shadow bg-four rounded text-center col-hover">
            <b-icon-truck class="text-warning" width="25" height="25"></b-icon-truck>
            <h5 class="color-white fw-bold my-auto py-2">Total Cars</h5>
            <h1 class="shadow text-primary text-center fw-bold" v-if="data.car">{{ data.car }}</h1>
            <h1 class="shadow text-primary text-center fw-bold" v-else>0</h1>
          </div>
        </div>
        <div class="col-lg-3 col-md-12 co-sm-12 mx-auto p-4">
          <div class="row p-4 shadow bg-four rounded text-center col-hover">
            <b-icon-basket class="text-warning" width="25" height="25"></b-icon-basket>
            <h5 class="color-white fw-bold my-auto py-2">Total Car Booking</h5>
            <h1 class="shadow text-primary text-center fw-bold" v-if="data.carOrder">{{ data.carOrder }}</h1>
            <h1 class="shadow text-primary text-center fw-bold" v-else>0</h1>
          </div>
        </div>

      </div>
      
      <div class="row">

        <div class="col-lg-7 col-md-12 mx-auto text-center">
          <div class="p-4 m-2 shadow bg-header rounded col-hover">
            <div class="d-flex justify-content-between p-3 bg-header rounded shadow">
                <h4 class="color-white fw-bold my-auto"><b-icon-newspaper class="text-success mr-2 d-inline" width="30" height="30"></b-icon-newspaper>Total Blog Post</h4>
                <h1 class="shadow color-main fw-bold" v-if="data.blog">{{ data.blog }}</h1>
                <h1 class="shadow color-main fw-bold" v-else>0</h1>
            </div>

            <div class="p-3 mt-3 rounded table-border-dark bg-header">

              <a href="/all-admin" class="btn btn-cus fw-bold m-2" v-if="this.$store.state.user.userType == 'admin'"><b-icon-plus class="text-success mr-2 d-inline" width="15" height="15"></b-icon-plus>Add Admin</a>
              <a href="/add-editor" class="btn btn-cus fw-bold m-2"><b-icon-plus class="text-success mr-2 d-inline" width="15" height="15"></b-icon-plus>Add Editor</a>
              <a href="/add-hotel" class="btn btn-cus fw-bold m-2"><b-icon-plus class="text-success mr-2 d-inline" width="15" height="15"></b-icon-plus>Add Hotel</a>
              <a href="/cars" class="btn btn-cus fw-bold m-2"><b-icon-plus class="text-success mr-2 d-inline" width="15" height="15"></b-icon-plus>Add Car Type</a>
              <a href="/driver" class="btn btn-cus fw-bold m-2"><b-icon-plus class="text-success mr-2 d-inline" width="15" height="15"></b-icon-plus>Add Car Driver</a>
              <a href="/destination" class="btn btn-cus fw-bold m-2"><b-icon-plus class="text-success mr-2 d-inline" width="15" height="15"></b-icon-plus>Add car Destination</a>
              <a href="/add-blog" class="btn btn-cus fw-bold m-2"><b-icon-plus class="text-success mr-2 d-inline" width="15" height="15"></b-icon-plus>Add post</a>
              <a href="/add-blog-category" class="btn btn-cus fw-bold m-2"><b-icon-plus class="text-success mr-2 d-inline" width="15" height="15"></b-icon-plus>Add Post Category</a>

            </div>
          </div>

        </div>

        <div class="col-lg-5 col-md-12 mx-auto text-center">
          <div class="p-4 m-2 shadow bg-header rounded col-hover"> 
            <div class="d-flex justify-content-between p-3 bg-header rounded shadow">
                <h5 class="color-white fw-bold my-auto"><b-icon-code-square class="text-success mr-2 d-inline" width="25" height="25"></b-icon-code-square>Admin Type</h5>
                <h6 class="color-main my-auto">{{ user.role }}</h6>
            </div>

            <div class="p-3 mt-3 bg-header rounded table-border-dark overflow-hidden">
                <div class="d-flex justify-content-between">
                    <p class="color-white fw-bold">Name:</p>
                    <p class="color-main my-auto">{{user.name}}</p>
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

  </div>
</template>

<script>


export default {
  data(){
    return{
      user: this.$store.state.user,
      data: {
        admin :'',
        editor :'',
        client :'',
        subscriberList :'',
        hotel :'', 
        hotelOrder :'',
        car:'',
        carOrder :'',
        blog :''
      }
    }
  },

  methods:{
    logout(){
      axios.post('/app/admin_logout').then((res) => {
        this.$router.push({ name: "LoginUser"});
      })
    },

    async getDashboard(){
      const res = await this.callApi("get", "app/dashboard");
      if(res.status === 200){
          this.data.admin = res.data.admin;
          this.data.editor = res.data.editor;
          this.data.client = res.data.user;
          this.data.subscriberList = res.data.subscriberList;
          this.data.hotel = res.data.hotel;
          this.data.hotelOrder = res.data.hotelOrder;
          this.data.car = res.data.car;
          this.data.carOrder = res.data.carOrder;
          this.data.blog = res.data.blog;
      }else {
        this.errorMsg(); 
      }
    }

  },

  mounted(){
    this.getDashboard();
  }
}
</script>

<style scoped>
.btn-cus{
  background: #000000;
  color: #fff;
  transition: .5s;
}

.btn-cus:hover{
  background: #303030;
  color: #fff;
  transform: scale(1.02);
  box-shadow: 0 0 10px #d3ff10 !important;
}

.m-70 {
  margin-top: 100px;
  margin-bottom: 20px;
}

h3{
  font-size: 20px;
  white-space: nowrap;
}
h5{
  margin: 0;
  padding: 0;
  font-size: 15px;
  white-space: nowrap;
}
</style>