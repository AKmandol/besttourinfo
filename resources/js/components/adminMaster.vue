<template>
    <div>
        <div id="wrapper">

            <!-- Sidebar -->
            <div v-if="this.$store.state.user">
                <sideBar></sideBar>
            </div>
            <!-- End of Sidebar -->

          
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <div v-if="this.$store.state.user">
                        <Navbar></Navbar>
                    </div>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <router-view></router-view>
                    </div>
                    <!-- /.container-fluid -->

                </div>
               <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="py-3 copyright">
                    <div class="container my-auto">
                        <div class="text-center my-auto">
                            <span>Copyright &copy; <span class="copyright-text fw-bold">BestTourInfo.</span> {{ new Date().getFullYear() }} </span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- End of Scroll to Top Button-->

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bloder color-white" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-danger">×</span>
                        </button>
                    </div>
                    <div class="modal-body color-white">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-outline-success mx-cus" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-sm btn-outline-danger mx-cus" href="app/admin_logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>



    </div>
</template>

<script>
import Navbar from '../components/backend/nav.vue'
import sideBar from '../components/backend/sidenav.vue'
export default {
    props: [
        'user'
    ],

    components: {
        Navbar,
        sideBar
    },

    data(){
        return{
            islogged: true,
        }
    },

    created(){
        this.$store.commit('setUpdateUser', this.user)
    }
}
</script>

<style>
.marginY {
    margin-top: 40px;
    margin-bottom: 200px;
}
.mt-100 {
    margin-top: 100px;
}

.mx-cus{
    margin: 3px !important;
}
 

.search{
    position: relative;
    box-shadow: 0 0 40px rgba(51, 51, 51, .1);   
}

.search input{
    height: 40px;
    text-indent: 25px;
}


.search input:focus{
    box-shadow: none;
}

.search .fa-search{
    position: absolute;
    top: 15px;
    left: 16px;
}

.search button{
    position: absolute;
    top: 5px;
    right: 5px;
    height: 30px;
    background: rgb(29, 85, 3);
    font-size: 13px;
    color:#fde1cb;
}

.scroll-to-top{
    background: linear-gradient(0deg, rgba(151, 91, 0, 0.89), rgba(0, 85, 0, 0.89));
}

#wrapper {
    height: 100vh !important;  
    overflow-y: scroll;
}

</style>