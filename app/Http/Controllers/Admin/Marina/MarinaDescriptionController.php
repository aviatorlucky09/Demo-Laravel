<?php
namespace App\Http\Controllers\Admin\Marina;

use App\Models\Marina\Marina;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;

class MarinaDescriptionController extends Controller
{
   public function __construct()
   { 
    $this->middleware('auth:admin');
}

public function marina_description($marina_id){

    $marina = Marina::where('id',$marina_id)->first();
    $active_tab = "description";

    if(!$marina){
        return view('error.page_not_found');
    } 

    
    return view('admin.marinas.marinas_description',compact("marina","active_tab"));
}

public function marina_description_store(Request $request,$marina_id){

    //dd($request->all());
    $v_arr =  array();

    /*$v_arr['description']  = "required";*/
    $v_arr['mobile'] = "required";
    $v_arr['email'] = "required|email";
    /* $v_arr['admin_status'] = "required";*/
    $v_arr['website'] = "required";
   /* $v_arr['amenities_id'] = "required";*/
   

    $v = Validator::make($request->all(), $v_arr );
    if ($v->fails())
    {   
        return response()->json(getValidationErrorJson($v));
        exit;
    }
    $marina = Marina::find($marina_id);
    if(!empty($request->description)){
        $marina->description = $request->description;
    }
    $marina->mobile = $request->mobile;
    $marina->email = $request->email;
    $marina->website = $request->website;
    $marina->what_they_offer = $request->what_they_offer;
    $marina->save();



$url = "";

$result_array = array( 'result' => "success",'message' => "Marina Description updated successfully" , 'url' => $url);
return response()->json($result_array);
exit;

}




}
