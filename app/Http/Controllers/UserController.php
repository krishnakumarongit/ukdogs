<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\User;
use App\Service\Common;
use App\Models\UserAttempts;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $common;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Common $common)
    {
        $this->middleware('guest');
        $this->common = $common;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.register');
    }


     public function passwordForgot()
    {
        return view('auth.password');
    }

    
    public function postPassword(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email']
        ]);

         $user = User::where('email', $request->input('email'))->first();
         if (isset($user->email) && $user->email != "") {
            $checkTemp = UserAttempts::where([['date', '=', date('Y-m-d')],['user_id', '=', $user->id],['type','=','forgot_password']])->get();
            if ($checkTemp->count() > 4) {
                $status = "Your have reached maximum attempts for the day. Please try again tomorrow.";
                return view('notification',['title' => 'Email Verified Successfully', 'message' => $status]);
            } else {
            
             $token = (string) Str::uuid();
             $user->password_token = $token;
             $user->created_at = Carbon::now();
             $user->updated_at = Carbon::now();
             $user->save();

             $temp = new UserAttempts;
             $temp->user_id = $user->id;
             $temp->date = date('Y-m-d');
             $temp->type = 'forgot_password';
             $temp->save();
             //send mail from here
             $subject = 'Reset your password on '.env('APP_NAME');
             $template = view('emails.password',['name' => $user->name, 'token' => $token])->render();
             $this->common->sendAuthMail($subject, $template, $user->name, $user->email, $token);
             //end of send email
             $request->session()->flash('message', 'An email has been sent to '.$user->email.' with further instructions.');

            }

         } else {
            $request->session()->flash('error', 'The email address that you have entered does not match any account.');
         }
         return redirect(route('password-forgot'));
    }




    public function check(Request $request)
    {

        $validator = Validator::make($request->all(),[
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
        $subject = 'Verify your email address on '.env('APP_NAME');
        $template = view('emails.register',['name' => $request->input('name'), 'token' => $token])->render();
        $this->common->sendAuthMail($subject, $template, $request->input('name'), $request->input('email'), $token);
        //end of send email
        $request->session()->flash('message', 'You have successfully registered and logged in.');
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
                $status = "Your email has been successfully verified";
                return view('notification',['title' => 'Email Verified Successfully', 'message' => $status]);
            } else {
                $status = "Your email is already verified";
                return view('notification',['title' => 'Email Verification', 'message' => $status]);
            }
        } else {
             $status = "Sorry your email cannot be identified.";
             return view('notification',['title' => 'Email Verification', 'message' => $status]);
        }
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
                $user->password_token = '';
                $user->password = Hash::make($request->input('password'));
                $user->save();
                return view('notification', ['title' => 'Password Changed successfully', 'message' => 'Password changed successfully.']);
            } else {
                return view('notification', ['title' => 'Error', 'message' => 'Error occured while processing your request.']);
            }
        } else {
            return view('notification', ['title' => 'Error', 'message' => 'Error occured while processing your request.']);
        }
    }


   
    public function verifyYourEmail() 
    {
        return view('verify_email');
    }






}
