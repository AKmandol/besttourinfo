<template>
    <div>

        <div class="accordion-item mt-4 border-0 p-3 container-main">
            
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
              <div class="accordion-body px-0 px-md-2">

                <div class="row g-1">

                  <div class="mx-auto my-3 row">

                    <div class="col-lg-3 col-md-12 col-sm-12 py-2">
                      <div class="form-check form-check-inline p-0">
                        <label class="form-check-label fw-bolder text-success h6">What Are You Looking For:</label>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 py-2">
                      <div class="form-check form-check-inline" @click="carNull()">
                        <input class="form-check-input" name="car" type="radio" id="inlineRadio50" value="0" v-model="this.car" checked>
                        <label class="form-check-label ml-1 mr-2 text-dark1 fw-bold" for="inlineRadio50">Any Type of Car</label>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 py-2">
                      <div class="form-check form-check-inline" @click="filteredProducts">
                        <input class="form-check-input" name="car" type="radio" id="inlineRadio51" value="1"  v-model="this.car">
                        <label class="form-check-label ml-1 mr-2 text-dark1 fw-bold" for="inlineRadio51">Specifics Type of Car</label>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 py-2"  v-if="this.car == 1">
                      <select class="form-select form-select-sm" aria-label="Default select example" v-model="data.car_type" @change="filteredProducts">
                        <option value="0" disabled selected>Select a Car Type</option>
                        <option v-for="(car,i) in carTypes" :key="i" :value="car.car_type">{{ car.car_type }}</option>
                      </select>
                    </div>


                  </div>

                  <div class="col-md-12 col-lg-6 mx-auto my-auto d-flex">
                   

                    <div class="form-floating col" v-if="this.filter_destinations != ''">
                      <input class="form-control border-2" list="destinations" type="text" v-model="data.destination" :class="hasError('destination') ? 'is-invalid' : ''">
                      <datalist id="destinations">
                        
                        <option :value="location.extra_one" v-for="(location,i) in filter_destinations" :key="i">
                          Pick up: {{ location.pick_up_location }} Drop-Off: {{ location.drop_off_location }} ---at {{ location.car_type }} ---cost: {{ location.cost }}tk
                        </option>

                      </datalist>
                      <label for="floatingSelect"> 
                        <span class="text-success h6"><b-icon-geo-alt-fill class="d-inline text-dark mr-2" width="15" height="15"></b-icon-geo-alt-fill> Select Pick-Up and Drop-Off Location <span class="text-primary fw-bold ml-2" v-if="text">[--Car Available--]</span> </span> 
                      </label>
                      <div class="invalid-feedback" v-if="hasError('destination')">{{getError('destination')}}</div>
                    </div>

                    <div class="form-floating col" v-else>
                      <input class="form-control border-2" list="destinations" type="text" v-model="data.destination" :class="hasError('destination') ? 'is-invalid' : ''">
                      <datalist id="destinations">
                        
                        <option :value="location.extra_one" v-for="(location,i) in destinations" :key="i">
                          Pick up: {{ location.pick_up_location }} Drop-Off: {{ location.drop_off_location }} ---at {{ location.car_type }} ---cost: {{ location.cost }}tk
                        </option>

                      </datalist>
                      <label for="floatingSelect"> 
                        <span class="text-success h6"><b-icon-geo-alt-fill class="d-inline text-dark mr-2" width="15" height="15"></b-icon-geo-alt-fill> Select Pick-Up and  Drop-Off Location</span> 
                      </label>
                      <div class="invalid-feedback" v-if="hasError('destination')">{{getError('destination')}}</div>
                    </div>

                    <b-icon-arrow-left-right class="text-center text-success col-1 my-auto d-none d-lg-block" width="15" height="15"></b-icon-arrow-left-right>
                    
                  </div>
                  

                  <div class="col-md-12 col-lg-6 mt-2 mt-md-0 mx-auto my-auto d-flex position-relative justify-content-between">

                    <b-icon-shuffle class="p-2 text-success border-4 bg-light rounded-circle position-absolute top-50 start-50 translate-middle zindex-100" width="40" height="40"></b-icon-shuffle>

                    <div class="col mr-1 mt-md-2 mt-lg-0 my-auto">

                        <v-date-picker v-model="data.pick_up_date" mode="dateTime">
                        <template v-slot="{ inputValue, inputEvents }">
                            <div class="d-flex justify-content-center aling-items-center">
                            
                            <div class="form-floating col">
                                <input :value="inputValue" v-on="inputEvents" class="form-control textt-small border-2" :class="hasError('pick_up_date') ? 'is-invalid' : ''" />
                                <label class="text-success" for="floatingSelect"> <span class="text-success"><b-icon-calendar-day class="d-inline text-dark mr-2" width="15" height="15"></b-icon-calendar-day></span> <span class="text-success">Pick Up Date Time</span></label>
                                <div class="invalid-feedback" v-if="hasError('pick_up_date')">{{getError('pick_up_date')}}</div>
                            </div>
                            
                            </div>
                        </template>
                        </v-date-picker>     
                        
                    </div>

                    <div class="col ml-1 mt-md-2 mt-lg-0 my-auto">
                        <v-date-picker v-model="data.drop_off_date" mode="dateTime">
                        <template v-slot="{ inputValue, inputEvents }">
                            <div class="d-flex justify-content-center aling-items-center">
                            
                            <div class="form-floating col">
                                <input :value="inputValue" v-on="inputEvents" class="form-control textt-small border-2" :class="hasError('drop_off_date') ? 'is-invalid' : ''" />
                                <label class="text-success" for="floatingSelect"> <span><b-icon-calendar-day class="d-inline text-dark mr-2" width="15" height="15"></b-icon-calendar-day></span> <span class="text-success">Return Date Time</span> <span class="text-danger">(If needed)</span></label>
                                <div class="invalid-feedback" v-if="hasError('drop_off_date')">{{getError('drop_off_date')}}</div>
                            </div>
                            
                            </div>
                        </template>
                        </v-date-picker> 
                        
                    </div>

                  </div>

                  <button @click="search" class="btn btn-dark1 col-lg-2 col-md-4 col-sm-6 py-2 mx-auto position-absolute top-100 start-50 translate-middle opacity-100 mt-4">
                    <b-icon-broadcast v-if="!loading" class="d-inline text-secondary mr-2" width="25" height="25"></b-icon-broadcast>
                    <b-icon-broadcast-pin v-else class="d-inline text-white mr-2" width="25" height="25"></b-icon-broadcast-pin>
                    
                    <span class="d-inline text-white fs-5 ml-2" v-if="!loading">Next</span>
                    <span class="d-inline text-white fs-5 ml-2" v-else>Getting</span>
                   
                  </button>  

                  </div>

              </div>
            </div>

        </div>

        <!-- Login Modal -->
        <Modal class="login-modal"
            v-model="Loginmodal"
            footer-hide
            >
            
            <div class="bg-transparent">

                <div class="card-body bg-transparent p-2 text-center">

                <img src="/img/logo.png" class="py-2 rounded px-4 shadow" height="80" alt="">

                <div class="mb-md-3 mt-md-3">

                    <p class="text-white mb-3">Please enter your login Email and Password!</p>

                    <div class="form-floating mb-4">
                    <input type="email" v-model="data.email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" :class="hasError('password') ? 'is-invalid' : ''">
                    <label for="floatingInput" class="text-dark">Email address</label>
                    <div class="text-danger text-start mt-2" v-if="errors['email']">
                        {{errors['email'][0]}}
                    </div>
                    </div>

                    <div class="input-group mb-3 w-100">
                    <div class="form-floating col">
                        <input v-model="data.password" name="password" :type="showPassword ? 'text' : 'password'" class="form-control" id="floatingPassword" placeholder="Password" :class="hasError('password') ? 'is-invalid' : ''">
                        <label for="floatingPassword" class="text-dark">Password</label>
                    </div>
                    <span @click="showPassword = !showPassword" class="input-group-text bg-white col-2"><b-icon-eye v-if="!showPassword" class="d-inline text-secondary mx-auto" width="15" height="15"></b-icon-eye><b-icon-eye-slash v-if="showPassword" @click="showPassword = !showPassword" class="d-inline text-secondary mx-auto" width="15" height="15"></b-icon-eye-slash></span>
                    
                    <div class="text-danger text-start mt-2 col-12" v-if="errors['password']">
                        {{errors['password'][0]}}
                    </div>
                    </div>

                    <p class="small mb-3 pb-lg-2"><a class="text-light" href="https://besttourinfo.com/user-login" target="_blank">Forgot password? <a class="text-primary">Click here</a> or Contact Our Support Team.</a></p>

                    <button @click.prevent="loginUser" class="btn btn-success col-5" type="submit">Login</button>

                </div>

                </div>

            </div>

        </Modal>

        <!-- Login/Register Modal -->
        <Modal
            v-model="modal"
            footer-hide
            >
            
            <div class="p-3 rounded">

            <div class="text-center p-3 bg-light rounded">
                <h6 class="text-danger fw-bold">You are not Logged In </h6>
                <p class="text-muted text-sm">Please Log in or Register</p>
            </div>

            <div class="row p-3 text-center my-2">
                <a @click="modalToggle" class="col py-3 bg-primary border rounded">
                    <b-icon-box-arrow-right class="d-inline text-white" width="25" height="25"></b-icon-box-arrow-right>
                    <span class="d-inline ml-2 text-white my-auto fw-bold">Login</span>
                </a>
                <div class="text-dark my-2">or</div>
                <router-link to="/register" class="col py-3 bg-dark border rounded">
                    <b-icon-chat-square-text class="d-inline text-white" width="25" height="25"></b-icon-chat-square-text>
                    <span class="d-inline ml-2 text-white my-auto fw-bold">Register</span>
                </router-link>
            </div>

            </div>
        </Modal>

        <!-- Order Modal -->
        <Modal
            v-model="orderModal"
            footer-hide
            width="650"
            >
            
            <div class="rounded pb-3">

              <h5 class="text-center py-3 text-dark1 fw-bold bg-light rounded mb-3 border-bottom-cus"><b-icon-truck class="d-inline text-primary mr-3" width="35" height="35"></b-icon-truck> <span class="ml-2">Your Ride Information</span></h5>

              <div class="row p-3" v-for="(data,i) in final_destinations" :key="i">
                
                <div class="col-md-8 col-sm-12  my-auto p-3 rounded bg-white border-end">

                  <h6 class="text-dark1 fw-bold pb-2">Packeage Name: <span class="text-dark fw-normal ml-2"> {{ data.extra_one }}.</span></h6>
                  <h6 class="text-dark1 fw-bold pb-2">Pick Up Location: <span class="text-dark fw-normal ml-2">{{ data.pick_up_location }}.</span></h6>
                  <h6 class="text-dark1 fw-bold pb-2">Drop Off Location: <span class="text-dark fw-normal ml-2">{{ data.drop_off_location }}.</span></h6>
                  <h6 class="text-dark1 fw-bold pb-2">Car Type: <span class="text-dark fw-normal ml-2">{{ data.car_type }}.</span></h6>
                  <h6 class="text-dark1 fw-bold pb-2" v-if="this.data.drop_off_date">Travel Cost: <span class="text-sm text-secondary">(Include VAT)</span> <span class="text-danger fw-normal ml-2">{{ parseInt(data.cost * 2) +  Math.floor((parseInt(data.cost) / 100) * this.vatTax[0].car_vat) }}</span><small>tk.</small></h6>
                  <h6 class="text-dark1 fw-bold pb-2" v-else>Travel Cost: <span class="text-sm text-secondary">(Include VAT)</span> <span class="text-danger fw-normal ml-2">{{ parseInt(data.cost) +  Math.floor((parseInt(data.cost) / 100) * this.vatTax[0].car_vat) }}</span><small>tk.</small></h6>

                  <div class="mt-2 p-3 border text-start rounded text-dark1" v-if="data.between_location">
                    <span class="fw-bold">Places between:</span>
                    <br>
                    <span class="fw-normal">{{ data.between_location }}</span>
                  </div>

                </div>
            
                <div class="col-md-4 col-sm-12 text-center my-auto">
                  <img :src="data.extra_two" alt="car" class="img-fluid">
                </div>
                
              </div>

              <div class="p-3 rounded bg-light mt-2 bg-dark">
                <p v-if="this.data.pick_up_date" class="text-white fw-bold">Pick up Date:<span class="fw-normal ml-1 text-light mr-2">{{ this.data.pick_up_date.toDateString()}}</span> Time:<span class="fw-normal ml-1 text-light">{{ this.data.pick_up_date.toLocaleTimeString() }}</span></p>
                <p v-if="this.data.drop_off_date" class="text-white fw-bold">Return Date:<span class="fw-normal ml-1 text-light mr-2">{{ this.data.drop_off_date.toDateString()}}</span> Time:<span class="fw-normal ml-1 text-light">{{ this.data.drop_off_date.toLocaleTimeString() }}</span></p>
              </div>

              <div class="p-3">
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="term" v-model="data.terms" value="1" :class="hasError('terms') ? 'is-invalid' : '' ">
                      <label class="form-check-label text-small text-dark ml-2 align-middle" for="term">Please accept our <a target="_blank" href="https://besttourinfo.com/terms-and-condition">Tearms and Conditions</a>, <a target="_blank" href="https://besttourinfo.com/privacy-policy">Privacy Policy</a> and <a target="_blank" href="https://besttourinfo.com/refund-policies">Return Refund Policy</a> </label>
                      <div class="invalid-feedback" v-if="hasError('terms')">{{getError('terms')}}</div>
                  </div>
              </div>

              <div class="text-center mt-2" v-if="this.transction_id == '' " >
                <a @click="confirmBooking" class="btn btn-dark1 text-warning px-4 fw-bold shadow"><b-icon-caret-right-square class="d-inline text-danger mr-2" width="17" height="17"></b-icon-caret-right-square>Check Now</a>
              </div>

              <div class="text-center mt-2">
                <a v-show="this.transction_id" class="btn btn-outline-warning px-4 fw-bold shadow" @click="sslHotelOrder" id="sslczPayBtn"
                    postdata=" "
                    order=" "
                    endpoint="/pay-via-ajax-ssl"><span class="d-inline text-danger mr-2" width="17" height="17">৳</span>Make Payment
                </a>              
              </div>

            </div>
        </Modal>

        <!-- Confirm Order Modal -->
        <Modal
            v-model="confirmModal"
            footer-hide
            >
            
            <div class="p-3 rounded">

            <div class="text-center p-3 bg-light rounded">
                <h6 class="text-success fw-bold">Your Booking Has been Recived </h6>
                <p class="text-dark text-sm">Let us check with driver availability </p>
            </div>

            <div class="row p-3 text-center my-2">
                <div class="col-md-6 my-auto">
                <a href="/profile" class="py-2 px-2 bg-primary border rounded">
                    <b-icon-box-arrow-right class="d-inline text-white" width="15" height="15"></b-icon-box-arrow-right>
                    <span class="d-inline ml-2 text-white my-auto fw-bold">Booking Details</span>
                </a>
                </div>
                <div class="col-md-6 my-auto">
                <div class="p-2 border rounded text-center">
                    <small class="text-dark">We will contact you through email or phone number.</small>
                    <p class="text-sm text-success">We Will Let You Know Shortly.</p>
                </div>
                </div>
            </div>

            </div>
        </Modal>

        <div v-if="isLoading" class="preloader">
            <div class="spinner"></div>
        </div>
  
  
    </div>
</template>
  
<script>
import $ from 'jquery';
export default {
    data () {
        return {
          payRadio: 1,
          vatTax: '',
          errors: {},
          isLoading: false,
          orderModal: false,
          confirmModal: false,
          modal: false,
          Loginmodal: false,
          showPassword: false,
          user: this.$store.state.client,
          loading: false,
          text: true,
          car: false,
          carTypes: [],
          destinations: [],
          filter_destinations: [],
          final_destinations: [],
          transction_id: '',
          total: '',
          cost: '',
          data:{
            terms:'',
            car_type: 'CNG',
            destination: '',
            destination_id: '',
            pick_up_date: new Date(),
            drop_off_date: null,
          },
          loginData:{
                email:'',
                password:'',
            },

         
        }
    },
    methods: {

      async sslHotelOrder(){
        var obj = {};
        obj.amount = this.total;
        obj.cartItem = this.final_destinations;
        obj.transction_id =  this.transction_id;
        obj.shipping_method =  "NO";
        obj.product_name =  "Car_Rent";
        obj.product_category =  "Travel";
        obj.product_profile =  "Virtual";
        $('#sslczPayBtn').prop('postdata', obj);
        this.orderModal = false;
      },

      modalToggle(){
        this.modal= false,
        this.Loginmodal = true;
      },

      async loginUser(){
        try {
              this.loading = true;
              // Make the API call
              const res = await this.callApi("post", "/user-login", this.data);

              // Handle successful login
              if (res.status === 200 || res.status === 302) {
                  this.successMsg(res.data.msg);
                  this.$router.go();
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

      },

      carNull(){
        this.data.car_type = '';
        this.filter_destinations = '';
        this.loading = false;
        this.getdestination();
      },

      async search() {
        //console.log(this.data)
        this.transction_id = '';
        if(!this.user){
            this.modal = true;
          }else{
            this.loading = true;
            const res = await this.callApi("post","home/order/car", this.data);
                if(res.status === 200){
                  this.errors = {};
                  this.orderModal = true
                  this.filterCost();
                  this.loading = false;
                    
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    this.errors = res.data.errors
                    }
                    this.loading = false;
                }
                else {
                    this.errorMsg('Something went wrong! Please try again');
                }
          }
      
      },

      async confirmEmail(){
          const res = await this.callApi("post","order/car/adminMail", {trans:this.transction_id, pick_up:this.data.pick_up_date, drop_off:this.data.drop_off_date, booking: this.final_destinations});
          if (res.status == 200) {
          //this.hotelList = res.data;
          //console.log(this.hotelList)
          } else {
          this.errorMsg();
          }
      },

      async confirmEmailClient(){
          const res = await this.callApi("post","order/car/clientMail", {trans:this.transction_id ,clientEmail: this.user.email, pick_up:this.data.pick_up_date, drop_off:this.data.drop_off_date, booking: this.final_destinations});
          if (res.status == 200) {
          //this.hotelList = res.data;
          //console.log(this.hotelList)
          } else {
          this.errorMsg();
          }
      },

      async confirmBooking(){
        this.isLoading = true;
        const pick = this.data.pick_up_date.toDateString()+' , '+this.data.pick_up_date.toLocaleTimeString();
        if(this.data.drop_off_date){
          this.data.drop_off_date = this.data.drop_off_date.toDateString()+' , '+this.data.drop_off_date.toLocaleTimeString();
        }else{
          this.data.drop_off_date = '';
        }
        
        const res = await this.callApi("post","home/car/orderConfirm", {pick_up:pick, drop_off:this.data.drop_off_date, booking: this.final_destinations, terms:this.data.terms});
          if(res.status === 200){
              setTimeout(() => {
                this.isLoading = false;
              }, 1000); 
              //console.log(res.data);
              this.transction_id = res.data.trasnstion_id;
              this.total = res.data.total;
              this.errors = {};
              setTimeout(() => {
                this.confirmEmailClient();
                this.confirmEmail();
              }, 1000); 
               
          }else if (res.status === 422) {
              for(let i in res.data.errors){
              this.errors = res.data.errors
              }
              this.loading2 = false;
              this.isLoading = false;
          }
          else {
            this.errorMsg('Something went wrong! Please try again');
          }
      },

      async getCar(){
          const res = await this.callApi("get", "/car/get_all");
          if (res.status == 200) {
              this.carTypes = res.data;
              //console.log(this.carTypes)
          } else {
              this.errorMsg();
          }
      },

      async getVat() {
        const res = await this.callApi("get", "vat/get");
        if (res.status == 200) {
            this.vatTax = res.data;
            //console.log(this.vatTax)
        } else {
            this.errorMsg();
        }
      },

      async getdestination(){
          const res = await this.callApi("get", "/destination/get_all");
          if (res.status == 200) {
              this.destinations = res.data;
              //console.log(this.destinations)
          } else {
              this.errorMsg();
          }
      },

      filteredProducts() {
        if(this.data.car_type){
          this.data.destination = '';
          const data = this.destinations.filter(destination => destination.car_type === this.data.car_type);
          return this.filter_destinations = data;
        }
      },

      filterCost() {
        if(this.data.destination){
          const data = this.destinations.filter(destination => destination.extra_one === this.data.destination);
          return this.final_destinations = data;
        }
      },  
      
    },

    watch: {
      
    },

    created(){
      this.getVat();
      this.getCar();
      this.getdestination();
    }
}

</script>

<style>

.input-group-text {
  border-left: 0 !important;
  
}

#floatingPassword{
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

.border-bottom-cus{
  border-bottom: 2px solid green;
}

</style>