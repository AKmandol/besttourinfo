<template>
  <div>

    <!-- Modal -->
    <div v-if="changeLoginInfo" class="modal fade" id="exampleModal2" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md mt-100">
        <div class="modal-content">
            <form @submit.prevent="changeLoginDetails" method="POST">
               
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-dark fw-bolder text-center w-100" id="exampleModalLabel">Change Your Login Info</h1>
                <span type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
            </div>
            <div class="modal-body p-4">

                <div class="row mb-3">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-dark">Current Email</label>
                    <div class="col-sm-8">
                        <input type="email" disabled class="form-control form-control-sm" id="colFormLabelSm" v-model="data.changedEmail" :class="hasError('changedEmail') ? 'is-invalid' : '' ">
                        <span class="text-sm fw-bold text-dark">[ NB: <span class="text-sm text-primary text-center">Email address can not be changed</span> ]</span>
                        <div class="invalid-feedback" v-if="hasError('changedEmail')">{{getError('changedEmail')}}</div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-dark">Current Password</label>
                    <div class="col-sm-8">
                        <input type="text" name="currentPassword" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Type Current Password" v-model="data.currentPassword" :class="hasError('currentPassword') ? 'is-invalid' : '' ">
                        <div class="invalid-feedback" v-if="hasError('currentPassword')">{{getError('currentPassword')}}</div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-dark">New Password</label>
                    <div class="col-sm-8">
                        <input type="text" name="changedPassword" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Type New Password" v-model="data.changedPassword" :class="hasError('changedPassword') ? 'is-invalid' : '' ">
                        <div class="invalid-feedback" v-if="hasError('changedPassword')">{{getError('changedPassword')}}</div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-dark">Confirm New Password</label>
                    <div class="col-sm-8">
                        <input type="text" name="ConfirmChangedPassword" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Type New Password" v-model="data.ConfirmChangedPassword" :class="hasError('ConfirmChangedPassword') ? 'is-invalid' : '' ">
                        <div class="invalid-feedback" v-if="hasError('ConfirmChangedPassword')">{{getError('ConfirmChangedPassword')}}</div>
                    </div>
                </div>

            </div>
            <div class="row mt-2 mx-0">
                <button type="button" class="mx-0 px-0 rounded-0 py-3 col-4 btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" @click="showDeleteModal = true" data-bs-dismiss="modal" class="mx-0 px-0 rounded-0 py-3 col-4 btn btn-danger btn-sm my-auto d-flex justify-content-center aling-items-center"><b-icon-trash class="text-white mr-2 my-auto" width="15" height="15"></b-icon-trash>Account</button>
                <button type="submit"  class="mx-0 px-0 rounded-0 py-3 col-4 btn btn-primary btn-sm">Save</button>
            </div>
        </form>
        </div>
    </div>
    </div>


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
        <div style="text-align: center; color: black">
            <p>Are you sure you want to delete your Account ?</p>
        </div>
        <template #footer>
            <button type="default" class="btn btn-secondary btn-sm" @click="closeModal">Close</button>
            <button @click="deleteUser" class="btn btn-danger btn-sm">Delete</button>
        </template>
    </Modal>



  </div>
</template>

<script>
export default {
    data(){
        return{
            isDeleting: false,
            showDeleteModal: false,
            errors:{},
            success: false,
            error: false,
            changeLoginInfo: true,

            user: this.$store.state.client,

            data:{
                userId: this.$store.state.client.id,
                changedEmail: this.$store.state.client.email,
                currentPassword: '',
                changedPassword: '',
                ConfirmChangedPassword: '',
            }
        }
    },

    methods:{
        async changeLoginDetails(){
            const res = await this.callApi('post','/app/updateUserlogin', this.data);
            if (res.status === 200) {
                this.successMsg("Data has been Updated successfully");
                this.changeLoginInfo=false;
                this.$router.go();
            }
            else{
                for(let i in res.data.errors){
                    this.errors = res.data.errors
                }
            }
                
        },
        
        async deleteUser() {
            const res = await this.callApi("post","profile/deleteUser",this.data);

            if (res.status == 200) {
                this.successMsg("Data has been successfully Deleted");
                this.showDeleteModal=false;
                this.$router.go();
            } else {
                this.errorMsg();
            }
        },
           
        async closeModal(){
            this.showDeleteModal = false;
        },
        
            
            
    }

}
</script>

<style scoped>

</style>