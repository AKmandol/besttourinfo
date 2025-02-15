<template>
  <div>

        <div v-if="isLoading" class="preloader">
            <div class="spinner"></div>
        </div>
     
      <div class="container-fluid main bg-dark mb-5 position-relative mt-50 p-0">

          <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white shadow border-bottom rounded position-absolute top-100 start-50 translate-middle">
                  <div class="d-flex justify-content-center aling-items-center p-2">
                      <router-link to="/" class="nav-link bg-white border shadow rounded">
                          <b-icon-grid-fill class="d-inline nav-icon" width="15" height="15"></b-icon-grid-fill>
                          <span class="d-inline ml-2 text-dark fw-bold mr-2">Home</span>
                      </router-link>
                      <span class="text-secondary my-auto mx-sm-2 mx-md-4"><b-icon-arrow-bar-left class="d-inline nav-icon" width="25" height="25"></b-icon-arrow-bar-left></span>
                      <router-link to="/about" class="nav-link bg-white border shadow rounded">
                          <b-icon-trophy class="d-inline nav-icon" width="15" height="15"></b-icon-trophy>
                          <span class="d-inline text-dark fw-bold ml-2">About Us</span>
                      </router-link>
                  </div>
              </div>
          </div>

      </div>
     
      <div class="container-fluid bg-dark mb-0 pb-0">
        <div class="mt-70p">
            <div class="row py-4 mx-auto ">
                
                <div class="col-md-3 col-sm-12 py-4 d-flex aling-items-center justify-content-md-start justify-content-center">
                    <b-icon-calendar-day-fill class="text-info" width="30" height="30"></b-icon-calendar-day-fill>
                    <h6 class="my-auto ml-2 text-white">Years of exprience<span class="text-success ml-2">5+</span></h6> 
                </div>

                <div class="col-md-3 col-sm-12 py-4 d-flex aling-items-center justify-content-center">
                    <b-icon-person-hearts class="text-warning" width="30" height="30"></b-icon-person-hearts>
                    <h6 class="my-auto ml-2 text-white">Clients<span class="text-success ml-2">2500+</span></h6> 
                </div>

                <div class="col-md-3 col-sm-12 py-4 d-flex aling-items-center justify-content-center">
                    <b-icon-person-workspace class="text-primary" width="30" height="30"></b-icon-person-workspace>
                    <h6 class="my-auto ml-2 text-white">Employee<span class="text-success ml-2">50+</span></h6> 
                </div>

                <div class="col-md-3 col-sm-12 py-4 d-flex aling-items-center justify-content-center justify-content-md-end">
                    <b-icon-broadcast class="text-danger" width="30" height="30"></b-icon-broadcast>
                    <h6 class="my-auto ml-2 text-white">Country<span class="text-success ml-2">7+</span></h6> 
                </div>

            </div>
        </div>
      </div>

      <div class="container-fluid bg-white pt-4 px-0">
        <div class="mt-70p my-3 p-cus">

                <div class="row bg-white p-0">
                    <h3 class="text-dark py-3 text-center border-cus fw-bold mb-4">About Us</h3>

                    <div class="col-md-7 col-sm-12">
                        <div class="py-3">

                            
                            <div class="rounded my-auto">
                                
                                <div class="data mb-4" v-for="(ab,i) in about" :key="i">
                                    <h6 v-html="ab.text" class="text-justify"></h6>
                                </div>

                                <div class="p-4 bg-dark1 rounded">
                                    <a href="/contact" class="text-white text-center fw-bold fs-6">Have Query ? Contact Us Now...</a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 col-sm-12 my-auto">
                        <div class="text-center">
                            <img src="/img/about.jpg" class="img-fluid rounded" alt="">
                        </div>
                    </div>

                </div>

                <div class="row mt-5 py-3 rounded bg-light px-0">

                    <h4 class="text-dark py-3 text-center border-cus fw-bold mb-4">FAQ'S</h4>

                    <span  class="col-sm-12 col-md-10 mx-auto d-flex justify-content-between" v-for="(f,i) in faq" :key="i">

                        <Collapse class="w-100" accordion>
                            <Panel>
                                {{ f.title }}
                                <template #content>{{ f.text }}</template>
                            </Panel>
                        </Collapse>

                    </span>

                    <!-- <div class="col-md-6 col-sm-12">
                        <div class="shadow rounded p-3 bg-white">

                            <div class="rounded my-3">

                                <div class="accordion accordion-flush border rounded" id="accordionFlushExample">

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Where are we locate?
                                        </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="text-dark">3 No Circle Area, Bandarban Sadar, Bandarban.</p>
                                            </div>                                    
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingThree">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                            How to contact us?
                                        </button>
                                        </h2>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="text-dark"> <span class="fw-bold">Call Us at </span> 01718274787.</p>
                                                <p class="text-dark"> or <span class="fw-bold">Email Us at </span> info@besttourinfo.com</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingFour">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                            Why choose us?
                                        </button>
                                        </h2>
                                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="text-dark">We are one of the best Travel Agency in Bnagladesh. BestTourInfo has always keep their reputation of most clint support.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingFive">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-headingFive">
                                            About our team?
                                        </button>
                                        </h2>
                                        <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="text-dark">We have an experienced and skilled team who understand your dream travel expectations and are always ready to fulfill them in the shortest possible time and on your requirements and budget.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingSix">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-headingSix">
                                            Is there any hidden charges?
                                        </button>
                                        </h2>
                                        <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="text-dark"><span class="fw-bold">No.</span> There is no hidden charge.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading7">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse7" aria-expanded="false" aria-controls="flush-heading7">
                                            How do I make a booking on Best Tour Info?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse7" class="accordion-collapse collapse" aria-labelledby="flush-heading7" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="text-dark">You can book your desire room at our website “besttourinfo.com”. Please follow the steps below for booking on Best Tour Info</p>
                                                <h6 class="text-dark fw-bold mt-3 mb-2">Follow this steps for Booking:</h6>

                                                <ul class="p-3 ml-3">
                                                    <li>Click the Stay's tab from our homepage.</li>
                                                    <li>Enter your destination, desired date, Room Quantity and No of Persons.</li>
                                                    <li>Click the SEARCH HOTELS button. You'll get a page with a hotel list that is available on your desired date and destination.</li>
                                                    <li>First, click on show details and get the full hotel details. Then select your rooms from the available option.</li>
                                                    <li>Then click Reserve, which will take you to a booking page where you will need to update your information.</li>
                                                    <li>Finally, pay through your card or MFS to complete your purchase.
                                                        *You can also do the booking by dialing our hotline numbers. Hotline +8801718274787 or you can email us at info@besttourinfo.com with your basic requirements for booking. For any kind of support, please email at support@besttourinfo.com. 
                                                    </li>
                                                    
                                                </ul>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading8">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse8" aria-expanded="false" aria-controls="flush-heading8">
                                        Can you provide the room rates per person or room-wise on Best Tour Info?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse8" class="accordion-collapse collapse" aria-labelledby="flush-heading8" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="text-dark">You will see the room rates as per room choice. You will never see room rent as per person.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading9">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse9" aria-expanded="false" aria-controls="flush-heading9">
                                            Can I check for budget hotels on Best Tour Info?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse9" class="accordion-collapse collapse" aria-labelledby="flush-heading9" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="text-dark"> You can easily filter hotels to find the best match within your budget. Search for hotels at your desired destination, click on the "Lowest Price" filter, and find the budget hotels for your convenience.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading10">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse10" aria-expanded="false" aria-controls="flush-heading10">
                                            Does the room rates include tax and service charges on Best Tour Info?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse10" class="accordion-collapse collapse" aria-labelledby="flush-heading10" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="text-dark"> Yes, the room rates include tax, service charge and others.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading11">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse11" aria-expanded="false" aria-controls="flush-heading11">
                                            What are the payments procedure?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse11" class="accordion-collapse collapse" aria-labelledby="flush-heading11" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <h6 class="text-dark fw-bold mt-3 mb-2">You can pay through– </h6>

                                                <ul class="p-3 ml-3">
                                                    <li>Online Bank Transfer.</li>
                                                    <li> By Credit/Debit Card on website or</li>
                                                    <li>MFS (Mobile Financial Services).</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading12">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse12" aria-expanded="false" aria-controls="flush-heading12">
                                            Can I upgrade my room?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse12" class="accordion-collapse collapse" aria-labelledby="flush-heading12" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="text-dark">Yes you can. Upgradation might be possible which will depend on availability. Due to that price may increase which need to settle first to confirm upgradation.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading13">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse13" aria-expanded="false" aria-controls="flush-heading13">
                                            Can I Change my room type?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse13" class="accordion-collapse collapse" aria-labelledby="flush-heading13" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="text-dark">Yes you can. Which will depend on availability. If price decrease you will not get refund. If price increases upgradation policy applies.</p>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading14">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse14" aria-expanded="false" aria-controls="flush-heading14">
                                            How to begin room upgradation process?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse14" class="accordion-collapse collapse" aria-labelledby="flush-heading14" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <p class="text-dark">Send us an email on mailing trail of your booking confirmation at suport@besttourinfo.com  It is necessary for information. Settle increased room price to confirm upgradation.</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="shadow rounded p-3 bg-white">

                            <div class="rounded my-3">

                                <div class="accordion accordion-flush border rounded" id="accordionFlushExample2">

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading15">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse15" aria-expanded="false" aria-controls="flush-heading15">
                                            What is the cancellation policy for hotel booking on Best Tour Info?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse15" class="accordion-collapse collapse" aria-labelledby="flush-heading15" data-bs-parent="#accordionFlushExample2">
                                            <div class="accordion-body">
                                                <p class="text-dark">In the room details section, you will find the cancellation policy for the room. Each room type has different types of cancellation policies.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading16">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse16" aria-expanded="false" aria-controls="flush-heading16">
                                            May I know why there is more than one rate for the same room type?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse16" class="accordion-collapse collapse" aria-labelledby="flush-heading16" data-bs-parent="#accordionFlushExample2">
                                            <div class="accordion-body">
                                                <p class="text-dark"> Room rents are sometimes different on the exact search. And this is because of special discounts, offer prices, promotions and cancellation policy.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading17">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse17" aria-expanded="false" aria-controls="flush-heading17">
                                            How can I be sure whether I received a discount on Best Tour Info?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse17" class="accordion-collapse collapse" aria-labelledby="flush-heading17" data-bs-parent="#accordionFlushExample2">
                                            <div class="accordion-body">
                                                <p class="text-dark">You can know if you have received a discount as it shows along with the room's actual rent and your final price after the applicable discount. That is how you will know the availed deal.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading18">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse18" aria-expanded="false" aria-controls="flush-heading18">
                                            Can I add an extra bed in my room?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse18" class="accordion-collapse collapse" aria-labelledby="flush-heading18" data-bs-parent="#accordionFlushExample2">
                                            <div class="accordion-body">
                                                <p class="text-dark"> Yes, you can easily add an extra bed in your desired room. However, you need to notify us beforehand to get the service on time. Plus, an additional charge may apply based on some property available.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading20">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse20" aria-expanded="false" aria-controls="flush-heading20">
                                            When sharing a room with their parents, is there an additional charge for children?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse20" class="accordion-collapse collapse" aria-labelledby="flush-heading20" data-bs-parent="#accordionFlushExample2">
                                            <div class="accordion-body">
                                                <p class="text-dark"> Children below 8 years can share a room with their parents. And this will not include any additional charge. However, this depends solely on the hotel's policy which you will find in the terms and conditions section.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading21">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse21" aria-expanded="false" aria-controls="flush-heading21">
                                            Why is "Non-refundable" stated next to my room type?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse21" class="accordion-collapse collapse" aria-labelledby="flush-heading21" data-bs-parent="#accordionFlushExample2">
                                            <div class="accordion-body">
                                                <p class="text-dark"> This means when you rent this specific room at that price, you cannot claim a refund even if you want to cancel the room.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading22">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse22" aria-expanded="false" aria-controls="flush-heading22">
                                            How do I apply for refund/cancellation on Best Tour Info?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse22" class="accordion-collapse collapse" aria-labelledby="flush-heading22" data-bs-parent="#accordionFlushExample2">
                                            <div class="accordion-body">
                                                <p class="text-dark"> Yes, you can reach us through Customer Support or send an email to suport@besttourinfo.com.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading23">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse23" aria-expanded="false" aria-controls="flush-heading23">
                                            What is the refund policy?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse23" class="accordion-collapse collapse" aria-labelledby="flush-heading23" data-bs-parent="#accordionFlushExample2">
                                            <div class="accordion-body">
                                                <p class="text-dark">The EMI charge will be deducted from the payable amount in case of refund.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading24">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse24" aria-expanded="false" aria-controls="flush-heading24">
                                            For a check-in date of today, is it possible to make a booking on the Best Tour Info website?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse24" class="accordion-collapse collapse" aria-labelledby="flush-heading24" data-bs-parent="#accordionFlushExample2">
                                            <div class="accordion-body">
                                                <p class="text-dark">You can book that preferred room if you can see the room available on our Best Tour Info website or mobile App.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading25">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse25" aria-expanded="false" aria-controls="flush-heading25">
                                            Why has the room rate changed?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse25" class="accordion-collapse collapse" aria-labelledby="flush-heading25" data-bs-parent="#accordionFlushExample2">
                                            <div class="accordion-body">
                                                <p class="text-dark">Room rates can change anytime due to the Hotel Authorities' terms and conditions.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading26">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse26" aria-expanded="false" aria-controls="flush-heading26">
                                            What cards are eligible?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse26" class="accordion-collapse collapse" aria-labelledby="flush-heading26" data-bs-parent="#accordionFlushExample2">
                                            <div class="accordion-body">
                                                <p class="text-dark">Credit cards from selected issuing banks are eligible to purchase with EMI. In that case, transaction amount must be equal to or higher than BDT 5,000.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading27">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse27" aria-expanded="false" aria-controls="flush-heading27">
                                            Is there any additional Interest applicable for EMI?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse27" class="accordion-collapse collapse" aria-labelledby="flush-heading27" data-bs-parent="#accordionFlushExample2">
                                            <div class="accordion-body">
                                                <p class="text-dark">You can avail EMI without paying additional interest. But you might need to pay a small convenience fee depending on your tenure and issuer bank.</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading28">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse28" aria-expanded="false" aria-controls="flush-heading28">
                                            Is it required to submit anything physically to process the EMI?
                                        </button>
                                        </h2>
                                        <div id="flush-collapse28" class="accordion-collapse collapse" aria-labelledby="flush-heading28" data-bs-parent="#accordionFlushExample2">
                                            <div class="accordion-body">
                                                <p class="text-dark">No. This is an online EMI facility so physical copy is not required.</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div> -->

                </div>
        </div>
      </div>
  </div>
</template>

<script>

export default {

data(){
    return {
        isLoading: true,
        about:null,
        faq:null,
        value:1,
        }
    },

methods: {
    async getAbout() {
      const res = await this.callApi("get", "home/get/about");
      if (res.status == 200) {
          this.about = res.data;
      } else {
          this.errorMsg();
      }
    },

    async getFaq() {
      const res = await this.callApi("get", "home/get/faq");
      if (res.status == 200) {
          this.faq = res.data;
      } else {
          this.errorMsg();
      }
    },
},

async created(){
    this.getAbout();
    this.getFaq();
    setTimeout(() => {
        this.isLoading = false;
    }, 300);
}

}
</script>

<style scoped>

 .data ol>li {
    margin-left: 30px !important;
    color: red !important;
}
.bg-dark1 {
   background: linear-gradient(0.25turn,#00202e, #2f0d00, #00202e) !important;
}
.border-cus{
   border-bottom: 5px solid #005610e0;
   border-top: 0;
   border-left: 0;
   border-right: 0;
}
.accordion-body{
    background: #e8f8fbc3;
    padding-top: 30px !important;
    padding-bottom: 30px !important;
}
.p-cus{
    padding-top: 40px;
    padding-bottom: 40px;
}
.mt-70p{
  width: 80vw;
  margin-left: auto;
  margin-right: auto;
  margin-top: 0 !important;
  padding-top: 0 !important;
}
.p-style{
  color: #000;
  line-height: 2;
  text-align: justify;
  padding: 8px;
}
.main {
  height: 200px;
  padding: 200px 0;
  background-color: #cbb1e8 !important;
  background-image: url("/img/bg/dark-wood.png");
 
}
</style>