<?php


namespace App\Http\Controllers\Admin\Marina;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Illuminate\Support\Facades\Validator;
use App\Config; 
use View;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Marina\MarinaOwner;
use App\Models\Marina\Marina;
use Illuminate\Support\Facades\Hash;

class MarinaOwnerController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth:admin');
      
    }
   public function marina_owner($marina_id){

    $marina = Marina::find($marina_id);
    $active_tab = "owner";

    if(!$marina){
        return view('error.page_not_found');
    } 
    $marina_owner = $marina->owner;

    return view('admin.marinas.marinas_owner',compact("marina_owner","marina","active_tab"));
}

public function marina_owner_store(Request $request,$marina_id){

    //dd($request->all());
    $v_arr =  array();

    $v_arr['full_name'] = "required";
    $v_arr['owner_email'] = "required|email";
    $v_arr['owner_mobile'] = "required";
  
    $v = Validator::make($request->all(), $v_arr );
    if ($v->fails())
    {   
        return response()->json(getValidationErrorJson($v));
        exit;
    }
    $marina_owner = MarinaOwner::firstOrCreate([
     'marina_id' => $marina_id
    ]);

     $marina_owner = MarinaOwner::find($marina_id);  
     $marina_owner->full_name = $request->full_name;
     $marina_owner->owner_email = $request->owner_email;
     $marina_owner->owner_mobile = $request->owner_mobile;

     $marina_owner->save();

$url = "";

$result_array = array( 'result' => "success",'message' => "Marina Owner updated successfully" , 'url' => $url);
return response()->json($result_array);
exit;

}
    
    
    
}
