<template>
    <div>
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 rounded bg-header  m-0 p-0">
                    <h5 class="color-white text-center fw-bold p-3"><b-icon-badge-ad class="d-inline text-success mr-2" width="25" height="25"></b-icon-badge-ad>Top HTML Ads</h5>
                </div>
            </div>
       
            <div class="row p-3 color-main table-border-dark">

                <div class="row mx-auto text-center py-4 table-border-dark my-3 rounded">

                   
                    <div class="col-2 my-auto">
                        <h6 class="color-white fw-bold"> Ad One: </h6>
                    </div>
                    <div class="col-10 my-auto p-4" v-for="(ads,i) in allAds" :key="i" v-html="ads.ad_one">
                    </div>
                   

                    <div class="col-2 my-auto">
                        <h6 class="text-success fw-bold"> Update new Ad One: </h6>
                    </div>
                    <div class="col-7 my-auto">
                        <textarea class="form-control" name="ad_one" v-model="data.ad_one" id="ad_one" rows="2" :class="hasError('ad_one') ? 'is-invalid' : '' "></textarea>
                        <div class="invalid-feedback" v-if="hasError('ad_one')">{{getError('ad_one')}}</div>
                    </div>
                    <div class="col-3 my-auto">
                        <a @click="updateAds(item,i)" class="mx-2 btn btn-sm btn-outline-primary px-2 m-1" data-toggle="modal" data-target="#editModal"><b-icon-plus-square class="d-inline mr-1" width="16" height="16"></b-icon-plus-square> Update </a>
                        <a @click="deleteOne()" class="mx-2 btn btn-sm btn-outline-danger px-2"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                    </div> 
                   
                </div>

                <div class="row mx-auto text-center py-4 table-border-dark my-3 rounded">

                   
                    <div class="col-2 my-auto">
                        <h6 class="color-white fw-bold"> Ad Two: </h6>
                    </div>
                    <div class="col-10 my-auto p-4" v-for="(ads,i) in allAds" :key="i" v-html="ads.ad_two">
                    </div>
                   

                    <div class="col-2 my-auto">
                        <h6 class="text-success fw-bold"> Update new Ad Two: </h6>
                    </div>
                    <div class="col-7 my-auto">
                        <textarea class="form-control" name="ad_two" v-model="data.ad_two" id="ad_two" rows="2" :class="hasError('ad_two') ? 'is-invalid' : '' "></textarea>
                        <div class="invalid-feedback" v-if="hasError('ad_two')">{{getError('ad_two')}}</div>
                    </div>
                    <div class="col-3 my-auto">
                        <a @click="updateAds(item,i)" class="mx-2 btn btn-sm btn-outline-primary px-2 m-1" data-toggle="modal" data-target="#editModal"><b-icon-plus-square class="d-inline mr-1" width="16" height="16"></b-icon-plus-square> Update </a>
                        <a @click="deleteTwo()" class="mx-2 btn btn-sm btn-outline-danger px-2"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                    </div> 
                   
                </div>

                <div class="row mx-auto text-center py-4 table-border-dark my-3 rounded">

                   
                    <div class="col-2 my-auto">
                        <h6 class="color-white fw-bold"> Ad Three: </h6>
                    </div>
                    <div class="col-10 my-auto p-4" v-for="(ads,i) in allAds" :key="i" v-html="ads.ad_three">
                    </div>
                   

                    <div class="col-2 my-auto">
                        <h6 class="text-success fw-bold"> Update new Ad Three: </h6>
                    </div>
                    <div class="col-7 my-auto">
                        <textarea class="form-control" name="ad_three" v-model="data.ad_three" id="ad_three" rows="2" :class="hasError('ad_three') ? 'is-invalid' : '' "></textarea>
                        <div class="invalid-feedback" v-if="hasError('ad_three')">{{getError('ad_three')}}</div>
                    </div>
                    <div class="col-3 my-auto">
                        <a @click="updateAds(item,i)" class="mx-2 btn btn-sm btn-outline-primary px-2 m-1" data-toggle="modal" data-target="#editModal"><b-icon-plus-square class="d-inline mr-1" width="16" height="16"></b-icon-plus-square> Update </a>
                        <a @click="deleteThree()" class="mx-2 btn btn-sm btn-outline-danger px-2"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
                    </div> 
                   
                </div>

                <div class="row mx-auto text-center py-4 table-border-dark my-3 rounded">

                   
                    <div class="col-2 my-auto">
                        <h6 class="color-white fw-bold"> Ad Four: </h6>
                    </div>
                    <div class="col-10 my-auto p-4" v-for="(ads,i) in allAds" :key="i" v-html="ads.ad_four">
                    </div>
                   

                    <div class="col-2 my-auto">
                        <h6 class="text-success fw-bold"> Update new Ad Four: </h6>
                    </div>
                    <div class="col-7 my-auto">
                        <textarea class="form-control" name="ad_four" v-model="data.ad_four" id="ad_four" rows="2" :class="hasError('ad_four') ? 'is-invalid' : '' "></textarea>
                        <div class="invalid-feedback" v-if="hasError('ad_four')">{{getError('ad_four')}}</div>
                    </div>
                    <div class="col-3 my-auto">
                        <a @click="updateAds(item,i)" class="mx-2 btn btn-sm btn-outline-primary px-2 m-1" data-toggle="modal" data-target="#editModal"><b-icon-plus-square class="d-inline mr-1" width="16" height="16"></b-icon-plus-square> Update </a>
                        <a @click="deleteFour()" class="mx-2 btn btn-sm btn-outline-danger px-2"><b-icon-trash class="d-inline" width="16" height="16"></b-icon-trash></a>
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
            <p>Are you sure you want to delete this Ads?</p>
        </div>
        <template #footer>
            <Button type="default" @click="closeModal">Close</Button>
            <Button
            type="error"
            @click="deleteAds()"
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
        showDeleteModal:false, 
        token: "",
        error: false,
        errors:{},
        allAds: [],
        deleteValue: {
            value: ''
        },
        data:{
           ad_one: '',
           ad_two: '',
           ad_three: '',
           ad_four: '',
           id: 1,
        },
        
        }
    },

    methods:{

        async updateAds(item,i) {
            const res = await this.callApi("post", "home/topTwoAds/Upload",this.data);
            if (res.status == 200) {
                this.allAds = res.data;
                this.successMsg("Ads Updated Successfully");
                this.$router.go();
            } else {
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

        deleteOne() {
            this.deleteValue.value = "1";
            this.showDeleteModal = true;
        },

        deleteTwo() {
            this.deleteValue.value = "2";
            this.showDeleteModal = true;
        },

        deleteThree() {
            this.deleteValue.value = "3";
            this.showDeleteModal = true;
        },

        deleteFour() {
            this.deleteValue.value = "4";
            this.showDeleteModal = true;
        },


        async deleteAds() {
            const res = await this.callApi("post", "home/html/delete", this.deleteValue);
            if (res.status == 200) {
                this.allAds = res.data;
                this.successMsg("Ads Deleted Successfully");
                this.showDeleteModal = false;
            } else {
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
        
        async getallAds() {
            const res = await this.callApi("get", "home/home/topTwoAdsGet");
            if (res.status == 200) {
                this.allAds = res.data;
                //console.log(this.allAds)
            } else {
                this.errorMsg();
            }
        },

        closeModal(){
         this.showDeleteModal= false;
        },

    },

    async created() {
        this.token = window.laravel.csrfToken;
        this.getallAds();
    },

    }
</script>
  
<style scoped>
</style>