<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;
use Auth;
use App\Models\System\DepositeReason;

class DepositeReasonController extends Controller
{
 public function __construct()
 {
    $this->middleware('auth:admin');
    $arr = array();
    $arr['view_folder'] = "admin.deposite_reasons";
    $arr['singular_name'] = "Deposite Reason";
    $arr['plural_name'] = "Deposite Reasons";
    $arr['table_name'] = "deposite_reasons";
    $arr['update_route_name'] = 'admin.deposite_reason_update';
    $arr['edit_route_name'] = 'admin.deposite_reason_edit';
    $arr['delete_route_name'] = 'admin.deposite_reason_delete';
    $arr['listing_url'] = ajaxUrl(route('admin.deposite_reasons'));
    $arr['create_url'] = ajaxUrl(route('admin.deposite_reason_create'));
    $this->config_arr =$arr;

}
public function index(Request $request)
{
   $deleted = 0;
   if($request->deleted == 1){
    $deleted = 1;
} 
$carr = $this->config_arr; 
$view_path = getAdminViewFolderPath($carr,"_list");
return view($view_path,compact('carr','deleted'));      

}

public function processing(Request $request){

   $deleted = 0;
   if($request->deleted == 1){
    $deleted = 1;
}

$carr = $this->config_arr;     

$visible_header = array("id","reason","option");
$db_header = array("reason");
$start = $request->start;
$length = $request->length;
$draw = $request->draw;
$search_req = $request->search;
$search = $search_req['value'];        

$query_obj = DepositeReason::query(); 

/* global search */
if($search != ''){
    $query_obj->where(function ($query)  use ($db_header, $search){
        foreach($db_header as $key=>$_field){  
            $query->orWhere($_field ,'like', '%'.$search .'%');    
        }
    });
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
                    
                }else{
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
    
    $v_arr['reason']  = "required|unique:deposite_reasons,reason,".$id;
    
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
   
    $allow_params[]  = "reason";
    
    foreach ($allow_params as $params){
        if($request->$params){
            $obj->$params = $request->$params;
        }
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
    return response()->json($result_array);
    exit;
}

public function getEmptyObject(){
 return new DepositeReason();
}
public function findById($id){

    return DepositeReason::withTrashed()->where("id",$id)->first();
}
}