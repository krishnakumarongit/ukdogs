<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\User;
use App\Service\Common;
use App\Models\UserAttempts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CommonController extends Controller
{
    protected $common;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Common $common)
    {
        //$this->middleware('guest');
        $this->common = $common;
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

   


}
