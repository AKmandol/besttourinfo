<template>
    <div>
        <div class="container-fluid">

            <div class="text-center p-3 rounded border shadow-sm " v-if="this.emailLog == ''">
                <h1 class="color-white">No List Found</h1>
            </div>

        <div class="row bg-main" v-else>

            <div class="col-md-12 rounded m-0 p-3">

                <h5 class="color-white text-center fw-bold p-3 bg-header table-border-dark"><b-icon-broadcast class="d-inline text-success mr-2" width="25" height="25"></b-icon-broadcast>Email Log</h5>

                <div class="table-responsive mt-2">

                    <table class="table table-striped text-center color-white mb-0">

                    <thead>
                        <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">OTP</th>
                        <th scope="col">Entry</th>
                        <th scope="col">Date & Time</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(log,i) in emailLog" :key="i">
                            <th scope="row" class="align-middle">{{  pageInfo.from + i }}</th>
                            <td>{{ log.name ? log.name : '...' }}</td>
                            <td>{{ log.email ? log.email : '...' }}</td>
                            <td>{{ log.otp ? log.otp : '...' }} <b-icon-subtract @click="copy(log)" class="d-inline color-white ml-2" width="16" height="16"></b-icon-subtract></td>
                            <td :class="log.status == 'Success' ? 'text-success' : 'text-danger'">{{ log.status }}</td>
                            <td>{{ log.date }}</td>
                        </tr>
                    </tbody>

                    </table>

                </div>
            </div>

            <div class="d-flex justify-content-between my-3">
                <div class="text-start">
                    <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="getEmailLog" v-if="pageInfo" />
                </div>
                <div class="text-end d-flex">
                    <label for="perPage" class="col-form-label color-white text-end mr-3">Show List</label>
                    <select id="perPage" class="form-select-sm form-select col" v-model="this.total" @change="this.getEmailLog()">
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
</template>
    
<script>

    export default {

    data(){
        return{
        data:{},
        emailLog: [],
        total: 10,
        pageInfo: null,
        }
    },

    methods:{

        async getEmailLog(page) {
            const res = await this.callApi("get", `app/email-log?page=${page}&total=${this.total}`);
            if (res.status == 200) {
                this.emailLog = res.data.data;
                this.pageInfo = res.data;
            } else {
                this.errorMsg();
            }
        },

        copy(log){
            let copyText = log.otp;
            navigator.clipboard.writeText(copyText);
            this.successMsg("Data Copied");
        }
    },

    async created() {
        this.getEmailLog();
    },

    }
</script>
  
<style scoped>
  
</style>