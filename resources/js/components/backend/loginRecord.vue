<template>
    <div>
        <div class="container-fluid">
            <div class="text-center p-3 rounded border shadow-sm " v-if="this.loginRecord == ''">
                <h1 class="color-white1">No List Found</h1>
            </div>

            <div class="row bg-main" v-else>

                <div class="col-md-12 rounded m-0 p-3">

                    <h5 class="color-white text-center fw-bold p-3 bg-header table-border-dark"><b-icon-record-circle class="d-inline text-success mr-2" width="25" height="25"></b-icon-record-circle>Login Record</h5>

                    <div class="table-responsive mt-2">

                        <table class="table table-striped text-center color-white mb-0">

                            <thead>
                                <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Email</th>
                                <th scope="col">User type</th>
                                <th scope="col">IP Address</th>
                                <th scope="col">Date & Time</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(record,i) in loginRecord" :key="i">
                                    <th scope="row" class="align-middle">{{  pageInfo.from + i }}</th>
                                    <td>{{ record.email }}</td>
                                    <td :class="record.user_type == 'Admin *' ? 'text-success' : 'color-white'">{{ record.user_type }}</td>
                                    <td>{{ record.ip }}</td>
                                    <td>{{ record.date }}</td>
                                </tr>
                        </tbody>

                        </table>

                    </div>
                </div>

                <div class="d-flex justify-content-between my-3">
                    <div class="text-start">
                        <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="getRecord" v-if="pageInfo" />
                    </div>
                    <div class="text-end d-flex">
                        <label for="perPage" class="col-form-label color-white text-end mr-3">Show List</label>
                        <select id="perPage" class="form-select-sm form-select col" v-model="this.total" @change="this.getRecord()">
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
            data:{
                
            },
            loginRecord: [],
            total: 10,
            pageInfo: null,
        }
    },

    methods:{

        async getRecord(page) {
            const res = await this.callApi("get", `app/login-record?page=${page}&total=${this.total}`);
            if (res.status == 200) {
                this.loginRecord = res.data.data;
                this.pageInfo = res.data;
            } else {
                this.errorMsg();
            }
        },

    },

    async created() {
        this.getRecord();
    },

    }
</script>
  
<style scoped>
  
</style>