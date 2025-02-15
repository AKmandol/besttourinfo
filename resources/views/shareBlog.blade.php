<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BestTourInfo Social Share</title>
    <link rel="icon" href="{{ url('img/fav.png') }}">
    <base href="/public" >

    <meta property="og:url" content="{{ url()->full(); }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $blog->blog_title }}" />
    <meta property="og:description" content="{{ strip_tags(Illuminate\Support\Str::limit($blog->description)) }}"/>
    <meta property="og:image" content="{{ 'https://besttourinfo.com'.$image->image }}" />

    <meta name="twitter:title" content="{{ $blog->blog_title }}">
    <meta name="twitter:description" content="{{ strip_tags(Illuminate\Support\Str::limit($blog->description)) }}">
    <meta name="twitter:image" content="{{ 'https://besttourinfo.com'.$image->image }}">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">

    <style>

      .text-dark1{
        font-size: 14px;
        font-weight: 700;
      }

      .radio-drop{
        background-color: #ffffffef;
      }

      .rad-label {
          display: flex;
          align-items: center;
          border-radius: 100px;
          margin: 10px 0;
          cursor: pointer;
          transition: .3s;
      }

      .rad-label:hover,
      .rad-label:focus-within {
          background: hsla(139, 100%, 83%, 0.562);
      }

      .rad-input {
          position: absolute;
          left: 0;
          top: 0;
          width: 1px;
          height: 1px;
          opacity: 0;
          z-index: -1;
      }

      .rad-design {
          width: 18px;
          height: 18px;
          border-radius: 100px;
          background: linear-gradient(to right bottom, hsl(154, 97%, 62%), hsl(30, 97%, 62%));
          position: relative;
      }

      .rad-design::before {
          content: '';
          display: inline-block;
          width: inherit;
          height: inherit;
          border-radius: inherit;
          background: hsla(0, 0%, 100%, 0.941);
          transform: scale(1.1);
          transition: .3s;
      }

      .rad-input:checked+.rad-design::before {
      transform: scale(0);
      }

      .rad-text {
          color: hsl(0, 0%, 21%);
          margin-left: 14px;
          text-transform: uppercase;
          font-size: 12px;
          font-weight: 600;
          transition: .3s;
      }

      .rad-input:checked~.rad-text {
          color: hsl(0, 0%, 0%);
      }


      /* ABS */
      /* ====================================================== */
      .abs-site-link {
          position: fixed;
          bottom: 40px;
          left: 20px;
          color: hsla(0, 0%, 0%, .5);
          font-size: 16px;
      }

      /* .headerFixed{
        
      } */
      .transparent {
          background-color: #ffffff00;
      }

      .container-header {
          width: 85% !important;
          margin-left: auto;
          margin-right: auto;
          padding: 0;
          border-radius: 10px;
      }

      .button {
          color: rgb(0, 0, 0);
          padding: 5px 10px;
          border-radius: 3px;
          font-weight: 600;
      }

      .login-btn:hover {
          background: rgba(0, 0, 17, 0.379);
          color:green;

      }
      .reg-btn:hover {
          background: rgba(0, 0, 17, 0.379);
          color:green;

      }
      .nav-icon {
          color: rgb(0, 131, 22);
      }

      .nav-link {
          text-transform: uppercase;
          font-weight: 500;
          font-size: 13px;
          align-items: center;
          letter-spacing: 1.5px;
      }
      .nav-link:hover {
          background: rgba(190, 190, 190, 0.347);
          color:green !important;
          border-radius: 3px;
      }
      a.router-link-active {
          border-bottom: 2px solid rgb(0, 113, 0); 
          background: rgba(190, 190, 190, 0.347);
          border-radius: 3px;
          color:rgb(13, 108, 0) !important;
          padding: 7px 10px;
      }

      .logo-img{
          height: 60px;
          width: auto;
          margin: 0;
          padding: 0;
      }

      @media only screen and (max-width: 1200px) {
          .logo-img{
              height: 40px;
              width: auto;
          }
      }
      @media only screen and (max-width: 991px) {
          .logo-img{
              height: 60px;
              width: auto;
          }
      }
    </style>

    <style>
      .back{
        padding-top: 30px;
        padding-bottom: 30px;
        background-image: linear-gradient(to right top, #ffffff, #7fe00015, #ffffff, #bdc00812, #ffffff);
      }
    </style>
  </head>
  <body>
    
    <body>
    
      <div class="bg-light">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bolder col-2 text-start d-none d-sm-block m-0 p-0" href="/">
                        <img src="/img/logo.png" class="logo-img" alt="logo">
                    </a>
  
                    <div class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
                        <b-icon-list class="text-dark" width="40" height="30"></b-icon-list>
                    </div>
  
  
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
  
                        <ul class="navbar-nav col-11 justify-content-evenly aling-items-center my-auto">
  
                            <li class="nav-item my-auto">
                                <a href="/" class="nav-link">
                                    <img src="img/icon/home.png" alt="" class="d-inline nav-icon" width="20" height="20">
                                    <span class="d-inline ml-2 text-dark1">Home</span>
                                </a>
                            </li>
  
                            <li class="nav-item my-auto">
                                <a href="/hotel" class="nav-link">
                                    <img src="img/icon/reception.png" alt="" class="d-inline nav-icon" width="25" height="25">
                                    <span class="d-inline ml-2 text-dark1 my-auto">Hotel</span>
                                </a>
                            </li>
  
                            <!-- <li class="nav-item">
                                <a href="/flight" class="nav-link">
                                    <img src="img/icon/airplane2.png" alt="" class="d-inline nav-icon" width="25" height="25">
                                    <span class="d-inline ml-2 text-dark1 my-auto">Flights</span>
                                </a>
                            </li> -->
  
                            <li class="nav-item">
                                <a href="/car" class="nav-link">
                                    <img src="img/icon/car2.png" alt="" class="d-inline nav-icon" width="25" height="25">
                                    <span class="d-inline ml-2 text-dark1 my-auto">Cars</span>
                                </a>
                            </li>
  
                            <li class="nav-item my-auto">
                                <a href="/posts" class="nav-link">
                                    <img src="img/icon/reader.png" alt="" class="d-inline nav-icon" width="25" height="25">
                                    <span class="d-inline ml-2 text-dark1 my-auto">Blog</span>
                                </a>
                            </li>
  
  
                            <li class="nav-item my-auto dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="img/icon/joomla.png" alt="" class="d-inline nav-icon" width="17" height="17">
                                    <span class="d-inline ml-2 text-dark1 my-auto">Company</span>
                                </a>
                                
                                <ul class="dropdown-menu radio-drop">
                                    <li class="dropdown-item">
                                        <a href="/about" class="nav-link">
                                            <b-icon-trophy class="d-inline nav-icon" width="16" height="16"></b-icon-trophy>
                                            <span class="d-inline ml-2 text-dark1 my-auto rad-text">About Us</span>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="dropdown-item">
                                        <a href="/contact" class="nav-link">
                                            <b-icon-geo class="d-inline nav-icon" width="16" height="16"></b-icon-geo>
                                            <span class="d-inline ml-2 text-dark1 my-auto rad-text">Contact Us</span>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="dropdown-item">
                                        <a href="/privacy-policy" class="nav-link">
                                            <b-icon-newspaper class="d-inline nav-icon" width="16" height="16"></b-icon-newspaper>
                                            <span class="d-inline ml-2 text-dark1 my-auto rad-text">Privacy Policy</span>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="dropdown-item">
                                        <a href="/terms-and-condition" class="nav-link">
                                            <b-icon-command class="d-inline nav-icon" width="16" height="16"></b-icon-command>
                                            <span class="d-inline ml-2 text-dark1 my-auto rad-text">Terms and Conditions</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
  
                            <!-- <li class="nav-item my-auto dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img v-if="currency == 'USD'" src="img/currency/doller.png" width="25" class="p-1" alt="">
                                    <img v-else src="img/currency/tk.png" width="25" class="p-1" alt="">
                                    <span v-if="currency == 'USD'" class="d-inline ml-2 text-dark1 my-auto">USD</span>
                                    <span v-else class="d-inline ml-2 text-dark1 my-auto">BDT</span>
                                </a>
                                
                                <ul class="dropdown-menu radio-drop">
                                    <li class="dropdown-item">
                                        <label class="rad-label">
                                            <input @change="currencyValue" v-model="currency" value="USD" type="radio" class="rad-input" name="rad">
                                            <div class="rad-design"></div>
                                            <div class="rad-text">USD</div>
                                        </label>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="dropdown-item">
                                        <label class="rad-label">
                                            <input @change="currencyValue" v-model="currency" value="BDT" type="radio" class="rad-input" name="rad">
                                            <div class="rad-design"></div>
                                            <div class="rad-text">BDT</div>
                                        </label>
                                    </li>
                                </ul>
                            </li> -->
                                                        
                        </ul>
                        
                        
  
                        {{-- <li class="nav-item my-auto dropdown d-flex ms-auto" v-show ="this.$store.state.client == 'true'">
                            <a class="nav-link dropdown-toggle p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img :src="this.$store.state.client.image" v-if="this.$store.state.client.image" class="text-dark border p-1 rounded-circle text-dark bg-seconary" width="30" height="30" />
                                <img src="img/fav.png" v-else class="text-dark border p-1 rounded-circle text-dark bg-seconary" width="35" height="35" />
                                <span class="d-inline text-dark1 my-auto">{{ this.$store.state.client.name }}</span>
                            </a>
                            
                            <ul class="dropdown-menu" v-if="this.$store.state.client.name">
                                <li class="dropdown-item"  v-if="this.$store.state.client.userType == 'user'">
                                    <a href="/profile" class="nav-link">
                                        <b-icon-person-bounding-box class="d-inline nav-icon" width="18" height="18"></b-icon-person-bounding-box>
                                        <span class="d-inline ml-2 text-dark1 my-auto">Profile</span>
                                    </a>
                                </li>
                                <li class="dropdown-item"  v-else>
                                    <a href="/dashboard" class="nav-link">
                                        <b-icon-speedometer2 class="d-inline nav-icon" width="18" height="18"></b-icon-speedometer2>
                                        <span class="d-inline ml-2 text-dark1 my-auto">Admin Dashboard</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="dropdown-item">
                                    <a href="/app/user_logout" class="nav-link">
                                        <b-icon-box-arrow-in-left class="d-inline text-danger" width="18" height="18"></b-icon-box-arrow-in-left>
                                        <span class="d-inline ml-2 text-dark1 my-auto">Logout</span>
                                    </a>
                                </li>
                            </ul>
  
                            <ul class="dropdown-menu" v-else>
                                <li class="dropdown-item">
                                    <a href="/user-login" class="nav-link">
                                        <b-icon-box-arrow-in-right class="d-inline nav-icon" width="18" height="18"></b-icon-box-arrow-in-right>
                                        <span class="d-inline ml-2 text-dark1 my-auto">Login</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="dropdown-item">
                                    <a href="/register" class="nav-link">
                                        <b-icon-ui-checks class="d-inline nav-icon" width="18" height="18"></b-icon-ui-checks>
                                        <span class="d-inline ml-2 text-dark1 my-auto">Resister</span>
                                    </a>
                                </li>
                            </ul>
  
                        </li> --}}
  
                    </div>
                </div>
            </nav>
        
        </div>
      </div>
  
      <p class="text-center text-dark mt-3">Copy the link from URL and share on your social platfrom like, <span class="fw-bold text-primary">Facebook</span> ,<span class="fw-bold text-info">Twitter ,</span> <span class="fw-bold text-warning">Linkeden</span>.</p>
  
  
      <div class="container-fluid p-0 m-0 overflow-hidden">
  
        <div class="container-fluid back shadow">
          <div class="d-flex justify-content-around align-items-center">
            <h1 class="fw-bold display-6">{{ $blog->blog_title }}</h1>
            <a class="fw-bold align-middle btn btn-outline-success" href="{{ 'https://besttourinfo.com/blogs?str='.$blog->id.'&cat='.$blog->title_image }}">See Full Details</a>
          </div>
        </div>
  
        <div class="row">
          @foreach($blog->images as $img)
          <div class="col-md-4">
            
              <img class="img-fluid p-3 rounded" src="{{ $img->image }}" alt="">
           
          </div>
          @endforeach
        </div>
  
      </div>
  
      <div class="bg-light text-center py-3 border-top">
        <h6 class="text-dark"><span class="text-success fw-bold">BestTourInfo</span>, Inc. All rights reserved.</h6>
      </div>
  
      
      <script src="{{asset('/bootstrap/bootstrap.bundle.min.js')}}"></script> 
    </body>
   
  </body>
</html>