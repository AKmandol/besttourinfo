<template>
    <div>
  
        <!-- Modal -->
        <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-header">
                        <h5 class="modal-title fw-bloder color-white" id="exampleModalLabel">See Full Details</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <b-icon-x-lg class="d-inline text-danger" width="16" height="16"></b-icon-x-lg>
                        </button>
                    </div>

                    <div class="modal-body modal-height m-0 p-0">

                        <div class="row p-0 m-0">

                            <div class="col-md-6 mx-auto p-3 m-1">

                                <h6 class="text-start p-3 fw-bolder bg-header rounded table-border-dark color-white">Basic Information</h6>

                                <div class="table-responsive rounded my-2">
                                    <table class="table table-striped table-hover justify-content-between">

                                        <tbody> 
                                            <tr>
                                                <td class="fw-bold color-white">Hotel Name</td>
                                                <td class="fw-bold">{{ hotels.name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold color-white">Phone Number</td>
                                                <td>{{ hotels.phone }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold color-white">Email Address</td>
                                                <td>{{ hotels.email }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold color-white">Hotel Full Address</td>
                                                <td>{{ hotels.address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold color-white">City</td>
                                                <td>{{ hotels.city }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold color-white">State</td>
                                                <td>{{ hotels.country }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold color-white">Zip Code</td>
                                                <td>{{ hotels.zip }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold color-white">Check In Time</td>
                                                <td>{{ hotels.checkIn }}</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold color-white">Check Out Time</td>
                                                <td>{{ hotels.checkOut }}</td>
                                            </tr>
                                            <tr v-if="hotels.tourPointAddress">
                                                <td class="fw-bold color-white">Distance From Tour Location-1</td>
                                                <td>{{ hotels.tourPointAddress }}</td>
                                            </tr>
                                            <tr v-if="hotels.tourPointAddress2">
                                                <td class="fw-bold color-white">Distance From Tour Location-2</td>
                                                <td>{{ hotels.tourPointAddress2 }}</td>
                                            </tr>
                                            <tr v-if="hotels.tourPointAddress3">
                                                <td class="fw-bold color-white">Distance From Tour Location-3</td>
                                                <td>{{ hotels.tourPointAddress3 }}</td>
                                            </tr>
                                            <tr v-if="hotels.tourPointAddress4">
                                                <td class="fw-bold color-white">Distance From Tour Location-4</td>
                                                <td>{{ hotels.tourPointAddress4 }}</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="p-3 table-border-dark my-2 rounded details-card">
                                    <h6 class="text-start mb-3 fw-bold color-white">Offer Details:</h6>
                                    <p class="text-justify"><span class="color-main fw-bold mr-3">Top Left Offer--</span>{{ hotels.floor_no }}</p>
                                    <p class="text-justify"><span class="color-main fw-bold mr-3">Top Right Offer--</span>{{ hotels.	right_top }}</p>
                                    <p class="text-justify"><span class="color-main fw-bold mr-3">Bottom Right Offer--</span>{{ hotels.constraction_year }}</p>
                                    <p class="text-justify"><span class="color-main fw-bold mr-3">Lowest Price--</span>{{ hotels.discount }}</p>
                                </div>

                            </div>

                            <div class="col-md-6 mx-auto p-3 m-1">
                                
                                <h6 class="text-start p-3 fw-bolder rounded bg-header color-white table-border-dark">Other Information</h6>
                                
                                <div class="p-3 table-border-dark my-2 rounded details-card">
                                    <h6 class="text-start mb-3 fw-bold color-white">Description:</h6>
                                    <p class="text-justify">{{ hotels.description }}</p>
                                </div>
                                <div class="p-3 table-border-dark my-2 rounded details-card">
                                    <h6 class="text-start mb-3 fw-bold color-white">House Rules:</h6>
                                    <p class="text-justify">{{ hotels.houseRules }}</p>
                                </div>
                                <div class="p-3 table-border-dark my-2 rounded details-card">
                                    <h6 class="text-start mb-3 fw-bold color-white">Kids Policy:</h6>
                                    <p class="text-justify">{{ hotels.kidsPolicy }}</p>
                                </div>
                                <div class="p-3 table-border-dark my-2 rounded details-card">
                                    <h6 class="text-start mb-3 fw-bold color-white">Pet Policy:</h6>
                                    <p class="text-justify">{{ hotels.petPolicy }}</p>
                                </div>
                                <div class="p-3 table-border-dark my-2 rounded details-card">
                                    <h6 class="text-start mb-3 fw-bold color-white">Hotel Instruction:</h6>
                                    <ul v-for="(ins,i) in hotels.instruction" :key="i">
                                        <li class="ml-3 py-1 text-justify color-main">{{ ins.hotel_instruction }}</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-12 mx-auto p-3 m-1">
                                <div class="p-3 table-border-dark rounded">
                                    <h6 class="text-start p-3 fw-bolder bg-header rounded table-border-dark color-white">Rooom Information</h6>
                                    <span v-for="(room,i) in hotels.rent" :key="i" class="table-border-dark rounded p-3 my-2 d-flex flex-row justify-content-between aling-items-center color-main">
                                        <span class="d-flex my-auto p-2 rounded bg-header">
                                            <p class="fw-bold mr-2 text-sm">Room Type:</p>
                                            <p class="text-sm">{{ room.offerTitle }}</p>
                                        </span>
                                        <span class="d-flex my-auto p-2 rounded bg-header">
                                            <p class="fw-bold mr-2 text-sm">Person Qty:</p>
                                            <p class="text-sm">{{ room.totalPerson }}</p>
                                        </span>
                                        <span class="d-flex my-auto p-2 rounded bg-header">
                                            <p class="fw-bold mr-2 text-sm">R Rent:</p>
                                            <p class="text-sm">৳ {{ room.offerRegularPrice }}</p>
                                        </span>
                                        <span class="d-flex my-auto p-2 rounded bg-header">
                                            <p class="fw-bold mr-2 text-sm">D Rent:</p>
                                            <p class="text-sm">৳ {{ room.offerDiscpuntPrice }}</p>
                                        </span>
                                        <span class="d-flex my-auto p-2 rounded bg-header">
                                            <p class="fw-bold mr-2 text-sm">WR Rent:</p>
                                            <p class="text-sm">৳ {{ room.WofferRegularPrice }}</p>
                                        </span>
                                        <span class="d-flex my-auto p-2 rounded bg-header">
                                            <p class="fw-bold mr-2 text-sm">WD Rent:</p>
                                            <p class="text-sm">৳ {{ room.WofferDiscpuntPrice }}</p>
                                        </span>
                                        <span>
                                            <img :src="room.image" alt="" height="50">
                                        </span>

                                        <div></div>
                                        
                                    </span>
                                </div>

                            </div>


                            <div class="col-md-6 mx-auto p-3 m-1">

                                <h6 class="text-start p-3 fw-bolder bg-header rounded table-border-dark color-white">Hotel Title Image</h6>

                                <div class="rounded table-border-dark pb-4 text-center max-height">
                                    <img :src="hotels.titleImage" class="img rounded table-border-dark m-3" height="100" alt=""> 
                                </div>

                            </div>

                            <div class="col-md-6 mx-auto p-3 m-1">

                                <h6 class="text-start p-3 fw-bolder rounded bg-header color-white">Hotel All Images</h6>

                                <div class="rounded table-border-dark max-height">
                                    <div class="text-center my-1 d-inline" v-for="(img,i) in hotels.images" :key="i">
                                        <img :src="img.hotel_image" class="img rounded table-border-dark m-3"  height="80" alt="">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 my-4">
                                <div class="row rounded">

                                    <div class="col-md-6">
                                        <h6 class="text-start my-3 fw-bold table-border-dark p-3 rounded bg-header color-white">Hotel Features</h6>
                                        <div class="px-2 m-1 btn btn-outline-light color-white rounded shadow table-border-dark table-border-dark-warning fw-bold" v-for="(feature,i) in hotels.features" :key="i"><span class="color-main">{{ feature.hotel_feature}}</span></div>  
                                    </div>

                                    <div class="col-md-6">
                                        <h6 class="text-start my-3 fw-bold table-border-dark p-3 rounded bg-header color-white">Payments Methods</h6>
                                        <div class="px-2 m-1 btn btn-outline-light rounded shadow table-border-dark table-border-dark-success fw-bold color-white" v-for="(payment,i) in hotels.payments" :key="i"><span class="color-main">{{ payment.payment_method}}</span></div> 
                                    </div>
                                    
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary shadow" type="button" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {

    props: ['hotels'],
        
    

    data(){
        return{

            addDetailsModal:true,
            data:{
                
            }
        }
    },

    methods:{
                
            
    },

    async created() {
    
    },

}
</script>

<style scoped>
.modal-height{
    max-height: 60vh;
    overflow-y: scroll;
}

.details-card:hover {
    background: #e2e2e2;
}

.max-height {
    height: 300px !important;
    overflow-y: auto;
}



</style>