<template>
    <div>
        <div class="container-fluid">
            <div class="row p-3 bg-main rounded">
                <div class="col-md-12 rounded m-0 p-3"> 
                    <h4 class="color-white text-center fw-bold p-3 table-border-dark"><b-icon-vr class="d-inline text-success mr-2" width="22" height="22"></b-icon-vr> Tearms and condition</h4>

                    <div class="text-start">
                        <a @click="showAddeModal = true" class="my-3 btn btn-outline-light fw-bold table-border-dark shadow-sm"><b-icon-plus class="d-inline mr-1 text-primary" width="22" height="22"></b-icon-plus><span class="color-white">Add Tearms and Condition</span></a>
                    </div>
                
                    <div class="table-responsive">

                        <table class="table table-striped rounded color-white text-center">
                            <thead>
                                <tr>
                                    <th class="col-1">SL</th>
                                    <th class="col-2">Action</th>
                                    <th class="col-2">Title</th>
                                    <th class="col-7">Description</th>
                                </tr>
                            </thead>
                            
                            <tbody>

                                <tr class="mx-0 px-0 my-auto" v-for="(t,i) in terms" :key="i">
                                    <th scope="row" class="align-middle">{{  pageInfo.from + i }}</th>
                                    <td  class="mx-0 px-0 my-auto align-middle">
                                        <a @click="editModal(t,i)" class="mx-2 btn btn-sm btn-outline-primary px-2 m-1"><b-icon-pencil-square class="d-inline mr-1" width="16" height="16"></b-icon-pencil-square></a>
                                        <a v-if="this.$store.state.user.userType == 'admin' || this.$store.state.user.userType == 'super'" @click="deleteModal(t,i)" class="mx-2 btn btn-sm btn-outline-danger px-2"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                                    </td>
                                    <td class="fw-bold align-middle">{{ t.title }}</td>
                                    <td  class="align-middle text-start data" v-html="t.text"></td>
                                </tr>
                                
                            </tbody>
                        </table>

                    </div>

                    <div class="d-flex justify-content-between my-3">
                        <div class="text-start">
                            <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.terms != ''" @on-change="getAll" />
                        </div>
                        <div class="text-end d-flex">
                            <label for="perPage" class="col-form-label color-white text-end mr-3">Show List</label>
                            <select id="perPage" class="form-select-sm form-select col" v-model="this.total" @change="this.getAll()">
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


        <!-- Add Moadal -->
        <Modal
            v-model="showAddeModal"
            :mask-closable="false"
            footer-hide	
            width="50vw"
            >
            <div class="row">

                <h5 class="p-3 table-border-dark mb-4 bg-header color-white text-center fw-bold"><b-icon-plus class="d-inline text-success mr-2" width="20" height="20"></b-icon-plus>Add Terms and condition</h5>
           
                <form class="row g-3 mx-auto" @submit.prevent="add" method="POST" @keydown="clearAllError">

                    <div class="col-md-12">
                        <label for="title" class="form-label fw-bolder color-white">Terms Title</label>
                        <input type="text" name="title" v-model="data.title" class="form-control" id="title" :class="hasError('title') ? 'is-invalid' : '' " >
                        <div class="invalid-feedback" v-if="hasError('title')">{{getError('title')}}</div>
                    </div>

                    <div class="col-md-12">
                        <label for="text" class="form-label fw-bolder color-white">Terms Description</label>
                        <!-- <ckeditor :editor="editor" @ready="onReady" v-model="editorData" :config="editorConfig" :class="hasError('text') ? 'is-invalid' : '' "></ckeditor> -->
                        <div><QuillEditor v-model:content="editorData" contentType="html" toolbar="full" theme="snow" /></div>
                        <div class="invalid-feedback" v-if="hasError('text')">{{getError('text')}}</div>
                    </div>


                    <div class="col-12 mt-5 text-center">


                        <button type="submit" class="btn btn-outline-primary px-4 mb-4 fw-bold">
                        <b-icon-plus-circle-dotted class="d-inline text-success mr-2" width="18" height="18"></b-icon-plus-circle-dotted>
                            Add
                        </button>

                    </div>

                </form>

            </div>
        </Modal>

        <!-- Edit Moadal -->
        <Modal
            v-model="showEditeModal"
            :mask-closable="false"
            footer-hide	
            width="50vw"
            >
            <div class="row">

                <h5 class="p-3 table-border-dark mb-4 bg-header color-white text-center fw-bold"><b-icon-pencil-square class="d-inline text-success mr-2" width="20" height="20"></b-icon-pencil-square>Edit Terms and condition</h5>
           
                <form class="row g-3 mx-auto" @submit.prevent="update" method="POST" @keydown="clearAllError">

                    <div class="col-md-12">
                        <label for="title" class="form-label fw-bolder color-white">Terms Title</label>
                        <input type="text" name="title" v-model="editData.title" class="form-control" id="title" :class="hasError('title') ? 'is-invalid' : '' " >
                        <div class="invalid-feedback" v-if="hasError('title')">{{getError('title')}}</div>
                    </div>

                    <div class="col-md-12">
                        <label for="text" class="form-label fw-bolder color-white">Terms Description</label>
                        <!-- <ckeditor :editor="editor" @ready="onReady" v-model="editData.text" :config="editorConfig" :class="hasError('text') ? 'is-invalid' : '' "></ckeditor> -->
                        <div><QuillEditor v-model:content="editData.text" contentType="html" toolbar="full" theme="snow" /></div>
                        <div class="invalid-feedback" v-if="hasError('text')">{{getError('text')}}</div>
                    </div>


                    <div class="col-12 mt-5 text-center">


                        <button type="submit" class="btn btn-outline-primary px-4 mb-4 fw-bold">
                        <b-icon-cloud-arrow-down class="d-inline text-success mr-2" width="18" height="18"></b-icon-cloud-arrow-down>
                            Update
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
                <p>Are you sure you want to delete this Terms ?</p>
            </div>
            <template #footer>
                <button type="default" class="btn btn-outline-secondary btn-sm" @click="this.showDeleteModal = false">Close</button>
                <button @click="deleteData()" class="btn btn-outline-danger btn-sm">Delete</button>
            </template>
        </Modal>



    </div>
</template>

<script>
//import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
    data(){
        return{
            //editor: ClassicEditor,
            editorData: '<p>Content of Terms and Condition Page.</p>',
            // editorConfig: {
            //     ckfinder: {
            //         uploadUrl: 'app/createBlog/upload',
            //     },
            //     language: 'cs',
                
            //     table: {
            //         contentToolbar: [
            //         'tableColumn',
            //         'tableRow',
            //         'mergeTableCells'
            //         ]
            //     },
            // },
            errors:{},
            showEditeModal: false,
            showDeleteModal: false,
            showAddeModal: false,

            terms:[],

            data:{
                title: '',
                text: ''
            },

            deleteItem: {},
            deletingIndex: -1,
            
            editData:{
                title: '',
                text: '',
                id:''
            },

            total:4,
            pageInfo: null,
            
        }
    },

    methods:{
        async add(){
            this.data.text = this.editorData;
            const res = await this.callApi("post","add/tearm", this.data);
            if (res.status == 200) {
                this.successMsg("Terms and condition has been Added successfully");
                this.getAll();
                this.data.text ='';
                this.data.title ='';
                this.editorData ='';
                this.showAddeModal= false;
            }else{
                if (res.status === 422) {
                    for(let i in res.data.errors){
                        this.errorMsg(res.data.errors[i][0])
                        this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
             
        },

        deleteModal(t,i){
            this.showDeleteModal = true;
            this.deleteItem = t;
            this.deletingIndex = i;
        },

        async deleteData(){
            const res = await this.callApi("post","delete/terms", this.deleteItem);
            if (res.status == 200) {
                this.terms.splice(this.deletingIndex,1);
                this.successMsg("Terms has been deleted successfully");
                this.showDeleteModal= false;
                this.getAll();
            } else {
                this.errorMsg();
            }
        },

        editModal(t,i){
            this.errors = {};
            this.showEditeModal = true;
            this.editData.title = t.title;
            this.editData.text = t.text;
            this.editData.id = t.id;
        },

        async update(){
            const res = await this.callApi("post","terms/update", this.editData);
            if (res.status == 200) {
                this.successMsg("Terms has been Updated successfully");
                this.terms = res.data.data;
                this.pageInfo = res.data;
                // this.pageInfo = res.data;
                this.showEditeModal= false;
            }else{
                if (res.status === 422) {
                    for(let i in res.data.errors){
                        this.errorMsg(res.data.errors[i][0])
                        this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },

        async getAll(page){
            const res = await this.callApi("get",`get/tearm?total=${this.total}&page=${page}`);
            if (res.status == 200) {
                this.terms = res.data.data;
                this.pageInfo = res.data;
                //console.log(this.terms)
            } else {
                this.errorMsg();
            }
        }
    },

    created(){
        this.getAll();
    }

}
</script>

<style scoped>
.m-70 {
  margin-top: 100px;
  margin-bottom: 20px;
}
</style>