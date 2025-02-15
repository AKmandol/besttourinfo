<template>
  <div>
    <nav class="navbar navbar-expand navbar-dark nav-bg-color topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Dark Light -->
            <li class="nav-item">
                <a class="nav-link" @click="toggleTheme">
                    <i class="fas fa-sun color-main2 fs-5" v-if="currentTheme === 'dark'"></i>
                    <i class="fas fa-cloud-moon color-main2 fs-5" v-if="currentTheme === 'light'"></i>
                </a>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw color-main2 fs-5 mr-3 mt-1"></i>
                    <h1 v-if="totalNotifications > 0" class="badge text-warning bg-main2 badge-counter ml-2 fs-6">{{ totalNotifications }}</h1>
                </a>
               
                <div class="dropdown-list dropdown-menu dropdown-menu-right dropdown-menu-dark bg-header table-border-dark" aria-labelledby="alertsDropdown" v-if="totalNotifications > 0">
                    <h6 class="p-3 bg-dark text-center">
                        <i class="fas fa-bell text-warning mr-2"></i>ORDER NOTIFICATIONS
                    </h6>
                    <router-link to="/booking" class="dropdown-item d-flex align-items-center" @click="clearNotification('nt_hotel_order')" v-if="this.$store.state.user.nt_hotel_order > 0">
                        <div class="mr-3">
                            <div class="icon-circle bg-light">
                                <i class="fas fa-home text-success"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small color-main"><i class="fas fa-clock mr-2 color-white"></i>{{this.$store.state.user.nt_hotel_order_date}}</div>
                            <span class="font-weight-bold color-white"> <span class="text-warning">{{this.$store.state.user.nt_hotel_order}}</span>  New Hotel Booking has been recived!</span>
                        </div>
                    </router-link>
                    <hr class="table-border-dark">
                    <router-link to="/cars-rent" class="dropdown-item d-flex align-items-center" @click="clearNotification('nt_car_order')" v-if="this.$store.state.user.nt_car_order > 0">
                        <div class="mr-3">
                            <div class="icon-circle bg-light">
                                <i class="fas fa-car text-success"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small color-main"><i class="fas fa-clock color-white mr-2"></i>{{this.$store.state.user.nt_car_order_date}}</div>
                            <span class="font-weight-bold color-white"><span class="text-warning">{{this.$store.state.user.nt_car_order}}</span> New Car Order has been recived!</span>
                        </div>
                    </router-link>
                    <a class="dropdown-item text-center small" @click="markAllAsRead()"><span class="color-white">Mark all as read</span></a>
                </div>
                <div class="dropdown-list dropdown-menu dropdown-menu-right dropdown-menu-dark table-border-dark" aria-labelledby="alertsDropdown" v-else>
                    <p class="p-3 bg-dark text-center">
                        No Order has been made currently
                    </p>
                </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline color-white small">{{this.$store.state.user.name}}</span>
                    <img class="img-profile rounded-circle border border-success p-1"
                        src="img/fav.png">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-dark table-border-dark shadow"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 color-main"></i>
                        <span class="color-white">Profile</span>
                    </a>
                    
                    <div class="dropdown-divider table-border-dark"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 color-main"></i>
                        <span class="color-white">Logout</span>
                    </a>

                    <div class="dropdown-divider table-border-dark"></div>
                    <a href="/" target="_blank" class="dropdown-item" >
                        <i class="fas fa-arrow-left fa-sm fa-fw mr-2 color-main"></i>
                        <span class="color-white">Back to home</span>
                    </a>
                </div>
            </li>

        </ul>

    </nav>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    components: {
    },

    data() {
        return {
            data:{}
        };
    },

    computed: {
        ...mapGetters(['currentTheme']),

        totalNotifications() {
            return (
                (this.$store.state.user.nt_hotel_order || 0) +
                (this.$store.state.user.nt_car_order || 0)
            );
        },
    },

    watch: {
        currentTheme(newTheme) {
            this.applyTheme(newTheme);
        }
    },

    methods: {
        ...mapActions(['toggleTheme']),

        applyTheme(theme) {
            const darkThemeLink = document.getElementById('dark-theme');
            const lightThemeLink = document.getElementById('light-theme');

            if (theme === 'dark') {
                darkThemeLink.disabled = false;
                lightThemeLink.disabled = true;
                this.data.logo = this.data.logo1;
            } else {
                darkThemeLink.disabled = true;
                lightThemeLink.disabled = false;
                this.data.logo = this.data.logo2;
            }

        },

        async markAllAsRead(){
            const res = await this.callApi("get", "mark/all/as/read");
            if (res.status == 200) {
                this.$store.state.user.nt_hotel_order = 0;
                this.$store.state.user.nt_car_order = 0;
                this.successMsg("All notifications are cleared.");
            } else {
                this.errorMsg();
            }
        },

        async clearNotification(text){
            const res = await this.callApi("post", "clear/notification", {type:text});
            if (res.status == 200) {
                if(text == 'nt_car_order'){
                    this.$store.state.user.nt_car_order = 0;
                }
                if(text == 'nt_hotel_order'){
                    this.$store.state.user.nt_hotel_order = 0;
                }
            } else {
                this.errorMsg();
            }
        }
    },

    mounted() {
        this.applyTheme(this.currentTheme);
    },
 
    created() {},
};

</script>

<style>
.navbar {
    height: 100%;
}

.dropdown-menu-dark{
    overflow: hidden;
}

</style>