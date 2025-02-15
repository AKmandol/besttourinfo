<template>
  <div  v-if="editModal" class="modal fade h-80vh m-70 w-100" data-bs-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5 text-dark fw-bolder text-center w-100" id="exampleModalLabel">Edit Your Information</h1>
        <span type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
      </div>

      <div class="modal-body bg-white m-0 p-0">
        
        <div class="row bg-white m-0 px-0 py-3">

          <div class="col-md-12 bg-white p-4 mx-auto">
            
            <h5 class="text-dark"><b-icon-pencil class="d-inline mr-2 text-primary" width="22" height="22"></b-icon-pencil>Basic info</h5>
            <hr class="mb-3 mt-1 opacity-50">
            <div class="row">
              <div class="col">
                <label class="mb-1 text-dark">Full Name </label>
                <input type="text" v-model="data.name" name="name" class="form-control" placeholder="Enter your full name" aria-label="First name" :class="hasError('name') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('name')">{{getError('name')}}</div>
              </div>
            </div>
            <div class="row pt-4">
              <div class="col">
                <label class="mb-1 text-dark">Date of Birth </label>
                <input type="date" v-model="data.date_of_birth" name="date_of_birth" class="form-control" placeholder="" aria-label="First name" :class="hasError('date_of_birth') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('date_of_birth')">{{getError('date_of_birth')}}</div>
              </div>
              <div class="col">
                <label class="mb-1 text-dark">National ID </label>
                <input type="number" v-model="data.nid" name="nid" class="form-control" placeholder="" aria-label="Last name" :class="hasError('nid') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('nid')">{{getError('nid')}}</div>
              </div>
            </div>
            <div class="row pt-4">
              <div class="col">
                <label class="mb-1 text-dark">Gender </label>
                <select v-model="data.gender" class="form-select" id="sel1" name="gender" :class="hasError('gender') ? 'is-invalid' : '' ">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option> 
                  <option value="Other">Other</option> 
                </select>
                <div class="invalid-feedback" v-if="hasError('gender')">{{getError('gender')}}</div>
              </div>
              <div class="col">
                <label class="mb-1 text-dark">Marital Status </label>
                <select v-model="data.marital_status" class="form-select" id="sel2" name="marital_status" :class="hasError('marital_status') ? 'is-invalid' : '' ">
                  <option value="Single">Single</option>
                  <option value="Married">Married</option>
                </select>
                <div class="invalid-feedback" v-if="hasError('marital_status')">{{getError('marital_status')}}</div>
              </div>
            </div>
            <h5 class="text-dark mt-5"><b-icon-pin-map class="d-inline mr-2 text-primary" width="22" height="22"></b-icon-pin-map>Address</h5>
            <hr class="mb-3 mt-1 opacity-50">
            <h6 class="text-dark mt-4 pt-2 fw-bold">Present Address:</h6>
            <div class="row pt-3">
              <div class="col">
                <label class="mb-1 text-dark">House Number</label>
                <input type="text" v-model="data.house_number" name="house_number" class="form-control" placeholder="" aria-label="First name" :class="hasError('house_number') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('house_number')">{{getError('house_number')}}</div>
              </div>
              <div class="col">
                <label class="mb-1 text-dark">Street Name </label>
                <input type="text" v-model="data.street_name" name="street_name" class="form-control" placeholder="" aria-label="Last name" :class="hasError('street_name') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('street_name')">{{getError('street_name')}}</div>
              </div>
            </div>
            <div class="row pt-4">
              <div class="col">
                <label class="mb-1 text-dark">Postal Code </label>
                <input type="number" v-model="data.postal_code" name="postal_code" class="form-control" placeholder="" aria-label="First name" :class="hasError('postal_code') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('postal_code')">{{getError('postal_code')}}</div>
              </div>
              <div class="col">
                <label class="mb-1 text-dark">City </label>
                <input type="text" v-model="data.city" name="city" class="form-control" placeholder="" aria-label="Last name" :class="hasError('city') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('city')">{{getError('city')}}</div>
              </div>
            </div>

            <h6 class="text-dark mt-4 pt-2 fw-bold">Permanent Address: <span class="btn btn-sm ml-2 d-inline">(Skip if both address are same) </span></h6>
            <div class="row pt-3">
              <div class="col">
                <label class="mb-1 text-dark">House Number </label>
                <input type="text" v-model="data.permanent_house_number" name="permanent_house_number" class="form-control" placeholder="" aria-label="First name" :class="hasError('permanent_house_number') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('permanent_house_number')">{{getError('permanent_house_number')}}</div>
              </div>
              <div class="col">
                <label class="mb-1 text-dark">Street Name </label>
                <input type="text" v-model="data.permanent_street_name" name="permanent_street_name" class="form-control" placeholder="" aria-label="Last name" :class="hasError('permanent_street_name') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('permanent_street_name')">{{getError('permanent_street_name')}}</div>
              </div>
            </div>
            <div class="row pt-4">
              <div class="col">
                <label class="mb-1 text-dark">Postal Code </label>
                <input type="number" v-model="data.permanent_postal_code" name="permanent_postal_code" class="form-control" placeholder="" aria-label="First name" :class="hasError('permanent_postal_code') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('permanent_postal_code')">{{getError('permanent_postal_code')}}</div>
              </div>
              <div class="col">
                <label class="mb-1 text-dark">City </label>
                <input type="text" v-model="data.permanent_city" name="permanent_city" class="form-control" placeholder="" aria-label="Last name" :class="hasError('permanent_city') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('permanent_city')">{{getError('permanent_city')}}</div>
              </div>
            </div>
            <h5 class="text-dark mt-5"><b-icon-postcard class="d-inline mr-2 text-primary" width="25" height="25"></b-icon-postcard>Passport Information <span class="btn btn-sm ml-2 d-inline">(Skip if you don't have Passport) </span></h5>
            <hr class="mb-3 mt-1 opacity-50">
            <div class="row pt-3">
              <div class="col">
                <label class="mb-1 text-dark">Passport Number </label>
                <input type="text" v-model="data.passport_no" name="passport_no" class="form-control" placeholder="" aria-label="First name" :class="hasError('passport_no') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('passport_no')">{{getError('passport_no')}}</div>
              </div>
              <div class="col">
                <label class="mb-1 text-dark">Passport Expiry Date </label>
                <input type="date" v-model="data.passport_expiry_date" name="passport_expiry_date" class="form-control" placeholder="" aria-label="Last name" :class="hasError('passport_expiry_date') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('passport_expiry_date')">{{getError('passport_expiry_date')}}</div>
              </div>
            </div>
            <h5 class="text-dark mt-5"><b-icon-telephone-outbound class="d-inline mr-2 text-primary" width="22" height="22"></b-icon-telephone-outbound>Contact</h5>
            <hr class="mb-3 mt-1 opacity-50">
            <div class="row pt-3">
              <div class="d-inline col-12">
                <label class="text-dark mb-1">Phone Number</label>
                <input type="tel" v-model="data.mobile" class="form-control" placeholder="" :class="hasError('mobile') ? 'is-invalid' : '' ">
                <div class="invalid-feedback" v-if="hasError('mobile')">{{getError('mobile')}}</div>
              </div>
            </div>  
              <h5 class="text-dark mt-5"><b-icon-info-circle class="d-inline mr-2 text-primary" width="22" height="22"></b-icon-info-circle>Other</h5>
              <hr class="mb-3 mt-1 opacity-50">
            <div class="row pt-3">
              <div class="col">
                <label class="mb-1 text-dark">Religion </label>
                <select v-model="data.religion" class="form-select" id="sel1" name="religion" :class="hasError('religion') ? 'is-invalid' : '' ">
                  <option value="Islam">Islam</option>  
                  <option value="Hindu">Hindu</option>  
                  <option value="Christianity">Christianity</option>  
                  <option value="Buddhism">Buddhism</option>  
                  <option value="Others">Others</option>  
                </select>
                <div class="invalid-feedback" v-if="hasError('religion')">{{getError('religion')}}</div>
              </div>
              <div class="col">
                <label class="mb-1 text-dark">Language </label>
                <select v-model="data.language" class="form-select" id="sel1" name="sellist1" :class="hasError('language') ? 'is-invalid' : '' ">
                  <option  value="English">English</option>
                  <option  value="Bangla">Bangla</option>
                </select>
                <div class="invalid-feedback" v-if="hasError('language')">{{getError('language')}}</div>
              </div>
            </div>  
          </div>

        </div>
        
      </div>

      <div class="justify-content-between m-0 p-0 border-0">
        <button type="button" class="btn btn-secondary col-4 mx-0 px-0 rounded-0 py-3" data-bs-dismiss="modal">Close</button>
        <button type="button" @click.prevent="resetData" class="btn btn-success col-4 mx-0 px-0 rounded-0 py-3">Reset</button>
        <button type="submit" @click.prevent="updateUser" class="btn btn-primary col-4 mx-0 px-0 rounded-0 py-3">Save</button>
      </div>


    </div>
  </div>
</div>
 
</template>

<script>
export default {

  data(){
    return{
      user: this.$store.state.client,
      data:{
        name: this.$store.state.client.name,
        date_of_birth: this.$store.state.client.date_of_birth,
        nid:this.$store.state.client.nid,
        gender: this.$store.state.client.gender,
        marital_status: this.$store.state.client.marital_status,
        house_number: this.$store.state.client.house_number,
        street_name: this.$store.state.client.street_name,
        postal_code: this.$store.state.client.postal_code,
        city: this.$store.state.client.city,
        permanent_house_number: this.$store.state.client.permanent_house_number,
        permanent_street_name: this.$store.state.client.permanent_street_name,
        permanent_postal_code: this.$store.state.client.permanent_postal_code,
        permanent_city: this.$store.state.client.permanent_city,
        passport_no: this.$store.state.client.passport_no,
        passport_expiry_date: this.$store.state.client.passport_expiry_date,
        mobile: this.$store.state.client.mobile,
        religion: this.$store.state.client.religion,
        language: this.$store.state.client.language,
      },
      errors:{},
      success: false,
      error: false,
      editModal: true,

    }
  },

  methods:{
   
      async updateUser(){
         const res = await this.callApi("post","app/updateUser",this.data);
          if (res.status == 200) {
              this.successMsg("Your Details Has Been Updated");
              this.editModal = false; 
              this.$router.go();
              // this.pageInfo = res.data;
          }else {
              if(res.status === 401){
                  this.errorMsg(res.data.msg);
              }else if (res.status === 422) {
                  for(let i in res.data.errors){
                  // this.errorMsg(res.data.errors[i][0])
                  this.errors = res.data.errors
                  }
              }
              else {
                  this.errorMsg();
              }
          }
          
      },

      resetData(){
            this.clearAllError();
           for (let field in this.data){
            this.data[field] = '';
           }
        },



    } 

}
</script>

<style scoped>
.w-80px{
  width: 70%;
}
.w-20px{
  width: 30%;
}
.h-80vh{
   max-height: 80vh;
}

.m-70{
  margin-top: 70px;
}
</style>