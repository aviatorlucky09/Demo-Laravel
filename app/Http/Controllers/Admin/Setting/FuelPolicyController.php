<?php
namespace App\Http\Controllers\Admin\Setting;

use App\Models\System\Policy\FuelPolicyData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;

class FuelPolicyController extends Controller
{
 public function __construct()
 { 
    $this->middleware('auth:admin');
}

public function fuel_policy(Request $request){

   $fuelPolicy = FuelPolicyData::find(2);
   $active_tab = "fuel";
   return view('admin.setting.policies.fuel_policy',compact("active_tab","fuelPolicy"));
}

public function fuel_policy_store(Request $request){

    //dd($request->all());
    $v_arr =  array();

    $v_arr['charge_amount']  = "required|numeric";
   

    $v = Validator::make($request->all(), $v_arr );
    if ($v->fails())
    {   
        return response()->json(getValidationErrorJson($v));
        exit;
    }
    $fuelPolicyId = $request->fuelPolicy_id;
    $fuelPolicy = FuelPolicyData::find($fuelPolicyId);
    $fuelPolicy->charge_amount = $request->charge_amount;
    $fuelPolicy->save();

    $url = "";

    $result_array = array( 'result' => "success",'message' => "Fuel Policy updated successfully" , 'url' => $url);
    return response()->json($result_array);
    exit;

}



}
