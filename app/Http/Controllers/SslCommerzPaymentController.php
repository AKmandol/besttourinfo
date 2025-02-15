<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Order;
use App\Models\Cart;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "trasnstion_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = Auth::user()->name;
        $post_data['cus_email'] = Auth::user()->email;
        $post_data['cus_add1'] = Auth::user()->permanent_house_number." ".Auth::user()->permanent_city."-".Auth::user()->permanent_postal_code;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = Auth::user()->city;
        $post_data['cus_state'] = Auth::user()->street_name;
        $post_data['cus_postcode'] = Auth::user()->postal_code;
        $post_data['cus_country'] = "";
        $post_data['cus_phone'] = Auth::user()->mobile;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = Auth::user()->email;
        $post_data['ship_add1'] = Auth::user()->permanent_house_number." ".Auth::user()->permanent_city."-".Auth::user()->permanent_postal_code;
        $post_data['ship_add2'] = "";
        $post_data['ship_city'] = Auth::user()->city;
        $post_data['ship_state'] = Auth::user()->street_name;;
        $post_data['ship_postcode'] = Auth::user()->postal_code;
        $post_data['ship_phone'] = Auth::user()->mobile;
        $post_data['ship_country'] = "";

        $post_data['shipping_method'] = "";
        $post_data['product_name'] = "";
        $post_data['product_category'] = "";
        $post_data['product_profile'] = "";

        // # OPTIONAL PARAMETERS
        // $post_data['value_a'] = "ref001";
        // $post_data['value_b'] = "ref002";
        // $post_data['value_c'] = "ref003";
        // $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('trasnstion_id', $post_data['tran_id'])
            ->updateOrInsert([
                'user_name' => $post_data['cus_name'],
                'user_email' => $post_data['cus_email'],
                'user_phone' => $post_data['cus_phone'],
                'total_price' => $post_data['total_amount'],
                'payment_status' => 'Pending',
                //'address' => $post_data['cus_add1'],
                'trasnstion_id' => $post_data['tran_id'],
                //'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request )
    {    

        $rules = [
            'cart_json' => 'required|json',
            'cart_json.cartItem.*.id' => 'required|numeric',
            'cart_json.cartItem.*.user_id' => 'required|numeric',
        ];

        $validatedData = $request->validate($rules);

        // If the JSON data passes validation, it will be available as an associative array in $validatedData
        // You can then use $validatedData['cart_json'], $validatedData['adult'], etc. in your code
        
        // Decode the cart_json
        $cartData = json_decode($validatedData['cart_json'], true);
       //return dd($cartData['amount']);
       
        $post_data = array();
        $post_data['total_amount'] = $cartData['amount']; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $cartData['transction_id']; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = Auth::user()->name;
        $post_data['cus_email'] = Auth::user()->email;
        if(Auth::user()->permanent_house_number && Auth::user()->permanent_city && Auth::user()->permanent_postal_code){
            $post_data['cus_add1'] = Auth::user()->mobile;
        }else{
            $post_data['cus_add1'] = "No Address Added";
        }
        $post_data['cus_add2'] = "";
        if(Auth::user()->city){
        $post_data['cus_city'] = Auth::user()->city;
        }else{
            $post_data['cus_city'] = "";
        }
        if(Auth::user()->street_name){
        $post_data['cus_state'] = Auth::user()->street_name;
        }else{
            $post_data['cus_state'] = "";
        }
        if(Auth::user()->postal_code){
        $post_data['cus_postcode'] = Auth::user()->postal_code;
        }else{
            $post_data['cus_postcode'] = "";
        }
        $post_data['cus_country'] = "";
        if(Auth::user()->mobile){
            $post_data['cus_phone'] = Auth::user()->mobile;
        }else{
            $post_data['cus_phone'] = "No Number Added";
        }
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = Auth::user()->email;
        if(Auth::user()->permanent_house_number && Auth::user()->permanent_city && Auth::user()->permanent_postal_code){
            $post_data['ship_add1'] = Auth::user()->mobile;
        }else{
            $post_data['ship_add1'] = "No Address Added";
        }
        $post_data['ship_add2'] = "";
        if(Auth::user()->city){
        $post_data['ship_city'] = Auth::user()->city;
        }else{
            $post_data['ship_city'] = "";
        }
        if(Auth::user()->street_name){
        $post_data['ship_state'] = Auth::user()->street_name;
        }else{
            $post_data['ship_state'] = "";
        }
        if(Auth::user()->postal_code){
        $post_data['ship_postcode'] = Auth::user()->postal_code;
        }else{
            $post_data['ship_postcode'] = "";
        }
        if(Auth::user()->mobile){
            $post_data['ship_phone'] = Auth::user()->mobile;
        }else{
            $post_data['ship_phone'] = "No Number Added";
        }
        
        $post_data['ship_country'] = "";

        $post_data['shipping_method'] = $cartData['shipping_method'];
        $post_data['product_name'] = $cartData['product_name'];
        $post_data['product_category'] = $cartData['product_category'];
        $post_data['product_profile'] = $cartData['product_profile'];
 

        //return dd($post_data);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');
        Session::set('email', Auth::user()->email);
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        //echo "Transaction is Successful";
        return dd(Session::get('email'));

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('trasnstion_id', $tran_id)
            ->select('trasnstion_id', 'payment_status', 'user_id')->first();
            //return dd($order_details);
        

            if ($order_details->payment_status == 'Pending') {
                $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

                if ($validation) {
                    /*
                    That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successfull transaction to customer
                    */
                    // $update_product = DB::table('orders')
                    //     ->where('trasnstion_id', $tran_id)
                    //     ->update(['payment_status' => 'Processing']);
                    Order::where('trasnstion_id', $tran_id)->update([
                        'payment_status' => 'Processing'
                    ]);

                    //echo "<br >Transaction is successfully Completed";
                    //Cart::where('user_id', $order_details->user_id)->delete();
                    return redirect('/profile');
                }
            } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {
                /*
                That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
                */
                return redirect('/profile');
            } else {
                #That means something wrong happened. You can redirect customer to your product page.
                return redirect()->back();
            }
            
        


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('trasnstion_id', $tran_id)
            ->select('trasnstion_id', 'payment_status')->first();

        if ($order_details->payment_status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('trasnstion_id', $tran_id)
                ->update(['payment_status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('trasnstion_id', $tran_id)
            ->select('trasnstion_id', 'payment_status')->first();

        if ($order_details->payment_status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('trasnstion_id', $tran_id)
                ->update(['payment_status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order = DB::table('orders')
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
                    Order::where('trasnstion_id', $tran_id)->update([
                        'payment_status' => 'Processing'
                    ]);
                    // $update_product = DB::table('orders')
                    //     ->where('trasnstion_id', $tran_id)
                    //     ->update(['payment_status' => 'Processing']);

                    // echo "Transaction is successfully Completed";
                }
            } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
            
        } else {
            echo "Invalid Data";
        }
    }

}
