import { createRouter, createWebHistory } from 'vue-router';

import HomePage from './components/fontend/homePage.vue'
import AboutPage from './components/fontend/about.vue'
import ContactPage from './components/fontend/contact.vue'
import HotelPage from './components/fontend/hotel.vue'
import FlightPage from './components/fontend/flight.vue'
import CarPage from './components/fontend/car.vue'
import singleHotel from './components/fontend/singleHotel.vue'
import Privacy from './components/fontend/privacyPolicy.vue'
import ReFund from './components/fontend/refund.vue'
import Terms from './components/fontend/terms.vue'
import HotelInfo from './components/fontend/hotelInfo.vue'
import Information from './components/fontend/info.vue'
import Blogs from './components/fontend/blog.vue'
import BlogHome from './components/fontend/blogHome.vue'
import Cart from './components/fontend/cart.vue'


import AdminLogin from './components/backend/admin/adminLogin.vue'
import adminDash from './components/backend/admin/dashboard.vue'
import AddHotel from './components/backend/hotel/addHotel.vue'
import Hotel from './components/backend/hotel/hotel.vue'
import Order from './components/backend/hotel/booking.vue'
import EditOrder from './components/backend/hotel/editBooking.vue'
import Subs from './components/backend/hotel/subscriber.vue'
import TopADS from './components/backend/hotel/topAds.vue'
import MultipleAds from './components/backend/hotel/multipleAds.vue'
import Blog from './components/backend/hotel/blog.vue'
import AddBlog from './components/backend/hotel/addBolg.vue'
import AddBlogCategory from './components/backend/hotel/addBlogCategory.vue'
import BlogCategory from './components/backend/hotel/category.vue'
import Vat from './components/backend/vat.vue'
import SendEmail from './components/backend/sendEmail.vue'
import LoginRecord from './components/backend/loginRecord.vue'
import EmailLog from './components/backend/emialLog.vue'
import Print from './components/backend/car/ptintCar.vue'
import PrintH from './components/backend/hotel/ptintHotel.vue'


import AllAdmin from './components/backend/admin/allAdmin.vue'
import AllUser from './components/backend/admin/allUser.vue'
import AllEditor from './components/backend/admin/allEditor.vue'
import AddEditor from './components/backend/admin/addEditor.vue'
import Admin from './components/backend/admin/admin.vue'


import CarType from './components/backend/car/carType.vue'
import Driver from './components/backend/car/driver.vue'
import Destination from './components/backend/car/destination.vue'
import CarRent from './components/backend/car/carRent.vue'
import AssignDriver from './components/backend/car/assignDriver.vue'


import LoginUser from './components/backend/user/login.vue'
import RegisterUser from './components/backend/user/register.vue'
import ProfilePage from './components/backend/user/profile.vue'
import BackAbout from './components/backend/home/about.vue'
import BackFaq from './components/backend/home/faq.vue'
import BackPrivacy from './components/backend/home/privacy.vue'
import BackReFund from './components/backend/home/refund.vue'
import BackTandC from './components/backend/home/tandc.vue'

import OrderConfirmation from './components/fontend/OrderConfirmation.vue'
import OrderConfirmationF from './components/fontend/OrderConfirmationfail.vue'

const routes = [

  {
    path: '/print-hotel', 
    name: 'PrintH',
    component: PrintH, 
  },

  {
    path: '/print-car', 
    name: 'Print',
    component: Print, 
  },

  {
    path: '/send-email', 
    name: 'SendEmail',
    component: SendEmail, 
  },

  {
    path: '/login-record', 
    name: 'LoginRecord',
    component: LoginRecord, 
  },

  {
    path: '/email-log', 
    name: 'EmailLog',
    component: EmailLog, 
  },

  {
    path: '/vat-tax', 
    name: 'VatTax',
    component: Vat, 
  },

  {
    path: '/vat-tax', 
    name: 'VatTax',
    component: Vat, 
  },

  {
    path: '/vat-tax', 
    name: 'VatTax',
    component: Vat, 
  },

  {
    path: '/cars-list', 
    name: 'AllCarType',
    component: CarType, 
  },
  {
    path: '/driver', 
    name: 'Driver',
    component: Driver, 
  },
  {
    path: '/destination', 
    name: 'Destination',
    component: Destination, 
  },
  {
    path: '/cars-rent', 
    name: 'Car Rent',
    component: CarRent, 
  },
  {
    path: '/assign-driver', 
    name: 'Assign Driver',
    component: AssignDriver, 
  },

  {
    path: '/about-us', 
    name: 'AboutUs',
    component: BackAbout, 
  },
  {
    path: '/faq', 
    name: 'FAQ',
    component: BackFaq,
  },
  {
    path: '/privacy-policys', 
    name: 'Back-Privacy',
    component: BackPrivacy 
  },
  { 
    path: '/refund-policy', 
    name: '/Refund',
    component: BackReFund 
  },
  {
    path: '/t-n-c', 
    name: 'T-N-C',
    component: BackTandC 
  },
 
  { 
    path: '/admin-info', 
    name: 'Admin',
    component: Admin 
  },
  { 
    path: '/all-admin', 
    name: 'All-Admin',
    component: AllAdmin 
  },
  { 
    path: '/all-user', 
    name: 'All-User',
    component: AllUser 
  },
  { 
    path: '/all-editor', 
    name: 'All-Editor',
    component: AllEditor 
  },
 
  { 
    path: '/add-editor', 
    name: 'Add-Editor',
    component: AddEditor 
  },








 
  { 
    path: '/', 
    name: 'HomePage',
    component: HomePage ,
    meta: {
      title: "BestTourInfo - Home",
      metaTags: []
    }
  },

  { 
    path: '/order-confirmation', 
    name: 'Order-Confirmation',
    component: OrderConfirmation,
    meta: {
      title: "BestTourInfo - Order",
      metaTags: []
    }
  },

  { 
    path: '/order-failed', 
    name: 'Order-failed',
    component: OrderConfirmationF,
    meta: {
      title: "BestTourInfo - Order",
      metaTags: []
    }
  },

  { 
    path: '/success', 
    name: 'Order-ConfirmationS',
    component: OrderConfirmation,
    meta: {
      title: "BestTourInfo - Order",
      metaTags: []
    }
  },
  { 
    path: '/fail', 
    name: 'Order-failedF',
    component: OrderConfirmationF,
    meta: {
      title: "BestTourInfo - Order",
      metaTags: []
    }
  },


  { 
    path: '/about', 
    name: '/about',
    component: AboutPage,
    meta: {
      title: "BestTourInfo - About Us",
      metaTags: []
    } 
  },
  { 
    path: '/contact', 
    name: '/contact',
    component: ContactPage,
    meta: {
      title: "BestTourInfo - Contact Us",
      metaTags: []
    } 
  },
  { 
    path: '/hotel', 
    name: '/hotel',
    component: HotelPage,
    meta: {
      title: "BestTourInfo - Hotels",
      metaTags: []
    } 
  },
  { 
    path: '/flight', 
    name: '/flight',
    component: FlightPage,
    meta: {
      title: "BestTourInfo - Fights",
      metaTags: []
    } 
  },
  { 
    path: '/car', 
    name: '/car',
    component: CarPage,
    meta: {
      title: "BestTourInfo - Cars",
      metaTags: []
    } 
  },
 
  { 
    path: '/refund-policies', 
    name: '/Refunds',
    component: ReFund,
    meta: {
      title: "BestTourInfo - Refund Policies",
      metaTags: []
    } 
  },
  { 
    path: '/privacy-policy', 
    name: '/PrivacyPolicy',
    component: Privacy,
    meta: {
      title: "BestTourInfo - Privacy Policy",
      metaTags: []
    } 
  },
  { 
    path: '/terms-and-condition', 
    name: 'Trmas',
    component: Terms,
    meta: {
      title: "BestTourInfo - Terms and Condition",
      metaTags: []
    } 
  },
  { 
    path: '/info', 
    name: 'Info',
    component: Information,
    meta: {
      title: "BestTourInfo - Info",
      metaTags: []
    } 
  },
  { 
    path: '/blogs', 
    name: 'Blogs-news',
    component: Blogs,
    meta: {
      title: "BestTourInfo - Blog Post",
      metaTags: []
    }  
  },

  { 
    path: '/posts', 
    name: 'Blogs-Home',
    component: BlogHome,
    meta: {
      title: "BestTourInfo - Blog",
      metaTags: []
    } 
  },

  { 
    path: '/hotel-booking', 
    name: 'Cart-Home',
    component: Cart,
    meta: {
      title: "BestTourInfo - Booking",
      metaTags: []
    } 
  },

  { 
    path: '/user-login', 
    name: '/user-login',
    component: LoginUser,
    meta: {
      title: "BestTourInfo - Login User",
      metaTags: []
    } 
  },
  { 
    path: '/register', 
    name: '/register',
    component: RegisterUser,
    meta: {
      title: "BestTourInfo - Register User",
      metaTags: []
    } 
  },
  { 
    path: '/profile', 
    name: '/profile',
    component: ProfilePage,
    meta: {
      title: "BestTourInfo - User Profile",
      metaTags: []
    } 
  },








 
  { 
    path: '/admin-login', 
    name: '/admin-login',
    component: AdminLogin
  },
  { 
    path: '/dashboard', 
    name: '/dashboard',
    component: adminDash
  },


  { 
    path: '/add-hotel', 
    name: '/add-hotel',
    component: AddHotel
  },

  { 
    path: '/subscriber-list', 
    name: '/Subscriber',
    component: Subs
  },

  { 
    path: '/top-ads', 
    name: 'TopAds',
    component: TopADS
  },
  { 
    path: '/multiple-ads', 
    name: 'MultipleAds',
    component: MultipleAds
  },

  { 
    path: '/hotels', 
    name: 'Hotel',
    component: Hotel
  },
  { 
    path: '/booking', 
    name: 'Order',
    component: Order
  },
  { 
    path: '/edit_booking', 
    name: 'EditBooking',
    component: EditOrder
  },

  { 
    path: '/search-hotel', 
    name: 'singleHotelDetails',
    component: singleHotel,
    meta: {
      title: "BestTourInfo - Search Result",
      metaTags: []
    } 
  },
  { 
    path: '/hotel-info', 
    name: 'HotelInfo',
    component: HotelInfo,
    meta: {
      title: 'BestTourInfo - Hotel Information',
      metaTags: []
    }
     
  },
  { 
    path: '/blog', 
    name: 'Blog',
    component: Blog 
  },
  { 
    path: '/add-blog', 
    name: 'BlogAdd',
    component: AddBlog 
  },
  { 
    path: '/add-blog-category', 
    name: 'BlogAddCat',
    component: AddBlogCategory 
  },
  { 
    path: '/category', 
    name: 'BlogCat',
    component: BlogCategory 
  },


    
  ]  

  
  const router = createRouter({
    history: createWebHistory(process.env.Base_URL),
    routes: routes, 
  })

  router.beforeEach((to,from,next) => {
    if(to.meta.title){
      document.title = `${to.meta.title}`;
    } else {
      document.title = "BestTourInfo";
    }
    
    next();
  });


  router.beforeEach((to, from, next) => {
    const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);
  
    if (nearestWithTitle) document.title = nearestWithTitle.meta.title;
  
    Array.from(document.querySelectorAll('[data-vue-router-controlled]')).map(el => el.parentNode.removeChild(el));
  
    if (!nearestWithTitle) return next();
  
    nearestWithTitle.meta.metaTags.map(tagDef => {
      const tag = document.createElement('meta');
      Object.keys(tagDef).forEach(key => {
        tag.setAttribute(key, tagDef[key]);
      });
      tag.setAttribute('data-vue-router-controlled', '');
      return tag;
    })
    .forEach(tag => document.head.appendChild(tag));
  
    next();
  });
  
  export default router