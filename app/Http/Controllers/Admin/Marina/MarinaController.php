<?php
namespace App\Http\Controllers\Admin\Marina;

use App\Models\Marina\Marina;
use App\Models\Boat\BodyOfWater;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config;
use View;
use Illuminate\Support\Str;
use App\Models\System\State;
use App\Models\System\City;
use App\Models\User\User;

class MarinaController extends Controller
{
 public function __construct()
 {
    $this->middleware('auth:admin');
    $arr = array();
    $arr['view_folder'] = "admin.marinas";
    $arr['singular_name'] = "Marina";
    $arr['plural_name'] = "Marinas";
    $arr['table_name'] = "marinas";
    $arr['update_route_name'] = 'admin.marina_update';
    $arr['edit_route_name'] = 'admin.marina_edit';
    $arr['delete_route_name'] = 'admin.marina_delete';
    $arr['listing_url'] = ajaxUrl(route('admin.marinas'));
    $arr['create_url'] = ajaxUrl(route('admin.marina_create'));
    $this->config_arr =$arr;

}
public function index(Request $request)
{
   $deleted = 0;
   if($request->deleted == 1){
    $deleted = 1;
    }

    $status = "";
    if(!empty($request->status) and isset($request->status)){
    $status = $request->status;
    }

    $states     = State::all();
    $cities     = City::select('id','name','state_id')->get();

    $selectedState       = State::find($request->state);
    $selectedCity       =  City::find($request->city);

    $carr = $this->config_arr;
    $view_path = getAdminViewFolderPath($carr,"_list");
    return view($view_path,compact('carr','deleted','states','cities','selectedState','selectedCity','status'));

}
public function processing(Request $request){

   $deleted = 0;
   if($request->deleted == 1){
            $deleted = 1;
        }

        $carr = $this->config_arr;

        $visible_header = array("id","name","address","body_water_type","marina_boats","status","option");
        $db_header = array("marinas.name","body_of_waters.name");
        $start = $request->start;
        $length = $request->length;
        $draw = $request->draw;
        $search_req = $request->search;
        $search = $search_req['value'];

        $query_obj = Marina::query();
        $query_obj->join('body_of_waters', 'marinas.body_of_water_id', '=','body_of_waters.id',"left");
        $query_obj->select("marinas.*","body_of_waters.name as body_water_type");


        /* global search */
        if($search != ''){
            $query_obj->where(function ($query)  use ($db_header, $search){
                foreach($db_header as $key=>$_field){
                    $query->orWhere($_field ,'like', '%'.$search .'%');
                }
            });
        }

        /*Search marina with status*/
        if(!empty($request->status) and isset($request->status) and $request->status !== ""){

            $query_obj->where('status',$request->status);
        }


        /*if($deleted == 0){
            $query_obj->whereNull('deleted_at');
        }else{
            $query_obj->whereNotNull('deleted_at');
        }
        */

        $selectedState       = $request->state;
        $selectedCity        = $request->city;


        /**** Filter State ***/
        if($selectedState){
            $query_obj->where('marinas.state_id', $selectedState);
        }
        /**** Filter City ***/
        if($selectedCity){
            $query_obj->where('marinas.city_id', $selectedCity);
        }


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
                 }else{
                    $_header = "<h5><span class='badge badge-danger'>".ucfirst($data_row->status)."</span></h5>";
                 }

             }else if($header == "marina_boats"){
                $count = $data_row->boats->count();
               $_header = "<a target='_blank' href='".ajaxUrl(route('admin.boats',['marina_id'=>$data_row->id]))."'> $count fleet(s)</a>" ;
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

    $obj = $this->getEmptyObject();
    $obj->id = 0;

    $bodyOfWaters = BodyOfWater::where('is_active',1)->get();
    $states = State::where('is_active',1)->pluck('name','id')->toArray();
    $cities = City::where('is_active',1)->pluck('name','id')->toArray();

    $carr               = $this->config_arr;

    $view_path = getAdminViewFolderPath($carr,"_form");
    return view($view_path,compact('obj','carr','bodyOfWaters','states','cities'));
}


public function edit(Request $request, $id = 0)
{
    $obj = $this->findById($id);
    if(!$obj){
        return view('error.record_not_found');
    }

    $bodyOfWaters = BodyOfWater::where('is_active',1)->get();
    $states = State::where('is_active',1)->pluck('name','id');
    $cities = City::where('is_active',1)->pluck('name','id');

    $carr               = $this->config_arr;
    $view_path = getAdminViewFolderPath($carr,"_form");

    return view($view_path,compact('obj','carr','bodyOfWaters','states','cities'));
}

public function update(Request $request, $id = 0)
{
    //dd($request->all());
    $carr = $this->config_arr;
    $url = "";

    $v_arr =  array();
    $v_arr['marina_name']  = "required|unique:marinas,name,".$id;
    $v_arr['body_of_water_id'] = "required|numeric";
    $v_arr['state_id'] = "required|numeric";
    $v_arr['city_id'] = "required|numeric";
    $v_arr['postal_code'] = "required|numeric";

    if($id != 0){
        $v_arr['status'] = "required|in:pending,approved,declined";
    }

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

    // $allow_params[]  = "name";
    $allow_params[]  = "body_of_water_id";
    $allow_params[]  = "state_id";
    $allow_params[]  = "city_id";
    $allow_params[]  = "status";
    $allow_params[]  = "address";
    $allow_params[]  = "latitude";
    $allow_params[]  = "longitude";
    $obj->name = $request->marina_name;
    foreach ($allow_params as $params){
        if($request->$params){
            $obj->$params = $request->$params;
        }
    }
//    $user = User::find(1);
//    $obj->user_id = $user->id;
    if(!empty($request->postal_code) and isset($request->postal_code)){
        $obj->zipcode = $request->postal_code;
    }
    $obj->save();
    if($obj_created){
        $url = ajaxUrl(route('admin.marina_description',['marina_id'=>$obj->id]));
    }

    $result_array = array( 'result' => "success",'message' => $success_message , 'url' => $url);
    return response()->json($result_array);
    exit;

}



public function delete(Request $request, $id = 0)
{
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
        // $result_array['data_callback'] = 'hide_rable_row';
    return response()->json($result_array);
    exit;
}

public function getEmptyObject(){
 return new Marina();
}
public function findById($id){

    return Marina::withTrashed()->where("id",$id)->first();
}
}
