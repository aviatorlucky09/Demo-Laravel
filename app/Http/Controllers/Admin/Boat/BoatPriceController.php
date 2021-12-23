<?php

namespace App\Http\Controllers\Admin\Boat;

use App\Models\Boat\Boat;
use App\Models\Boat\BoatPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;

class BoatPriceController extends Controller
{
 public function __construct()
 {
  $this->middleware('auth:admin');

}
public function boat_price(Request $request,$boat_id){
  $boat = Boat::where('id',$boat_id)->first();
  $active_tab = "price";
  if(!$boat){
    return view('error.page_not_found');
  } 
  $prices = BoatPrice::where("boat_id", $boat_id)->get()->toArray();

  return view('admin.boats.price',compact("boat","active_tab",'prices'));
}
public function boat_price_store(Request $request,$boat_id){

 $v_arr =  array();

 $v = Validator::make($request->all(), $v_arr );
 if ($v->fails())
 {   
  return response()->json(getValidationErrorJson($v));
  exit;
}

if(is_array($request->arr) and isset($request->arr)){

  $boat_price_arr = $request->arr;
  foreach($boat_price_arr as $day=>$price_arr){

   $boat_price = BoatPrice::firstOrNew([
    'boat_id' =>  $boat_id,
    'day'=>$day
  ]);
   foreach($price_arr as $field_name=>$value){

    if($field_name==='hourly_start_hours' or $field_name==='hourly_end_hours' or $field_name==='full_day_start_hours' or $field_name==='full_day_end_hours' or $field_name==='half_day_am_start_hours' or $field_name==='half_day_am_end_hours' or $field_name==='half_day_pm_start_hours' or $field_name==='half_day_pm_end_hours'){

     $boat_price->$field_name = date('H:i:s',strtotime($value));
   }else{
     $boat_price->$field_name = $value;
   }

   $boat_price->save();
 }


}

}

$url = "";
$result_array = array( 'result' => "success",'message' => "Boat Price Updated Successfully" , 'url' => $url);
return response()->json($result_array);
exit;


}
public function boat_bulk_price_store(Request $request,$boat_id){

  //dd($request->all());
 $v_arr =  array();
 $v_arr['half_day_am_price']  = "required_if:half_day_am,1";
 $v_arr['half_day_am_start_hours'] = "required_if:half_day_am,1";
 $v_arr['half_day_am_end_hours'] = "required_if:half_day_am,1";
 $v_arr['half_day_am_turnaround'] = "required_if:half_day_am,1";

 $v_arr['half_day_pm_price']  = "required_if:half_day_pm,1";
 $v_arr['half_day_pm_start_hours'] = "required_if:half_day_pm,1";
 $v_arr['half_day_pm_end_hours'] = "required_if:half_day_pm,1";
 $v_arr['half_day_pm_turnaround'] = "required_if:half_day_pm,1";

 $v_arr['full_day_price']  =   "required_if:full_day,1";
 $v_arr['full_day_start_hours'] = "required_if:full_day,1";
 $v_arr['full_day_end_hours'] = "required_if:full_day,1";
 $v_arr['full_day_turnaround'] = "required_if:full_day,1";

 $v_arr['hourly_price']  =   "required_if:hourly,1";
 $v_arr['hourly_start_hours'] = "required_if:hourly,1";
 $v_arr['hourly_end_hours'] = "required_if:hourly,1";
 $v_arr['hourly_turnaround'] = "required_if:hourly,1";

 $v = Validator::make($request->all(), $v_arr );
 if ($v->fails())
 {   
  return response()->json(getValidationErrorJson($v));
  exit;
}
  $days = getWeekDaysArray();
  $price_arr = $request->arr;

  foreach($days as $day_key=>$day){
     $boat_price = BoatPrice::firstOrNew([
      'boat_id' =>  $boat_id,
      'day'=>$day_key
    ]);
   foreach($price_arr as $field_name=>$value){
    
     if($field_name==='hourly_start_hours' or $field_name==='hourly_end_hours' or $field_name==='full_day_start_hours' or $field_name==='full_day_end_hours' or $field_name==='half_day_am_start_hours' or $field_name==='half_day_am_end_hours' or $field_name==='half_day_pm_start_hours' or $field_name==='half_day_pm_end_hours'){

       $boat_price->$field_name = date('H:i:s',strtotime($value));
     }else{
       $boat_price->$field_name = $value;
     }

     $boat_price->save();


   }
  }
$url = "";
$result_array = array( 'result' => "success",'message' => "Bulk Price Updated Successfully" , 'url' => $url,'data_callback'=>'reloadPage');
return response()->json($result_array);
exit;



 


}



}
