<?php


namespace App\Http\Controllers\Admin\User;

use App\Models\User\User;
use App\Models\User\UserDetail;
use App\Models\System\GovernmentDocument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserDetailController extends Controller
{
 public function __construct()
 { 
    $this->middleware('auth:admin');
}

public function user_detail($user_id){

  if(!Auth::guard('admin')->user()->hasAccess('user_modify')){
        return view('layouts.admin.no_access')->with(["name"=>"Users Create"]);
  }  
  $user = User::where('id',$user_id)->first();
    $active_tab = "detail";

    if(!$user){
        return view('error.page_not_found');
    } 
   
    return view('admin.users.details',compact("user","active_tab"));
}

public function user_detail_store(Request $request,$user_id){

    //dd($request->all());
    $v_arr =  array();

    /* $v_arr['government_document_id'] ="required|numeric";*/
      /*$v_arr['emergency_contact'] = 'required|min:9';*/
     /* $v_arr['company_name'] = 'required';*/
     /* $v_arr['street'] = 'required';
      $v_arr['city'] = 'required';
      $v_arr['state'] = 'required';
      $v_arr['zipcode'] = 'required';
      $v_arr['operator_status'] = "required|in:pending,approved,declined";
      $v_arr['operator_status_note']="required";
   */

    $v = Validator::make($request->all(), $v_arr );
    if ($v->fails())
    {   
        return response()->json(getValidationErrorJson($v));
        exit;
    }
   
     $user_detail = UserDetail::firstOrNew([
        'user_id' =>  $user_id,
    ]);

       $user_detail->user_id = $user_id;
       $user_detail->about_me = $request->about_me;
       $user_detail->government_document_id  = $request->government_document_id;
       $user_detail->emergency_contact = $request->emergency_contact;
       $user_detail->company_name =$request->company_name;
       $user_detail->street =$request->street;
       $user_detail->city =$request->city;
       $user_detail->state =$request->state;
       $user_detail->zipcode =$request->zipcode;
       $user_detail->boat_license_document = "";
       $user_detail->operator_status = $request->operator_status;
       $user_detail->operator_status_note = $request->operator_status_note;

       $user_detail->save();
       $this->upload_government_ID($request, $user_id);
       $this->upload_boat_license($request, $user_id);

    $url = "";

    $result_array = array( 'result' => "success",'message' => "User Detail Updated Successfully" , 'url' => $url);
    return response()->json($result_array);
    exit;

}
public function upload_government_ID($request, $user_id){
   
   $v_arr = array();
   $v_arr['government_document'] = "required|mimes:jpeg,png|max:2048";

  $v = Validator::make($request->all(), $v_arr );
    if ($v->fails())
    {   
        return response()->json(getValidationErrorJson($v));
        exit;
    }

  $disk = config('filesystems.default');
  if($request->file('government_document')){
   $file = $request->file('government_document');
   $name= time().$file->getClientOriginalName();
   $filePath = User::PUBLIC_DOCUMENTS. "/".$user_id ."/".$name;
   $file_store = Storage::disk($disk)->put($filePath,  file_get_contents($file));
   if($file_store){
    $userDetail = UserDetail::where('user_id',$user_id)->first();
    if($userDetail){
      $userDetail->government_document = $name;
      $userDetail->save();
    }

    return response()->json(["message" => "Government ID Uploaded"]);
  }  

}

}
public function upload_boat_license($request, $user_id){

 
   $v_arr = array();
   $v_arr['boat_license_document'] = "required|mimes:jpeg,png|max:2048";

   $v = Validator::make($request->all(),$v_arr);
    if ($v->fails()){  
        return response()->json(getValidationErrorJson($v));
        exit;

    }

  $disk = config('filesystems.default');
  if($request->file('boat_license_document')){
   $file = $request->file('boat_license_document');
   $name= time().$file->getClientOriginalName();
   $filePath = User::PUBLIC_LICENSE. "/".$user_id ."/".$name;
   $file_store = Storage::disk($disk)->put($filePath,  file_get_contents($file));
   if($file_store){
    $userDetail = UserDetail::where('user_id',$user_id)->first();
    if($userDetail){
      $userDetail->boat_license_document = $name;
      $userDetail->save();
    }

    return response()->json(["message" => "Government ID Uploaded"]);
  }  

}

}




}
