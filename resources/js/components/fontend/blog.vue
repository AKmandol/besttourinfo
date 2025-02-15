<template>

    <div class="bg-white height-cus">
  
      <div v-if="isLoading" class="preloader">
          <div class="spinner"></div>
      </div>
    
      <span v-for="(blog,i) in blogs" :key="i">
  
        <div class="container-fluid main position-relative mt-50 p-0">
  
          <div class="row">
              <div class="col-12 position-absolute top-50 start-50 translate-middle">
                  <div class="d-flex justify-content-center aling-items-center">
                      <h1 class="text-dark fw-bold display-4">{{ blog.blog_title }}</h1>
                  </div>
              </div>
          </div>
  
        </div>
       
       <div class="container-fluid bg-light">
        <div class="w-70px">
          <div class="row py-4">
  
            <div class="col-md-3 col-sm-12 pb-3 my-auto">
              <div class="d-flex justify-content-start align-items-center">
                <b-icon-chevron-double-down class="icon2-color mr-2" width="30"></b-icon-chevron-double-down>
                <h6 class="text-dark1 fw-bold">Locations</h6>
              </div>
            </div>

            <hr class="m-p-0">
  
            <div class="col-12 m-p-0">
  
                <div class="row">
  
                  <div class="col-md-3 col-sm-12 bg-cus">
                    <div class="text-justify pr-2 data">
                      <div class="d-flex flex-column" v-for="(cat,i) in blogCategory" :key="i">
              
                        <a @click="info(cat,i)"  class="catMain">
                          <img src="/img/icon/google-maps.png" class="mr-2 " width="35" alt="catiCON">{{ cat.category }}
                        </a>
                      
                      </div>
                    </div>

                    <div class="mt-4">
                      <div class="d-flex justify-content-start align-items-center">
                        <p class="text-dark">Related Post</p>
                        <b-icon-chevron-double-down class="text-success ml-2" width="30"></b-icon-chevron-double-down>
                      </div>

                      <div class="text-center bg-white my-2 rounded p-2" v-if="catBlog.length > 1 ">
                        <div @click="getNew(cat,i)" class="d-flex div-hover cursor-pointer p-1" v-for="(cat,i) in catBlog" :key="i">
                
                          <a class="text-start text-dark1 my-auto">
                            
                            <span class="col-3" v-for="(img,i) in cat.images" :key="i" v-if="cat.blog_title != blog.blog_title">
                              <img v-if="i == 0" :src="img.image" class="rounded mr-2" height="22" alt="">
                            </span>
                            
                          </a>
                          <h6 v-if="cat.blog_title != blog.blog_title"  class="my-auto text-start text-dark fw-bold">{{ cat.blog_title }}</h6>

                        </div>
                      </div>

                      <div v-else class="pb-4 pt-2">
                        <p class="text-center fw-bold text-dark">No Related Blog Found</p>
                      </div>

                    </div>



                  </div>


                  <div class="col-md-9 col-sm-12">
                    <div class="d-flex justify-content-start align-items-center mt-3 p-0 p-md-2">
                      <img src="img/icon/banner.png" class="m-2" width="25" alt="catiCON">
                      <h4 class="text-dark1 fw-bold w-100">{{ blog.blog_title }}</h4>
                    </div>
                    <div class="bg-light rounded pt-3 text-justify data">
                      <h6 class="pr-2 text-dark p-0 p-md-2" v-html="blog.description">
                        
                      </h6>
                    </div>
                  </div>

                </div>
  
            </div>
  
            <div class="bg-light px-0 py-4">
  
              <div class="container-fluid p-0">
                  
                <div class="row p-0">
  
                  <div class="col-md-4 col-sm-12 py-3 text-center" v-for="(img,j) in blog.images" :key="j">
                    <img :src="img.image" class="img-fluid rounded image-cus bg-white" alt="">
                  </div>
                  
                  <div class="col-12 p-3 my-auto">
                    <div class="text-center">
                      <a @click="handleShowPreview()" class="btn btn-dark1 text-white px-2 fw-bold"><b-icon-eye class="d-inline my-auto mr-2 text-success" width="18" height="18"></b-icon-eye> View All {{ blog.images.length }} Images</a>
                    </div>
                  </div>
  
                </div>
                  
              </div>
  
            </div>
  
          </div>
        </div>

       </div> 
  
      </span> 
  
      <div class="container-fluid bg-color-hotel" v-if="hotelList != ''">
        <div class="container py-5 mx-auto px-0">
  
          <div class="d-flex flex-row aling-items-center justify-content-start py-2" v-for="(blog,i) in blogs" :key="i">
            <b-icon-back class="icon2-color mr-2 my-auto" width="20" height="20"></b-icon-back>
            <h4 class="text-dark1 text-center my-auto">Top Hotels in {{ blog.title_image }}</h4>
          </div>
          <hr class="mb-4">
  
          <div class="row m-0 p-0">
                
            <div class="col-lg-3 col-md-6 col-sm-12 my-2 position-relative" v-for="(data,i) in hotelList" :key="i">
  
              <span v-if="data.floor_no" class="zIndex px-2 py-1">{{ data.floor_no }}</span>
  
              <div class="p-0 m-0 d-flex div-hover position-relative img-main-div bg-white overflow-hidden">
                  <img :src="data.titleImage" alt="Avatar" class="image img-fluid">
                  <div class="middle">
                    <a :href="'/hotel-info?id=' + data.id" target="_blank" class="btn btn-dark1 fw-bolder text-white"><b-icon-eye class="d-inline text-light mr-2" width="18" height="18"></b-icon-eye>Details</a>
                  </div>
                  <h6 v-if="data.constraction_year"><small class="aling-middle px-2 py-1 bg-dark-location2 fw-bolder"><b-icon-gift class="d-inline text-danger mr-2" width="17" height="17"></b-icon-gift>{{ data.constraction_year }}</small></h6>
                  <h6><small class="aling-middle px-2 py-1 bg-dark-location fw-bolder position-absolute bottom-0 end-0"><b-icon-geo-alt class="d-inline text-primary mr-2" width="17" height="17"></b-icon-geo-alt>{{ data.city }}</small></h6>
              </div>
  
              <div class="col-lg-4 col-md-6 col-sm-12 w-100 col-sec  text-dark">
                <div class="d-flex justify-content-start aling-items-center mb-1 name-hotel">
                  <b-icon-house-heart-fill class="my-auto text-success mr-2" width="25" height="25"></b-icon-house-heart-fill>
                  <h6 class="fw-bold mb-2 my-auto aling-middle">{{ data.name }}</h6>
                </div>
                <div class="d-flex justify-content-between aling-items-center mb-1" v-for="(r,i) in data.rent" :key="i">
                  <p class="ml-2  p-2" v-if="i == 0">Starting from<span class="fw-bold ml-2">৳ {{ r.offerDiscpuntPrice }}</span>/night</p> 
                  <p class="fw-bold text-center float-end p-2 rounded bg-col" v-if="i == 0"><span class="text-white">{{ r.rdiscount}}%</span> OFF </p>
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
        blogCategory: [],
        catBlog: [],
        isLoading: true,  
        total:4,
        pageInfo: null,
        urlList:[],
    }
},

methods: {

    info(cat,i) {
      window.location = `/posts?category=${cat.category}`;
    },

    getNew(cat,i) {
      window.location = `/blogs?str=${cat.id}&cat=${cat.title_image}`;
    },

    async handleShowPreview() {

        if(!this.$route.query.str){
            const res = await this.callApi("get","home/getBlogImageLast");
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
            //console.log(res.data)
            //console.log(this.urlList)
            } else {
            this.errorMsg();
            }

            }else{

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
            //console.log(res.data)
            //console.log(this.urlList)
            } else {
            this.errorMsg();
            }
        }

    },

    async getBlog() {
        const res = await this.callApi("get",`/home/blog-info?id=${this.$route.query.str}`);
        if (res.status == 200) {
            this.blogs = res.data; 
            //console.log(this.blogs)
          }else{
            this.errorMsg();
        }
    },

    async getBlogHotel(page){
        const res = await this.callApi("get",`home/getBlogHotel?str=${this.$route.query.cat}&total=${this.total}&page=${page}`);
        if (res.status == 200) {
            this.hotelList = res.data.data;
            this.pageInfo = res.data;
            //console.log(this.hotelList)
        } else {
            this.errorMsg();
        }
    },

    async getCategory(){
        const res = await this.callApi("get", "blog/getCategoryAll");
        if (res.status == 200) {
            this.blogCategory = res.data;
            //console.log(this.blogCategory)
        } else {
            this.errorMsg();
        } 
    },

    async getCat(){
      const res = await this.callApi("get",`home/getCatBlog?str=${this.$route.query.cat}`);
        if (res.status == 200) {
            this.catBlog = res.data;
            //console.log(this.catBlog)
        } else {
            this.errorMsg();
        }
    },
    
            
},

created(){
    this.getBlogHotel();
    this.getBlog();
    this.getCategory();
    this.getCat();
    setTimeout(() => {
    this.isLoading = false;
    }, 500); 
}

}
</script>
  
<style scoped>
.bg-cus{
  background: linear-gradient(to right, #F1F4F7, #e5fcfda5);
  border-bottom-left-radius: 15px;
  border-bottom-right-radius: 15px;
  padding-top: 10px;
}
.name-hotel{
  height: 40px;
}
.cursor-pointer{
  cursor: pointer;
}
.catMain{
  margin: 3px;
  padding: 3px 15px;
  color: #2a2a2a;
  font-weight: bold;
  border-bottom: .5px solid rgba(0, 205, 0, 0.208);
}

.catMain:hover{
  padding: 2px 13px;
  color: #21a300;
  font-weight: bolder;
  border-bottom: 1px solid green;
}
.height-cus{
  min-height: 60vh;
}
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
width: 90% !important;
margin-left: auto !important;
margin-right: auto !important;
}
.main {
height: 350px;
background-color: #97ad0794;
background-image: url("/img/bg/dark-exa.png");
/* This is mostly intended for prototyping; please download the pattern and re-host for production environments. Thank you! */
/* This is mostly intended for prototyping; please download the pattern and re-host for production environments. Thank you! */
}
.bg-color-hotel {
background-color: #F1F4F7;
}
.icon2-color{
color: #187b9f;
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

.bg-col{
color: #ff0000 !important;
background: #ffffff;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #000000,#004d0e);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #000000,#004d0e); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}

.name-hotel{
height: 40px;
}
</style>