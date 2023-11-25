<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
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
            'password' => $request->input('password'),
        ]);
        return response()->json(['success'=> true,'Signup successful'],200);
    }

    public function login(Request $request){
    
        if($request->isMethod('get')){
            return view('auth.login');
        }

        $rules = array(
            'email' => 'required|email:rfc,dns,filter',
            'password' => 'required',
        );
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }  
        // dd(!Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]));
        if (!Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return $this->sendFailedLoginResponse($request);

        }

        return redirect()->route('admin.home');

    }
    
    public function logout(Request $request){

        Auth::logout(); // logout user
        return redirect('/admin/login');
    }
}
