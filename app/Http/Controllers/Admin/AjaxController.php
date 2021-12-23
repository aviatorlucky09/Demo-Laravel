<?php

namespace App\Http\Controllers\Admin;

use App\Models\System\State;
use App\Models\System\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    public function ajax_state_list(Request $request)
    {
        $country_id = $request->country_id;
        $states = State::where('country_id', $country_id)->get();

        $result_array = array( 'result' => "success", 'states' => $states);
        return response()->json($result_array);
        exit;
    }
    public function ajax_city_list(Request $request)
    {
        $state_id = $request->state_id;
        $cities = City::where('state_id', $state_id)->get();

        $result_array = array( 'result' => "success", 'cities' => $cities);
        return response()->json($result_array);
        exit;
    }
    public function ajax_marina(Request $request){

        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = DB::table('marinas')->select("id","name")
           ->where(DB::raw("name"), 'LIKE', "%". $search."%")
           ->get();
                   
        }
        return response()->json($data);
    }
    public function ajax_cities_of_state(Request $request,$state_id){

         $state = State::find($state_id);
         return $state->cities->pluck('name','id')->toArray();
    }
}
