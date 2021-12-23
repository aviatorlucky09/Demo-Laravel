<?php


namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;
use Illuminate\Support\Facades\Validator;
use App\Config;
use View;
use Illuminate\Support\Str;
use Auth;
use App\Models\User\AdminRole;
use App\Models\User\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $arr = array();
        $arr['view_folder'] = "admin.admins";
        $arr['singular_name'] = "Admin";
        $arr['plural_name'] = "Admins";
        $arr['table_name'] = "admins";
        $arr['update_route_name'] = 'admin.admin_update';
        $arr['edit_route_name'] = 'admin.admin_edit';
        $arr['delete_route_name'] = 'admin.admin_delete';
        $arr['listing_url'] = ajaxUrl(route('admin.admins'));
        $arr['create_url'] = ajaxUrl(route('admin.admin_create'));
        $this->config_arr =$arr;

    }
    public function index(Request $request)
    {
        if(!Auth::guard('admin')->user()->hasAccess('admin_user_view') and !Auth::guard('admin')->user()->hasAccess('sub_user_view')){
            return view('layouts.admin.no_access')->with(["name"=>"Admin User View"]);
        } 

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

        $visible_header = array("id","first_name","last_name","email","role_name","option");
        $db_header = array("first_name","last_name","email",'role_name');
        $start = $request->start;
        $length = $request->length;
        $draw = $request->draw;
        $search_req = $request->search;
        $search = $search_req['value'];

        $query_obj = Admin::query();
        $query_obj->select("admins.*",'admin_roles.name as role_name');
        $query_obj->leftJoin('admin_roles', 'admin_roles.id', '=', 'admins.role_id');

        /* global search */
        if($search != ''){
            $query_obj->where(function ($query)  use ($db_header, $search){
                foreach($db_header as $key=>$_field){
                    if($_field == "role_name"){
                        $query->orWhere("admin_roles.name" ,'like', '%'.$search .'%');
                    }else{
                        $query->orWhere("admins.".$_field ,'like', '%'.$search .'%');
                    }

                }
            });
         }


        $join = " admins ";

        $select = " `admins`.*";

        if($deleted == 0){
            $query_obj->whereNull('admins.deleted_at');
        }else{
            $query_obj->whereNotNull('admins.deleted_at');
        }
 
        if(!Auth::guard('admin')->user()->hasAccess('admin_user_view')){
            $query_obj->where('admins.role_id', Auth::guard('admin')->user()->role_id);
        }


        $query_obj->withTrashed();


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
        if(!Auth::guard('admin')->user()->hasAccess('admin_user_create') and !Auth::guard('admin')->user()->hasAccess('sub_user_create')){
            return view('layouts.admin.no_access')->with(["name"=>"Admin User Create"]);
        }
        $allowDepartmentChange = 0;
        if(Auth::guard('admin')->user()->hasAccess('admin_user_create')){
            $allowDepartmentChange = 1;
        } 

        $obj = $this->getEmptyObject();
        $obj->id            = 0;
        $adminRoles         = AdminRole::select("id","name")->get();
        $roleModules        = AdminRole::roleModules();

        $carr               = $this->config_arr;

        $view_path = getAdminViewFolderPath($carr,"_form");
        return view($view_path,compact('obj','carr','adminRoles','roleModules','allowDepartmentChange'));
    }

    public function edit(Request $request, $id = 0)
    {
        if(!Auth::guard('admin')->user()->hasAccess('admin_user_modify') and !Auth::guard('admin')->user()->hasAccess('sub_user_modify')){
            return view('layouts.admin.no_access')->with(["name"=>"Admin User Modify"]);
        }
        $allowDepartmentChange = 0;
        if(Auth::guard('admin')->user()->hasAccess('admin_user_modify')){
            $allowDepartmentChange = 1;
        } 
        $obj = $this->findById($id);

        if(!$obj){
            return view('error.record_not_found');
        }
        $adminRoles         = AdminRole::select("id","name")->get();
        $roleModules        = AdminRole::roleModules();
        $carr               = $this->config_arr;
        $view_path = getAdminViewFolderPath($carr,"_form");

        return view($view_path,compact('obj','carr','adminRoles','roleModules','allowDepartmentChange'));
    }
    public function permissions(Request $request, $id = 0)
    {
        if(!Auth::guard('admin')->user()->hasAccess('admin_user_modify') and !Auth::guard('admin')->user()->hasAccess('sub_user_modify')){
            return view('layouts.admin.no_access')->with(["name"=>"Admin User Permission Modify"]);
        } 
        $allowDepartmentChange = 0;
        if(Auth::guard('admin')->user()->hasAccess('admin_user_modify')){
            $allowDepartmentChange = 1;
        } 
        $obj = $this->findById($id);

        if(!$obj){
            return view('error.record_not_found');
        }
        $adminRoles         = AdminRole::select("id","name")->get();
        $roleModules        = AdminRole::roleModules();
        $carr               = $this->config_arr;
        $view_path = getAdminViewFolderPath($carr,"_permissions");

        return view($view_path,compact('obj','carr','adminRoles','roleModules','allowDepartmentChange'));
    }
 
    public function update(Request $request, $id = 0)
    {
       if(!Auth::guard('admin')->user()->hasAccess('admin_user_modify') and !Auth::guard('admin')->user()->hasAccess('sub_user_modify')){
            $result_array = array( 'result' => "error",'message' => "Access Denied" , 'url' => "");
            return response()->json($result_array);
       };

       if($request->permission_tab){
           return $this->updatePermissions($request, $id);
       }
        $carr = $this->config_arr;
        $url = "";

        $v_arr =  array();

        $v_arr['first_name'] ="required";
        $v_arr['last_name'] ="required";
        $v_arr['email']  = "required|email|unique:admins,email,".$id;
        if(Auth::guard('admin')->user()->hasAccess('admin_user_modify')){
            $v_arr['role_id'] = "required";
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
            if(!$obj){
                $result_array = array( 'result' => "error",'message' => $carr['singular_name']." Not found",'error_list' => "");
                return response()->json($result_array);
                exit;
            }
            if($request->change_pwd){
                $obj->password = bcrypt($request->password);
            }
            $success_message = $carr['singular_name']. " Upated";


        }else{
             $v_arr['password'] = "required|min:6";
             $v = Validator::make($request->all(), $v_arr );
            if ($v->fails())
            {
                return response()->json(getValidationErrorJson($v));
                exit;
            }
            $obj = $this->getEmptyObject();
            $obj->password = bcrypt($request->password);
            $obj->created_by = Auth::guard('admin')->user()->id;

            $url = $carr['listing_url'];
            $success_message = $carr['singular_name'] ." Created";
            if(Auth::guard('admin')->user()->hasAccess('sub_user_modify')){
               $obj->role_id = Auth::guard('admin')->user()->role_id;     
            }

        }
       $allow_params = array();

       $allow_params[]  = "first_name";
       $allow_params[] =  "last_name";
       $allow_params[] =  "email";
       if(Auth::guard('admin')->user()->hasAccess('admin_user_modify')){
            $allow_params[] = "role_id";
       }

       foreach ($allow_params as $params){
        if($request->$params){
            $obj->$params = $request->$params;
        }
       }
        $permission  = array();
        if(is_array($request->r)){
            $permission = $request->r;
        }
        $obj->permission = json_encode($permission);
        $obj->save();


        $obj->save();

        $result_array = array( 'result' => "success",'message' => $success_message , 'url' => $url);
        return response()->json($result_array);
        exit;

    }
    public function updatePermissions(Request $request, $id = 0){
        if(!Auth::guard('admin')->user()->hasAccess('admin_user_modify') and Auth::guard('admin')->user()->hasAccess('sub_user_modify')){
            $result_array = array( 'result' => "error",'message' => "Access Denied" , 'url' => "");
            return response()->json($result_array);
        };
        $carr = $this->config_arr;
        $obj = $this->findById($id);
        if(!$obj){
            $result_array = array( 'result' => "error",'message' => $carr['singular_name']." Not found",'error_list' => "");
            return response()->json($result_array);
            exit;
        }
        $permission  = array();
        if(is_array($request->r)){
            $permission = $request->r;
        }
        $obj->permission = json_encode($permission);
        $obj->save();
        $success_message = $carr['singular_name']. " Permissions Upated";
        $result_array = array( 'result' => "success",'message' => $success_message , 'url' => '');
        return response()->json($result_array);
        exit;


    }



    public function delete(Request $request, $id = 0)
    {
        if(!Auth::guard('admin')->user()->hasAccess('admin_user_delete')){
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
        // $result_array['data_callback'] = 'hide_rable_row';
        return response()->json($result_array);
        exit;
    }
    public function getMyInfo(Request $request){

        $carr = $this->config_arr;
        $obj = Auth::guard('admin')->user();
        
        return view('admin.admins.my_info_form', compact('carr','obj'));

    }
   
    public function updateMyInfo(Request $request){

        $obj = Auth::guard('admin')->user();

        $user_id = $user->id;
        $v_arr['first_name'] ="required";
        $v_arr['last_name'] ="required";
        $v_arr['email']  = "required|email|unique:admins,email,".$user_id;


         $v = Validator::make($request->all(), $v_arr );
        if ($v->fails())
        {
          return response()->json(getValidationErrorJson($v));
          exit;
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        if($request->change_pwd){
                $user->password = Hash::make($request->password);
        }
        $user->save();

        $url = ajaxUrl(route('admin.dashboard'));
        $success_message = "Updated Successfully";

        $result_array = array( 'result' => "success",'message' => $success_message , 'url' => $url);
        return response()->json($result_array);
        exit;

    }

    public function getEmptyObject(){
         return new Admin();
    }
    public function findById($id){

         return Admin::where("id",$id)->first();
    }


}
