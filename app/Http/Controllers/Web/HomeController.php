<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CopyPrescriptionRecord;
use App\Models\CustomSearch;
use App\Models\CustomSearchTag;
use Carbon\Carbon;
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
        // dd(auth()->user());
        $user = Auth::user();
        $customSearchObj = CustomSearch::where('user_id',auth()->user()->id)->with('customTags','groupNames')->get();
        // dd($customSearchObj);
        $customSearchParent = CustomSearch::where('user_id',auth()->user()->id)->where('parent_id',0)->get();
        if($request->ajax()){
            return response()->json(['success'=>$customSearchParent]);
        }
        // dd($customSearchObj);
        return view('web.home',compact('user','buttons','customSearchObj','customSearchParent'));
    }
    public function addPrescription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'parent_groups' => 'required',
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
                $presriptionObj->parent_group_id = $request->parent_groups;
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
            $Prescriptions = Prescription::where('user_id', auth()->user()->id)->whereHas('tags', function ($query) use ($explodeSearch) {
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
            'group_name' => 'required_without_all:title,tags',
            'title' => 'sometimes|required_without:group_name',
            'tags' => 'sometimes|required_without:group_name',
        ], [
            'group_name.required_without_all' => 'The group name field is required .',
            'title.required_without' => 'The title field is required .',
            'tags.required_without' => 'The tags field is required .',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            $customSearchObj = new CustomSearch(); 
            // DB::beginTransaction();
            if(!empty($request->input('group_name'))){
                $customSearchObj->title = $request->group_name;
                $customSearchObj->user_id = $userObj->id;
                $customSearchObj->save();
                $tags = CustomSearch::with('customTags','groupNames')->where('id',$customSearchObj->id)->get();
                return response()->json(['success'=> true ,'message'=> 'Lable added successfully!','newCustomSearch' => $tags]);
            }
            if(!empty($request->input('title'))){
                $customSearchObj->title = $request->title;
                $customSearchObj->parent_id = $request->customSearchObj_id;
                $customSearchObj->user_id = $userObj->id;
                $customSearchObj->save();
                
            }
            $emplodedTags = explode(',',$request->input('tags'));
            if(!empty($request->input('tags'))){
                foreach($emplodedTags as $value){
                    $customSearchTagObj = new CustomSearchTag();
                    $customSearchTagObj->tag = $value;
                    $customSearchTagObj->custom_search_id = $customSearchObj->id;
                    $customSearchTagObj->user_id = $userObj->id;
                    $customSearchTagObj->save();
                }
            }
            // $count = count($emplodedTags);
            // if(!empty($request->customSearchObj_id)){
            //     $tags = CustomSearch::with(['customTags' => function($query) use($count) {
            //         $query->orderBy('created_at', 'desc')->take($count)->get();
            //     }])->where('id', $request->customSearchObj_id)->get();
            // }else{
                $tags = CustomSearch::with('customTags','groupNames')->where('id',$customSearchObj->id)->get();
            // }
            // DB::commit();
            return response()->json(['success'=> true ,'message'=> 'Lable added successfully!','newCustomSearch' => $tags]);
        } catch (\Throwable $th) {
            // DB::rollBack();
            return response()->json(['error'=> true ,'message'=> $th->getMessage()]);
        }
    }
    public function getProfileData()
    {
        $user = Auth::user(); // Assuming you are using Laravel's built-in authentication
        $data = [
            'full_name' => $user->full_name,
            'profile_image' => $user->profile_image, 
        ];

        return response()->json($data);
    }
    public function getButtonDescription(Request $request)
    {
        $buttonId = $request->input('button_id');
        $button = Button::find($buttonId);

        if ($button) {
            return response()->json(['description' => replaceWithDate($button->description)]);
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
    public function deleteLeftTags(Request $request)
    {
        $tags = CustomSearchTag::find($request->tag_id);
        $custom_search_id = $tags->custom_search_id;
        if ($tags->customSearch->customTags->count() === 1) {
            $tags->customSearch->delete();
        }
        $tags->delete();
        $count = CustomSearchTag::where("custom_search_id",$custom_search_id)->count();
        return response()->json(['success' => 'true', 'message' => 'Tag Deleted','count'=>$count]);
    }
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

    public function getAllUserCards(Request $request,CustomSearch $prescription)
    {
        $totalCards = CustomSearch::where('user_id','!=',auth()->user()->id)->where('parent_id',0)->count();
        $totalPrescreptions = Prescription::where('user_id','!=',auth()->user()->id)->count();
        if ($request->ajax()) {
            $prescriptions = $prescription->getAllCards($request);
             $setFilteredRecords = $totalCards;
            if(!empty($search)){
                $setFilteredRecords = $prescription->getAllCards($request,true);
            }
            return datatables()->of($prescriptions)
                // ->addIndexColumn()
                ->addColumn('template_count', function ($prescription) {
                    $ids = CustomSearch::where('parent_id',$prescription->id)->pluck('id')->toArray();
                    $tags = CustomSearchTag::whereIn('custom_search_id',$ids)->pluck('tag')->toArray();
                    $Prescriptions = Prescription::whereHas('tags', function ($query) use ($tags) {
                     $query->whereIn('tags', $tags);
                 })->count();
                    return $Prescriptions;
                })
                ->addColumn('user_id', function ($prescription) {
                   $email = $prescription->user->email;
                    return !empty($prescription->user->full_name) ? $prescription->user->full_name  : $email;
                })
                ->addColumn('created_at', function ($prescription) {
                     return $prescription->created_at->diffForHumans();
                 })
                 ->addColumn('updated_at', function ($prescription) {
                    return $prescription->updated_at->diffForHumans();
                })
               
                ->addColumn('action', function ($prescription) {
                    $recordObj = CopyPrescriptionRecord::where('group_id',$prescription->id)->where('user_id',auth()->user()->id)->get();
                $btn = '';
                if(!empty($recordObj) && count($recordObj)>0){
                    $btn = '<a href="#" title="View" ><i style="color:#53dd4a;" class="fas fa-heart allreadyCopied"></i></a>&nbsp;&nbsp;';
                }else{
                    $btn = '<a href="#" title="View" ><i style="color:white;" class="fas fa-heart copyData" data-id="'.$prescription->id.'"></i></a>&nbsp;&nbsp;';
                }
                
                return $btn;
            })
                ->rawColumns([
                'action',
                'template_count'
            ])
            ->setTotalRecords($totalCards)
            ->setFilteredRecords($setFilteredRecords)
            ->skipPaging()
            ->make(true);
        }

        return view('web.all-user-cards',compact('totalCards','totalPrescreptions'));
    }
    public function viewCards($id)
    {
        // $ids = explode("",$id);
        $ids = CustomSearch::where('parent_id',$id)->pluck('id')->toArray();
       $tags = CustomSearchTag::whereIn('custom_search_id',$ids)->pluck('tag')->toArray();
       $emplodedIds =  [];
    //    dd($Prescriptions);
       $Prescriptions = Prescription::whereHas('tags', function ($query) use ($tags) {
        $query->whereIn('tags', $tags);
    })->get();
    if($Prescriptions){
        return view('web.copy-template',compact('Prescriptions'))->render();
    }
    
    }
    public function copyGroup1($id){
        $newUserId = auth()->user()->id;
        $groupNames = CustomSearch::find($id);
        $groupNamesTags = CustomSearchTag::where('custom_search_id',$id)->get();
        $tags = CustomSearchTag::where('custom_search_id',$id)->pluck('tag')->toArray();
        if(!empty($groupNames)){
            $recordObj = new CopyPrescriptionRecord();
            $recordObj->user_id = $newUserId;
            $recordObj->group_id = $groupNames->id;
            $recordObj->save();
            $groupNames->download_count = $groupNames->download_count + 1;
            $groupNames->save();
            $newGroupName = $groupNames->replicate();
            $newGroupName->user_id = $newUserId;
            $newGroupName->download_count = 0;
            $newGroupName->created_at = Carbon::now();
            $newGroupName->updated_at = Carbon::now();
            $newGroupName->save();
        }
        if(!empty($groupNamesTags)){
            $Prescriptions = Prescription::whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('tags', $tags);
            })->get();
            foreach ($groupNamesTags as $groupNameTag) {
                $newGroupNameTag = $groupNameTag->replicate();
                $newGroupNameTag->user_id = $newUserId;
                $newGroupNameTag->custom_search_id = $newGroupName->id;
                $newGroupNameTag->created_at = Carbon::now();
                $newGroupNameTag->updated_at = Carbon::now();
                $newGroupNameTag->save();
            }
        }
        
        if(!empty($Prescriptions)){
            foreach ($Prescriptions as $prescription) {
                $newPrescription = $prescription->replicate();
                $newPrescription->user_id = $newUserId;
                $newPrescription->created_at = Carbon::now();
                $newPrescription->updated_at = Carbon::now();
                $newPrescription->save();
            }
        }
        return response()->json(["message" =>"success"]);
        
    }
    public function copyGroup($id){
        $newUserId = auth()->user()->id;
        $groupNames = CustomSearch::find($id);
        
        if(!empty($groupNames)){
            $recordObj = new CopyPrescriptionRecord();
            $recordObj->user_id = $newUserId;
            $recordObj->group_id = $groupNames->id;
            $recordObj->save();
            $groupNames->download_count = $groupNames->download_count + 1;
            $groupNames->save();
            $newGroupName = $groupNames->replicate();
            $newGroupName->download_count = 0;
            $newGroupName->user_id = $newUserId;
            $newGroupName->save();
        }
        $innerGroups = CustomSearch::where('parent_id',$groupNames->id)->get();
        if(!empty($innerGroups)){
            foreach($innerGroups as $value){
                $newInnerGroup =  $value->replicate();
                $newInnerGroup->user_id = $newUserId;
                $newInnerGroup->parent_id = $newGroupName->id;
                $newInnerGroup->save();
                $groupNamesTags = CustomSearchTag::where('custom_search_id',$value->id)->get();
                if(!empty($groupNamesTags)){
                    foreach($groupNamesTags as  $groupNamesTag){
                        $newTags = $groupNamesTag->replicate();
                        $newTags->custom_search_id = $newInnerGroup->id;
                        $newTags->user_id = $newUserId;
                        $newTags->save();
                    }
                }
                $tags = CustomSearchTag::where('custom_search_id',$value->id)->pluck('tag')->toArray();
                if(!empty($tags)){
                    $Prescriptions = Prescription::whereHas('tags', function ($query) use ($tags) {
                        $query->whereIn('tags', $tags);
                    })->get();
                    if(!empty($Prescriptions)){
                        foreach ($Prescriptions as $prescription) {
                            $prescriptionTags = PrescriptionTag::where('prescription_id',$prescription->id)->get();
                            $newPrescription = $prescription->replicate();
                            $newPrescription->user_id = $newUserId;
                            $newPrescription->created_at = Carbon::now();
                            $newPrescription->updated_at = Carbon::now();
                            $newPrescription->save();
                            foreach($prescriptionTags as $prescriptionTag){
                                $newPrescriptionTags = $prescriptionTag->replicate();
                                $newPrescriptionTags->prescription_id = $newPrescription->id ;
                                $newPrescriptionTags->user_id = $newUserId ;
                                $newPrescriptionTags->save();

                            }
                        }
                    }
                }
               
            }
        }
        return response()->json(["message" =>"success"]);
        
    }
    public function editMainGroup(Request $request,$id = false){
        if($request->isMethod("GET")){
            $data = CustomSearch::find($id);
            if(!empty($data)){
                return response()->json(['group' => $data->title]);
            }else{
                return response()->json(['error'=> 'Data not found']); 
            }
        }
       
    }
    public function updateGroupName(Request $request){
        $data = CustomSearch::find($request->group_lable);
        if(!empty($data)){
            $data->title = $request->group_name;
            try {
                if($data->save()){
                    return response()->json(['success' => "Updated"]);
                }
            } catch (\Throwable $th) {
                return response()->json(['error' => $th]);
            }
           
        }
    }

    public function deleteGroup(Request $request){
        $maingroup = CustomSearch::find($request->group_id);
        if(!empty($maingroup)){
            CustomSearch::where('parent_id',$request->group_id)->delete();
            $prescreptionIds = Prescription::where('parent_group_id',$maingroup->id)->pluck("id","id")->toArray();
            if($prescreptionIds){
                PrescriptionTag::whereIn("prescription_id",$prescreptionIds)->delete();
            }
            Prescription::where('parent_group_id',$maingroup->id)->delete();
            if($maingroup->delete()){
                return response()->json(['success' => "Deleted"]); 
            }else{
                return response()->json(['error' => "Something went wrong"]);
            }
        }else{
            return response()->json(['error' => "search not found"]);
        }
    }

}
