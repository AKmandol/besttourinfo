<template>
    <div>
  
        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="fw-blod color-white aling-middle">Edit Information</h5>
                        <p class="fw-bloder color-white ml-3 aling-middle"> for <span class="text-success fs-5 ml-2">"{{ hotels.name }}"</span> </p>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <b-icon-x-lg class="d-inline text-danger" width="16" height="16"></b-icon-x-lg>
                        </button>
                    </div>

                    <div class="modal-body color-white modal-height">

                        <form class="row g-3 p-3" @submit.prevent="update" method="POST" @keydown="clearAllError">

                            <div class="col-md-12">
                                <label for="home" class="form-label fw-bolder color-white"> <span class="text-danger">*</span> Whether shown in HOMEPAGE or not </label>
                                <div class="form-check form-check-inline align-middle mx-4">
                                    <input v-model="hotels.activeStatus" class="form-check-input" type="radio" name="home" id="home" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline align-middle mx-4">
                                    <input v-model="hotels.activeStatus" class="form-check-input" type="radio" name="home" id="home" value="0">
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="hotel_name" class="form-label fw-bolder color-white">Hotel Name</label>
                                <input type="text" name="name" v-model="hotels.name" class="form-control" id="hotel_name" placeholder="Hotel Name" :class="hasError('name') ? 'is-invalid' : '' " >
                                <div class="invalid-feedback" v-if="hasError('name')">{{getError('name')}}</div>
                            </div>

                            <div class="col-md-6">
                                <label for="ocation" class="form-label fw-bolder color-white">Hotel Address</label>
                                <input type="text" name="address" v-model="hotels.address" class="form-control" id="location" placeholder="e.g Dhanmondhi,Dhaka,Bangladesh" :class="hasError('address') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('address')">{{getError('address')}}</div>
                            </div>

                            <div class="col-md-6">
                                <label for="tourPonit" class="form-label fw-bolder color-white">TourPonit Distance</label>
                                <input type="text" name="tourPointAddress" v-model="hotels.tourPointAddress" class="form-control" id="tourPonit" placeholder="e.g 1km from Cox's Bazar Sea Beach" :class="hasError('tourPointAddress') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('tourPointAddress')">{{getError('tourPointAddress')}}</div>
                            </div>

                            <div class="col-md-6">
                                <label for="map" class="form-label fw-bolder color-white">TourPonit Distance-2</label>
                                <input type="text" name="tourPointAddress2" v-model="hotels.tourPointAddress2" class="form-control" id="map" placeholder="e.g 1km from Cox's Bazar Sea Beach" :class="hasError('tourPointAddress2') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('tourPointAddress2')">{{getError('tourPointAddress2')}}</div>
                            </div>

                            <div class="col-md-6">
                                <label for="map" class="form-label fw-bolder color-white">TourPonit Distance-3</label>
                                <input type="text" name="tourPointAddress3" v-model="hotels.tourPointAddress3" class="form-control" id="map" placeholder="e.g 1km from Cox's Bazar Sea Beach" :class="hasError('tourPointAddress3') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('tourPointAddress3')">{{getError('tourPointAddress3')}}</div>
                            </div>

                            <div class="col-md-6">
                                <label for="map" class="form-label fw-bolder color-white">TourPonit Distance-4</label>
                                <input type="text" name="tourPointAddress4" v-model="hotels.tourPointAddress4" class="form-control" id="map" placeholder="e.g 1km from Cox's Bazar Sea Beach" :class="hasError('tourPointAddress4') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('tourPointAddress4')">{{getError('tourPointAddress4')}}</div>
                            </div>

                            <div class="col-md-5">
                                <label for="map" class="form-label fw-bolder color-white">Phone Number</label>
                                <input type="text" name="phone" v-model="hotels.phone" class="form-control" id="map" placeholder="e.g +8801788888888" :class="hasError('phone') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('phone')">{{getError('phone')}}</div>
                            </div>

                            <div class="col-md-5">
                                <label for="tourPonit" class="form-label fw-bolder color-white">Email Address</label>
                                <input type="email" name="email" v-model="hotels.email" class="form-control" id="tourPonit" placeholder="e.g zahid@email.com" :class="hasError('email') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('email')">{{getError('email')}}</div>
                            </div>

                            <div class="col-md-2">
                                <label for="total_room" class="form-label fw-bolder color-white">Available Room</label>
                                <input type="text" name="total_room" v-model="hotels.total_room" class="form-control" id="total_room" placeholder="e.g 5" :class="hasError('total_room') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('total_room')">{{getError('total_room')}}</div>
                            </div>

                            <div class="col-md-12">
                                <label for="titleImage" class="form-label fw-bolder color-white">Title Image</label>

                                <Upload
                                    :class="hasError('image') ? 'is-invalid' : '' "
                                    :headers="{
                                        'x-csrf-token': token,
                                        'X-Requested-With': 'XMLHttpRequest',
                                    }"
                                    :show-upload-list="false"
                                    type="drag"
                                    action="/hotel/title/uploads"
                                    ref="uploads"
                                    :on-success="handleSuccess"
                                    :format="['jpg', 'jpeg', 'png']"
                                    :max-size="2048"
                                    :on-format-error="handleFormatError"
                                    :on-exceeded-size="handleMaxSize"
                                    >
                                    <div style="padding: 20px 0">
                                        <Icon
                                        type="ios-cloud-upload"
                                        size="52"
                                        style="color: #3399ff"
                                        ></Icon>
                                        <p>Click or drag Title Hotel-Image here to upload(600x475)</p>
                                    </div>
                                </Upload>

                                <div class="p-3 table-border-dark rounded  mt-2">
                                    <div  v-if="!data.img" class="d-inline">
                                        <label for="fw-bolder color-white">Old Image: </label>
                                        <img class="rounded p-2 table-border-dark ml-3" width="120" :src="hotels.titleImage" />
                                    </div>

                                    <div v-if="data.img" class="d-inline ml-5 text-success">
                                        <label for="form-label fw-bolder text-success">New Image: </label>
                                        <img class="rounded p-2 table-border-dark ml-3" width="120" :src="data.img" />
                                        <span class="d-inline ml-4">
                                            <Icon type="ios-trash-outline" size="24" color="red" @click="deleteTitleImage" />
                                        </span>
                                    </div>

                                </div>

                                <div class="invalid-feedback" v-if="hasError('image')">{{getError('image')}}</div>

                            </div>

                            <div class="col-md-12">
                                <label for="tourPonit" class="form-label fw-bolder color-white">Description</label>
                                <div><QuillEditor v-model:content="hotels.description" contentType="html" toolbar="full" theme="snow" :class="hasError('description') ? 'is-invalid' : '' " /></div>
                                <!-- <textarea class="form-control" name="description" v-model="hotels.description" id="exampleFormControlTextarea1" rows="3" :class="hasError('description') ? 'is-invalid' : '' "></textarea> -->
                                <div class="invalid-feedback" v-if="hasError('description')">{{getError('description')}}</div>
                            </div>

                            <div class="col-md-3">
                                <label for="discount" class="form-label fw-bolder color-white">Lowest Price</label>
                                <input type="number" name="discount" v-model="hotels.discount" class="form-control" id="discount" placeholder="3200" :class="hasError('discount') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('discount')">@{{getError('discount')}}</div>
                            </div>

                            <div class="col-md-3">
                                <label for="inputCity" class="form-label fw-bolder color-white">City</label>
                                <input type="text" name="city" v-model="hotels.city" class="form-control" id="inputCity" placeholder="e.g Dhaka,Bangladesh" :class="hasError('city') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('city')">@{{getError('city')}}</div>
                            </div>

                            <div class="col-md-3">
                                <label for="inputState" class="form-label fw-bolder color-white">Country</label>
                                <input type="text" name="country" v-model="hotels.country" class="form-control" id="inputCity" placeholder="e.g Mirpur,Dhaka" :class="hasError('country') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('country')">@{{getError('country')}}</div>
                            </div>

                            <div class="col-md-3">
                                <label for="inputZip" class="form-label fw-bolder color-white">Zip</label>
                                <input type="text" name="zip" v-model="hotels.zip" class="form-control" id="inputZip" placeholder="e.g 1205" :class="hasError('zip') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('zip')">{{getError('zip')}}</div>
                            </div>

                            <div class="col-md-4">
                                <label for="floor_no" class="form-label fw-bolder color-white">Left Top Message</label>
                                <input type="text" name="floor_no" v-model="hotels.floor_no" class="form-control" id="floor_no" :class="hasError('floor_no') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('floor_no')">{{getError('floor_no')}}</div>
                            </div>

                            <div class="col-md-4">
                                <label for="right_top" class="form-label fw-bolder color-white">Right Top Message</label>
                                <input type="text" name="right_top" v-model="hotels.right_top" class="form-control" id="right_top"  :class="hasError('right_top') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('right_top')">{{getError('right_top')}}</div>
                            </div>

                            <div class="col-md-4">
                                <label for="constraction_year" class="form-label fw-bolder color-white">Right Bottom Message</label>
                                <input type="text" name="constraction_year" v-model="hotels.constraction_year" class="form-control" id="constraction_year" :class="hasError('constraction_year') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('constraction_year')">{{getError('constraction_year')}}</div>
                            </div> 

                            <div class="col-md-12 p-3">
                                
                                <div class="row table-border-dark p-3 rounded my-3" v-for="(item,index) in hotels.rent" :key="item">

                                    <div class="my-2 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="inputZip3" class="form-label fw-bolder color-white">Room Type</label>
                                        <input disabled type="text" name="offerTitle" v-model="item.offerTitle" class="form-control" id="inputZip3">
                                    </div>

                                    <div class="my-2 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="inputZip" class="form-label fw-bolder color-white">Regular Price</label>
                                        <input disabled type="text" name="offerRegularPrice" v-model="item.offerRegularPrice" class="form-control" id="inputZip3">
                                    </div>
                                
                                    <div class="my-2 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="inputZip" class="form-label fw-bolder color-white">Discount Price</label>
                                        <input disabled type="text" name="offerDiscpuntPrice" v-model="item.offerDiscpuntPrice" class="form-control" id="inputZip3">
                                    </div>

                                    <div class="my-2 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="rdiscount" class="form-label fw-bolder color-white">Rdiscount Price</label>
                                        <input disabled type="text" name="rdiscount" v-model="item.rdiscount" class="form-control" id="inputZip3">
                                    </div>

                                    <div class="my-2 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="inputZip" class="form-label fw-bolder color-white">Person Qty</label>
                                        <input disabled type="text" name="totalPerson" v-model="item.totalPerson" class="form-control" id="inputZip3">
                                    </div>

                                    <div class="my-2 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="bed" class="form-label fw-bolder color-white">Bed No</label>
                                        <input disabled type="text" name="bed" v-model="item.bed" class="form-control" id="inputZip3">
                                    </div>

                                    <div class="my-2 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="inputZip" class="form-label fw-bolder color-white">Wregular Price</label>
                                        <input disabled type="text" name="offerRegWofferRegularPriceularPrice" v-model="item.WofferRegularPrice" class="form-control" id="inputZip3">
                                    </div>
                                
                                    <div class="my-2 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="inputZip" class="form-label fw-bolder color-white">Wdiscount Price</label>
                                        <input disabled type="text" name="WofferDiscpuntPrice" v-model="item.WofferDiscpuntPrice" class="form-control" id="inputZip3">
                                    </div>

                                    <div class="my-2 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="wdiscount" class="form-label fw-bolder color-white">Wdiscount Ratio</label>
                                        <input disabled type="text" name="wdiscount" v-model="item.wdiscount" class="form-control" id="inputZip3">
                                    </div>

                                    <div class="my-2 col-xl-8 col-sm-8 fw-bold">     

                                        <div class="p-3 table-border-dark bg-main rounded position-relative mt-2" v-show="item.image">
                                            <span class="color-white aling-middle mr-3">Title Image:</span>
                                            <img class="rounded p-2 table-border-dark" width="80" :src="`${item.image}`" />
                                        </div>

                                    </div>

                                    <div class="my-2 col-12 fw-bold d-flex align-items-center justify-content-center" v-show="this.hotels.rent > 1">
                                        <a class="btn btn-danger text-white" @click="removeRow(item,index)"> <b-icon-trash class="d-inline text-white" width="15" height="15"></b-icon-trash></a>
                                    </div>
                                
                                </div>
                                
                            </div>

                            <div class="col-md-12 p-3">
                                
                                <div class="row table-border-dark p-3 rounded my-3" v-for="(item,index) in data.hotelRent" :key="item">
                               
                                    <p class="fw-bold mb-2">Row {{ index+1 }}</p>

                                    <div class="my-2 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="offerTitle" class="form-label fw-bolder color-white">Room Type</label>
                                        <input type="text" name="offerTitle" v-model="item.offerTitle" class="form-control" id="offerTitle" placeholder="e.g 1 Room See view Side" :class="hasError('offerTitle') ? 'is-invalid' : '' ">
                                        <div class="invalid-feedback" v-if="hasError('offerTitle')">{{getError('offerTitle')}}</div>
                                    </div>
                                    
                                    <div class="my-2 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="totalPerson" class="form-label fw-bolder color-white">Person Qty</label>
                                        <input type="text" name="totalPerson" v-model="item.totalPerson" class="form-control" id="totalPerson" placeholder="e.g 3" :class="hasError('totalPerson') ? 'is-invalid' : '' ">
                                        <div class="invalid-feedback" v-if="hasError('totalPerson')">{{getError('totalPerson')}}</div>
                                    </div>

                                    <div class="my-2 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="bed" class="form-label fw-bolder color-white">Bed No</label>
                                        <input type="text" name="bed" v-model="item.bed" class="form-control" id="bed" placeholder="e.g 2 double/single " :class="hasError('bed') ? 'is-invalid' : '' ">
                                        <div class="invalid-feedback" v-if="hasError('bed')">{{getError('bed')}}</div>
                                    </div>

                                    <div class="my-2 col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                        <label for="size" class="form-label fw-bolder color-white">Room Size</label>
                                        <input type="text" name="size" v-model="item.size" class="form-control" id="size" placeholder="e.g 60 x 20 = 1200 " :class="hasError('size') ? 'is-invalid' : '' ">
                                        <div class="invalid-feedback" v-if="hasError('size')">{{getError('size')}}</div>
                                    </div>

                                    <div class="my-2 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                        <label for="offerRegularPrice" class="form-label fw-bolder color-white">Regular Price</label>
                                        <input type="number" name="offerRegularPrice" v-model="item.offerRegularPrice" class="form-control" id="offerRegularPrice" placeholder="e.g 12000" :class="hasError('offerRegularPrice') ? 'is-invalid' : '' ">
                                        <div class="invalid-feedback" v-if="hasError('offerRegularPrice')">{{getError('offerRegularPrice')}}</div>
                                    </div>
                                
                                    <div class="my-2 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                        <label for="offerDiscpuntPrice" class="form-label fw-bolder color-white">Discount Price</label>
                                        <input type="number" name="offerDiscpuntPrice" v-model="item.offerDiscpuntPrice" class="form-control" id="offerDiscpuntPrice" placeholder="e.g 8500" :class="hasError('offerDiscpuntPrice') ? 'is-invalid' : '' ">
                                        <div class="invalid-feedback" v-if="hasError('offerDiscpuntPrice')">{{getError('offerDiscpuntPrice')}}</div>
                                    </div>
                                
                                    <div class="my-2 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                        <label for="rdiscount" class="form-label fw-bolder color-white">Rdiscount Ratio</label>
                                        <input type="text" name="rdiscount" v-model="item.rdiscount" class="form-control" id="rdiscount" placeholder="15" :class="hasError('rdiscount') ? 'is-invalid' : '' ">
                                        <div class="invalid-feedback" v-if="hasError('rdiscount')">{{getError('rdiscount')}}</div>
                                    </div>

                                    <div class="my-2 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                        <label for="WofferRegularPrice" class="form-label fw-bolder color-white">Weekend Price</label>
                                        <input type="number" name="WofferRegularPrice" v-model="item.WofferRegularPrice" class="form-control" id="WofferRegularPrice" placeholder="e.g 12000" :class="hasError('WofferRegularPrice') ? 'is-invalid' : '' ">
                                        <div class="invalid-feedback" v-if="hasError('WofferRegularPrice')">{{getError('WofferRegularPrice')}}</div>
                                    </div>
                                
                                    <div class="my-2 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                        <label for="WofferDiscpuntPrice" class="form-label fw-bolder color-white">Weekend Discount Price</label>
                                        <input type="number" name="WofferDiscpuntPrice" v-model="item.WofferDiscpuntPrice" class="form-control" id="WofferDiscpuntPrice" placeholder="e.g 8500" :class="hasError('WofferDiscpuntPrice') ? 'is-invalid' : '' ">
                                        <div class="invalid-feedback" v-if="hasError('WofferDiscpuntPrice')">{{getError('WofferDiscpuntPrice')}}</div>
                                    </div>

                                    <div class="my-2 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                        <label for="wdiscount" class="form-label fw-bolder color-white">Wdiscount Ratio</label>
                                        <input type="text" name="wdiscount" v-model="item.wdiscount" class="form-control" id="wdiscount" placeholder="20" :class="hasError('wdiscount') ? 'is-invalid' : '' ">
                                        <div class="invalid-feedback" v-if="hasError('wdiscount')">{{getError('wdiscount')}}</div>
                                    </div>

                                    <div class="my-2 col-xl-12 col-sm-12 fw-bold">     
                                        <label for="input" class="form-label color-white text-sm">Upload a Room Type Title Image (<span class="text-sm text-primary">600x475 px</span>) </label>
                                        <input type="file" id="input" class="form-control" @change="onFileChange($event, index)">

                                        <div class="p-3 table-border-dark bg-main rounded position-relative mt-2" v-show="item.img">
                                            <span class="text-success aling-middle mr-3">Uploded Image:</span>
                                            <img class="rounded p-2 table-border-dark" width="120" :src="`${item.img}`" />
                                        </div>

                                        <div class="invalid-feedback" v-if="hasError('img')">{{getError('img')}}</div>

                                    </div>

                                    <div class="col-md-12">
                                        
                                        <label for="inputAddress" class="form-label fw-bolder color-white"> Room Features</label>
                                        <div class="table-border-dark bg-main rounded p-4" :class="hasError('roomFeatures') ? 'is-invalid' : '' ">

                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Ceiling Fan" class="form-check-input" type="checkbox" id="f1">
                                                <label class="form-check-label" for="f1">Ceiling Fan</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="safety locker" class="form-check-input" type="checkbox" id="f100">
                                                <label class="form-check-label" for="f100">safety locker</label>
                                            </div>
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Air Conditioning" class="form-check-input" type="checkbox" id="f2">
                                                <label class="form-check-label" for="f2">Air Conditioning</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Wi-Fi" class="form-check-input" type="checkbox" id="f3">
                                                <label class="form-check-label" for="f3">Wi-Fi</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Toiletries" class="form-check-input" type="checkbox" id="f4">
                                                <label class="form-check-label" for="f4">Toiletries</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Power Outlet" class="form-check-input" type="checkbox" id="f5">
                                                <label class="form-check-label" for="f5">Power Outlet</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Table Fan" class="form-check-input" type="checkbox" id="f6">
                                                <label class="form-check-label" for="f6">Table Fan</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Blankets" class="form-check-input" type="checkbox" id="f7">
                                                <label class="form-check-label" for="f7">Blankets</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Closet" class="form-check-input" type="checkbox" id="f8">
                                                <label class="form-check-label" for="f8">Closet</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Curtain" class="form-check-input" type="checkbox" id="f9">
                                                <label class="form-check-label" for="f9">Curtain</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Desk" class="form-check-input" type="checkbox" id="f10">
                                                <label class="form-check-label" for="f10">Desk</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Housekeeping" class="form-check-input" type="checkbox" id="f11">
                                                <label class="form-check-label" for="f11">Housekeeping</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="In-room Dining" class="form-check-input" type="checkbox" id="f12">
                                                <label class="form-check-label" for="f12">In-room Dining</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Room Service" class="form-check-input" type="checkbox" id="f13">
                                                <label class="form-check-label" for="f13">Room Service</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Slippers" class="form-check-input" type="checkbox" id="f14">
                                                <label class="form-check-label" for="f14">Slippers</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Bathroom" class="form-check-input" type="checkbox" id="f15">
                                                <label class="form-check-label" for="f15">Bathroom</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Towels" class="form-check-input" type="checkbox" id="f16">
                                                <label class="form-check-label" for="f16">Towels</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="TV" class="form-check-input" type="checkbox" id="f17">
                                                <label class="form-check-label" for="f17">TV</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Coffee/Tea Maker" class="form-check-input" type="checkbox" id="f18">
                                                <label class="form-check-label" for="f18">Coffee/Tea Maker</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Sofa" class="form-check-input" type="checkbox" id="f19">
                                                <label class="form-check-label" for="f19">Sofa</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Stove" class="form-check-input" type="checkbox" id="f20">
                                                <label class="form-check-label" for="f20">Stove</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Oven" class="form-check-input" type="checkbox" id="f21">
                                                <label class="form-check-label" for="f21">Oven</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Ironing Facility" class="form-check-input" type="checkbox" id="f22">
                                                <label class="form-check-label" for="f22">Ironing Facility</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Refrigerator" class="form-check-input" type="checkbox" id="f23">
                                                <label class="form-check-label" for="f23">Refrigerator</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Balcony" class="form-check-input" type="checkbox" id="f24">
                                                <label class="form-check-label" for="f24">Balcony</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="smoking allowance" class="form-check-input" type="checkbox" id="f25">
                                                <label class="form-check-label" for="f25">smoking allowance</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Bathtub" class="form-check-input" type="checkbox" id="f26">
                                                <label class="form-check-label" for="f26">Bathtub</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Hot Water" class="form-check-input" type="checkbox" id="f27">
                                                <label class="form-check-label" for="f27">Hot Water</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Cable TV" class="form-check-input" type="checkbox" id="f28">
                                                <label class="form-check-label" for="f28">Cable TV</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Telephone" class="form-check-input" type="checkbox" id="f29">
                                                <label class="form-check-label" for="f29">Telephone</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Hairdryer" class="form-check-input" type="checkbox" id="f30">
                                                <label class="form-check-label" for="f30">Hairdryer</label>
                                            </div>   
                                            <div class="form-check form-check-inline p-2">
                                                <input v-model="item.roomFeatures" value="Make-up Mirror" class="form-check-input" type="checkbox" id="f31">
                                                <label class="form-check-label" for="f31">Make-up Mirror</label>
                                            </div>   

                                        </div>

                                        <div class="invalid-feedback" v-if="hasError('roomFeatures')">{{getError('roomFeatures')}}</div>

                                    </div>

                                    <div class="my-2 col fw-bold d-flex align-items-center justify-content-center" v-show="this.data.hotelRent >= 1">
                                        <a class="btn btn-danger text-white" @click="removeRowEDIT(item,index)"> <b-icon-trash class="d-inline text-white" width="25" height="25"></b-icon-trash></a>
                                    </div>

                                    <div class="my-2 col fw-bold d-flex align-items-center justify-content-center">
                                        <a class="btn btn-success mx-1 text-white" @click="addRow"> <b-icon-plus class="d-inline text-white" width="25" height="25"></b-icon-plus></a>
                                    </div>
                                
                                </div>

                            </div>

                            <div class="col-md-4">
                                <label for="stars" class="form-label fw-bolder color-white">Hotel Stars</label>
                                <input type="number" max="5" min="0" name="stars" v-model="hotels.stars" class="form-control" id="stars" :class="hasError('stars') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('stars')">{{getError('stars')}}</div>
                            </div>

                            <div class="col-md-4">
                                <label for="inputZip" class="form-label fw-bolder color-white">Hotel In Time</label>
                                <input type="time" name="checkIn" v-model="hotels.checkIn" class="form-control" id="inputZip3" placeholder="e.g 02.00 am" :class="hasError('checkIn') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('checkIn')">{{getError('checkIn')}}</div>
                            </div>

                            <div class="col-md-4">
                                <label for="inputZip" class="form-label fw-bolder color-white">Hotel Out Time</label>
                                <input type="time" name="checkOut" v-model="hotels.checkOut" class="form-control" id="inputZip3" placeholder="e.g 05.00 am" :class="hasError('checkOut') ? 'is-invalid' : '' ">
                                <div class="invalid-feedback" v-if="hasError('checkOut')">{{getError('checkOut')}}</div>
                            </div>

                            <div class="col-md-12">
                                <label for="inputZip3" class="form-label fw-bolder color-white">Hotel Rules</label>
                                <div><QuillEditor v-model:content="hotels.houseRules" contentType="html" toolbar="full" theme="snow" :class="hasError('houseRules') ? 'is-invalid' : '' " /></div>
                                <!-- <textarea class="form-control" name="houseRules" v-model="hotels.houseRules" id="exampleFormControlTextarea1" rows="2" :class="hasError('houseRules') ? 'is-invalid' : '' "></textarea> -->
                                <div class="invalid-feedback" v-if="hasError('houseRules')">{{getError('houseRules')}}</div>
                            </div>

                            <div class="col-md-6">
                                <label for="inputZip" class="form-label fw-bolder color-white">Pet Policy</label>
                                <div><QuillEditor v-model:content="hotels.petPolicy" contentType="html" toolbar="full" theme="snow" :class="hasError('petPolicy') ? 'is-invalid' : '' " /></div>
                                <!-- <textarea name="petPolicy" v-model="hotels.petPolicy" class="form-control" id="exampleFormControlTextarea1" rows="2" :class="hasError('petPolicy') ? 'is-invalid' : '' "></textarea> -->
                                <div class="invalid-feedback" v-if="hasError('petPolicy')">{{getError('petPolicy')}}</div>
                            </div>

                            <div class="col-md-6">
                                <label for="inputZip" class="form-label fw-bolder color-white">Kids Policy</label>
                                <div><QuillEditor v-model:content="hotels.kidsPolicy" contentType="html" toolbar="full" theme="snow" :class="hasError('kidsPolicy') ? 'is-invalid' : '' " /></div>
                                <!-- <textarea name="kidsPolicy" v-model="hotels.kidsPolicy" class="form-control" id="exampleFormControlTextarea1" rows="2" :class="hasError('kidsPolicy') ? 'is-invalid' : '' "></textarea> -->
                                <div class="invalid-feedback" v-if="hasError('kidsPolicy')">{{getError('kidsPolicy')}}</div>
                            </div>

                            <div class="col-md-12 mb-4" v-show="hotels.features != ''">
                                
                                <label for="inputAddress" class="form-label fw-bolder color-white mr-3 my-auto">Old Features:</label>
                                <div class="table-border-dark bg-main rounded p-3 mt-2">

                                    <div class="row p-3 g-1">
                                        <div class="col-auto justify-content-between"  v-for="(f,i) in hotels.features" :key="i">
                                            <p v-if="f.id" class="p-2 my-2 bg-main table-border-dark rounded">{{ f.hotel_feature }} <span class="ml-4 text-center"><b-icon-trash @click="deleteFeatures(f,i)" class="d-inline text-danger" width="16" height="16"></b-icon-trash></span></p>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="inputAddress" class="form-label fw-bolder text-success">Add new Features</label>
                                <div class="table-border-dark bg-main rounded p-4" :class="hasError('facilites') ? 'is-invalid' : '' ">

                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Hill View/Mountain View" class="form-check-input" type="checkbox" id="fa1">
                                        <label class="form-check-label" for="fa1">Hill View/Mountain View</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Steam Bath" class="form-check-input" type="checkbox" id="fa2">
                                        <label class="form-check-label" for="fa2">Steam Bath</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Laundry Service" class="form-check-input" type="checkbox" id="fa3">
                                        <label class="form-check-label" for="fa3">Laundry Service</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Business Center" class="form-check-input" type="checkbox" id="fa4">
                                        <label class="form-check-label" for="fa4">Business Center</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Hall Room" class="form-check-input" type="checkbox" id="fa5">
                                        <label class="form-check-label" for="fa5">Hall Room</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Prayer Room" class="form-check-input" type="checkbox" id="fa6">
                                        <label class="form-check-label" for="fa6">Prayer Room</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Tour and Travel Desk" class="form-check-input" type="checkbox" id="fa7">
                                        <label class="form-check-label" for="fa7">Tour and Travel Desk</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Water Park" class="form-check-input" type="checkbox" id="fa8">
                                        <label class="form-check-label" for="fa8">Water Park</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Doctor on Call" class="form-check-input" type="checkbox" id="fa9">
                                        <label class="form-check-label" for="fa9">Doctor on Call</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="DJ Party/ Night Club" class="form-check-input" type="checkbox" id="fa10">
                                        <label class="form-check-label" for="fa10">DJ Party/ Night Club</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="B-B-Q" class="form-check-input" type="checkbox" id="fa11">
                                        <label class="form-check-label" for="fa11">B-B-Q</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Safety Locker" class="form-check-input" type="checkbox" id="fa12">
                                        <label class="form-check-label" for="fa12">Safety Locker</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Indore Games" class="form-check-input" type="checkbox" id="fa13">
                                        <label class="form-check-label" for="fa13">Indore Games</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Kayaking Boat" class="form-check-input" type="checkbox" id="fa15">
                                        <label class="form-check-label" for="fa15">Kayaking Boat</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Fishing" class="form-check-input" type="checkbox" id="fa16">
                                        <label class="form-check-label" for="fa16">Fishing</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Salon" class="form-check-input" type="checkbox" id="fa17">
                                        <label class="form-check-label" for="fa17">Salon</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Luggage Room" class="form-check-input" type="checkbox" id="fa18">
                                        <label class="form-check-label" for="fa18">Luggage Room</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input v-model="newFeatures" value="Breakfast Included" class="form-check-input" type="checkbox" id="1">
                                        <label class="form-check-label" for="1">Breakfast Included</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Kitchen facilities" v-model="newFeatures" type="checkbox" id="2">
                                        <label class="form-check-label" for="2">Kitchen facilities</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Bar Inside" v-model="newFeatures" type="checkbox" id="3">
                                        <label class="form-check-label" for="3">Bar Inside</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="5 stars" v-model="newFeatures" type="checkbox" id="4">
                                        <label class="form-check-label" for="4">5 stars</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Beach View" v-model="newFeatures" type="checkbox" id="5">
                                        <label class="form-check-label" for="5">Beach View</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Parking Area" v-model="newFeatures" type="checkbox" id="6">
                                        <label class="form-check-label" for="6">Parking Area</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Free WiFi" v-model="newFeatures" type="checkbox" id="7">
                                        <label class="form-check-label" for="7">Free WiFi</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Swimming pool" v-model="newFeatures" type="checkbox" id="8">
                                        <label class="form-check-label" for="8">Swimming pool</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Pet friendly" v-model="newFeatures" type="checkbox" id="10">
                                        <label class="form-check-label" for="10">Pet friendly</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Kids Zone" v-model="newFeatures" type="checkbox" id="11">
                                        <label class="form-check-label" for="11">Kids Zone</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Smoking Zone" v-model="newFeatures" type="checkbox" id="12">
                                        <label class="form-check-label" for="12">Smoking Zone</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Air conditioning" v-model="newFeatures" type="checkbox" id="13">
                                        <label class="form-check-label" for="13">Air conditioning</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Wheelchair accessibleg" v-model="newFeatures" type="checkbox" id="14">
                                        <label class="form-check-label" for="14">Wheelchair accessibleg</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Balcony" v-model="newFeatures" type="checkbox" id="15">
                                        <label class="form-check-label" for="15">Balcony</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Steam room" v-model="newFeatures" type="checkbox" id="16">
                                        <label class="form-check-label" for="16">Steam room</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Full-body massage" v-model="newFeatures" type="checkbox" id="17">
                                        <label class="form-check-label" for="17">Full-body massage</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Fitness center" v-model="newFeatures" type="checkbox" id="18">
                                        <label class="form-check-label" for="18">Fitness center</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Sauna" v-model="newFeatures" type="checkbox" id="19">
                                        <label class="form-check-label" for="19">Sauna</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Spa facilities" v-model="newFeatures" type="checkbox" id="20">
                                        <label class="form-check-label" for="20">Spa facilities</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Tourist Info Centre" v-model="newFeatures" type="checkbox" id="21">
                                        <label class="form-check-label" for="21">Tourist Info Centre</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="No prepayment" v-model="newFeatures" type="checkbox" id="22">
                                        <label class="form-check-label" for="22">No prepayment</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Free cancellation" v-model="newFeatures" type="checkbox" id="23">
                                        <label class="form-check-label" for="23">Free cancellation</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Book without credit card" v-model="newFeatures" type="checkbox" id="24">
                                        <label class="form-check-label" for="24">Book without credit card</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Resort Hotel" v-model="newFeatures" type="checkbox" id="25">
                                        <label class="form-check-label" for="25">Resort Hotel</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Apart Hotel" v-model="newFeatures" type="checkbox" id="26">
                                        <label class="form-check-label" for="26">Apart Hotel</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Hotel"  v-model="newFeatures" type="checkbox" id="27">
                                        <label class="form-check-label" for="27">Hotel</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Telephone"  v-model="newFeatures" type="checkbox" id="28">
                                        <label class="form-check-label" for="28">Telephone</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Mobile Phone Coverage"  v-model="newFeatures" type="checkbox" id="300">
                                        <label class="form-check-label" for="300">Mobile Phone Coverage</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Vehicle Parking"  v-model="newFeatures" type="checkbox" id="100">
                                        <label class="form-check-label" for="100">Vehicle Parking</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Couple Friendly"  v-model="newFeatures" type="checkbox" id="200">
                                        <label class="form-check-label" for="200">Couple Friendly</label>
                                    </div>

                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Coffee/Tea in Lobby"  v-model="newFeatures" type="checkbox" id="500">
                                        <label class="form-check-label" for="500">Coffee/Tea in Lobby</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Alcohol Permit"  v-model="newFeatures" type="checkbox" id="501">
                                        <label class="form-check-label" for="501">Alcohol Permit</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Accessible Bathroom"  v-model="newFeatures" type="checkbox" id="502">
                                        <label class="form-check-label" for="502">Accessible Bathroom</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Clothes Dryer"  v-model="newFeatures" type="checkbox" id="503">
                                        <label class="form-check-label" for="503">Clothes Dryer</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Towel"  v-model="newFeatures" type="checkbox" id="504">
                                        <label class="form-check-label" for="504">Towel</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Medical Support"  v-model="newFeatures" type="checkbox" id="505">
                                        <label class="form-check-label" for="505">Medical Support</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Room Service"  v-model="newFeatures" type="checkbox" id="506">
                                        <label class="form-check-label" for="506">Room Service</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" value="Washing machine"  v-model="newFeatures" type="checkbox" id="507">
                                        <label class="form-check-label" for="507">Washing machine</label>
                                    </div>

                                </div>

                                <div class="invalid-feedback" v-if="hasError('facilites')">{{getError('facilites')}}</div>

                            </div>

                            <div class="col-md-12 mb-4" v-show="hotels.payments != ''">
                                
                                <label for="inputAddress" class="form-label fw-bolder color-white mr-3 my-auto">Old Payment Method:</label>
                                <div class="table-border-dark bg-main rounded p-3 mt-2">

                                    <div class="row p-3 g-2">
                                        <div class="col-auto justify-content-between"  v-for="(f,i) in hotels.payments" :key="i">
                                            <span v-if="f.id" class="d-inline p-2 my-2 bg-main table-border-dark rounded">{{ f.payment_method }} <span class="btn btn-light btn-sm ml-4 text-center"><b-icon-trash @click="deletePayment(f,i)" class="d-inline text-danger" width="16" height="16"></b-icon-trash></span></span>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>

                            <div class="col-md-12">
                            
                                <label for="inputZip" class="form-label fw-bolder text-success">Add new Payment Method Accept:</label>
                                
                                <div class="row p-3 table-border-dark rounded bg-header text-center gap-3" :class="hasError('paymentType') ? 'is-invalid' : '' ">
                                    <div class="table-border-dark p-2 shadow rounded col-md-2 col-sm-4 my-auto">
                                        <input v-model="newPayments" value="Visa" id="Visa" class="form-check-input my-auto" type="checkbox">
                                        <img src="img/payment/1.png" class="form-check-label" height="25" width="30" alt="">
                                    </div>
                                    <div class="table-border-dark p-2 shadow rounded col-md-2 col-sm-4 my-auto">
                                        <input v-model="newPayments" value="UCB" id="UCB" class="form-check-input my-auto" type="checkbox">
                                        <img src="img/payment/2.png" class="form-check-label" height="25" width="25" alt="">
                                    </div>
                                    <div class="table-border-dark p-2 shadow rounded col-md-2 col-sm-4 my-auto">
                                        <input v-model="newPayments" value="Exim" id="Exim" class="form-check-input my-auto" type="checkbox">
                                        <img src="img/payment/3.png" class="form-check-label" height="25" width="25" alt="">
                                    </div>
                                    <div class="table-border-dark p-2 shadow rounded col-md-2 col-sm-4 my-auto">
                                        <input v-model="newPayments" value="Bkesh" id="Bkesh" class="form-check-input my-auto" type="checkbox">
                                        <img src="img/payment/4.jpg" class="form-check-label" height="25" width="25" alt="">
                                    </div>
                                    <div class="table-border-dark p-2 shadow rounded col-md-2 col-sm-4 my-auto">
                                        <input v-model="newPayments" value="DBBL" id="DBBL" class="form-check-input my-auto" type="checkbox">
                                        <img src="img/payment/5.jpg" class="form-check-label" height="25" width="25" alt="">
                                    </div>
                                    <div class="table-border-dark p-2 shadow rounded col-md-2 col-sm-4 my-auto">
                                        <input v-model="newPayments" value="MasterCard" id="MasterCard" class="form-check-input my-auto" type="checkbox">
                                        <img src="img/payment/6.png" class="form-check-label" height="25" width="25" alt="">
                                    </div>
                                    <div class="table-border-dark p-2 shadow rounded col-md-2 col-sm-4 my-auto">
                                        <input v-model="newPayments" value="PayPal" id="PayPal" class="form-check-input my-auto" type="checkbox">
                                        <img src="img/payment/7.jpg" class="form-check-label" height="25" width="25" alt="">
                                    </div>
                                    <div class="table-border-dark p-2 shadow rounded col-md-2 col-sm-4 my-auto">
                                        <input v-model="newPayments" value="Rocket" id="Rocket" class="form-check-input my-auto" type="checkbox">
                                        <img src="img/payment/8.png" class="form-check-label" height="25" width="25" alt="">
                                    </div>
                                    <div class="table-border-dark p-2 shadow rounded col-md-2 col-sm-4 my-auto">
                                        <input v-model="newPayments" value="Cash" id="cash" class="form-check-input my-auto" type="checkbox">
                                        <span class="color-white fw-bold img ml-1">Cash</span>
                                    </div>

                                </div>

                                <div class="invalid-feedback" v-if="hasError('paymentType')">{{getError('paymentType')}}</div>

                            </div>

                            <div class="col-md-12">
                                <form method="POST">
                                    <label for="images" class="form-label fw-bolder color-white">Hotel Images</label>
                                    <div class="p-3 table-border-dark bg-main rounded">

                                        <div class="mb-3">
                                            <label for="formFile" class="form-label text-success">Upload new Images</label>
                                            <input multiple class="form-control" type="file" id="file-uplaod-two" @change="fieldChange" :class="hasError('images') ? 'is-invalid' : '' ">
                                            <div class="invalid-feedback" v-if="hasError('images')">{{getError('images')}}</div>
                                        </div>

                                        <div class="p-3 table-border-dark rounded" v-show="this.hotels.images != ''">
                                            <p class="color-white my-auto">Old Images:</p>
                                            <div class="position-relative d-inline-flex mx-3 my-4" v-for="(img,index) in this.hotels.images" :key="index">
                                                <img :src="img.hotel_image" class="rounded table-border-dark shadow-sm " width="100" alt=""> 
                                                <a class="position-absolute top-0 start-100 translate-middle bg-main rounded-circle table-border-dark p-1" @click="deleteImageServer(img,index)"><b-icon-x-lg class="text-danger fw-bold" width="18"></b-icon-x-lg></a>
                                            </div>
                                        </div>

                                        <div class="p-3 table-border-dark rounded mt-2" v-show="this.files.length">
                                            <p class="text-success my-auto">New Images:</p>
                                            <div class="position-r d-inline-flex mx-3 my-4" v-for="(img,index) in this.files" :key="index">
                                                <img :src="img" class="rounded table-border-dark shadow-sm " width="100" alt=""> 
                                                <a class="position-absolute top-0 start-100 translate-middle bg-main rounded-circle table-border-dark p-1" @click="deleteImage(index)"><b-icon-x-lg class="text-danger fw-bold" width="18"></b-icon-x-lg></a>
                                            </div>

                                        </div>

                                    </div>
                                </form>
                                
                            </div>

                            <div class="col-md-12 mb-4" v-show="hotels.instruction != ''">
                                
                                <label for="inputAddress" class="form-label fw-bolder color-white mr-3 my-auto">Old Hotel Instruciton:</label>
                                <div class="table-border-dark bg-main rounded p-3 mt-2">

                                    <div class="row p-3 g-2">
                                        <ul class="col-auto d-block">
                                            <span class="d-flex" v-for="(f,i) in hotels.instruction" :key="i">
                                                <li class="p-2 mb-2 bg-main table-border-dark rounded">{{ f.hotel_instruction }} <span class="btn btn-light btn-sm ml-4 text-center"><b-icon-trash @click="deleteInstruction(f,i)" class="d-inline text-danger float-end" width="16" height="16"></b-icon-trash></span></li>
                                                <br>
                                            </span>
                                        </ul>
                                    </div>
                                
                                </div>
                            </div>

                            <div class="col-md-12">
                            
                                <form method="POST">
                                    <label for="images" class="form-label fw-bolder text-success">Add New Hotel Instructions</label>
                                    <div class="row p-3 table-border-dark bg-main rounded">

                                        <div class="mb-3 col-12" v-for="(item,i) in data.ins" :key="i">
                                            <label for="formFile" class="form-label fw-bold">Hotel Instructions {{ i+1 }}</label>
                                            <input class="form-control" v-model="item.instruction" type="text">

                                            <div class="my-2 fw-bold d-flex align-items-center justify-content-center" v-if="this.data.ins.length > 1">
                                                <a class="btn btn-danger text-white" @click="removeRowIns(i)"> <b-icon-trash class="d-inline text-white" width="15" height="15"></b-icon-trash></a>
                                            </div>
                                        </div>

                                        <div class="my-2 col-12 fw-bold d-flex align-items-center justify-content-center">
                                            <a class="btn btn-success mx-1 text-white" @click="addRowIns"> <b-icon-plus class="d-inline text-white" width="15" height="15"></b-icon-plus></a>
                                        </div>

                                    </div>
                                </form>
                                
                            </div>

                            <div class="col-12 mt-5 text-center d-flex justify-content-center">

                                <button type="submit" class="shadow btn btn-outline-primary text-center col-6 mx-auto">
                                <b-icon-save class="d-inline text-white mr-2" width="18" height="18" ></b-icon-save>
                                    update
                                </button>

                            </div>

                        </form>
                    
                    
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary rounded-1 px-3 fw-bold shadow" type="button" data-dismiss="modal">Close</button>
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

            token:'',
            addDetailsModal:true,
            errors:{},
            files:[],
            newFeatures:[],
            newPayments:[],
            form: new FormData,
            hotel: [],
            data:{
                image:[],
                images:[],
                features:[],
                rent:[],
                payment:[],
                instruction:[],
                img: '',
                hotelRent: [{
                    offerTitle:'',
                    totalPerson:'',
                    bed:'',
                    size:'',
                    offerRegularPrice: '',
                    offerDiscpuntPrice: '',
                    WofferRegularPrice: '',
                    WofferDiscpuntPrice: '',
                    rdiscount: '',
                    wdiscount: '',
                    img: null,
                    imgName: null,
                    roomFeatures: [],
                }],
                ins: [{
                    instruction: ''
                }],
            }
        }
    },

    methods:{
        
        addRowIns(){
            this.data.ins.push({
                instruction: '',
            })
        },

        removeRowIns(i){
            if(this.data.ins.length > 1){
                this.data.ins.splice(i,1)
            }
        },

        async onFileChange(event, index) {
            const file = event.target.files[0]
            
            let reader = new FileReader()
            
            reader.onload = (e) => {
                this.data.hotelRent[index].img = e.target.result
            }

            reader.readAsDataURL(file)
            const formData = new FormData();
            formData.append('image', file);
            const response = await axios.post('/hotel/store/rent', formData, {
                headers: {
                'Content-Type': 'multipart/form-data'
                }
            });
            let imgData = `/hotel_title_image_room/${response.data}`;
            this.data.hotelRent[index].imgName = imgData;
        },

        addRow(){
            this.data.hotelRent.push({
                offerTitle:'',
                totalPerson:'',
                bed:'',
                size:'',
                offerRegularPrice: '',
                offerDiscpuntPrice: '',
                WofferRegularPrice: '',
                WofferDiscpuntPrice: '',
                rdiscount: '',
                wdiscount: '',
                img: null,
                imgName: null,
                roomFeatures: []
            })
        },

        async removeRowEDIT(item,index){
            this.data.hotelRent.splice(index,1);
            this.infoMsg("Room data Removed");
        },

        async removeRow(item,index){
            this.data.rent = item;
            const res = await this.callApi("post","hotel/deleteRent", this.data.rent);
            
            if(res.status === 200){
                this.hotels.rent.splice(index,1);
                this.infoMsg("Room data Removed");
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    // this.errorMsg(res.data.errors[i][0])
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },

        handleSuccess(res, file) {
            res = `/hotel_title_image/${res}`;
            this.data.img = res;
            this.hotels.titleImage = res;
        },

        handleFormatError (file) {
            this.$Notice.warning({
                title: 'The file format is incorrect',
                desc: 'File format of ' + file.name + ' is incorrect, please select jpg or png.'
            });
        },

        handleMaxSize (file) {
            this.$Notice.warning({
                title: 'Exceeding file size limit',
                desc: 'File  ' + file.name + ' is too large, no more than 2M.'
            });
        },
            
        resetAll(){
            console.log(this.hotels)
        },

        async update(){
            // console.log(this.hotels);
            const res = await this.callApi("post","hotel/update_hotel",this.hotels);
            if(res.status === 200){
                this.successMsg("Holtel Updated Successfully");
                this.hotelList = res.data.data;
                this.pageInfo = res.data;
                this.updateFeatures();
                this.updatePayment();
                this.updateRent();
                this.updateInstruction();
                if(this.data.images != ''){
                    this.updateImage();
                }
                this.errors = {};
                this.newFeatures = [];
                this.newPayments = [];
                this.data.hotelRent = [];
                this.data.ins = [];
                this.data.images = [];
                //console.log(this.hotelList);
                setTimeout(() => {
                    window.location.reload();
                }, 100); 
                //window.location.reload()

            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
            
        },
 
        async updateFeatures(){
           // console.log(this.hotel)
            const res = await this.callApi("post","hotel/update_feature",{facilites: this.newFeatures,hotel_id: this.hotels.id,hotel_name: this.hotels.name});
            if(res.status === 200){
                this.newFeatures = [];
                this.hotels.features = res.data;
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },

        async updateRent(){
            const res = await this.callApi("post","hotel/update_rent",{rent: this.data.hotelRent, hotel_id: this.hotels.id, hotel_name: this.hotels.name});
            if(res.status === 200){
                this.hotels.rent = res.data;
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },

        async updatePayment(){
            const res = await this.callApi("post","hotel/update_payment",{payments: this.newPayments,hotel_id: this.hotels.id,hotel_name: this.hotels.name});
            if(res.status === 200){
                this.newPayments = [];
                this.hotels.payments = res.data;
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },

        async updateInstruction(){
            const res = await this.callApi("post","/hotel/update_instruction",{ins: this.data.ins,hotel_id: this.hotels.id});
            if(res.status === 200){
                this.hotels.instruction = res.data;
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },

        async updateImage(e){
            for(let i=0; i<this.data.images.length;i++){
                this.form.append('Hotel_Images[]', this.data.images[i]);
            }

            this.form.append('hotel_id', this.hotels.id);
            this.form.append('hotel_name', this.hotels.name);

            const config = { headers: { 'Content-Type': 'multipart/form-data' } };
            const res = await this.callApi("post", "hotel/update/image",this.form,config)
            if(res.status === 200){
                this.hotels.images = res.data;
                document.getElementById('file-uplaod-two').value=[];
                this.files = [];
                this.$router.go();
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                        this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },

        deleteTitleImage(){
            //console.log(this.data.img)
            this.data.img = "";
        },

        async deleteImageServer(img,index){
            this.data.image = img;
            // console.log(this.image)
            const res = await this.callApi("post","hotel/deleteImage",this.data.image);
            
            if(res.status === 200){
                this.hotels.images.splice(index,1);
                this.infoMsg("Image Removed");
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    // this.errorMsg(res.data.errors[i][0])
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },

        fieldChange(e){
            let selectedFiles = e.target.files;
            if(!selectedFiles.length){
                return false;
            }
            for(let i=0;i<selectedFiles.length;i++){
                this.data.images.push(selectedFiles[i]);
            }
            if(selectedFiles.length){
                Array.from(selectedFiles).forEach(file => this.addImage(file));
            }

            //console.log(this.data.images);
            
        },

        addImage(file){
            if(!file.type.match('image.*')){
                this.infoMsg(`${file.name} is not an Image`);
                return;
            }

            //this.data.files.push(file);
            const reader = new FileReader();
            reader.onload = (e) => this.files.push(e.target.result);
            reader.readAsDataURL(file);
            //console.log(file);
        },

        deleteImage(index){
            this.files.splice(index,1);
            this.data.images.splice(index,1);
            this.infoMsg("Image Removed");
        },

        async deleteFeatures(f,i){
            this.data.features = f;
            const res = await this.callApi("post","hotel/deleteFeature", this.data.features);
            
            if(res.status === 200){
                this.hotels.features.splice(i,1);
                this.infoMsg("Features Removed");
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    // this.errorMsg(res.data.errors[i][0])
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },
        
        async deletePayment(f,i){
            this.data.payment = f;
            const res = await this.callApi("post","hotel/deletePayment", this.data.payment);
            if(res.status === 200){
                this.hotels.payments.splice(i,1);
                this.infoMsg("Payment Method Removed");
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    // this.errorMsg(res.data.errors[i][0])
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },
                
        
        async deleteInstruction(f,i){
            this.data.instruction = f;
            const res = await this.callApi("post","/hotel/deleteInstruction", this.data.instruction);
            if(res.status === 200){
                this.hotels.instruction.splice(i,1);
                this.infoMsg("Hotel Instruction Removed");
            }else {
                if(res.status === 401){
                    this.errorMsg(res.data.msg);
                }else if (res.status === 422) {
                    for(let i in res.data.errors){
                    // this.errorMsg(res.data.errors[i][0])
                    this.errors = res.data.errors
                    }
                }
                else {
                    this.errorMsg();
                }
            }
        },
                
         
    },

    async created(){
        this.token = window.laravel.csrfToken;
    }

}
</script>

<style scoped>
.modal-height{
    max-height: 60vh;
    overflow-y: auto;
}
</style>