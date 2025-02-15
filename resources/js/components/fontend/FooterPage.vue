<template>
    <div class="footer">

        <div class="container-fluid bg-subs py-1">

            <div class="container p-0">
                <div class="row">
                    <div class="col-md-9 col-sm-12 col-xs-12 py-2">
                        <div class="input-group">
                            <input type="email" v-model="data.EmailAddress" class="form-control" placeholder="Subscribe with email to get special offer" aria-label="Recipient's username" aria-describedby="button-addon2" :class="hasError('EmailAddress') ? 'is-invalid' : '' ">
                            <a :loading="loading" class="rounded-subs-btn rounded fw-bold btn-primary d-flex align-items-center" @click.prevent="success()" type="button" id="button-addon2">
                                <h6 class="align-middle" v-if="!loading">Subscribe</h6>
                                <h6 class="align-middle" v-else>Loading...</h6>
                            </a>
                            <div class="invalid-feedback" v-if="hasError('EmailAddress')">{{getError('EmailAddress')}}</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 mx-auto d-flex justify-content-center py-2 text-center">
                        <a href="https://forms.gle/gxDUPD4wEWG47B8j9" target="_blank" class="fw-bold rounded-btn w-100">Become an affiliate</a>
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-footer">
            <div class="container">
                <footer class="pt-3">
                    <div class="row">
                        
                        <div class="col-sm-12 col-md-3 mb-3 text-center text-md-start">
                           
                            <!-- <a href="https://besttourinfo.com/" class="d-flex aling-items-center justify-content-center justify-content-md-start">
                                <img class="rounded my-auto" width="180" src="img/logo1.png" alt="">
                            </a> -->
                            <h5 class="text-center text-md-start mb-3 text-nav-heading my-auto">Contact</h5>
                          
                            <div class="my-auto">
                                <div class="mt-1">
                                    <a href="tel:+8801718-274787" class="text-semi-lightw"><b-icon-telephone class="text-seccondary mr-2 d-inline my-1" width="10" height="10"></b-icon-telephone>+8801718-274787</a>
                                    <br>
                                    <a href = "mailto:info@besttourinfo.com" class="text-semi-lightw"><b-icon-envelope class="text-seccondary mr-2 d-inline my-1" width="10" height="10"></b-icon-envelope>info@besttourinfo.com</a>
                                </div>

                                <p class="nav-item text-unstyled my-auto text-start py-2">
                                    <ul class="list-unstyled d-flex my-auto justify-content-center  justify-content-md-start">
                                        <li class="ms-3">
                                            <a class="link-dark" href="https://www.facebook.com/besttourinfo.com.fb" target="_blank">
                                            <b-icon-facebook class="text-primary ul-li rounded-circle p-2 bg-custom" width="35" height="35"></b-icon-facebook>
                                            </a>
                                        </li>
                                        
                                        <li class="ms-3">
                                            <a class="link-dark" href="https://www.instagram.com/besttourinfo/" target="_blank">
                                            <b-icon-instagram class="text-danger ul-li rounded-circle p-2 bg-custom" width="35" height="35"></b-icon-instagram>
                                            </a>
                                        </li>
                                        <li class="ms-3">
                                            <a class="link-dark" href="https://twitter.com/besttourinfocom" target="_blank">
                                            <b-icon-twitter class="text-primary ul-li rounded-circle p-2 bg-custom" width="35" height="35"></b-icon-twitter>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </p>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-3 mx-auto mb-3 text-center">
                            <h5 class="text-light  text-nav-heading mb-3 fw-bold"><b-icon-info-circle class="text-seccondary mr-2 d-inline" width="22" height="22"></b-icon-info-circle>Need Help <span class="text-primary">?</span></h5>
                            <p class="p-1 text-semi-lightw">
                                Have questions ? <br>
                                Fell free to contact us... <br>
                                Email us or Knock us on Messenger anytime <br> or <br> Call our Hotline 24/7.
                            </p>
                        </div>

                        <div class="col-sm-12 col-md-3 mx-auto mb-3">
                            <h5 class="text-center mb-3 text-nav-heading">Quick links</h5>
                            <ul class="nav flex-column">
                                <!-- <li class="nav-item mb-2 text-center"><router-link to="/about" class="p-0 text-nav-link">About Us</router-link></li> -->
                                <li class="nav-item mb-2 text-center"><router-link to="/refund-policies" class="p-0 text-nav-link">Refund Policy</router-link></li>
                                <li class="nav-item mb-2 text-center"><router-link to="/privacy-policy" class="p-0 text-nav-link">Privacy Policy</router-link></li>
                                <li class="nav-item mb-2 text-center"><router-link to="/terms-and-condition" class="p-0 text-nav-link">Terms and Conditions</router-link></li>
                                <li class="nav-item mb-2 text-center"><router-link to="/about" class="p-0 text-nav-link">FAQs</router-link></li>
                            </ul>
                        </div>

                        <div class="col-sm-12 col-md-3 mx-auto mb-3">
                            <h5 class="text-center mb-3 text-nav-heading">Explore More</h5>
                            <ul class="nav flex-column">
                                <!-- <li class="nav-item mb-2 text-center"><router-link to="/about" class="p-0 text-nav-link">About Us</router-link></li> -->
                                <li class="nav-item mb-2 text-center"><router-link to="/hotel" class="p-0 text-nav-link">Our Hotels</router-link></li>
                                <li class="nav-item mb-2 text-center"><router-link to="/car" class="p-0 text-nav-link">Our Cars</router-link></li>
                                <li class="nav-item mb-2 text-center"><router-link to="/posts" class="p-0 text-nav-link">Our Ships</router-link></li>
                                <li class="nav-item mb-2 text-center"><router-link to="/posts" class="p-0 text-nav-link">Blogs</router-link></li>
                                
                            </ul>
                        </div>
                        

                    </div>
                </footer>
            </div>
        </div>

        <div class="bg-footer-mini bg-white">

            <!-- <img src="img/Payment Banner_Jan23_V2-05.jpg" class="img-fluid mb-0 pb-0" alt=""> -->

            <div class="container py-3">
                <div class="row text-center">
                    <p class="my-auto text-sm-center text-md-start col-md-4 col-sm-12 py-1 py-md-0">&copy; 2023 - {{ new Date().getFullYear() }} <b class="text-success">BestTourInfo</b> Inc.</p>
                    <!-- <p class="my-auto text-sm-center text-md-center col-md-4 col-sm-12">Trade Lisence No: <span class="text-success">05810.</span></p> -->
                    <!-- <p class="nav-item text-unstyled my-auto text-sm-center col-md-4 col-sm-12 py-2 py-md-0">
                        <ul class="list-unstyled d-flex my-auto justify-content-center">
                            <li class="ms-3">
                                <a class="link-dark" href="https://www.facebook.com/besttourinfo.com.fb" target="_blank">
                                <b-icon-facebook class="text-primary ul-li" width="17" height="17"></b-icon-facebook>
                                </a>
                            </li>
                            
                            <li class="ms-3">
                                <a class="link-dark" href="https://www.instagram.com/besttourinfo/" target="_blank">
                                <b-icon-instagram class="text-danger ul-li" width="17" height="17"></b-icon-instagram>
                                </a>
                            </li>
                            <li class="ms-3">
                                <a class="link-dark" href="https://twitter.com/besttourinfocom" target="_blank">
                                <b-icon-twitter class="text-primary ul-li" width="17" height="17"></b-icon-twitter>
                                </a>
                            </li>
                            
                        </ul>
                    </p> -->
                    <p class="my-auto text-center col-md-5 col-sm-12 py-1 py-md-0">
                        Payment By<img src="img/ssl.png" class="img-fluid ml-2" alt="">
                    </p>
                    <p class="my-auto text-sm-center text-md-end col-md-3 col-sm-12 py-1 py-md-0">
                        Developed by <a class="text-success fw-bold" href="https://amlan-kumar-mandol.netlify.app/" target="_blank">AKM.</a>
                    </p>
                </div>
            </div>
        </div>

        <BackTop :bottom="100"></BackTop>

        <!-- Email Modal -->

        <Modal v-model="successModal" scrollable width="300" footer-hide>
            <div class="p-3">
                <div class="text-success h-100 d-flex aling-items-center justify-content-center mb-2">
                    <Icon type="md-checkbox-outline" class="text-center mr-2" size="30" />
                    <span class="my-auto text-center text-success fs-5">E-mail has been sent</span>    
                </div>
                <p class="text-dark text-center text-sm">[ We will contact you shortly. ]</p>
            </div>
        </Modal>

        <!-- Subscriber  Modal -->
        <Modal v-model="subsModal" scrollable width="420" footer-hide>
            <div class="p-3">
                <div class="text-success h-100 d-flex aling-items-center justify-content-center mb-2">
                    <Icon type="md-checkbox-outline" class="text-center mr-2" size="30" />
                    <span class="my-auto text-center text-success fs-5">Thank You for Subscribe Us</span>    
                </div>
                <p class="text-dark text-center text-sm">[ We will Keep you Updating.... ]</p>
            </div>
        </Modal>

    </div>
</template>

<script>
import common from './../../common.js';

export default {

  mixins: [common],
  data(){
    return {
        errors: {},
        loading: false,
        subsModal: false,
        successModal: false,
        footerMail: {
            user_name: '',
            user_email: '',
            message: '',
        },

        data:{
            EmailAddress: "",
        }
    }
  },  

  methods: {

    async sendmail() {
    //   if (this.footerMail.user_name.trim() == "")
    //   return this.infoMsg("Name can not be empty");  
    //   if (this.footerMail.user_email.trim() == "")
    //   return this.infoMsg("Email can not be empty");  
    //   if (this.footerMail.message.trim() == "")
    //   return this.infoMsg("Message can not be empty");  
      const res = await this.callApi("post","footer/mailsend", this.footerMail);
        if (res.status == 200) {
        this.successModal = true;
        this.errors = {};
        this.footerMail = {};
        //console.log(this.staysInBangladesh)
        } else{
            if(res.status === 422) {
                for(let i in res.data.errors){
                    this.errors = res.data.errors
                }
            }
            else {
                this.errorMsg();
            }
        }

      
    },
    
    async success() {
    
        this.loading = true;
        const res = await this.callApi("post", "/subscribe", this.data)
        if(res.status === 201){
            this.subsModal = true;
            this.data.EmailAddress = "";
            this.loading = false;
            this.errors = {};
            setTimeout(() => {
                this.subsModal = false;
            }, 2000);
        }
        if(res.status === 422) {
            for(let i in res.data.errors){
            this.errors = res.data.errors
            }
            this.loading = false;
        }
        // if(res.status === 500) {
        //    this.errors = res.data.errors
        //    this.errors = {};
        //    this.loading = false;
        // }
        // else {
        //     this.errors = res.data.errors
        //     this.loading = false;
        // }
    }

       
    },


}
</script>

<style scoped>
.bg-custom{
    background: #ffffff;
    border: .2px solid #08444f;
}
.rounded-btn:hover{
    background: #000000;
    padding: 7px 10px;
    text-decoration: underline;
    border-radius: 7px;
    border: .5px solid #2f2f2f;
    font-weight: 600;
}

.rounded-btn{
    background: #008e28;
    padding: 7px 10px;
    text-decoration: none;
    border-radius: 7px;
    color: #fff;
    border: .5px solid #a8a8a8;
    height: max-content !important;
}

.footer {
    overflow: hidden;
    position: relative;
    z-index: 10 !important;
}

.text-semi-light{
    color:rgb(182, 182, 182);
    font-size: 12px;
}    

.text-semi-lightw{
    color: rgb(176, 176, 176);
    font-size: 14px;
}    
.bg-footer {
    background: rgb(1, 14, 16);
    padding: 30px 0;
}

.bg-subs {
    background: rgba(0, 19, 23, 0.908);
    border-bottom: 1px solid #ffffff2c;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.bg-footer-mini {
    background: rgb(230, 230, 230) !important;
    font-size: 13px;
}

.text-nav-heading {
    color: #e8e8e8;
    font-size: 18px;
}

.text-nav-link {
    color: rgb(176, 176, 176);
    font-size: 15px;
}

.text-nav-link:hover {
    color:#fff;
    padding: 0;
}

.bg-footer-form {
    background: rgb(0, 41, 49);
    border: 0;
}

.rounded-subs2{
    background: linear-gradient(0.25turn, #000000, #062200, #413636);
    border-top-right-radius: 17px;
    border-bottom-left-radius: 17px;
    border: .5px solid rgb(99, 99, 99);
    padding: 8px 15px;
    text-decoration: underline;
    font-size: 15px;
    color: #ffffff;
}
.rounded-subs2:hover{
    background: linear-gradient(0.25turn, #f69d3c,#000000, #398300);
    border-radius: 7px;
    transition: .3s;
}

.rounded-subs{
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    background: rgba(0, 0, 0, 0.582);
    color:#fff;
    border: .5px solid rgb(58, 58, 58);
}

.rounded-subs-btn{
    border-top-left-radius: 0 !important;
    border-bottom-left-radius: 0 !important;
    font-weight: 600;
    padding: 0 30px;
}

.bg-custom{
    background: #aaaaaa;
}

.bg-custom:hover{
    background: #ffffff;
}

</style>