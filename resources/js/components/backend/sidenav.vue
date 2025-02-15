<template>
  <div>

    <ul class="navbar-nav sidebar accordion" id="accordionSidebar">
        
        <!-- Sidebar - Brand -->
        <a class="d-flex mx-auto my-auto d-none d-md-block top-icon text-center" href="/dashboard">
            <img src="img/logo1.png" height="60" class="mr-2">
            <h6 class="fw-bold text-success d-none">BTI <sup class="fw-normal color-white text-sm">AD</sup></h6>
            <sup class="fw-normal color-white text-sm d-md-none ad-text">AD</sup>    
        </a>

        <a class="sidebar-sm d-flex align-items-center justify-content-center mx-auto d-md-none w-50" href="/dashboard">
            <img src="img/fav.png" height="60">
        </a>
        <!-- End of Sidebar - Brand -->
        
        <!-- Divider -->
        

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <router-link class="nav-link" to="/dashboard">
                <b-icon-speedometer class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-speedometer>
                <span class="color-white">Dashboard</span>
            </router-link>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <!-- <div class="sidebar-heading mt-4">
            Admin Management
        </div> -->

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <b-icon-tools class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-tools>
                <span class="color-white">Admin</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" :class="{ show: isActiveMenu('/admin-info') || isActiveMenu('/all-admin') || isActiveMenu('/all-user') || isActiveMenu('/all-editor') || isActiveMenu('/add-editor') }">
                <div class="bg-collaspse py-2 collapse-inner rounded">
                    <router-link class="collapse-item" to="/admin-info">
                        <i class="mr-2 color-white fas fa-fw fa-lock"></i>
                        <span class="color-white">Admin Info</span>
                    </router-link>
                    <router-link class="collapse-item" to="/all-admin" v-if="this.$store.state.user.userType == 'admin' || this.$store.state.user.userType == 'super'">
                        <i class="mr-2 color-white fas fa-fw fa-user-check"></i>
                        <span class="color-white">All Admin</span>
                    </router-link>
                    <router-link class="collapse-item" to="/all-editor" >
                        <i class="mr-2 color-white fas fa-fw fa-sitemap"></i>
                        <span class="color-white">All Editor</span>
                    </router-link>
                    <router-link class="collapse-item" to="/add-editor" v-if="this.$store.state.user.userType != 'editor'">
                        <i class="mr-2 color-white fas fa-fw fa-plus"></i>
                        <span class="color-white">Add Editor</span>
                    </router-link>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">
        <li class="nav-item">
            <router-link class="nav-link" to="/all-user">
                <b-icon-people class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-people>
                <span class="color-white">All Customers</span>
            </router-link>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4"
                aria-expanded="true" aria-controls="collapse4">
                <b-icon-bank class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-bank>
                <span class="color-white">Hotel Manage</span>
            </a>
            <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" :class="{ show: isActiveMenu('/hotels') || isActiveMenu('/add-hotel') }">
                <div class="bg-collaspse py-2 collapse-inner rounded">
                    <router-link class="collapse-item" to="/hotels">
                        <b-icon-eye class="color-white mr-2 my-auto" width="18" height="18"></b-icon-eye>
                        <span class="color-white">All Hotels</span>
                    </router-link>

                    <router-link class="collapse-item" to="/add-hotel">
                        <b-icon-plus-circle class="color-white mr-2 my-auto" width="18" height="18"></b-icon-plus-circle>
                        <span class="color-white">Add Hotel</span>
                    </router-link>

                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse40"
                aria-expanded="true" aria-controls="collapse40">
                <b-icon-cart-check class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-cart-check>
                <span class="color-white">Hotel Booking</span>
            </a>
            <div id="collapse40" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" :class="{ show: isActiveMenu('/booking') || isActiveMenu('/edit_booking') || isActiveMenu('/print-hotel') }">
                <div class="bg-collaspse py-2 collapse-inner rounded">
      
                    <router-link class="collapse-item" to="/booking">
                        <b-icon-eye class="color-white mr-2 my-auto" width="18" height="18"></b-icon-eye>
                        <span class="color-white">All Booking</span>
                    </router-link>

                    <router-link class="collapse-item" to="/edit_booking">
                        <b-icon-pencil-square class="color-white mr-2 my-auto" width="16" height="16"></b-icon-pencil-square>
                        <span class="color-white">Edit Booking</span>
                    </router-link>

                    <router-link class="collapse-item" to="/print-hotel">
                        <b-icon-printer class="color-white mr-2 my-auto" width="16" height="16"></b-icon-printer>
                        <span class="color-white"> Print Order</span>
                    </router-link>

                </div>
            </div>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse510"
                aria-expanded="true" aria-controls="collapse510">
                <b-icon-truck class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-truck>
                <span class="color-white">Car Rental</span>
            </a>
            <div id="collapse510" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" :class="{ show: isActiveMenu('/cars-list') || isActiveMenu('/driver') || isActiveMenu('/destination') }">
                <div class="bg-collaspse py-2 collapse-inner rounded">
      
                    <router-link class="collapse-item" to="/cars-list">
                        <b-icon-eye class="color-white mr-2 my-auto" width="16" height="16"></b-icon-eye>
                        <span class="color-white">Car Type</span>
                    </router-link>

                    <router-link class="collapse-item" to="/driver">
                        <b-icon-eye class="color-white mr-2 my-auto" width="16" height="16"></b-icon-eye>
                        <span class="color-white">Drivers</span>
                    </router-link>

                    <router-link class="collapse-item" to="/destination">
                        <b-icon-geo-alt class="color-white mr-2 my-auto" width="16" height="16"></b-icon-geo-alt>
                        <span class="color-white">Destinations</span>
                    </router-link>

                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse410"
                aria-expanded="true" aria-controls="collapse410">
                <b-icon-cart-check class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-cart-check>
                <span class="color-white">Car Booking</span>
            </a>
            <div id="collapse410" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" :class="{ show: isActiveMenu('/cars-rent') || isActiveMenu('/assign-driver') || isActiveMenu('/print-car') }">
                <div class="bg-collaspse py-2 collapse-inner rounded">
      
                    <router-link class="collapse-item" to="/cars-rent">
                        <b-icon-basket class="color-white mr-2 my-auto" width="16" height="16"></b-icon-basket>
                        <span class="color-white">All Order</span>
                    </router-link>

                    <router-link class="collapse-item" to="/assign-driver">
                        <b-icon-bookmark-plus class="color-white mr-2 my-auto" width="16" height="16"></b-icon-bookmark-plus>
                        <span class="color-white">Update Order</span>
                    </router-link>

                    <router-link class="collapse-item" to="/print-car">
                        <b-icon-printer class="color-white mr-2 my-auto" width="16" height="16"></b-icon-printer>
                        <span class="color-white"> Print Order</span>
                    </router-link>
      
                </div>
            </div>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse50"
                aria-expanded="true" aria-controls="collapse50">
                <b-icon-newspaper class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-newspaper>
                <span class="color-white">Blog</span>
            </a>
            <div id="collapse50" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" :class="{ show: isActiveMenu('/blog') || isActiveMenu('/category') || isActiveMenu('/add-blog') || isActiveMenu('/add-blog-category')  }">
                <div class="bg-collaspse py-2 collapse-inner rounded">
      
                    <router-link class="collapse-item" to="/blog">
                        <b-icon-eye class="color-white mr-2 my-auto" width="18" height="18"></b-icon-eye>
                        <span class="color-white">All Post</span>
                    </router-link>

                    <router-link class="collapse-item" to="/category">
                        <b-icon-eye class="color-white mr-2 my-auto" width="18" height="18"></b-icon-eye>
                        <span class="color-white">All Categories</span>
                    </router-link>

                    <router-link class="collapse-item" to="/add-blog">
                        <b-icon-plus-circle class="color-white mr-2 my-auto" width="16" height="16"></b-icon-plus-circle>
                        <span class="color-white">Add Post</span>
                    </router-link>

                    <router-link class="collapse-item" to="/add-blog-category">
                        <b-icon-plus-circle class="color-white mr-2 my-auto" width="16" height="16"></b-icon-plus-circle>
                        <span class="color-white">Add Category</span>
                    </router-link>

                </div>
            </div>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <router-link class="nav-link" to="/vat-tax">
                <b-icon-currency-dollar class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-currency-dollar>
                <span class="color-white"> Vat and Tax</span>
            </router-link>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <router-link class="nav-link" to="/send-email">
                <b-icon-envelope class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-envelope>
                <span class="color-white">Send Email</span>
            </router-link>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <router-link class="nav-link" to="/login-record">
                <b-icon-card-checklist class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-card-checklist>
                <span class="color-white">Login Record</span>
            </router-link>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <router-link class="nav-link" to="/email-log">
                <b-icon-link45deg class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-link45deg>
                <span class="color-white">Email Log</span>
            </router-link>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <router-link class="nav-link" to="/top-ads">
                <b-icon-badge-ad class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-badge-ad>
                <span class="color-white">Top Ads Html</span>
            </router-link>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <router-link class="nav-link" to="/multiple-ads">
                <b-icon-badge-ad class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-badge-ad>
                <span class="color-white">Bottom Ads Image</span>
            </router-link>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <router-link class="nav-link" to="/subscriber-list">
                <b-icon-list-task class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-list-task>
                <span class="color-white">Subscriber List</span>
            </router-link>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <router-link class="nav-link" to="/about-us">
                <b-icon-info-circle class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-info-circle>
                <span class="color-white">About Us</span>
            </router-link>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <router-link class="nav-link" to="/faq">
                <b-icon-question-diamond class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-question-diamond>
                <span class="color-white">FAQ's</span>
            </router-link>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <router-link class="nav-link" to="/t-n-c">
                <b-icon-file-earmark-ruled class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-file-earmark-ruled>
                <span class="color-white">T&C</span>
            </router-link>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <router-link class="nav-link" to="/privacy-policys">
                <b-icon-file-lock class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-file-lock>
                <span class="color-white">Privacy Policy</span>
            </router-link>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <router-link class="nav-link" to="/refund-policy">
                <b-icon-file-medical class="icon-color mr-2 my-auto" width="17" height="17"></b-icon-file-medical>
                <span class="color-white">Refund Policy</span>
            </router-link>
        </li>

        <!-- Sidebar Logout (Sidebar) -->
        <a class="text-center mb-5 mt-3"  href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger fs-4"></i>
        </a>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>

  </div>
</template>

<script>
export default {
    data(){
        return{
            user: this.$store.state.user,
        }
    },

    methods: {
        isActiveMenu(paths) {
            return paths.includes(this.$route.path);
        },
    }
}
</script>

<style scoped>

.mt-cus{
    margin-top: 100px;
}

.nav-link span{
    font-weight: 400;
}
.sidebar-sm{
    width: 2.5rem;
    padding: 10px 0;
    border-bottom: 2px dashed rgb(13, 77, 0);
}

.top-icon{
    padding: 13px 0;
    border-bottom: 2px solid rgb(13, 77, 0);
    width: 100%;
}
.toggled2 img{
    display: none;
}
.toggled2 .ad-text{
    display: none;
}

.toggled2 h6{
    display: block !important;
}

</style>