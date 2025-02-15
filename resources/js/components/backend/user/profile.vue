<template>
  <div class="bg-cus p-0">
    <div class="m-71 p-0">
      <div class="container p-0">
        <div class="row p-0 my-4">

            <div class="col-lg-4 col-md-5 col-sm-12 h-100 bg-white p-2 my-2 rounded">
              <table class="table table-hover p-2 border-0" style="border-style:none;">
                <thead>
                  <tr class="d-flex d-flex justify-content-between p-2 border-0">
                    
                    <div class="d-flex justify-content-start border-0">
                      <img :src="user.image" class="text-dark border p-1 rounded-circle text-dark" width="100" height="100" />
                      <!-- <b-icon-person class="text-dark border p-3 rounded-circle text-dark bg-seconary" width="100" height="100"></b-icon-person> -->
                    </div>
                    
                    <div class="d-flex justify-content-end aling-items-start d-inline border-0" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                      <b-icon-pencil-square class="text-primary float-start my-auto mr-3" width="20" height="20"></b-icon-pencil-square>
                      <a class="float-end text-dark my-auto ml-2">Profile Image</a>
                    </div>
                    
                  </tr>
                </thead>
                <tbody class="border-left">
                  <tr>
                    <td class="col fw-bolder"><a class="text-dark"> <b-icon-person-check class="text-primary d-inline mr-2" width="15" height="15"></b-icon-person-check>{{user.name}}</a></td>
                  </tr>
                  <tr>
                    <td class="col"><a class="text-dark" data-bs-toggle="modal" data-bs-target="#orderModal"> <b-icon-cart class="text-primary d-inline mr-2" width="15" height="15"></b-icon-cart>Hotel Booking</a></td>
                  </tr>
                  <tr>
                    <td class="col"><a class="text-dark" data-bs-toggle="modal" data-bs-target="#carOderModal"> <b-icon-truck class="text-primary d-inline mr-2" width="15" height="15"></b-icon-truck>Car Booking</a></td>
                  </tr>
                  <tr>
                    <td class="col"><a class="text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal2"> <b-icon-gear class="text-primary d-inline mr-2" width="15" height="15"></b-icon-gear>Change Password</a></td>
                  </tr>
                  <tr>
                    <td class="col"><a class="text-dark" data-bs-toggle="modal" data-bs-target="#logoutModal2"> <b-icon-box-arrow-left class="text-danger d-inline mr-2" width="15" height="15"></b-icon-box-arrow-left>Logout</a></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="co-lg-8 col-md-6 col-sm-12 h-100 bg-white p-2 my-2 rounded mx-auto">

             <div class="d-flex d-flex justify-content-between p-3 border-0">

                <div class="d-flex justify-content-start border-0">
                  <b-icon-person-lines-fill class="text-primary float-start my-auto mr-3" width="30" height="30"></b-icon-person-lines-fill>
                  <h2 class="float-end text-dark fw-bold my-auto ml-2" >Profile</h2>
                </div>
                
                <div class="d-flex justify-content-end aling-items-start d-inline border-0"  type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <b-icon-pencil-square class="text-primary float-start my-auto mr-3" width="20" height="20"></b-icon-pencil-square>
                  <a class="float-end text-dark my-auto ml-2" >Edit Details</a>
                </div>

             </div>
              <p class="ml-2 mb-4 text-muted text-sm">Basic info, for a faster booking experience</p>

              <table class="table table-striped rounded">

                <tbody class="border-left">
                  <tr>
                    <td class="w-50">Name</td>
                    <td class="w-50">{{user.name}}.</td>  
                  </tr>
                  <tr>
                    <td>Gender</td>
                    <td>{{user.gender}}.</td> 
                  </tr>
                  <tr>
                    <td>Present Address</td>
                    <td>{{user.house_number}}, {{user.street_name}}, {{user.city}}, {{user.postal_code}}.</td> 
                  </tr>
                  <tr>
                    <td>Parmanent Address</td>
                    <td>{{user.permanent_house_number}}, {{user.permanent_street_name}}, {{user.permanent_city}}, {{user.permanent_postal_code}}.</td>
                  </tr>
                  <tr>
                    <td>Marital Status</td>
                    <td>{{user.marital_status}}.</td> 
                  </tr>
                  <tr>
                    <td>Date of Birth</td>
                    <td>{{user.date_of_birth}}.</td> 
                  </tr>
                  <tr>
                    <td>Passport Number</td>
                    <td>{{user.passport_no}}.</td> 
                  </tr>
                  <tr>
                    <td>Passport Expiry Date</td>
                    <td>{{user.passport_expiry_date}}.</td> 
                  </tr>
                  <tr>
                    <td>National ID</td>
                    <td>{{user.nid}}.</td> 
                  </tr>
                  <tr>
                    <td>Contact Number</td>
                    <td>{{user.mobile}}</td> 
                  </tr>
                  <tr>
                    <td>Religion</td>
                    <td>{{user.religion}}.</td> 
                  </tr>
                  <tr>
                    <td>language Preference</td>
                    <td>{{user.language}}.</td> 
                  </tr>
                </tbody>
              </table>

            </div>    

        </div>
      </div>
    </div>


<!-- Logout Modal-->
<div class="modal fade mt-100" id="logoutModal2" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title fw-blod text-dark fs-5">Ready to Leave?</h4>
                <button class="close bg-white" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-danger bg-white fs-4">×</span>
                </button>
            </div>
            <div class="modal-body text-dark py-4 text-center">Select "Logout" below if you are ready to end your current session.</div>
            <div class="m-0 p-0 flex-row">
                <button class="w-50 btn btn-sm btn-secondary py-2 mt-1 rounded-0" type="button" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <a class="text-white w-50 btn btn-sm btn-danger py-2 mt-1 rounded-0" href="/app/user_logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Edit Your Information Modal -->
<EditModal></EditModal>
<SettingModal></SettingModal>
<ImageModal></ImageModal>
<BookingModal></BookingModal>
<CarBookingModal></CarBookingModal>




  </div>
</template>

<script>

import BookingModal from "./order.vue"
import CarBookingModal from "./car-order.vue"
import EditModal from "./edit-modal.vue"
import SettingModal from "./setting-model.vue"
import ImageModal from "./image-model.vue"

export default {

  components: {
    EditModal,
    SettingModal,
    ImageModal,
    BookingModal,
    CarBookingModal
  },

  data(){
    return{
      user: this.$store.state.client,
      vatTax:[],
    }
  },

  methods:{
    
      logout(){
            axios.post('app/user_logout').then((res) => {
              this.$router.go();
              this.successMsg('You are logout successfully');
          })
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
   },

    mounted(){
      this.getVat();
    }



}
</script>

<style scoped>
.bg-cus{
  background: #dadada;
  padding: 20px 0;
}

.m-71 {
  margin-top: 90px;
  width: 80%;
  margin-left: auto;
  margin-right: auto;
}
.h-80vh{
  height: 75vh;
}
.border-left td{
  border-left: 0 !important;
}
</style>