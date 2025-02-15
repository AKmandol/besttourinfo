<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\CarDriver;
use App\Models\Destination;
use App\Models\carOrder;
use App\Models\EmailLog;
use App\Models\vatTax;
use Illuminate\Support\Facades\Mail;
use App\Mail\CarOrderAdmin;
use App\Mail\CarOrderClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{
    public function uploadTitleImage(Request $request){

        $this->validate($request,[
            'file' => 'required|mimes:jpg,png,jpeg'
        ]);

        $picName = time().'.'.$request->file->extension();
        $request->file->move(public_path('car_title_image'),$picName);
        return $picName;
    }

    public function uploadDriverImage(Request $request){

        $this->validate($request,[
            'file' => 'required|mimes:jpg,png,jpeg'
        ]);

        $picName = time().'.'.$request->file->extension();
        $request->file->move(public_path('car_driver_image'),$picName);
        return $picName;
    }

    public function uploadLicenseImage(Request $request){

        $this->validate($request,[
            'file' => 'required|mimes:jpg,png,jpeg'
        ]);

        $pic = time().'.'.$request->file->extension();
        $request->file->move(public_path('driver_license_image'),$pic);
        return $pic;
    }



    public function storeCar(Request $request){

        $this->validate($request,[
            'car_type' => 'required',
            'title_image' => 'required'
        ]);

        return Car::create([
            'car_type' => $request->car_type,
            'title_image' => $request->title_image,
        ]);
    
    }

    public function getAllCar(Request $request){
        if($request->total){
            return Car::orderBy('id','desc')->paginate($request->total);
        }else{
            return Car::orderBy('id','desc')->get();
        }
    }

    public function deleteCar(Request $request){

        $fileName = $request->title_image;
        $filePath = public_path().$fileName;
        if(file_exists($filePath)){
             @unlink($filePath);
        }
        
        Car::where('id', $request->id)->delete();

    }

    public function updateCar(Request $request){

        $this->validate($request,[
            'car_type' => 'required',
            'title_image' => 'required'
        ]);

        return Car:: where('id',$request->id)->update([
            'car_type' => $request->car_type,
            'title_image' => $request->title_image
        ]);

    }


    
    public function storeDriver(Request $request){

        $this->validate($request,[
            'driver_name' => 'required',
            'driver_phone' => 'required',
            'driver_address' => 'required',
            'driver_age' => 'required',
            'driver_car_type' => 'required',
            'driver_nid_no' => 'required',
            'driver_img' => 'required',
            'driver_license' => 'required',
            'driver_license_img' => 'required',
        ]);

        return CarDriver::create([
            'driver_name' => $request->driver_name,
            'driver_phone' => $request->driver_phone,
            'driver_email' => $request->driver_email,
            'driver_address' => $request->driver_address,
            'driver_age' => $request->driver_age,
            'driver_car_type' => $request->driver_car_type,
            'driver_nid_no' => $request->driver_nid_no,
            'driver_img' => $request->driver_img,
            'driver_license' => $request->driver_license,
            'driver_license_img' => $request->driver_license_img,
        ]);
    
    }

    public function getAllDriver(Request $request){
        if($request->total){
            return CarDriver::orderBy('id','desc')->paginate($request->total);
        }else{
            return CarDriver::orderBy('id','desc')->get();
        }
    }

    public function getCarByType(Request $request){
        return CarDriver::where('driver_car_type', $request->carType)->orderBy('id','desc')->paginate($request->total);
    }

    public function deleteDriver(Request $request){

        $fileName = $request->driver_img;
        $filePath = public_path().$fileName;
        if(file_exists($filePath)){
             @unlink($filePath);
        }

        $fileName2 = $request->driver_license_img;
        $filePath2 = public_path().$fileName2;
        if(file_exists($filePath2)){
             @unlink($filePath2);
        }
        
        CarDriver::where('id', $request->id)->delete();

    }

    
    public function updateDriver(Request $request){

        $this->validate($request,[
            'driver_name' => 'required',
            'driver_phone' => 'required',
            'driver_address' => 'required',
            'driver_age' => 'required',
            'driver_car_type' => 'required',
            'driver_nid_no' => 'required',
            'driver_img' => 'required',
            'driver_license' => 'required',
            'driver_license_img' => 'required',
        ]);

        return CarDriver:: where('id',$request->id)->update([
            'driver_name' => $request->driver_name,
            'driver_phone' => $request->driver_phone,
            'driver_email' => $request->driver_email,
            'driver_address' => $request->driver_address,
            'driver_age' => $request->driver_age,
            'driver_car_type' => $request->driver_car_type,
            'driver_nid_no' => $request->driver_nid_no,
            'driver_img' => $request->driver_img,
            'driver_license' => $request->driver_license,
            'driver_license_img' => $request->driver_license_img,
        ]);

    }

    
    public function storeDestination(Request $request){

        $this->validate($request,[
            'extra_one' => 'required|unique:destinations',
            'pick_up_location' => 'required',
            'drop_off_location' => 'required',
            'car_type' => 'required',
            'between_location' => 'required',
            'cost' => 'required',
        ]);

        $car = Car::where('car_type', $request->car_type)->get();

        return Destination::create([
            'extra_one' => $request->extra_one,
            'extra_two' => $car[0]['title_image'],
            'pick_up_location' => $request->pick_up_location,
            'drop_off_location' => $request->drop_off_location,
            'car_type' => $request->car_type,
            'cost' => $request->cost,
        ]);
    
    }

    public function getAllDestination(Request $request){
        if($request->total){
            return Destination::orderBy('id','desc')->paginate($request->total);
        }else{
            return Destination::orderBy('id','desc')->get();
        }
    }

    public function deleteDestination(Request $request){

        Destination::where('id', $request->id)->delete();

    }

    public function updateDestination(Request $request){

        $this->validate($request,[
            'extra_one' => 'required',
            'pick_up_location' => 'required',
            'drop_off_location' => 'required',
            'car_type' => 'required',
            'cost' => 'required',
        ]);

        $car = Car::where('car_type', $request->car_type)->get();

        return Destination:: where('id',$request->id)->update([
            'extra_one' => $request->extra_one,
            'extra_two' => $car[0]['title_image'],
            'pick_up_location' => $request->pick_up_location,
            'drop_off_location' => $request->drop_off_location,
            'car_type' => $request->car_type,
            'between_location' => $request->between_location,
            'cost' => $request->cost,
        ]);

    }

    public function carOrder(Request $request){

        $this->validate($request,[
            'destination' => 'required',
            'pick_up_date' => 'required',
        ]);

    }

    public function carOrderConfirm(Request $request){

        $this->validate($request,[
            'terms' => 'required|in:1',
          ],
          [
            'terms.required' =>'Please tick on Accept Checkbox',
          ]
          );

        $vat = vatTax::where('id', 1)->get();
        $trasnstion_id = time().rand(4,5);

        if(!empty($request->drop_off)){
            $total = $request->booking[0]['cost'] * 2 + (($request->booking[0]['cost'] / 100) * $vat[0]['car_vat']);
        }else{
            $total = $request->booking[0]['cost'] + (($request->booking[0]['cost'] / 100) * $vat[0]['car_vat']);
        }

        $data_obj = [
            'total' => $total,
            'trasnstion_id' => $trasnstion_id
        ];
        //return dd($vat);
        foreach($request->booking as $a){

            carOrder::create([
                'car_driver_id' => 0,
                'extra_three' => $trasnstion_id,
                'extra_one' => Auth::guard('users')->user()->id,
                'extra_two' =>$a['cost'] + (($a['cost'] / 100) * $vat[0]['car_vat']),
                'user_name' => Auth::guard('users')->user()->name,
                'user_phone' => Auth::guard('users')->user()->mobile,
                'user_email' => Auth::guard('users')->user()->email,
                'packeage_name' => $a['extra_one'],
                'pick_up_location' => $a['pick_up_location'],
                'drop_off_location' => $a['drop_off_location'],
                'pick_up_date' => $request->pick_up,
                'drop_off_date' => $request->drop_off,
                'car_type' => $a['car_type'],
                'location_between' => $a['between_location'],
                'cost' => $a['cost'],
                'payment_status' => 'Pending',
            ]);

        }
        DB::table('admins')->increment('nt_car_order', 1, ['nt_car_order_date' => now()]);
        return  $data_obj;
    }


    public function editCarOrder(Request $request){

        $vat = vatTax::where('id', 1)->get();
        //return dd($vat);
    
        carOrder::where('id',$request->id)->update([
            'extra_two' =>$request->cost + (($request->cost / 100) * $vat[0]['car_vat']),
            'pick_up_location' => $request->pick_up_location,
            'drop_off_location' => $request->drop_off_location,
            'pick_up_date' => $request->pick_up,
            'drop_off_date' => $request->drop_off,
            'cost' => $request->cost,
            'payment_status' => 'Pending',
        ]);

        
    }

    public function gatCarOrder(Request $request){

        if($request->total){
            return carOrder::orderBy('id','desc')->paginate($request->total);
        }else{
            return carOrder::orderBy('id','desc')->where('extra_one', Auth::guard('users')->user()->id)->get();
        }
        
    }

    public function gatCarDriver(Request $request){
        return CarDriver::where('id', $request->id)->get();
    }

    public function gatCarDriverOrder(Request $request){
        return CarDriver::where('id', $request->id)->get();
    }

    public function deleteCarOrder(Request $request){
        carOrder::where('id', $request->order_id)->delete();
    }

    public function deleteCarOrderAdmin(Request $request){
        carOrder::where('id', $request->id)->delete();
        return carOrder::orderBy('id','desc')->paginate(3);
    }

    public function updateCarOrder(Request $request){
        $this->validate($request,[
            'pick_up_location' => 'required',
            'drop_off_location' => 'required',
        ]);

         if($request->drop_off){
            $cost = $request->cost * 2;
         }else{
            $cost = $request->cost;
         }
       

        return carOrder:: where('id',$request->id)->update([
            'pick_up_date' => $request->pick_up,
            'drop_off_date' => $request->drop_off,
            'pick_up_location' => $request->pick_up_location,
            'drop_off_location' => $request->drop_off_location,
            'extra_two' => $cost
        ]);
    }

    

    public function carStatusChange(Request $request){
        $this->validate($request,[
            'status' => 'required',
        ]);

        return carOrder:: where('id',$request->id)->update([
            'payment_status' => $request->status,
        ]);
    }

    public function updateAssignDriver(Request $request){
    
        return carOrder:: where('id',$request->id)->update([
            'car_driver_id' => $request->driver_id,
        ]);
    }

    public function removeAssignDriver(Request $request){
    
        return carOrder:: where('id',$request->id)->update([
            'car_driver_id' => 0,
        ]);
    }

    public function carOrderMailAdmin(Request $request){
        try {
            $request->pick_up = date("D F j, Y, g:i a");
            if($request->drop_off){
                $request->drop_off = date("D F j, Y, g:i a");
            }

            $trans= $request->trans;
            $pick_up= $request->pick_up;
            $drop_off= $request->drop_off;
            $booking= $request->booking;
    
            $send_mail = "salesatbti@gmail.com";
            Mail::to($send_mail)->send(new CarOrderAdmin($pick_up,$drop_off,$booking,$trans));
            $status = 'Success';
          } catch (\Exception $e) {
              Log::error("Email sending failed". $e->getMessage());
              $status = 'Failed';
        };
      
        EmailLog::create([
            'name' => "Car Order Mail Admin",
            'email' => $send_mail,
            'otp' =>  "Car Order ID: " .$request->trans,
            'status' =>  $status,
            'date' => now()->format('d M Y - h:i A')
        ]);
    
        return $status === 'Success' ? "Success" : "Failed";
  
    }

    public function carOrderMailClient(Request $request){

        try {
            $request->pick_up = date("D F j, Y, g:i a");
        if($request->drop_off){
            $request->drop_off = date("D F j, Y, g:i a");
        }

        $trans= $request->trans;
        $pick_up= $request->pick_up;
        $drop_off= $request->drop_off;
        $booking= $request->booking;
        $send_mail = $request->clientEmail;

        Mail::to($send_mail)->send(new CarOrderClient($pick_up,$drop_off,$booking,$trans));
        $status = 'Success';
        } catch (\Exception $e) {
            Log::error("Email sending failed". $e->getMessage());
            $status = 'Failed';
        };
    
        EmailLog::create([
            'name' => Auth::guard('users')->user()->name,
            'email' => $request->clientEmail,
            'otp' =>  "Car Order ID: " .$request->trans,
            'status' =>  $status,
            'date' => now()->format('d M Y - h:i A')
        ]);
    
        return $status === 'Success' ? "Success" : "Failed";
 

    }

}
