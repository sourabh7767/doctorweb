<?php

namespace App\Http\Controllers;

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
        $users = User::where('created_by','!=', 0)->count();
        $data = User::getActiveInactiveCount();
        $monthlys = User::monthly();
        return view('home',compact("users","data","monthlys"));
    }
    
    public function webIndex(){
        return view('web.index');
    }
}
