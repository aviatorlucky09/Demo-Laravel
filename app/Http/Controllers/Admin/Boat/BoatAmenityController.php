<?php


namespace App\Http\Controllers\Admin\Boat;

use App\Models\Boat\BoatAmenity;
use App\Models\Boat\BoatAmenityRelation;
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
use App\Models\Boat\Boat;
use Illuminate\Support\Facades\Hash;


class BoatAmenityController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth:admin');
        $arr = array();
        $arr['view_folder'] = "admin.boat_amenities";
        $arr['singular_name'] = "Boat Amenity";
        $arr['plural_name'] = "Boat Amenities";
        $arr['table_name'] = "boat_amenities";
        $arr['update_route_name'] = 'admin.boat_amenity_update';
        $arr['edit_route_name'] = 'admin.boat_amenity_edit';
        $arr['delete_route_name'] = 'admin.boat_amenity_delete';
        $arr['listing_url'] = ajaxUrl(route('admin.boat_amenities'));
        $arr['create_url'] = ajaxUrl(route('admin.boat_amenity_create'));
        $this->config_arr =$arr;

    }
    public function index(Request $request)
    {

        $deleted = 0;
        if($request->deleted == 1){
            $deleted = 1;
        }  
        $time_type = $request->time_type;
        $carr = $this->config_arr; 
        $view_path = getAdminViewFolderPath($carr,"_list");

        return view($view_path,compact('carr','deleted','time_type'));    

    }
    public function boat_amenity($boat_id){
        
        $boat = Boat::where('id',$boat_id)->first();
        $active_tab = "amenity";
        $boatAmenities = BoatAmenity::where('is_active',1)->pluck('name','id')->toArray();

        if(!$boat){
            return view('error.page_not_found');
        } 

        return view('admin.boats.amenity',compact("boat","active_tab","boatAmenities"));
    }
    public function boat_amenity_store(Request $request,$boat_id){

        //dd($request->all());
        if(is_array($request->amenities_id) and isset($request->amenities_id)){

          $_array =  $request->amenities_id;

          $amenity_ids_array = array_unique($_array);

          $_boat_amenity = BoatAmenityRelation::where('boat_id',$boat_id)->first();

          if($_boat_amenity){
            $boat_amenities = BoatAmenityRelation::where('boat_id',$boat_id)->get();

                //Remove amenities not in array
            foreach($boat_amenities as $boat_amenity){
                if(!(in_array($boat_amenity->amenities_id, $amenity_ids_array))){
                    $boat_amenity->delete();
                    
                    foreach($amenity_ids_array as $amenity_id){
                            //Add amenity
                        $exist_record = BoatAmenityRelation::where('boat_id',$boat_id)->where('amenity_id',$amenity_id)->first();
                        if($exist_record){
                            continue;
                        }else{
                            $_amenity = new BoatAmenityRelation();
                            $_amenity->boat_id = $boat_id;
                            $_amenity->amenity_id = $amenity_id;
                            $_amenity->save();
                        }             
                        
                    }
                }else{
                    foreach($amenity_ids_array as $amenity_id){
                            //Add amenity 
                     $exist_record = BoatAmenityRelation::where('boat_id',$boat_id)->where('amenity_id',$amenity_id)->first();
                     if($exist_record){
                        continue;
                    }
                    $_amenity = new BoatAmenityRelation();
                    $_amenity->boat_id = $boat_id;
                    $_amenity->amenity_id = $amenity_id;
                    $_amenity->save();
                    
                    
                }

            }
        }
    }else{
        foreach($amenity_ids_array as $amenity_id){
                        //Add amenity 
         $_amenity = new BoatAmenityRelation();
         $_amenity->boat_id = $boat_id;
         $_amenity->amenity_id = $amenity_id;
         $_amenity->save();
     }
 }

}else{

    $boat_amenities = BoatAmenityRelation::where('boat_id',$boat_id)->get();
    foreach($boat_amenities as $amenity){
        $amenity->delete();
    }
}
$url = "";
$result_array = array( 'result' => "success",'message' => 'Boat Amenities Updated Successfully' , 'url' => $url);
return response()->json($result_array);
exit;

}
public function processing(Request $request){

 $deleted = 0;
 if($request->deleted == 1){
    $deleted = 1;
}

$carr = $this->config_arr;     

$visible_header = array("id","name","is_active","option");
$db_header = array("name");
$start = $request->start;
$length = $request->length;
$draw = $request->draw;
$search_req = $request->search;
$search = $search_req['value'];        

$query_obj = BoatAmenity::query(); 


/* global search */
if($search != ''){
    $query_obj->where(function ($query)  use ($db_header, $search){
        foreach($db_header as $key=>$_field){  
            $query->orWhere($_field ,'like', '%'.$search .'%');    
        }
    });
}


       /* $join = " admins ";
          
       $select = " `admins`.*";*/

        /*if($deleted == 0){  
            $query_obj->whereNull('deleted_at');
        }else{
            $query_obj->whereNotNull('deleted_at');
        }
        */

        
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
                    
                }else if($header == "is_active"){
                    if($data_row->is_active == 1){
                       $_header = "<h5><span class='badge badge-primary'>Active</span></h5>";
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

    $obj = $this->getEmptyObject();
    $obj->id            = 0;


    $carr               = $this->config_arr; 

    $view_path = getAdminViewFolderPath($carr,"_form");
    return view($view_path,compact('obj','carr'));
}

public function edit(Request $request, $id = 0)
{
    $obj = $this->findById($id);

    if(!$obj){
        return view('error.record_not_found');
    }

    $carr               = $this->config_arr; 
    $view_path = getAdminViewFolderPath($carr,"_form"); 

    return view($view_path,compact('obj','carr'));
}

public function update(Request $request, $id = 0)
{   
        //dd($request->all());

    $carr = $this->config_arr; 
    $url = "";

    $v_arr =  array();

    $v_arr['name'] ="required";
    $v_arr['sort_order'] ="required|numeric";

    $v = Validator::make($request->all(), $v_arr );
    if ($v->fails())
    {   
        return response()->json(getValidationErrorJson($v));
        exit;
    }

        // Check unique email id
    if($id){
        $obj = $this->findById($id);
        if(!$obj){
            $result_array = array( 'result' => "error",'message' => $carr['singular_name']." Not found",'error_list' => "");
            return response()->json($result_array);
            exit;
        }

        $success_message = $carr['singular_name']. " Upated";


    }else{

        $obj = $this->getEmptyObject();

        $url = $carr['listing_url'];
        $success_message = $carr['singular_name'] ." Created";

    }
    $allow_params = array();

    $allow_params[]  = "name";
    $allow_params[] =  "sort_order";
    $allow_params[] =  "is_active";

    foreach ($allow_params as $params){
        if($request->$params){
            $obj->$params = $request->$params;
        }
    }
    if($request->sort_order == 0){
       $obj->sort_order =0;
   }
   if($request->is_active == 0){
    $obj->is_active =0;
}

$obj->save();

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
   return new BoatAmenity();
}
public function findById($id){

   return BoatAmenity::withTrashed()->where("id",$id)->first();
}



}
