<?php

namespace App\Http\Controllers\Admin\Boat;

use App\Models\Boat\Boat;
use App\Models\System\State;
use App\Models\System\City;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config;
use View;
use Illuminate\Support\Str;
use Auth;
use App\Models\Boat\BoatType;

class BoatController extends Controller
{
 public function __construct()
 {
    $this->middleware('auth:admin');
    $arr = array();
    $arr['view_folder'] = "admin.boats";
    $arr['singular_name'] = "Boat";
    $arr['plural_name'] = "Boats";
    $arr['table_name'] = "boats";
    $arr['update_route_name'] = 'admin.boat_update';
    $arr['edit_route_name'] = 'admin.boat_edit';
    $arr['delete_route_name'] = 'admin.boat_delete';
    $arr['listing_url'] = ajaxUrl(route('admin.boats'));
    $arr['create_url'] = ajaxUrl(route('admin.boat_create'));
    $this->config_arr =$arr;

}
public function index(Request $request)
{
    if(!Auth::guard('admin')->user()->hasAccess('fleet_view')){
        return view('layouts.admin.no_access')->with(["name"=>"Boats View"]);
    }
    $deleted = 0;
    if($request->deleted == 1){
        $deleted = 1;
    }
    $marina_id = 0;
    if(!empty($request->marina_id) and isset($request->marina_id)){
        $marina_id = $request->marina_id;
    }

    $boat_type_id = 0;
    if(!empty($request->boat_type_id) and isset($request->boat_type_id)){
    $boat_type_id = $request->boat_type_id;
    }

    $status = "";
    if(!empty($request->status) and isset($request->status)){
    $status = $request->status;
    }

    $boatTypes = BoatType::where('is_active',1)->get();

    $carr = $this->config_arr;
    $view_path = getAdminViewFolderPath($carr,"_list");
    return view($view_path,compact('carr','deleted','marina_id','boat_type_id','boatTypes','status'));

}

public function processing(Request $request){

   $deleted = 0;
   if($request->deleted == 1){
    $deleted = 1;
        }

        $carr = $this->config_arr;

        $visible_header = array("id","name","boat_type","status","option");
        $db_header = array("boats.name","boat_types.name");
        $start = $request->start;
        $length = $request->length;
        $draw = $request->draw;
        $search_req = $request->search;
        $search = $search_req['value'];

        $query_obj = Boat::query();
        $query_obj->join('boat_types', 'boats.boat_type_id', '=', 'boat_types.id',"left");
        $query_obj->select("boats.*","boat_types.name as boat_type");


        /* global search */
        if($search != ''){
            $query_obj->where(function ($query)  use ($db_header, $search){
                foreach($db_header as $key=>$_field){
                    $query->orWhere($_field ,'like', '%'.$search .'%');
                }
            });
        }

        /*Search boat with marina*/
        if(!empty($request->marina_id) and isset($request->marina_id) and $request->marina_id !== 0){

            $query_obj->where('marina_id',$request->marina_id);
        }
        /*Search boat with boat type*/
        if(!empty($request->boat_type_id) and isset($request->boat_type_id) and $request->boat_type_id !== 0){

            $query_obj->where('boat_type_id',$request->boat_type_id);
        }
        /*Search boat with status*/
        if(!empty($request->status) and isset($request->status) and $request->status !== ""){

            $query_obj->where('status',$request->status);
        }





        /*if($deleted == 0){
            $query_obj->whereNull('deleted_at');
        }else{
            $query_obj->whereNotNull('deleted_at');
        }*/


        $query_obj->orderBy('id', 'DESC');

        $query_obj_count = $query_obj;

        $total_records = $query_obj_count->count();

        $data_obj = $query_obj->skip($start)->take($length)->get();


        $table = array();
        $table['draw'] = $draw;
        $table['recordsTotal'] = $total_records;
        $table['recordsFiltered'] = $total_records;
        $table_data = array();


        foreach ($data_obj as $key => $data_row){


            $_data = array();
            $element_id = $data_row->id;
            foreach($visible_header as $key=>$header){
                $_header = "";
                if ($header == "option") {
                    $obj = $data_row;
                    $view_path = getAdminViewFolderPath($carr,"_options");
                    $_header.= (string)View::make(  $view_path ,compact('obj','element_id','carr','deleted'));

                }else if($header == "status"){

                 if($data_row->status == "pending"){
                    $_header = "<h5><span class='badge badge-warning'>".ucfirst($data_row->status)."</span></h5>";
                 }else if($data_row->status == "approved"){
                    $_header = "<h5><span class='badge badge-primary'>".ucfirst($data_row->status)."</span></h5>";
                 }else if($data_row->status == "declined"){
                    $_header = "<h5><span class='badge badge-danger'>".ucfirst($data_row->status)."</span></h5>";
                 }else{
                    $_header = "<h5><span class='badge badge-success'>".ucfirst($data_row->status)."</span></h5>";
                 }


             }

             else{
                $_header = $data_row->$header;
            }

            $_data[] = $_header;
        }
        $table_data[] = $_data;
    }

    $table['data'] = $table_data;

    return $table;
}

public function create(Request $request)
{
    if(!Auth::guard('admin')->user()->hasAccess('fleet_create')){
        return view('layouts.admin.no_access')->with(["name"=>"Boats Create"]);
    }
    $obj = $this->getEmptyObject();
    $obj->id            = 0;

    $states = State::where('is_active',1)->pluck('name','id')->toArray();
    $cities = City::where('is_active',1)->pluck('name','id')->toArray();

    $carr               = $this->config_arr;

    $view_path = getAdminViewFolderPath($carr,"_form");
    return view($view_path,compact('obj','carr','states','cities'));
}


public function edit(Request $request, $id = 0)
{
    if(!Auth::guard('admin')->user()->hasAccess('fleet_modify')){
        return view('layouts.admin.no_access')->with(["name"=>"Boats Modify"]);
    }
    $obj = $this->findById($id);
    if(!$obj){
        return view('error.record_not_found');
    }

    $states = State::where('is_active',1)->pluck('name','id')->toArray();
    $cities = City::where('is_active',1)->pluck('name','id')->toArray();

    $carr               = $this->config_arr;
    $view_path = getAdminViewFolderPath($carr,"_form");

    return view($view_path,compact('obj','carr','states','cities'));
}

public function update(Request $request, $id = 0)
{
    if(!Auth::guard('admin')->user()->hasAccess('fleet_modify')){
      $result_array = array( 'result' => "error",'message' => "Access Denied" , 'url' => "");
      return response()->json($result_array);
    }  
    $carr = $this->config_arr;
    $url = "";

    $v_arr =  array();

   /* $v_arr['boat_name']  = "required|unique:boats,name,".$id;
    $v_arr['listing_title'] = "required";
    $v_arr['marina_id'] = "required|numeric";
    $v_arr['city_id'] = "required|numeric";
    $v_arr['state_id'] = "required|numeric";
    $v_arr['address'] = "required";
    $v_arr['postal_code'] = "required";
    $v_arr['status'] = "required|in:pending,approved,declined,draft";*/

    $v = Validator::make($request->all(), $v_arr );
    if ($v->fails())
    {
        return response()->json(getValidationErrorJson($v));
        exit;
    }

        // Check unique email id
    if($id){
        $obj = $this->findById($id);
         $obj_created = 0;
        if(!$obj){
            $result_array = array( 'result' => "error",'message' => $carr['singular_name']." Not found",'error_list' => "");
            return response()->json($result_array);
            exit;
        }
        $success_message = $carr['singular_name']. " Upated";



    }else{
        $obj = $this->getEmptyObject();
        $obj_created = 1;

        $url = $carr['listing_url'];
        $success_message = $carr['singular_name'] ." Created";

    }
    $allow_params = array();

    $allow_params[]  = "listing_title";
    $allow_params[]  = "marina_id";
    $allow_params[]  = "city_id";
    $allow_params[]  = "state_id";
    $allow_params[]  = "address";
    $allow_params[]  = "latitude";
    $allow_params[]  = "longitude";
    $allow_params[]  = "status";


    foreach ($allow_params as $params){
        if($request->$params){
            $obj->$params = $request->$params;
        }
    }
//    $user = User::find(1);
//    $obj->user_id = $user->id;
    if(!empty($request->boat_name) and isset($request->boat_name)){
        $obj->name = $request->boat_name;
    }
    if(!empty($request->postal_code) and isset($request->postal_code)){
        $obj->zipcode = $request->postal_code;
    }
    $obj->save();
    if($obj_created){
            $url = ajaxUrl(route('admin.boat_description',['boat_id'=>$obj->id]));
       }

    $result_array = array( 'result' => "success",'message' => $success_message , 'url' => $url);
    return response()->json($result_array);
    exit;

}

public function delete(Request $request, $id = 0)
{
    if(!Auth::guard('admin')->user()->hasAccess('fleet_delete')){
      $result_array = array( 'result' => "error",'message' => "Access Denied" , 'url' => "");
      return response()->json($result_array);
    } 
    $carr = $this->config_arr;

    $obj = $this->findById($id);
    if(!$obj){
        $result_array = array( 'result' => "error",'message' => $carr['singular_name']." not found",'error_list' => "");
        return response()->json($result_array);
        exit;
    }
    if($request->restore == 1){
        $obj->restore();
        $success_message = $carr['singular_name']." Restored";

    }else{


        $obj->delete();
        $success_message = $carr['singular_name']." Deleted";

    }

    $result_array = array( 'result' => "success",'message' => $success_message);
    return response()->json($result_array);
    exit;
}

public function getEmptyObject(){
 return new Boat();
}
public function findById($id){

    return Boat::withTrashed()->where("id",$id)->first();
}
}
