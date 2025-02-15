<template>
  <div>

    <div v-if="isLoading" class="preloader">
      <div class="spinner"></div>
    </div>

    <div class="container-fluid main-div">

      <div class="container-custom2 child position-relative bg-white border shadow container-main py-4 px-2">
        
        <div class="accordion" id="accordionExample">

          <div class="border p-2 d-flex flex-row shadow bg-white container-main position-absolute top-0 start-50 translate-middle">

            
            <div class="accordion-header" id="headingOne">
              <a class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                <!-- <b-icon-house-heart class="text-muted border bg-light d-inline" width="25" height="25"></b-icon-house-heart> -->
                <img src="/img/icon/bed.png" class="text-primary d-inline" width="30" height="30" alt="">
                <h6 class="ml-2 mr-2 text-center text-dark fw-bold d-none d-md-block">Find Your Hotel</h6>
              </a>
            </div>
            
          </div>

          <HotelSearch></HotelSearch>

        </div>

      </div>  

    </div>

    <div class="container-fluid bg-light-cus py-4 px-0" v-if="topTwoAds != '' ">

      <div class="container-custom px-0">
          
        <div class="row overflow-hidden py-4 px-0" v-for="(ad,i) in topTwoAds" :key="i">

          <div class="col-sm-12 col-md-auto mx-auto p-2" v-if="ad.ad_one">
            <div class="text-center my-auto" v-html="ad.ad_one"></div>
          </div>
          <div class="col-sm-12 col-md-auto mx-auto p-2" v-if="ad.ad_two">
            <div class="text-center my-auto" v-html="ad.ad_two"></div>
          </div>
          <div class="col-sm-12 col-md-auto mx-auto p-2" v-if="ad.ad_three">
            <div class="text-center my-auto" v-html="ad.ad_three"></div>
          </div>
          <div class="col-sm-12 col-md-auto mx-auto p-2" v-if="ad.ad_four">
            <div class="text-center my-auto" v-html="ad.ad_four"></div>
          </div>

          <!-- <div class="col-md-6 col-sm-12">
            <div class="text-center text-md-start my-auto"><img :src="img.right_ads_path" class="m-1 img-fluid rounded-custom" alt=""></div>
          </div> -->

        </div>

      </div>

    </div>

    <div class="container-custom py-5 mx-auto px-0"> 

      <div class="d-flex flex-row aling-items-center justify-content-start py-2">
        <b-icon-back class="icon-color mr-2 my-auto" width="20" height="20"></b-icon-back>
        <h4 class="text-dark1 text-center my-auto">Top Hotels</h4>
      </div>
      <p class="text-muted ml-4">The journey of a thousand miles begins with a single step.</p>
      <hr class="mb-2 mt-1">
      

      <div class="row m-0 p-0">

        <div class="row mt-3 mx-0 px-0 ">
            
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 my-2 position-relative" v-for="(data,i) in hotelList" :key="i">

            <span v-if="data.floor_no" class="zIndex px-2 py-1">{{ data.floor_no }}</span>
            <span v-if="data.right_top" class="zIndex1 px-2 py-1">{{ data.right_top }}</span>

            <div class="p-0 m-0 d-flex  position-relative img-main-div bg-white overflow-hidden">
                <img :src="data.titleImage" alt="Avatar" class="image img-fluid">
                <div class="middle">
                  <a :href="'/hotel-info?id='+data.id" target="_blank" class="btn btn-dark1 fw-bolder text-white"><b-icon-eye class="d-inline text-light mr-2" width="18" height="18"></b-icon-eye>See Hotels</a>
                </div>
                <h6 v-if="data.constraction_year"><small class="aling-middle px-2 py-1 bg-dark-location2 fw-bolder"><b-icon-gift class="d-inline text-danger mr-2" width="17" height="17"></b-icon-gift>{{ data.constraction_year }}</small></h6>
                <h6><small class="aling-middle px-2 py-1 bg-dark-location fw-bolder position-absolute bottom-0 end-0"><b-icon-geo-alt class="d-inline text-primary mr-2" width="17" height="17"></b-icon-geo-alt>{{ data.city }}</small></h6>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 w-100 col-sec  text-dark">

              <!-- <h6 class="fw-bold mb-2 aling-middle name-hotel"><b-icon-house-heart-fill class="d-inline text-success mr-2" width="25" height="25"></b-icon-house-heart-fill>{{ data.name }}</h6> -->
              
              <div class="d-flex justify-content-start aling-items-center mb-1 name-hotel">
                <b-icon-house-heart-fill class="my-auto text-success mr-2" width="27" height="27"></b-icon-house-heart-fill>
                <h6 class="fw-bold mb-2 my-auto">{{ data.name }}</h6>
              </div>

              <div class="d-flex justify-content-between aling-items-center mb-1" v-for="(r,i) in data.rent" :key="i">
                <p class="ml-2  p-2" v-if="i == 0">Starting from<span class="fw-bold ml-2">৳ {{ r.offerDiscpuntPrice }}</span>/night</p> 
                <p class="fw-bold float-end my-auto p-1 rounded bg-col text-center" v-if="i == 0"> <span class="text-sm1 text-white">{{ r.rdiscount}}%</span> OFF </p>
              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <div class="container-fluid bg-light-cus py-4" v-if="ads != '' ">

      <div class="container-custom" v-if="ads != '' ">
          
          <div class="row pt-4">
            <div class="col-12">
              <vueper-slides 
                  fixed-height="170px"
                  :breakpoints="{ 600: { visibleSlides: 1 },900: { visibleSlides: 1 },1200: { visibleSlides: 2 },1400: { visibleSlides: 3 },1500: { visibleSlides: 3 }  }"
                  :infinite="true" 
                  :visible-slides="3"
                  :slide-ratio="(1/5)"
                  :dragging-distance="70"
                  :gap="2"
                  :bullets="false"
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
                  v-for="(image,i) in ads"
                  :key="i"
                  :image="image.ads_path"
                  class="image rounded-img"
                  >

                  <template #content>
                    <a class="position-absolute top-0 end-0">
                      <img src="/img/fav.png" class="p-2" width="40" alt="">
                    </a>
                  </template>

                </vueper-slide>
              </vueper-slides>
            </div>
          </div>

      </div>

    </div>
    
    <div class="container-fluid px-0 mx-0  pt-4 my-4">

      <div class="container-custom mb-4">

        <div class="d-flex flex-row aling-items-center justify-content-start py-2">
          <b-icon-hospital class="icon-color mr-2 my-auto" width="20" height="20"></b-icon-hospital>
          <h4 class="text-dark1 text-center my-auto">Top Destinations</h4>
        </div>
        <p class="text-muted ml-4">These are the most cost effictive and place  to visite.</p>
        <hr class="mb-4 mt-1">

        <div class="row">

          <div class="col-lg-4 col-md-6 col-sm-12" v-for="(blog,i) in blogList" :Key="i">
            
            <a @click="info(blog,i)" class="image-main mx-auto">
              <template v-for="(img,j) in blog.images" :key="j">
                <img v-if="j==0" :src="img.image" class="city_image img-fluid" alt="">
              </template>
              <a class="text text-white fw-bold fs-4 w-50"> {{ blog.blog_title }} </a>
              <a class="position-absolute bottom-0 end-0"><img src="/img/fav.png" class="p-2" width="40" alt=""></a>
            </a>

          </div>

        </div>  

        <div class="text-center mt-2 mb-4">
            <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" v-if="this.blogList != ''" @on-change="getBlog" />
        </div>

      </div>

    </div>


  </div>
</template>

<script>
import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'

import HotelSearch from '../search/hotelSearch.vue'

export default {


    
    components: {
      VueperSlides,
      VueperSlide,
      HotelSearch,
    },
   // /hotel_title_image/1683754286.jpg
    data () {
        return {
          hotelDetails: this.$store.state.popMoadal,
          show: false,
          hotelList: [],
          hotelListBangladesh: [],
          staysInBangladesh: [],
          singleHotel: [],
          topTwoAds: [],
          ads: [],
          isLoading: true,
          blogList: [],
          total:6,
          pageInfo: null,
        }
    },
    methods: {

      info(blog,i) {
        window.location = `/blogs?str=${blog.id}&cat=${blog.title_image}`;
      },

      async getBlog(page) {
        this.isLoading = true;
        const res = await this.callApi("get",`/blog/all?total=${this.total}&page=${page}`);
        if (res.status == 200) {
            this.blogList = res.data.data;
            this.pageInfo = res.data;
            setTimeout(() => {
              this.isLoading = false;
            }, 300);
            //console.log(this.blogList)
        } else {
            this.errorMsg();
        }
      },

      async getTopTwoAds() {
        const res = await this.callApi("get", "home/home/topTwoAdsGet");
        if (res.status == 200) {
            this.topTwoAds = res.data;
        } else {
            this.errorMsg();
        }
      },

      async getAds() {
          const res = await this.callApi("get", "home/home/adsGet");
          if (res.status == 200) {
              this.ads = res.data;
          } else {
              this.errorMsg();
          }
      },

      async getDestinationHotelList(){
        const res = await this.callApi("get","home/getTopDestinationHotel");
        if (res.status == 200) {
          this.hotelList = res.data;
          //console.log(this.hotelList)
        } else {
          this.errorMsg();
        }
      },

      // async hotelInfo(data,i) {
      //   let id = data.id;
      //   const res = await this.callApi("get",`home/hotelDetails?id=${id}`);
      //   if (res.status == 200) {
      //     this.singleHotel = res.data;
      //     this.$store.state.popMoadal = true;
      //     console.log(this.singleHotel)
      //   } else {
      //     this.errorMsg();
      //   }
      // },

      // async tourInBdSingle(slide,i) {
      //   let id = slide.id;
      //   const res = await this.callApi("get",`home/hotelDetails?id=${id}`);
      //   if (res.status == 200) {
      //     this.singleHotel = res.data;
      //     this.$store.state.popMoadal = true;
      //     console.log(this.singleHotel)
      //   } else {
      //     this.errorMsg();
      //   }
      // },
      
      // async reputatedStaysInBdSingle(hotel,i) {
      //   let id = hotel.id;
      //   const res = await this.callApi("get",`home/hotelDetails?id=${id}`);
      //   if (res.status == 200) {
      //     this.singleHotel = res.data;
      //     this.$store.state.popMoadal = true;
      //     console.log(this.singleHotel)
      //   } else {
      //     this.errorMsg();
      //   }
      // },

      // async tourInBangladesh(){
      //   const res = await this.callApi("get","home/getTourInBD");
      //   if (res.status == 200) {
      //     this.hotelListBangladesh = res.data;
      //     console.log(this.hotelListBangladesh)
      //   } else {
      //     this.errorMsg();
      //   }
      // },

      // async reputatedStaysInBangladesh(){
      //   const res = await this.callApi("get","home/getreputatedStaysInBangladesh");
      //   if (res.status == 200) {
      //     this.staysInBangladesh = res.data;
      //     console.log(this.staysInBangladesh)
      //   } else {
      //     this.errorMsg();
      //   }
      // }

    },

    async created(){

      this.getBlog();
      this.getTopTwoAds();
      this.getAds();
      this.getDestinationHotelList();
      // this.tourInBangladesh();
      // this.reputatedStaysInBangladesh();
      setTimeout(() => {
        this.isLoading = false;
      }, 500);

    }
}

</script>

<style scoped>

.name-hotel{
  height: 40px;
}
.rounded-custom{
  height: 80%;
  border-radius: 12px;
  transition: transform .3s;
}

.rounded-custom:hover{
  border-radius: 10px;
  transform: scale(1.03);
}
.image-main{
  position: relative;
  width: 90%;
  height: 90%;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: transform .3s;
}
.city_image{
  width: 100%;
  height: 100%;
  border-radius: 15px;
}

.image-main:before {
  content: "";
  display: block;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.564);
  border-radius: 15px;
}

.text {
  text-shadow: 5px 5px 10px black;
  margin: 0;
  position: absolute;
  text-align: center;
}
.image-main:hover{
  transform: scale(1.03);
}
.zIndex{
  color: #fff;
  background: -webkit-linear-gradient(to right, #E2E2E2, #052b56);  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #000000, #053a7f); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  font-weight: bolder;
  z-index: 100;
  border-top: .5px solid rgb(131, 202, 247);
  border-top-right-radius: 0px;
  border-top-right-radius: 20px;
  position: absolute;
  top: 20px;
  left: 12px;
}

.zIndex1{
  color: #fff;
  background: -webkit-linear-gradient(to right, #E2E2E2, #052b56);  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #052b56, #633c00); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  font-weight: bolder;
  z-index: 100;
  border-top: .5px solid rgb(131, 202, 247);
  border-top-right-radius: 0px;
  border-top-left-radius: 20px;
  position: absolute;
  top: 20px;
  right: 12px;
}
.bg-dark-location2{
  border-top: .5px solid rgb(131, 202, 247);
  color: #000;
  background: -webkit-linear-gradient(to right, #E2E2E2, #052b56);  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #ffffff, #ffe7ca); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  border-top-left-radius: 20px;
  border-bottom-left-radius: 0px;
  width: auto;
  position: absolute;
  top: 65%;
  right: 0;
}

.bg-dark-location{
  border-top: .5px solid rgb(131, 202, 247);
  color: #fff;
  background: -webkit-linear-gradient(to right, #E2E2E2, #052b56);  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #000000, #014f37); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
  border-top-left-radius: 20px;
  width: auto;
}
.container-custom {
  width: 85% !important;
  margin-left: auto;
  margin-right: auto;

}

.container-custom2 {
  width: 1100px !important;
  margin-left: auto;
  margin-right: auto;

}

.rounded-img{
  border-top-right-radius: 10px !important;
  border-top-left-radius: 10px !important;
  border-bottom-left-radius: 10px !important;
  border-bottom-right-radius: 10px !important;
}

.col-sec{
  height: 120px;
  padding: 15px 8px !important;
 /* background: #bfe1db35; */
  border: 1px solid rgb(209, 209, 209);
  border-bottom-right-radius: 10px;
  border-bottom-left-radius: 10px;
  background: #141414;  /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #E2E2E2, #c9e2ff);  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #fff4dd, #b0dae9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}

.bg-light-cus{
  background: #ffffff;  /* fallback for old browsers */
}

.bg-col{
  color: #ff0000 !important;
  background: #ffffff;  /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #000000,#004d0e);  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #000000,#004d0e); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.image {
  opacity: 1;
  display: block;
  transition: .7s ease;
  backface-visibility: hidden;
  margin-left: auto;
  margin-right: auto; 
}
.img-main-div{
  overflow: hidden;
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;
  border: 1px solid rgb(209, 209, 209);
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
  background: #000000 !important;
  border-radius: 20px;
}
.img-main-div:hover .image {
  opacity: 0.7;
  transform: scale(1.1); 
}
.image:hover {
  transform: scale(1.1); 
}

.img-main-div:hover .middle {
  opacity: 1;
  background: #000000 !important;
}

.bg-btn{
  background: #000000;
  opacity: .7;
}
.bg-btn:hover{
  background: #000000;
  opacity: 1;
}
.bg-card {
  background: #fff;
}

.bg-card:hover {
  background: #006386;
  cursor: pointer;
}
.bg-icon{
  background: rgb(255, 255, 255);
  border: .5px solid rgba(252, 159, 0, 0.785);
}
.bg-card:hover .bg-icon {
  background: rgb(255, 255, 255);
  border: 5px solid rgba(255, 153, 0, 0.785);
}
.bg-card:hover .title-sevice {
  color: #fff;
}
.bg-card:hover .details-info {
  color: rgb(233, 233, 233);
}

.title-sevice {
  color: black;
}

.details-info {
  color: rgb(68, 68, 68);
}
.vueperslides__arrow {
  color: rgb(172, 15, 15) !important;
}
.client-img {
  margin: 0 !important ;
  border-bottom-left-radius: 0 !important;
  border-bottom-right-radius: 0 !important;
}
.client-img:hover {
  border-left: 1px solid #006386 !important;
  border-top: 1px solid #006386 !important;
  border-right: 1px solid #006386 !important;
  background: #00628613 !important;
}


.input-group-sm>.form-select {
  padding-left: 5px !important;
  padding-top: 0 !important;
  padding-bottom: 0 !important;
  padding-right: 0 !important;
}
.bg-color {
  background: linear-gradient(0deg, rgba(255, 255, 255, 0.105), rgba(0, 78, 102, 0.407)) !important;
  height: 100%;
  width: 20%;
  border-top-right-radius: 0 !important;
  border-bottom-right-radius: 0 !important;
}
.carusel-details {
  border-bottom-left-radius: 10px !important;
  border-bottom-right-radius: 10px !important;
  margin-top: 0 !important;
  background: linear-gradient(0deg, rgb(0, 0, 0), rgb(0, 78, 102)) !important;
  border: 0 !important;
}

.text-sm {
  font-size: 11px;
}
.main-div {
  padding: 270px 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
  width: 100%;
  background-image: linear-gradient(to bottom, rgba(0, 13, 11, 0.092), rgba(23, 24, 24, 0.092)),url('/img/backmain.jpg');
  /* background-image: url("/img/a.gif"); */
  background-size: cover !important;
  background-repeat: no-repeat !important;
}

.text-blue {
  color: rgb(0, 0, 0);
  font-weight: 700;
  font-size: 25px;
}

.btn-dark-details {
 background-color: rgb(30, 30, 30);
 color: #fff;
 border: 1px solid rgb(141, 141, 141);
 font-weight: 600;
}
.btn-dark-details:hover {
 background-color: rgb(0, 0, 0);
 color: #fff;
 border: 1px solid rgb(255, 255, 255);
}
 
.slide {
  padding: 25px;
  border-radius: 5px;
  background: rgb(255, 255, 255);
  border: .3px solid rgba(199, 199, 199, 0.836);
}
.w-90p {
  background: linear-gradient(0deg, rgb(0, 0, 0), rgb(0, 42, 55)) !important;
  background-size: cover !important;
  border-bottom: 2px solid #fff;
  border-radius: 5px;
  position: relative;
  cursor: pointer;
}

.w-90p:hover {
 background: linear-gradient(0.25turn, #000000, #1d4201,#f0830f);
}
.main-top {
  background: rgb(84, 2, 146);
  margin-bottom: 10px;
  margin-left: 0;
  margin-right: 0;
  padding: 0;
}

.bg-img {
  text-align: center;
  padding: 200px 0px !important;
  width: 100% !important;
  background-size: cover !important;
  background-repeat: no-repeat !important;
  background: linear-gradient(0deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url("/img/constration.jpg");
  /* background-attachment: fixed; */
}

.bg-img-5 {
  text-align: right;
  padding: 80px 0px;
  background-size: cover !important;
  background-repeat: no-repeat !important;
  background: linear-gradient(0deg, rgba(0, 0, 0, 0.248), rgba(0, 0, 0, 0.237)), url("/img/t2.gif");
  margin-left: auto;
  border-bottom-right-radius: 10px;
  border-top-right-radius: 10px;
}

.bg-img-6 {
  text-align: left;
  padding: 80px 0px;
  background-size: cover !important;
  background-repeat: no-repeat !important;
  background: linear-gradient(0deg, rgba(0, 0, 0, 0.315), rgba(0, 0, 0, 0.244)), url("/img/t1.gif");
  margin-right: auto;
  border-bottom-left-radius: 10px;
  border-top-left-radius: 10px;
}


</style>