<template>
    <div class="bg-white">

        <div v-if="isLoading" class="preloader">
            <div class="spinner"></div>
        </div>
       
        <div class="container-fluid main mb-5 position-relative mt-50">

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white shadow border-bottom rounded position-absolute top-100 start-50 translate-middle">
                    <div class="d-flex justify-content-center aling-items-center p-2">
                        <router-link to="/" class="nav-link bg-white border shadow rounded">
                            <b-icon-grid-fill class="d-inline nav-icon" width="15" height="15"></b-icon-grid-fill>
                            <span class="d-inline ml-2 text-dark fw-bold mr-2">Home</span>
                        </router-link>
                        <span class="text-secondary my-auto mx-sm-2 mx-md-4"><b-icon-arrow-bar-left class="d-inline nav-icon" width="25" height="25"></b-icon-arrow-bar-left></span>
                        <router-link to="/hotel" class="nav-link bg-white border shadow rounded">
                            <b-icon-hospital class="d-inline nav-icon" width="15" height="15"></b-icon-hospital>
                            <span class="d-inline text-dark fw-bold ml-2">Stays</span>
                        </router-link>
                    </div>
                </div>
            </div>

        </div>


        <div class="container-fluid main-first m-0 p-0 p-md-3">

            <div class="mt-70p container-custom2 container-main position-relative border shadow py-4 px-2">
        
                <div class="accordion px-2" id="accordionExample">

                    <div class="d-flex flex-row shadow bg-white container-main position-absolute top-0 start-50 translate-middle">

                        
                        <div class="accordion-header p-1" id="headingOne">
                            <a class="accordion-button rounded-3 bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <!-- <b-icon-house-heart class="text-success d-inline" width="25" height="25"></b-icon-house-heart> -->
                                <img src="/img/icon/bed.png" class="border rounded-circle p-2 d-inline" width="40" height="40" alt="">
                                <span class="ml-2 mr-2 text-center text-dark fw-bold fs-6 d-none d-md-block">Hotel Booking</span>
                            </a>
                        </div>

                    </div>


                    <HotelSearch></HotelSearch>

                </div>

            </div>  

        </div>
        
       
        <div class="container-fluid bg-light py-4 px-0">
            <div class="mt-70p container-main py-4">

                <div class="d-flex flex-row aling-items-center justify-content-center py-2">
                    <b-icon-hospital class="text-danger mr-2 my-auto" width="28" height="28"></b-icon-hospital>
                    <h3 class="text-dark1 fw-bold text-center my-auto">Explore Our Hotels</h3>
                </div>
                <hr class="mb-3 mt-1 text-success">

                <div class="row mt-3 pt-4 px-0">

                    <div class="col-lg-2 col-md-12 m-0 pb-3 px-0 mb-3 mb-md-0 div-hover max-h bg-white" v-if="this.searchdData != ''">

                        <div class="border shadow bg-dark rounded m-0 p-0 border-right-down">
                        <h6 class="text-center text-white fw-bolder m-0 py-3">FILTER</h6>
                        </div>

                        <div class="px-3 py-4 bg-white">
                        <label for="input1" class="form-label fw-bolder">By Price</label>
                        <select @change="filterData" v-model="this.filter" class="form-select form-select-sm" aria-label="Default select example">
                            <option disabled value="null">Select Price</option>
                            <option value="low">Price Low to High</option>
                            <option value="high">Price High to Low</option>
                        </select>
                        </div>

                        <div class="px-3 py-4 bg-white">
                        <label for="input1" class="form-label fw-bolder">By Location</label>
                        <select  @change="filterDataCity" v-model="filterCity" class="form-select form-select-sm" aria-label="Default select example">
                            
                            <option disabled value="null">Select Location</option>
                            <option  v-for="(hotel,i) in location" :key="i" :value="hotel.city">{{ hotel.city }}</option>
                            
                        </select>
                        </div>

                        <div class="px-3 py-4 bg-white">
                        <label for="input2" class="form-label fw-bolder">By Price Range</label>

                        <div class="P-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" @change="filterData" v-model="filter" value="p1k" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Price less than 1k
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" @change="filterData" v-model="filter" value="p1kto5k">
                                <label class="form-check-label" for="exampleRadios2">
                                    Price between 1k to 5k
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" @change="filterData" v-model="filter" value="p5kto10k">
                                <label class="form-check-label" for="exampleRadios3">
                                    Price between 5k to 10k
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios4" @change="filterData" v-model="filter" value="p10">
                                <label class="form-check-label" for="exampleRadios4">
                                    Price greater than 10k
                                </label>
                            </div>

                        </div>

                        </div>

                        <div class="px-3 pt-4 bg-white">
                        <label for="input2" class="form-label fw-bolder">By Facilities</label>
                        </div>

                        <div class="px-2 pb-4 bg-white">
                            <div class="form-check form-check-inline ml-4 w-100">
                                <b-icon-egg-fried class="d-none my-auto mr-2 text-secondary" width="15" height="15"></b-icon-egg-fried>
                                <input v-model="filterFacilities" @change="filterFacility" class="form-check-input my-auto" type="radio" id="inlineCheckbox1" value="Breakfast Included">
                                <label class="form-check-label ml-2 my-auto" for="inlineCheckbox1">Breakfast Included</label>
                            </div>

                            <div class="form-check form-check-inline ml-4 w-100">
                                <b-icon-egg class="d-none my-auto mr-2 text-secondary" width="15" height="15"></b-icon-egg>
                                <input v-model="filterFacilities" @change="filterFacility" class="form-check-input my-auto" type="radio" id="inlineCheckbox2" value="Kitchen facilities">
                                <label class="form-check-label ml-2 my-auto" for="inlineCheckbox2">Kitchen facilities</label>
                            </div>

                            <div class="form-check form-check-inline ml-4 w-100">
                                <b-icon-cup-straw class="d-none my-auto mr-2 text-secondary" width="15" height="15"></b-icon-cup-straw>
                                <input v-model="filterFacilities" @change="filterFacility" class="form-check-input my-auto" type="radio" id="inlineCheckbox3" value="Bar Inside">
                                <label class="form-check-label ml-2 my-auto" for="inlineCheckbox3">Bar Inside</label>
                            </div>

                            <div class="form-check form-check-inline ml-4 w-100">
                                <b-icon-star class="d-none my-auto mr-2 text-secondary" width="15" height="15"></b-icon-star>
                                <input v-model="filterFacilities" @change="filterFacility" class="form-check-input my-auto" type="radio" id="inlineCheckbox4" value="5 stars">
                                <label class="form-check-label ml-2 my-auto" for="inlineCheckbox4">5 stars</label>
                            </div>

                            <div class="form-check form-check-inline ml-4 w-100">
                                <b-icon-heart-pulse class="d-none my-auto mr-2 text-secondary" width="15" height="15"></b-icon-heart-pulse>
                                <input v-model="filterFacilities" @change="filterFacility" class="form-check-input my-auto" type="radio" id="inlineCheckbox5" value="Beach View">
                                <label class="form-check-label ml-2 my-auto" for="inlineCheckbox5">Beach View</label>
                            </div>

                            <div class="form-check form-check-inline ml-4 w-100" v-if="more">
                                <b-icon-truck class="d-none my-auto mr-2 text-secondary" width="15" height="15"></b-icon-truck>
                                <input v-model="filterFacilities" @change="filterFacility" class="form-check-input my-auto" type="radio" id="inlineCheckbox6" value="Parking Area">
                                <label class="form-check-label ml-2 my-auto" for="inlineCheckbox6">Parking Area</label>
                            </div>

                            <div class="form-check form-check-inline ml-4 w-100" v-if="more">
                                <b-icon-wifi class="d-none my-auto mr-2 text-secondary" width="15" height="15"></b-icon-wifi>
                                <input v-model="filterFacilities" @change="filterFacility" class="form-check-input my-auto" type="radio" id="inlineCheckbox7" value="Free WiFi">
                                <label class="form-check-label ml-2 my-auto" for="inlineCheckbox7">Free WiFi</label>
                            </div>

                            <div class="form-check form-check-inline ml-4 w-100" v-if="more">
                                <b-icon-water class="d-none my-auto mr-2 text-secondary" width="15" height="15"></b-icon-water>
                                <input v-model="filterFacilities" @change="filterFacility" class="form-check-input my-auto" type="radio" id="inlineCheckbox8" value="Swimming pool">
                                <label class="form-check-label ml-2 my-auto" for="inlineCheckbox8">Swimming pool</label>
                            </div>

                            <a class="text-sm float-end" @click="more = !more">
                                <span v-if="!more">more</span>
                                <span v-if="more">less</span>
                            </a>

                        </div>
                    </div>


                    <div class="col-lg-10 col-md-12 p-0 px-lg-3">

                        <div class="row bg-white shadow div-hover border rounded mx-auto m-0 px-3 d-flex justify-content-between flex-column flex-md-row search-item mb-3" v-for="(hotel,i) in searchdData" :key="i">

                            <div class="col-lg-3 col-md-12 bg-white my-auto position-relative pr-3">

                                <span v-if="hotel.floor_no" class="zIndex px-2 py-1">{{ hotel.floor_no }}</span>
                                
                                <vueper-slides 
                                :infinite="true" 
                                :bullets="false"
                                 fixed-height="220px"
                                 class="mt-3 mt-lg-0"
                                >
                                

                                <template #arrow-left>
                                    <b-icon-chevron-left class="my-auto text-dark p-0" width="40" height="40"></b-icon-chevron-left>
                                </template>
                                <template #arrow-right>
                                    <b-icon-chevron-right class="my-auto text-dark p-0" width="40" height="40"></b-icon-chevron-right>
                                </template>

                                <vueper-slide 
                                v-for="(img,i) in hotel.images" :key="i" 
                                :image="img.hotel_image" 
                                class="h-100 rounded image"
                                >
                                </vueper-slide>
                                
                                </vueper-slides>
                            
                            </div>

                            <div class="col-lg-5 col-md-12 bg-light m-p-0">

                                <div class="row my-auto">
                                <div class="col-8 pt-2 pb-4 pl-3 mt-1 text-start my-auto">
                                    <p v-if="hotel.stars >= 1" class="d-inline fw-bold text-dark">Stars:</p>
                                    <span v-if="hotel.stars == '1'">
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    </span>
                                    <span v-if="hotel.stars == '2'">
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    </span>
                                    <span v-if="hotel.stars == '3'">
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    </span>
                                    <span v-if="hotel.stars == '4'">
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    </span>
                                    <span v-if="hotel.stars == '5'">
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    <b-icon-star-fill class="text-warning mx-1 d-inline" width="10" height="10"></b-icon-star-fill>
                                    </span>
                                </div>

                                <div class="col-4 text-end">
                                    <a class="btn-sm my-auto btn btn-dark1 text-white rounded-3 mt-2 px-3"  :href="'/hotel-info?id=' + hotel.id" target="_blank">Details</a>
                                </div>

                                </div>

                                <div class="d-flex aling-items-center ml-2 mt-2">
                                <b-icon-bank class="icon-color my-auto mr-2" width="15" height="15"></b-icon-bank>
                                <h6 class="text-dark1">{{ hotel.name }}</h6>
                                </div>

                                <div class="d-flex aling-items-center ml-2 mt-2">
                                <b-icon-map class="d-inline my-auto mr-2 text-success" width="15" height="15"></b-icon-map>
                                <p class="text-dark">{{ hotel.address }}</p>
                                </div>

                                <div v-if="hotel.total_room" class="d-flex aling-items-center ml-2 mt-2">
                                <b-icon-capslock class="d-inline my-auto mr-2 text-primary" width="15" height="15"></b-icon-capslock>
                                <p class="text-dark1 text-center">Only {{ hotel.total_room }} Rooms Available</p>
                                </div>
                                <div v-if="hotel.tourPointAddress2" class="d-flex aling-items-center ml-2 mt-2">
                                <b-icon-geo class="d-inline my-auto mr-2 text-secondary" width="10" height="10"></b-icon-geo>
                                <p class="text-muted text-sm text-center"> {{ hotel.tourPointAddress }}</p>
                                </div>

                                <div class="py-3">
                                
                                <span v-for="(p,u) in hotel.images" :key="u" class="p-2"  @click="handleShowPreview(hotel,i)">
                                
                                    <img v-if="u <= 5" :src="p.hotel_image" alt="" class="d-inline border rounded" width="50">
                                

                                </span>

                                <div>
                                    <a @click="handleShowPreview(hotel,i)" class="btn bg-lightYy px-2 float-end text-sm ml-2 my-2 text-dark"><b-icon-eye class="d-inline my-auto mr-1 text-dark" width="15" height="15"></b-icon-eye> View All </a>
                                </div>
                                
                                </div>

                            </div>

                            <div class="col-lg-4 col-md-12 bg-white mx-auto my-auto">

                                <div v-for="(p,q) in hotel.rent" :key="q">
                                <span v-if="q == 0" class="d-flex justify-content-between p-2">
                                    <p class="p-1 py-1 text-dark ml-2 mt-1 rounded my-auto text-start fw-bold">Starting From</p>
                                    <p class="px-2 py-1 text-sm text-muted mt-1 rounded my-auto"> <del>৳ {{ p.offerRegularPrice }}</del></p>
                                    <p class="py-1 bg-white text-dark border fw-bold mt-1 rounded my-auto px-3">৳ {{ p.offerDiscpuntPrice }}</p>
                                </span>
                                </div>
                                
                                <div class="my-auto" v-for="(p,q) in hotel.rent" :key="q">
                                <span v-if="q == 0" class="d-flex justify-content-between bg-lightYy rounded py-1">
                                    <p class="px-4 py-1 text-dark rounded my-auto text-sm fw-bold">Up to</p>
                                    <Tag type="dot" color="success"><span class="fw-bold text-danger fs-6">{{ p.rdiscount }}%</span></Tag>
                                    <p class="px-4 py-1 text-dark rounded my-auto text-sm fw-bold">Discount</p>
                                    <!-- <a :href="'/hotel-info?id=' + hotel.id" target="_blank" class="text-sm btn btn-sm btn-dark1 rounded text-white px-3 py-1 my-auto">Full Details</a> -->
                                </span>
                                <span v-else></span>
                                </div>

                                <div class="mt-1 rounded border mb-3">
                                
                                <div class="border-bottom bg-light d-flex justify-content-start">
                                    <p class="text-success fw-bolder my-auto ml-2 p-2">Featuares</p>
                                </div>
                                
                                <div class="h-l-fixed">
                                    <div class="d-inline-flex justify-content-between" v-for="(f,j) in hotel.features" :key="j">

                                        <div class="d-inline-flex justify-content-between" v-if="j <= 2">

                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Hill View/Mountain View'"><b-icon-binoculars class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-binoculars>Hill View/Mountain View</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Steam Bath'"><b-icon-cloud-snow-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cloud-snow-fill>Steam Bath</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Laundry Service'"><b-icon-archive class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-archive>Laundry Service</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Business Center'"><b-icon-safe class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-safe>Business Center</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Hall Room'"><b-icon-hospital class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hospital>Hall Room</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Prayer Room'"><b-icon-hospital-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hospital-fill>Prayer Room</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Tour and Travel Desk'"><b-icon-border-style class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-border-style>Tour and Travel Desk</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Water Park'"><b-icon-water class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-water>Water Park</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Doctor on Call'"><b-icon-graph-up class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-graph-up>Doctor on Call</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'DJ Party/ Night Club'"><b-icon-suit-club class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-suit-club>DJ Party/ Night Club</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'B-B-Q'"><b-icon-medium class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-medium>B-B-Q</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Safety Locker'"><b-icon-lock class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-lock>Safety Locker</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Indore Games'"><b-icon-controller class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-controller>Indore Games</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Kayaking Boat'"><b-icon-cpu class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cpu>Kayaking Boat</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Fishing'"><b-icon-eyeglasses class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-eyeglasses>Fishing</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Salon'"><b-icon-scissors class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-scissors>Salon</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Luggage Room'"><b-icon-receipt-cutoff class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-receipt-cutoff>Luggage Room</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Breakfast Included'"><b-icon-egg-fried class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-egg-fried>Breakfast Included</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Swimming pool'"><b-icon-water class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-water>Swimming pool</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Steam room'"><b-icon-cloud-snow-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cloud-snow-fill>Steam room</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Free cancellation'"><b-icon-arrow-repeat class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-arrow-repeat>Free cancellation</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Full-body massage'"><b-icon-balloon-heart class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-balloon-heart>Full-body massage</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Pet friendly'"><b-icon-bug class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bug>Pet friendly</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Kitchen facilities'"><b-icon-check-circle class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-check-circle>Kitchen facilities</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Kids Zone'"><b-icon-person-check class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-person-check>Kids Zone</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Fitness center'"><b-icon-heart-pulse class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-heart-pulse>Fitness center</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Book without credit card'"><b-icon-card-checklist class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-card-checklist>Book without credit card</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Resort Hotel'"><b-icon-box2-heart class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-box2-heart>Resort Hotel</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Sauna'"><b-icon-wind class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-wind>Sauna</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Smoking Zone'"><b-icon-bandaid class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bandaid>Smoking Zone</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == '5 stars'"><b-icon-star class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-star>5 stars</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Beach View'"><b-icon-sunset class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-sunset>Beach View</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Air conditioning'"><b-icon-fan class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-fan>Air conditioning</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Spa facilities'"><b-icon-heart-pulse-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-heart-pulse-fill>Spa facilities</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Apart Hotel'"><b-icon-hospital class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hospital>Apart Hotel</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Hotel'"><b-icon-hospital-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hospital-fill>Hotel</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Tourist Info Centre'"><b-icon-info-circle class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-info-circle>Tourist Info Centre</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Wheelchair accessibleg'"><b-icon-gpu-card class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-gpu-card>Wheelchair accessibleg</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Parking Area'"><b-icon-bezier2 class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bezier2>Parking Area</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Free WiFi'"><b-icon-wifi class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-wifi>Free WiFi</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Balcony'"><b-icon-binoculars class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-binoculars>Balcony</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'No prepayment'"><b-icon-cash-coin class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cash-coin>No prepayment</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Vehicle Parking'"><b-icon-bicycle class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bicycle>Vehicle Parking</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Medical Support'"><b-icon-bag-heart class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bag-heart>Medical Support</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Room Service'"><b-icon-alt class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-alt>Room Service</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Couple Friendly'"><b-icon-hearts class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hearts>Couple Friendly</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Bar Inside'"><b-icon-cup-straw class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cup-straw>Bar Inside</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Coffee/Tea in Lobby'"><b-icon-cup class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cup>Coffee/Tea in Lobby</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Washing machine'"><b-icon-boombox class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-boombox>Washing machine</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Alcohol Permit'"><b-icon-hurricane class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hurricane>Alcohol Permit</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Accessible Bathroom'"><b-icon-modem class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-modem>Accessible Bathroom</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Telephone'"><b-icon-telephone class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-telephone>Telephone</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Clothes Dryer'"><b-icon-border-inner class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-border-inner>Clothes Dryer</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Towel'"><b-icon-input-cursor class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-input-cursor>Towel</span>
                                            <span class="d-inline text-dark m-2 rounded bg-light shadow-sm p-1 text-sm" v-if="f.hotel_feature == 'Mobile Phone Coverage'"><b-icon-router class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-router>Mobile Phone Coverage</span>
                                        
                                        </div>
                                    </div>

                                    <a @click="viewAllFeature(hotel,i)" class="btn bg-lightYy px-2 float-end text-sm m-2"><b-icon-eye class="d-inline my-auto mr-1 text-warning" width="15" height="15"></b-icon-eye> View All</a>

                                </div>
                                
                                </div>
                                

                            </div>
                        
                        </div>


                        <div class="text-center mt-4">
                        <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.searchdData != ''" @on-change="getHotel" />
                        </div>

                    </div>


                </div>


            </div>
            
        
        </div>

        <div class="container-fluid py-4">

            <div class="mt-70p py-4">
                <div class="row m-0 p-0">

                    <div class="col-12 mx-auto border container-main pb-3 px-0">

                        <div class="mb-2 d-flex justify-content-start bg-light py-3 container-main11 border-bottom border-success my-auto">
                            <b-icon-arrow-right-square class="text-success mr-3" width="25" height="25"></b-icon-arrow-right-square>
                            <h5 class="text-dark text-start ml-4 fw-bold">Popular Hotel by Tourist Choice</h5>
                        </div>

                        <div class="row mt-3">

                            <div class="container-custom" v-if="staysInBangladesh != '' ">
          
          
                                <div class="col-12">
                                <vueper-slides 
                                    fixed-height="270px"
                                    :breakpoints="{ 600: { visibleSlides: 1 },900: { visibleSlides: 1 },1200: { visibleSlides: 2 },1400: { visibleSlides: 3 },1500: { visibleSlides: 3 }  }"
                                    :infinite="true" 
                                    :visible-slides="3"
                                    :slide-ratio="(1/5)"
                                    :dragging-distance="70"
                                    :gap="2"
                                    class="no-shadow pt-3"
                                    autoplay 
                                    :duration = "2000"
                                    >

                                    <template #arrow-left>
                                    <b-icon-chevron-left class="text-primary my-auto p-0" width="55" height="55"></b-icon-chevron-left>
                                    </template>

                                    <template #arrow-right>
                                    <b-icon-chevron-right class="text-primary my-auto p-0" width="55" height="55"></b-icon-chevron-right>
                                    </template>

                                    <vueper-slide
                                    v-for="(hotel,i) in staysInBangladesh"
                                    :key="i"
                                    :image="hotel.titleImage"
                                    class="image rounded-img"
                                    >

                                    <template #content>
                                        
                                        <div class="col-lg-4 col-sm-6 col-sm-12 my-2 p-3 my-2">
                                            <a :href="'/hotel-info?id=' + hotel.id" target="_blank">
                                                <div class="p-1  shadow container-main1  position-absolute bottom-0 start-0">
                                                    <!-- <img :src="hotel.titleImage" class="img-fluid p-1 container-main" alt=""> -->
                                                    <h6 class="text-center py-2 m-0 text-white fw-bolder">{{ hotel.name }}</h6>
                                                </div>
                                                <div class="p-2  shadow container-main2  position-absolute bottom-0 end-0">
                                                    <!-- <img :src="hotel.titleImage" class="img-fluid p-1 container-main" alt=""> -->
                                                    <a  :href="'/hotel-info?id=' + hotel.id" target="_blank" class="btn btn-dark1 text-white fw-bold px-4">View</a>
                                                </div>
                                            </a>
                                        </div>     


                                    </template>

                                    </vueper-slide>
                                </vueper-slides>
                                </div>
          

                            </div>

                        </div>

                    </div>                             

                </div>
                
            </div>
        
        </div>

        <!-- Features Modal -->
        <Modal
        v-model="featuremodal"
        footer-hide
        width="70vw"
        >

            <div class="p-3 rounded">

                <div class="text-center p-3 bg-light rounded border-bottom border-success">
                    <h5 class="text-dark1 fw-bold">All Facelities</h5>
                    <p class="text-success mt-2">Also can request facelities on Booking</p>
                </div>

                <div class="p-3 bg-white rounded border text-center my-2">

                    <span class="m-2 d-inline-flex justify-content-between" v-for="(f,r) in featuresAll" :key="r">
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Hill View/Mountain View'"><b-icon-binoculars class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-binoculars>Hill View/Mountain View</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Steam Bath'"><b-icon-cloud-snow-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cloud-snow-fill>Steam Bath</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Laundry Service'"><b-icon-archive class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-archive>Laundry Service</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Business Center'"><b-icon-safe class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-safe>Business Center</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Hall Room'"><b-icon-hospital class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hospital>Hall Room</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Prayer Room'"><b-icon-hospital-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hospital-fill>Prayer Room</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Tour and Travel Desk'"><b-icon-border-style class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-border-style>Tour and Travel Desk</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Water Park'"><b-icon-water class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-water>Water Park</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Doctor on Call'"><b-icon-graph-up class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-graph-up>Doctor on Call</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'DJ Party/ Night Club'"><b-icon-suit-club class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-suit-club>DJ Party/ Night Club</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'B-B-Q'"><b-icon-medium class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-medium>B-B-Q</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Safety Locker'"><b-icon-lock class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-lock>Safety Locker</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Indore Games'"><b-icon-controller class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-controller>Indore Games</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Kayaking Boat'"><b-icon-cpu class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cpu>Kayaking Boat</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Fishing'"><b-icon-eyeglasses class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-eyeglasses>Fishing</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Salon'"><b-icon-scissors class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-scissors>Salon</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Luggage Room'"><b-icon-receipt-cutoff class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-receipt-cutoff>Luggage Room</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Breakfast Included'"><b-icon-egg-fried class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-egg-fried>Breakfast Included</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Swimming pool'"><b-icon-water class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-water>Swimming pool</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Steam room'"><b-icon-cloud-snow-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cloud-snow-fill>Steam room</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Free cancellation'"><b-icon-arrow-repeat class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-arrow-repeat>Free cancellation</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Full-body massage'"><b-icon-balloon-heart class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-balloon-heart>Full-body massage</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Pet friendly'"><b-icon-bug class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bug>Pet friendly</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Kitchen facilities'"><b-icon-check-circle class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-check-circle>Kitchen facilities</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Kids Zone'"><b-icon-person-check class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-person-check>Kids Zone</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Fitness center'"><b-icon-heart-pulse class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-heart-pulse>Fitness center</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Book without credit card'"><b-icon-card-checklist class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-card-checklist>Book without credit card</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Resort Hotel'"><b-icon-box2-heart class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-box2-heart>Resort Hotel</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Sauna'"><b-icon-wind class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-wind>Sauna</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Smoking Zone'"><b-icon-bandaid class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bandaid>Smoking Zone</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == '5 stars'"><b-icon-star class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-star>5 stars</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Beach View'"><b-icon-sunset class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-sunset>Beach View</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Air conditioning'"><b-icon-fan class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-fan>Air conditioning</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Spa facilities'"><b-icon-heart-pulse-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-heart-pulse-fill>Spa facilities</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Apart Hotel'"><b-icon-hospital class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hospital>Apart Hotel</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Hotel'"><b-icon-hospital-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hospital-fill>Hotel</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Tourist Info Centre'"><b-icon-info-circle class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-info-circle>Tourist Info Centre</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Wheelchair accessibleg'"><b-icon-gpu-card class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-gpu-card>Wheelchair accessibleg</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Parking Area'"><b-icon-bezier2 class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bezier2>Parking Area</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Free WiFi'"><b-icon-wifi class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-wifi>Free WiFi</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Balcony'"><b-icon-binoculars class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-binoculars>Balcony</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'No prepayment'"><b-icon-cash-coin class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cash-coin>No prepayment</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Vehicle Parking'"><b-icon-bicycle class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bicycle>Vehicle Parking</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Medical Support'"><b-icon-bag-heart class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bag-heart>Medical Support</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Room Service'"><b-icon-alt class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-alt>Room Service</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Couple Friendly'"><b-icon-hearts class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hearts>Couple Friendly</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Bar Inside'"><b-icon-cup-straw class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cup-straw>Bar Inside</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Coffee/Tea in Lobby'"><b-icon-cup class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cup>Coffee/Tea in Lobby</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Washing machine'"><b-icon-boombox class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-boombox>Washing machine</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Alcohol Permit'"><b-icon-hurricane class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hurricane>Alcohol Permit</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Accessible Bathroom'"><b-icon-modem class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-modem>Accessible Bathroom</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Telephone'"><b-icon-telephone class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-telephone>Telephone</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Clothes Dryer'"><b-icon-border-inner class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-border-inner>Clothes Dryer</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Towel'"><b-icon-input-cursor class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-input-cursor>Towel</span>
                        <span class="d-inline text-dark m-1 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Mobile Phone Coverage'"><b-icon-router class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-router>Mobile Phone Coverage</span>
                    </span>
                    
                </div>

            </div>

        </Modal>
    

    </div>
</template>

<script>
import { VueperSlides, VueperSlide } from 'vueperslides';
import 'vueperslides/dist/vueperslides.css';
import HotelSearch from '../search/hotelSearch.vue'

export default {
    components: {
      VueperSlides,
      VueperSlide,
      HotelSearch
    },
    data () {
        return {
            urlList:[
       
            ],
            location: [],
            isLoading: true,
            featuremodal: false,
            featuresAll: null,
            total:10,
            pageInfo: null,
            value:[],
            show: false,
            staysInBangladesh: [],
            searchdData: [],
            filter: null,
            filterCity: null,
            filterFacilities: [],
            more: false
          
        }
    },

    methods: {

        async getLocation() {
            const res = await this.callApi("get","home/getLocation");
            if (res.status == 200) {
                this.location = res.data;
                //console.log(this.location)
            } else {
                this.errorMsg();
            }
        },

        async getHotel(page) {
            this.isLoading = true;
            const res = await this.callApi("get",`home/getALLHotel?str=${this.$route.query.str}&total=${this.total}&page=${page}`);
            if (res.status == 200) {
                this.searchdData = res.data.data;
                this.pageInfo = res.data; 
                setTimeout(() => {
                    this.isLoading = false;
                }, 300);
            } else {
                this.errorMsg();
            }
        },

        async filterData(page) {
           //console.log(this.filter)
            this.isLoading = true;
            const res = await this.callApi("get",`home/filterGetALLHotel?str=${this.filter}&total=${this.total}&page=${page}`);
            if (res.status == 200) {
               if(res.data.data == ''){
                this.infoMsg("No filter data found");
               }else{
                    this.searchdData = res.data.data;
                    this.pageInfo = res.data;
               }
                setTimeout(() => {
                    this.isLoading = false;
                }, 100); 
            } else {
                this.errorMsg();
                this.isLoading = false;
            }
        },

        async filterFacility(page) {
            console.log(this.filterFacilities)
            //this.isLoading = true;
            const res = await this.callApi("get",`home/filterGetALLHotelFas?city=${this.filterCity}&facility=${this.filterFacilities}&total=${this.total}&page=${page}`);
            if (res.status == 200) {
                console.log(res.data.data)
               if(res.data.data == ''){
                this.infoMsg("No filter data found");
               }else{
                    this.searchdData = res.data.data;
                    this.pageInfo = res.data;
               }
                setTimeout(() => {
                    this.isLoading = false;
                }, 100); 
            } else {
                this.errorMsg();
                this.isLoading = false;
            }
        },

        async filterDataCity(page) {
           //console.log(this.filterCity)
            this.isLoading = true;
            const res = await this.callApi("get",`home/filterGetALLHotelCity?city=${this.filterCity}&total=${this.total}&page=${page}`);
            if (res.status == 200) {
               if(res.data.data == ''){
                this.infoMsg("No filter data found");
               }else{
                    this.searchdData = res.data.data;
                    this.pageInfo = res.data;
               }
                setTimeout(() => {
                    this.isLoading = false;
                }, 100); 
            } else {
                this.errorMsg();
                this.isLoading = false;
            }
        },

        async handleShowPreview (hotel,i) {
            this.urlList = [];
            let id = hotel.id;
            const res = await this.callApi("get",`home/hotelImage?id=${id}`);
            if (res.status == 200) {

            const objectArray = Object.entries(res.data);
            objectArray.forEach(([key, value]) => {
                this.urlList.push(value['hotel_image']); 
            });

            this.$ImagePreview.show({
                previewList: this.urlList,
                infinite: false,
                toolbar : ['zoomIn', 'zoomOut', 'rotateLeft', 'rotateRight'],
                lazy : true
            });
            //console.log(res.data)
            //console.log(this.urlList)
            } else {
            this.errorMsg();
            }

        },

        async clientReviewHotel(){
            const res = await this.callApi("get","home/clientReviewHotel");
            if (res.status == 200) {
            this.staysInBangladesh = res.data;
            //console.log(this.staysInBangladesh)
            } else {
            this.errorMsg();
            }
        },

        async viewAllFeature(hotel,i) {
            this.featuremodal = true;
            const fId = hotel.id;
            const res = await this.callApi("get",`home/hotelFeatures?id=${fId}`);
            if (res.status == 200) {
                this.featuresAll = res.data;
            } else {
                this.errorMsg();
            }
           // console.log(this.featuresAll)
        },
                        
    },

    created(){
        this.getHotel();
        this.getLocation();
        this.clientReviewHotel();
        setTimeout(() => {
            this.isLoading = false;
        }, 500);
    }
}
</script>

<style scoped>

.zIndex{
  color: #fff;
  background: -webkit-linear-gradient(to right, #E2E2E2, #052b56);  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #09630b, #3f0054); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  font-weight: bolder;
  z-index: 100;
  border-top: .5px solid rgb(0, 0, 0);
  border-top-right-radius: 0px;
  border-top-right-radius: 20px;
  position: absolute;
  top: 20px;
  left: 12px;
}

.container-custom2 {
  width: 1100px !important;
}

.rounded-img{
  border-top-right-radius: 10px !important;
  border-top-left-radius: 10px !important;
  border-bottom-left-radius: 10px !important;
  border-bottom-right-radius: 10px !important;
  position: relative;
  border: .3px solid #dcdcdc;
}
.container-main11 {
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;

}
.container-main1 {
  border-top-right-radius: 15px !important;
  border-bottom-right-radius: 1px !important;
  background: #6b3401f0;
  width: 200px;
}
.container-main2 {
  border-top-left-radius: 10px !important;
  border-bottom-left-radius: 10px !important;
}
.mt-70p{
    width: 80vw;
    margin-left: auto;
    margin-right: auto;
}

.main-first {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 350px;
  width: 100%;
  background-size: cover !important;
  background-repeat: no-repeat !important;
}

.main {
height: 200px;
padding: 200px 0;
background-color: #354d4ccb;
background-image: url("/img/bg/3px-tile.png");
/* This is mostly intended for prototyping; please download the pattern and re-host for production environments. Thank you! */
}

.container-main {
  border-radius: 10px;
}

</style>