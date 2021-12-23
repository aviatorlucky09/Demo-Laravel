<?php

namespace App\Http\Controllers\Admin;

use App\Models\System\AppLanguage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AppLanguageController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
        $arr = array();
        $arr['view_folder'] = "admin.app_lang";
        $arr['singular_name'] = "App Language";
        $arr['plural_name'] = "App Languages";
        $arr['table_name'] = "app_languages";
        $arr['update_route_name'] = 'admin.app_lang_update';
        $arr['edit_route_name'] = 'admin.app_lang_edit';
       /* $arr['listing_url'] = ajaxUrl(route('admin.app_configs'));*/
        $this->config_arr =$arr;

    }
    public function index(Request $request,$page)
    {   

       $deleted = 0;
       if($request->deleted == 1){
            $deleted = 1;
       }  
       $page = $request->page;
       $carr = $this->config_arr; 
       $view_path = getAdminViewFolderPath($carr,"_list");

       return view($view_path,compact('carr','deleted','page'));      

    }
    public function pages(Request $request){

        $carr = $this->config_arr; 

        $pages = AppLanguage::pages();

        $view_path = getAdminViewFolderPath($carr,"_pages");
       return view($view_path,compact('carr','pages'));
    }
    public function processing(Request $request){
        
       $deleted = 0;
       if($request->deleted == 1){
            $deleted = 1;
       }
        $page = $request->page;
        $carr = $this->config_arr;     

        $visible_header = array("id","lang_name","data_value","option");
        $db_header = array("lang_key","lang_name");
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
            $LIKE_STR .= '`app_languages`.`'.$_field."` LIKE '%".$search."%' OR ";    
            
               
          } 
          $LIKE_STR = trim(trim($LIKE_STR," "),"OR");
        }



        $join = "   ";
        
        
        $select = " `app_languages`.*";

        if(!empty($page)){
             $WHERE = " WHERE  page = '".$page."' ";

        }else{
            $WHERE = " WHERE  1 = 1";    
        }
  
        $ORDER_BY_STR = " ORDER BY `app_languages`.`id` DESC ";
        $SQL_ALL = "SELECT  $select FROM  app_languages $WHERE $LIKE_STR $ORDER_BY_STR $LIMIT_STR";
        
         
        
        
        //dd($SQL_ALL);
        $data_obj = DB::select($SQL_ALL);        

        $COUNT_ALL = "SELECT count(*) as total_records FROM   app_languages $WHERE $LIKE_STR";
        $total_obj = DB::select($COUNT_ALL);
        $SELECT_SQL = "";

        $table = array();
        $table['draw'] = $draw;
        $table['recordsTotal'] = $total_obj[0]->total_records;
        $table['recordsFiltered'] = $total_obj[0]->total_records;
        $table_data = array();

         
        foreach ($data_obj as $key => $data_row){

            $data_raw_obj = $this->findById($data_row->id);
            $_data = array();
            $element_id = $data_row->id; 
            foreach($visible_header as $key=>$header){
                $_header = "";
                if ($header == "option") {
                    $obj = $data_raw_obj;
                    $view_path = getAdminViewFolderPath($carr,"_options");
                    $_header.= (string)View::make(  $view_path ,compact('obj','element_id','carr','deleted'));
                    
                }
                // if ($header == "data_value") {

                // }
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
     
    
    public function edit(Request $request, $id = 0,$page)
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
        $obj = $this->findById($id);
           
        if($obj and $obj->data_type == "image"){
             $v_arr['file']  = "required";
        }else{
             $v_arr['data_value']  = "required";
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

        if($obj->data_type == "image"){
            // $disk = "local"; //config('filesystems.default');
            // if($request->file('file')){
            //     /**** Delete old image ****/
            //     $filePath = $obj->data_value;
            //     if (\Storage::disk($disk)->exists($filePath)){
            //         var_dump(\Storage::disk($disk)->exists($filePath));
            //         \Storage::disk($disk)->delete($filePath);
            //     }
            //     $file = $request->file('file');
            //     $name= $obj->config_key.".".$file->extension();
            //     $filePath = AppConfig::CONFIG_IMAGES."/".$name;
            //     $file_store = Storage::disk($disk)->put($filePath,  file_get_contents($file));
            //     if($file_store){
            //         $obj->data_value = $filePath;
            //     }
            // }
        }
        else{
            $allow_params = array();
            $allow_params[]  = "data_value";
            foreach ($allow_params as $params){
                if($request->$params){
                    $obj->$params = $request->$params;
                }
            }
       
        }

       $obj->save();
      
        $result_array = array( 'result' => "success",'message' => $success_message , 'url' => $url);
        return response()->json($result_array);
        exit;
 
    }
     

     
    public function delete(Request $request, $id = 0)
    {   
       
    }

    public function getEmptyObject(){
         return new AppLanguage();
    }
    public function findById($id){

        return AppLanguage::where("id",$id)->first();
    }
}
