<template>
    <div>
    
        <div class="container-fluid marginY">
            <div class="container-fluid">
                <div class="row p-4 my-4 shadow-sm rounded bg-main">

                    <div class="mb-4 table-border-dark-bottom-dark bg-header rounded">
                    <h5 class="p-3 bg-header color-white text-center fw-bold"><b-icon-plus class="d-inline text-success mr-2" width="30" height="30"></b-icon-plus>Add Hotel Details</h5>
                    </div>
                    
                    <form class="row g-3" @submit.prevent="store" method="POST" @keydown="clearAllError">

                        <div class="col-md-12">
                            <label for="home" class="form-label fw-bolder color-white"> <span class="text-danger">*</span> Whether shown in HOMEPAGE or not </label>
                            <div class="form-check form-check-inline align-middle mx-4">
                                <input v-model="data.home" class="form-check-input" type="radio" name="home" id="home" value="1">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                            </div>
                            <div class="form-check form-check-inline align-middle mx-4">
                                <input v-model="data.home" class="form-check-input" type="radio" name="home" id="home" value="0">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="hotel_name" class="form-label fw-bolder color-white">Hotel Name</label>
                            <input type="text" name="name" v-model="data.name" class="form-control" id="hotel_name" placeholder="Hotel Name" :class="hasError('name') ? 'is-invalid' : '' " >
                            <div class="invalid-feedback" v-if="hasError('name')">{{getError('name')}}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="location" class="form-label fw-bolder color-white">Hotel Address</label>
                            <input type="text" name="address" v-model="data.address" class="form-control" id="location" placeholder="e.g Dhanmondhi,Dhaka,Bangladesh" :class="hasError('address') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('address')">{{getError('address')}}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="tourPonit" class="form-label fw-bolder color-white">TourPonit Distance-1</label>
                            <input type="text" name="tourPointAddress" v-model="data.tourPointAddress" class="form-control" id="tourPonit" placeholder="e.g 1km from Cox's Bazar Sea Beach" :class="hasError('tourPointAddress') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('tourPointAddress')">{{getError('tourPointAddress')}}</div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="map" class="form-label fw-bolder color-white">TourPonit Distance-2</label>
                            <input type="text" name="tourPointAddress2" v-model="data.tourPointAddress2" class="form-control" id="map" placeholder="e.g 1km from Cox's Bazar Sea Beach" :class="hasError('tourPointAddress2') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('tourPointAddress2')">{{getError('tourPointAddress2')}}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="map" class="form-label fw-bolder color-white">TourPonit Distance-3</label>
                            <input type="text" name="tourPointAddress3" v-model="data.tourPointAddress3" class="form-control" id="map" placeholder="e.g 1km from Cox's Bazar Sea Beach" :class="hasError('tourPointAddress3') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('tourPointAddress3')">{{getError('tourPointAddress3')}}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="map" class="form-label fw-bolder color-white">TourPonit Distance-4</label>
                            <input type="text" name="tourPointAddress4" v-model="data.tourPointAddress4" class="form-control" id="map" placeholder="e.g 1km from Cox's Bazar Sea Beach" :class="hasError('tourPointAddress4') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('tourPointAddress4')">{{getError('tourPointAddress4')}}</div>
                        </div>

                        <div class="col-md-5">
                            <label for="phone" class="form-label fw-bolder color-white">Phone Number</label>
                            <input type="text" name="phone" v-model="data.phone" class="form-control" id="phone" placeholder="e.g +8801788888888" :class="hasError('phone') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('phone')">{{getError('phone')}}</div>
                        </div>

                        <div class="col-md-5">
                            <label for="email" class="form-label fw-bolder color-white">Email Address</label>
                            <input type="email" name="email" v-model="data.email" class="form-control" id="email" placeholder="e.g zahid@email.com" :class="hasError('email') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('email')">{{getError('email')}}</div>
                        </div>

                        <div class="col-md-2">
                            <label for="total_room" class="form-label fw-bolder color-white">Available Room</label>
                            <input type="text" name="total_room" v-model="data.total_room" class="form-control" id="total_room" placeholder="e.g 5" :class="hasError('total_room') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('total_room')">{{getError('total_room')}}</div>
                        </div>

                        <div class="col-md-4">
                            <label for="floor_no" class="form-label fw-bolder color-white">Left Top Message</label>
                            <input type="text" name="floor_no" v-model="data.floor_no" class="form-control" id="floor_no" placeholder="Left Top Message" :class="hasError('floor_no') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('floor_no')">{{getError('floor_no')}}</div>
                        </div>

                        <div class="col-md-4">
                            <label for="right" class="form-label fw-bolder color-white">Right Top Message</label>
                            <input type="text" name="right" v-model="data.right" class="form-control" id="right" placeholder="Right Top Message" :class="hasError('right') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('right')">{{getError('right')}}</div>
                        </div>

                        <div class="col-md-4">
                            <label for="constraction_year" class="form-label fw-bolder color-white">Right Bottom Message</label>
                            <input type="text" name="constraction_year" v-model="data.constraction_year" class="form-control" id="constraction_year" placeholder="Right Bottom Message" :class="hasError('constraction_year') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('constraction_year')">{{getError('constraction_year')}}</div>
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
                                    <p>Click or drag Title Hotel-Image here to upload (<span class="text-sm text-primary">600x475 px</span>)</p>
                                </div>
                            </Upload>

                            <div class="p-3 table-border-dark rounded position-relative mt-2" v-show="data.image">
                            <img class="rounded p-2 table-border-dark" width="120" :src="`${data.image}`" />
                            <span class="position-absolute top-50 start-50 translate-middle">
                                <Icon type="ios-trash-outline" size="24" color="red" @click="deleteImage" />
                            </span>
                            </div>

                            <div class="invalid-feedback" v-if="hasError('image')">{{getError('image')}}</div>

                        </div>

                        <div class="col-md-12">
                            <label for="description" class="form-label fw-bolder color-white">Description</label>
                            <!-- <textarea class="form-control" name="description" v-model="data.description" id="description" rows="3" :class="hasError('description') ? 'is-invalid' : '' "></textarea> -->
                            <div><QuillEditor v-model:content="data.description" contentType="html" toolbar="full" theme="snow" :class="hasError('description') ? 'is-invalid' : '' " /></div>
                            <div class="invalid-feedback" v-if="hasError('description')">{{getError('description')}}</div>
                        </div>
 
                        <div class="col-md-3">
                            <label for="inputCity" class="form-label fw-bolder color-white">Lowest Price</label>
                            <input type="number" name="price" v-model="data.price" class="form-control" id="price" placeholder="3200" :class="hasError('price') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('price')">@{{getError('price')}}</div>
                        </div>

                        <div class="col-md-3">
                            <label for="inputCity" class="form-label fw-bolder color-white">City</label>
                            <input type="text" name="city" v-model="data.city" class="form-control" id="inputCity" placeholder="e.g Dhaka,Bangladesh" :class="hasError('city') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('city')">@{{getError('city')}}</div>
                        </div>

                        <div class="col-md-3">
                            <label for="inputCity" class="form-label fw-bolder color-white">Country</label>
                            <input type="text" name="country" v-model="data.country" class="form-control" id="inputCity" placeholder="e.g Mirpur,Dhaka" :class="hasError('country') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('country')">@{{getError('country')}}</div>
                        </div>

                        <div class="col-md-3">
                            <label for="inputZip" class="form-label fw-bolder color-white">Zip</label>
                            <input type="text" name="zip" v-model="data.zip" class="form-control" id="inputZip" placeholder="e.g 1205" :class="hasError('zip') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('zip')">{{getError('zip')}}</div>
                        </div>

                        <div class="col-md-12 p-3">
                           
                            <div class="row table-border-dark p-3 rounded my-3" v-for="(item,index) in data.form" :key="item">
                               
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
                                    <input type="number" name="offerRegularPrice" v-model="item.offerRegularPrice" class="form-control" id="offerRegularPrice" placeholder="e.g 12000tk" :class="hasError('offerRegularPrice') ? 'is-invalid' : '' ">
                                    <div class="invalid-feedback" v-if="hasError('offerRegularPrice')">{{getError('offerRegularPrice')}}</div>
                                </div>
                            
                                <div class="my-2 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                    <label for="offerDiscpuntPrice" class="form-label fw-bolder color-white">Discount Price</label>
                                    <input type="number" name="offerDiscpuntPrice" v-model="item.offerDiscpuntPrice" class="form-control" id="offerDiscpuntPrice" placeholder="e.g 8500tk" :class="hasError('offerDiscpuntPrice') ? 'is-invalid' : '' ">
                                    <div class="invalid-feedback" v-if="hasError('offerDiscpuntPrice')">{{getError('offerDiscpuntPrice')}}</div>
                                </div>
                            
                                <div class="my-2 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                    <label for="rdiscount" class="form-label fw-bolder color-white">Rdiscount Ratio</label>
                                    <input type="text" name="rdiscount" v-model="item.rdiscount" class="form-control" id="rdiscount" placeholder="15" :class="hasError('rdiscount') ? 'is-invalid' : '' ">
                                    <div class="invalid-feedback" v-if="hasError('rdiscount')">{{getError('rdiscount')}}</div>
                                </div>
                                
                                <div class="my-2 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                    <label for="WofferRegularPrice" class="form-label fw-bolder color-white">Weekend Price</label>
                                    <input type="number" name="WofferRegularPrice" v-model="item.WofferRegularPrice" class="form-control" id="WofferRegularPrice" placeholder="e.g 12000tk" :class="hasError('WofferRegularPrice') ? 'is-invalid' : '' ">
                                    <div class="invalid-feedback" v-if="hasError('WofferRegularPrice')">{{getError('WofferRegularPrice')}}</div>
                                </div>
                            
                                <div class="my-2 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                    <label for="WofferDiscpuntPrice" class="form-label fw-bolder color-white">Weekend Discount Price</label>
                                    <input type="number" name="WofferDiscpuntPrice" v-model="item.WofferDiscpuntPrice" class="form-control" id="WofferDiscpuntPrice" placeholder="e.g 8500tk" :class="hasError('WofferDiscpuntPrice') ? 'is-invalid' : '' ">
                                    <div class="invalid-feedback" v-if="hasError('WofferDiscpuntPrice')">{{getError('WofferDiscpuntPrice')}}</div>
                                </div>

                                <div class="my-2 col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                    <label for="wdiscount" class="form-label fw-bolder color-white">Wdiscount Ratio</label>
                                    <input type="text" name="wdiscount" v-model="item.wdiscount" class="form-control" id="wdiscount" placeholder="20" :class="hasError('wdiscount') ? 'is-invalid' : '' ">
                                    <div class="invalid-feedback" v-if="hasError('wdiscount')">{{getError('wdiscount')}}</div>
                                </div>

                                <div class="my-2 col-xl-12 col-sm-12 fw-bold">     
                                    <label for="inputZip" class="form-label color-white">Upload a Room Type Title Image (<span class="text-sm text-primary">600x475 px</span>) </label>
                                    <input type="file" class="form-control" @change="onFileChange($event, index)">

                                    <div class="p-3 table-border-dark bg-header rounded position-relative mt-2" v-show="item.img">
                                        <img class="rounded p-2 table-border-dark" width="120" :src="`${item.img}`" />
                                        <!-- <span class="position-absolute top-50 start-50 translate-middle">
                                            <Icon type="ios-trash-outline" size="24" color="red" @click="deleteImageRoom(img)" />
                                        </span> -->
                                    </div>

                                    <div class="invalid-feedback" v-if="hasError('img')">{{getError('img')}}</div>

                                </div>

                                <div class="col-md-12">
                                    <label for="inputAddress" class="form-label fw-bolder color-white"> Room Features</label>
                                    <div class="table-border-dark bg-header rounded p-4" :class="hasError('roomFeatures') ? 'is-invalid' : '' ">

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


                                <div class="my-2 col fw-bold d-flex align-items-center justify-content-center" v-if="this.data.form.length > 1">
                                    <a class="btn btn-danger text-white" @click="removeRow(index)"> <b-icon-trash class="d-inline text-white" width="25" height="25"></b-icon-trash></a>
                                </div>
                            
                            </div>

                            <div class="my-2 col fw-bold d-flex align-items-center justify-content-center">
                                <a class="btn btn-success mx-1 text-white" @click="addRow"> <b-icon-plus class="d-inline text-white" width="25" height="25"></b-icon-plus></a>
                            </div>

                           
                            
                        </div>

                        <div class="col-md-4">
                            <label for="stars" class="form-label fw-bolder color-white">Hotel Stars</label>
                            <input type="text" max="5" min="0" name="stars" v-model="data.stars" class="form-control" id="stars" :class="hasError('stars') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('stars')">{{getError('stars')}}</div>
                        </div>

                        <div class="col-md-4">
                            <label for="inputZip" class="form-label fw-bolder color-white">Hotel In Time</label>
                            <input type="time" name="checkIn" v-model="data.checkIn" class="form-control" id="inputZip3" placeholder="e.g 02.00 am" :class="hasError('checkIn') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('checkIn')">{{getError('checkIn')}}</div>
                        </div>

                        <div class="col-md-4">
                            <label for="inputZip" class="form-label fw-bolder color-white">Hotel Out Time</label>
                            <input type="time" name="checkOut" v-model="data.checkOut" class="form-control" id="inputZip3" placeholder="e.g 05.00 am" :class="hasError('checkOut') ? 'is-invalid' : '' ">
                            <div class="invalid-feedback" v-if="hasError('checkOut')">{{getError('checkOut')}}</div>
                        </div> 

                        <div class="col-md-12">
                            <label for="inputZip3" class="form-label fw-bolder color-white">Hotel Rules</label>
                            <div><QuillEditor v-model:content="data.houseRules" contentType="html" toolbar="full" theme="snow" :class="hasError('houseRules') ? 'is-invalid' : '' " /></div>
                            <!-- <textarea class="form-control" name="houseRules" v-model="data.houseRules" id="exampleFormControlTextarea1" rows="2" :class="hasError('houseRules') ? 'is-invalid' : '' "></textarea> -->
                            <div class="invalid-feedback" v-if="hasError('houseRules')">{{getError('houseRules')}}</div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="inputZip" class="form-label fw-bolder color-white">Pet Policy</label>
                            <div><QuillEditor v-model:content="data.petPolicy" contentType="html" toolbar="full" theme="snow" :class="hasError('petPolicy') ? 'is-invalid' : '' " /></div>
                            <!-- <textarea name="petPolicy" v-model="data.petPolicy" class="form-control" id="exampleFormControlTextarea1" rows="2" :class="hasError('petPolicy') ? 'is-invalid' : '' "></textarea> -->
                            <div class="invalid-feedback" v-if="hasError('petPolicy')">{{getError('petPolicy')}}</div>
                        </div>

                        <div class="col-md-6">
                            <label for="inputZip" class="form-label fw-bolder color-white">Kids Policy</label>
                            <div><QuillEditor v-model:content="data.kidsPolicy" contentType="html" toolbar="full" theme="snow" :class="hasError('kidsPolicy') ? 'is-invalid' : '' " /></div>
                            <!-- <textarea name="kidsPolicy" v-model="data.kidsPolicy" class="form-control" id="exampleFormControlTextarea1" rows="2" :class="hasError('kidsPolicy') ? 'is-invalid' : '' "></textarea> -->
                            <div class="invalid-feedback" v-if="hasError('kidsPolicy')">{{getError('kidsPolicy')}}</div>
                        </div>

                        <div class="col-md-12">
                            <label for="inputAddress" class="form-label fw-bolder color-white">Features</label>
                            <div class="table-border-dark bg-header rounded p-4" :class="hasError('facilites') ? 'is-invalid' : '' ">

                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Hill View/Mountain View" class="form-check-input" type="checkbox" id="fa1">
                                    <label class="form-check-label" for="fa1">Hill View/Mountain View</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Steam Bath" class="form-check-input" type="checkbox" id="fa2">
                                    <label class="form-check-label" for="fa2">Steam Bath</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Laundry Service" class="form-check-input" type="checkbox" id="fa3">
                                    <label class="form-check-label" for="fa3">Laundry Service</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Business Center" class="form-check-input" type="checkbox" id="fa4">
                                    <label class="form-check-label" for="fa4">Business Center</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Hall Room" class="form-check-input" type="checkbox" id="fa5">
                                    <label class="form-check-label" for="fa5">Hall Room</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Prayer Room" class="form-check-input" type="checkbox" id="fa6">
                                    <label class="form-check-label" for="fa6">Prayer Room</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Tour and Travel Desk" class="form-check-input" type="checkbox" id="fa7">
                                    <label class="form-check-label" for="fa7">Tour and Travel Desk</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Water Park" class="form-check-input" type="checkbox" id="fa8">
                                    <label class="form-check-label" for="fa8">Water Park</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Doctor on Call" class="form-check-input" type="checkbox" id="fa9">
                                    <label class="form-check-label" for="fa9">Doctor on Call</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="DJ Party/ Night Club" class="form-check-input" type="checkbox" id="fa10">
                                    <label class="form-check-label" for="fa10">DJ Party/ Night Club</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="B-B-Q" class="form-check-input" type="checkbox" id="fa11">
                                    <label class="form-check-label" for="fa11">B-B-Q</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Safety Locker" class="form-check-input" type="checkbox" id="fa12">
                                    <label class="form-check-label" for="fa12">Safety Locker</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Indore Games" class="form-check-input" type="checkbox" id="fa13">
                                    <label class="form-check-label" for="fa13">Indore Games</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Kayaking Boat" class="form-check-input" type="checkbox" id="fa15">
                                    <label class="form-check-label" for="fa15">Kayaking Boat</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Fishing" class="form-check-input" type="checkbox" id="fa16">
                                    <label class="form-check-label" for="fa16">Fishing</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Salon" class="form-check-input" type="checkbox" id="fa17">
                                    <label class="form-check-label" for="fa17">Salon</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Luggage Room" class="form-check-input" type="checkbox" id="fa18">
                                    <label class="form-check-label" for="fa18">Luggage Room</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input v-model="data.facilites" value="Breakfast Included" class="form-check-input" type="checkbox" id="1">
                                    <label class="form-check-label" for="1">Breakfast Included</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Kitchen facilities" v-model="data.facilites" type="checkbox" id="2">
                                    <label class="form-check-label" for="2">Kitchen facilities</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Bar Inside" v-model="data.facilites" type="checkbox" id="3">
                                    <label class="form-check-label" for="3">Bar Inside</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="5 stars" v-model="data.facilites" type="checkbox" id="4">
                                    <label class="form-check-label" for="4">5 stars</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Beach View" v-model="data.facilites" type="checkbox" id="5">
                                    <label class="form-check-label" for="5">Beach View</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Parking Area" v-model="data.facilites" type="checkbox" id="6">
                                    <label class="form-check-label" for="6">Parking Area</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Free WiFi" v-model="data.facilites" type="checkbox" id="7">
                                    <label class="form-check-label" for="7">Free WiFi</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Swimming pool" v-model="data.facilites" type="checkbox" id="8">
                                    <label class="form-check-label" for="8">Swimming pool</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Pet friendly" v-model="data.facilites" type="checkbox" id="10">
                                    <label class="form-check-label" for="10">Pet friendly</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Kids Zone" v-model="data.facilites" type="checkbox" id="11">
                                    <label class="form-check-label" for="11">Kids Zone</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Smoking Zone" v-model="data.facilites" type="checkbox" id="12">
                                    <label class="form-check-label" for="12">Smoking Zone</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Air conditioning" v-model="data.facilites" type="checkbox" id="13">
                                    <label class="form-check-label" for="13">Air conditioning</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Wheelchair accessibleg" v-model="data.facilites" type="checkbox" id="14">
                                    <label class="form-check-label" for="14">Wheelchair accessibleg</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Balcony" v-model="data.facilites" type="checkbox" id="15">
                                    <label class="form-check-label" for="15">Balcony</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Steam room" v-model="data.facilites" type="checkbox" id="16">
                                    <label class="form-check-label" for="16">Steam room</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Full-body massage" v-model="data.facilites" type="checkbox" id="17">
                                    <label class="form-check-label" for="17">Full-body massage</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Fitness center" v-model="data.facilites" type="checkbox" id="18">
                                    <label class="form-check-label" for="18">Fitness center</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Sauna" v-model="data.facilites" type="checkbox" id="19">
                                    <label class="form-check-label" for="19">Sauna</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Spa facilities" v-model="data.facilites" type="checkbox" id="20">
                                    <label class="form-check-label" for="20">Spa facilities</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Tourist Info Centre" v-model="data.facilites" type="checkbox" id="21">
                                    <label class="form-check-label" for="21">Tourist Info Centre</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="No prepayment" v-model="data.facilites" type="checkbox" id="22">
                                    <label class="form-check-label" for="22">No prepayment</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Free cancellation" v-model="data.facilites" type="checkbox" id="23">
                                    <label class="form-check-label" for="23">Free cancellation</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Book without credit card" v-model="data.facilites" type="checkbox" id="24">
                                    <label class="form-check-label" for="24">Book without credit card</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Resort Hotel" v-model="data.facilites" type="checkbox" id="25">
                                    <label class="form-check-label" for="25">Resort Hotel</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Apart Hotel" v-model="data.facilites" type="checkbox" id="26">
                                    <label class="form-check-label" for="26">Apart Hotel</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Hotel"  v-model="data.facilites" type="checkbox" id="27">
                                    <label class="form-check-label" for="27">Hotel</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Telephone"  v-model="data.facilites" type="checkbox" id="28">
                                    <label class="form-check-label" for="28">Telephone</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Mobile Phone Coverage"  v-model="data.facilites" type="checkbox" id="300">
                                    <label class="form-check-label" for="300">Mobile Phone Coverage</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Vehicle Parking"  v-model="data.facilites" type="checkbox" id="100">
                                    <label class="form-check-label" for="100">Vehicle Parking</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Couple Friendly"  v-model="data.facilites" type="checkbox" id="200">
                                    <label class="form-check-label" for="200">Couple Friendly</label>
                                </div>

                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Coffee/Tea in Lobby"  v-model="data.facilites" type="checkbox" id="500">
                                    <label class="form-check-label" for="500">Coffee/Tea in Lobby</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Alcohol Permit"  v-model="data.facilites" type="checkbox" id="501">
                                    <label class="form-check-label" for="501">Alcohol Permit</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Accessible Bathroom"  v-model="data.facilites" type="checkbox" id="502">
                                    <label class="form-check-label" for="502">Accessible Bathroom</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Clothes Dryer"  v-model="data.facilites" type="checkbox" id="503">
                                    <label class="form-check-label" for="503">Clothes Dryer</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Medical Support"  v-model="data.facilites" type="checkbox" id="505">
                                    <label class="form-check-label" for="505">Medical Support</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Room Service"  v-model="data.facilites" type="checkbox" id="506">
                                    <label class="form-check-label" for="506">Room Service</label>
                                </div>
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" value="Washing machine"  v-model="data.facilites" type="checkbox" id="507">
                                    <label class="form-check-label" for="507">Washing machine</label>
                                </div>

                            </div>

                            <div class="invalid-feedback" v-if="hasError('facilites')">{{getError('facilites')}}</div>

                        </div>

                        <div class="col-md-12">
                           
                            <label for="inputZip" class="form-label fw-bolder color-white">Payment Method Accept:</label>
                            
                            <div class="row p-3 table-border-dark rounded bg-header text-center" :class="hasError('paymentType') ? 'is-invalid' : '' ">
                                <div class="bg-header p-2 shadow rounded col-md-2 col-sm-4">
                                    <input v-model="data.paymentType" value="Visa" id="Visa" class="form-check-input" type="checkbox">
                                    <img src="img/payment/1.png" class="" height="30" width="30" alt="">
                                </div>
                                <div class="bg-header p-2 shadow rounded col-md-2 col-sm-4">
                                    <input v-model="data.paymentType" value="UCB" id="UCB" class="form-check-input" type="checkbox">
                                    <img src="img/payment/2.png" class="" height="30" width="30" alt="">
                                </div>
                                <div class="bg-header p-2 shadow rounded col-md-2 col-sm-4">
                                    <input v-model="data.paymentType" value="Exim" id="Exim" class="form-check-input" type="checkbox">
                                    <img src="img/payment/3.png" class="" height="30" width="30" alt="">
                                </div>
                                <div class="bg-header p-2 shadow rounded col-md-2 col-sm-4">
                                    <input v-model="data.paymentType" value="Bkesh" id="Bkesh" class="form-check-input" type="checkbox">
                                    <img src="img/payment/4.jpg" class="" height="30" width="30" alt="">
                                </div>
                                <div class="bg-header p-2 shadow rounded col-md-2 col-sm-4">
                                    <input v-model="data.paymentType" value="DBBL" id="DBBL" class="form-check-input" type="checkbox">
                                    <img src="img/payment/5.jpg" class="" height="30" width="30" alt="">
                                </div>
                                <div class="bg-header p-2 shadow rounded col-md-2 col-sm-4">
                                    <input v-model="data.paymentType" value="MasterCard" id="MasterCard" class="form-check-input" type="checkbox">
                                    <img src="img/payment/6.png" class="" height="30" width="30" alt="">
                                </div>
                                <div class="bg-header p-2 shadow rounded col-md-2 col-sm-4">
                                    <input v-model="data.paymentType" value="PayPal" id="PayPal" class="form-check-input" type="checkbox">
                                    <img src="img/payment/7.jpg" class="" height="30" width="30" alt="">
                                </div>
                                <div class="bg-header p-2 shadow rounded col-md-2 col-sm-4">
                                    <input v-model="data.paymentType" value="Rocket" id="Rocket" class="form-check-input" type="checkbox">
                                    <img src="img/payment/8.png" class="" height="30" width="30" alt="">
                                </div>
                                <div class="bg-header p-2 shadow rounded col-md-2 col-sm-4">
                                    <input v-model="data.paymentType" value="Cash" id="cash" class="form-check-input mr-4" type="checkbox">
                                    <p class="color-white fw-bold ml-4">Cash</p>
                                </div>

                            </div>

                            <div class="invalid-feedback" v-if="hasError('paymentType')">{{getError('paymentType')}}</div>

                        </div>

                        <div class="col-md-12">
                            
                            <form method="POST">
                                <label for="images" class="form-label fw-bolder color-white">Hotel Images</label>
                                <div class="p-3 table-border-dark bg-header rounded">

                                    <div class="mb-3">
                                        <label for="formFile" class="form-label fw-bold">Upload all Images (<span class="text-sm text-primary">All Image Same Size Recommended</span>) </label>
                                        <input multiple class="form-control" type="file" id="file-uplaod-two" @change="fieldChange" :class="hasError('images') ? 'is-invalid' : '' ">
                                        <div class="invalid-feedback" v-if="hasError('images')">{{getError('images')}}</div>
                                    </div>

                                    <div class="p-3 table-border-dark rounded" v-show="this.files.length">

                                        <div class="position-r d-inline-flex mx-3 my-4" v-for="(img,index) in this.files" :key="index">
                                            <img :src="img" class="rounded table-border-dark shadow-sm " width="100" alt=""> 
                                            <div class="position-absolute top-100 start-50 translate-middle text-center text-muted p-2 bg-main w-100 font-sm"><span>{{ this.data.images[index].size }} KB</span></div>
                                            <a class="position-absolute top-0 start-100 translate-middle bg-header rounded-circle table-border-dark p-1" @click="deleteImageMul(index)"><b-icon-x-lg class="text-danger fw-bold" width="18"></b-icon-x-lg></a>
                                        </div>

                                    </div>

                                </div>
                            </form>
                            
                        </div>

                        <div class="col-md-12">
                            
                            <form method="POST" class="p-3">
                                <label for="images" class="form-label fw-bolder color-white">Hotel Instructions</label>
                                <div class="row p-3 table-border-dark bg-header rounded">

                                    <div class="mb-3 col-12" v-for="(item,i) in data.ins" :key="i">
                                        <label for="formFile" class="form-label fw-bold">Hotel Instructions {{ i+1 }}</label>
                                        <input class="form-control" v-model="item.instruction" type="text">

                                        <div class="my-2 fw-bold d-flex align-items-center justify-content-center" v-if="this.data.ins.length > 1">
                                            <a class="btn btn-danger text-white" @click="removeRowIns(i)"> <b-icon-trash class="d-inline text-white" width="25" height="25"></b-icon-trash></a>
                                        </div>
                                    </div>

                                    <div class="my-2 col-12 fw-bold d-flex align-items-center justify-content-center">
                                        <a class="btn btn-success mx-1 text-white" @click="addRowIns"> <b-icon-plus class="d-inline text-white" width="25" height="25"></b-icon-plus></a>
                                    </div>

                                </div>
                            </form>
                            
                        </div>


                        <div class="col-12 mt-5 text-center d-flex justify-content-between">

                            <button @click.prevent="resetAll()" type="button" class="shadow btn btn-outline-secondary text-center col-2 mx-auto">
                            <b-icon-arrow-repeat class="d-inline text-white mr-2" width="18" height="18"></b-icon-arrow-repeat>
                                Reset
                            </button>

                            <button type="submit" class="shadow btn btn-outline-primary text-center col-6 mx-auto">
                            <b-icon-save class="d-inline text-white mr-2" width="18" height="18"></b-icon-save>
                                Save
                            </button>

                        </div>

                    </form>
                    
                </div>
            </div>
        </div>
    
    </div>
</template>
  
<script>

    export default {
        data () {
            return {
                form: new FormData,
                errors:{},
                files:[],
                success: false,
                error: false,
                token: "",
                data:{
                    home: 0,
                    name : '',
                    address : '',
                    tourPointAddress : '',
                    tourPointAddress2 : '',
                    tourPointAddress3 : '',
                    tourPointAddress4 : '',
                    phone : '',
                    email : '',
                    description : '',
                    discount : '',
                    city:'',
                    country:'',
                    right: '',
                    zip:'',
                    price:'',
                    total_room:'',
                    constraction_year:'',
                    floor_no:'',
                    form: [{
                        offerTitle:'Basic',
                        totalPerson: 1,
                        bed: 1,
                        size: "2400",
                        offerRegularPrice: 0,
                        offerDiscpuntPrice: 0,
                        WofferRegularPrice: 0,
                        WofferDiscpuntPrice: 0,
                        rdiscount: 0,
                        wdiscount: 0,
                        img: null,
                        imgName: null,
                        roomFeatures: [],
                    }],
                    ins: [{
                        instruction: ''
                    }],
                    houseRules:'',
                    checkIn:'',
                    checkOut:'',
                    petPolicy:'',
                    kidsPolicy:'',
                    stars:'',
                    image:'',
                    facilites: [],
                    paymentType: [],
                    images:[],
                },

                hotelInfo: [],
             
            }
        },
        methods: {

            async onFileChange(event, index) {
                const file = event.target.files[0]
                
                let reader = new FileReader()
                
                reader.onload = (e) => {
                    this.data.form[index].img = e.target.result  
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
                this.data.form[index].imgName = imgData;
            },

            addRow(){
                this.data.form.push({
                    offerTitle: '',
                    totalPerson: 0,
                    bed: 0,
                    size: 0,
                    offerRegularPrice: 0,
                    offerDiscpuntPrice: 0,
                    WofferRegularPrice: 0,
                    WofferDiscpuntPrice: 0,
                    rdiscount: 0,
                    wdiscount: 0,
                    img: null,
                    imgName: null,
                    roomFeatures: [],
                })
            },

            addRowIns(){
                this.data.ins.push({
                    instruction: '',
                })
            },

            removeRow(index){
                if(this.data.form.length > 1){
                    this.data.form.splice(index,1)
                }
            },

            removeRowIns(i){
                if(this.data.ins.length > 1){
                    this.data.ins.splice(i,1)
                }
            },

            handleSuccess(res, file) {
                res = `/hotel_title_image/${res}`;
                this.data.image = res;
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
            
                
            // console.log(this.data.images);
                
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

            deleteImageRoom(img){
                this.data.form.splice(img,1);
                this.infoMsg("Image Removed");
            },

            deleteImageMul(index){
                this.files.splice(index,1);
                this.infoMsg("Image Removed");
            },

            deleteImage(index){
                this.data.image = '';
                this.infoMsg("Image Removed");
            },

            async store(){
                console.log(this.data)
                const res = await this.callApi("post", "hotel/store",this.data);
                if(res.status === 201){
                    this.successMsg("Holtel Information Added Successfully");
                    this.hotelInfo = res.data;
                    this.storeImages();
                    this.$router.push({name: 'Hotel'});
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

            async storeImages(){

                for(let i=0; i<this.data.images.length;i++){
                    this.form.append('Hotel_Images[]', this.data.images[i]);
                }
                this.form.append('hotel_name', this.hotelInfo.name);
                this.form.append('hotel_id', this.hotelInfo.id);

                const config = { headers: { 'Content-Type': 'multipart/form-data' } };
                const res = await this.callApi("post", "hotel/store/image",this.form,config)

                if(res.status === 200){
                    document.getElementById('file-uplaod-two').value=[];
                    this.errors = {};
                    this.files = [];
                    this.data = [];
                   
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
            
            resetAll(){
                this.$router.go();
            },

            
        },

        mounted () {
            
        },

        async created(){
            this.token = window.laravel.csrfToken;
        }

       
    }
</script>

<style scoped>
.position-r{
    position:  relative !important;
}

.ivu-icon-ios-camera {
    color: black !important;
    font-size: 40px !important;
    display: flex  !important;
    align-items: center !important;
    justify-content: center !important;
}

.image_thumb {
    height: 100px;
    width: 100px;
    overflow: hidden;
}

.img-hover {
    opacity: .7;
}

.img-hover:hover {
    opacity: .3 !important;
}
</style>