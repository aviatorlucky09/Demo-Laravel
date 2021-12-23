<?php


namespace App\Http\Controllers\Admin\Boat;

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
use App\Models\Boat\BoatType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

 
class BoatTypeController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth:admin');
        $arr = array();
        $arr['view_folder'] = "admin.boat_types";
        $arr['singular_name'] = "Boat Type";
        $arr['plural_name'] = "Boat Types";
        $arr['table_name'] = "boat_types";
        $arr['update_route_name'] = 'admin.boat_type_update';
        $arr['edit_route_name'] = 'admin.boat_type_edit';
        $arr['delete_route_name'] = 'admin.boat_type_delete';
        $arr['listing_url'] = ajaxUrl(route('admin.boat_types'));
        $arr['create_url'] = ajaxUrl(route('admin.boat_type_create'));
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

        $visible_header = array("id","name","is_active","option");
        $db_header = array("name");
        $start = $request->start;
        $length = $request->length;
        $draw = $request->draw;
        $search_req = $request->search;
        $search = $search_req['value'];        

        $query_obj = BoatType::query(); 
       

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
      
        $query_obj->orderBy('sort_order', 'ASC');
  
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
        // $v_arr['sort_order'] ="required|numeric";
      
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
       $allow_params[] =  "display_on_homepage";
       $allow_params[] =  "is_active";
       
       foreach ($allow_params as $params){
        if($request->$params){
            $obj->$params = $request->$params;
        }
       }
       if($request->sort_order == 0){
         $obj->sort_order =0;
       }
       if($request->display_on_homepage == 0){
            $obj->display_on_homepage =0;
       }
       
       $obj->save();
       $this->uploadImage($request,$obj);
        $result_array = array( 'result' => "success",'message' => $success_message , 'url' => $url);
        return response()->json($result_array);
        exit;

    }
    public function uploadImage($request, $boatType){

      
       $disk = config('filesystems.default');
       if($request->file('image')){

           $file = $request->file('image');
           // $name= time().$file->getClientOriginalName();
           $name= time()."_".$boatType->id.".".$file->extension();
           $filePath = BoatType::PUBLIC_IMAGES. "/".$boatType->id ."/".$name;
           $file_store = Storage::disk($disk)->put($filePath,  file_get_contents($file));
           if($file_store){
                /***** Delete Old files *****/
                $oldFilePath = $boatType->image;
                if (\Storage::disk($disk)->exists($oldFilePath))
                    \Storage::disk($disk)->delete($oldFilePath);

                $boatType->image = $filePath;
                $boatType->save();
                return response()->json(["message" => "Boat type image uploaded successfully"]);
            }  

         }

    }

    public function position(Request $request){

        $boatTypes = BoatType::whereNull('deleted_at')->where('is_active',1)->orderBy('sort_order','asc')->pluck('name','id');
        $carr = $this->config_arr;
        $view_path = getAdminViewFolderPath($carr,"_position");

        return view($view_path,compact('carr','boatTypes'));  

    }
    public function positionUpdate(Request $request){
        
        $pos_arr = $request->pos_arr;
         //dd($pos_arr);
        foreach($pos_arr as $_position){

            $boatTypeId = $_position[0];
            $position = $_position[1];

            $boatType = BoatType::find($boatTypeId);
            if($boatType){
              $boatType->sort_order = $position;
              $boatType->save();
          }
      }
      $url="";
      $resultArray = array('result' => "success",'message' => "Position Updated Successfully" , 'url' => $url);
      return response()->json($resultArray);
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
         return new BoatType();
    }
    public function findById($id){
        
         return BoatType::withTrashed()->where("id",$id)->first();
    }
   
    
    
}
