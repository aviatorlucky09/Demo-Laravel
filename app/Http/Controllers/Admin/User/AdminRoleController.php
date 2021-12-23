<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User\AdminRole;
use Illuminate\Http\Request;
use View;
use Validator;
use Auth;

class AdminRoleController extends Controller
{
   private $config_arr;

   public function __construct()
    {

        $arr = array();
        $arr['view_folder'] = "admin.admin_role";
        $arr['singular_name'] = "Admin Role";
        $arr['plural_name'] = "Admin Roles";
        $arr['table_name'] = "admin_roles";
        $arr['update_route_name'] = 'admin.admin_role_update';
        $arr['edit_route_name'] = 'admin.admin_role_edit';
        $arr['delete_route_name'] = 'admin.admin_role_delete';
        $arr['processing_route_name'] = 'admin.admin_roles_processing';
        $arr['listing_url'] =  ajaxUrl(route('admin.admin_roles'));
        $arr['create_url'] =  ajaxUrl(route('admin.admin_role_create'));
        $arr['active_menu'] =  "admin.admin_roles";

        $this->config_arr =$arr;

    }
    public function index(Request $request)
    {
        if(!Auth::guard('admin')->user()->hasAccess('admin_role_view')){
            return view('layouts.admin.no_access')->with(["name"=>"Admin Role View"]);
        } 

        $deleted = 0;
        if($request->deleted == 1){
            $deleted = 1;
        }

        $carr = $this->config_arr;
        $view_path = getAdminViewFolderPath($carr,"_list");
        $activeMenu = "";
        return view($view_path,compact('carr','deleted'));

    }
    public function processing(Request $request){
        $deleted = 0;
        if($request->deleted == 1){
            $deleted = 1;
        }

        $carr = $this->config_arr;

        $visible_header = array("id","name","option");
        $db_header = array("name");
        $start = $request->start;
        $length = $request->length;

        $draw = $request->draw;
        $search_req = $request->search;
        $search = $search_req['value'];

        $query_obj = AdminRole::query();


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
        if(!Auth::guard('admin')->user()->hasAccess('admin_role_create')){
            return view('layouts.admin.no_access')->with(["name"=>"Admin Role Create"]);
        } 
        $obj = $this->getEmptyObject();
        $obj->id            = 0;
        $carr               = $this->config_arr;
        $roleModules        = AdminRole::roleModules();

        $view_path = getAdminViewFolderPath($carr,"_form");
        return view($view_path,compact('obj','carr','roleModules'));
    }


    public function edit(Request $request, $id = 0)
    {
        if(!Auth::guard('admin')->user()->hasAccess('admin_role_modify')){
            return view('layouts.admin.no_access')->with(["name"=>"Admin Role Modify"]);
        } 
        $obj = $this->findById($id);
        if(!$obj){
            return view('error.record_not_found');
        }

        $carr               = $this->config_arr;
        $roleModules        = AdminRole::roleModules();
        $view_path = getAdminViewFolderPath($carr,"_form");


        return view($view_path,compact('obj','carr','roleModules'));
    }

    public function update(Request $request, $id = 0)
    {
        if(!Auth::guard('admin')->user()->hasAccess('admin_role_modify')){
            $result_array = array( 'result' => "error",'message' => "Access Denied" , 'url' => "");
            return response()->json($result_array);
        } 
        $carr = $this->config_arr;
        $url = "";
        $v_arr =  array();
        $v_arr['name']  = "required|unique:admin_roles,name,".$id;
        $v = Validator::make($request->all(), $v_arr );
        if ($v->fails())
        {
            return response()->json(getValidationErrorJson($v));
            exit;
        }
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



        $result_array = array( 'result' => "success",'message' => $success_message , 'url' => $url);
        return response()->json($result_array);
        exit;

    }



    public function delete(Request $request, $id = 0)
    {
        if(!Auth::guard('admin')->user()->hasAccess('admin_role_delete')){
            $result_array = array( 'result' => "error",'message' => "Access Denied" , 'url' => "");
            return response()->json($result_array);
        } 
        $carr = $this->config_arr;

        $obj = AdminRole::where("id",$id)->withTrashed()->first();
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
        return new AdminRole();
    }
    public function findById($id){

        return AdminRole::where("id",$id)->first();
    }
}
