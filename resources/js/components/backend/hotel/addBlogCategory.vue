<template>
    <div>
      <div class="container mr-70">
        <div class="row bg-main p-3 rounded table-border-dark">

            <h5 class="p-3 table-border-dark mb-4 bg-header color-white text-center fw-bold"><b-icon-plus class="d-inline text-success mr-2" width="30" height="30"></b-icon-plus>Add Blog Category</h5>
        
            <form class="row g-3 mx-auto" @submit.prevent="store" method="POST" @keydown="clearAllError">

                <div class="col-md-12">
                    <label for="slug" class="form-label fw-bolder color-white">Area Name/Exact Location</label>
                    <input type="text" name="slug" v-model="data.slug" class="form-control" id="slug" :class="hasError('slug') ? 'is-invalid' : '' ">
                    <div class="invalid-feedback" v-if="hasError('slug')">{{getError('slug')}}</div>
                </div>

                <div class="col-md-12">
                    <label for="blog_category" class="form-label fw-bolder color-white">City Name/Category</label>
                    <input type="text" name="blog_category" v-model="data.blog_category" class="form-control" id="blog_category" :class="hasError('blog_category') ? 'is-invalid' : '' " >
                    <div class="invalid-feedback" v-if="hasError('blog_category')">{{getError('blog_category')}}</div>
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

export default {

    data(){
        return{
            errors:{},
            data:{
                blog_category : '',
                slug : '',
            },  

            blogCategory: [],

        }
    },

    methods:{

        resetAll(){
            this.$router.go();
        },
    
        async store(){
            console.log(this.data)
            const res = await this.callApi("post", "blog/store/category",this.data);
            if(res.status === 201){
                this.successMsg("Category Added Successfully");
                this.blogCategory = res.data;
                this.$router.push({name: 'BlogCat'});
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

    },

    async created(){
        this.token = window.laravel.csrfToken;
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