<template>
    <div>
      <div class="container-fluid">
        <div class="row">

            <div class="text-center p-3 rounded table-border-dark shadow-sm " v-if="this.blogList == ''">
                <h1 class="color-white1">No Blog Post Found</h1>
            </div>

            <div class="col-md-12 rounded bg-main main-col m-0 p-3" v-else>
                <h5 class="p-3 table-border-dark bg-header color-white d-flex aling-items-center justify-content-center fw-bold aling-middle"><b-icon-signpost-2 class="d-inline text-success mr-2" width="22" height="22"></b-icon-signpost-2>All Blog Post</h5>

                <router-link class="color-white1 btn btn-sm btn-outline-primary m-2 float-start" to="/add-blog"><b-icon-plus class="d-inline text-success mr-2" width="22" height="22"></b-icon-plus>Add Post</router-link>
                <router-link class="color-white1 btn btn-sm btn-outline-primary m-2 float-end" to="/add-blog-category"><b-icon-plus class="d-inline text-success mr-2" width="22" height="22"></b-icon-plus>Add Category</router-link>

                <div class="table-responsive mt-2">

                    <table class="table table-striped rounded color-white text-center">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Post Title</th>
                                <th scope="col">City/Category</th>
                                <th scope="col">Country Name</th>
                                <th scope="col">Images</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>

                            <tr class="mx-0 px-0 my-auto" v-for="(item,i) in blogList" :key="i">
                                <th scope="row" class="align-middle">{{  pageInfo.from + i }}</th>                                <td class="fw-bold mx-0 px-0 align-middle">{{ item.blog_title }}</td>
                                <td class="fw-bold mx-0 px-0 align-middle">{{ item.title_image }}</td>
                                <td  class="mx-0 px-0 align-middle">{{ item.tag_line }}</td>
                                <td  class="mx-0 px-0 align-middle">
                                    <span v-for="(img, j) in item.images" :key="j">
                                        <img :src="img.image" height="40" class="img rounded m-2 table-border-dark" alt="">
                                    </span>

                                </td>
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
                        <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.blogList != ''" @on-change="getBlog" />
                    </div>
                    <div class="text-end d-flex">
                        <label for="perPage" class="col-form-label color-white text-end mr-3">Show List</label>
                        <select id="perPage" class="form-select-sm form-select col" v-model="this.total" @change="this.getBlog()">
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
            width="70vw"
            >
            <div class="row">

                <h5 class="p-3 table-border-dark-bottom table-border-dark-success mb-4 bg-header color-white text-center fw-bold"><b-icon-pen class="d-inline text-success mr-2" width="20" height="20"></b-icon-pen>Edit Blog Post</h5>
           
                <form class="row g-3 mx-auto" @submit.prevent="update" method="POST" @keydown="clearAllError">

                    <div class="col-md-6">
                        <label for="blog_title" class="form-label fw-bolder color-white">Blog Title</label>
                        <input type="text" name="blog_title" v-model="editdata.blog_title" class="form-control" id="blog_title" :class="hasError('blog_title') ? 'is-invalid' : '' " >
                        <div class="invalid-feedback" v-if="hasError('blog_title')">{{getError('blog_title')}}</div>
                    </div>

                    <div class="col-md-6">
                        <label for="inputCity" class="form-label fw-bolder color-white">Country Name</label>
                        <input type="text" name="tag_line" v-model="editdata.tag_line" class="form-control" id="tag_line" :class="hasError('tag_line') ? 'is-invalid' : '' ">
                        <div class="invalid-feedback" v-if="hasError('tag_line')">@{{getError('tag_line')}}</div>
                    </div>

                    <div class="col-md-12">
                        <label for="cat" class="form-label fw-bolder color-white">City/Category</label>
                        <select class="form-select" v-model="editdata.category" id="cat" :class="hasError('category') ? 'is-invalid' : '' ">
                            <option :value="cat.category" v-for="(cat,i) in blogCategory" :key="i">
                                {{ cat.category }}
                            </option>
                        </select>
                        <div class="invalid-feedback" v-if="hasError('category')">{{getError('category')}}</div>                    
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label fw-bolder color-white">Post Description</label>
                        <!-- <textarea class="form-control" name="description" v-model="editdata.description" id="description" rows="3" :class="hasError('description') ? 'is-invalid' : '' "></textarea> -->
                        <!-- <ckeditor :editor="editor" @ready="onReady" v-model="editdata.description" :config="editorConfig"></ckeditor> -->
                        <div><QuillEditor v-model:content="editdata.description" contentType="html" toolbar="full" theme="snow" /></div>
                        <div class="invalid-feedback" v-if="hasError('description')">{{getError('description')}}</div>
                    </div>
                    
                    <div class="col-md-12">

                        <div class="p-3 table-border-dark rounded" v-show="this.editdata.images">
                            <p class="color-white my-auto">Old Images:</p>
                            <div class="position-relative d-inline-flex mx-3 my-4" v-for="(img,index) in this.editdata.images" :key="index">
                                <img :src="img.image" class="rounded table-border-dark shadow-sm " width="100" alt=""> 
                                <a class="position-absolute top-0 start-100 translate-middle bg-main rounded-circle table-border-dark p-1" @click="deleteImageMul(img,index)"><b-icon-x-lg class="text-danger fw-bold" width="18"></b-icon-x-lg></a>
                            </div>

                        </div>
                        
                        <form method="POST">
                            <label for="images" class="form-label text-success mt-3">Upload New Images</label>
                            <div class="p-3 table-border-dark bg-main rounded">

                                <div class="mb-3">
                                    <label for="file-uplaod-two" class="form-label fw-bold">Upload all Images (<span class="text-sm text-primary">All Image Same Size(450 x 300) and only 5 Image Recommended</span>) </label>
                                    <input multiple class="form-control" type="file" id="file-uplaod-two" @change="fieldChange" :class="hasError('images') ? 'is-invalid' : '' ">
                                    <div class="invalid-feedback" v-if="hasError('images')">{{getError('images')}}</div>
                                </div>

                                <div v-show="this.files.length">

                                    <div class="position-relative d-inline-flex mx-3 my-4" v-for="(img,index) in this.files" :key="index">
                                        <img :src="img" class="rounded table-border-dark shadow-sm " width="100" alt=""> 
                                        <a class="position-absolute top-0 start-100 translate-middle bg-main rounded-circle table-border-dark p-1" @click="deleteImage(index)"><b-icon-x-lg class="text-danger fw-bold" width="18"></b-icon-x-lg></a>
                                    </div>

                                </div>

                            </div>
                        </form>
                        
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
                <p>Are you sure you want to delete this Post ?</p>
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
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

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
    blogList: [],
    blogCategory: [],
    total:5,
    pageInfo: null,
    editdata: {
        blog_title: '',
        tag_line: '',
        description: '',
        category: '',
        images: [],
        id: ''
    },

    data: {
        images:[]
    },

    editor: ClassicEditor,
    // editorData: '<p>Content of Blog Page.</p>',
    editorConfig: {
        ckfinder: {
            // uploadUrl: "{{ route('createBlog.upload', ['_token' => csrf_token()])}}",
            uploadUrl: 'app/createBlog/upload',
            
        },
        language: 'cs',
        image: {
            toolbar: [
            'imageTextAlternative',
            'imageStyle:side',
            ]
        },
        table: {
            contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells'
            ]
        },
    },



    }
},

methods:{

    onReady( editor )  {
            // Insert the toolbar before the editable area.
        editor.ui.getEditableElement().parentElement.insertBefore(
        editor.ui.view.toolbar.element,
        editor.ui.getEditableElement()
        )
    },

    resetAll(){
        this.editdata = {};
        this.data = {};
        this.files = '';
        document.getElementById('file-uplaod-two').value=[];
    },

    fieldChange(e){
        let selectedFiles = e.target.files;
        if(!selectedFiles.length){
            return false;
        }
        for(let i=0;i<selectedFiles.length;i++){
            this.data.images.push(selectedFiles[i]);
        }
        if(selectedFiles.length){
            Array.from(selectedFiles).forEach(file => this.addImage(file));
        }  
    // console.log(this.data.images);
    },

    addImage(file){
        if(!file.type.match('image.*')){
        this.infoMsg(`${file.name} is not an Image`);
        return;
        }

         //this.data.files.push(file);
        const reader = new FileReader();
        reader.onload = (e) => this.files.push(e.target.result);
        reader.readAsDataURL(file);
        //console.log(file);
    },

    deleteImage(index){
        this.files.splice(index,1);
        this.infoMsg("Image Removed");
    },

    async deleteImageMul(img,index){
        this.editdata.images.splice(index,1);
        const res = await this.callApi("post", `/blog/deleteImage?id=${img.id}&img=${img.image}`);
        if (res.status == 200) {
            this.infoMsg("Image Removed");
            //this.blogList = res.data;
            //console.log(this.blogList)
        } else {
            this.errorMsg();
        }
    },

    editPost(item,i){
        this.showEditeModal = true;
        this.editdata.blog_title = item.blog_title;
        this.editdata.tag_line = item.tag_line;
        this.editdata.description = item.description;
        this.editdata.category = item.title_image;
        this.editdata.images = item.images;
        this.editdata.id = item.id;
    },

    async getBlog(page){
        const res = await this.callApi("get", `/blog/all?total=${this.total}&page=${page}`);
        if (res.status == 200) {
            this.blogList = res.data.data;
            this.pageInfo = res.data;
            //console.log(this.blogList)
        } else {
            this.errorMsg();
        }
        
    },

    deletePost(item,i){
        this.showDeleteModal = true;
        this.deleteItem = item;
        this.deletingIndex = i;
    },

    async update(){
        //console.log(this.editdata);
        //console.log(this.data);
        const res = await this.callApi("post","blog/update_post", this.editdata);
        if (res.status == 200) {
            this.successMsg("Blog Post has been Updated successfully");
            this.blogList = res.data.data;
            this.pageInfo = res.data;
            if(this.data.images != ''){
                this.updateImage();
            }
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

    async updateImage(e){
        for(let i=0; i<this.data.images.length;i++){
            this.form.append('Blog_Images[]', this.data.images[i]);
        }

        this.form.append('blog_id', this.editdata.id);
        this.form.append('blog_title', this.editdata.blog_title);

        const config = { headers: { 'Content-Type': 'multipart/form-data' } };
        const res = await this.callApi("post", "blog/update/image",this.form,config)
        if(res.status === 200){
            this.blogList = res.data.data;
            this.pageInfo = res.data;
            document.getElementById('file-uplaod-two').value=[];
            this.files = [];
            this.$router.go();
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
        const res = await this.callApi("post","blog/delete_post", this.deleteItem);
        if (res.status == 200) {
            this.blogList.splice(this.deletingIndex,1);
            this.successMsg("Blog Post has been deleted successfully");
            this.showDeleteModal= false;
        } else {
            this.errorMsg();
        }
    },

    async getCategory(){
        const res = await this.callApi("get", "blog/getCategoryAll");
        if (res.status == 200) {
            this.blogCategory = res.data;
            //console.log(this.blogCategory)
        } else {
            this.errorMsg();
        } 
    },

},

mounted(){
  this.getBlog();
  this.getCategory();
}
}
</script>

<style scoped>

</style>