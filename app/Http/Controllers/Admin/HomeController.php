<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $this->middleware('auth:admin');
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
        $perscriptionsCount = Prescription::count();
        $monthlys = User::monthly();
        return view('home',compact("users","data","monthlys","perscriptionsCount"));
    }
    public function getPrescription(Request $request)
    {
        $prescription = Prescription::find($request->card_id);
        return response()->json(['success' => true,'message' => "Prescription get successfully!",'object' => $prescription]);
    }
    
    
}
