<template>
    <div>
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 rounded bg-header m-0 p-0">
                    <h5 class="color-white text-center fw-bold p-3 table-header-memu"><b-icon-badge-ad class="d-inline text-success mr-2" width="25" height="25"></b-icon-badge-ad>Multiple Ads</h5>
                </div>
            </div>

            <div class="row p-3 bg-main table-border-dark">

                <div class="col-md-4 col-sm-6" v-for="(image,i) in ads" :key="i">
                    <div class="text-center position-relative m-3">
                        <img :src="image.ads_path" class="img-fluid rounded" alt="">
                        <a class="mx-2 btn btn-sm px-2 position-absolute top-50 start-50 translate-middle table-border-dark" @click="deleteModal(image,i)"><b-icon-trash class="d-inline text-danger" width="20" height="20"></b-icon-trash></a>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <form method="POST">
                        <div class="p-3 table-border-dark bg-main rounded">

                            <div class="mb-3">
                                <label for="formFile" class="form-label fw-bold mb-3">Upload Your Ads <kbd>Multiple</kbd> (<span class="text-sm text-primary">500x170 px</span>) </label>
                                <input multiple class="form-control" type="file" id="file-uplaod-two" @change="fieldChange" :class="hasError('images') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('images')">{{getError('images')}}</div>
                            </div>

                            <div class="p-3 table-border-dark rounded" v-show="this.files.length">

                                <div class="position-r d-inline-flex mx-3 my-4" v-for="(img,index) in this.files" :key="index">
                                    <img :src="img" class="rounded table-border-dark shadow-sm " height="80" alt=""> 
                                    <a class="position-absolute top-0 start-100 translate-middle rounded-circle table-border-dark p-1" @click="deleteImageMul(index)"><b-icon-x-lg class="text-danger fw-bold" width="18"></b-icon-x-lg></a>
                                </div>

                            </div>

                            <div class="text-center my-4">
                                <a class="btn btn-outline-primary col-lg-3 col-md-6 col-sm-8 py-2" @click="storeImages">Upload All</a>
                            </div>

                        </div>
                    </form>
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
            @click="deleteImage"
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
        ads: null,
        showDeleteModal:false, 
        errors:{},
        form: new FormData,
        files:[],
        deleteItem: {},
        deletingIndex: -1,
        data:{
            images:[],
            id: 1,
        },
        
        }
    },

    methods:{

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

        async storeImages(){
            //console.log(this.data.images);
            for(let i=0; i<this.data.images.length;i++){
                this.form.append('Hotel_Images[]', this.data.images[i]);
            }

            this.form.append('ads_id', this.data.id);

            const config = { headers: { 'Content-Type': 'multipart/form-data' } };
            const res = await this.callApi("post", "home/store/adsImages",this.form,config)

            if(res.status === 200){
                document.getElementById('file-uplaod-two').value=[];
                this.errors = {};
                this.files = [];
                this.data = [];
                this.successMsg("Ads Images Added Successfully");
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

        async getAds() {
            const res = await this.callApi("get", "home/home/adsGet");
            if (res.status == 200) {
                this.ads = res.data;
            } else {
                this.errorMsg();
            }
        },

        deleteModal(image,i){
            this.showDeleteModal= true;
            this.deleteItem = image;
            this.deletingIndex = i;
        },

        async deleteImage(){
            const res = await this.callApi("post", "home/delete_ads", this.deleteItem);
            if (res.status == 200) {
                this.ads.splice(this.deletingIndex,1);
                this.successMsg("Ads has been deleted successfully");
                this.showDeleteModal= false;
                //this.$router.go();
            } else {
                this.errorMsg();
            } 
        },

        closeModal(){
            this.showDeleteModal= false;
        },

    },

    async created() {
        this.getAds();
    },

    }
</script>
  
<style scoped>
  
</style>