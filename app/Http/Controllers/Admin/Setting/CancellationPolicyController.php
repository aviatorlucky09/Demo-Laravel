<?php
namespace App\Http\Controllers\Admin\Setting;

use App\Models\System\Policy\CancellationPolicyData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;

class CancellationPolicyController extends Controller
{
 public function __construct()
 { 
    $this->middleware('auth:admin');
}

public function cancellation_policy(Request $request){

   $cancellationPolicies = CancellationPolicyData::all();
   $timeArray = ["hours"=>"hours","days"=>"days"];
   $active_tab = "cancellation";

   return view('admin.setting.policies.cancellation_policy',compact("active_tab","cancellationPolicies","timeArray"));

   
}

public function cancellation_policy_store(Request $request){

    //dd($request->all());
    $v_arr =  array();
    $v_arr['arr'] = "required";

    $v = Validator::make($request->all(), $v_arr );
    if ($v->fails())
    {   
        return response()->json(getValidationErrorJson($v));
        exit;
    }
    $cancellation_arr = $request->arr;

    foreach($cancellation_arr as $cancellation_id => $fields){
         $obj = CancellationPolicyData::find($cancellation_id);
        foreach($fields as $fieldname=>$value){
             $obj->$fieldname =$value;
             $obj->save();
        }    
    }

    $url = "";

    $result_array = array( 'result' => "success",'message' => "Cancellation Policy updated successfully" , 'url' => $url);
    return response()->json($result_array);
    exit;

}



}
