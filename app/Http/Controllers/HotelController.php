<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\HotelImages;
use App\Models\BlogImage;
use App\Models\Blog;
use App\Models\HotelFeatures;
use App\Models\HotelPayments;
use App\Models\HotelInstruction;
use App\Models\HotelRent;
use App\Models\BolgCategory;
use App\Models\RoomFeatures;
use App\Models\SubscriberList;
use Illuminate\Http\Request;

use File;

class HotelController extends Controller
{
  
  public function gethotelList(Request $request){
    return Hotel::orderBy('id', 'desc')->paginate($request->total);
  } 

  public function getFullDetailsHotelList(Request $request){
    return Hotel::with(['images','features','payments','rent','instruction'])->where('id', $request->id)->first();
  } 



  public function uploadTitleImage(Request $request){

      $this->validate($request,[
        'file' => 'required|mimes:jpg,png,jpeg'
        ]);

        $picName = time().'.'.$request->file->extension();
        $request->file->move(public_path('hotel_title_image'),$picName);
        return $picName;
  }

  public function uploadRoomTitleImage(Request $request){
    //return dd($request->image);
    $this->validate($request,[
     'image' => 'required|mimes:jpg,png,jpeg'
     ]);

     $picName = time().'.'.$request->image->getClientOriginalName();
     $request->image->move(public_path('hotel_title_image_room'),$picName);
     return $picName;
  }

  public function storeImage(Request $request){

      if(count($request->Hotel_Images)){
        foreach($request->Hotel_Images as $uploadFile){
          $path = '/hotel_images/';
          $picName = $path.$request->hotel_name.'_'.time().'_'.$uploadFile->getClientOriginalName();
          $url = $picName;
          $uploadFile->move(public_path('hotel_images'),$picName);
          $im[] =$url; 
        } 
      }
      
      $all = [];

      foreach($im as $img){
        array_push($all, [
          'hotel_name' => $request->hotel_name,
          'hotel_id' => $request->hotel_id,
          'hotel_image' => $img
        ]);
      }

      return HotelImages::insert($all);
      

  }

  public function store(Request $request){

      $this->validate($request,[
          'name' => 'required',
          'address' => 'required',
          'phone' => 'required',
          'email' => 'required|email',
          'description' => 'required',
          'city' => 'required',
          'country' => 'required',
          'zip' => 'required',
          'price' => 'required',
          'checkIn' => 'required',
          'checkOut' => 'required',
          'facilites' => 'required',
          'paymentType' => 'required',
          'total_room' => 'required',
        ]);
      
      $hotel = Hotel::create([
        'name' => $request->name,
        'address' => $request->address,
        'tourPointAddress' => $request->tourPointAddress,
        'tourPointAddress2' => $request->tourPointAddress2,
        'tourPointAddress3' => $request->tourPointAddress3,
        'tourPointAddress4' => $request->tourPointAddress4,
        'phone' => $request->phone,
        'email' => $request->email,
        'description' => $request->description,
        'city' => $request->city,
        'discount' => $request->price,
        'country' => $request->country,
        'zip' => $request->zip,
        'houseRules' => $request->houseRules,
        'checkIn' => $request->checkIn,
        'checkOut' => $request->checkOut,
        'petPolicy' => $request->petPolicy,
        'kidsPolicy' => $request->kidsPolicy,
        'titleImage' => $request->image,
        //'stars' => $request->stars,
        // 'discount' => $request->discount,
        'total_room' => $request->total_room,
        'constraction_year' => $request->constraction_year,
        'right_top' => $request->right,
        'floor_no' => $request->floor_no,
        'activeStatus' => $request->home,
      ]);
    
      if($request->facilites != ''){
        foreach($request->facilites as $im){
          $hotelFeature = HotelFeatures:: create([
            'hotel_id' => $hotel->id,
            'hotel_name' => $request->name,
            'hotel_feature' => $im,
          ]);
        }
      }

      
      foreach($request->ins as $im){
        if($im['instruction'] != ''){
          $hotelInstruction = HotelInstruction:: create([
            'hotel_id' => $hotel->id,
            'hotel_instruction' => $im['instruction'],
          ]);
        }
      }
      

      if($request->paymentType != ''){
        foreach($request->paymentType as $im){
          $hotelPayment = HotelPayments:: create([
            'hotel_id' => $hotel->id,
            'hotel_name' => $request->name,
            'payment_method' => $im,
          ]);
        }
      }

      foreach($request->form as $im){
        $hotelRent = HotelRent:: create([
          'hotel_id' => $hotel->id,
          'hotel_name' => $request->name,
          'hotel_address' => $hotel->address,
          'hotel_phone' => $hotel->phone,
          'hotel_email' => $hotel->email,
          'offerTitle' => $im['offerTitle'],
          'totalPerson' => $im['totalPerson'],
          'bed' => $im['bed'],
          'size' => $im['size'],
          'offerRegularPrice' => $im['offerRegularPrice'],
          'offerDiscpuntPrice' => $im['offerDiscpuntPrice'],
          'rdiscount' => $im['rdiscount'],
          'WofferRegularPrice' => $im['WofferRegularPrice'],
          'WofferDiscpuntPrice' => $im['WofferDiscpuntPrice'],
          'wdiscount' => $im['wdiscount'],
          'image' => $im['imgName'],
        ]);

        foreach($im['roomFeatures'] as $f){
          $roomFeature = RoomFeatures:: create([
            'hotel_id' => $hotel->id,
            'rent_id' => $hotelRent->id,
            'room_type' => $im['offerTitle'],
            'room_feature' => $f,
          ]);
        }

      }

      return $hotel;
      
  }
  
  public function deleteHotel(Request $request){
    
    $hotelImages = HotelImages::where('hotel_id', $request->id)->pluck('hotel_image')->toArray();
    $hotelTitleImage = Hotel::where('id', $request->id)->pluck('titleImage')->toArray();
    $hotelRentImage = HotelRent::where('hotel_id', $request->id)->pluck('image')->toArray();

    foreach ($hotelImages as $fileName) {
        if (file_exists(public_path().$fileName)) {
            @unlink(public_path().$fileName);
        }
    }

    foreach ($hotelTitleImage as $fileName) {
        if (file_exists(public_path().$fileName)) {
            @unlink(public_path().$fileName);
        }
    }

    foreach ($hotelRentImage as $fileName) {
        if (file_exists(public_path().$fileName)) {
            @unlink(public_path().$fileName);
        }
    }

    Hotel::with(['images','features','payments'])->where('id', $request->id)->delete();
    HotelImages::where('hotel_id', $request->id)->delete();
    HotelFeatures::where('hotel_id', $request->id)->delete();
    HotelPayments::where('hotel_id', $request->id)->delete();
    HotelRent::where('hotel_id', $request->id)->delete();
    HotelInstruction::where('hotel_id', $request->id)->delete();

    // return response()->json([
    //   'msg' => "okkkkk"
    // ]);
  }


  public function updateHotel(Request $request){  
   // return dd($request);

    $this->validate($request,[
      'name' => 'required',
      'address' => 'required',
      'phone' => 'required',
      'email' => 'required|email',
      'description' => 'required',
      'city' => 'required',
      'discount' => 'required',
      'country' => 'required',
      'zip' => 'required',
      'checkIn' => 'required',
      'checkOut' => 'required',
      //'stars' => 'required', 
    ]);
  
    Hotel::where('id',$request->id)->update([
      'name' => $request->name,
      'address' => $request->address,
      'tourPointAddress' => $request->tourPointAddress,
      'tourPointAddress2' => $request->tourPointAddress2  ,
      'tourPointAddress3' => $request->tourPointAddress3,
      'tourPointAddress4' => $request->tourPointAddress4,
      'phone' => $request->phone,
      'email' => $request->email,
      'description' => $request->description,
      'city' => $request->city,
      'country' => $request->country,
      'zip' => $request->zip,
      'discount' => $request->discount,
      'houseRules' => $request->houseRules,
      'checkIn' => $request->checkIn,
      'checkOut' => $request->checkOut,
      'petPolicy' => $request->petPolicy,
      'kidsPolicy' => $request->kidsPolicy,
      'titleImage' => $request->titleImage,
      'stars' => $request->stars,
      'total_room' => $request->total_room,
      'constraction_year' => $request->constraction_year,
      'right_top' => $request->right_top,
      'floor_no' => $request->floor_no,
      'activeStatus' => $request->activeStatus,
    ]);

    return Hotel::orderBy('id', 'desc')->paginate($request->total);

  }

  public function updateImage(Request $request){
    //return dd($request->Hotel_Images);
    if(!empty($request->Hotel_Images)){
      foreach($request->Hotel_Images as $uploadFile){
        $path = '/hotel_images/';
        $picName = $path.$request->hotel_name.'_'.time().'_'.$uploadFile->getClientOriginalName();
        $url = $picName;
        $uploadFile->move(public_path('hotel_images'),$picName);
        $im[] =$url; 
      } 
    }
    
    $all = [];
      if(!empty($im)){
        foreach($im as $img){
            array_push($all, [
              'hotel_id' => $request->hotel_id,
              'hotel_name' => $request->hotel_name,
              'hotel_image' => $img
            ]);
          }
        }
      HotelImages::insert($all);
      return HotelImages::where('hotel_id', $request->hotel_id)->get();
    }

  
    public function updateFeature(Request $request){
    
    $all = [];

    foreach($request->facilites as $facility){
      array_push($all, [
        'hotel_id' => $request->hotel_id,
        'hotel_name' => $request->hotel_name,
        'hotel_feature' => $facility
      ]);
    }

    HotelFeatures::insert($all);
    return HotelFeatures::where('hotel_id', $request->hotel_id)->get();
  }
  
  public function updatePayment(Request $request){
    
    $all = [];

    foreach($request->payments as $facility){
      array_push($all, [
        'hotel_id' => $request->hotel_id,
        'hotel_name' => $request->hotel_name,
        'payment_method' => $facility
      ]);
    }

    HotelPayments::insert($all);
    return HotelPayments::where('hotel_id', $request->hotel_id)->get();
  }
  
  public function updateRent(Request $request){

    $hotel = Hotel::where('id', $request->hotel_id)->first();
    
    if($request->rent != ''){

      foreach($request->rent as $im){

        if($im['offerTitle'] != ''){

          $hotelRent = HotelRent:: create([
            'hotel_id' => $request->hotel_id,
            'hotel_name' => $request->hotel_name,
            'hotel_address' => $hotel->address,
            'hotel_phone' => $hotel->phone,
            'hotel_email' => $hotel->email,
            'offerTitle' => $im['offerTitle'],
            'totalPerson' => $im['totalPerson'],
            'bed' => $im['bed'],
            'size' => $im['size'],
            'offerRegularPrice' => $im['offerRegularPrice'],
            'offerDiscpuntPrice' => $im['offerDiscpuntPrice'],
            'rdiscount' => $im['rdiscount'],
            'WofferRegularPrice' => $im['WofferRegularPrice'],
            'WofferDiscpuntPrice' => $im['WofferDiscpuntPrice'],
            'wdiscount' => $im['wdiscount'],
            'image' => $im['imgName'],
          ]);

          foreach($im['roomFeatures'] as $f){
            $roomFeature = RoomFeatures:: create([
              'hotel_id' => $request->hotel_id,
              'rent_id' => $hotelRent->id,
              'room_type' => $im['offerTitle'],
              'room_feature' => $f,
            ]);

          }
        }
      }

    }


    return HotelRent::where('hotel_id', $request->hotel_id)->get();
  }
  
  public function updateInstruction(Request $request){
    
    if($request->ins != ''){

      foreach($request->ins as $im){

        if($im['instruction'] != ''){

          $hotelInstruction = HotelInstruction:: create([
            'hotel_id' => $request->hotel_id,
            'hotel_instruction' => $im['instruction']
          ]);
        }
      }

    }


    return HotelInstruction::where('hotel_id', $request->hotel_id)->get();
  }

  public function deleteFeature(Request $request){  
   return HotelFeatures::where('id', $request->id)->delete();
  }

  public function deletePayment(Request $request){  
   return HotelPayments::where('id', $request->id)->delete();
  }

  public function deleteHotelInstruction(Request $request){  
   return HotelInstruction::where('id', $request->id)->delete();
  }

  public function deleteImage(Request $request){  
    $fileName = $request->hotel_image;
    //return dd($fileName);
    //$path = public_path()."/hotel_images/";
    $filePath = public_path().$fileName;
    //return dd($filePath);
    if(file_exists($filePath)){
      @unlink($filePath);
    }
    HotelImages::where('id', $request->id)->delete();
 
  }

  public function deleteRent(Request $request){  
   return HotelRent::where('id', $request->id)->delete();
  }

  public function getOrderList(Request $request){
    return Order::with(['user','orderDetails'])->orderBy('id', 'desc')->paginate($request->total);
    //return User::with(['orders'])->orderBy('id', 'desc')->paginate($request->total);
  } 

  public function deleteOrder(Request $request){
    Order::where('id', $request->id)->delete();
  }
  
  public function getFullDetailsBookingList(Request $request){
    return Order::with(['user','orderDetails'])->where('id', $request->id)->first();
  } 

  public function updateOrder(Request $request){  

    $this->validate($request,[
      'payment_status' => 'required',
    ]);
  
    Order::where('id',$request->id)->update([
      'payment_status' => $request->payment_status,
    ]);

  }

  public function getSubscriber(Request $request){
    return SubscriberList::orderBy('id', 'desc')->paginate($request->total);
  } 

  public function deleteSubscriber(Request $request){
    SubscriberList::where('id', $request->id)->delete();
    return SubscriberList::orderBy('id', 'desc')->paginate($request->total);
  }

  public function addSubscriber(Request $request){
    $request->validate([
      'EmailAddress' => 'required|email|unique:subscriber_lists,email|max:100'       
    ]);

    return SubscriberList::create([
      'email' => $request->EmailAddress
    ]);

  }

  public function storeBlog(Request $request){

    $this->validate($request,[
        'blog_title' => 'required',
        'tag_line' => 'required',
        'description' => 'required',
        'category' => 'required',
      ]);
    
    $blog = Blog::create([
      'blog_title' => $request->blog_title,
      'tag_line' => $request->tag_line,
      'description' => $request->description,
      'title_image' => $request->category,
    ]);

    return $blog;
    //return dd($request->description);
    
  }

  public function storeBlogImage(Request $request){

    if(count($request->Blog_Images)){
      foreach($request->Blog_Images as $uploadFile){
        $path = '/blog_images/';
        $picName = $path.$request->blog_title.'_'.time().'_'.$uploadFile->getClientOriginalName();
        $url = $picName;
        $uploadFile->move(public_path('blog_images'),$picName);
        $im[] =$url; 
      } 
    }
    
    $all = [];

    foreach($im as $img){
      array_push($all, [
        'blog_id' => $request->blog_id,
        'image' => $img
      ]);
    }

    return BlogImage::insert($all);

  }

  public function getAllBlog(request $request){
    return Blog::with(['images'])->orderBy('id', 'desc')->paginate($request->total);
  }

  public function getAllBlogCat(request $request){
    return Blog::with(['images'])->where('title_image', $request->category)->paginate($request->total);
  }

  public function getCategoryBlog(request $request){
    return Blog::with(['images'])->where('title_image', $request->str)->paginate($request->total);
  }
  
  public function getCountryBlogPost(request $request){
    return Blog::with(['images'])->where('tag_line', $request->str)->paginate($request->total);
  }

  public function getCountryBlog(){
    return Blog::select('tag_line')->distinct()->get();
  }

  public function deleteBlogPost(request $request){

    $fileNames = BlogImage::where('blog_id', $request->id)->pluck('image')->toArray();

    foreach ($fileNames as $fileName) {
        if (file_exists(public_path().$fileName)) {
            @unlink(public_path().$fileName);
        }
    }
    
    Blog::where('id', $request->id)->delete();

  }

  public function deleteBlogPostImage(request $request){
    //return dd($request->img);
    $fileName = $request->img;
    $path = public_path();
    $filePath = $path.$fileName;
    //return dd($filePath);
    if(file_exists($filePath)){
      @unlink($filePath);
    }
    return BlogImage::where('id', $request->id)->delete();
    //return Blog::with(['images'])->orderBy('id', 'desc')->paginate($request->total);
  }

  public function UpdateBlogPost(request $request){
    // return dd($request);

    $this->validate($request,[
      'blog_title' => 'required',
      'tag_line' => 'required',
      'description' => 'required',
      'category' => 'required',
    ]);
  
    Blog::where('id',$request->id)->update([
      'blog_title' => $request->blog_title,
      'tag_line' => $request->tag_line,
      'description' => $request->description,
      'title_image' => $request->category,
    ]);

    return Blog::with(['images'])->orderBy('id', 'desc')->paginate(5);
    
  }

  public function UpdateBlogPostImage(request $request){
    //return dd($request->Blog_Images);
    if(!empty($request->Blog_Images)){
      foreach($request->Blog_Images as $uploadFile){
        $path = '/blog_images/';
        $picName = $path.$request->blog_title.'_'.time().'_'.$uploadFile->getClientOriginalName();
        $url = $picName;
        $uploadFile->move(public_path('blog_images'),$picName);
        $im[] =$url; 
      } 
    }
    
    $all = [];
      if(!empty($im)){
        foreach($im as $img){
            array_push($all, [
              'blog_id' => $request->blog_id,
              'image' => $img
            ]);
          }
        }
      BlogImage::insert($all);
      return Blog::with(['images'])->orderBy('id', 'desc')->paginate($request->total);
  }

  // public function uploadBlogTitleImage(request $request){
  //   $this->validate($request,[
  //     'file' => 'required|mimes:jpg,png,jpeg'
  //     ]);

  //     $picName = time().'.'.$request->file->extension();
  //     $request->file->move(public_path('blog_title_image'),$picName);
  //     return $picName;
  // }

  public function addCategory(Request $request){

    $this->validate($request,[
        'blog_category' => 'required',
        'slug' => 'required',
      ]);
    
    $blog = BolgCategory::create([
      'category' => $request->blog_category,
      'slug' => $request->slug,
    ]);

    return $blog;
    //return dd($request->description);
    
  }

  public function getCategoryAll(request $request){
    return BolgCategory::select('category')->distinct()->get();
  }

  public function getCategory(request $request){
    return BolgCategory::orderBy('id', 'desc')->paginate($request->total);
  }

  public function deleteCategory(request $request){
    BolgCategory::where('id', $request->id)->delete();
  }

  
  public function UpdateCategory(request $request){

    $this->validate($request,[
      'name' => 'required',
      'slug' => 'required',
    ]);
  
    BolgCategory::where('id',$request->id)->update([
      'category' => $request->name,
      'slug' => $request->slug,
    ]);

    return BolgCategory::orderBy('id', 'desc')->paginate($request->total);
    
  }

  public function getSlug(Request $request){
    return BolgCategory::select('slug')->distinct()->get();
  } 

  public function getCatBlog(Request $request){
    return Blog::with(['images'])->where('title_image', $request->str)->get();
  } 


}
