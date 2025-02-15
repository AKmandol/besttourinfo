<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Hotel;
use App\Models\LoginRecord;
use App\Models\EmailLog;
use App\Models\Destination;
use App\Models\Car;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendConfirmation;
use App\Mail\SendEmailSidebar;
use App\Models\carOrder;
use App\Models\SubscriberList;
use App\Models\Blog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;
use App\Rules\OnlyGender;
use Illuminate\Support\Facades\Validator;;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;


//use Cookie;



class AdminController extends Controller
{
  
  public function index(Request $request){

    if(Auth::guard('users')->check() && $request->path() == 'user-login'){
      return redirect('/profile');
    }
    return view('home');
  }
  
  public function getDashboard(){

    $admin = User::where('socialType', '=', 'admin')->count();
    $user = User::where('userType', '=', 'user')->count();
    $editor = User::where('socialType', '=', 'editor')->count();
    $subscriberList = SubscriberList::count();
    $hotel = Hotel::count();
    $hotelOrder = Order::count();
    $car = Car::count();
    $carOrder = carOrder::count();
    $blog = Blog::count();

    return response()->json([
      'admin' =>$admin,
      'editor' =>$editor,
      'user' =>$user,
      'subscriberList' =>$subscriberList,
      'hotel' => $hotel, 
      'hotelOrder' =>$hotelOrder,
      'car' =>$car,
      'carOrder' =>$carOrder,
      'blog' =>$blog
    ]);

  }
  
  public function admin(Request $request){
    if(!Auth::guard('admins')->check() && $request->path() == 'admin-login'){
      return view('adminRoot');
    }

    if(Auth::guard('admins')->check() && $request->path() == 'admin-login'){
      return redirect('/dashboard');
    }
    return view('adminRoot');
  }


  public function adminLogin(Request $request){

    $this->validate($request, [
        'email' => 'bail|required|email',
        'password' => 'bail|required|min:6'
    ]);

    if (Auth::guard('admins')->attempt([
        'email' => $request->email,
        'password' => $request->password,
        'isActivated' => '1',
        'role' => 'admin'
    ])) {

      $request->session()->regenerate();

      $user = Auth::guard('admins')->user();

      if($user->userType == 'editor'){
        $userType = 'Editor';
      }elseif($user->userType == 'super'){
        $userType = 'Admin *';
      }else{
        $userType = 'Admin';
      }

      LoginRecord::create([
          'email' => $user->email,
          'user_type' => $userType,
          'ip' => $request->ip(),
          'date' => now()->format('d M Y - h:i A')
      ]);

      return response()->json([
          'msg' => $user->name . ' You Are logged In..'
      ]);

    } else {
        return response()->json([
            'msg' => 'You are not allowed to login'
        ], 401);
    }
  }


  
    public function adminLogout(Request $request){

      Auth::guard('admins')->logout();
      $request->session()->forget('admin_guard_session_key');
      $request->session()->regenerateToken();
      return redirect('/');

    }

  public function forgotPassword(Request $request){

    $request->validate([
      'forgot_email' => [
        'required',
          Rule::exists('users', 'email'), // 'users' is the table name, 'id' is the column name
        ],
            // 'forgot_email' => ['required','email','max:150'],
      ],
      [
        'forgot_email.exists' => 'This email address does not exists. Please enter your correct Email address'
      ]
    );

    try {
      $confirmationEmail = $request->forgot_email;
      $confirmationCode = $request->confirmation_code;
      Mail::to($confirmationEmail)->send(new SendConfirmation($confirmationCode));
      $status = 'Success';
    } catch (\Exception $e) {
        Log::error("Email sending failed". $e->getMessage());
        $status = 'Failed';
    };

    EmailLog::create([
        'name' => "Password Reset",
        'email' => $request->forgot_email,
        'otp' => $request->confirmation_code,
        'status' => $status,
        'date' => now()->format('d M Y - h:i A')
    ]);

    return $status === 'Success' ? "Success" : "Failed";

  }

  public function cngPassword(Request $request){

    $request->validate([
        'confirmation_code_match' => ['required','same:confirmation_code'],
      ],
      [
        'confirmation_code_match.same' => 'Confirmation code dose not match. Please Check your Email and try again.'
      ]
    );
   
  }

  public function confirmcngPassword(Request $request){

    $request->validate([
        'changedPassword' => ['required','same:cpassword'],
        'cpassword' => ['required','same:changedPassword'],
      ],
      [
        'changedPassword.required' => 'This field is required.',
        'cpassword.required' => 'This field is required.',
        'changedPassword.same' => 'Both password field needed to be same.Please type again.',
      ]
    );

    User::where('email', $request->forgot_email)->update([
      'password' => Hash::make($request->changedPassword),
    ]);
   
  }

  public function registerUser(Request $request){

    $request->validate([
        'name' => ['required','max:150'],
        'email' =>['required','unique:users'],
        //'email' => ['required','email','max:150'],
        'mobile' => ['required','max:20'],
        'password' => ['required','min:6','max:50'],
        'confirmation_code' => ['required','min:6'],
      ],
      [
        'email.unique' => 'This email address already exists. Please enter correct email or contact support team.'
      ]
    );

    try {
      $confirmationCode = $request->confirmation_code;
      $send_mail = $request->email;
      Mail::to($send_mail)->send(new SendConfirmation($confirmationCode));
      $status = 'Success';
    } catch (\Exception $e) {
        Log::error("Email sending failed". $e->getMessage());
        $status = 'Failed';
    };

    EmailLog::create([
        'name' => $request->name,
        'email' => $send_mail,
        'otp' => $confirmationCode,
        'status' => $status,
        'date' => now()->format('d M Y - h:i A')
    ]);

    return $status === 'Success' ? "Success" : "Failed";
  }

  public function registerAccountConfirm(Request $request){


    //return dd($request);

    $request->validate([
        'name' => ['required','max:50'],
        'email' => ['required','email','max:150'],
        'mobile' => ['required','max:20'],
        'password' => ['required','min:6','max:50'],
        'confirmation_code' => ['required','min:6'],
        'confirmation_code_match' => ['required','same:confirmation_code'],
          
      ],
      [
        'confirmation_code_match.same' => 'Confirmation code dose not match. Please Check your Email adn try again.',
      ]
    );
  
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->phone,
        'password' => Hash::make($request->password),
        'userType' => 'user',
    ]);

  }

  public function userLogin(Request $request){

    $this->validate($request,[
        'email' => [
          'required', 'email',
          Rule::exists('users', 'email'), // 'users' is the table name, 'id' is the column name
        ],
        'password' => [
          'required',
            
        ],
      ],
      [
        'email.email' => 'Please enter a correct email address.',
        'email.required' => 'This field is required.',
        'email.exists' => 'This email does not exists.',
        'password.required' => 'Incorrect login information.',
      ]
   );

   if(Auth::guard('users')->attempt(['email' => $request->email, 'password' => $request->password, 'userType' => 'user'])){
      $request->session()->regenerate();
      $user = Auth::guard('users')->user();
      LoginRecord::create([
          'email' => $user->email,
          'user_type' => 'Customer',
          'ip' => $request->ip(),
          'date' => now()->format('d M Y - h:i A')
      ]);
      return response()->json ([
        'msg' => $user->name.' '.'You Are logged In..'
      ]);
    }
    else {
        return response()->json ([
            'msg' => 'You are not allowed to login'
        ],401);
    }

  }

  public function logoutUser(Request $request){
    Auth::guard('users')->logout();
    $request->session()->forget('user_guard_session_key'); // Replace with the specific key used for admins
    $request->session()->regenerateToken();
    return redirect('/');
  }

  public function updateUser(Request $request){

    $this->validate($request,[
        'name' => 'required|max:150',
        'date_of_birth' => 'required|date|max:10',
        'nid' => 'required|max:50',
        'gender' => 'required|in:Male,Female,Other|max:7',
        'marital_status' => 'required|in:Single,Married|max:7',
        'house_number' => 'required|max:20',
        'street_name' => 'required|max:50',
        'postal_code' => 'bail|required|max:10',
        'city' => 'required|max:50',
        'permanent_house_number' => 'nullable|max:20',
        'permanent_street_name' => 'nullable|max:50',
        'permanent_postal_code' => 'nullable|max:10',
        'permanent_city' => 'nullable|max:50',
        'passport_no' => 'nullable|max:100',
        'passport_expiry_date' => 'nullable|date|max:10',
        'mobile' => 'required|max:20',
        'religion' => 'required|in:Islam,Hindu,Christianity,Buddhism,Others|max:30',
        'language' => 'required|in:Bangla,English|max:10'
    ]);
  
    return User:: where('id', Auth::guard('users')->user()->id)->update([
      'name' => $request->name,
      'date_of_birth' => $request->date_of_birth,
      'nid' => $request->nid,
      'gender' => $request->gender,
      'marital_status' => $request->marital_status,
      'house_number' => $request->house_number,
      'street_name' => $request->street_name,
      'postal_code' => $request->postal_code,
      'city' => $request->city,
      'permanent_house_number' => $request->permanent_house_number,
      'permanent_street_name' => $request->permanent_street_name,
      'permanent_postal_code' => $request->permanent_postal_code,
      'permanent_city' => $request->permanent_city,
      'passport_no' => $request->passport_no,
      'passport_expiry_date' => $request->passport_expiry_date,
      'mobile' => $request->mobile,
      'religion' => $request->religion,
      'language' => $request->language,
    ]);

  }
  
  public function updateUserlogin(Request $request){

    $this->validate($request,[
        'changedEmail' => ['required'],
        'currentPassword' => ['required', new MatchOldPassword],
        'changedPassword' => 'required|min:6|max:100',
        'ConfirmChangedPassword' => ['required','same:changedPassword'],
    ]);
    
    // User::find(auth()->user()->id)->update(['password'=> Hash::make($request->changedPassword)]);
    User:: where('id', Auth::guard('users')->user()->id)->update([

      // 'email' => $request->changedEmail,
      'password' => Hash::make($request->changedPassword),
    ]);

    Auth::guard('users')->logout();
  
    $request->session()->forget('user_guard_session_key');
    $request->session()->regenerateToken();
    return redirect('/user-login');
  }

  public function deleteUser (Request $request){  

    User::where('id', $request->userId)->delete();
    
    Auth::guard('users')->logout();

    $request->session()->forget('user_guard_session_key');

    $request->session()->regenerateToken();

    return redirect()->back();
  }


  public function uploadProfilePic(Request $request){

    $this->validate($request,[
      'file' => 'required|mimes:jpg,png,jpeg|max:1024'
    ]);
    
    $picName = time().'.'.$request->file->extension();
    $request->file->move(public_path('profile_images'),$picName);
    $pic = "/profile_images/".$picName;
    return User::where('id', Auth::guard('users')->user()->id)->update([
      'image' => $pic,
    ]);
  }

  public function imageStore(Request $request){

    return User::where('id', Auth::guard('users')->user()->id)->update([
      'image' => $request->images,
    ]);
  }

  public function deleteImage (Request $request){  
    $fileName = $request-> profileImage;
    $filePath = $fileName;
    //dd('$fileName');
    if(file_exists($filePath)){
      @unlink($filePath);
    }
    return 'done2';
  }


  public function getOrder(Request $request){  
    $id = Auth::guard('users')->user()->id;
    return Order::with('orderDetails')->where('user_id', $id)->orderBy('id','desc')->get();
   
  }

  public function getSearch(Request $request){  
    //return dd($request);
    $str = $request->search;
    if(!$str) {
      $data = Hotel::with(['images','features','payments','rent'])->paginate($request->total);
    }
    else{
      $data = Hotel::with(['images','features','payments','rent'])->where('name','LIKE',"%{$str}%")->orWhere('address','LIKE', "%{$str}%")->paginate($request->total);
    }
    return $data;

  }

  public function getSearchHotel(Request $request) {  
    $str = $request->search;
    
    $query = Order::with(['user', 'orderDetails'])->orderBy('id', 'desc');

    if ($str) {
        $query->whereHas('orderDetails', function ($q) use ($str) {
            $q->where('hotel_name', 'LIKE', "%{$str}%");
        })->orWhereHas('user', function ($q) use ($str) {
            $q->where('name', 'LIKE', "%{$str}%"); // Assuming 'name' is the correct column in users table
        });
    }

    return $query->paginate($request->total);
  }


  public function getSearchCar(Request $request){  
    
    $str = $request->search;
    if(!$str) {
      $data = carOrder::orderBy('id','desc')->paginate($request->total);
    }
    else{
      $data = carOrder::where('packeage_name','LIKE',"%{$str}%")->orWhere('user_name','LIKE', "%{$str}%")->paginate($request->total);
    }
    return $data;

  }

  public function getSearchPackeage(Request $request){  
    
    $str = $request->search;
    if(!$str) {
      $data = Destination::orderBy('id','desc')->paginate($request->total);
    }
    else{
      $data = Destination::where('extra_one','LIKE',"%{$str}%")->orWhere('pick_up_location','LIKE', "%{$str}%")->paginate($request->total);
    }
    return $data;

  }

  public function deleteOrder(Request $request){  
    Order::where('id', $request->order_id)->delete();
  }

  public function updateeOrder(Request $request){

    $this->validate($request,[
        'check_in' => 'required|date|max:20',
        'check_out' => 'required|date|max:20',
        'payment_type' => 'nullable|in:Rocket,Nagad,',
        'transction_no' => 'nullable|max:100',
    ]);

   
    $diff = strtotime($request->check_out) - strtotime($request->check_in);
    $res = abs(round($diff / 86400));

    //return dd($price);
  
    return Order:: where('id', $request->order_id)->update([

      'room_no' => $request->room,
      'no_of_adult' => $request->adult,
      'no_of_child' => $request->child,
      'total_price' => $request->total,
      'check_in' => $request->check_in,
      'check_out' => $request->check_out,
      'payment_type' => $request->payment,
      'trasnstion_id' => $request->transtion,
      'backup' => $request->room_type_price * $request->room * $res,

    ]);

  }
  
  public function addAdmin(Request $request){  
    $request->validate([
      'name' => ['required'],
      'email' => ['required','email'],
      'pass' => ['required'],
    ]);

    Admin::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->pass),
        'isActivated' => 1,
        'role' => "admin",
        'userType' => "admin",
    ]);

    return Admin::where('userType', 'admin')->orWhere('userType', 'super')->orderBy('id','desc')->get();
    
  }
  
  public function updateAdmin(Request $request){  
    $request->validate([
      'name' => ['required'],
      'email' => ['required','email'],
      'pass' => ['required'],
    ]);

    Admin:: where('id', $request->id)->update([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->pass),
    ]);
    return Admin::where('userType', 'admin')->orWhere('userType', 'super')->orderBy('id','desc')->get();
  }
  
  public function deleteAdmin(Request $request){  
    Admin::where('id', $request->id)->delete();
  }
  
  public function getAllAdmin(Request $request){  
    return Admin::where('userType', 'admin')->orWhere('userType', 'super')->orderBy('id','desc')->get();
  }
  
  public function getAllUser(Request $request){  
    if($request->total){
      return User::where('userType','user')->orderBy('id','desc')->paginate($request->total);
    }else{
      return User::where('userType','user')->orderBy('id','desc')->get();
    }
    
  }
  
  public function getSingleUser(Request $request){  
    return User::where('id', $request->id)->get();
  }

  public function deleteUserData(Request $request){  
    User::where('id', $request->id)->delete();
    return User::where('userType', 'user')->orderBy('id','desc')->paginate(8);
  }
    
  public function updateUserData(Request $request){  
    $request->validate([
      'pass' => ['required'],
    ]);

    User:: where('id', $request->id)->update([
      'password' => Hash::make($request->pass),
    ]);

    return User::where('userType', 'user')->orderBy('id','desc')->paginate($request->total);

  }

  public function addEditor(Request $request){  
    $request->validate([
      'name' => ['required'],
      'email' => ['required','email'],
      'pass' => ['required'],
    ]);

    Admin::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->pass),
      'isActivated' => 1,
      'userType' => "editor",
      'role' => "admin",
    ]);

    return Admin::where('userType', 'editor')->orderBy('id','desc')->get();
    
  }
  
  public function getEditor(Request $request){  
    return Admin::where('userType', "editor")->orderBy('id','desc')->get();
  }

  public function updateEditor(Request $request){  
    $request->validate([
      'name' => ['required'],
      'email' => ['required','email'],
      'pass' => ['required'],
    ]);

    Admin:: where('id', $request->id)->update([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->pass),
      'isActivated' => 1,
      'userType' => "editor",
      'role' => "admin",
    ]);

    return Admin::where('userType', 'editor')->orderBy('id','desc')->get();

  }
  
  public function deleteEditor(Request $request){  
    Admin::where('id', $request->id)->delete();
  }

  public function notificationClear(){
    $admin = Admin::findOrFail(Auth::guard('admins')->user()->id);
    $admin->update([
        'nt_hotel_order' => 0,
        'nt_car_order' => 0,
    ]);
  }

  public function notificationClearType(Request $request){
    $admin = Admin::findOrFail(Auth::guard('admins')->user()->id);
    if ($request->type == "nt_hotel_order") {
      $admin->update(['nt_hotel_order' => 0]);
    }
    if ($request->type == "nt_car_order") {
      $admin->update(["nt_car_order" => 0]);
    }
  }

  public function getLoginRecord(Request $request){
    return LoginRecord::orderBy('id', 'desc')->paginate($request->total);
  }

  public function getEmailLog(Request $request){
    return EmailLog::orderBy('id', 'desc')->paginate($request->total);
  }

  public function sendEmail(Request $request){
    $this->validate($request,[
      'emailType' => 'required|in:0,1',
      'address'   => 'required_if:emailType,0|nullable|string',
      'subject'   => 'required|string',
      'message'   => 'required|string',
    ],[
      'emailType.required' => "Please select Email type.",
      'emailType.in' => "Invalid Email type.",
      'address.required_if' => "Email addresses are required, Seoerated by (,) .",
      'address.string' => "Invalid Email address.",
      'subject.required' => "Email subject is required.",
      'subject.string' => "Invalid Email subject.",
      'message.required' => "Email message is required.",
      'message.string' => "Invalid Email message.",
    ]);

    try {
      if ($request->emailType == '0') {

        $emails = explode(',', $request->address);  
        foreach ($emails as $email) {
          Mail::to(trim($email))->send(new SendEmailSidebar($request->message, $request->subject));
        }
        $this->logEmail($emails[0], $request->subject, 'Success');

      } else {

        $customers = \App\Models\User::whereNotNull('email')->pluck('email')->toArray();
        foreach ($customers as $email) {
          Mail::to($email)->send(new SendEmailSidebar($request->message, $request->subject));
        }
        $this->logEmail('All Customers', $request->subject, 'Success');

      }
      return response()->json(['message' => 'Emails sent successfully'], 200);

    } catch (\Exception $e) {
      Log::error("Email sending failed. Error: " . $e->getMessage());
      $this->logEmail('SideBar Email', $request->subject, 'Failed');
      return response()->json(['message' => 'Failed to send email', 'error' => $e->getMessage()], 500);
    }

  }

  private function logEmail($email, $subject, $status)
  {
    EmailLog::create([
      'name' => "Send Email System",
      'email'   => $email,
      'otp'   => $subject,
      'status'  => $status,
      'date'    => now()->format('d M Y - h:i A'),
    ]);
  }


}