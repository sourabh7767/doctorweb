<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Button;
use App\Models\Prescription;
use App\Models\PrescriptionTag;
use Illuminate\Support\Facades\DB;
use Validator;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web')->except('webHome');
    }
    public function webHome(Request $request){
        $buttons = Button::get();
        return view('web.home',compact('buttons'));
    }
    public function addPrescription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'diagn' => 'required',
            'objective' => 'required',
            'recomend' => 'required',
            'tags' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            DB::beginTransaction();
            $presriptionObj = new Prescription();
                $presriptionObj->diagn = $request->input('diagn');
                $presriptionObj->objective = $request->input('objective');
                $presriptionObj->recomend = $request->input('recomend');
                $presriptionObj->user_id = auth()->guard('web')->user()->id;
                $presriptionObj->save();
           
            $emplodedTags = explode(',',$request->input('tags'));
            foreach ($emplodedTags as $key => $value) {
                $tagsObj = new PrescriptionTag();
                $tagsObj->tags = $value;
                $tagsObj->user_id = auth()->guard('web')->user()->id;
                $tagsObj->prescription_id = $presriptionObj->id;
                $tagsObj->save();
            }
                
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
       return response()->json(['success' => true,'Prescription added successfully']);
    }
    public function getTraumaData(Request $request){
        $searchTerm = $request->input('searchTerm');
        $Prescriptions = "";
        if ($searchTerm) {
            $Prescriptions = Prescription::where('deleted_at',null)->with('tags')
                ->where('diagn', 'LIKE', '%'. $searchTerm .'%')
                ->orWhere('objective','LIKE', '%'. $searchTerm .'%')
                ->get();
        } 
        return view('web.prescription-card',compact('Prescriptions'))->render();
    }

    public function deleteTraumaCard(Request $request)
    {
        try {
            DB::beginTransaction();
            $cruntCard = Prescription::where('id', $request->card_id)->first();
            $cruntCard->delete();
            PrescriptionTag::where('prescription_id', $request->card_id)->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Prescriptions deleted successfully!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error deleting prescriptions', 'error' => $th->getMessage()]);
        }
        
    }

    public function addTags(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'place' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $buttonObj = Button::create([
            'title' => $request->title,
            'description' => $request->description,
            'place' => $request->place
        ]);
        if($buttonObj)
        return response()->json(['success' => true,'message' => "Button added Successfull!"]);
    }
}
