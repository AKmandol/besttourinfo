<template>
    <div>
      <div class="container-fluid mr-70">
        <div class="row bg-main p-3 rounded table-border-dark">
        
            <h5 class="p-3 table-border-dark mb-4 bg-header color-white text-center fw-bold"><b-icon-plus class="d-inline text-success mr-2" width="30" height="30"></b-icon-plus>Add Blog Post</h5>
           
            
            <form class="row g-3 mx-auto" @submit.prevent="store" method="POST" @keydown="clearAllError">

                <div class="col-md-6">
                    <label for="blog_title" class="form-label fw-bolder color-white">Blog Title</label>
                    <input type="text" name="blog_title" v-model="data.blog_title" class="form-control" id="blog_title" placeholder="Blog Title" :class="hasError('blog_title') ? 'is-invalid' : '' " >
                    <div class="invalid-feedback" v-if="hasError('blog_title')">{{getError('blog_title')}}</div>
                </div>

                <div class="col-md-6">
                    <label for="inputCity" class="form-label fw-bolder color-white">Country Name</label>
                    <input type="text" name="tag_line" v-model="data.tag_line" class="form-control" id="tag_line" placeholder="Country Name" :class="hasError('tag_line') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('tag_line')">{{getError('tag_line')}}</div>
                </div>

                <div class="col-md-12">
                    <label for="cat" class="form-label fw-bolder color-white">Area Name</label>
                    <select class="form-select" v-model="data.category" id="cat" :class="hasError('category') ? 'is-invalid' : '' ">
                        <option selected :value="cat.category" v-for="(cat,i) in blogCategory" :key="i">
                            {{ cat.category }}
                        </option>
                    </select>
                    <div class="invalid-feedback" v-if="hasError('category')">{{getError('category')}}</div>                    
                </div>

                <div class="col-md-12">
                    <label for="description" class="form-label fw-bolder color-white">Post Description</label>
                    <!-- <textarea class="form-control" name="description" v-model="data.description" id="description" rows="3" :class="hasError('description') ? 'is-invalid' : '' "></textarea> -->
                    <!-- <ckeditor :editor="editor" @ready="onReady" v-model="editorData" :config="editorConfig"></ckeditor> -->
                    <div><QuillEditor v-model:content="data.description" contentType="html" toolbar="full" theme="snow" /></div>
                    
                    <div class="invalid-feedback" v-if="hasError('description')">{{getError('description')}}</div>
                </div>
                
                <div class="col-md-12">
                    
                    <form method="POST">
                        <label for="images" class="form-label fw-bolder color-white">Blog Images</label>
                        <div class="p-3 table-border-dark bg-header rounded">

                            <div class="mb-3">
                                <label for="formFile" class="form-label fw-bold">Upload all Images (<span class="text-sm text-primary">All Image Same Size(450 x 300) and only 5 Image Recommended</span>) </label>
                                <input multiple class="form-control" type="file" id="file-uplaod-blog" @change="fieldChange" :class="hasError('images') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('images')">{{getError('images')}}</div>
                            </div>

                            <div class="p-3 table-border-dark rounded" v-show="this.files.length">

                                <div class="position-r d-inline-flex mx-3 my-4" v-for="(img,index) in this.files" :key="index">
                                    <img :src="img" class="rounded table-border-dark shadow-sm " width="100" alt=""> 
                                    <a class="position-absolute top-0 start-100 translate-middle bg-white rounded-circle table-border-dark p-1" @click="deleteImageMul(index)"><b-icon-x-lg class="text-danger fw-bold" width="18"></b-icon-x-lg></a>
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
                        Save
                    </button>

                </div>

            </form>


        </div>
          
       
      </div>
    </div>
</template>
  
<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {

    data(){
        return{
        errors:{},
        files:[],
        form: new FormData,
        token: '',
        data:{
            blog_title : '',
            tag_line : '',
            description : '',
            images: [],
            category: '',
        },  
        blogInfo: [],
        blogCategory: [],

        editor: ClassicEditor,
        editorData: '<p>Content of Blog Page.</p>',
        editorConfig: {
            ckfinder: {
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
        }




        }
    },

    methods:{

        resetAll(){
            this.$router.go();
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

        deleteImageMul(index){
            this.files.splice(index,1);
            this.infoMsg("Image Removed");
        },

        onReady( editor )  {
             // Insert the toolbar before the editable area.
            editor.ui.getEditableElement().parentElement.insertBefore(
            editor.ui.view.toolbar.element,
            editor.ui.getEditableElement()
            )
        },
            
        async store(){
            // this.data.description = this.editorData;
            const res = await this.callApi("post", "blog/store",this.data);
            if(res.status === 201){
                this.successMsg("Blog Post Added Successfully");
                this.blogInfo = res.data;
                this.storeImages();
                this.blogInfo = res.data;
                this.$router.push({name: 'Blog'});
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

        async storeImages(){

            for(let i=0; i<this.data.images.length;i++){
                this.form.append('Blog_Images[]', this.data.images[i]);
            }
            this.form.append('blog_id', this.blogInfo.id);
            this.form.append('blog_title', this.data.blog_title);

            const config = { headers: { 'Content-Type': 'multipart/form-data' } };
            const res = await this.callApi("post", "blog/store/image",this.form,config)

            if(res.status === 200){
                //document.getElementById('file-uplaod-blog').value = '';
                this.errors = {};
                this.files = [];
                this.data = [];
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

    async created(){
        this.token = window.laravel.csrfToken;
    },

    async mounted(){
        this.getCategory();
    }

}
</script>

<style scoped>
.mr-70 {
margin-top: 20px;
margin-bottom: 20px;
}

.position-r{
    position:  relative !important;
}
</style>