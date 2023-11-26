<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Button;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'change_old_pass' => 'required',
            'change_new_pass' => 'required',
            'change_confirm_pass' => 'required|same:change_new_pass',
        ],[
            'change_old_pass.required' => 'Current password is required',
            'change_new_pass.required' => 'New password is required',
            'change_confirm_pass.required' => 'Confirm password is required',
            'change_confirm_pass.same' => 'Confirm password should be same as new passowrd'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        $currentPassword = $user->password;

        if (Hash::check($request->change_old_pass, $currentPassword)) {
            $user->update([
                'password' => Hash::make($request->change_new_pass),
            ]);

            return response()->json(['success' => true ,'message' => 'Password changed successfully']);
        } else {
            return response()->json(['success' => false,'error' => 'Current password is incorrect'], 422);
        }
    }
    public function userLogout(Request $request){

        Auth::guard('web')->logout();
        return redirect()->route('web.index');
    }
}
