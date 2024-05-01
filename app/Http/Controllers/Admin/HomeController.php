<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Button;
use App\Models\CustomSearch;
use App\Models\Prescription;
use App\Models\PrescriptionTag;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
        // die("dd");
        $prescriptionId = $request->input('prescription_id');
        $selectedUsers = $request->input('selected_users');
        $originalPrescription = Prescription::find($prescriptionId);
        $mainGroup = CustomSearch::find($originalPrescription->parent_group_id);
        $originalPrescriptionTags = PrescriptionTag::where('prescription_id',$prescriptionId)->get();
        try {
            DB::beginTransaction();
        foreach ($selectedUsers as $userId) {
            if(!empty($mainGroup)){
                $newMainGroup = $mainGroup->replicate();
                $newMainGroup->user_id = $userId;
                $newMainGroup->save();
            }
            $newPrescription = $originalPrescription->replicate();

            $newPrescription->user_id = $userId;
            $newPrescription->parent_group_id = $newMainGroup->id;
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
    public function CopyAllPrescriptionModal(Request $request)
    {
        
        $users = User::where('id','!=',$request->user_id)->where('role','!=',User::ROLE_ADMIN)->get();
        return view('user.select-user',compact('users'))->render();
    }
    public function saveAllCopiedData(Request $request)
    {
        $user = $request->user_id;
        $selectedUsers = $request->input('selected_users');
        $record = [];
        try {
            foreach ($selectedUsers as $userId) {
                $originalPrescriptions = Prescription::where('user_id', $user)->get();
                if(!empty($originalPrescriptions)){
                    foreach ($originalPrescriptions as $value) {
                        $mainGroup = CustomSearch::find($value->parent_group_id);
                        if (array_key_exists($value->parent_group_id, $record)) {
                            $newPrescription = $value->replicate();
                            $newPrescription->parent_group_id = $value->parent_group_id;
                            $newPrescription->user_id = $userId;
                            $newPrescription->save();
                        }else{
                            $newMainGroup = $mainGroup->replicate();
                            $newMainGroup->user_id = $userId;
                            $newMainGroup->save();

                            $newPrescription = $value->replicate();
                            $newPrescription->parent_group_id = $newMainGroup->id;
                            $newPrescription->user_id = $userId;
                            $newPrescription->save();
                            $record[$value->parent_group_id] = [$newMainGroup->id];
                        }
                       
                    }
                    
                }
            }
            
            return response()->json(['success' => true , 'message' =>  'Prescriptions copied']);
        } catch (\Throwable $th) {
            return response()->json(['error' => true , 'message' =>  'Prescriptions not copied']);
        }
    }

    // public function saveAllCopiedData(Request $request)
    // {
    //     $abc = [];
    //     $user = $request->user_id;
    //     $selectedUsers = $request->input('selected_users');
    //     try {
    //         DB::beginTransaction();
    
    //         foreach ($selectedUsers as $userId) {
    //             $originalPrescriptions = Prescription::where('user_id', $user)->get();
    //             $abc[] = $originalPrescriptions;
    //             foreach ($originalPrescriptions as $originalPrescription) {
    //                 $newPrescription = $originalPrescription->replicate();
    //                 $newPrescription->user_id = $userId;
    //                 $newPrescription->save();
    
    //                 $originalPrescriptionTags = PrescriptionTag::where('prescription_id', $originalPrescription->id)->get();
    
    //                 foreach ($originalPrescriptionTags as $originalPrescriptionTag) {
    //                     $newPrescriptionTag = $originalPrescriptionTag->replicate();
    //                     $newPrescriptionTag->user_id = $userId;
    //                     $newPrescriptionTag->prescription_id = $newPrescription->id;
    //                     $newPrescriptionTag->save();
    //                 }
    //             }
    //         }
    
    //         DB::commit();
    //         return response()->json(['success' => true , 'message' =>  'Prescriptions copied']);
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         return response()->json(['error' => true , 'message' =>  'Prescriptions not copied']);
    //     }
    // }
    
    public function editPrescreption(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'diagn' => 'required',
            'objective' => 'required',
            'recomend' => 'required',
            'name' => 'required',
            'description' => 'required',
            'tags' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            DB::beginTransaction();
            $presriptionObj = Prescription::find($request->prescreprion_id);
                $presriptionObj->diagn = $request->input('diagn');
                $presriptionObj->objective = $request->input('objective');
                $presriptionObj->recomend = $request->input('recomend');
                $presriptionObj->name = $request->input('name');
                $presriptionObj->description = $request->input('description');
                $presriptionObj->user_id = $request->input('user_id');
                $presriptionObj->save();
                $ids = explode(',',$request->tag_ids);
                foreach($ids as $id){
                    PrescriptionTag::where('id',$id)->delete();
                }
                $tags = explode(",", $request->input('tags'));
                foreach ($tags as $key => $tag) {
                    $tagsObj = new PrescriptionTag();
                    $tagsObj->tags = $tag;
                    $tagsObj->user_id = $request->input('user_id');
                    $tagsObj->prescription_id = $presriptionObj->id;
                    $tagsObj->save();
                }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
       return response()->json(['success' => true,'message'=>'Prescription updated successfully']);
    }
    public function getPrescriptionEdit($id)
    {
        $prescreption = Prescription::find($id);
        $tags = PrescriptionTag::where('prescription_id',$prescreption->id)->get();
        return response()->json(['success' => true,'object' => $prescreption , 'tags' => $tags]);
    }
    public function editGroupName(Request $request){
        if(!empty($request->all()));
        $customeSearchObj = CustomSearch::find($request->group_lable);
        $customeSearchObj->title = $request->title;
        $customeSearchObj->save();
        return response()->json(['success' => true,'message'=>'Group (successfully']);
    }
    
}
