<template>
    <div>

        <div v-if="isLoading" class="preloader">
            <div class="spinner"></div>
        </div>

        <div class="container-fluid p-0">
            
            <div class="pb-4 pt-1 shadow">
                <iframe class="m-0 p-0 border-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d473352.62217123056!2d91.98677707943028!3d22.047018614001473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ad87c0002f69cd%3A0xbfb6392c4dba1529!2sMember%20Para!5e0!3m2!1sen!2sbd!4v1680704358161!5m2!1sen!2sbd" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        
            <div class="container py-4 contact-child shadow-sm container-main">

                <div class="row">

                    <div class="col-lg-8 col-md-12 mx-auto py-4 border-right position-relative">

                         <div class="mb-3 bg2 border p-3 container-main">
                            <h3 class="text-white fw-bold text-center">Feel free to contact us</h3>
                         </div>   

                        <div class="p-3">
                            <form method="POST">

                                <div class="row mb-4">
                                    <label for="fullname" class="col-sm-12 col-md-3 col-form-label text-dark">Full name <span class="text-danger ml-1">*</span> </label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="text" class="form-control bg-input" v-model="formValidate.name" id="fullname" placeholder="Fullname" :class="hasError('name') ? 'is-invalid' : '' ">
                                        <div class="invalid-feedback" v-if="hasError('name')">{{getError('name')}}</div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="email" class="col-sm-12 col-md-3 col-form-label text-dark">Email <span class="text-danger ml-1">*</span> </label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="email" class="form-control bg-input" v-model="formValidate.email" id="email" placeholder="Email" :class="hasError('email') ? 'is-invalid' : '' ">
                                        <div class="invalid-feedback" v-if="hasError('email')">{{getError('email')}}</div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="phone" class="col-sm-12 col-md-3 col-form-label text-dark">Phone no <small>(Optional)</small> </label>
                                    <div class="col-sm-12 col-md-9">
                                        <input type="text" class="form-control bg-input" :class="hasError('phone') ? 'is-invalid' : '' "  v-model="formValidate.phone" id="phone" placeholder="Phone number">
                                        <div class="invalid-feedback" v-if="hasError('phone')">{{getError('phone')}}</div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="msg" class="col-sm-12 col-md-3 col-form-label text-dark">Messeage <span class="text-danger ml-1">*</span> </label>
                                    <div class="col-sm-12 col-md-9">
                                        <textarea class="form-control bg-input" id="msg" rows="5" v-model="formValidate.msg" placeholder="Message" :class="hasError('msg') ? 'is-invalid' : '' "></textarea>
                                        <div class="invalid-feedback" v-if="hasError('msg')">{{getError('msg')}}</div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-sm-12 col-md-3"></label>
                                    <div class="text-center col-sm-12 col-md-3 mx-auto mt-3">
                                        <button class="btn col-12 btn-dark text-white" :loading="loading2" icon="ios-send-outline" @click.prevent="sendEmail">
                                            <span v-if="!loading2">Send Email</span>
                                            <span v-else>Loading...</span>
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <div class="offset-0 offset-md-3 d-flex justify-content-center py-2 gap-3 mt-2 p-3">

                            <a href="https://www.facebook.com/besttourinfo.com.fb" target="_blank" class="d-inline"><b-icon-facebook width="30" height="30" class="header-icon text-primary ul-li"></b-icon-facebook></a>
                            <a href="https://www.instagram.com/besttourinfo/" target="_blank"><b-icon-instagram width="30" height="30" class="header-icon text-danger ul-li"></b-icon-instagram></a>
                            <a href="https://twitter.com/besttourinfocom" target="_blank"><b-icon-twitter width="30" height="30" class="header-icon text-primary ul-li"></b-icon-twitter></a>
                       
                        </div>

                    </div>

                    <div class="col-lg-4 col-md-12 mx-auto pt-4">

                        <div class="mb-3 p-3 bg2 border p-3 container-main">
                          <h3 class="text-white fw-bold text-center">Our Location</h3>
                        </div>

                        <div class="row p-0 mb-4">
                        
                            <div class="col-10 mx-auto my-2 bg-card-bg p-2 container-main">
                                <h6 class="p-2 text-start text-white"><span class="text-light fw-bold">Address : </span>Bandarban Sadar, Bandarban.</h6>
                                <h6 class="p-2 text-start text-white"><span class="text-light fw-bold">Road no : </span>3 No Circle Area.</h6>
                                <h6 class="p-2 text-start text-white"><span class="text-light fw-bold">House no : </span>Member Para.</h6>
                            </div>
                            <div class="col-10 mx-auto my-2 bg-card-bg p-2 container-main">
                                <h6 class="p-2 text-start text-white"><span class="text-light fw-bold">Phone no : </span>01718274787</h6>
                                <h6 class="p-2 text-start text-white"><span class="text-light fw-bold">Email : </span>info@besttourinfo.com.</h6>
                                <h6 class="p-2 text-start text-white"><span class="text-light fw-bold">Email : </span>support@besttourinfo.com.</h6>
                                <h6 class="p-2 text-start text-white"><span class="text-light fw-bold">Email : </span>sales@besttourinfo.com.</h6>
                            </div>

                            <div class="col-10 mx-auto my-2 bg-card-bg p-2 container-main text-center">
                                <div>
                                    <img src="img/whats-app-qr.jpg" height="150" width="150" class="container-main" alt="logo not found">
                                </div>
                                <p class="text-center text-success text-small mt-2">Join us on whatsapp</p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
    
        </div>


        <Modal v-model="successModal" scrollable width="300" footer-hide>
            <div class="p-3">
                <div class="text-success h-100 d-flex aling-items-center justify-content-center mb-2">
                    <Icon type="md-checkbox-outline" class="text-center mr-2" size="30" />
                    <span class="my-auto text-center text-success fs-5">E-mail has been sent</span>    
                </div>
                <p class="text-dark text-center text-sm">[ We will contact you shortly. ]</p>
            </div>
        </Modal>

    </div>    
</template>
  
<script>


export default {

    data () {
        return {
            errors: {},
            successModal: false,
            loading2: false,
            isLoading: true,

            formValidate: {
                name: '',
                email: '',
                phone: '',
                msg: ''
            },

            
        }
    },

    methods: {

        async sendEmail() {
            this.loading2 = true;
            const res = await this.callApi("post","contact/mailsend", this.formValidate);
            if (res.status == 200) {
            this.successModal = true;
            this.errors = {};
            this.formValidate = {};
            this.loading2 = false;
            } else{
                if(res.status === 422) {
                    for(let i in res.data.errors){
                    this.errors = res.data.errors
                    }
                    this.loading2 = false;
                }
                else {
                    this.errorMsg();
                    this.loading2 = false;
                }
            }

        }
    },

    async created(){
        setTimeout(() => {
            this.isLoading = false;
        }, 300);
    }
}
</script>
  
<style scoped>

.contact-child {
    position: relative;
    background: rgba(255, 255, 255, 0.945);
    border: .5px solid rgb(226, 226, 226);
    margin-top: -150px;
    z-index: 1000;
    margin-bottom: 25px;
}
.bg-input {
    background: rgb(238, 238, 238);
    color: #000;
    border: .5px solid rgb(221, 221, 221);
}
.btn-black {
    background: rgb(51, 51, 51);
    border: .5px solid rgb(216, 216, 216);
}

.btn-black:hover {
    background: rgb(0, 0, 0);
    border: .5px solid rgba(216, 216, 216);;
}
.container-main {
  border-radius: 7px !important;
}
.col-form-label {
    font-size: 15px;
    font-weight: 600;
}

.bg2{
    background: linear-gradient(0.25turn,#00202e, #2f0d00, #00202e) !important;
}
.bg-card-bg{
    background: #00202e;
}
</style>