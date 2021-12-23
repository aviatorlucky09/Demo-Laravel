<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Company\RentalOperatorInquiry;
use App\Models\User\User;
use App\Models\Company\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use View;

class OperatorInquiryController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth:admin');
        $arr = array();
        $arr['view_folder'] = "admin.rental_operator_inquiries";
        $arr['singular_name'] = "Rental Operator Inquiry";
        $arr['plural_name'] = "Rental Operator Inquiries";
        $arr['table_name'] = "rental_operator_inquiries";
        $arr['update_route_name'] = 'admin.rental_operator_inquiry_update';
        $arr['edit_route_name'] = 'admin.rental_operator_inquiry_edit';
        $arr['delete_route_name'] = 'admin.rental_operator_inquiry_delete';
        $arr['listing_url'] = ajaxUrl(route('admin.rental_operator_inquiries'));
        $arr['create_url'] = ajaxUrl(route('admin.rental_operator_inquiry_create'));
        $this->config_arr =$arr;

    }
    public function index(Request $request)
    {
       
       $deleted = 0;
       if($request->deleted == 1){
            $deleted = 1;
       }  
        $statusList = RentalOperatorInquiry::statusList();


        $_status = "";
        if(!empty($request->status) and isset($request->status)){
            $_status = $request->status;
        }
       $carr = $this->config_arr; 
       $view_path = getAdminViewFolderPath($carr,"_list");

       return view($view_path,compact('carr','deleted','statusList','_status'));    
      
    }
    public function processing(Request $request){

       $deleted = 0;
       if($request->deleted == 1){
            $deleted = 1;
       }

       $carr = $this->config_arr;     

        $visible_header = array("id","email_id","contact_number","company_name","status","option");
        $db_header = array("email_id","company_name","contact_number","status");
        $start = $request->start;
        $length = $request->length;
        $draw = $request->draw;
        $search_req = $request->search;
        $search = $search_req['value'];        

        $query_obj = RentalOperatorInquiry::query(); 
       

        /* global search */
        if($search != ''){
            $query_obj->where(function ($query)  use ($db_header, $search){
                foreach($db_header as $key=>$_field){  
                    $query->orWhere($_field ,'like', '%'.$search .'%');    
                }
            });
         }


        if($deleted == 1){  
            $query_obj->whereNotNull('deleted_at');
        }else{
            $query_obj->whereNull('deleted_at');
            
        }
         /*Search with status*/
        if(!empty($request->status) and isset($request->status) and $request->status !== ""){

            $query_obj->where('status',$request->status);
        }
         
        $query_obj->orderBy('id', 'DESC');
  
        $query_obj_count = $query_obj;

        $total_records = $query_obj_count->withTrashed()->count();

        $data_obj = $query_obj->withTrashed()->skip($start)->take($length)->get();
       

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
                else if($header == "contact_number"){
                    $_header = $data_row->contact_number_str;
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
        /*** if inquery is approved then not allwo to edit */
        if($obj->status == "approved"){
            $view_path = getAdminViewFolderPath($carr,"_approve_action"); 
            return view($view_path,compact('obj','carr'));
        }
        
        $statusList = RentalOperatorInquiry::statusList();
        $view_path = getAdminViewFolderPath($carr,"_form"); 
          
        return view($view_path,compact('obj','carr','statusList'));
    }
   
    public function update(Request $request, $id = 0)
    {   
        $statusList = array_keys(RentalOperatorInquiry::statusList());
        $request->merge(['contact_number' =>  trim(phoneNumberStringToNumber( $request->contact_number))]);
       
        $carr = $this->config_arr; 
        $url = "";

        $v_arr =  array();
       
        $v_arr['company_name'] ="required";
        $v_arr['update_note']  = "required";
        $v_arr['status']       = "required|in:".implode(",",$statusList);
        $v_arr['contact_number'] = "required|digits:10";
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

       $allow_params[]  = "company_name";
       $allow_params[]  = "status";
       $allow_params[]  = "contact_number";
       
       
      
       foreach ($allow_params as $params){
        if(isset($request->$params)){
            $obj->$params = $request->$params;
        }
       }
       $obj->status_note = $request->update_note;
       $obj->save();
       /**** Update History */
       $obj->createHistory(\Auth::guard('admin')->user()->full_name,$request->update_note);
       
       $url =  ajaxUrl(route($carr['edit_route_name'],['id'=>$obj->id,"t"=>time()]));
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
    public function action(Request $request, $id)
    { 
        $obj = $this->findById($id);
      
        if(!$obj){
            return view('error.record_not_found');
        }
        $action  = $request->action;
        if($action == "approve"){
            return $this->actionApprove($request,$obj);
        }


    }
    public function saveAction(Request $request, $id = "")
    { 

        $obj = $this->findById($id);
        $action = $request->action;
        if(!$obj){
            $result_array = array( 'result' => "error",'message' => $carr['singular_name']." not found",'error_list' => "");
            return response()->json($result_array);
            exit;
        }

        if($action == "approve"){
            return $this->saveActionApprove($request , $obj);
        }


        
    }
    private function actionApprove(Request $request, $obj){
        $carr = $this->config_arr;
        $view_path = getAdminViewFolderPath($carr,"_approve_action"); 
        return view($view_path,compact('obj','carr'));
    }

    private function saveActionApprove(Request $request, $obj){
        $carr = $this->config_arr;
        $v_arr =  array();
        $v_arr['update_note']  = "required";
        $v = Validator::make($request->all(), $v_arr );
        if ($v->fails()){   
            return response()->json(getValidationErrorJson($v));
        } 
        /****** check company already have email id */

        $company = Company::where('email_id',$obj->email_id)->first();
        if($company){
            $result_array = array( 'result' => "error",'message' => "Company already exists at $obj->email_id ",'error_list' => "");
            return response()->json($result_array);
            exit;
        }
        /******** Check user exists */
        $company = User::where('email',$obj->email_id)->first();
        if($company){
            $result_array = array( 'result' => "error",'message' => "User already exists at $obj->email_id ",'error_list' => "");
            return response()->json($result_array);
            exit;
        }

        /***** Update status of inquiry */
        $obj->status = "approved";
        $obj->createHistory(\Auth::guard('admin')->user()->full_name,$request->update_note);

        /**** Create User  */
        $user               = new User();
        $user->first_name   = $obj->company_name;
        $user->email        = $obj->email_id;
        $user->mobile       = $obj->contact_number;
        $user->user_type    = '1';
        $user->password     = bcrypt(rand(1,1000));
        $user->save();

        $company            = new Company();
        $company->user_id   = $user->id;
        $company->email_id  = $obj->email_id;
        $company->name      = $obj->company_name;
        $company->address   = $obj->address;
        $company->about_company = $obj->about_company;
        $company->latitude  = $obj->latitude;
        $company->longitude = $obj->longitude;
        $company->save();

        $user->company_id   = $company->id;
        $user->save();

        $obj->user_id       = $user->id;
        $obj->company_id    = $company->id;
        $obj->save();

        $url =  ajaxUrl(route('admin.rental_operator_inquiry_action',['id'=>$obj->id,'action'=>'approve',"t"=>time()]));
        $result_array = array( 'result' => "success",'message' => "Operator created successfully",'url' => $url);
        return response()->json($result_array);
        
        

        /******  */

    }


    




    public function getEmptyObject(){
         return new RentalOperatorInquiry();
    }
    public function findById($id){
        
         return RentalOperatorInquiry::withTrashed()->where("id",$id)->first();
    }
   
    
    
}