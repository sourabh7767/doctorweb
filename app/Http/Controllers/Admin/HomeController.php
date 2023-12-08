<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Button;
use App\Models\Prescription;
use App\Models\PrescriptionTag;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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
    public function getCopyPrescriptionModal(Request $request)
    {
        $priscription = Prescription::find($request->prescription_id);
        $users = User::where('id','!=',$priscription->user_id)->where('role','!=',User::ROLE_ADMIN)->get();
        return view('user.select-user',compact('users','priscription'))->render();
    }
    public function saveCopiedData(Request $request)
    {
        $prescriptionId = $request->input('prescription_id');
        $selectedUsers = $request->input('selected_users');
        $originalPrescription = Prescription::find($prescriptionId);
        $originalPrescriptionTags = PrescriptionTag::where('prescription_id',$prescriptionId)->get();
        try {
            DB::beginTransaction();
        foreach ($selectedUsers as $userId) {
            $newPrescription = $originalPrescription->replicate();

            $newPrescription->user_id = $userId;

            $newPrescription->save();
            foreach($originalPrescriptionTags as $originalPrescriptionTag){
                $newPrescriptionTag = $originalPrescriptionTag->replicate();
                $newPrescriptionTag->user_id = $userId;
                $newPrescriptionTag->prescription_id = $newPrescription->id;
                $newPrescriptionTag->save();
            }
        }
        DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        
        return Redirect::back()->with('success', 'Prescriptions copied');
    }
    
}
