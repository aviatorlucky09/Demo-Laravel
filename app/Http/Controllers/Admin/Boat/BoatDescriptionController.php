<?php


namespace App\Http\Controllers\Admin\Boat;

use App\Models\Boat\Boat;
use App\Models\Boat\BoatDetail;
use App\Models\Boat\BoatType;
use App\Models\Boat\BoatManufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;

class BoatDescriptionController extends Controller
{
 public function __construct()
 { 
    $this->middleware('auth:admin');
}

public function boat_description($boat_id){

    $boat = Boat::where('id',$boat_id)->first();
    $active_tab = "description";

    if(!$boat){
        return view('error.page_not_found');
    } 
    $boatTypes = BoatType::where('is_active',1)->get();
    $boatManufacturers = BoatManufacturer::where('is_active',1)->get();
   
    return view('admin.boats.description',compact("boat","active_tab","boatTypes","boatManufacturers"));
}

public function boat_description_store(Request $request,$boat_id){

    //dd($request->all());
    $v_arr =  array();

    /*$v_arr['boat_type_id']  = "required|numeric";
    $v_arr['year'] = "required|numeric";
    $v_arr['manufacturer'] = "required";
    $v_arr['length'] = "required|numeric";
    $v_arr['passenger_limit'] = "required|numeric";
    $v_arr['engine_make'] = "required";
    $v_arr['horsepower'] = "required";
    $v_arr['fuel_included'] = "required|in:0,1";
    $v_arr['pets_allowed'] = "required|in:0,1,2";
    $v_arr['captains_required'] = "required|in:0,1";
    $v_arr['model'] = "required";
    $v_arr['rental_season_start'] = "required";
    $v_arr['rental_season_end'] = "required";
    $v_arr['towing_allowed'] = "required|in:0,1";*/
   

    $v = Validator::make($request->all(), $v_arr );
    if ($v->fails())
    {   
        return response()->json(getValidationErrorJson($v));
        exit;
    }
    

   
    $boat = Boat::find($boat_id);
    $boat->passenger_limit = $request->passenger_limit;
    $boat->min_age = $request->min_age;
    $boat->bookable_online = $request->bookable_online;
    $boat->boat_type_id = $request->boat_type_id;

    $boat->save();

     $boat_detail = BoatDetail::firstOrNew([
        'boat_id' =>  $boat_id,
    ]);

   $boat_detail->year = $request->year;
   $boat_detail->manufacturer_id  = $request->manufacturer_id ;
   $boat_detail->length = $request->length;
   $boat_detail->horsepower = $request->horsepower;
   $boat_detail->fuel_included = $request->fuel_included;
   $boat_detail->pets_allowed = $request->pets_allowed;
   $boat_detail->captains_required = $request->captains_required;
   $boat_detail->captains_available = $request->captains_available;
   $boat_detail->model = $request->model;
   $boat_detail->engine_make = $request->engine_make;
   $boat_detail->rental_season_start = $request->rental_season_start;
   $boat_detail->rental_season_end = $request->rental_season_end;
   $boat_detail->towing_allowed = $request->towing_allowed;
   $boat_detail->private_notes = $request->private_notes;
   $boat_detail->security_deposit = $request->security_deposit;
   
   if(!empty($request->rental_season_start)){
        $boat_detail->rental_season_start = date("Y-m-d",strtotime($request->rental_season_start));
    }
    if(!empty($request->rental_season_end)){
        $boat_detail->rental_season_end = date("Y-m-d",strtotime($request->rental_season_end));
    }
    $boat_detail->save();

    $url = "";

    $result_array = array( 'result' => "success",'message' => "Boat Description updated successfully" , 'url' => $url);
    return response()->json($result_array);
    exit;

}



}
