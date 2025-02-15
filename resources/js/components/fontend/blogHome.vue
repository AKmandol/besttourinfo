<template>

    <div class="bg-white height-cus">
  
      <div v-if="isLoading" class="preloader">
          <div class="spinner"></div>
      </div>

      <div class="container-fluid main position-relative mt-50">

        <div class="row">
            <div class="col-12 position-absolute top-50 start-50 translate-middle">
                <div class="d-flex justify-content-center aling-items-center">
                    <h1 class="text-white fw-bold display-1 shadow-sm p-2 rounded bg1 text-center">Travel News <sub class="fw-bold text-size">Around the world</sub></h1> <br>
                </div>
            </div>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white shadow border-bottom rounded position-absolute top-100 start-50 translate-middle">
              <div class="d-flex justify-content-center aling-items-center p-2">
                  <router-link to="/" class="nav-link bg-white border shadow rounded">
                      <b-icon-grid-fill class="d-inline nav-icon" width="15" height="15"></b-icon-grid-fill>
                      <span class="d-inline ml-2 text-dark fw-bold mr-2">Home</span>
                  </router-link>
                  <span class="text-secondary my-auto mx-sm-2 mx-md-4"><b-icon-arrow-bar-left class="d-inline nav-icon" width="25" height="25"></b-icon-arrow-bar-left></span>
                  <router-link to="/posts" class="nav-link bg-white border shadow rounded">
                      <b-icon-newspaper class="d-inline nav-icon" width="15" height="15"></b-icon-newspaper>
                      <span class="d-inline text-dark fw-bold ml-2">Posts</span>
                  </router-link>
              </div>
          </div>
        </div>

      </div>
      
      <div class="container-fluid bg-white mt-5 p-0">
      <div class="w-70px">
        <div class="row py-4">

          <div class="col-md-3 col-sm-12 pb-3 my-auto">
            <div class="d-flex justify-content-start align-items-center">
              <b-icon-chevron-double-down class="icon2-color mr-2" width="15" height="15"></b-icon-chevron-double-down>
              <h6 class="text-dark1 fw-bold">Locations</h6>
            </div>
          </div>

          <div class="col-md-9 d-none d-md-block col-sm-12 pb-3 my-auto">
            <div class="d-flex justify-content-center align-items-center">
              <b-icon-postcard-heart-fill class="text-info mr-2" width="30" height="30"></b-icon-postcard-heart-fill>
              <h3 class="text-dark1 fw-bold">Recent Blog Post</h3>
            </div>
          </div>

          <hr class="m-p-0">

          <div class="col-12 m-p-0">

              <div class="row">

                <div class="col-lg-3 col-md-4 col-sm-12 bg-cus">

                  <div class="pr-2">
                    <div class="d-flex flex-column" v-for="(cat,i) in blogCategory" :key="i">
                        <a @click="getCategoryBlog(cat,i)" class="catMain">
                          <img src="img/icon/google-maps.png" class="mr-2" width="18" alt="catiCON">{{ cat.category }}
                        </a>
                    </div>
                  </div>

                  <div class="d-flex flex-column text-start mt-4">
                    <p class="text-dark1 fw-bold mb-2"><b-icon-three-dots class="text-secondary mr-2 d-inline" width="15" height="15"></b-icon-three-dots>Browse Country</p>
                    <div class="d-flex flex-column" v-for="(cat,i) in blogCountry" :key="i">
                        <a @click="getCountryBlog(cat,i)" class="catMain">
                          <img src="img/icon/map.png" class="mr-2" width="18" alt="catiCON">{{ cat.tag_line }}
                        </a>
                    </div>
                  </div>

                </div>

                <div class="col-lg-9 col-md-8 col-sm-12">
                  

                    <div class="row" v-if="blogList != ''">

                      <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 p-3" v-for="(blog,i) in blogList" :Key="i">
                        
                        <!-- <div class="row g-0 rounded-cus overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            
                            <div class="col p-4 d-flex flex-column position-static">

                              <span class="d-block d-lg-flex justify-content-between">
                                <div class="text-dark1 my-2"><img src="img/icon/google-maps.png" class="mr-2" width="18" alt="catiCON">{{ blog.title_image }}</div>
                                <div class="text-dark1 my-2"><img src="img/icon/map.png" class="mr-2" width="18" alt="catiCON">{{ blog.tag_line }}</div>
                              </span>

                              <div class="d-flex mb-3 mt-3">
                                <img src="img/icon/banner.png" class="mr-2" width="15" alt="catiCON">
                                <h6 class="ml-2 text text-dark text-start my-auto">{{ blog.blog_title }}</h6>
                              </div>

                              
                              <p v-if="isExpanded" class="card-text mb-auto" v-html="blog.description"></p>
                                <p v-else class="truncate" v-html="blog.description">
                                </p>
                              <a class="mt-2" @click="info(blog,i)">Continue Reading...</a>

                            </div>

                            <div class="col-auto position-relative" v-for="(img,j) in blog.images" :key="j">

                              <img class="bd-placeholder-img" v-if="j==0" :src="img.image" width="200" height="263"  />

                              <a class="btn btn-sm position-absolute top-0 end-0 bg-light p-2" target="_blank" :href="'/social/share/blog?id=' + blog.id" >
                                  <img src="img/icon/shared.png" width="20" alt="share">
                              </a>

                            </div>

                        </div> -->
                      
                        <div class="card1 mx-auto div-hover">
                          
                          <div class="card__header" v-for="(img,j) in blog.images" :key="j">
                            <img v-if="j==0" :src="img.image" alt="card__image" class="card__image" width="600">
                          </div>
                          
                          <div class="card__body">
                            <span class="tag tag-blue">{{ blog.title_image }}</span>
                            <h4>{{ blog.blog_title }}</h4>
                            <p class="truncate" v-html="blog.description"></p>
                            <a class="mt-2" @click="info(blog,i)">Continue Reading...</a>
                          </div>

                          <div class="card__footer">
                            <div class="user">
                              <img src="img/icon/map.png" alt="user__image" class="user__image">
                              <div class="user__info">
                                <h6>{{ blog.tag_line }}</h6>
                                <small>  -- {{ blog.title_image }}</small>
                              </div>
                            </div>
                          </div>

                        </div>
                      
                      </div>

                      <div class="text-center mt-2 mb-4">
                        <Page :total="pageInfo2.total" :current="pageInfo2.current_page" :page-size="parseInt(pageInfo2.per_page)" v-if="this.blogList != ''" @on-change="getBlog" />
                      </div>

                    </div>  

                    <div class="row" v-else>
                      <div class="col-6 mx-auto my-auto">
                        <h5 class="text-center text-dark1 py-3 px-4 mt-4 rounded shadow">No Post Found</h5>
                      </div>
                    </div>

                </div>

              </div>

          </div>

        </div>
      </div>

      </div>
  
      <div class="container-fluid bg-color-hotel" v-if="hotelList != ''">
        <div class="container py-5 mx-auto px-0">
  
          <div class="d-flex flex-row aling-items-center justify-content-start py-2">
            <b-icon-textarea class="text-info mr-2 my-auto" width="25" height="25"></b-icon-textarea>
            <h4 class="text-dark1 text-center my-auto">Nearby Stays</h4>
          </div>
          <hr class="mb-4">
  
          <div class="row">
                
            <div class="col-lg-3 col-md-6 col-sm-12 my-2 position-relative" v-for="(data,i) in hotelList" :key="i">
  
              <span v-if="data.floor_no" class="zIndex px-2 py-1">{{ data.floor_no }}</span>
  
              <div class="d-flex position-relative img-main-div bg-white overflow-hidden div-hover">
                  <img :src="data.titleImage" alt="Avatar" class="image img-fluid">
                  <div class="middle">
                    <a :href="'/hotel-info?id=' + data.id" target="_blank" class="btn btn-dark1 fw-bolder text-white"><b-icon-eye class="d-inline text-light mr-2" width="18" height="18"></b-icon-eye>Details</a>
                  </div>
                  <h6 v-if="data.constraction_year"><small class="aling-middle px-2 py-1 bg-dark-location2 fw-bolder"><b-icon-gift class="d-inline text-danger mr-2" width="17" height="17"></b-icon-gift>{{ data.constraction_year }}</small></h6>
                  <h6><small class="aling-middle px-2 py-1 bg-dark-location fw-bolder position-absolute bottom-0 end-0"><b-icon-geo-alt class="d-inline text-primary mr-2" width="17" height="17"></b-icon-geo-alt>{{ data.city }}</small></h6>
              </div>
  
              <div class="col-lg-4 col-md-6 col-sm-12 w-100 col-sec text-dark">
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
                <Page :total="pageInfo.total" :current="pageInfo.current_page" :page-size="parseInt(pageInfo.per_page)" @on-change="getHotes" />
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
        blogCategory: [],
        blogCountry: [],
        isLoading: true,  
        blogList: [],
        total2:6,
        total:4,
        pageInfo: null,
        pageInfo2: null,
        urlList:[],
        isExpanded: false
    }
},

methods: {

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

    info(blog,i) {
      window.location = `/blogs?str=${blog.id}&cat=${blog.title_image}`;
    },

    async getCategoryBlog(cat,i,page) {
      const res = await this.callApi("get",`/cattegory/all?total=${this.total2}&page=${page}&str=${cat.category}`);
      this.isLoading = true;
      if (res.status == 200) {
          setTimeout(() => {
            this.blogList = res.data.data;
            this.pageInfo2 = res.data;
            this.isLoading = false;
            //console.log(this.$route.query.category)
          }, 400); 
          
          //console.log(this.blogList)
      } else {
          this.errorMsg();
      }
    },

    async getCountryBlog(cat,i,page) {
      const res = await this.callApi("get",`/country/all?total=${this.total2}&page=${page}&str=${cat.tag_line}`);
      this.isLoading = true;
      if (res.status == 200) {
          setTimeout(() => {
            this.blogList = res.data.data;
            this.pageInfo2 = res.data;
            this.isLoading = false;
          }, 400); 
          
          //console.log(this.blogList)
      } else {
          this.errorMsg();
      }
    },

    async getBlog(page) {
      this.isLoading = true;
      if(this.$route.query.category == null){
        const res = await this.callApi("get",`/blog/all?total=${this.total2}&page=${page}`);
        if (res.status == 200) {
            this.blogList = res.data.data;
            this.pageInfo2 = res.data;
            //console.log(this.blogList)
            this.pageInfo = res.data;
            setTimeout(() => {
            this.isLoading = false;
            }, 300);
        } else {
            this.errorMsg();
        }
      }else {
        const res = await this.callApi("get",`/blog/all/category?total=${this.total2}&page=${page}&category=${this.$route.query.category}`);
        if (res.status == 200) {
            this.blogList = res.data.data;
            this.pageInfo2 = res.data;
            //console.log(this.blogList)
            //console.log(this.$route.query.category)
        } else {
            this.errorMsg();
        }
      }
    },

    async getHotes(page){
        this.isLoading = true;
        const res = await this.callApi("get",`/home/getALLHotel?str=${this.$route.query.cat}&total=${this.total}&page=${page}`);
        if (res.status == 200) {
            this.hotelList = res.data.data;
            this.pageInfo = res.data;
            //console.log(this.hotelList)
            setTimeout(() => {
            this.isLoading = false;
            }, 300);
        } else {
            this.errorMsg();
        }
    },

    async getCategory(){
        const res = await this.callApi("get", "blog/getCategoryAll");
        if (res.status == 200) {
            this.blogCategory = res.data;
            //zconsole.log(this.blogCategory)
        } else {
            this.errorMsg();
        } 
    },

    async getCountry(){
        const res = await this.callApi("get", "blog/getCountryAll");
        if (res.status == 200) {
            this.blogCountry = res.data;
            //console.log(this.blogCountry)
        } else {
            this.errorMsg();
        } 
    },
             
},

created(){
    this.getHotes();
    this.getBlog();
    this.getCategory();
    this.getCountry();
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
.card__image {
  height: 250px;
  max-width: 100%;
  display: block;
  object-fit: cover;
}
.card1 {
  display: flex;
  flex-direction: column;
  overflow: hidden;
  box-shadow: 0 .1rem 1rem rgba(0, 0, 0, 0.288);
  border-radius: 1em;
  background: #000000;
  background: linear-gradient(to right, #ffffff3f, #d4fafda6);
}

.card1:hover {
  background: linear-gradient(to right, #ffffffd6, #ffffff);
  scale: 1;
}
.card__body {
  padding: 1rem;
  display: flex;
  flex-direction: column;
  gap: .5rem;
}
.tag {
  align-self: flex-start;
  padding: .5em .6em;
  border-radius: .5em;
  font-size: .85rem;
}
.tag-blue {
  background: #e7761a;
  background: linear-gradient(to bottom, #000000, #01682a);
  color: #fafafa;
}
.card__body h4 {
  font-size: 1.5rem;
  text-transform: capitalize;
  color: #000;
  padding: 7px 0;
}
.card__footer {
  display: flex;
  padding: 0 1rem 1rem 1.5rem;
  margin-top: auto;
}
.user {
  display: flex;
  gap: .5rem;
  color: #000000;
}
.user__image {
  border-radius: 50%;
  width: 30px;
  height: 30px;
}
.user__info > small {
  color: #666;
}
   
.rounded-cus {
  border-top-left-radius: 15px !important;
  border-top-right-radius: 15px !important;
  border: .5px solid rgba(58, 122, 2, 0.178);
}
.truncate {
  height: 80px;
  overflow: hidden;
}
.city_image{
  width: 100px;
  height: 100px;
  border-radius: 10px;
}

.text {
  width: 100%;
  font-weight: bold;
  font-size: 18px;
}

.text-size {
  font-size: 30px;
  color: #5fff37;
}

.bg1{
    background: #1e660142;
    border-bottom: 5px solid rgb(0, 79, 0);
}
.catMain{
  margin: 3px;
  padding: 3px 15px !important;
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
margin-top: 70px !important;
}
.main {
height: 350px;
background-color: #022e01;
background-image: url("/img/bg/blog.png");
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
height: 130px;
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