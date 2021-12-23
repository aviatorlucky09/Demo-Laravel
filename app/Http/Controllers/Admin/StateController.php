<?php

namespace App\Http\Controllers\Admin;

use App\Models\System\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;

class StateController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
        $arr = array();
        $arr['view_folder'] = "admin.state";
        $arr['singular_name'] = "State";
        $arr['plural_name'] = "States";
        $arr['table_name'] = "states";
        $arr['update_route_name'] = 'admin.state_update';
        $arr['edit_route_name'] = 'admin.state_edit';
        $arr['delete_route_name'] = 'admin.state_delete';
        $arr['listing_url'] = ajaxUrl(route('admin.states'));
        $arr['create_url'] = ajaxUrl(route('admin.state_create'));
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

        $visible_header = array("id","country_name","name","is_active","option");
        $db_header = array("name","country_name");
        $start = $request->start;
        $length = $request->length;

        $LIMIT_STR = "limit  $start, $length";

        $draw = $request->draw;
        $search_req = $request->search;
        $search = $search_req['value'];        

         
        
        /* global search */

        $LIKE_STR = '';
        if($search != ''){
          $LIKE_STR = " AND ";
          foreach($db_header as $key=>$header){         
            $_field =  $header ;
            if($_field == "country_name"){
                $LIKE_STR .= "`countries`.`name` LIKE '%".$search."%' OR ";        
                continue;
            }
            $LIKE_STR .= '`states`.`'.$_field."` LIKE '%".$search."%' OR ";    
            
               
          } 
          $LIKE_STR = trim(trim($LIKE_STR," "),"OR");
        }

        $join = "   states LEFT JOIN countries ON countries.id = states.country_id ";
        
        
        
        $select = " `states`.* ,`countries`.`name` as country_name";

       
        /*if($deleted == 0){
            $WHERE = " WHERE `states`.`deleted_at` IS null ";
        }else{
            $WHERE = " WHERE `states`.`deleted_at` IS NOT NULL ";
        }*/
         $WHERE = " WHERE 1 = 1";
         
       

        $ORDER_BY_STR = " ORDER BY `states`.`id` DESC ";
        
        $SQL_ALL = "SELECT  $select FROM $join $WHERE $LIKE_STR $ORDER_BY_STR $LIMIT_STR";
        
         
        
        
        //dd($SQL_ALL);
        $data_obj = DB::select($SQL_ALL);        

        $COUNT_ALL = "SELECT count(*) as total_records FROM  $join $WHERE $LIKE_STR";
        $total_obj = DB::select($COUNT_ALL);
        $SELECT_SQL = "";

        $table = array();
        $table['draw'] = $draw;
        $table['recordsTotal'] = $total_obj[0]->total_records;
        $table['recordsFiltered'] = $total_obj[0]->total_records;
        $table_data = array();

         
        foreach ($data_obj as $key => $data_row){

            $data_raw_obj = State::where("id",$data_row->id)->first(); 
            $_data = array();
            $element_id = $data_row->id; 
            foreach($visible_header as $key=>$header){
                $_header = "";
                if ($header == "option") {
                    $obj = $data_raw_obj;
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
        $carr = $this->config_arr; 
        $url = "";

        $v_arr =  array();
    
        
        $v_arr['name']  = "required|unique:states,name,".$id;
        $v_arr['country_id'] = "required";
        $v_arr['sort_order'] = "required|numeric";
         
          
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
       $allow_params[] = "country_id";
       $allow_params[] = "is_active";
       $allow_params[]  = "sort_order";

       foreach ($allow_params as $params){
        if($request->$params){
            $obj->$params = $request->$params;
        }
       }
       if($request->is_active == 0){
        $request->is_active = 0;
       }
       if($request->sort_order == 0){
            $request->sort_order = 0;
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
         return new State();
    }
    public function findById($id){

        return State::withTrashed()->where("id",$id)->first();
    }
}
