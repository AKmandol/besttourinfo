<template>
    <div>
        <div class="container">
            <div class="row">

                <div class="col-md-12 rounded bg-main m-0">

                    <h5 class="color-white text-center fw-bold p-3 bg-header mb-2 table-border-dark my-2"><b-icon-envelope-open class="d-inline text-success mr-2" width="25" height="25"></b-icon-envelope-open>Send Email</h5>

                    <div class="col-md-8 col-sm-12 mx-auto mt-3">
                        <div class="col-12 mb-3">
                            <label for="emailType" class="form-label fw-bolder color-white">Email Type</label>
                            <select class="form-select" name="emailType" id="emailType" v-model="data.emailType" :class="hasError('emailType') ? 'is-invalid' : '' ">
                                <option selected value="" disabled>Select Email Type</option>
                                <option value="0">Individual Email</option>
                                <option value="1">To All Customer</option>
                            </select>
                            <div class="invalid-feedback" v-if="hasError('emailType')">{{getError('emailType')}}</div>
                        </div>

                        <div class="col-12 mb-3" v-if="data.emailType == '0'">
                            <label for="address" class="form-label fw-bolder color-white">Email Address</label>
                            <input type="text" name="address" v-model="data.address" class="form-control" id="address" placeholder="Emter Email Address seperated by(,)" :class="hasError('address') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('address')">{{getError('address')}}</div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="subject" class="form-label fw-bolder color-white">Email Subject</label>
                            <input type="text" name="subject" v-model="data.subject" class="form-control" id="subject" placeholder="Enter Email Subject" :class="hasError('subject') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('subject')">{{getError('subject')}}</div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="message" class="form-label fw-bolder color-white">Email Body</label>
                            <div><QuillEditor v-model:content="data.message" contentType="html" toolbar="full" theme="snow" id="message" /></div>
                            <div class="invalid-feedback" v-if="hasError('message')">{{getError('message')}}</div>
                        </div>
                    </div>

                    <div class="col-md-8 col-sm-12 d-flex justify-content-center mx-auto mt-3">

                        <button @click="resetAll" type="button" class="btn btn-outline-secondary col-2 mb-4 mx-2">
                        <b-icon-arrow-repeat class="d-inline text-white mr-2" width="18" height="18"></b-icon-arrow-repeat>
                            Reset
                        </button>

                        <button  @click="send" type="submit" class="btn btn-outline-success col-2 mb-4 mx-2">
                        <b-icon-wind class="d-inline text-white mr-2" width="18" height="18"></b-icon-wind>
                            <span v-if="this.loading">Sending...</span>
                            <span v-else>Send</span>
                        </button>

                    </div>


                </div>

            </div>
        </div>
    </div>
</template>
    
<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    export default {

    data(){
        return{

            data:{
                emailType:'',
                address:'',
                subject:'',
                message:'Write message...'
            },

            loading: false,

            allUser: [],

            errors: {},

            editor: ClassicEditor,
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

        async getUser(){
            const res = await this.callApi("get", "/get_all_User");
            if (res.status == 200) {
                this.allUser = res.data;
            } else {
                this.errorMsg();
            }
        },

        resetAll(){
            this.$router.go();
        },

        async send(){
            this.loading = true;
            const res = await this.callApi("post", "email/send",this.data);
            if(res.status === 200){
                this.successMsg("Email Sent Successfully.");
                this.loading = false;
                this.resetAll();
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                    this.loading = false;
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                        this.errors = res.data.errors
                    }
                    this.loading = false;
                }
                else {
                    this.errorMsg();
                    this.loading = false;
                }
            }
        }
    },

    async created() {
        this.getUser();
    },

    }
</script>
  
<style scoped>
  
</style>