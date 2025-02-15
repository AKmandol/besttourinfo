<template>
  <div>

    <!-- Modal -->
    <div v-if="picModal" class="modal fade" id="exampleModal3" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mt-100 modal-md">
        <div class="modal-content">
            <form method="POST">
               
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-dark fw-bolder text-center w-100" id="exampleModalLabel">Upload Profile Picture</h1>
                    <span type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
                </div>

                <div class="modal-body p-4">

                    <Upload
                        :headers="{
                            'x-csrf-token': token,
                            'X-Requested-With': 'XMLHttpRequest',
                        }"
                        :show-upload-list="false"
                        type="drag"
                        action="profilePic/upload"
                        ref="uploads"
                        :on-success="handleSuccess"
                        :on-error="handleError"
                        :format="['jpg', 'jpeg', 'png']"
                        :max-size="1024"
                        :on-format-error="handleFormatError"
                        :on-exceeded-size="handleMaxSize"
                        >
                        <div style="padding: 20px 0">
                            <Icon
                            type="ios-cloud-upload"
                            size="52"
                            style="color: #3399ff"
                            ></Icon>
                            <p>Click or drag Profile-Image here to upload</p>
                        </div>
                    </Upload>
                            
                </div>

                <div class="justify-content-center m-0 p-0 border-0">
                    <button type="button" class="btn btn-sm btn-secondary col-12 mx-0 px-0 rounded-0 py-3" data-bs-dismiss="modal">Close</button>
                </div>
                
            </form>
        </div>
    </div>
    </div>

  </div>
</template>

<script>
export default {
    data(){
        return{

            picModal: true,
            token: '',

            user: this.$store.state.client,

            data:{
                images:'',
            }
        }
    },

    methods:{
        
        async deleteImage(){
            let image = this.data.images   
            console.log(this.data.images)
            this.data.images='';
            const res = await this.callApi('post', 'profile/deleteImage', {profileImage: image});
            if (res.status != 200) {
                this.errorMsg("File Deleted");
            }

        },
        
        handleSuccess(res, file) {
            this.picModal = false;
            window.location.reload();
        },

        handleError(res, file) {
            this.$Notice.warning({
            title: "The file format is incorrect",
            desc: `${file.errors.file.length ? file.errors.file[0] : "Something went wrong!"}`,
            });
        },

        handleFormatError (file) {
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png or jpeg.'
            });
        },

        handleMaxSize (file) {
            this.$Notice.warning({
                title: 'Exceeding file size limit',
                desc: 'File  ' + file.name + ' is too large, no more than 1M.'
            });
        },
            
    },

    async created(){
        this.token = window.laravel.csrfToken;
    }

}
</script>

<style scoped>

</style>