<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CustomSearch;
use App\Models\CustomSearchTag;
use Illuminate\Http\Request;
use App\Models\Button;
use App\Models\Prescription;
use App\Models\PrescriptionTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web')->except('webHome');
    }
    public function webHome(Request $request){
        $buttons = Button::where('user_id',auth()->user()->id)->get();
        // $middleIndex = $buttons->count() / 2;
        // $buttons1 = $buttons->slice(0, $middleIndex);
        // $buttons2 = $buttons->slice($middleIndex);
        $user = Auth::user();
        $customSearchObj = CustomSearch::where('user_id',auth()->user()->id)->with('customTags')->get();
        // dd($customSearchObj);
        return view('web.home',compact('user','buttons','customSearchObj'));
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
                $presriptionObj->name = $request->input('name');
                $presriptionObj->description = $request->input('description');
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
       return response()->json(['success' => true,'message'=>'Prescription added successfully']);
    }
    public function getTraumaData(Request $request){
        $searchTerm = $request->input('searchTerm');
        $type = $request->has('type');
        $explodeSearch   = explode(',',strtolower($searchTerm));
        $Prescriptions = "";
        $priscriptionid = [];
        if($type){
            // $prescriptionTags = PrescriptionTag::where('user_id',auth()->user()->id)->whereIn(DB::raw('LOWER(tags)'), $explodeSearch)->get();
            // foreach ($prescriptionTags as $tag) {
            //     $priscriptionid[] = $tag->prescriptions->id;
            // }
            // if ($prescriptionTags) {
            //     $Prescriptions = Prescription::whereIn('id', $priscriptionid)->where('user_id',auth()->user()->id)->get();
            // }
            $Prescriptions = Prescription::whereHas('tags', function ($query) use ($explodeSearch) {
                $query->whereIn('tags', $explodeSearch);
            }, '=', count($explodeSearch))->get();
        }else{
            if ($searchTerm) {
                $Prescriptions = Prescription::where('user_id', auth()->user()->id)
                ->where(function ($query) use ($searchTerm) {
                    $query->where('diagn', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('objective', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('name', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('recomend', 'LIKE', '%' . $searchTerm . '%');
                })
                ->get();
            }
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
            'place' => $request->place,
            'user_id' => auth()->user()->id
        ]);
        if($buttonObj)
        return response()->json(['success' => true,'message' => "Button added Successfull!",'newButton' => $buttonObj]);
    }

    public function updateProfile(Request $request)
    {
        $model = auth()->user();
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
        ],
    [
      'full_name.required' => 'Name is required',  
    ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if($request->hasFile('profileImage')){
            $model->profile_image = saveUploadedFile($request->profileImage);
        }
        $model->full_name = $request->full_name;
        if($model->save()){
            return response()->json(['success' => true , 'message' => 'Profile updated !']);
        }
    }

    public function deleteButtons(Request $request)
    {
        $button = Button::find($request->button_id)->delete();
        if($button){
            return response()->json(['success' => true , 'message' => 'Button deleted!']);
        }else{
            return response()->json(['error' => true,'message' => 'Something went wrong']);
        }
    }

    public function addSearchableTags(Request $request)
    {
        $userObj = auth()->user();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'tags' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            DB::beginTransaction();
            $customSearchObj = new CustomSearch(); 
            $customSearchObj->title = $request->title;
            $customSearchObj->user_id = $userObj->id;
            $customSearchObj->save();
            $emplodedTags = explode(',',$request->input('tags'));
            foreach($emplodedTags as $value){
                $customSearchTagObj = new CustomSearchTag();
                $customSearchTagObj->tag = $value;
                $customSearchTagObj->custom_search_id = $customSearchObj->id;
                $customSearchTagObj->user_id = $userObj->id;
                $customSearchTagObj->save();
            }
            $tags = CustomSearch::with('customTags')->where('id',$customSearchObj->id)->get();
            DB::commit();
            return response()->json(['success'=> true ,'message'=> 'Lable added successfully!','newCustomSearch' => $tags]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error'=> true ,'message'=> $th->getMessage()]);
        }
    }
    public function getProfileData()
    {
        $user = Auth::user(); // Assuming you are using Laravel's built-in authentication
        $data = [
            'full_name' => $user->full_name,
            'profile_image' => $user->profile_image, // Replace with the actual field name
        ];

        return response()->json($data);
    }
    public function getButtonDescription(Request $request)
    {
        $buttonId = $request->input('button_id');
        $button = Button::find($buttonId);

        if ($button) {
            return response()->json(['description' => $button->description]);
        } else {
            return response()->json(['error' => 'Button not found'], 404);
        }
    }

    public function searchTagsByLables(Request $request)
    {
        {
            $searchTerm = $request->input('searchTerm');
    
            $results = CustomSearch::where('user_id',auth()->user()->id)->where('title', 'like', "%$searchTerm%")
                ->orWhereHas('customTags', function ($query) use ($searchTerm) {
                    $query->where('tag', 'like', "%$searchTerm%");
                })
                ->get();
    
            return response()->json(['results' => $results]);
        }
    }

    public function getPrescription(Request $request)
    {
        $prescription = Prescription::find($request->card_id);
        return response()->json(['success' => true,'message' => "Prescription get successfully!",'object' => $prescription]);
    }

}
