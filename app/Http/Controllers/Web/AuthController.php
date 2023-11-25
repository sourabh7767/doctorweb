<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Button;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function userLogout(Request $request){

        Auth::guard('web')->logout();
        return redirect()->route('web.index');
    }
}
