<template>
  <div>
    <div class="accordion-item mt-4 border-0">
          
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample" style="">
            <div class="accordion-body px-0 px-md-2">

                <div class="row g-1">

                    <div class="col-md-12 col-lg-4 d-flex mx-auto my-auto">

                        <div class="form-floating col">
                        <input class="form-control textt-small border-4" list="datalistOptions" id="exampleDataList" placeholder="Type to search a Hotel">
                        <datalist id="datalistOptions">
                            <option value="San Francisco">Location:Dhanmondhi,Dhaka,Banglasesh.</option>
                            <option value="New York">Location:Mancrster,New York.</option>
                            <option value="Seattle">Location:7street,Seattle.</option>
                            <option value="Los Angeles">Location:22/8D,Angeles.</option>
                            <option value="Chicago">Location:Dhanmondhi,Chicago.</option>
                        </datalist>
                        <label class="text-primary" for="floatingSelect"> <span><b-icon-geo-alt class="d-inline text-secondary mr-2" width="15" height="15"></b-icon-geo-alt></span> From </label>
                        </div>

                        <b-icon-arrow-left-right class="text-center text-primary col-1 my-auto" width="15" height="15"></b-icon-arrow-left-right>

                        <div class="form-floating col">
                        <input class="form-control textt-small border-4" list="datalistOptions" id="exampleDataList" placeholder="Type to search a Hotel">
                        <datalist id="datalistOptions">
                            <option value="San Francisco">Location:Dhanmondhi,Dhaka,Banglasesh.</option>
                            <option value="New York">Location:Mancrster,New York.</option>
                            <option value="Seattle">Location:7street,Seattle.</option>
                            <option value="Los Angeles">Location:22/8D,Angeles.</option>
                            <option value="Chicago">Location:Dhanmondhi,Chicago.</option>
                        </datalist>
                        <label class="text-primary" for="floatingSelect"> <span><b-icon-geo-alt class="d-inline text-secondary mr-2" width="15" height="15"></b-icon-geo-alt></span> To </label>
                        </div>

                    </div>

                    <div class="col-md-12 col-lg-5 mt-md-2 mt-lg-0 mx-auto d-flex position-relative justify-content-between">

                        <b-icon-shuffle class="p-2 text-success border-4 bg-light rounded-circle position-absolute top-50 start-50 translate-middle zindex-100" width="40" height="40"></b-icon-shuffle>

                        <div class="col mx-2 mt-md-2 mt-lg-0 my-auto">

                            <v-date-picker v-model="date" mode="dateTime" >
                            <template v-slot="{ inputValue, inputEvents }">
                                <div class="d-flex justify-content-center aling-items-center">
                                
                                <div class="form-floating col">
                                    <input :value="inputValue" v-on="inputEvents" class="form-control textt-small border-4" />
                                    <label for="floatingSelect"> <span><b-icon-calendar-day class="d-inline text-dark mr-2" width="15" height="15"></b-icon-calendar-day></span> <span class="text-primary">Journey Date</span></label>
                                </div>
                                
                                </div>
                            </template>
                            </v-date-picker>     

                        </div>

                        <div class="col mx-2 mt-md-2 mt-lg-0 my-auto">
                            <v-date-picker v-model="date2" mode="dateTime" >
                            <template v-slot="{ inputValue, inputEvents }">
                                <div class="d-flex justify-content-center aling-items-center">
                                
                                <div class="form-floating col">
                                    <input :value="inputValue" v-on="inputEvents" class="form-control textt-small border-4" />
                                    <label for="floatingSelect"> <span><b-icon-calendar-day class="d-inline text-dark mr-2" width="15" height="15"></b-icon-calendar-day></span> <span class="text-primary">Return Date</span> <span class="text-danger">(If needed)</span></label>
                                </div>
                                
                                </div>
                            </template>
                            </v-date-picker> 

                        </div>

                    </div>

                    <div class="col-md-12 col-lg-3 mt-md-2 mt-lg-0">
                        <div class="form-floating position-relative">
                        <div class="dropdown form-control border-4">
                            <button class="btn text-end border dropdown-toggle h-100 col-12 border-0 position-absolute top-0 start-50 translate-middle-x" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                                <span class="float-start mt-3 textt-small">Traveler and Class Details </span>
                            </button>
                            
                                <form class="dropdown-menu p-3 mt-2 col-12 dropdown-menu-white">

                                <div class="row mb-3">

                                    <span class="col col-form-label">
                                    <b-icon-person-hearts class="d-inline text-primary mr-2" width="15" height="15"></b-icon-person-hearts>
                                    <label class="d-inline text-dark textt-small">Adults:</label>
                                    </span>
                                    <div class="col my-auto">
                                    <InputNumber class="ml-1 rounded text-end float-end" size="small" :max="10" :min="1" v-model="adult" controls-outside />
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <span class="col col-form-label">
                                    <b-icon-flower3 class="d-inline text-primary mr-2" width="15" height="15"></b-icon-flower3>
                                    <label class="d-inline text-dark textt-small">Child:<br><span class="text-muted text-sm ml-2">(Age 2-15)</span></label>
                                    </span>
                                    <div class="col my-auto">
                                    <InputNumber class="ml-1 rounded text-end float-end" size="small" :max="10" :min="0" v-model="child" controls-outside />
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <span class="col col-form-label">
                                    <b-icon-binoculars class="d-inline text-primary mr-2" width="15" height="15"></b-icon-binoculars>
                                    <label class="d-inline text-dark textt-small">Senior:<br><span class="text-muted text-sm ml-2">(Age 65+)</span></label>
                                    </span>
                                    <div class="col my-auto">
                                    <InputNumber class="ml-1 rounded text-end float-end" size="small" :max="10" :min="0" v-model="senior" controls-outside />
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <span class="col col-form-label">
                                    <b-icon-cart2 class="d-inline text-primary mr-2" width="15" height="15"></b-icon-cart2>
                                    <label class="d-inline text-dark textt-small">Baby:<br><span class="text-muted text-sm ml-2">(Age 0-2)</span></label>
                                    </span>
                                    <div class="col my-auto">
                                    <InputNumber class="ml-1 rounded text-end float-end" size="small" :max="10" :min="0" v-model="baby" controls-outside />
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <span class="col col-form-label my-auto">
                                    <b-icon-currency-dollar class="d-inline text-primary mr-2" width="15" height="15"></b-icon-currency-dollar>
                                    <label class="d-inline text-dark textt-small">Classes:</label>
                                    </span>
                                    <div class="col my-auto textt-small">

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Economy</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Business</label>
                                    </div>

                                    </div>

                                </div>

                                <div><hr class="dropdown-divider mb-3"></div>

                                <a type="submit" class="btn btn-sm btn-secondary px-3 mx-2 float-end">Confirm</a>

                                </form>

                            </div>
                            <label for="floatingSelect"> <span><b-icon-people class="d-inline text-dark mr-2" width="15" height="15"></b-icon-people></span>  <span class="text-primary">Traveler Information</span> </label>
                        </div>
                    </div>
                    
                    <button disabled class="btn btn-dark1 col-lg-3 col-md-4 col-sm-6 py-2 mx-auto position-absolute top-100 start-50 translate-middle opacity-100">
                        <b-icon-search class="d-inline text-secondary mr-2" width="25" height="25"></b-icon-search>
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
          date: new Date(),
          date2: new Date(),
          room:1,
          adult:1,
          child:0,
          age:{ 
            child: []
          }
          ,
          senior:0,
          baby:0,
          range: {
            start: new Date(),
            end: new Date(),
          },
        }
    },
    methods: {
      onClick() {

        
      },
      add(index) {
            this.inputs.push({ age: '' });
        },
        remove(index) {
            this.inputs.splice(index, 1);
        },
    }
}

</script>

<style>

</style>