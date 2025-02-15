<template>
    <div>

        <div class="headerFixed" :style="headerStyles">
            <div class="container-header">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <a class="navbar-brand fw-bolder col-2 text-start  m-0 p-0" href="/">
                            <img src="/img/logo.png" class="logo-img" alt="logo">
                        </a>

                        <a class="d-lg-none float-end" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                            <b-icon-list class="text-dark" width="40" height="30"></b-icon-list>
                        </a>

                        <div class="offcanvas offcanvas-start d-lg-none" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                            <div class="offcanvas-header border-bottom shadow">
                                <a class="text-start" href="/">
                                    <img src="/img/logo.png" class="img-fluid mx-auto" width="150" alt="logo">
                                </a>
                                <a class="btn-close bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></a>
                            </div>
                            <div class="offcanvas-body">
                                
                                
                                <ul class="navbar-nav col-11 justify-content-evenly aling-items-center my-auto">

                                    <li class="nav-item my-auto">
                                        <router-link to="/" class="nav-link" data-bs-dismiss="offcanvas">
                                            <img src="img/icon/home.png" alt="" class="d-inline nav-icon" width="17" height="17">
                                            <span class="d-inline ml-2 text-dark1">Home</span>
                                        </router-link>
                                    </li>

                                    <li class="nav-item my-auto">
                                        <router-link to="/hotel" class="nav-link" data-bs-dismiss="offcanvas">
                                            <img src="img/icon/reception.png" alt="" class="d-inline nav-icon" width="25" height="25">
                                            <span class="d-inline ml-2 text-dark1 my-auto">Hotel</span>
                                        </router-link>
                                    </li>


                                    <li class="nav-item">
                                        <router-link to="/car" class="nav-link" data-bs-dismiss="offcanvas">
                                            <img src="img/icon/car2.png" alt="" class="d-inline nav-icon" width="25" height="25">
                                            <span class="d-inline ml-2 text-dark1 my-auto">Cars</span>
                                        </router-link>
                                    </li>

                                    <li class="nav-item my-auto">
                                        <router-link to="/posts" class="nav-link" data-bs-dismiss="offcanvas">
                                            <img src="img/icon/reader.png" alt="" class="d-inline nav-icon" width="25" height="25">
                                            <span class="d-inline ml-2 text-dark1 my-auto">Blog</span>
                                        </router-link>
                                    </li>


                                    <li class="nav-item my-auto dropdown ">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="img/icon/joomla.png" alt="" class="d-inline nav-icon" width="17" height="17">
                                            <span class="d-inline ml-2 text-dark1 my-auto">Company</span>
                                        </a>
                                        
                                        <ul class="dropdown-menu radio-drop">
                                            <li class="dropdown-item">
                                                <router-link to="/about" class="nav-link" data-bs-dismiss="offcanvas">
                                                    <b-icon-trophy class="d-inline nav-icon" width="16" height="16"></b-icon-trophy>
                                                    <span class="d-inline ml-2 text-dark1 my-auto rad-text">About Us</span>
                                                </router-link>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li class="dropdown-item">
                                                <router-link to="/contact" class="nav-link" data-bs-dismiss="offcanvas">
                                                    <b-icon-geo class="d-inline nav-icon" width="16" height="16"></b-icon-geo>
                                                    <span class="d-inline ml-2 text-dark1 my-auto rad-text">Contact Us</span>
                                                </router-link>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li class="dropdown-item">
                                                <router-link to="/privacy-policy" class="nav-link" data-bs-dismiss="offcanvas">
                                                    <b-icon-newspaper class="d-inline nav-icon" width="16" height="16"></b-icon-newspaper>
                                                    <span class="d-inline ml-2 text-dark1 my-auto rad-text">Privacy Policy</span>
                                                </router-link>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li class="dropdown-item">
                                                <router-link to="/terms-and-condition" class="nav-link" data-bs-dismiss="offcanvas">
                                                    <b-icon-command class="d-inline nav-icon" width="16" height="16"></b-icon-command>
                                                    <span class="d-inline ml-2 text-dark1 my-auto rad-text">Terms and Conditions</span>
                                                </router-link>
                                            </li>
                                        </ul>
                                    </li>
                                                            
                                </ul>


                                <li class="nav-item my-auto dropdown d-flex mt-2" v-show ="this.$store.state.client == 'true'">
                                    <a class="nav-link dropdown-toggle p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img :src="this.$store.state.client.image" v-if="this.$store.state.client.image" class="text-dark border p-1 rounded-circle text-dark bg-seconary" width="30" height="30" />
                                        <img src="img/fav.png" v-else class="text-dark border-header p-1 rounded-circle text-dark bg-transparent" width="35" height="35" />
                                        <span v-if="this.$store.state.client.name" class="d-inline text-dark1 my-auto ml-2">{{ this.$store.state.client.name }}...</span>
                                    </a>
                                    
                                    <ul class="dropdown-menu radio-drop" v-if="this.$store.state.client.name">
                                        <li class="dropdown-item"  v-if="this.$store.state.client.userType == 'user'">
                                            <a href="/profile" class="nav-link" data-bs-dismiss="offcanvas">
                                                <b-icon-person-bounding-box class="d-inline nav-icon" width="18" height="18"></b-icon-person-bounding-box>
                                                <span class="d-inline ml-2 text-dark1 my-auto">Profile</span>
                                            </a>
                                        </li>
                                        <li class="dropdown-item"  v-else>
                                            <a href="/dashboard" class="nav-link" data-bs-dismiss="offcanvas">
                                                <b-icon-speedometer2 class="d-inline nav-icon" width="18" height="18"></b-icon-speedometer2>
                                                <span class="d-inline ml-2 text-dark1 my-auto">Dashboard</span>
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li class="dropdown-item">
                                            <a href="/app/user_logout" class="nav-link" data-bs-dismiss="offcanvas">
                                                <b-icon-box-arrow-in-left class="d-inline text-danger" width="18" height="18"></b-icon-box-arrow-in-left>
                                                <span class="d-inline ml-2 text-dark1 my-auto">Logout</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <ul class="dropdown-menu  radio-drop" v-else>
                                        <li class="dropdown-item">
                                            <router-link to="/user-login" class="nav-link" data-bs-dismiss="offcanvas">
                                                <b-icon-box-arrow-in-right class="d-inline nav-icon" width="18" height="18"></b-icon-box-arrow-in-right>
                                                <span class="d-inline ml-2 text-dark1 my-auto">Login</span>
                                            </router-link>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li class="dropdown-item">
                                            <router-link to="/register" class="nav-link" data-bs-dismiss="offcanvas">
                                                <b-icon-ui-checks class="d-inline nav-icon" width="18" height="18"></b-icon-ui-checks>
                                                <span class="d-inline ml-2 text-dark1 my-auto">Resister</span>
                                            </router-link>
                                        </li>
                                    </ul>

                                </li>



                            </div>
                        </div>

                        <!-- <div class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
                            <b-icon-list class="text-dark" width="40" height="30"></b-icon-list>
                        </div> -->


                        <div class="collapse navbar-collapse mt-1 mt-lg-0 ml-4" id="navbarSupportedContent">

                            <ul class="navbar-nav col-11 justify-content-evenly aling-items-center my-auto">

                                <li class="nav-item my-auto">
                                    <router-link to="/" class="nav-link">
                                        <img src="img/icon/home.png" alt="" class="d-inline nav-icon" width="17" height="17">
                                        <span class="d-inline ml-2 text-dark1">Home</span>
                                    </router-link>
                                </li>

                                <li class="nav-item my-auto">
                                    <router-link to="/hotel" class="nav-link">
                                        <img src="img/icon/reception.png" alt="" class="d-inline nav-icon" width="25" height="25">
                                        <span class="d-inline ml-2 text-dark1 my-auto">Hotel</span>
                                    </router-link>
                                </li>

                                <!-- <li class="nav-item">
                                    <router-link to="/flight" class="nav-link">
                                        <img src="img/icon/airplane2.png" alt="" class="d-inline nav-icon" width="25" height="25">
                                        <span class="d-inline ml-2 text-dark1 my-auto">Flights</span>
                                    </router-link>
                                </li> -->

                                <li class="nav-item">
                                    <router-link to="/car" class="nav-link">
                                        <img src="img/icon/car2.png" alt="" class="d-inline nav-icon" width="25" height="25">
                                        <span class="d-inline ml-2 text-dark1 my-auto">Cars</span>
                                    </router-link>
                                </li>

                                <li class="nav-item my-auto">
                                    <router-link to="/posts" class="nav-link">
                                        <img src="img/icon/reader.png" alt="" class="d-inline nav-icon" width="25" height="25">
                                        <span class="d-inline ml-2 text-dark1 my-auto">Blog</span>
                                    </router-link>
                                </li>

    
                                <li class="nav-item my-auto dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="img/icon/joomla.png" alt="" class="d-inline nav-icon" width="17" height="17">
                                        <span class="d-inline ml-2 text-dark1 my-auto">Company</span>
                                    </a>
                                    
                                    <ul class="dropdown-menu radio-drop">
                                        <li class="dropdown-item">
                                            <router-link to="/about" class="nav-link">
                                                <b-icon-trophy class="d-inline nav-icon" width="16" height="16"></b-icon-trophy>
                                                <span class="d-inline ml-2 text-dark1 my-auto rad-text">About Us</span>
                                            </router-link>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li class="dropdown-item">
                                            <router-link to="/contact" class="nav-link">
                                                <b-icon-geo class="d-inline nav-icon" width="16" height="16"></b-icon-geo>
                                                <span class="d-inline ml-2 text-dark1 my-auto rad-text">Contact Us</span>
                                            </router-link>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li class="dropdown-item">
                                            <router-link to="/privacy-policy" class="nav-link">
                                                <b-icon-newspaper class="d-inline nav-icon" width="16" height="16"></b-icon-newspaper>
                                                <span class="d-inline ml-2 text-dark1 my-auto rad-text">Privacy Policy</span>
                                            </router-link>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li class="dropdown-item">
                                            <router-link to="/terms-and-condition" class="nav-link">
                                                <b-icon-command class="d-inline nav-icon" width="16" height="16"></b-icon-command>
                                                <span class="d-inline ml-2 text-dark1 my-auto rad-text">Terms and Conditions</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </li>

                                <!-- <li class="nav-item my-auto dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img v-if="currency == 'USD'" src="img/currency/doller.png" width="25" class="p-1" alt="">
                                        <img v-else src="img/currency/tk.png" width="25" class="p-1" alt="">
                                        <span v-if="currency == 'USD'" class="d-inline ml-2 text-dark1 my-auto">USD</span>
                                        <span v-else class="d-inline ml-2 text-dark1 my-auto">BDT</span>
                                    </a>
                                    
                                    <ul class="dropdown-menu radio-drop">
                                        <li class="dropdown-item">
                                            <label class="rad-label">
                                                <input @change="currencyValue" v-model="currency" value="USD" type="radio" class="rad-input" name="rad">
                                                <div class="rad-design"></div>
                                                <div class="rad-text">USD</div>
                                            </label>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li class="dropdown-item">
                                            <label class="rad-label">
                                                <input @change="currencyValue" v-model="currency" value="BDT" type="radio" class="rad-input" name="rad">
                                                <div class="rad-design"></div>
                                                <div class="rad-text">BDT</div>
                                            </label>
                                        </li>
                                    </ul>
                                </li> -->
                                                           
                            </ul>
                            
                            

                            <li class="nav-item my-auto dropdown d-flex ms-auto" v-show ="this.$store.state.client == 'true'">
                                <a class="nav-link dropdown-toggle p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img :src="this.$store.state.client.image" v-if="this.$store.state.client.image" class="text-dark border p-1 rounded-circle text-dark bg-seconary" width="30" height="30" />
                                    <img src="img/fav.png" v-else class="text-dark border-header p-1 rounded-circle text-dark bg-transparent" width="35" height="35" />
                                    <span v-if="this.$store.state.client.name" class="d-inline text-dark1 my-auto ml-2">{{ this.$store.state.client.name.substring(0, 5) }}...</span>
                                </a>
                                
                                <ul class="dropdown-menu radio-drop" v-if="this.$store.state.client.name">
                                    <li class="dropdown-item"  v-if="this.$store.state.client.userType == 'user'">
                                        <a href="/profile" class="nav-link">
                                            <b-icon-person-bounding-box class="d-inline nav-icon" width="18" height="18"></b-icon-person-bounding-box>
                                            <span class="d-inline ml-2 text-dark1 my-auto">Profile</span>
                                        </a>
                                    </li>
                                    <li class="dropdown-item"  v-else>
                                        <a href="/dashboard" class="nav-link">
                                            <b-icon-speedometer2 class="d-inline nav-icon" width="18" height="18"></b-icon-speedometer2>
                                            <span class="d-inline ml-2 text-dark1 my-auto">Dashboard</span>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="dropdown-item">
                                        <a href="/app/user_logout" class="nav-link">
                                            <b-icon-box-arrow-in-left class="d-inline text-danger" width="18" height="18"></b-icon-box-arrow-in-left>
                                            <span class="d-inline ml-2 text-dark1 my-auto">Logout</span>
                                        </a>
                                    </li>
                                </ul>

                                <ul class="dropdown-menu  radio-drop" v-else>
                                    <li class="dropdown-item">
                                        <router-link to="/user-login" class="nav-link">
                                            <b-icon-box-arrow-in-right class="d-inline nav-icon" width="18" height="18"></b-icon-box-arrow-in-right>
                                            <span class="d-inline ml-2 text-dark1 my-auto">Login</span>
                                        </router-link>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="dropdown-item">
                                        <router-link to="/register" class="nav-link">
                                            <b-icon-ui-checks class="d-inline nav-icon" width="18" height="18"></b-icon-ui-checks>
                                            <span class="d-inline ml-2 text-dark1 my-auto">Resister</span>
                                        </router-link>
                                    </li>
                                </ul>

                            </li>

                        </div>
                        
                    </div>
                </nav>
            
            </div>
        </div>

    </div>
</template>

<script>

export default {
    data() {
        return {
            currency: '',
            headerStyles: {
                // Default header background style
                background: 'transparent',
                borderBottom: 'none'
            },
        }
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
    },
    destroyed() {
        window.removeEventListener('scroll', this.handleScroll);
    },

    methods: {
        handleScroll() {

            
                // Calculate scroll position
                const scrollPosition = window.scrollY || window.pageYOffset;

                // Define the threshold where you want to change the background
                const threshold = 80;

                // Update the header background based on the scroll position
                if (scrollPosition > threshold) {
                    this.headerStyles.background = '#fff'; // Change to desired background color/image
                    this.headerStyles.borderBottom = '.1px dotted   rgba(48, 177, 48, 0.458)'; // Change to desired background color/image
                } else { 
                    this.headerStyles.background = 'transparent';
                    this.headerStyles.borderBottom = 'none';
                }
            
        },

        currencyValue(){
            //console.log(this.currency);
        }
  }
}
</script>

<style scoped>
    .offcanvas{
        width: 70%;
    }

    .border-header{
        border: 2px solid rgb(48, 177, 48);
    }

    .radio-drop{
        background-color: #ffffffef;
    }

    .rad-label {
        display: flex;
        align-items: center;
        border-radius: 100px;
        margin: 10px 0;
        cursor: pointer;
        transition: .3s;
    }

    .rad-label:hover,
    .rad-label:focus-within {
        background: hsla(139, 100%, 83%, 0.562);
    }

    .rad-input {
        position: absolute;
        left: 0;
        top: 0;
        width: 1px;
        height: 1px;
        opacity: 0;
        z-index: -1;
    }

    .rad-design {
        width: 18px;
        height: 18px;
        border-radius: 100px;
        background: linear-gradient(to right bottom, hsl(154, 97%, 62%), hsl(30, 97%, 62%));
        position: relative;
    }

    .rad-design::before {
        content: '';
        display: inline-block;
        width: inherit;
        height: inherit;
        border-radius: inherit;
        background: hsla(0, 0%, 100%, 0.941);
        transform: scale(1.1);
        transition: .3s;
    }

    .rad-input:checked+.rad-design::before {
     transform: scale(0);
    }

    .rad-text {
        color: hsl(0, 0%, 21%);
        margin-left: 14px;
        text-transform: uppercase;
        font-size: 12px;
        font-weight: 600;
        transition: .3s;
    }

    .rad-input:checked~.rad-text {
        color: hsl(0, 0%, 0%);
    }


    /* ABS */
    /* ====================================================== */
    .abs-site-link {
        position: fixed;
        bottom: 40px;
        left: 20px;
        color: hsla(0, 0%, 0%, .5);
        font-size: 16px;
    }

    /* .headerFixed{
       
    } */
    .transparent {
        background-color: #ffffff00;
    }

    .container-header {
        width: 85% !important;
        margin-left: auto;
        margin-right: auto;
        padding: 0;
        border-radius: 10px;
    }

    .button {
        color: rgb(0, 0, 0);
        padding: 5px 10px;
        border-radius: 3px;
        font-weight: 600;
    }

    .login-btn:hover {
        background: rgba(0, 0, 17, 0.379);
        color:green;

    }
    .reg-btn:hover {
        background: rgba(0, 0, 17, 0.379);
        color:green;

    }
    .nav-icon {
        color: rgb(0, 131, 22);
    }

    .nav-link {
        text-transform: uppercase;
        font-weight: 500;
        font-size: 13px;
        align-items: center;
        letter-spacing: 1.5px;
    }
    .nav-link:hover {
        background: rgba(190, 190, 190, 0.347);
        color:green !important;
        border-radius: 3px;
    }
    a.router-link-active {
        border-bottom: 2px solid rgb(0, 113, 0); 
        background: rgba(190, 190, 190, 0.347);
        border-radius: 3px;
        color:rgb(13, 108, 0) !important;
        padding: 7px 10px;
    }

    .logo-img{
        height: 60px;
        width: auto;
        margin: 0;
        padding: 0;
    }

    @media only screen and (max-width: 1200px) {
        .logo-img{
            height: 40px;
            width: auto;
        }
    }
    @media only screen and (max-width: 991px) {
        .logo-img{
            height: 60px;
            width: auto;
        }
    }

</style>