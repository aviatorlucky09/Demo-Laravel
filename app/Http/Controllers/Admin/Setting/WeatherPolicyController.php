<?php
namespace App\Http\Controllers\Admin\Setting;

use App\Models\System\Policy\WeatherPolicyData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;

class WeatherPolicyController extends Controller
{
 public function __construct()
 { 
    $this->middleware('auth:admin');
}

public function weather_policy(Request $request){

   $weatherPolicies = WeatherPolicyData::findMany([1, 2, 3]);
   $active_tab = "weather";

    return view('admin.setting.policies.weather_policy',compact("active_tab","weatherPolicies"));
}

public function weather_policy_store(Request $request){

    //dd($request->all());
    $v_arr =  array();
     $v_arr['arr'] = "required";

   
    $v = Validator::make($request->all(), $v_arr );
    if ($v->fails())
    {   
        return response()->json(getValidationErrorJson($v));
        exit;
    }
    $weather_policy_arr = $request->arr;

    foreach($weather_policy_arr as $weather_policy_id => $fields){
         $obj = WeatherPolicyData::find($weather_policy_id);
        foreach($fields as $fieldname=>$value){
             $obj->$fieldname =$value;
             $obj->save();
        }    
    }

    $url = "";

    $result_array = array( 'result' => "success",'message' => "Weather Policy updated successfully" , 'url' => $url);
    return response()->json($result_array);
    exit;

}



}
