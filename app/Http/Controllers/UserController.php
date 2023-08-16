<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Brand;
use File;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    public $emailReciever;
    public $emailRecieverName;

    public function getSignup(){

        return view('user.signup');
    }

     public function postSignup(Request $request){ 
   

        $this->validate($request, [
         'fname' => 'required',
         'lname' => 'required',
         'email' => 'email|required|unique:users',
         'phone' => 'numeric',
         'password' => 'required|min:8|confirmed',
         'picture' => 'required',
        ]);


         $user = new User([
          'name' => $request->input('fname').' '.$request->lname,
          'email' => $request->input('email'),
          'password' => bcrypt($request->input('password')),
        

        ]);


        if($request->hasFile('picture')){
            
               $extension = $request->picture->extension();
             
               $imageName = time().'.'.$extension;
               $request->picture->move(public_path('storage/profilePic'), $imageName);
                  $user->image = $imageName; 
        }
        $user->save();
        $customer = new Customer;
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->addressline = $request->addressline;
        $customer->city = $request->city;
        $customer->zipcode = $request->zipcode;
        $customer->phone = $request->phone;
        $customer->user_id = $user->id;
        $customer->save();
        
        $user_id_setter = User::where('id', $user->id)->first();
        $user_id_setter->user_id = $user->id; 
        $user_id_setter->save();
        Auth::login($user);
        echo "Good";
      return redirect()->route('user.profile');
    }


     public function getSignin(){
        return view('user.signin');
    }

     public function postSignin(Request $request){
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);
        if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
        {
            if (auth()->user()->is_admin == 1) {

               return redirect()->route('admin.dashboard');
            } 
            elseif(auth()->user()->is_admin == 2){
               return redirect()->route('order.index');
            }
            else {
                return redirect()->to("/");
            }
        }
        else{
            return redirect()->route('user.signin')
                ->with('error','Your Email Or Password Are Wrong.');
        }
     }

      public function getLogout(){
        Auth::logout();
        return redirect()->route('product.index');
    }

    // public function getProfile(){
    //     //$orders = Auth::user()->with('orders')->get();
    //     $orders = Auth::user()->orders;
    // //   dd($orders);
    //     $orders->transform(function($order, $key){
    //         $order->cart = unserialize($order->cart);
    //         return $order;
    //     });
    //     return view('user.profile',compact('orders'));
    // }

    public function getProfile(Request $request){
        if(Auth::check() == false){
            return redirect()->back();
        };
        if(Auth::check() && auth()->user()->is_admin == 1){
            return redirect()->back();
        }
        $customer = Customer::where('user_id',Auth::id())->first();

        if($request->arrangement != null){
        $orders = Order::with('customer', 'items')
        ->where('customer_id',$customer->customer_id)
        ->where('status',$request->arrangement)
        ->orderBy('orderinfo_id','DESC')->get();
        $selectedBtn = $request->arrangement;
        }
        else{
         $orders = Order::with('customer', 'items')
        ->where('customer_id',$customer->customer_id)
        ->where('status',"New Order")
        ->orderBy('orderinfo_id','DESC')->get();
        $selectedBtn = "New Order";
        }



          $brands = Brand::with('category')->with('items')->get();
       // dd($orders);
          return view('user.profile',compact('orders', 'brands', 'selectedBtn'));
    }


    public function forgetPassword(){
        return view('user.forget_password');
    }



    public function validateEmail(Request $request){
        $user = User::where('email', '=', $request->email)->first();


         if ($user == null) {
            return redirect()->back()->with('error','Email not exists');
        }
        $tk = Str::random(60);

         DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $tk,
            'created_at' => Carbon::now(),
        ]);

        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        $this->emailReciever = $request->email;
        $this->emailRecieverName = $user->name;

        $link = App::make('url')->to('/').'/user/confirm_password/'. $tokenData->token . '/' . $user->email;

        Mail::send('email_for_reset', ['button_link' =>  $link], function($message)
        {   
         $message->from('justinesarabia77@gmail.com', 'Byte Shop');
         $message->to($this->emailReciever,$this->emailRecieverName)->subject('Password Reset');
        });
        return redirect()->back()->with('send', 'A reset link has been sent to your email address.');
    }




      public function resetpassword(Request $request){
          //Validate input

        $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:users,email',
        'password' => 'required|confirmed',
        'token' => 'required' ]);

          //check if payload is valid before moving on
        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator);
        }

        $password = $request->password;

        // Validate the token
        $tokenData = DB::table('password_resets')
        ->where('token','=' ,$request->token)->first();

           

        // Redirect the user back to the password reset request form if the token is invalid
            if (!$tokenData) return view('user.forget_password')->with('error', 'Wrong token please enter your email to recieved new token');

            $user = User::where('email', $tokenData->email)->first();
        // Redirect the user back if the email is invalid
            if (!$user) return redirect()->back()->with('error', 'Email not found');

        //Hash and update the new password
            $user->password = bcrypt($password);
            $user->save(); //or $user->save();
           

        //login the user immediately they change password successfully
        // Auth::login($user);
        // $request->session()->put('UserId',$user->id);
        

        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
        ->delete();


            if ($user) 
            {
                $user1 = User::where('email','=',$request->email)->first();
                Auth::login($user1);
                  if (auth()->user()->is_admin == 1) {
                  return redirect()->route('admin.dashboard');
                  } 
                  elseif(auth()->user()->is_admin == 2){
                  return redirect()->route('order.index');
                  }
                  else {
                  return redirect()->to("/");
                  }

            } else {
                return redirect()->back()->with('email','A Network Error occurred. Please try again.');
            }

        }



        public function edit($id){
            $user = User::with('customer')->where('user_id', $id)->first();
            // dd($user);
            if(auth()->user()->is_admin == 1 || auth()->user()->is_admin == 2){
                return view('admin.edit', compact('user'));
            }
            else{
                return view('user.edit', compact('user'));
            }
            
        }

        public function update(Request $request){
            // dd($request->city);
             $input = $request->all();
                if($request->password != null){
                   
                     $rules = [
                        'fname' => 'required|max:60',
                        'lname' => 'required|max:60',
                        'city' => 'required',
                        'phone' => 'required|numeric',
                        'addressline' => 'required',
                        'zipcode' => 'required',
                        'picture'=> 'nullable|image',
                        'current_password' => 'required',
                        'password' =>'string|min:8|confirmed',
                    ];
                }
                else{
                      $rules = [
                        'fname' => 'required|max:60',
                        'lname' => 'required|max:60',
                        'city' => 'required',
                        'phone' => 'required|numeric',
                        'addressline' => 'required',
                        'zipcode' => 'required',
                        'picture'=> 'nullable|image',
                    ];

                }

            $validator = Validator::make($request->all(), $rules);

            if($validator->passes()){


                if($request->password != null){
                     $user = User::where('id','=',auth()->user()->user_id)
                     ->select('id','password')->first();
                        
                    if(!Hash::check($request->current_password,$user->password)){
                        return redirect()->back()->with('error', 'Wrong Current Password');
                    }
                }


                $user= User::where('user_id', auth()->user()->user_id)->first();
                $customer= Customer::where('user_id', auth()->user()->user_id)->first();

                $user->name = $request->fname." ".$request->lname;

                if($request->password != null){
                     $user->password = bcrypt($request->password);
                } 
                if($request->hasFile('picture')){
                       $extension = $request->picture->extension();
                       $imageName = time().'.'.$extension;
                       File::delete('storage/profilePic'.$user->image);
                       $request->picture->move(public_path('storage/profilePic'), $imageName);
                       $user->image = $imageName; 
                }
                $user->save();

                 $customer->fname = $request->fname;
                 $customer->lname = $request->lname;
                 $customer->addressline = $request->addressline;
                 $customer->city = $request->city;
                 $customer->zipcode = $request->zipcode;
                 $customer->phone = $request->phone;
                 $customer->save();

        

                return redirect()->route('profile.show', auth()->user()->user_id);



            }
            else{
                return redirect()->back()->withInput()->withErrors($validator);
            }         


           return redirect()->route('profile.show', auth()->user()->user_id);
        }

        public function profileShow($id){
            $user = User::with('customer')->where('user_id', $id)->first();

            if(auth()->user()->is_admin == 1 || auth()->user()->is_admin == 2){
                return view('admin.show_profile', compact('user'));
            }
            else{
                return view('user.show_profile', compact('user'));
            }

        }



}
