<template>
  <div class="bg-white">

    <div v-if="isLoading" class="preloader">
        <div class="spinner"></div>
    </div>
  
    <span v-for="(blog,i) in blogs" :key="i">

      <div class="container-fluid main position-relative mt-50">

        <div class="row">
            <div class="col-12 position-absolute top-50 start-50 translate-middle">
                <div class="d-flex justify-content-center aling-items-center">
                    <h1 class="text-white fw-bold display-4">{{ blog.blog_title }}</h1>
                </div>
            </div>
        </div>

      </div>
     
      <div class="w-70px">
        <div class="row py-4">

          <div class="col-md-6 col-sm-12 py-3">
            <div class="d-flex justify-content-start align-items-center">
              <b-icon-map class="icon2-color mr-2" width="22" height="22"></b-icon-map>
              <h4 class="text-dark1 fw-bold">{{ blog.blog_title }}</h4>
            </div>
          </div>
          
          <div class="col-md-6 col-sm-12 py-3">
            <div class="d-flex justify-content-md-end align-items-center">
              <b-icon-trophy class="text-secondary mr-2" width="15" height="15"></b-icon-trophy>
              <p class="text-dark">{{ blog.tag_line }}</p>
            </div>
          </div>

          <hr class="mb-4">

          <div class="col-12 py-3">

              <div class="row">

                <div class="col-md-9 col-sm-12">
                  <div class="text-justify px-3">
                    <h6 class="px-4">
                      {{ blog.description }}
                    </h6>
                  </div>
                </div>

                <div class="col-md-3 col-sm-12 my-auto">
                  <div class="text-center position-relative p-sm-4 p-md-0">
                    <img :src="blog.title_image" alt="" class="img-fluid rounded">
                    <a class="position-absolute bottom-0 end-0">
                    <img src="img/fav.png" class="p-2" width="40" alt="">
                    </a>
                  </div>
                </div>

              </div>

          </div>

          <div class="col-12 py-4">

            <div class="rounded">
                
              <div class="row p-3 bg-light">

                <h5 class="text-dark1 text-center p-3">Image Gallary</h5>

                <div class="col-md-4 col-sm-12 position-relative" v-for="(img,j) in blog.images" :key="j">
                  <img :src="img.image" class="img-fluid rounded image-cus bg-white m-3" alt="">
                  <a class="position-r">
                  <img src="img/fav.png" class="p-2" width="45" alt="">
                  </a>
                </div>
                
                <div class="col-md-4 col-sm-12 p-3 my-auto">
                  <div class="text-center">
                    <a @click="handleShowPreview()" class="btn btn-dark1 text-white px-2 fw-bold"><b-icon-eye class="d-inline my-auto mr-2 text-success" width="18" height="18"></b-icon-eye> View All Images</a>
                  </div>
                </div>

              </div>
                
            </div>

          </div>

        </div>
      </div>

    </span> 

    <div class="container-fluid bg-color-hotel" v-if="hotelList != ''">
      <div class="w-70px py-5 mx-auto px-0">

        <div class="d-flex flex-row aling-items-center justify-content-start py-2" v-for="(blog,i) in blogs" :key="i">
          <b-icon-back class="icon2-color mr-2 my-auto" width="20" height="20"></b-icon-back>
          <h4 class="text-dark1 text-center my-auto">Top Hotels in {{ blog.blog_title }}</h4>
        </div>
        <hr class="mb-4">

        <div class="row m-0 p-0">
              
          <div class="col-lg-3 col-md-6 col-sm-12 my-2 position-relative" v-for="(data,i) in hotelList" :key="i">

            <span v-if="data.floor_no" class="zIndex px-2 py-1">{{ data.floor_no }}</span>

            <div class="p-0 m-0 d-flex  position-relative img-main-div bg-white overflow-hidden">
                <img :src="data.titleImage" alt="Avatar" class="image img-fluid">
                <div class="middle">
                  <a :href="'/hotel-info?id=' + data.id" target="_blank" class="btn btn-dark1 fw-bolder text-white"><b-icon-eye class="d-inline text-light mr-2" width="18" height="18"></b-icon-eye>See Hotels</a>
                </div>
                <h6 v-if="data.constraction_year"><small class="aling-middle px-2 py-1 bg-dark-location2 fw-bolder"><b-icon-gift class="d-inline text-danger mr-2" width="17" height="17"></b-icon-gift>{{ data.constraction_year }}</small></h6>
                <h6><small class="aling-middle px-2 py-1 bg-dark-location fw-bolder position-absolute bottom-0 end-0"><b-icon-geo-alt class="d-inline text-primary mr-2" width="17" height="17"></b-icon-geo-alt>{{ data.city }}</small></h6>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 w-100 col-sec  text-dark">
              <h5 class="fw-bold mb-2 aling-middle"><b-icon-house-heart-fill class="d-inline text-success mr-2" width="25" height="25"></b-icon-house-heart-fill>{{ data.name }}</h5>
              <div class="d-flex justify-content-between aling-items-center mb-1" v-for="(r,i) in data.rent" :key="i">
              <p class="ml-2  p-2" v-if="i == 0">Starting from<span class="fw-bold ml-2">৳ {{ r.offerDiscpuntPrice }}</span>/night</p> 
              <p class="fw-bold text-success float-end p-2 container-main bg-col" v-if="i == 0">{{ r.rdiscount}}% OFF </p>
              </div>
            </div>

          </div>

          <div class="text-center mt-4">
              <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="getBlogHotel" />
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
        hotelList:[],
        blogs: [],
        isLoading: true,  
        total:5,
        pageInfo: null,
        urlList:[],
      }
  },

  methods: {

    async handleShowPreview() {

      const res = await this.callApi("get",`home/getBlogImage?id=${this.$route.query.str}`);
      if (res.status == 200) {

      const objectArray = Object.entries(res.data);
      objectArray.forEach(([key, value]) => {
          this.urlList.push(value['image']); 
      });

      this.$ImagePreview.show({
          previewList: this.urlList,
          infinite: true,
          toolbar : ['zoomIn', 'zoomOut', 'rotateLeft', 'rotateRight'],
          lazy : true
      });
      console.log(res.data)
      //console.log(this.urlList)
      } else {
      this.errorMsg();
      }

    },

    async getBlog() {
      const res = await this.callApi("get",`/home/blog-info?id=${this.$route.query.str}`);
      if (res.status == 200) {
        this.blogs = res.data; 
        //console.log(this.blogs);
        //console.log(res.data);
        //console.log(this.searchdData);
        //console.log(this.$store.state.searchedData.hotel);
        //this.hotel =  this.$store.state.property;
      } else {
        this.errorMsg();
      }

    },

    async getBlogHotel(page){
      const res = await this.callApi("get",`home/getBlogHotel?str=${this.$route.query.tag}&total=${this.total}&page=${page}`);
      if (res.status == 200) {
        this.hotelList = res.data.data;
        this.pageInfo = res.data;
        //console.log(this.hotelList)
      } else {
        this.errorMsg();
      }
    },
              
  },

  created(){
   this.getBlogHotel();
   this.getBlog();
   setTimeout(() => {
      this.isLoading = false;
    }, 1000); 
  }

}
</script>

<style scoped>

.position-r{
  position: absolute;
  top: 15px;
  right: 0;
}
.image-cus:hover{
  transform: scale(1.02);
  transition: transform .5s;
}
.w-70px{
  width: 85vw !important;
  margin-left: auto;
  margin-right: auto;
}
.main {
  height: 300px;
  background-color: #2d1300;
  background-image: repeating-radial-gradient( circle at 0 0, transparent 0, #00000098 4px ), repeating-linear-gradient( #271201, #006a158e,#000000d5 );
}
.bg-color-hotel {
  background-color: #F1F4F7;
}
.icon2-color{
  color: #006d94;
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

.image {
  opacity: 1;
  display: block;
  transition: .7s ease;
  backface-visibility: hidden;
  margin-left: auto;
  margin-right: auto; 
}
.img-main-div{
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
.col-sec{
  padding: 15px 8px;
 /* background: #bfe1db35; */
  border: 1px solid rgb(209, 209, 209);
  border-bottom-right-radius: 10px;
  border-bottom-left-radius: 10px;
  background: #141414;  /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #E2E2E2, #c9e2ff);  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #fff4dd, #b0dae9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}
</style>