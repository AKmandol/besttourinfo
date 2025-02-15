<template>
  <div>

    <div class="accordion-item mt-4 border-0">
            
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body px-0 px-md-2">

            <div class="row g-1">

                <div class="col-sm-12 col-md-6 col-lg-3 mx-auto my-auto">

                    <div class="form-floating">
                        <input class="form-control border-4" type="text" list="propertyList" v-model="hotel">

                        <datalist id="propertyList">

                            <option v-for="(data,i) in propertyList" :key="i">

                                <!-- <span class="text-dark float-start">{{ data.name }} at <small class="text-white float-end">{{ data.address }}</small></span> -->
                                <span class="text-dark float-start">{{ data.name }}</span>
                                
                            </option>
                            
                            
                        </datalist>

                        <label for="floatingSelect"> <span><b-icon-geo-alt class="d-inline text-primary mr-2" width="15" height="15"></b-icon-geo-alt></span> Search Destination or Property </label>
                    </div>
            
                </div>

                <div class="col-sm-12 col-md-6 col-lg-5 mt-2 mt-md-0 mx-auto position-relative">

                    <b-icon-shuffle class="p-2 text-success border-4 bg-light rounded-circle position-absolute top-50 start-50 translate-middle zindex-100" width="40" height="40"></b-icon-shuffle>

                    <v-date-picker v-model="data.range" mode="date" is-range :columns="2" >
                        <template v-slot="{ inputValue, inputEvents }">
                        <div class="d-flex justify-content-center aling-items-center">
                            
                            <div class="form-floating col mr-1">
                            <input :value="inputValue.start" v-on="inputEvents.start" class="form-control textt-small border-4" />
                            <label for="floatingSelect"> <span><b-icon-calendar-day class="d-inline text-primary mr-2" width="15" height="15"></b-icon-calendar-day></span> Check In</label>
                            </div>
                            

                            <div class="form-floating col ml-1">
                            <input :value="inputValue.end" v-on="inputEvents.end" class="form-control textt-small border-4" />
                            <label for="floatingSelect"> <span><b-icon-calendar-day class="d-inline text-primary mr-2" width="15" height="15"></b-icon-calendar-day></span> Check Out</label>
                            </div>
                        
                        </div>
                        </template>
                    </v-date-picker>

                </div>

                <div class="col-sm-12 col-md-12 col-lg-4 mt-2 mt-lg-0">
                    <div class="form-floating">
                        <div class="dropdown drop form-control border-4 position-relative">

                            <button @click="this.drop = true" class="btn text-start p-3 dropdown-toggle h-100 col-12 position-absolute top-50 start-50 translate-middle" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                <span class="text-start text-dark textt-small align-bottom mt-3">Select All Information Correctly</span>
                            </button>
                            
                            <form v-show="drop" class="dropdown-menu p-3 mt-2 col-12 dropdown-menu-white">
                                
                                <div class="row mb-3">

                                <span class="col-8 col-form-label">
                                    <b-icon-house-heart class="d-inline text-primary mr-2" width="15" height="15"></b-icon-house-heart>
                                    <label class="d-inline text-dark textt-small">Rooms:</label>
                                </span>
                                <div class="col-4 my-auto">
                                    <InputNumber class="ml-1 rounded text-end float-end" :min="1" v-model="data.room" controls-outside />
                                </div>

                                </div>

                                <div class="row mb-3">

                                <span class="col-8 col-form-label">
                                    <b-icon-person-hearts class="d-inline text-primary mr-2" width="15" height="15"></b-icon-person-hearts>
                                    <label class="d-inline text-dark textt-small">Adults:</label>
                                </span>
                                <div class="col-4 my-auto">
                                    <InputNumber class="ml-1 rounded text-end float-end" :min="1" v-model="data.adult" controls-outside />
                                </div>

                                </div>

                                <div class="row mb-3">

                                <span class="col-8 col-form-label">
                                    <b-icon-person-hearts class="d-inline text-primary mr-2" width="15" height="15"></b-icon-person-hearts>
                                    <label class="d-inline text-dark textt-small">Children: <small class="aling-middle">(Ages Below 12)</small> </label>
                                </span>
                                <div class="col-4 my-auto">
                                    <InputNumber class="ml-1 rounded text-end float-end" :min="0" v-model="data.child" controls-outside />
                                </div>

                                </div>

                                <div><hr class="dropdown-divider mb-3"></div>

                                <a type="submit" @click="this.drop = false" class="btn btn-sm btn-secondary d-flex justify-content-center col-4 mx-auto float-end">Ok</a>

                            </form>

                        </div>
                        
                        
                        <label for="floatingSelect"> <span><b-icon-people class="d-inline text-primary mr-2" width="15" height="15"></b-icon-people></span> Total Room,Adults,Children </label>
                    </div>
                </div>
                
            
                
                <button @click="search" class="btn border-secondary border-2 btn-dark1 col-lg-2 col-md-4 col-sm-6 py-2 mx-auto position-absolute top-100 start-50 translate-middle">
                    <b-icon-search class="d-inline text-white fw-bold mr-2" width="25" height="25"></b-icon-search>
                    <span class="d-inline text-white fs-5 ml-2" v-if="!loading">Search</span>
                    <span class="d-inline text-white fs-5 ml-2" v-if="loading">Searching</span>
                </button>  
                
                

            </div>
            
            </div>
        </div>

    </div>


  </div>
</template>

<script>

export default {
    data () {
        return {
          loading: false,
          drop: true,
          propertyList:[],
          searchedData:[],
          hotel:'',
          data: 
            {
              room: 1,
              adult: 1,
              child: 0,
              range: {
                start: new Date(),
                end: new Date(),
              },
            }
          
          ,
          
        }
    },
    methods: {

      search() {
        //console.log(this.data);
        this.loading = true;
        this.$store.commit('searchData', this.data);
        this.$store.commit('propertyData', this.hotel);
        window.location = `/search-hotel?str=${this.hotel}`;
        //this.$router.push({name: 'singleHotelDetails', params: { data: this.hotel } });
        
      },

      async searchProperty(){
        const res = await this.callApi("get","home/getALL");
        if (res.status == 200) {
          this.propertyList = res.data;
          this.loading = false;
          //console.log(this.propertyList)
        } else {
          this.errorMsg();
        }
      },

    },

    created(){
        this.searchProperty();
    }
}

</script>

<style>
.mt-span{
    margin-top: 25px !important;
} 

</style>