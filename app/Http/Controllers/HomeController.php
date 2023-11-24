<?php

namespace App\Http\Controllers;

use App\Models\Button;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('webIndex');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $data = User::getActiveInactiveCount();
        $monthlys = User::monthly();
        return view('home',compact("users","data","monthlys"));
    }
    
    public function webIndex(){
       
        return view('web.index');
    }
    
    public function webHome(Request $request){
        $buttons = Button::get();
        return view('web.home',compact('buttons'));
    }
}
