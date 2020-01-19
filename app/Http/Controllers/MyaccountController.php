<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Locations;
use App\Service\Common;
use App\Models\UserAttempts;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class MyaccountController extends Controller
{
    protected $common;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Common $common)
    {
        $this->middleware('auth');
        $this->common = $common;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('myaccount.index');
    }

    public function changePassword(Request $request)
    {
       return view('myaccount.changepassword');
    }

    public function myAccountPassword(Request $request) {

        $validatedData = $request->validate([
            'current_password' => ['required', 'string', 'max:255', 'min:6'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!Hash::check($request->input('current_password'), Auth::user()->password)) {
            return \Redirect::back()->withErrors(['The current password you have entered does not match your current one'])
            ->withInput($request->input());
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make( $request->input('new_password'));
        $user->save();
        $request->session()->flash('myaccount_message', 'Your password has been changed successfully.');
        return redirect(route('my-account-change-password'));
    }


    public function check(Request $request)
    {

         $validatedData = $request->validate($request->all(),[
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255','min:3', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        if (! $validator->passes()) {
            $errors = $validator->errors()->all();
            return response()->json(['status' => 'no', 'errors' => $errors]);
        }
        
        $token = (string) Str::uuid();
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make( $request->input('password'));
        $user->email_verified = 0;
        $user->token = $token;
        $user->regtype = 'website';
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->save();
        $this->guard()->login($user);
        //send email from here
        $this->common->sendAuthMail($subject, $template, $request->input('name'), $request->input('email'), $token);
        //end of send email
        //login and redirect user
         
        return response()->json(['status' => 'yes', 'errors' => '']);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    public function validateEmail(Request $request, $token ='')
    {
        $verifyUser = User::where('token', $token)->first();
        if (isset($verifyUser) ) {
            if($verifyUser->email_verified != 1) {
                $verifyUser->email_verified = 1;
                $verifyUser->email_verified_at = Carbon::now();
                $verifyUser->token = '';
                $verifyUser->save();
                $status = "Your e-mail is verified. You can now login.";
                echo $status;
                exit;
            } else {
                $status = "Your e-mail is already verified";
                echo $status;
                exit;
            }
        } else {
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }
        return redirect('/login')->with('status', $status);
    }

    public function sendEmailVerification (Request $request)
    {
        //check number of attempts from here / max 5 attempts
        $checkTemp = UserAttempts::where([['date','=',date('Y-m-d')],['user_id','=','1'],['type','=','email_verify']])->get();
        if ($checkTemp->count() > 4) {
            echo "Limit exceeded";
            exit;
        } else {
            $temp = new UserAttempts;
            $temp->user_id = 1;
            $temp->date = date('Y-m-d');
            $temp->type = 'email_verify';
            $temp->save();
            //send verification email from here
            echo "send email verification link";
            exit;
        }


    }

    public function passwordReset (Request $request) 
    {
        return view('registration.email');
    }


    public function emailCheck (Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email'],
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if (isset($user) ) {

            $checkTemp = UserAttempts::where([['date', '=', date('Y-m-d')],['email', '=', $request->input('email')],['type','=','password_reset']])->get();
            if ($checkTemp->count() > 4) {
                echo "Limit exceeded";
                exit;
            } else {
                $temp = new UserAttempts;
                $temp->email = $request->input('email');
                $temp->date = date('Y-m-d');
                $temp->type = 'password_reset';
                $temp->save();
                $token = (string) Str::uuid();
                $user->password_token = $token;
                $user->save();
                //send email from here
            }
        } else {
            echo "User not found in system...";
            exit;
        }
    }


    public function passwordResetPage(Request $request, $token = '') 
    {
        return view('registration.reset', ['token' => $token]);
    }


    public function passwordResetPageCheck(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if (isset($user)) {
            if ($user->password_token == $request->input('token')) {
                $user->password = Hash::make($request->input('password'));
                $user->save();
                echo "request processed successfully...";
                exit;
            } else {
                echo "error processing your request...";
                exit;
            }
        } else {
            echo "User not found in system...";
            exit;
        }

    }


   
    public function verifyYourEmail() 
    {
        return view('verify_email');
    }


    public function profile(Request $request)
    {
       $user = User::find(Auth::user()->id);
       if(!$user){
          return redirect(route('do-sign-in'));
       }
       return view('myaccount.profile',['location' => Locations::all(),'user' => $user]);
    }

    public function profileConfirm(Request $request) {

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:50', 'min:3'],
            'location' => ['required'],
            'website_address' => ['sometimes', 'nullable', 'url'],
            'main_telephone_number' => ['sometimes', 'nullable', 'min:10', 'max:11'],
            'about_me' => ['sometimes', 'nullable', 'min:25','max:1000'],
            'secondary_telephone_number' => ['sometimes', 'nullable', 'min:10', 'max:11']

        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $request->input('name');
        $user->about_me = $request->input('about_me');
        $user->location = $request->input('location');
        $user->website_address = $request->input('website_address');
        $user->main_telephone_number = $request->input('main_telephone_number');
        $user->secondary_telephone_number = $request->input('secondary_telephone_number');    
        $user->save();
        $request->session()->flash('myaccount_message', 'Your personal information has been updated successfully.');
        return redirect(route('my-account-profile'));
    }

    public function email(Request $request)
    {
       $user = User::find(Auth::user()->id);
       return view('myaccount.email', ['email' => $user->email]);
    }

    public function emailConfirm(Request $request) {

        $user = User::find(Auth::user()->id);
        $validatedData = $request->validate([
            'email' => ['required', 'email','unique:users,email,'.$user->id]
        ]);

        if ($user->email != $request->input('email')) {
             $checkTemp = UserAttempts::where([['date', '=', date('Y-m-d')],['user_id', '=', Auth::user()->id],['type','=','email_change']])->get();
            if ($checkTemp->count() > 4) {
               $request->session()->flash('error', 'Your request limit for tody has reached. Please try again tomorrow.');
            } else {
                $token = (string) Str::uuid();
                $user->email = $request->input('email');
                $user->email_verified_at = null;
                $user->email_verified = 0;
                $user->token = $token;
                $user->save();
                 //send email from here
                $subject = 'Verify your email address on '.env('APP_NAME');
                $template = view('emails.register',['name' => $user->name, 'token' => $token])->render();
                $this->common->sendAuthMail($subject, $template, $user->name, $request->input('email'), $token);
                $attempt = new UserAttempts();
                $attempt->user_id = Auth::user()->id;
                $attempt->date = date('Y-m-d');
                $attempt->type = 'email_change';
                $attempt->updated_at =  Carbon::now();
                $attempt->created_at =  Carbon::now();
                $attempt->save();
                //check if the email present in varified list
                $request->session()->flash('myaccount_message', 'Your login email has been changed successfully. Now we need to verify your email address.We have sent an email to your new email account. Please click the link in that email to continue.');
            }
        }
        return redirect(route('my-account-email'));
    }


    public function resentMail(Request $request) 
    {
        if (Auth::user()->email_verified == 1) {
                return redirect(route('my-account-profile'));
        }
        return view('myaccount.resend');
    }


    public function resentMailConfirm(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $checkTemp = UserAttempts::where([['date', '=', date('Y-m-d')],['user_id', '=', Auth::user()->id],['type','=','resend_emalil_link']])->get();
            if ($checkTemp->count() > 4) {
               $request->session()->flash('error', 'Your request limit for tody has reached. Please try again tomorrow.');
            } else {
                $token = (string) Str::uuid();
                $user->email_verified_at = null;
                $user->email_verified = 0;
                $user->token = $token;
                $user->save();
                 //send email from here
                $subject = 'Verify your email address on '.env('APP_NAME');
                $template = view('emails.register',['name' => $user->name, 'token' => $token])->render();
                $this->common->sendAuthMail($subject, $template, $user->name, $user->email, $token);
                $attempt = new UserAttempts();
                $attempt->user_id = Auth::user()->id;
                $attempt->date = date('Y-m-d');
                $attempt->type = 'resend_emalil_link';
                $attempt->updated_at =  Carbon::now();
                $attempt->created_at =  Carbon::now();
                $attempt->save();
                //check if the email present in varified list
                $request->session()->flash('myaccount_message', 'We have sent an email to your new email account. Please click the link in that email to verify.');

            }
            return redirect(route('resent-mail'));
    }


    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $user = User::find(Auth::user()->id);
            $validator = Validator::make($request->all(),[
               'image' => ['required','mimes:jpeg,png,jpg', 'image', 'max:2048']
            ]);
            if (! $validator->passes()) {
               $errors = $validator->errors()->all();
               return response()->json(['status' => 'no', 'errors' => $errors]);
            }
            $image = $request->file('image');
            $name = date('y-m-d').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $user = User::find(Auth::user()->id);
            //unlink previous image here
            if ($user->photo !="" && file_exists(public_path().'/images/'.$user->photo)) {
                unlink(public_path().'/images/'.$user->photo);
            }
            $user->photo = $name;
            $user->save();
             return response()->json(['status' => 'yes', 'message' => '<img height="100" width="100" src="'.asset('images/'.$name).'">']);
        }
        return response()->json(['status' => 'no', 'errors' => 'Please select a profile image to upload.
            ']);
    }



}