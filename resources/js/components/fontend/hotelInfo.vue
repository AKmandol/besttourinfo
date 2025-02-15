<template>
    <div>
        

        <div v-if="isLoading" class="preloader">
            <div class="spinner"></div>
        </div>

        <div class="container-fluid main">
            <div class="container container-main position-relative bg-white border shadow rounded py-4">

                <div class="accordion  px-2" id="accordionExample">

                    <div class="border p-3 d-flex flex-row container-main shadow bg-light rounded-3 position-absolute top-0 start-50 translate-middle">

                        
                        <div class="accordion-header" id="headingOne">
                            <a class="accordion-button bg-white collapsed container-main" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
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

        <div class="container-fluid mb-4 p-0" v-for="(hotel,index) in singleHotel" :key="index">

            <div class="container-cus">

                <div class="row border px-2 pt-2 pb-3 container-main bg-white">

                    <div class="col-12">
                        <div class="row mb-3 p-2">
                            <div class="col-md-8 col-sm-12">
                                <div class="d-flex aling-items-center my-auto">
                                    <h3 class="text-dark1 aling-middle">{{ hotel.name }}</h3>
                                    <a class="btn btn-sm my-auto ml-2 text-end" target="_blank" :href="'/social/share?id=' + hotel.id" >
                                        <img src="img/icon/shared.png" width="20" alt="share">
                                    </a>
                                </div>
                                
                                <p class="text-dark mt-2"><b-icon-geo class="d-inline my-auto mr-2 text-secondary" width="16" height="16"></b-icon-geo>{{ hotel.address }}</p>
                            </div>
                            
                            <div class="d-none d-md-block col-4 my-auto">
                                <h5 class="text-dark1 text-center">All Images</h5>                                    
                            </div>
                        </div>
                        <hr class="mb-3">
                    </div>

                    <div class="col-md-8 col-sm-12">
                        <div class="row max-height p-4">

                            <vueper-slides :slide-ratio="1 / 2" fixed-height="450px"
                            :bullets="false"
                            class="no-shadow"
                            >
                            <template #arrow-left>
                                <b-icon-chevron-left class="text-primary my-auto p-0" width="55" height="55"></b-icon-chevron-left>
                            </template>

                            <template #arrow-right>
                                <b-icon-chevron-right class="text-primary my-auto p-0" width="55" height="55"></b-icon-chevron-right>
                            </template>
                            <vueper-slide v-for="(slide, i) in hotel.images" :key="i" :image="slide.hotel_image" 
                            class="container-main"
                            />
                            </vueper-slides>

                        </div>
                    </div>

                    <div class="text-center d-md-none mb-2">
                        <a @click="handleShowPreview(hotel,i)" class="text-white btn-dark1 px-3 py-2">
                            View All {{ hotel.images.length }} Images
                        </a>
                    </div>

                    <div class="col-md-4 d-none d-md-block my-auto">
                        <div class="row p-4">
                            <div class="col-md-6 col-sm-12" v-for="(img,i) in hotel.images" :key="i">
                                <div class="image-main" v-if="(i <= 5)">
                                    <img :src="img.hotel_image" alt="Avatar" class="image img-fluid border shadow">
                                </div>
                            </div>

                            <div class="text-center col-12 m-3">
                                <a @click="handleShowPreview(hotel,i)" class="text-white btn-dark1 px-3 py-2">
                                    View All {{ hotel.images.length }} Images
                                </a>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row border p-2 container-main mt-3 bg-white">
                    <div class="col-md-8 col-sm-12 p-3">
                        <h5 class="text-dark1 text-start">Hotel Description</h5>
                         <p class="text-justify mt-3 text-dark" v-html="hotel.description"></p>  
                    </div>
                    <div class="col-md-4 col-sm-12 p-3">
                        <h5 class="text-dark1 text-start" v-if="hotel.tourPointAddress">Nearby Tourist Point</h5>
                        <p v-if="hotel.tourPointAddress" class="text-dark mt-3"><b-icon-geo-alt class="d-inline my-auto mr-2 text-primary my-auto" width="15" height="15"></b-icon-geo-alt> {{hotel.tourPointAddress}}.</p>
                        <p v-if="hotel.tourPointAddress2" class="text-dark mt-2"><b-icon-geo-alt class="d-inline my-auto mr-2 text-primary my-auto" width="15" height="15"></b-icon-geo-alt> {{hotel.tourPointAddress2}}.</p>
                        <p v-if="hotel.tourPointAddress3" class="text-dark mt-2"><b-icon-geo-alt class="d-inline my-auto mr-2 text-primary my-auto" width="15" height="15"></b-icon-geo-alt> {{hotel.tourPointAddress3}}.</p>
                        <p v-if="hotel.tourPointAddress4" class="text-dark mt-2"><b-icon-geo-alt class="d-inline my-auto mr-2 text-primary my-auto" width="15" height="15"></b-icon-geo-alt> {{hotel.tourPointAddress4}}.</p>
                    </div>
                </div>

                <div class="row border p-2 container-main mt-3 bg-white">
                    
                    <div class="col-12 p-3">
                        <h5 class="text-dark1 text-start mb-3">Hotel All Facilities</h5>
                        <div id="fes" class="d-inline-flex justify-content-between" v-for="(f,j) in hotel.features" :key="j">

                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Hill View/Mountain View'"><b-icon-binoculars class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-binoculars>Hill View/Mountain View</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Steam Bath'"><b-icon-cloud-snow-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cloud-snow-fill>Steam Bath</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Laundry Service'"><b-icon-archive class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-archive>Laundry Service</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Business Center'"><b-icon-safe class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-safe>Business Center</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Hall Room'"><b-icon-hospital class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hospital>Hall Room</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Prayer Room'"><b-icon-hospital-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hospital-fill>Prayer Room</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Tour and Travel Desk'"><b-icon-border-style class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-border-style>Tour and Travel Desk</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Water Park'"><b-icon-water class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-water>Water Park</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Doctor on Call'"><b-icon-graph-up class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-graph-up>Doctor on Call</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'DJ Party/ Night Club'"><b-icon-suit-club class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-suit-club>DJ Party/ Night Club</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'B-B-Q'"><b-icon-medium class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-medium>B-B-Q</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Safety Locker'"><b-icon-lock class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-lock>Safety Locker</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Indore Games'"><b-icon-controller class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-controller>Indore Games</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Kayaking Boat'"><b-icon-cpu class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cpu>Kayaking Boat</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Fishing'"><b-icon-eyeglasses class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-eyeglasses>Fishing</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Salon'"><b-icon-scissors class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-scissors>Salon</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Luggage Room'"><b-icon-receipt-cutoff class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-receipt-cutoff>Luggage Room</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Breakfast Included'"><b-icon-egg-fried class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-egg-fried>Breakfast Included</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Swimming pool'"><b-icon-water class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-water>Swimming pool</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Steam room'"><b-icon-cloud-snow-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cloud-snow-fill>Steam room</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Free cancellation'"><b-icon-arrow-repeat class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-arrow-repeat>Free cancellation</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Full-body massage'"><b-icon-balloon-heart class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-balloon-heart>Full-body massage</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Pet friendly'"><b-icon-bug class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bug>Pet friendly</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Kitchen facilities'"><b-icon-check-circle class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-check-circle>Kitchen facilities</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Kids Zone'"><b-icon-person-check class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-person-check>Kids Zone</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Fitness center'"><b-icon-heart-pulse class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-heart-pulse>Fitness center</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Book without credit card'"><b-icon-card-checklist class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-card-checklist>Book without credit card</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Resort Hotel'"><b-icon-box2-heart class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-box2-heart>Resort Hotel</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Sauna'"><b-icon-wind class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-wind>Sauna</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Smoking Zone'"><b-icon-bandaid class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bandaid>Smoking Zone</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == '5 stars'"><b-icon-star class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-star>5 stars</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Beach View'"><b-icon-sunset class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-sunset>Beach View</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Air conditioning'"><b-icon-fan class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-fan>Air conditioning</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Spa facilities'"><b-icon-heart-pulse-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-heart-pulse-fill>Spa facilities</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Apart Hotel'"><b-icon-hospital class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hospital>Apart Hotel</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Hotel'"><b-icon-hospital-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hospital-fill>Hotel</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Tourist Info Centre'"><b-icon-info-circle class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-info-circle>Tourist Info Centre</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Wheelchair accessibleg'"><b-icon-gpu-card class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-gpu-card>Wheelchair accessibleg</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Parking Area'"><b-icon-bezier2 class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bezier2>Parking Area</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Free WiFi'"><b-icon-wifi class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-wifi>Free WiFi</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Balcony'"><b-icon-binoculars class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-binoculars>Balcony</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'No prepayment'"><b-icon-cash-coin class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cash-coin>No prepayment</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Vehicle Parking'"><b-icon-bicycle class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bicycle>Vehicle Parking</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Medical Support'"><b-icon-bag-heart class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bag-heart>Medical Support</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Room Service'"><b-icon-alt class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-alt>Room Service</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Couple Friendly'"><b-icon-hearts class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hearts>Couple Friendly</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Bar Inside'"><b-icon-cup-straw class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cup-straw>Bar Inside</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Coffee/Tea in Lobby'"><b-icon-cup class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cup>Coffee/Tea in Lobby</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Washing machine'"><b-icon-boombox class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-boombox>Washing machine</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Alcohol Permit'"><b-icon-hurricane class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hurricane>Alcohol Permit</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Accessible Bathroom'"><b-icon-modem class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-modem>Accessible Bathroom</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Telephone'"><b-icon-telephone class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-telephone>Telephone</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Clothes Dryer'"><b-icon-border-inner class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-border-inner>Clothes Dryer</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Towel'"><b-icon-input-cursor class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-input-cursor>Towel</span>
                            <span class="d-inline text-dark m-2 rounded bg-white shadow-sm p-2" v-if="f.hotel_feature == 'Mobile Phone Coverage'"><b-icon-router class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-router>Mobile Phone Coverage</span>
                            
                        </div>
                    </div>
                    
                </div>

                <div class="row border p-2 container-main mt-3 bg-white position-relative">
                    <div class="col-12 p-3">
                        <h5 class="text-dark1 text-start mb-3">Room Type</h5>

                        <div class="row my-4 p-2 bg-light container-main" v-for="(room,i) in hotel.rent" :key="i">
                            
                            <div class="col-lg-8 col-md-12 col-sm-12">

                                <div class="row">

                                    <div class="col-lg-4 col-md-12 col-sm-12 my-auto text-center">
                                        <img :src="room.image" class="img-fluid image-main" alt="">
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12 p-3 my-auto">
                                        <h6 class="text-dark text-start mb-3 fw-bold">Room Details:</h6>
                                        <p class="text-dark text-start mb-2 fw-bold"><b-icon-aspect-ratio class="d-inline my-auto mr-2 text-success" width="15" height="15"></b-icon-aspect-ratio>{{room.offerTitle}}</p>
                                        <p class="text-dark text-start mb-2"><b-icon-inbox class="d-inline my-auto mr-2 text-success" width="15" height="15"></b-icon-inbox>{{ room.bed }}</p>
                                        <p class="text-dark text-start mb-2"><b-icon-people class="d-inline my-auto mr-2 text-success" width="15" height="15"></b-icon-people>{{ room.totalPerson }} person can stay</p>
                                        <p v-if="room.size" class="text-dark text-start mb-2"><b-icon-arrows-angle-contract class="d-inline my-auto mr-2 text-success" width="15" height="15"></b-icon-arrows-angle-contract> Size: {{ room.size }} square feet</p>
                                        <p class="text-dark text-start mb-2"><b-icon-gift class="d-inline my-auto mr-2 text-success" width="15" height="15"></b-icon-gift>Request Feature on Booking</p>
                                        <!-- <p class="text-dark text-start mb-2"><b-icon-arrow-left-right class="d-inline my-auto mr-2 text-secondary" width="15" height="15"></b-icon-arrow-left-right>Discount on Booking</p> -->
                                        <a @click="roomFeaturs(room,i)" class="text-dark fw-bold underline ml-4"> show all</a>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12 text-md-end text-sm-start my-auto container-main bg-white p-4 rounded">
                                        <h6 class="text-dark fw-bold">up to<span class="ml-4 py-2 px-4 rounded  bg-white text-center text-success fw-bolder shadow-sm">{{ room.rdiscount }}% off</span></h6>
                                        <h6 class="py-2 text-dark mt-4">Starts from</h6>
                                        <h6 class="py-2"><del class="text-danger mr-1">৳ {{ room.offerRegularPrice }}</del></h6>
                                        <h5 class="my-2 ml-0"><span class="text-dark1 fw-bold">৳ {{ room.offerDiscpuntPrice }}</span></h5>
                                        <p> <span class="text-muted"> for 1 night</span></p>
                                        <!-- <p class="mt-4 text-dark">Weekend Price <button type="button" class="bg-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Hotel Room Rent on Friday and Satuarday"><b-icon-info-circle class="d-inline my-auto ml-2 text-secondary" width="17" height="17"></b-icon-info-circle></button> </p>
                                        <p class="my-2"><del class="text-danger mr-3">৳ {{ room.WofferRegularPrice }}</del> <span class="text-dark fw-bold ml-4">৳ {{ room.WofferDiscpuntPrice }}</span> <span class="text-sm text-muted">for 1 night</span></p> -->
                                    </div>
                                    
                                </div>

                            </div>

                            <div class="col-lg-3 col-md-12 col-sm-12 my-auto text-center">
                                <a class="btn btn-dark1 mb-4 mt-2 m-lg-0 text-white aling-middle fw-bold py-2 px-3" @click="booking(room,i)"><b-icon-cart class="d-inline my-auto fw-bold mr-2 text-warning" width="20" height="20"></b-icon-cart>Reserve</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row border p-2 container-main mt-3 bg-white">
                    <div class="col-12 p-3">
                        <h5 class="text-dark1 text-start">Hotel Policy</h5>
                         <div class="bg-light p-3 mt-3 container-main">

                            <div class="p-3 d-flex my-auto row">
                                <p class="col-sm-12 col-md-4 my-auto text-dark1 fw-bold text-start"><b-icon-alarm class="d-inline my-auto mr-2 text-secondary my-auto" width="15" height="15"></b-icon-alarm>Check In</p>
                                <p class="col-sm-12 col-md-8 my-auto text-dark text-start">{{ hotel.checkIn}} AM</p>
                            </div>
                            <div class="p-3 d-flex row">
                                <p class="col-sm-12 col-md-4 my-auto text-dark1 fw-bold text-start"><b-icon-alarm class="d-inline my-auto mr-2 text-secondary my-auto" width="15" height="15"></b-icon-alarm>Check Out</p>
                                <p class="col-sm-12 col-md-8 my-auto text-dark text-start">{{ hotel.checkOut}} AM</p>
                            </div>
                            <div class="p-3 d-flex row" v-show="hotel.instruction !== '' ">
                                <p class="col-sm-12 col-md-4 my-auto text-dark1 fw-bold text-start"><b-icon-check2-square class="d-inline my-auto mr-2 text-secondary my-auto" width="15" height="15"></b-icon-check2-square>Hotel Instructions</p>
                                <p class="col-sm-12 col-md-8 my-auto text-dark text-start">
                                    <ul class="text-dark" v-for="(ins,i) in hotel.instruction" :key="i">
                                        <li v-if="ins.hotel_instruction" class="ml-4 py-1">{{ ins.hotel_instruction }}</li>
                                    </ul>
                                </p>
                            </div>
                            <div class="p-3 d-flex row" v-if="hotel.houseRules != '' ">
                                <p class="col-sm-12 col-md-4 my-auto text-dark1 fw-bold text-start"><b-icon-file-earmark-ruled class="d-inline my-auto mr-2 text-secondary my-auto" width="15" height="15"></b-icon-file-earmark-ruled> House Rules</p>
                                <p class="col-sm-12 col-md-7 my-auto text-dark text-start ml-4 py-1" v-html="hotel.houseRules"></p>
                            </div>
                            <div class="p-3 d-flex row" v-if="hotel.kidsPolicy != '' ">
                                <p class="col-sm-12 col-md-4 my-auto text-dark1 fw-bold text-start"><b-icon-balloon-heart class="d-inline my-auto mr-2 text-secondary my-auto" width="15" height="15"></b-icon-balloon-heart>Kids Policy</p>
                                <p class="col-sm-12 col-md-7 my-auto text-dark text-start ml-4 py-1" v-html="hotel.kidsPolicy"></p>
                            </div>
                            <div class="p-3 d-flex row" v-if="hotel.petPolicy != '' ">
                                <p class="col-sm-12 col-md-4 my-auto text-dark1 fw-bold text-start"><b-icon-exclamation-diamond class="d-inline my-auto mr-2 text-secondary my-auto" width="15" height="15"></b-icon-exclamation-diamond>Pet Policy</p>
                                <p class="col-sm-12 col-md-7 my-auto text-dark text-start ml-4 py-1" v-html="hotel.petPolicy"></p>
                            </div>
                            <div class="p-3 d-flex row">
                                <p class="col-sm-12 col-md-4 my-auto text-dark1 fw-bold text-start"><b-icon-currency-dollar class="d-inline my-auto mr-2 text-secondary my-auto" width="15" height="15"></b-icon-currency-dollar>Payment Accepts</p>
                                <p class="col-sm-12 col-md-8 my-auto text-dark text-start">
                                    <span v-for="(p,i) in hotel.payments" :key="i">
                                        <img v-if="p.payment_method == 'Visa'" src="img/payment/1.png" class="m-2 px-2 py-1 bg-white shadow rounded" height="45" alt="">
                                        <img v-if="p.payment_method == 'UCB'" src="img/payment/2.png" class="m-2 px-2 py-1 bg-white shadow rounded" height="45" alt="">
                                        <img v-if="p.payment_method == 'Exim'" src="img/payment/3.png" class="m-2 px-2 py-1 bg-white shadow rounded" height="45" alt="">
                                        <img v-if="p.payment_method == 'Bkesh'" src="img/payment/4.jpg" class="m-2 px-2 py-1 bg-white shadow rounded" height="45" alt="">
                                        <img v-if="p.payment_method == 'DBBL'" src="img/payment/5.jpg" class="m-2 px-2 py-1 bg-white shadow rounded" height="45" alt="">
                                        <img v-if="p.payment_method == 'MasterCard'" src="img/payment/6.png" class="m-2 px-2 py-1 bg-white shadow rounded" height="45" alt="">
                                        <img v-if="p.payment_method == 'PayPal'" src="img/payment/7.jpg" class="m-2 px-2 py-1 bg-white shadow rounded" height="45" alt="">
                                        <img v-if="p.payment_method == 'Rocket'" src="img/payment/8.png" class="m-2 px-2 py-1 bg-white shadow rounded" height="45" alt="">
                                        <img v-if="p.payment_method == 'Cash'" src="img/payment/10.png" class="m-2 px-2 py-1 bg-white shadow rounded" height="45" alt="">
                                    </span>
                                </p>
                            </div>

                        </div> 
                    </div>
                </div>

            </div>

        </div>

        <div class="cart-main p-2" v-if="cart">
            <div>
                <h5 class="text-center py-4 mb-2 bg-cart text-white fw-bolder rounded">Booking Summary</h5>
            </div>
            <b-icon-dash class="text-white fw-bolder position-absolute top-0 start-0 m-2 bg-danger rounded" @click="this.cart = !this.cart" width="20" height="20"></b-icon-dash>

            <span v-if="this.cartItem.length == 0 ">
                <div class="p-2 bg-cart2 rounded position-relative my-2">
                    <p class="text-dark text-center fw-bold p-1">No Item Added</p>
                </div>
            </span>

            <span v-else>

                <span class="row px-3 py-1" v-for="(item,i) in cartItem" :key="i">
                    <div class="col-1 py-2 my-auto position-relative" v-if="cartItem.length > 0">
                        
                        <b-icon-x-lg class="position-absolute top-50 start-0 translate-middle btn-hover text-danger mr-2" width="18" height="18" @click="deleteItem(item,i)"></b-icon-x-lg>

                    </div>
                    <div class="col-11 py-2 bg-cart2 rounded" v-if="item.hotel_name">
                        <p class="text-dark fw-bold p-1">{{ item.hotel_name }}</p>
                        <div class="d-flex">
                            <p class="text-dark p-1 mr-2 d-inline flex-grow-1"> Room No: {{ item.room_no }}</p>
                            <b-icon-dash-circle class="btn2-hover text-secondary mx-2 my-auto d-inline" width="18" height="18" @click="roomremove(item,i)"></b-icon-dash-circle>
                            <b-icon-plus-circle class="btn2-hover text-success mx-2 my-auto d-inline" width="18" height="18" @click="roomAdd(item,i)"></b-icon-plus-circle>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text-dark text-sm ml-2 d-inline">{{ item.room_type }}</p>
                            <p class="text-dark text-sm d-inline"> ৳ {{ item.price }} /=</p>
                        </div>
                    </div>
                </span>

                <hr class="text-success mt-2">
                <span class="d-flex justify-content-between" v-if="cartItem.length > 0">
                    <h6 class="text-white p-1 mr-2 d-inline">Sub Total: <span class="text-color">(Include VAT)</span> </h6>
                    <h6 class="text-white p-1 fw-bold d-inline"> ৳ {{ this.total }} /=</h6>
                </span>

            </span>
            
            <div class="text-center mt-3 mb-1" v-if="cartItem.length > 0">
                <a class="btn btn-cart fw-bolder" @click="continueBooking">Continue</a>
            </div>

        </div>

        <div class="text-center my-auto p-3 cart-icon" @click="this.cart = !this.cart">
            <b-icon-basket2 class="my-auto text-warning" width="28" height="28"></b-icon-basket2>
            <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger" v-if="this.cartItem.length > 0">
                {{this.cartItem.length}}
            </span>
        </div>
       

        <!-- Room features Modal -->
        <Modal
            v-model="Roommodal"
            footer-hide
            width="70vw"
            >
            
            <div class="p-3 rounded">

            <div class="text-center p-3 bg-light rounded border-bottom border-success">
                <h5 class="text-dark1 fw-bold">Room Facelities</h5>
                <p class="text-success mt-2">Also can request facelities on Booking</p>
            </div>

            <div class="p-3 bg-white rounded border text-center my-2" v-for="(hotel,index) in singleHotel" :key="index">

                <span class="m-2 d-inline-flex justify-content-between" v-for="(rf,f) in roomTypeFeaturs" :key="f">
                    <span v-if="rf.room_feature == 'Safety Locker'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-lock class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-lock> Safety Locker</span>
                    <span v-if="rf.room_feature == 'Ceiling Fan'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-fan class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-fan> Ceiling Fan</span>
                    <span v-if="rf.room_feature == 'safety locker'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-lock class="d-inline my-auto mr-2 text-secondary" width="16" height="16"></b-icon-lock> safety locker</span>
                    <span v-if="rf.room_feature == 'Air Conditioning'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-radioactive class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-radioactive> Air Conditioning</span>
                    <span v-if="rf.room_feature == 'Wi-Fi'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-wifi class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-wifi> Wi-Fi</span>
                    <span v-if="rf.room_feature == 'Toiletries'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-gender-ambiguous class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-gender-ambiguous> Toiletries</span>
                    <span v-if="rf.room_feature == 'Power Outlet'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-plug class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-plug> Power Outlet</span>
                    <span v-if="rf.room_feature == 'Table Fan'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-wind class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-wind> Table Fan</span>
                    <span v-if="rf.room_feature == 'Blankets'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-git class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-git> Blankets</span>
                    <span v-if="rf.room_feature == 'Closet'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-bandaid-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bandaid-fill> Closet</span>
                    <span v-if="rf.room_feature == 'Curtain'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-bookmarks-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bookmarks-fill> Curtain</span>
                    <span v-if="rf.room_feature == 'Desk'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-pc-display class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-pc-display> Desk</span>
                    <span v-if="rf.room_feature == 'Housekeeping'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-window-sidebar class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-window-sidebar> Housekeeping</span>
                    <span v-if="rf.room_feature == 'In-room Dining'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-egg-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-egg-fill> In-room Dining</span>
                    <span v-if="rf.room_feature == 'Room Service'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-bank2 class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-bank2> Room Service</span>
                    <span v-if="rf.room_feature == 'Slippers'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-shield-fill-plus class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-shield-fill-plus> Slippers</span>
                    <span v-if="rf.room_feature == 'Bathroom'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-circle-square class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-circle-square> Bathroom</span>
                    <span v-if="rf.room_feature == 'Towels'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-clipboard-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-clipboard-fill> Towels</span>
                    <span v-if="rf.room_feature == 'TV'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-tv class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-tv> TV</span>
                    <span v-if="rf.room_feature == 'Coffee/Tea Maker'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-cup-fill class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-cup-fill> Coffee/Tea Maker</span>
                    <span v-if="rf.room_feature == 'Sofa'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-grip-horizontal class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-grip-horizontal> Sofa</span>
                    <span v-if="rf.room_feature == 'Stove'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-inbox class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-inbox> Stove</span>
                    <span v-if="rf.room_feature == 'Oven'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-hurricane class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-hurricane> Oven</span>
                    <span v-if="rf.room_feature == 'Ironing Facility'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-inboxes class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-inboxes> Ironing Facility</span>
                    <span v-if="rf.room_feature == 'Refrigerator'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-journal class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-journal> Refrigerator</span>
                    <span v-if="rf.room_feature == 'Balcony'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-border-width class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-border-width> Balcony</span>
                    <span v-if="rf.room_feature == 'smoking allowance'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-question-lg class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-question-lg> smoking allowance</span>
                    <span v-if="rf.room_feature == 'Bathtub'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-robot class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-robot> Bathtub</span>
                    <span v-if="rf.room_feature == 'Hot Water'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-water class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-water> Hot Water</span>
                    <span v-if="rf.room_feature == 'Cable TV'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-router class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-router> Cable TV</span>
                    <span v-if="rf.room_feature == 'Telephone'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-telephone-forward class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-telephone-forward> Telephone</span>
                    <span v-if="rf.room_feature == 'Hairdryer'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-tornado class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-tornado> Hairdryer</span>
                    <span v-if="rf.room_feature == 'Make-up Mirror'" class="d-inline py-2 px-3 rounded bg-light text-dark"><b-icon-symmetry-vertical class="d-inline my-auto mr-2 text-success" width="16" height="16"></b-icon-symmetry-vertical> Make-up Mirror</span>
                </span>
                
            </div>

            </div>
        </Modal>

        <!-- Login Modal -->
        <Modal class="login-modal"
            v-model="Loginmodal"
            footer-hide
            >
            
            <div class="bg-transparent">

                <div class="card-body bg-transparent p-2 text-center">

                <img src="/img/logo.png" class="py-2 rounded px-4 shadow" height="80" alt="">

                <div class="mb-md-3 mt-md-3">

                    <p class="text-white mb-3">Please enter your login Email and Password!</p>

                    <div class="form-floating mb-4">
                    <input type="email" v-model="data.email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" :class="hasError('password') ? 'is-invalid' : ''">
                    <label for="floatingInput" class="text-dark">Email address</label>
                    <div class="text-danger text-start mt-2" v-if="errors['email']">
                        {{errors['email'][0]}}
                    </div>
                    </div>

                    <div class="input-group mb-3 w-100">
                    <div class="form-floating col">
                        <input v-model="data.password" name="password" :type="showPassword ? 'text' : 'password'" class="form-control" id="floatingPassword" placeholder="Password" :class="hasError('password') ? 'is-invalid' : ''">
                        <label for="floatingPassword" class="text-dark">Password</label>
                    </div>
                    <span @click="showPassword = !showPassword" class="input-group-text bg-white col-2"><b-icon-eye v-if="!showPassword" class="d-inline text-secondary mx-auto" width="15" height="15"></b-icon-eye><b-icon-eye-slash v-if="showPassword" @click="showPassword = !showPassword" class="d-inline text-secondary mx-auto" width="15" height="15"></b-icon-eye-slash></span>
                    
                    <div class="text-danger text-start mt-2 col-12" v-if="errors['password']">
                        {{errors['password'][0]}}
                    </div>
                    </div>

                    <p class="small mb-3 pb-lg-2"><a class="text-light" href="https://besttourinfo.com/user-login" target="_blank">Forgot password? <a class="text-primary">Click here</a> or Contact Our Support Team.</a></p>

                    <button @click.prevent="loginUser" class="btn btn-success col-5" type="submit">Login</button>

                </div>

                </div>

            </div>

        </Modal>

        <!-- Login/Register Modal -->
        <Modal
            v-model="modal"
            footer-hide
            >
            
            <div class="p-3 rounded">

            <div class="text-center p-3 bg-light rounded">
                <h6 class="text-danger fw-bold">You are not Logged In </h6>
                <p class="text-muted text-sm">Please Log in or Register</p>
            </div>

            <div class="row p-3 text-center my-2">
                <a @click="modalToggle" class="col py-3 bg-primary border rounded">
                    <b-icon-box-arrow-right class="d-inline text-white" width="25" height="25"></b-icon-box-arrow-right>
                    <span class="d-inline ml-2 text-white my-auto fw-bold">Login</span>
                </a>
                <div class="text-dark my-2">or</div>
                <a href="/register" class="col py-3 bg-dark border rounded">
                    <b-icon-chat-square-text class="d-inline text-white" width="25" height="25"></b-icon-chat-square-text>
                    <span class="d-inline ml-2 text-white my-auto fw-bold">Register</span>
                </a>
            </div>

            </div>
        </Modal>

      
    </div>    
</template>
  
<script>

import { Time } from 'view-ui-plus';
import HotelSearch from '../search/hotelSearch.vue';
import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'

export default {

    components: {
        VueperSlides,
        VueperSlide,
        HotelSearch
    },

    data () {
        return {
            vatTax: '',
            loading2: false,
            showPassword: false,
            cart: false,
            Loginmodal: false,
            isLoading: true,
            isReadonly: true,
            user: this.$store.state.client,
            bookingHistory: null,
            errors:{},
            modal: false,
            Roommodal: false,
            orderModal: false,
            confirmModal: false,
            singleHotel: null, 
            urlList: [],
            roomTypeFeaturs:[],
            rfId: '',
            total: '', 
            subTotal: '', 
            cartId: '',
            totalAdultPer:'',
            cartItem: [{
            }],
            book:{
                adult:1,
                child:0,
                booking_date: new Date(),
                inDate:'',
                outDate:'',
                payment_type:'',
                transction_no:'',
            },
            data:{
                email:'',
                password:'',
            },
            bookTime: 1,
            
        }
    },

    methods: {

        modalToggle(){
            this.modal= false,
            this.Loginmodal = true;
        },

        async loginUser(){
            try {
                this.loading = true;
                // Make the API call
                const res = await this.callApi("post", "/user-login", this.data);

                // Handle successful login
                if (res.status === 200 || res.status === 302) {
                    this.successMsg(res.data.msg);
                    this.$router.go();
                } 
                // Handle validation errors
                else if (res.status === 422) {
                    this.errors = res.data.errors;
                } 
                // Handle other errors
                else {
                    this.errors = { password: ["Invalid Email Password"] };
                }
            } catch (error) {
                // Log or display unexpected errors
                this.errors = { general: ["An unexpected error occurred"] };
            } finally {
                // Ensure loading is turned off regardless of the outcome
                this.loading = false;
            }
        }, 

        async roomFeaturs(room,i) {
            this.rfId = room.id;
            this.Roommodal = true;

            const res = await this.callApi("get",`home/roomFeatures?id=${this.rfId}`);
            if (res.status == 200) {
                this.roomTypeFeaturs = res.data;
                console.log(this.roomTypeFeaturs)
            } else {
                this.errorMsg();
            }
           
        },

        async getVat() {
            const res = await this.callApi("get", "vat/get");
            if (res.status == 200) {
                this.vatTax = res.data;
                //console.log(this.vatTax)
            } else {
                this.errorMsg();
            }
        },

        async getHotel() {
        
            const res = await this.callApi("get",`home/hotelDetailsSingle?id=${this.$route.query.id}`);
            if (res.status == 200) {
                this.singleHotel = res.data;
            } else {
                this.errorMsg();
            }
        },

        async getCart() {
            const res = await this.callApi("get","home/getCart");
            if (res.status == 200) {
                this.cartItem = res.data;
            } else {
                this.errorMsg();
            }
        },

        async totalPrice(){
           // console.log(this.cartItem)
            this.total = this.cartItem.reduce( (acc, item) => {
                return acc + ( 1 * item.price * this.bookTime) + Math.floor((item.price / 100) * this.vatTax[0].hotel_vat);
            }, 0);
        },

        async totalAdult(){
            this.totalAdultPer = this.cartItem.reduce( (acc, item) => {
                return acc + ( 1 * item.hotel_id * item.room_no);
            }, 0);
            //this.totalAdult = 
            //console.log(this.totalAdultPer)
        },

        async handleShowPreview (hotel,i) {

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

        async booking(room,i) {

            if(!this.user){
                this.modal = true;
            }
            else{
                this.cart = true;
                
                this.cartItem.push({
                    room_id : room.id,
                    hotel_id : room.totalPerson,
                    hotel_name : room.hotel_name,
                    hotel_address : room.hotel_address,
                    hotel_phone : room.hotel_phone,
                    hotel_email : room.hotel_email,
                    room_type : room.offerTitle,
                    room_no: 1,
                    price : room.offerDiscpuntPrice,
                    price_original : room.offerDiscpuntPrice,
                })
                const res = await this.callApi("post","home/cart", {cartItem: this.cartItem,total: this.total});
                if(res.status === 200){
                    this.successMsg("Item Added to cart, Please continue for confirm booking.");
                    this.cartItem = res.data;
                    this.totalPrice();
                }else {
                    this.errorMsg('Something went wrong! Please try again');
                }
            

            }

        },

        async roomAdd(item,i){
            this.cartId = item.id;
            item.room_no++
            const res = await this.callApi("post","home/roomAdd", {id: this.cartId, room: item.room_no, price_original: item.price_original});
            if (res.status == 200) {
                this.cartItem = res.data;
                this.totalPrice();
            } else {
                this.errorMsg();
            }
            
        },

        async roomremove(item,i){
            this.cartId = item.id;
            if(item.room_no > 1){
                item.room_no--
            }
            const res = await this.callApi("post","home/roomRemove", {id: this.cartId, room: item.room_no, price_original: item.price_original});
            if (res.status == 200) {
                this.cartItem = res.data;
                this.totalPrice();
            } else {
                this.errorMsg();
            }
            
        },

        async deleteItem(item,i){
            this.cartId = item.id;
            const res = await this.callApi("post","home/delete_cart", item);
            if (res.status == 200) {
                this.cartItem.splice(i,1);
                this.totalPrice();
                this.successMsg("Cart Item deleted Successfully.");
            } else {
                this.errorMsg();
            }
            
        },

        async continueBooking(){
            window.location ='/hotel-booking';
        },


    },

    created(){
        this.getHotel();
        this.getCart();
        this.getVat();
        //this.getBookingHistory();
        setTimeout(() => {
            this.isLoading = false;
            this.totalPrice();
            this.totalAdult();
        }, 1000); 
    },
}
</script>
  
<style scoped>
.text-color{
    color: #cbcaca;
    font-size: 12px;
}
.btn-hover:hover{
    border: .5px solid red;
    cursor: pointer;
}
.btn2-hover:hover{
    border: 1px solid rgba(255, 0, 0, 0);
    cursor: pointer;
}
.bg-cart {
     background: linear-gradient(0.25turn, #148516, #2b6201, #9a5001);
}

.bg-cart2 {
    background: linear-gradient(0.25turn, #e0f8e1, #fffded, #fffde4);
}

.cart-main{
    position: fixed;
    top: 29%;
    right: 0;
    max-height: 350px;
    width: 325px;
    background: #173816;
    border-radius: 7px;
    overflow-y: auto;
    overflow-x: hidden;
    z-index: 1000 !important;
}

.text-dark{
    color: #000;
}
.cart-icon{
    position: fixed;
    top: 33%;
    right: 0;
    background: linear-gradient(0.25turn, #146f15, #1e4600, #834400);
    border-radius: 7px;
    transition: transform .3s;
    border: 1px solid #fff;
    z-index: 100 !important;
}
.cart-icon:hover{
    background: #000 !important;
    transform: scale(1.05);
}

.btn-cart{
    background: #067704;
    padding: 7px 15px;
    border-radius: 7px;
    color: #efededd9;
    font-weight: bold;
    border-bottom: .5px solid #ffffffc3;
    transition: transform .3s;
}

.btn-cart:hover{
    background: linear-gradient(0.25turn, #3f87a6, #1e4600, #834400);
    color: #efeded;
    font-weight: bold;
    border-bottom: .5px solid #ffffffc3;
    transform: scale(1.05);
}

.text-btn{
    background: linear-gradient(0.25turn, #3f87a6, #1e4600, #834400);
    padding: 10px 18px;
    border-radius: 10px;
    color: #efeded;
    font-weight: bolder;
}
.text-btn:hover{
    background: linear-gradient(0.25turn,#834400,#3f87a6,#1e4600);
    padding: 9px 17px;
    border-radius: 10px;
    color: #ffffff;
    font-weight: bolder;
}
.widthCus{
    width: 100px;
}
.container-cus{
    width: 90%;
    margin-left: auto;
    margin-right: auto;
}
.main {
  padding-top: 180px;
  padding-bottom: 70px;
  background-image:  repeating-radial-gradient( circle at 0 0, transparent 0, #626262b0 5px ), repeating-linear-gradient( #093200bb, #000000c2 );
  margin-bottom: 25px;
}
.image-main {
  border-radius: 7px;
}
.container-main {
  border-radius: 7px;
}

.image-main {
  position: relative;
  padding: 2px 0px;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
  border-radius: 7px;
}

.rounded-cos{
  /* opacity: .8;  
  border-radius: 8px;
  font-size: 11px;
  background: linear-gradient(0.25turn,#763d00, #000000, #1f4800);
  color: #fff;
  font-weight: bolder; */
  margin-right: 3px;
  margin-bottom: 3px;
  padding: 5px;
  
}
.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}

.image-main:hover .image {
  transform: scale(1.02); 
}

.image-main:hover .middle {
  opacity: 1;
}
.text {
  background: linear-gradient(0.25turn, #3f87a6, #398300, #f69d3c);
  color: white;
  font-weight: 600;
  font-size: 15px;
  padding: 3px 10px;
  border-radius: 8px;
  cursor: pointer;
}

.max-height{
    height: 500px;
}

.bg{
    background: linear-gradient(0.25turn, #093f56, #714e02, #9b5203);
}
.bg2{
    background: linear-gradient(0.25turn,#ddfbc612, #f69c3c23, #3f87a63a) !important;
}
.bg-card-bg{
    background: #3f87a61e;
    border-radius: 5px;
}
.border-cus{
    border: 1px solid #4a7f9649;
    background: linear-gradient(0.25turn,#ddfbc63c, #f69c3c52, #3f87a670) !important;
}

.input-group-text {
  border-left: 0 !important;
  
}

#floatingPassword{
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}

</style>