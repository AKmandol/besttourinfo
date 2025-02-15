<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\Mail\ContactMail;
use App\Mail\ClientMail;
use App\Mail\OrderStatus;
use App\Mail\MailOrder;
use App\Models\Hotel;
use App\Models\HotelImages;
use App\Models\Cart;
use App\Models\Order;
use App\Models\HotelOrderDetails;
use App\Models\EmailLog;
use App\Models\Blog;
use App\Models\TandC;
use App\Models\Privacy;
use App\Models\Refund;
use App\Models\Faq;
use App\Models\vatTax;
use App\Models\About;
use App\Models\BlogImage;
use App\Models\User;
use App\Models\HotelRent;
use App\Models\HotelFeatures;
use App\Models\RoomFeatures;
use App\Models\HotelPayments;
use App\Models\TopTwoAds;
use App\Models\MultipleAds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function getTopDestination(Request $request){
      return Hotel::where('activeStatus', 1)->orderBy('id', 'desc')->with(['images','features','payments','rent'])->take(8)->get();
    } 

    public function clientReviewHotel(Request $request){
      return Hotel::orderBy('id', 'desc')->with(['images'])->take(6)->get();
    } 

    public function getALL(Request $request){
      return Hotel::with(['images','features','payments','rent'])->get();
    } 

    public function getAllHotel(Request $request){
      return Hotel::with(['images','features','payments','rent'])->paginate($request->total);
    } 

    public function getHotelLocation(Request $request){
      return Hotel::select('city')->distinct()->get();
    } 

    public function getSingleHotel(Request $request){
      return Hotel::with(['images','features','payments'])->where('id',$request->id)->get();
    } 

    public function getRoomFeatures(Request $request){
      //return dd($request->id);
      return RoomFeatures::where('rent_id',$request->id)->get();
    } 
    
    public function singleHotelFeatures(Request $request){
      //return dd($request);
      return HotelFeatures::where('hotel_id',$request->id)->get();
    } 

    public function getHotelDetailsSingleShare(Request $request){
  
      $hotel= Hotel::with(['images','features','payments','rent','instruction'])->find($request->id);  
      return view('share', compact('hotel'));  

    } 

    public function getHotelDetailsSingleShareBlog(Request $request){
      $image = BlogImage::where('blog_id',$request->id)->first();
      //return dd ($image);
      $blog= Blog::with(['images'])->find($request->id); 
      return view('shareBlog', compact('blog','image')); 

    } 

    public function getHotelDetailsSingle(Request $request){

      $hotel = Hotel::with(['images','features','payments','rent','instruction'])->where('id',$request->id)->get();
       
      return $hotel;
    } 

    public function getSingleHotelImage(Request $request){
      return HotelImages::where('hotel_id',$request->id)->select('hotel_image')->get();
    } 

    public function getTourInBangladesh(Request $request){
      return Hotel::orderBy('id', 'desc')->where('country','Bangladesh')->get();
    } 

    public function reputatedStays(Request $request){
      return Hotel::with(['images','features','payments'])->where('stars', '>=', 3)->get();
    } 

    public function searchedData(Request $request){

      $str = $request->str;
      if(!$str) {
        $data = Hotel::with(['images','features','payments','rent'])->paginate($request->total);
      }
      else{
        $data = Hotel::with(['images','features','payments','rent'])->where('name',$request->str)->orWhere('city', $request->str)->paginate($request->total);
      }
      return $data;
      
    } 

    public function getAllHotelFilter(Request $request){

      if($request->str == 'low') {
        $data = Hotel::orderBy("discount", "asc")->with(['images','features','payments','rent'])->paginate($request->total);
      }
      if($request->str == 'high') {
        $data = Hotel::orderBy("discount", "desc")->with(['images','features','payments','rent'])->paginate($request->total);
      }
      if($request->str == 'p1k') {
        $data = Hotel::where('discount', '<', 999)->with(['images','features','payments','rent'])->paginate($request->total);
      }
      if($request->str == 'p1kto5k') {
        $data = Hotel::whereBetween('discount', [1000,4999])->orderBy('discount', 'asc')->with(['images','features','payments','rent'])->paginate($request->total);
      }
      if($request->str == 'p5kto10k') {
        $data = Hotel::whereBetween('discount', [5000,10000])->orderBy('discount', 'asc')->with(['images','features','payments','rent'])->paginate($request->total);
      }
      if($request->str == 'p10') {
        $data = Hotel::where('discount', '>', 10000)->with(['images','features','payments','rent'])->paginate($request->total);
      }
        
      return $data;
      
    } 

    public function getAllHotelFilterCity(Request $request){

      if($request->city != NULL){
        $data = Hotel::where('city', $request->city)->with(['images','features','payments','rent'])->paginate($request->total);
      }
      return $data;
      
    } 

    public function getAllHotelFilterFacility(Request $request){

      $inputArray[] = $request->input('facility');
      //return dd($request->facility);
      $hotelFeatures = HotelFeatures::where('hotel_feature',$request->facility)->select(['hotel_id'])->get();
      
      //return $hotelFeatures;

      if($request->facility != NULL){
        $data = Hotel::whereIn('id', $hotelFeatures)->with(['images','features','payments','rent'])->paginate($request->total);
      }
      elseif($request->city != NULL){
        $data = Hotel::where('city', $request->city)->with(['images','features','payments','rent'])->paginate($request->total);
      }
      return $data;

      // return $inputArray[] = $request->input('facility');

      $facilities = explode(',', $request->facility);
      
    } 

    public function booking(Request $request) {
      $this->validate($request, [
          'inDate' => 'required|date|max:20',
          'outDate' => 'required|date|max:20|after_or_equal:inDate',
          'payment_type' => 'nullable|in:Rocket,Nagad',
          'transction_no' => 'nullable|max:100',
          'terms' => 'required|in:1',
      ], [
          'inDate.required' => 'Please Enter Your Check In Date',
          'outDate.required' => 'Please Enter Your Check Out Date',
          'outDate.after_or_equal' => 'Check-out date must be after or same as check-in date',
          'terms.required' => 'Please tick on Accept Checkbox',
      ]);
  
      $today = now();
      $trasnstion_id = time() . rand(4, 5);
  
      $diff = strtotime($request->outDate) - strtotime($request->inDate);
      $res = round($diff / 86400);  
  
      $order = Order::create([
        'trasnstion_id' => $trasnstion_id,
        'user_id' => Auth::guard('users')->user()->id,
        'user_name' => Auth::guard('users')->user()->name,
        'user_phone' => Auth::guard('users')->user()->mobile,
        'user_email' => Auth::guard('users')->user()->email,
        'no_of_adult' => $request->adult,
        'no_of_child' => $request->child,
        'booking_date' => $today,
        'check_in' => $request->inDate,
        'check_out' => $request->outDate,
        'payment_status' => 'Pending',
        'payment_type' => $request->payment_type,
      ]);
  
      $total_price = 0;
      $backup = 0;
  
      foreach ($request->cartItem as $b) {
          if (!empty($b['price_original'])) {
              $total_price += $b['price_original'] * $b['room_no'];
              $backup += $b['price_original'] * $b['room_no'] * $res;
  
              HotelOrderDetails::create([
                'order_id' => $order->id,
                'hotel_id' => $b['hotel_id'],
                'hotel_name' => $b['hotel_name'],
                'hotel_address' => $b['hotel_address'],
                'hotel_phone' => $b['hotel_phone'],
                'hotel_email' => $b['hotel_email'],
                'room_type' => $b['room_type'],
                'room_no' => $b['room_no'],
                'room_type_price' => $b['price_original'],
                'trasnstion_id' => $trasnstion_id,
              ]);
          }
      }
  
      Order::where('id', $order->id)->update([
          'total_price' => $total_price,
          'backup' => $backup,
      ]);
  
      DB::table('admins')->increment('nt_hotel_order', 1, ['nt_hotel_order_date' => now()]);
      
      return $trasnstion_id;
    }
  

    public function payNowSsl1(Request $request){    

        $rules = [
            'cart_json' => 'required|json',
            'cart_json.cartItem.*.id' => 'required|numeric',
        ];

        $validatedData = $request->validate($rules);

        // If the JSON data passes validation, it will be available as an associative array in $validatedData
        // You can then use $validatedData['cart_json'], $validatedData['adult'], etc. in your code
        
        // Decode the cart_json
        $cartData = json_decode($validatedData['cart_json'], true);
        //return dd($cartData);
       
        $post_data = array();
        $post_data['total_amount'] = $cartData['amount']; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $cartData['transction_id']; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = Auth::guard('users')->user()->name;
        $post_data['cus_email'] = Auth::guard('users')->user()->email;
        if(Auth::guard('users')->user()->permanent_house_number && Auth::guard('users')->user()->permanent_city && Auth::guard('users')->user()->permanent_postal_code){
            $post_data['cus_add1'] = Auth::guard('users')->user()->mobile;
        }else{
            $post_data['cus_add1'] = "No Address Added";
        }
        $post_data['cus_add2'] = "";
        if(Auth::guard('users')->user()->city){
        $post_data['cus_city'] = Auth::guard('users')->user()->city;
        }else{
            $post_data['cus_city'] = "";
        }
        if(Auth::guard('users')->user()->street_name){
        $post_data['cus_state'] = Auth::guard('users')->user()->street_name;
        }else{
            $post_data['cus_state'] = "";
        }
        if(Auth::guard('users')->user()->postal_code){
        $post_data['cus_postcode'] = Auth::guard('users')->user()->postal_code;
        }else{
            $post_data['cus_postcode'] = "";
        }
        $post_data['cus_country'] = "";
        if(Auth::guard('users')->user()->mobile){
            $post_data['cus_phone'] = Auth::guard('users')->user()->mobile;
        }else{
            $post_data['cus_phone'] = "No Number Added";
        }
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = Auth::guard('users')->user()->email;
        if(Auth::guard('users')->user()->permanent_house_number && Auth::guard('users')->user()->permanent_city && Auth::guard('users')->user()->permanent_postal_code){
            $post_data['ship_add1'] = Auth::guard('users')->user()->mobile;
        }else{
            $post_data['ship_add1'] = "No Address Added";
        }
        $post_data['ship_add2'] = "";
        if(Auth::guard('users')->user()->city){
        $post_data['ship_city'] = Auth::guard('users')->user()->city;
        }else{
            $post_data['ship_city'] = "";
        }
        if(Auth::guard('users')->user()->street_name){
        $post_data['ship_state'] = Auth::guard('users')->user()->street_name;
        }else{
            $post_data['ship_state'] = "";
        }
        if(Auth::guard('users')->user()->postal_code){
        $post_data['ship_postcode'] = Auth::guard('users')->user()->postal_code;
        }else{
            $post_data['ship_postcode'] = "";
        }
        if(Auth::guard('users')->user()->mobile){
            $post_data['ship_phone'] = Auth::guard('users')->user()->mobile;
        }else{
            $post_data['ship_phone'] = "No Number Added";
        }
        
        $post_data['ship_country'] = "";

        $post_data['shipping_method'] = $cartData['shipping_method'];
        $post_data['product_name'] = $cartData['product_name'];
        $post_data['product_category'] = $cartData['product_category'];
        $post_data['product_profile'] = $cartData['product_profile'];
 
        $post_data['value_a'] =  Auth::guard('users')->user()->email;
        $post_data['value_b'] =  $cartData['product_name'];
      

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');
        //Session::set('email', Auth::user()->email);
        //session(['email' => Auth::user()->email]);
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success1(Request $request){

      //echo "Transaction is Successful";
      
      $tran_id = $request->input('tran_id');
      $amount = $request->input('amount');
      $currency = $request->input('currency');
      $user_email = $request->input('value_a');
      $p_name = $request->input('value_b');
      
      
      //return dd($p_name);
      $sslc = new SslCommerzNotification();

      #Check order status in order tabel against the transaction id or order id.
      if($p_name == 'Car_Rent'){
        DB::table('admins')->increment('nt_car_order', 1, [
          'nt_car_order_date' => date('j M Y')
        ]);

        $order_details = DB::table('car_orders')
            ->where('extra_three', $tran_id)
            ->select('extra_three', 'payment_status','extra_one')->first();

        if ($order_details->payment_status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('car_orders')
                    ->where('extra_three', $tran_id)
                    ->update(['payment_status' => 'Processing']);
                echo "<br >Transaction is successfully Completed";


                
                $clientEmail =  $amount;
                $orderId= "BTI_C-".$tran_id;
                $status= "Payment_Recived";

                Mail::to($user_email)->send(new OrderStatus($clientEmail, $orderId, $status));

                return redirect('/order-confirmation');
            }
        } else if ($order_details->payment_status == 'Processing' || $order_details->status == 'Complete') {
            /*
            That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
            */
            echo "Transaction is successfully Completed";
            return redirect('/order-confirmation');
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
            return redirect('/car');
        }


      }else{
        DB::table('admins')->increment('nt_hotel_order', 1, [
          'nt_hotel_order_date' => date('j M Y')
        ]);
          
        $order_details = DB::table('orders')
            ->where('trasnstion_id', $tran_id)
            ->select('trasnstion_id', 'payment_status','user_id')->first();

        if ($order_details->payment_status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('trasnstion_id', $tran_id)
                    ->update(['payment_status' => 'Processing']);
                echo "<br >Transaction is successfully Completed";
                
                $clientEmail =  $amount;
                $orderId= "BTI_H-".$tran_id;
                $status= "Payment_Recived";

                Mail::to($user_email)->send(new OrderStatus($clientEmail, $orderId, $status));

                Cart::where('user_id', $order_details->user_id)->delete();
                return redirect('/order-confirmation');
            }
        } else if ($order_details->payment_status == 'Processing' || $order_details->status == 'Complete') {
            /*
            That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
            */
            echo "Transaction is successfully Completed";
            return redirect('/order-confirmation');
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
            return redirect('/hotel-booking');
        }


      }

  }

    public function fail1(Request $request){

      $p_name = $request->input('value_b');
      $tran_id = $request->input('tran_id');

      if ($p_name == 'Car_Rent'){
        DB::table('admins')->increment('nt_car_order', 1, [
          'nt_car_order_date' => date('j M Y')
        ]);

        $order_details = DB::table('car_orders')
            ->where('extra_three', $tran_id)
            ->select('extra_three', 'payment_status','extra_one')->first();

        if ($order_details->payment_status == 'Pending') {
            $update_product = DB::table('car_orders')
                ->where('extra_three', $tran_id)
                ->update(['payment_status' => 'Failed']);
            echo "Transaction is Falied";
            return redirect('/order-failed');
        } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {
            echo "Transaction is already Successful";
            return redirect('/order-confirmation');
        } else {
            echo "Transaction is Invalid";
            return redirect('/order-failed');
        }
      }
      else{
        DB::table('admins')->increment('nt_hotel_order', 1, [
          'nt_hotel_order_date' => date('j M Y')
        ]);

        $order_details = DB::table('orders')
            ->where('trasnstion_id', $tran_id)
            ->select('trasnstion_id', 'payment_status')->first();

        if ($order_details->payment_status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('trasnstion_id', $tran_id)
                ->update(['payment_status' => 'Failed']);
            echo "Transaction is Falied";
            return redirect('/hotel-booking');
        } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {
            echo "Transaction is already Successful";
            return redirect('/order-confirmation');
        } else {
            echo "Transaction is Invalid";
            return redirect('/order-failed');
        }
      }

    }

    public function cancel1(Request $request){

        $tran_id = $request->input('tran_id');
        $p_name = $request->input('value_b');

        if ($p_name == 'Car_Rent'){
          DB::table('admins')->increment('nt_car_order', 1, [
            'nt_car_order_date' => date('j M Y')
          ]);

          $order_details = DB::table('car_orders')
            ->where('extra_three', $tran_id)
            ->select('extra_three', 'payment_status','extra_one')->first();

          if ($order_details->payment_status == 'Pending') {
              $update_product = DB::table('car_orders')
                  ->where('extra_three', $tran_id)
                  ->update(['payment_status' => 'Canceled']);
              echo "Transaction is Cancel";
              return redirect('/order-failed');
          } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {
              echo "Transaction is already Successful";
              return redirect('/order-confirmation');
          } else {
              echo "Transaction is Invalid";
              return redirect('/order-failed');
          }
      }else{

        DB::table('admins')->increment('nt_hotel_order', 1, [
          'nt_hotel_order_date' => date('j M Y')
        ]);

        $order_details = DB::table('orders')
            ->where('trasnstion_id', $tran_id)
            ->select('trasnstion_id', 'payment_status')->first();

        if ($order_details->payment_status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('trasnstion_id', $tran_id)
                ->update(['payment_status' => 'Canceled']);
            echo "Transaction is Cancel";
            return redirect('/hotel-booking');
        } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {
            echo "Transaction is already Successful";
            return redirect('/order-confirmation');
        } else {
            echo "Transaction is Invalid";
            return redirect('/hotel-booking');
        }
      }

    }

    public function ipn1(Request $request){
        #Received all the payement information from the gateway
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $p_name = $request->input('value_b');

        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

          if ($p_name == 'Car_Rent'){
            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('car_orders')
            ->where('extra_three', $tran_id)
            ->select('extra_three', 'payment_status','extra_one')->first();
            
            if ($order_details->payment_status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */

                    $update_product = DB::table('car_orders')
                        ->where('extra_three', $tran_id)
                        ->update(['payment_status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                    return redirect('/order-confirmation');
                }
            } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
                return redirect('/order-confirmation');
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
                return redirect('/order-failed');
            }
          }else{
            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('trasnstion_id', $tran_id)
                ->select('trasnstion_id', 'payment_status')->first();
            
            if ($order_details->payment_status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */

                    $update_product = DB::table('orders')
                        ->where('trasnstion_id', $tran_id)
                        ->update(['payment_status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                    return redirect('/order-confirmation');
                }
            } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
                return redirect('/order-confirmation');
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
                return redirect('/hotel-booking');
            }
          }
            
        } else {
            echo "Invalid Data";
            return redirect('/order-failed');
        }
    }

    public function payNowSsl(Request $request)
    {
      // Validation Rules
      $rules = [
          'cart_json' => 'required|json',
      ];
      
      $validatedData = $request->validate($rules);

      // Decode JSON safely
      $cartData = json_decode($validatedData['cart_json'], true);
      
      // Ensure required keys exist in decoded JSON
      if (!isset($cartData['amount'], $cartData['transction_id'], $cartData['shipping_method'], 
                  $cartData['product_name'], $cartData['product_category'], $cartData['product_profile'])) {
          return response()->json(['error' => 'Invalid cart data'], 400);
      }

      // Get Authenticated User
      $user = Auth::guard('users')->user();

      // Prepare Payment Data
      $post_data = [
          'total_amount'   => $cartData['amount'], // Ensure amount is >= 10
          'currency'       => "BDT",
          'tran_id'        => $cartData['transction_id'], // Must be unique
          'cus_name'       => $user->name ?? 'Unknown',
          'cus_email'      => $user->email ?? 'No Email',
          'cus_add1'       => $user->permanent_house_number && $user->permanent_city && $user->permanent_postal_code ? $user->mobile : "No Address Added",
          'cus_add2'       => "",
          'cus_city'       => $user->city ?? "",
          'cus_state'      => $user->street_name ?? "",
          'cus_postcode'   => $user->postal_code ?? "",
          'cus_country'    => "",
          'cus_phone'      => $user->mobile ?? "No Number Added",
          'cus_fax'        => "",

          // Shipping Information (similar to customer details)
          'ship_name'      => $user->email ?? 'Unknown',
          'ship_add1'      => $user->permanent_house_number && $user->permanent_city && $user->permanent_postal_code ? $user->mobile : "No Address Added",
          'ship_add2'      => "",
          'ship_city'      => $user->city ?? "",
          'ship_state'     => $user->street_name ?? "",
          'ship_postcode'  => $user->postal_code ?? "",
          'ship_country'   => "",
          'ship_phone'     => $user->mobile ?? "No Number Added",
          
          // Product & Transaction Details
          'shipping_method' => $cartData['shipping_method'],
          'product_name'    => $cartData['product_name'],
          'product_category'=> $cartData['product_category'],
          'product_profile' => $cartData['product_profile'],
          'value_a'         => $user->email ?? 'Unknown',
          'value_b'         => $cartData['product_name'],
      ];

      // Initiate SSLCommerz Payment
      $sslc = new SslCommerzNotification();
      $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

      if (!is_array($payment_options)) {
          print_r($payment_options);
      }
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $user_email = $request->input('value_a');
        $p_name = $request->input('value_b');

        if ($p_name == 'Car_Rent') {
            $order = DB::table('car_orders')->where('extra_three', $tran_id)->first();
        } else {
          $order = DB::table('orders')->where('trasnstion_id', $tran_id)->first();
        }

        if ($order && $order->payment_status == 'Pending') {
            DB::table($p_name == 'Car_Rent' ? 'car_orders' : 'orders')
                ->where($p_name == 'Car_Rent' ? 'extra_three' : 'trasnstion_id', $tran_id)
                ->update(['payment_status' => 'Processing']);

            try {
                Mail::to($user_email)->send(new OrderStatus($amount, "BTI_" . ($p_name == 'Car_Rent' ? 'C' : 'H') . "-" . $tran_id, "Payment_Received"));
            } catch (\Exception $e) {
                Log::error("Email sending failed for transaction ID: $tran_id. Error: " . $e->getMessage());
            }
        }

        return redirect('/order-confirmation');
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $p_name = $request->input('value_b');
        $table = $p_name == 'Car_Rent' ? 'car_orders' : 'orders';
        $column = $p_name == 'Car_Rent' ? 'extra_three' : 'trasnstion_id';

        DB::table($table)->where($column, $tran_id)->update(['payment_status' => 'Failed']);
        return redirect('/order-failed');
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $p_name = $request->input('value_b');
        $table = $p_name == 'Car_Rent' ? 'car_orders' : 'orders';
        $column = $p_name == 'Car_Rent' ? 'extra_three' : 'trasnstion_id';

        DB::table($table)->where($column, $tran_id)->update(['payment_status' => 'Canceled']);
        return redirect('/order-failed');
    }

    public function ipn(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $p_name = $request->input('value_b');
        $table = $p_name == 'Car_Rent' ? 'car_orders' : 'orders';
        $column = $p_name == 'Car_Rent' ? 'extra_three' : 'trasnstion_id';
        
        $order = DB::table($table)->where($column, $tran_id)->first();
        if ($order && $order->payment_status == 'Pending') {
            DB::table($table)->where($column, $tran_id)->update(['payment_status' => 'Processing']);
            return redirect('/order-confirmation');
        }
        return redirect('/order-failed');
    }

    

    public function getcartItem(Request $request){
      if(Auth::guard('users')->user()){
        return Cart::where('user_id', Auth::guard('users')->user()->id)->get();
      }

    }

    public function getHistory(Request $request){
      return Order::where('user_id', Auth::guard('users')->user()->id)->get();
    }

    public function deleteCartItem(Request $request){
      //return dd($request);
      return Cart::where('id', $request->id)->delete();
    }

    public function cartItemAdd(Request $request){
      //return dd($request->cartItem);
      foreach($request->cartItem as $b){
        if($b['price'] != ''){
            Cart::updateOrCreate(['room_id' => $b['room_id']],[
            'user_id' => Auth::guard('users')->user()->id,
            'room_id' => $b['room_id'],
            'hotel_id' => $b['hotel_id'],
            'hotel_name' => $b['hotel_name'],
            'hotel_address' => $b['hotel_address'],
            'hotel_phone' => $b['hotel_phone'],
            'hotel_email' => $b['hotel_email'],
            'room_type' => $b['room_type'],
            'room_no' => $b['room_no'],
            'price' => $b['price'],
            'price_original' => $b['price_original'],
          ]);
        }
      }

      return Cart::where('user_id', Auth::guard('users')->user()->id)->get();

    }

    public function rooomNoUpdate(Request $request){
      //return dd($request->price);
      $p = $request->room * $request->price_original;
      Cart::where('id',$request->id)->update([
        'room_no' => $request->room,
        'price_original' => $request->price_original,
        'price' => $p
      ]);

      return Cart::where('user_id', Auth::guard('users')->user()->id)->get();

    }

    public function footerMail(Request $request){
      $this->validate($request,[
        'user_name' => 'required',
        'user_email' => 'required',
        'message' => 'required'
      ]);

      $name= $request->user_name;
      $email= $request->user_email;
      $msg= $request->message;
        
      $send_mail = "besttourinfo.com@gmail.com";

      Mail::to($send_mail)->send(new MailNotify($name, $email, $msg));
      return "Mail Send";

    }

    public function ContactMail(Request $request){
      $this->validate($request,[
        'name' => 'required|max:50',
        'email' => 'required|email|max:50',
        'msg' => 'required|max:100',
        'phone' => 'max:20'
      ]);
        
      try {
        $name= $request->name;
        $email= $request->email;
        $msg= $request->msg;
        $phone= $request->phone;
        $send_mail = "besttourinfo.com@gmail.com";
        Mail::to($send_mail)->send(new ContactMail($name, $email, $msg, $phone));
        $status = 'Success';
      } catch (\Exception $e) {
          Log::error("Email sending failed". $e->getMessage());
          $status = 'Failed';
      };
  
      EmailLog::create([
          'name' => $request->name,
          'email' => $request->email,
          'otp' => $request->msg,
          'status' =>  $status,
          'date' => now()->format('d M Y - h:i A')
      ]);
  
      return $status === 'Success' ? "Success" : "Failed";

    }

    public function oderMail(Request $request){
      try {
        $clientName= $request->clientName;
        $clientEmail= $request->clientEmail;
        $clientPhone= $request->clientPhone;
        $subTotal= $request->sub;
        $adult= $request->adult;
        $child= $request->child;
        $booking_date= $request->booking_date;
        $inDate= $request->inDate;
        $outDate= $request->outDate;
        $payment_type= $request->payment_type;
        $transction_no= $request->transction_no;
        $allHotel = $request->cartItem;    
        $tarns = $request->tarns;    
        $send_mail = "salesatbti@gmail.com";
        Mail::to($send_mail)->send(new MailOrder($tarns, $clientName, $clientEmail, $clientPhone, $subTotal, $adult, $child, $booking_date, $inDate, $outDate, $payment_type,$transction_no,$allHotel));
        $status = 'Success';
      } catch (\Exception $e) {
          Log::error("Email sending failed". $e->getMessage());
          $status = 'Failed';
      };
  
      EmailLog::create([
          'name' => "Hotel Order Mail Admin",
          'email' => $send_mail,
          'otp' => "Hotel Order ID: " .$request->tarns,
          'status' =>  $status,
          'date' => now()->format('d M Y - h:i A')
      ]);
  
      return $status === 'Success' ? "Success" : "Failed";

    }

    public function statusMailClient(Request $request){

      try {
        $send_mail= $request->clientEmail;
        $clientEmail= $request->clientEmail;
        $orderId= $request->orerId;
        $status= $request->status;
        Mail::to($send_mail)->send(new OrderStatus($clientEmail, $orderId, $status));
        $status = 'Success';
      } catch (\Exception $e) {
          Log::error("Email sending failed". $e->getMessage());
          $status = 'Failed';
      };
  
      EmailLog::create([
          'name' => $request->clientName,
          'email' => $request->clientEmail,
          'otp' => "Hotel Order ID: " .$request->orerId,
          'status' =>  $status,
          'date' => now()->format('d M Y - h:i A')
      ]);
  
      return $status === 'Success' ? "Success" : "Failed";

    }

    public function oderMailClient(Request $request){
      try {
        $clientName= $request->clientName;
        $clientEmail= $request->clientEmail;
        $clientPhone= $request->clientPhone;
        $subTotal= $request->sub;
        $adult= $request->adult;
        $child= $request->child;
        $booking_date= $request->booking_date;
        $inDate= $request->inDate;
        $outDate= $request->outDate;
        $payment_type= $request->payment_type;
        $transction_no= $request->transction_no;
        $allHotel = $request->cartItem;    
        $send_mail = $request->clientEmail;
        $tarns = $request->tarns;
        Mail::to($send_mail)->send(new ClientMail($tarns,$clientName, $clientEmail, $clientPhone, $subTotal, $adult, $child, $booking_date, $inDate, $outDate, $payment_type,$transction_no,$allHotel));
        $status = 'Success';
      } catch (\Exception $e) {
          Log::error("Email sending failed". $e->getMessage());
          $status = 'Failed';
      };
  
      EmailLog::create([
          'name' => $request->clientName,
          'email' => $request->clientEmail,
          'otp' => "Hotel Order ID: " .$request->tarns,
          'status' =>  $status,
          'date' => now()->format('d M Y - h:i A')
      ]);
  
      return $status === 'Success' ? "Success" : "Failed";

    }

    public function topAdsUpdate(Request $request){
      
      if($request->ad_one){
        TopTwoAds::where('id',1)->update([
          'ad_one' => $request->ad_one,
          
        ]);
      }
      
      if($request->ad_two){
        TopTwoAds::where('id',1)->update([
          'ad_two' => $request->ad_two,
          
        ]);
      }
      
      if($request->ad_three){
        TopTwoAds::where('id',1)->update([
          'ad_three' => $request->ad_three,
          
        ]);
      }
      
      if($request->ad_four){
        TopTwoAds::where('id',1)->update([
          'ad_four' => $request->	ad_four,
        
        ]);
      }

      return TopTwoAds::orderBy('id', 'desc')->get();

    }

    public function getTopTwo(Request $request){

     return TopTwoAds::orderBy('id', 'desc')->get();

    }

    public function deleteHtmlAds(Request $request){

      //return dd($request->value);
      if($request->value == 1){
        TopTwoAds::where('id',1)->update([
          'ad_one' => null,
        ]);
      }
      
      if($request->value == 2){
        TopTwoAds::where('id',1)->update([
          'ad_two' => null,
        ]);
      }
      
      if($request->value == 3){
        TopTwoAds::where('id',1)->update([
          'ad_three' => null,
        ]);
      }
      
      if($request->value == 4){
        TopTwoAds::where('id',1)->update([
          'ad_four' => null,
        ]);
      }

      return TopTwoAds::orderBy('id', 'desc')->get();
      

      //TopTwoAds::where('id', 1)->delete();

    }

    public function storeMutipleAds(Request $request){
      //return dd($request->Hotel_Images);
      if(count($request->Hotel_Images)){
        foreach($request->Hotel_Images as $uploadFile){
          $path = '/multiple_ads/';
          $picName = $path.$uploadFile->getClientOriginalName();
          $url = $picName;
          $uploadFile->move(public_path('multiple_ads'),$picName);
          $im[] =$url; 
        } 
      }
      
      $all = [];

      foreach($im as $img){
        array_push($all, [
          'ads_id' => $request->ads_id,
          'ads_path' => $img
        ]);
      }

      return MultipleAds::insert($all);
    }

    public function getAds(Request $request){
      return MultipleAds::orderBy('id', 'desc')->get();
    }

    public function deleteAds(Request $request){
      //return dd($request->id);
      $fileName = $request->ads_path;
      $path = public_path();
      $filePath = $path.$fileName;
      if(file_exists($filePath)){
        @unlink($filePath);
      }
      MultipleAds::where('id', $request->id)->delete();
      return MultipleAds::orderBy('id', 'desc')->get();
    }

    public function getSingleBlogData(Request $request){
      $id = Blog::latest()->first()->id;
      return Blog::with(['images'])->where('id',$id)->get();
    }

    public function getSingleBlog(Request $request){
      $id = $request->id;
      $data = Blog::with(['images'])->where('id',$id)->get();
      return $data;
    }

    public function getSingleBlogHotel(Request $request){
      return Hotel::with(['rent'])->where('city',$request->str)->paginate($request->total);
    }

    public function getBlogImagesLast(Request $request){
      $id = Blog::latest()->first()->id;
      return BlogImage::where('blog_id',$id)->get();
    }

    public function getBlogImages(Request $request){
      
      return BlogImage::where('blog_id',$request->id)->get();
     
    }

    public function createAbout(Request $request){
      
      //return dd($request->jsonData);
      $ab =  About::where('id', 1)->update([
        'text' => $request->jsonData,
      ]);

      return $ab;
     
    }

    public function getAbout(Request $request){
      
      return About::where('id',1)->get();
     
    }

    public function uploadCk(Request $request){
      
      if($request->hasFile('upload')) {
        $originalName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originalName,PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName.'_'.time().'.'.$extension;
      
        $request->file('upload')->move(public_path('uploads'),$fileName);
      
        $url = asset('uploads/' . $fileName);
      
        return response()->json([
          'fileName' => $fileName,
          'uploaded' => 1,
          'url' => $url
        ]);
      }
     
    }

    public function addTerms(Request $request){  
      $request->validate([
        'text' => 'required',
      ]);
  
      TandC::create([
          'title' => $request->title,
          'text' => $request->text,
      ]);
  
      return TandC::orderBy('id','desc')->paginate($request->total);
      
    }

    public function getALLTerms(Request $request){  
      return TandC::orderBy('id','desc')->paginate($request->total);
    }

    public function deleteTerms(Request $request){  
      TandC::where('id', $request->id)->delete();
    }

    public function updateTerms(Request $request){  
      $this->validate($request,[
        'text' => 'required',
      ]);
    
      TandC::where('id',$request->id)->update([
        'title' => $request->title,
        'text' => $request->text,
      ]);
  
      return TandC::orderBy('id','desc')->paginate($request->total);
    }

    public function addPrivacy(Request $request){  
      $request->validate([
        'text' => ['required'],
      ]);
  
      Privacy::create([
          'title' => $request->title,
          'text' => $request->text,
      ]);
  
      //return TandC::orderBy('id','desc')->paginate($request->total);
      
    }

    public function getALLPrivacy(Request $request){  
      return Privacy::orderBy('id','desc')->paginate($request->total);
    }

    public function deletePrivacy(Request $request){  
      Privacy::where('id', $request->id)->delete();
    }

    public function updatePrivacy(Request $request){  
      $this->validate($request,[
        'text' => 'required',
      ]);
    
      Privacy::where('id',$request->id)->update([
        'title' => $request->title,
        'text' => $request->text,
      ]);
  
      //return TandC::orderBy('id','desc')->paginate($request->total);
    }

    public function addRefund(Request $request){  
      $request->validate([
        'text' => ['required'],
      ]);
  
      Refund::create([
          'title' => $request->title,
          'text' => $request->text,
      ]);
  
      //return TandC::orderBy('id','desc')->paginate($request->total);
      
    }

    public function getALLRefund(Request $request){  
      return Refund::orderBy('id','desc')->paginate($request->total);
    }

    public function deleteRefund(Request $request){  
      Refund::where('id', $request->id)->delete();
    }

    public function updateRefund(Request $request){  
      $this->validate($request,[
        'text' => 'required',
      ]);
    
      Refund::where('id',$request->id)->update([
        'title' => $request->title,
        'text' => $request->text,
      ]);
  
      //return TandC::orderBy('id','desc')->paginate($request->total);
    }

    public function addFaq(Request $request){  
      $request->validate([
        'text' => ['required'],
        'title' => ['required']
      ]);
  
      Faq::create([
          'title' => $request->title,
          'text' => $request->text,
      ]);
  
      //return TandC::orderBy('id','desc')->paginate($request->total);
      
    }

    public function getALLFaq(Request $request){  
      return Faq::orderBy('id','asc')->paginate($request->total);
    }

    public function deleteFaq(Request $request){  
      Faq::where('id', $request->id)->delete();
    }

    public function updateFaq(Request $request){  
      $this->validate($request,[
        'title' => 'required',
        'text' => 'required',
      ]);
    
      Faq::where('id',$request->id)->update([
        'title' => $request->title,
        'text' => $request->text,
      ]);
  
      //return TandC::orderBy('id','desc')->paginate($request->total);
    }

    public function getAllPolicies(Request $request){  
      return Privacy::all();
    }

    public function getAllRefunds(Request $request){  
      return Refund::all();
    }

    public function getAllConditons(Request $request){  
      return TandC::all();
    }

    public function getAllFaqs(Request $request){  
      return Faq::all();
    }

    public function getVat(Request $request){  
      return vatTax::all();
    }

    public function updateHotelVat(Request $request){  
      $this->validate($request,[
        'hotelVat' => 'required',
      ]);
    
      vatTax::where('id',$request->id)->update([
        'hotel_vat' => $request->hotelVat,
      ]);

      // vatTax::updateOrCreate([
      //   'id' => 1,
      // ],[
      //   'hotel_vat' => $request->hotelVat,
      // ]);
    }

    public function updateCarVat(Request $request){  
      $this->validate($request,[
        'carVat' => 'required',
      ]);
    
      vatTax::where('id',$request->id)->update([
        'car_vat' => $request->carVat,
      ]);
    }
}
