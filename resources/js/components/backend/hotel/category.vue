<template>
    <div>
      <div class="container-fluid">
        <div class="row">

            <div class="text-center p-3 rounded table-border-dark shadow-sm " v-if="this.blogCategory == ''">
                <h1 class="color-white1">No Blog Category Found</h1>
            </div>

            <div class="col-md-12 rounded bg-main main-col m-0 p-3" v-else>
                <h5 class="p-3 table-border-dark bg-header color-white d-flex aling-items-center justify-content-center fw-bold aling-middle"><b-icon-signpost-2 class="d-inline text-success mr-2" width="22" height="22"></b-icon-signpost-2>All Blog Category</h5>

                <router-link class="color-white1 btn btn-sm btn-outline-primary m-2 float-start" to="/add-blog"><b-icon-plus class="d-inline text-success mr-2" width="22" height="22"></b-icon-plus>Add Post</router-link>
                <router-link class="color-white1 btn btn-sm btn-outline-primary m-2 float-end" to="/add-blog-category"><b-icon-plus class="d-inline text-success mr-2" width="22" height="22"></b-icon-plus>Add Category</router-link>

                <div class="table-responsive">

                    <table class="table table-striped rounded color-white text-center">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Area Name/Exact Location</th>
                                <th scope="col">City Name/Category</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>

                            <tr class="mx-0 px-0 my-auto" v-for="(item,i) in blogCategory" :key="i">
                                <th scope="row" class="align-middle">{{  pageInfo.from + i }}</th>                                <td  class="mx-0 px-0 align-middle">{{ item.slug }}</td>
                                <td class="fw-bold mx-0 px-0 align-middle">{{ item.category }}</td>
                                <td  class="mx-0 px-0 my-auto">
                                    <a @click="editPost(item,i)" class="mx-2 btn btn-sm btn-outline-primary px-2 m-1" data-toggle="modal" data-target="#editModal"><b-icon-pencil-square class="d-inline mr-1" width="16" height="16"></b-icon-pencil-square></a>
                                    <a v-if="this.$store.state.user.userType == 'admin' || this.$store.state.user.userType == 'super'" @click="deletePost(item,i)" class="mx-2 btn btn-sm btn-outline-danger px-2"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>

                </div>

                <div class="d-flex justify-content-between my-3">
                    <div class="text-start">
                        <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.blogCategory != ''" @on-change="getCategory" />
                    </div>
                    <div class="text-end d-flex">
                        <label for="perPage" class="col-form-label color-white text-end mr-3">Show List</label>
                        <select id="perPage" class="form-select-sm form-select col" v-model="this.total" @change="this.getCategory()">
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
      </div>

        <!-- Edit Moadal -->
        <Modal
            v-model="showEditeModal"
            :mask-closable="false"
            footer-hide	
            width="50vw"
            >
            <div class="row">

                <h5 class="p-3 table-border-dark mb-4 bg-header color-white text-center fw-bold"><b-icon-pen class="d-inline text-success mr-2" width="20" height="20"></b-icon-pen>Edit Blog Post</h5>
           
                <form class="row g-3 mx-auto" @submit.prevent="update" method="POST" @keydown="clearAllError">

                    <div class="col-md-12">
                        <label for="name" class="form-label fw-bolder color-white">City Name/Category</label>
                        <input type="text" name="name" v-model="editdata.name" class="form-control" id="name" :class="hasError('name') ? 'is-invalid' : '' " >
                        <div class="invalid-feedback" v-if="hasError('name')">{{getError('name')}}</div>
                    </div>

                    <div class="col-md-12">
                        <label for="slug" class="form-label fw-bolder color-white">Area Name/Exact Location</label>
                        <input type="text" name="slug" v-model="editdata.slug" class="form-control" id="slug" :class="hasError('slug') ? 'is-invalid' : '' ">
                        <div class="invalid-feedback" v-if="hasError('slug')">{{getError('slug')}}</div>
                    </div>

                    <div class="col-12 mt-5 text-center d-flex justify-content-between">

                        <button @click="resetAll" type="button" class="btn btn-outline-secondary text-center col-2 mx-auto mb-4">
                        <b-icon-arrow-repeat class="d-inline text-white mr-2" width="18" height="18"></b-icon-arrow-repeat>
                            Reset
                        </button>

                        <button type="submit" class="btn btn-outline-primary text-center col-6 mx-auto mb-4">
                        <b-icon-save class="d-inline text-white mr-2" width="18" height="18"></b-icon-save>
                            update
                        </button>

                    </div>

                </form>

            </div>
        </Modal>

        <!-- delete Moadal -->
        <Modal
            v-model="showDeleteModal"
            :mask-closable="false"
            width="360"
            >
            <template #header>
                <p class="d-flex align-items-center justify-content-center" style="color: red; text-align: center; min-height:40px">
                <Icon type="md-alert" size="34" />
                <span class="ml-2 fw-bolder text-warnning fs-6">Delete confirmation</span>
                </p>
            </template>
            <div class="color-white">
                <p>Are you sure you want to delete this Category ?</p>
            </div>
            <template #footer>
                <button type="default" class="btn btn-outline-secondary btn-sm" @click="this.showDeleteModal = false">Close</button>
                <button @click="deleteBlog()" class="btn btn-outline-danger btn-sm">Delete</button>
            </template>
        </Modal>


    </div>
</template>
  
<script>
import { update } from 'lodash';

export default {   
data(){
    return{
    showDeleteModal: false,
    errors:{},
    files:[],
    form: new FormData,
    showEditeModal: false,
    deleteItem: {},
    deletingIndex: -1,
    blogCategory: [],
    total:5,
    pageInfo: null,
    editdata: {
        name: '',
        slug: '',
        id: ''
    },

    }
},

methods:{

    

    resetAll(){
        this.editdata = {};
    },

    editPost(item,i){
        this.showEditeModal = true;
        this.editdata.name = item.category;
        this.editdata.slug = item.slug;
        this.editdata.id = item.id;
    },

    deletePost(item,i){
        this.showDeleteModal = true;
        this.deleteItem = item;
        this.deletingIndex = i;
    },

    async update(){
        //console.log(this.editdata);
        //console.log(this.data);
        const res = await this.callApi("post","blog/update_Category", this.editdata);
        if (res.status == 200) {
            this.successMsg("Category been Updated successfully");
            this.blogCategory = res.data.data;
            this.pageInfo = res.data;
            this.showEditeModal= false;
        }else {
            if(res.status === 401){
                this.errorMsg(res.data.msg);
            }else if (res.status === 422) {
                for(let i in res.data.errors){
                this.errors = res.data.errors
                }
            }
            else {
                this.errorMsg();
            }
        }
    },

    async deleteBlog(){
        //console.log(this.deleteItem);
        const res = await this.callApi("post","blog/delete_category", this.deleteItem);
        if (res.status == 200) {
            this.blogCategory.splice(this.deletingIndex,1);
            this.successMsg("Category been deleted successfully");
            this.showDeleteModal= false;
        } else {
            this.errorMsg();
        }
    },

    async getCategory(page){
        const res = await this.callApi("get", `blog/getCategory?total=${this.total}&page=${page}`);
        if (res.status == 200) {
            this.blogCategory = res.data.data;
            this.pageInfo = res.data;
            //console.log(this.blogCategory)
        } else {
            this.errorMsg();
        } 
    },

},

mounted(){
  this.getCategory();
}
}
</script>

<style scoped>

</style>