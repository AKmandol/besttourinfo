<template>
  <div>

    <div v-if="isLoading" class="preloader">
      <div class="spinner"></div>
    </div>

    <div class="container-fluid main-first1">

      <div class="container position-relative bg-white border shadow container-main py-4 px-2 px-md-2">

          <div class="accordion" id="accordionExample">

              <div class="border p-3 d-flex flex-row shadow bg-light container-main position-absolute top-0 start-50 translate-middle">

                  
                  <div class="accordion-header" id="headingOne">
                      <a class="accordion-button container-main bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
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

    <div class="container-fluid bg-light mb-0 px-0">
      <div class="mt-0p pb-2 pt-4">
        <div class="row bg-white">
          <div class="col-12 mx-auto p-4 rounded border" v-if="this.searchdData != ''">
            <h4 class="text-center text-dark fw-bolder"><b-icon-search class="d-inline text-success mr-2" width="25" height="25"></b-icon-search>Search Results</h4>
          </div>
          <div class="col-12 mx-auto p-4 min-h-100 bg-light" v-else>
            <h4 class="text-center text-dark fw-bolder"><b-icon-search class="d-inline text-secondary mr-2" width="25" height="25"></b-icon-search>No Search Data Found</h4>
          
           <div class="text-center mt-4">
            <a href="/"><b-icon-arrow-return-left class="d-inline text-success mr-2" width="17" height="17"></b-icon-arrow-return-left> Back to Home Page</a>
           </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid bg-light mt-0 py-4 px-0">

      <div class="mt-0p">

            <div class="row my-auto">

              <div class="col-12">

                <div class="div-hover row bg-white shadow border rounded mx-auto my-auto py-3 d-flex justify-content-between flex-column flex-md-row search-item mb-3" v-for="(hotel,i) in searchdData" :key="i">

                  <div class="col-lg-3 col-md-12 bg-white my-auto">
                      
                      <vueper-slides 
                        :infinite="true" 
                        :bullets="false"
                        fixed-height="220px"
                        class=""
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

                  <div class="col-lg-5 col-md-12 bg-light rounded mx-auto my-auto">

                      <div class="row my-auto">
                      <div class="col-8 pt-2 pb-4 pl-3 mt-1 text-start my-auto">
                          <p class="d-inline fw-bold text-dark" v-if="hotel.stars" >Stars:</p>
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
                          <a class="btn-sm my-auto btn btn-success rounded mt-2"  :href="'/hotel-info?id=' + hotel.id" target="_blank">Details</a>
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

                      <div v-if="hotel.tourPointAddress" class="d-flex aling-items-center ml-2 mt-2">
                      <b-icon-capslock class="d-inline my-auto mr-2 text-primary" width="15" height="15"></b-icon-capslock>
                      <p class="text-dark1 text-center">Only {{ hotel.total_room }} Rooms Available</p>
                      </div>
                      <div v-if="hotel.tourPointAddress2" class="d-flex aling-items-center ml-2 mt-2">
                      <b-icon-geo class="d-inline my-auto mr-2 text-secondary" width="10" height="10"></b-icon-geo>
                      <p class="text-muted text-sm text-center"> {{ hotel.tourPointAddress }}</p>
                      </div>

                      <div class="pl-3 mt-2">
                      
                      <span v-for="(p,u) in hotel.images" :key="u" class="p-2"  @click="handleShowPreview(hotel,i)">
                      
                        <img v-if="u <= 6" :src="p.hotel_image" alt="" class="border rounded" width="50">
                      
                      </span>
                      <div class="w-100">
                        <a @click="handleShowPreview(hotel,i)" class="text-dark btn bg-lightYy text-sm float-end mb-2"><b-icon-eye class="d-inline my-auto mr-1 text-warning" width="15" height="15"></b-icon-eye> View All</a>
                      </div>
                      
                      </div>

                  </div>

                  <div class="col-lg-4 col-md-12 bg-white rounded mx-auto my-auto">

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
                          <Tag type="dot" color="success"><span class="fw-bold text-dark fs-6">{{ p.rdiscount }}%</span></Tag>
                          <p class="px-4 py-1 text-dark rounded my-auto text-sm fw-bold">Discount</p>
                          <!-- <a :href="'/hotel-info?id=' + hotel.id" target="_blank" class="text-sm btn btn-sm btn-dark1 rounded text-white px-3 py-1 my-auto">Full Details</a> -->
                      </span>
                      <span v-else></span>
                      </div>

                      <div class="mt-2 border rounded">
                      
                      <div class="border-bottom bg-light d-flex justify-content-start">
                          <p class="text-success fw-bolder my-auto ml-2 p-2">Featuares</p>
                      </div>
                      
                      <div class="h-l-fixed">
                          <div class="d-inline-flex justify-content-between" v-for="(f,j) in hotel.features" :key="j">

                              <div class="d-inline-flex justify-content-between" v-if="j <= 3">

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
                  <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.searchdData != ''" @on-change="searchHotel" />
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
import HotelSearch from '../search/hotelSearch.vue';

export default {

  components: {
    VueperSlides,
    VueperSlide,
    HotelSearch
  },

  data() {
    return {
      urlList:[
       
      ],
      featuremodal: false,
      featuresAll: null,
      see: false,
      isLoading: true,
      isReadonly: true,
      singleHotel:'',
      bookingHistory:false,
      errors:{},
      modal: false,
      confirmModal: false,
      orderModal: false,
      user: this.$store.state.client,
      total:4,
      pageInfo: null,
      value:[],
      searchdData:[], 
      hotel: this.$store.state.property,
      filter: ['less1'],

      data:{
        room: this.$store.state.searchedData.room,
        adult: this.$store.state.searchedData.adult,
        child: this.$store.state.searchedData.child,
        range: {
          start: new Date(),
          end: new Date(),
        },
          
      },
       book:{
        room: 1,
        adult:1,
        child:0,
        booking_date: new Date(),
        inDate:'',
        outDate:'',
        hotel_name:'',
        hotel_address: '',
        hotel_phone: '',
        hotel_email: '',
        hotel_price: '',
        id:'',
        hotel_type:'',
        payment_type:'',
        transction_no:'',
       }
    }
  },

  methods: {


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
    
    async searchHotel(page) {
      this.isLoading = true;
      const res = await this.callApi("get",`/home/search-hotel?str=${this.$route.query.str}&total=${this.total}&page=${page}&filter=${this.filter}`);
      if (res.status == 200) {
        this.searchdData = res.data.data;
        this.pageInfo = res.data;
        this.isLoading = false;
      } else {
        this.errorMsg();
      }
      
    },

    async getHotel() {
        const res = await this.callApi("get",`home/hotelDetailsSingle?id=${this.book.id}`);
        if (res.status == 200) {
            this.singleHotel = res.data;
            //console.log(this.singleHotel)
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
      //console.log(this.featuresAll)
    },

    // async booking(hotel,i) {
    //   this.book.id = hotel.id;
    //   this.book.hotel_name = hotel.name;
    //   this.book.hotel_address = hotel.address;
    //   this.book.hotel_phone = hotel.phone;
    //   this.book.hotel_email = hotel.email;
    //   this.book.inDate = hotel.check_in;
    //   this.book.outDate = hotel.check_out;
    //   this.getHotel();
    //   if(!this.user){
    //     this.modal = true;
    //   }
    //   else{
    //     this.orderModal = true;
        
    //   }
      
    // },

    async confirmEmail(){
        const res = await this.callApi("get","order/mailsend");
        if (res.status == 200) {
        //this.hotelList = res.data;
        //console.log(this.hotelList)
        } else {
        this.errorMsg();
        }
    },

    // async confirmBooking(){
      
    //     if(this.book.hotel_price == ''){
    //       this.errorMsg('Please Select a Room Type');
    //     }

    //     this.book.hotel_price = document.getElementById('wo').value;
        
    //     console.log(this.book)
    //     const res = await this.callApi("post","home/order", this.book);
    //     if(res.status === 200){
    //         this.successMsg("Your Booking Has Been Placed");
    //         this.errors = {};
    //         // this.book = {};
    //         this.orderModal = false;
    //         this.confirmModal = true;
    //         this.confirmEmail();
    //     }else if (res.status === 422) {
    //         for(let i in res.data.errors){
    //         this.errors = res.data.errors
    //         }
    //     }
    //     else {
    //         this.errorMsg('Something went wrong! Please try again');
    //     }
    // }
                
  },

  created(){
    this.searchHotel();
    setTimeout(() => {
      this.isLoading = false;
    }, 1000); 
   
    //console.log(this.$route.query.str)
  }
}
</script>

<style>

.widthCus{
    width: 100px;
}

.bg-lightY{
  border: 1px solid #00505023;
  font-size: 201px !important;
}
.bg-lightYy{
  background:#e4feff55;
  border: .5px solid #03909545;
}

.h-fixed{
    height: 350px;
    overflow-y: auto;
}
.bg-card {
  background: rgba(39, 29, 0, 0.1);
}
.widthVw {
  width: 80vw !important;
}
.ivu-modal-body{
  max-height: 70vh !important;
  overflow-y: auto;
}

@media (max-width: 576px) { 
  .widthVw {
  width: 100vw !important;
  }
}

.img-margin{
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}
.h-row {
  position: relative;
  height: 80vh;
  
}
.left-menu {
  
  height: 100vh;
  overflow: auto;
}
.right-menu {
  position: absolute;
  top: 0;
  right: 0;
}
.border-right {
  border-right: .5px dashed gray;
}
.search-item {
  height: max-content;
}
.main-first1 {
  padding: 230px 0 100px 0 ;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
  width: 100%;
  background-color: #008c8c;
  background-image: url("/img/bg/brick-wall-dark.png");
/* This is mostly intended for prototyping; please download the pattern and re-host for production environments. Thank you! */
}
 .mt-500 {
    margin-top:70px;
 }

 .form-check-input {
  width: 17px;
  height: 17px;
}

.border-right-down {
  border-bottom-right-radius: 0 !important;
  border-bottom-left-radius: 0 !important;
}

.min-h-100{
  min-height: 60vh;
}

.h-l-image{
  height: 140px !important;
}

.h-l-fixed{
  height: max-content !important;
  overflow-y: auto;
}

.bg{
    background: linear-gradient(0.25turn, #3f87a6, #398300, #f69d3c);
}
.bg2{
    background: linear-gradient(0.25turn,#ddfbc612, #f69c3c23, #3f87a63a) !important;
}
.bg-card-bg{
    background: #3f87a61e;
}
.border-cus{
    border: 1px solid #4a7f9649;
}

.mt-0p{
    width: 80vw !important;
    margin-left: auto;
    margin-right: auto;
}

</style>