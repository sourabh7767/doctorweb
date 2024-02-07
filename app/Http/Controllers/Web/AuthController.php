<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\Button;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('webIndex');
    }
    public function webIndex(){
        return view('web.index');
    }

    public function signup(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create a new user
        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'email_verified_at' => Carbon::now(),
        ]);
        return response()->json(['success'=> true,'Signup successful'],200);
    }
    public function userLogin(Request $request){
    

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        
        $email = $request->email;
        $password = $request->password;
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if (!Auth::guard('web')->attempt(['email' => $email, 'password' => $password])) {
            $returnArray = ['password' => ["Password or Email is Incorect"]];
            return response()->json(['errors' => $returnArray], 422);

        }

        return response()->json(['success' => "login"], 200);

    }

    public function changePassword(Request $request,$id = false)
    {
        if($request->isMethod("GET")){
            return view('web.reset-password',compact('id'));
        }
        $validator = Validator::make($request->all(), [
            'change_new_pass' => 'required',
            'change_confirm_pass' => 'required|same:change_new_pass',
        ],[

            'change_new_pass.required' => 'New password is required',
            'change_confirm_pass.required' => 'Confirm password is required',
            'change_confirm_pass.same' => 'Confirm password should be same as new passowrd'
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $userObj = User::find(decrypt($request->user_id));
        $userObj->update([
            'password' => Hash::make($request->change_new_pass),
        ]);
        return redirect('/')->with('success',"Password Change Successfully");
    }
    public function userLogout(Request $request){

        Auth::guard('web')->logout();
        return redirect()->route('web.index');
    }
    public function forgetPasswordView()
    {
        return view('web.forget-password');
    }
    public function forgetPassword(Request $request, User $user)
    {
        $rules = [
            'email' => 'required',
        ];

        $messages = [
            'email.required' => 'Please enter email address.'
        ];

        $inputArr = $request->all();
        $validator = Validator::make($inputArr, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        $userObj = User::where('email', $inputArr['email'])
                        ->first();
        if (!$userObj) {
            session()->flash('error',"User not found with this email address");
            return redirect()->back()->with('error' , "User not found with this email address");
        }

        if(empty($userObj->email_verified_at))
        {
            session()->flash('error',"Please verify your account");
            return redirect()->back()->with('error' , "Please verify your account");
        }
        $resetPasswordOtp = $userObj->generateEmailVerificationOtp();
            $details = [
                'email' => $userObj->email,
                'otp' => $resetPasswordOtp 
            ];
        try{
             \Mail::to($userObj->email)->send(new ResetPasswordMail($details));
           }catch(\Exception $ex){
            session()->flash('error',"Mail could not be send,We have some SMTP server Issues.Please try again later.");
            return redirect()->back()->with('error', 'Mail could not be send,We have some SMTP server Issues.Please try again later.');
           }

        $userObj->email_verification_otp = $resetPasswordOtp;
        $userObj->save();

        session()->flash('success',"Reset password OTP sent successfully");
        return redirect()->route('verifyOtpView',encrypt($userObj->id))->with('success','Reset password OTP sent successfully');
    }

    public function verifyOtp(Request $request,$id = false)
   {
       if($request->isMethod("GET")){
           return view('web.verify-otp',compact('id'));
        }
        $rules = [
            'user_id' => 'required',
        ];
        $rawOtp = $request->only(['digit1', 'digit2', 'digit3', 'digit4', 'digit5', 'digit6']);
        $otp = implode("",$rawOtp);
        $inputArr = $request->all();
        $validator = Validator::make($inputArr, $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
       $userObj = User::where('id', decrypt($inputArr['user_id']))
                       ->where('email_verification_otp', $otp)
                       ->first();
       if (!$userObj) {
        session()->flash('error',"Invalid otp");
        return redirect()->back()->with('error' , "Invalid otp");
       }

       $userObj->email_verified_at = Carbon::now();
       $userObj->email_verification_otp = null;
       
       if($userObj->save()){
           session()->flash('success',"Otp verified Successfully.");
           return redirect()->route('changePasswordWeb',encrypt($userObj->id))->with('success' , "Otp verified Successfully.");
       }else{
        session()->flash('error',"Something went wrong");
           return redirect()->back()->with('error' , "Something went wrong");
       }
    }
    public function resendOtp(Request $request, User $user)
    {
        $userId = decrypt($request->get('user_id'));
        if(!$userId){
            session()->flash('error',"Something went wrong");
            return redirect()->back()->with('error' , "Something went wrong");
        }
        $userObj = User::where('id', $userId)->first();
        if (!$userObj) {
            session()->flash('error',"User not found");
            return redirect()->back()->with('error' , "User not found");
        }
       
        $verificationOtp = $userObj->generateEmailVerificationOtp();
        $details = [
            'email' => $userObj->email,
            'otp' => $verificationOtp 
        ];
        try{
            \Mail::to($userObj->email)->send(new ResetPasswordMail($details));
        }catch(\Exception $ex){
            session()->flash('error',"Mail could not be send,We have some SMTP server Issues.Please try again later.");
            return redirect()->back()->with('error', 'Mail could not be send,We have some SMTP server Issues.Please try again later.');
        }
        $userObj->email_verification_otp = $verificationOtp;
        if($userObj->save()){
            session()->flash('success',"Otp resend successfully!");
            return redirect()->back()->with('success' , "Otp resend successfully!");    
        }else{
            session()->flash('error',"Otp is not sent");
            return redirect()->back()->with('error' , "Otp is not sent");
        }
    }
}
