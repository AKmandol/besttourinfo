<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\UserCheck;

Route::get('/',[AdminController::class, 'index']);

//BackEnd Admin
Route::get('/admin-login',[AdminController::class, 'admin']);
Route::post('/app/admin_login',[AdminController::class, 'adminLogin']);
Route::get('/app/admin_logout',[AdminController::class, 'adminLogout']);
Route::post('/subscribe',[HotelController::class, 'addSubscriber']);

Route::middleware([AdminCheck::class])->group(function () {
    Route::get('/app/dashboard',[AdminController::class, 'getDashboard']);
    Route::get('/dashboard',[AdminController::class, 'admin']);
    Route::get('/vat-tax',[AdminController::class, 'admin']);
    Route::get('/cars-list',[AdminController::class, 'admin']);
    Route::get('/driver',[AdminController::class, 'admin']);
    Route::get('/destination',[AdminController::class, 'admin']);
    Route::get('/cars-rent',[AdminController::class, 'admin']);
    Route::get('/assign-driver',[AdminController::class, 'admin']);
    Route::get('/all-admin',[AdminController::class, 'admin']);
    Route::get('/all-user',[AdminController::class, 'admin']);
    Route::get('/all-editor',[AdminController::class, 'admin']);
    Route::get('/add-editor',[AdminController::class, 'admin']);
    Route::get('/add-hotel',[AdminController::class, 'admin']);
    Route::get('/subscriber-list',[AdminController::class, 'admin']);
    Route::get('/top-ads',[AdminController::class, 'admin']);
    Route::get('/multiple-ads',[AdminController::class, 'admin']);
    Route::get('/admin-info',[AdminController::class, 'admin']);
    Route::get('/add-blog',[AdminController::class, 'admin']);
    Route::get('/add-blog-category',[AdminController::class, 'admin']);
    Route::get('/category',[AdminController::class, 'admin']);
    Route::get('/blog',[AdminController::class, 'admin']);
    Route::get('/hotels',[AdminController::class, 'admin']);
    Route::get('/booking',[AdminController::class, 'admin']);
    Route::get('/edit_booking',[AdminController::class, 'admin']);
    Route::get('/admin-home/hotelDetailsSingle',[AdminController::class, 'admin']);
    Route::get('/about-us',[AdminController::class, 'admin']);
    Route::get('/faq',[AdminController::class, 'admin']);
    Route::get('/refund-policy',[AdminController::class, 'admin']);
    Route::get('/privacy-policys',[AdminController::class, 'admin']);
    Route::get('/send-email',[AdminController::class, 'admin']);
    Route::get('/email-log',[AdminController::class, 'admin']);
    Route::get('/login-record',[AdminController::class, 'admin']);
    Route::get('/print-hotel',[AdminController::class, 'admin']);
    Route::get('/print-car',[AdminController::class, 'admin']);
    Route::get('/t-n-c',[AdminController::class, 'admin']);

    Route::get('/back/getSearch',[AdminController::class, 'getSearch']);
    Route::get('/hotel/getSearch/order',[AdminController::class, 'getSearchHotel']);
    Route::get('/car/getSearch/orderCar',[AdminController::class, 'getSearchCar']);
    Route::get('/car/getSearch/packeage',[AdminController::class, 'getSearchPackeage']);


    Route::post('/car/title/uploads',[CarController::class, 'uploadTitleImage']);
    Route::post('/car/store',[CarController::class, 'storeCar']);
    Route::post('/car/delete',[CarController::class, 'deleteCar']);
    Route::post('/car/update',[CarController::class, 'updateCar']);

    Route::post('/driver/img/uploads',[CarController::class, 'uploadDriverImage']);
    Route::post('/driver/license/uploads',[CarController::class, 'uploadLicenseImage']);
    Route::post('/drive/store',[CarController::class, 'storeDriver']);
    Route::post('/driver/delete',[CarController::class, 'deleteDriver']);
    Route::post('/driver/update',[CarController::class, 'updateDriver']);
    
    
    Route::post('/destination/store',[CarController::class, 'storeDestination']);
    Route::post('/destination/delete',[CarController::class, 'deleteDestination']);
    Route::post('/destination/update',[CarController::class, 'updateDestination']);


    Route::post('/updateHotel/vat',[HomeController::class, 'updateHotelVat']);
    Route::post('/updateCar/vat',[HomeController::class, 'updateCarVat']);
    

    Route::post('/hotel/store',[HotelController::class, 'store']);
    Route::post('/hotel/store/image',[HotelController::class, 'storeImage']);
    Route::post('/hotel/store/facelities',[HotelController::class, 'storeFacelities']);
    Route::post('/hotel/store/payments',[HotelController::class, 'storePayments']);
    Route::get('/get_hotelList',[HotelController::class, 'gethotelList']);
    Route::get('/full/details_hotel',[HotelController::class, 'getFullDetailsHotelList']);
    Route::get('/full/details_booking',[HotelController::class, 'getFullDetailsBookingList']);
    Route::post('/info/delete_hotel',[HotelController::class, 'deleteHotel']);
    Route::post('/hotel/title/uploads',[HotelController::class, 'uploadTitleImage']);
    Route::post('/hotel/store/rent',[HotelController::class, 'uploadRoomTitleImage']);
    Route::post('/hotel/uploads',[HotelController::class, 'upload']);
    Route::post('/hotel/deleteImage',[HotelController::class, 'deleteImage']);
    Route::post('/hotel/update_basic',[HotelController::class, 'updateBasic']);
    Route::post('/hotel/update/image',[HotelController::class, 'updateImage']);
    Route::post('/hotel/deleteFeature',[HotelController::class, 'deleteFeature']);
    Route::post('/hotel/deleteRent',[HotelController::class, 'deleteRent']);
    Route::post('/hotel/update_hotel',[HotelController::class, 'updateHotel']);
    Route::post('/hotel/update_feature',[HotelController::class, 'updateFeature']);
    Route::post('/hotel/update_instruction',[HotelController::class, 'updateInstruction']);
    Route::post('/hotel/update_payment',[HotelController::class, 'updatePayment']);
    Route::post('/hotel/update_rent',[HotelController::class, 'updateRent']);
    Route::post('/hotel/deletePayment',[HotelController::class, 'deletePayment']);
    Route::post('/hotel/deleteInstruction',[HotelController::class, 'deleteHotelInstruction']);
    Route::get('/get_orderLists',[HotelController::class, 'getOrderList']);
    Route::post('/info/delete_order',[HotelController::class, 'deleteOrder']);
    Route::post('/updateBooking',[HotelController::class, 'updateOrder']);

    Route::get('/app/get_subscriber',[HotelController::class, 'getSubscriber']);
    Route::post('app/delete_subscriber',[HotelController::class, 'deleteSubscriber']);
    Route::post('/blog/store',[HotelController::class, 'storeBlog']);

    Route::get('/app/login-record',[AdminController::class, 'getLoginRecord']);
    Route::get('/app/email-log',[AdminController::class, 'getEmailLog']);

    Route::post('/blog/store/image',[HotelController::class, 'storeBlogImage']);
    Route::post('/blog/delete_post',[HotelController::class, 'deleteBlogPost']);
    Route::post('/blog/delete_category',[HotelController::class, 'deleteCategory']);
    Route::post('/blog/deleteImage',[HotelController::class, 'deleteBlogPostImage']);
    Route::post('/blog/update_post',[HotelController::class, 'UpdateBlogPost']);
    Route::post('/blog/update_Category',[HotelController::class, 'UpdateCategory']);
    Route::post('/blog/update/image',[HotelController::class, 'UpdateBlogPostImage']);
    Route::post('/blog/store/category',[HotelController::class, 'addCategory']);

    Route::get('/get_all_Admin',[AdminController::class, 'getAllAdmin']);
    Route::post('/admin/store',[AdminController::class, 'addAdmin']);
    Route::post('/admin/update',[AdminController::class, 'updateAdmin']);
    Route::post('/admin/delete',[AdminController::class, 'deleteAdmin']);
    Route::get('/get_all_User',[AdminController::class, 'getAllUser']);
    Route::get('/get_one_User',[AdminController::class, 'getSingleUser']);
    Route::post('/user/delete',[AdminController::class, 'deleteUserData']);
    Route::post('/user/update',[AdminController::class, 'updateUserData']);
    Route::post('/editor/store',[AdminController::class, 'addEditor']);
    Route::get('/get_all_editors',[AdminController::class, 'getEditor']);
    Route::post('/editor/update',[AdminController::class, 'updateEditor']);
    Route::post('/editor/delete',[AdminController::class, 'deleteEditor']);


    Route::post('/car/status/update',[CarController::class, 'carStatusChange']);
    Route::get('/driver/get_type_by',[CarController::class, 'getCarByType']);
    Route::post('/car/assign_driver/update',[CarController::class, 'updateAssignDriver']);
    Route::post('/car/assign_driver/remove',[CarController::class, 'removeAssignDriver']);

    Route::get('/mark/all/as/read',[AdminController::class, 'notificationClear']);
    Route::post('/clear/notification',[AdminController::class, 'notificationClearType']);
    
    Route::post('/email/send',[AdminController::class, 'sendEmail']);

});

Route::get('/car/get_all',[CarController::class, 'getAllCar']);
Route::get('/driver/get_all',[CarController::class, 'getAllDriver']);
Route::get('/destination/get_all',[CarController::class, 'getAllDestination']);
Route::post('/home/order/car',[CarController::class, 'carOrder']);
Route::post('/home/car/orderConfirm',[CarController::class, 'carOrderConfirm']);
Route::get('/car/get_orderList',[CarController::class, 'gatCarOrder']);
Route::get('/car/get_orderDrivert',[CarController::class, 'gatCarDriverOrder']);
Route::post('/car/get_driver',[CarController::class, 'gatCarDriver']);
Route::post('/delete_carOrderList',[CarController::class, 'deleteCarOrder']);
Route::post('/car/oder/delete',[CarController::class, 'deleteCarOrderAdmin']);
Route::post('/update_carOrderList',[CarController::class, 'editCarOrder']);

//BackEnd User
Route::post('/user-login',[AdminController::class, 'userLogin']);
Route::post('/api/registerAccount',[AdminController::class, 'registerUser']);
Route::post('/api/registerAccountConfirm',[AdminController::class, 'registerAccountConfirm']);
Route::post('/api/forgot',[AdminController::class, 'forgotPassword']);
Route::post('/api/changePassword',[AdminController::class, 'cngPassword']);
Route::post('/api/confirmChangePassword',[AdminController::class, 'confirmcngPassword']);
Route::get('/app/user_logout',[AdminController::class, 'logoutUser']);
Route::middleware([UserCheck::class])->group(function () {
    Route::get('/profile',[AdminController::class, 'index']);
    Route::get('/order-confirmation',[AdminController::class, 'index']);
    Route::get('/order-failed',[AdminController::class, 'index']);
    Route::post('/app/updateUser',[AdminController::class, 'updateUser']);
    Route::post('/app/updateUserlogin',[AdminController::class, 'updateUserlogin']);
    Route::post('profilePic/upload',[AdminController::class, 'uploadProfilePic']);
    Route::get('/profile/deleteImage',[AdminController::class, 'deleteImage']);
    Route::post('/profile/store',[AdminController::class, 'imageStore']);
    Route::post('/profile/deleteUser',[AdminController::class, 'deleteUser']);
    Route::get('/get_orderList',[AdminController::class, 'getOrder']);
    Route::post('/delete_orderList',[AdminController::class, 'deleteOrder']);
    Route::post('/update_orderList',[AdminController::class, 'updateeOrder']);
    Route::post('/update_car_OrderList',[CarController::class, 'updateCarOrder']);
    Route::post('/home/order',[HomeController::class, 'booking']);

    // SSLCOMMERZ Start
    Route::post('/pay-via-ajax-ssl', [HomeController::class, 'payNowSsl']);
    Route::post('/success', [HomeController::class, 'success']);
    Route::post('/fail', [HomeController::class, 'fail']);
    Route::post('/cancel', [HomeController::class, 'cancel']);
    Route::post('/ipn', [HomeController::class, 'ipn']);
    //SSLCOMMERZ END

});

//Home Page
Route::get('/home/getTopDestinationHotel',[HomeController::class, 'getTopDestination']);
// Route::get('/home/getTourInBD',[HomeController::class, 'getTourInBangladesh']);
// Route::get('/home/getreputatedStaysInBangladesh',[HomeController::class, 'reputatedStays']);
Route::get('/home/clientReviewHotel',[HomeController::class, 'clientReviewHotel']);
Route::get('/home/getALL',[HomeController::class, 'getALL']);
Route::get('/home/hotelDetails',[HomeController::class, 'getSingleHotel']);
Route::get('/home/hotelDetailsSingle',[HomeController::class, 'getHotelDetailsSingle']);
Route::get('/social/share',[HomeController::class, 'getHotelDetailsSingleShare']);
Route::get('/social/share/blog',[HomeController::class, 'getHotelDetailsSingleShareBlog']);
Route::get('/home/roomFeatures',[HomeController::class, 'getRoomFeatures']);
Route::get('/home/hotelFeatures',[HomeController::class, 'singleHotelFeatures']);
Route::get('/home/hotelImage',[HomeController::class, 'getSingleHotelImage']);
Route::get('/home/search-hotel',[HomeController::class, 'searchedData']);







Route::post('/footer/mailsend',[HomeController::class, 'footerMail']);
Route::post('/contact/mailsend',[HomeController::class, 'ContactMail']);
Route::post('/order/mailsend',[HomeController::class, 'oderMail']);
Route::post('/order/mailsendClient',[HomeController::class, 'oderMailClient']);
Route::post('/status/mailsendClient',[HomeController::class, 'statusMailClient']);
Route::post('/order/car/adminMail',[CarController::class, 'carOrderMailAdmin']);
Route::post('/order/car/clientMail',[CarController::class, 'carOrderMailClient']);


Route::get('/blog/getCategoryAll',[HotelController::class, 'getCategoryAll']);
Route::get('/blog/getCategory',[HotelController::class, 'getCategory']);
Route::get('/blog/getSlug',[HotelController::class, 'getSlug']);
Route::get('/home/getCatBlog',[HotelController::class, 'getCatBlog']);
Route::get('/vat/get',[HomeController::class, 'getVat']);


Route::post('/home/cart',[HomeController::class, 'cartItemAdd']);
Route::get('/home/getCart',[HomeController::class, 'getcartItem']);
Route::post('/home/delete_cart',[HomeController::class, 'deleteCartItem']);
Route::post('/home/roomAdd',[HomeController::class, 'rooomNoUpdate']);
Route::post('/home/roomRemove',[HomeController::class, 'rooomNoUpdate']);
Route::get('/home/getALLHotel',[HomeController::class, 'getAllHotel']);
Route::get('/home/filterGetALLHotel',[HomeController::class, 'getAllHotelFilter']);
Route::get('/home/filterGetALLHotelCity',[HomeController::class, 'getAllHotelFilterCity']);
Route::get('/home/filterGetALLHotelFas',[HomeController::class, 'getAllHotelFilterFacility']);
Route::post('/home/image_one/uploads',[HomeController::class, 'imageOneUpload']);
Route::post('/home/image_two/uploads',[HomeController::class, 'imageTwoUpload']);
Route::post('/home/topTwoAds/Upload',[HomeController::class, 'topAdsUpdate']);
Route::get('/home/home/topTwoAdsGet',[HomeController::class, 'getTopTwo']);
Route::post('/home/html/delete',[HomeController::class, 'deleteHtmlAds']);
Route::post('/home/store/adsImages',[HomeController::class, 'storeMutipleAds']);
Route::get('/home/home/adsGet',[HomeController::class, 'getAds']);
Route::post('/home/delete_ads',[HomeController::class, 'deleteAds']);
Route::get('/blog/all',[HotelController::class, 'getAllBlog']);
Route::get('/blog/all/category',[HotelController::class, 'getAllBlogCat']);
Route::get('/cattegory/all',[HotelController::class, 'getCategoryBlog']);
Route::get('/blog/getCountryAll',[HotelController::class, 'getCountryBlog']);
Route::get('/country/all',[HotelController::class, 'getCountryBlogPost']);
Route::get('/home/blog-info',[HomeController::class, 'getSingleBlog']);
Route::get('/home/gttSingleBlog',[HomeController::class, 'getSingleBlogData']);
Route::get('/home/getBlogHotel',[HomeController::class, 'getSingleBlogHotel']);
Route::get('/home/getLocation',[HomeController::class, 'getHotelLocation']);
Route::get('/home/getBlogImage',[HomeController::class, 'getBlogImages']);
Route::get('/home/getBlogImageLast',[HomeController::class, 'getBlogImagesLast']);
Route::post('/home/create-about',[HomeController::class, 'createAbout']);
Route::get('/home/get/about',[HomeController::class, 'getAbout']);
Route::post('/app/createBlog/upload',[HomeController::class, 'uploadCk']);
Route::post('/add/tearm',[HomeController::class, 'addTerms']);
Route::get('/get/tearm',[HomeController::class, 'getALLTerms']);
Route::post('/delete/terms',[HomeController::class, 'deleteTerms']);
Route::post('/terms/update',[HomeController::class, 'updateTerms']);
Route::post('/add/privacy',[HomeController::class, 'addPrivacy']);
Route::get('/get/privacy',[HomeController::class, 'getALLPrivacy']);
Route::post('/delete/privacy',[HomeController::class, 'deletePrivacy']);
Route::post('/privacy/update',[HomeController::class, 'updatePrivacy']);
Route::post('/add/refund',[HomeController::class, 'addRefund']);
Route::get('/get/refund',[HomeController::class, 'getALLRefund']);
Route::post('/delete/refund',[HomeController::class, 'deleteRefund']);
Route::post('/refund/update',[HomeController::class, 'updateRefund']);
Route::post('/add/faq',[HomeController::class, 'addFaq']);
Route::get('/get/faq',[HomeController::class, 'getALLFaq']);
Route::post('/delete/faq',[HomeController::class, 'deleteFaq']);
Route::post('/faq/update',[HomeController::class, 'updateFaq']);




Route::get('/home/getAllPrivacy',[HomeController::class, 'getAllPolicies']);
Route::get('/home/getAllRefund',[HomeController::class, 'getAllRefunds']);
Route::get('/home/getAllTerms',[HomeController::class, 'getAllConditons']);
Route::get('/home/get/faq',[HomeController::class, 'getAllFaqs']);
Route::get('/home/getBookingHostory',[HomeController::class, 'getHistory']);


Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});

//Reload Solution
Route::get('/{pathMatch}',[AdminController::class,'index'])->where('pathMacth',".*");
