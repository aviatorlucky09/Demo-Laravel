<?php

namespace App\Http\Controllers\Admin\User;
 
use App\Models\Company\Company;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use View;


class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $arr = array();
        $arr['view_folder'] = "admin.companies";
        $arr['singular_name'] = "Company";
        $arr['plural_name'] = "Companies";
        $arr['table_name'] = "companies";
        $arr['update_route_name'] = 'admin.company_update';
        $arr['edit_route_name'] = 'admin.company_edit';
        $arr['delete_route_name'] = 'admin.company_delete';
        $arr['listing_url'] = ajaxUrl(route('admin.companies'));
        $arr['create_url'] = ajaxUrl(route('admin.company_create'));
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

        $_status = "";
        if(!empty($request->status) and isset($request->status)){
            $_status = $request->status;
        }
       $statusArr = Company::statusArr();
 
       return view($view_path,compact('carr','deleted','statusArr','_status'));    
      
    }
    public function processing(Request $request){

       $deleted = 0;
       if($request->deleted == 1){
            $deleted = 1;
       }

       $carr = $this->config_arr;     

        $visible_header = array("id","name","email_id","status","commission_percentage","option");
        $db_header = array("name","email_id");
        $start = $request->start;
        $length = $request->length;
        $draw = $request->draw;
        $search_req = $request->search;
        $search = $search_req['value'];        

        $query_obj = Company::query(); 
       

        /* global search */
        if($search != ''){
            $query_obj->where(function ($query)  use ($db_header, $search){
                foreach($db_header as $key=>$_field){  
                    $query->orWhere($_field ,'like', '%'.$search .'%');    
                }
            });
        }

          /*Search with status*/
        if(!empty($request->status) and isset($request->status) and $request->status !== ""){

            $query_obj->where('status',$request->status);
        }
        
        if($deleted == 0){  
            $query_obj->whereNull('deleted_at');
        }else{
            $query_obj->whereNotNull('deleted_at');
        }
        
        
        $query_obj->orderBy('id', 'DESC');
  
        $query_obj_count = $query_obj;

        $total_records = $query_obj_count->withTrashed()->count();

        $data_obj = $query_obj->skip($start)->take($length)->withTrashed()->get();
       

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

        $active_tab = "company";
        $view_path = getAdminViewFolderPath($carr,"_form"); 
          
        return view($view_path,compact('obj','carr','active_tab'));
    }
   
    public function update(Request $request, $id = 0)
    {   
        //dd($request->all());

        $carr = $this->config_arr; 
        $url = "";

        $v_arr =  array();
       
        $v_arr['company_name'] ="required|max:50";
        $v_arr['address'] ="required|max:500";
        $v_arr['commission_percentage'] ="required|min:0|max:40";
        

        
      
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
       $allow_params[] =  "address";
       $allow_params[] =  "zipcode";
       $allow_params[] =  "commission_percentage";
       $allow_params[] =  "about_company";
       
        
       foreach ($allow_params as $params){
        if(isset($request->$params)){
            $obj->$params = $request->$params;
        }
       }
       if(isset($request->postal_code)){
            $obj->zipcode = $request->postal_code;
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
    public function users(Request $request, $id = 0){

        $carr = $this->config_arr;
        $obj = $this->findById($id);
        if(!$obj){
            return view('error.record_not_found');
        }
        $companyUsers = User::where('company_id',$id)->select('id','first_name','last_name','email','mobile','user_type','status')->get();
       
        $view_path = getAdminViewFolderPath($carr,"_users"); 
        $active_tab = "users";
        return view($view_path,compact('obj','carr','active_tab','companyUsers'));
    }

    
    

    public function getEmptyObject(){
         return new Company();
    }
    public function findById($id){
        
         return Company::withTrashed()->where("id",$id)->first();
    }
}
