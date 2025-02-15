<template>
    <div>
        <div class="container-fluid">

            <div class="text-center p-3 rounded table-border-dark shadow-sm " v-if="this.sunbscribersList == ''">
                <h1 class="color-white">No List Found</h1>
            </div>

        <div class="row bg-main" v-else>

            <div class="col-md-12 rounded m-0 p-3">

                <h5 class="color-white text-center fw-bold p-3 bg-header table-border-dark"><b-icon-people class="d-inline text-success mr-2" width="25" height="25"></b-icon-people>All Subscriber</h5>

                <div class="table-responsive mt-2">

                    <table class="table table-striped text-center mb-0">

                    <thead>
                        <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr v-for="(subscriber,i) in sunbscribersList" :key="i">
                            <th scope="row" class="align-middle">{{  pageInfo.from + i }}</th>
                            <td>{{ subscriber.email }}</td>
                        <td>
                            <a v-if="this.$store.state.user.userType == 'admin' || this.$store.state.user.userType == 'super'" class="mx-2 btn btn-sm btn-outline-danger px-2 my-auto" @click="deleteModal(subscriber,i)"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                            <a class="mx-2 btn btn-sm btn-outline-success px-2 my-auto" @click="copy(subscriber,i)"><b-icon-scissors class="d-inline text-white" width="16" height="16"></b-icon-scissors> Copy Email</a>
                        </td>
                        </tr>
                        
                    </tbody>

                    </table>

                </div>
            </div>

            <div class="d-flex justify-content-between my-3">
                <div class="text-start">
                    <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="getSubList" v-if="pageInfo" />
                </div>
                <div class="text-end d-flex">
                    <label for="perPage" class="col-form-label color-white text-end mr-3">Show List</label>
                    <select id="perPage" class="form-select-sm form-select col" v-model="this.total" @change="this.getSubList()">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="3000">All</option>
                    </select>
                </div>
            </div>
            

        </div>
        </div>

        <!-- Delete Modal -->
        <Modal
        v-model="showDeleteModal"
        :mask-closable="false"
        width="360"
        >
        <template #header>
            <p class="d-flex align-items-center justify-content-center " style="color: red; text-align: center; min-height:40px">
            <Icon type="md-alert" size="32" />
            <span class="ml-2">Delete confirmation</span>
            </p>
        </template>
        <div style="text-align: center; color: black">
            <p>Are you sure you want to delete this ?</p>
        </div>
        <template #footer>
            <Button type="default" @click="closeModal">Close</Button>
            <Button
            type="error"
            @click="deleteSubs()"
            >Delete</Button
            >
        </template>
        </Modal>

    </div>
</template>
    
<script>

    export default {

    data(){
        return{
        data:{
            
        },
        sunbscribersList: [],
        showDeleteModal: false,
        deleteItem: {},
        deletingIndex: -1,
        total: 10,
        pageInfo: null,
        }
    },

    methods:{

        async getSubList(page) {
        const res = await this.callApi("get", `app/get_subscriber?page=${page}&total=${this.total}`);
        if (res.status == 200) {
            this.sunbscribersList = res.data.data;
            this.pageInfo = res.data;
        } else {
            this.errorMsg();
        }
        },

        deleteModal(subscriber,i){
        this.showDeleteModal= true;
        this.deleteItem = subscriber;
        this.deletingIndex = i;
        },

        async deleteSubs(){
        const res = await this.callApi("post", "app/delete_subscriber", this.deleteItem);
        if (res.status == 200) {
            this.sunbscribersList.splice(this.deletingIndex,1);
            this.successMsg("Subscriber has been deleted successfully");
            this.showDeleteModal= false;
            this.sunbscribersList = res.data.data;
            this.pageInfo = res.data;
            //this.$router.go();
        } else {
            this.errorMsg();
        } 
        },

        closeModal(){
        this.showDeleteModal= false;
        },

        copy(subscriber, i){
        let copyText = subscriber.email;
        navigator.clipboard.writeText(copyText);
        this.successMsg("Email Address Copied");
        }
    },

    async created() {
        this.getSubList();
    },

    }
</script>
  
<style scoped>
  
</style>