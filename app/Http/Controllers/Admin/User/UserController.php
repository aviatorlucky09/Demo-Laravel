<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Auth;
use App\Models\Company\Company;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');

    $arr = array();
    $arr['view_folder'] = "admin.users";
    $arr['singular_name'] = "User";
    $arr['plural_name'] = "Users";
    $arr['table_name'] = "users";
    $arr['update_route_name'] = 'admin.user_update';
    $arr['edit_route_name'] = 'admin.user_edit';
    $arr['delete_route_name'] = 'admin.user_delete';
    $arr['listing_url'] = ajaxUrl(route('admin.users'));
    $arr['create_url'] = ajaxUrl(route('admin.user_create'));
    $this->config_arr =$arr;

  }
  public function index(Request $request)
  { 
    
      if(!Auth::guard('admin')->user()->hasAccess('user_view')){
        return view('layouts.admin.no_access')->with(["name"=>"Users View"]);
      }

      $deleted = 0;
      if($request->deleted == 1){
        $deleted = 1;
      }  
      $user_type = $request->user_type;
      $carr = $this->config_arr; 
      $userTypes = User::getAllUserTypes();

      $view_path = getAdminViewFolderPath($carr,"_list");
      return view($view_path,compact('carr','deleted','userTypes','user_type'));      

}
public function processing(Request $request){

    $deleted = 0;
    if($request->deleted == 1){
      $deleted = 1;
    }

    $carr = $this->config_arr;     

    $visible_header = array("id","first_name","last_name","email","mobile","user_type","status","option");
    $db_header = array("first_name","last_name","email");
    $start = $request->start;
    $length = $request->length;
    $LIMIT_STR = "limit  $start, $length";
    $draw = $request->draw;
    $search_req = $request->search;
    $search = $search_req['value'];        

    /* global search */
      $query_obj = User::query();

        /* global search */

        if($search != ''){
            $query_obj->where(function ($query)  use ($db_header, $search){
                foreach($db_header as $key=>$_field){
                    $query->orWhere($_field ,'like', '%'.$search .'%');
                }
            });
        }
        if($deleted == 0){
            $query_obj->whereNull('deleted_at');
        }else{
            $query_obj->whereNotNull('deleted_at');
        }
        if($request->user_type == "user"){
          $query_obj->where('user_type','0');
        }else if($request->user_type == "rental_operator"){
          $query_obj->where('user_type','1');
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

              $data_raw_obj = User::where("id",$data_row->id)->first(); 
              $_data = array();
              $element_id = $data_row->id; 
              foreach($visible_header as $key=>$header){
                $_header = "";
                if ($header == "option") {
                  $obj = $data_raw_obj;
                  $view_path = getAdminViewFolderPath($carr,"_options");
                  $_header.= (string)View::make(  $view_path ,compact('obj','element_id','carr','deleted'));

                }else if($header == "status"){
                  if($data_row->status == 1){
                  $_header = "<h5><span class='badge badge-primary'>Active</span></h5>";
                }

              }else if($header == "user_type"){
                $_header = "<h5><span class='label label-warning'>".$data_raw_obj->getUserType()."</span></h5>";
              }else if($header == "mobile"){
              $mobile_no = $data_row->country_code;
              $mobile_no.= $data_row->mobile;
              $_header = telephoneNumberFormat($mobile_no);
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
    if(!Auth::guard('admin')->user()->hasAccess('user_create')){
        return view('layouts.admin.no_access')->with(["name"=>"Users Create"]);
    }
    $obj = $this->getEmptyObject();
    $obj->id            = 0;


    $carr               = $this->config_arr; 
    $userTypes = User::getAllUserTypes();
    $genderTypes = getAllGenderTypes();

    $view_path = getAdminViewFolderPath($carr,"_form");
    return view($view_path,compact('obj','carr','userTypes','genderTypes'));
  }


  public function edit(Request $request, $id = 0)
  {
    if(!Auth::guard('admin')->user()->hasAccess('user_modify')){
        return view('layouts.admin.no_access')->with(["name"=>"Users Create"]);
    }
    $obj = $this->findById($id);
    if(!$obj){
      return view('error.record_not_found');
    }

    $carr               = $this->config_arr; 
    $userTypes = User::getAllUserTypes();
    $genderTypes = getAllGenderTypes();

    $view_path = getAdminViewFolderPath($carr,"_form"); 

    return view($view_path,compact('obj','carr','userTypes','genderTypes'));
  }

  public function update(Request $request, $id = 0)
  {   
    if(!Auth::guard('admin')->user()->hasAccess('user_modify')){
      $result_array = array( 'result' => "error",'message' => "Access Denied" , 'url' => "");
      return response()->json($result_array);
    }   
    $carr = $this->config_arr; 
    $url = "";

    $v_arr =  array();
    
     $request->merge(['mobile' =>  trim(phoneNumberStringToNumber( $request->mobile))]);
      
    $v_arr['email']  = "required|email|unique:users,email,".$id;
    $v_arr['first_name'] ="required";
    $v_arr['last_name'] ="required";
    // $v_arr['user_type']  = "required|in:0,1";
    /* $v_arr['gender']  = "required|in:MALE,FEMALE"; */
    /* $v_arr['birth_date']  = "required"; */
    /* $v_arr['profile_picture'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';*/
    $v_arr['country_code'] ="required|numeric";
    $v_arr['mobile'] = 'required|min:10|max:11';

    if($request->user_type == 1 and $id == 0){
      $v_arr['operator_name'] = 'required|min:10';
    }
    if($request->change_pwd or $id == 0){
      $v_arr['password'] = "required|min:6";
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
          
            if($request->change_pwd){
              $obj->password = Hash::make($request->password);
            }
            $success_message = $carr['singular_name']. " Upated";
            

          }else{
             /******* create new Company First *******/
                $company = new Company();
                $company->name = $request->operator_name;
                $company->save();
             /*********** End company */
              $obj_created = 1;
              $obj = $this->getEmptyObject();
              $obj->company_id = $company->id;
              $obj->password = Hash::make($request->password);
              $url = $carr['listing_url'];
              $success_message = $carr['singular_name'] ." Created";

            }
            $allow_params = array();
            $allow_params[]  = "first_name";
            $allow_params[]  = "last_name";
            $allow_params[]  = "email";
            $allow_params[]  = "status";
            $allow_params[]  = "is_block";
            $allow_params[]  = "user_type";
            $allow_params[]  = "gender";
            $allow_params[]  = "country_code";
            $allow_params[]  = "mobile";

            foreach ($allow_params as $params){
              if($request->$params){
                $obj->$params = $request->$params;
              }
            }
            if(!empty($request->birth_date)){
              $obj->birth_date = date("Y-m-d",strtotime($request->birth_date));
            }
       /*if($request->password){
            $obj->password = Hash::make($request->password);
          }*/
          if($request->status == 0){
            $obj->status = 0;
          }
          if($request->is_block == 0){
            $request->is_block = 0;
          }
          if($request->user_type == 0){
            $request->user_type = 0;
          }
        
         $obj->save();
         $this->uploadImage($request,$obj);

        if($obj_created){
            $url = ajaxUrl(route('admin.user_detail',['user_id'=>$obj->id]));   
       }

   

       $result_array = array( 'result' => "success",'message' => $success_message , 'url' => $url);
       return response()->json($result_array);
       exit;

     }
     
     public function uploadImage($request, $user){

      
       $disk = config('filesystems.default');
       if($request->file('profile_picture')){
           $file = $request->file('profile_picture');
           $name= time().$file->getClientOriginalName();
           $filePath = User::PUBLIC_IMAGES. "/".$user->id ."/".$name;
           $file_store = Storage::disk($disk)->put($filePath,  file_get_contents($file));
                if($file_store){
                    $user->profile_picture = $name;
                    $user->save();
                    return response()->json(["message" => "User profile image uploaded successfully"]);
                }  

         }

     }
     
public function delete(Request $request, $id = 0)
{  
    if(!Auth::guard('admin')->user()->hasAccess('user_delete')){
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
     return new User();
   }
   public function findById($id){

    return User::withTrashed()->where("id",$id)->first();
  }
}
