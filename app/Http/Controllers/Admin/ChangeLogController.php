<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;
use App\Models\System\ChangeLog;


class ChangeLogController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
        $arr = array();
        $arr['view_folder'] = "admin.change_logs";
        $arr['singular_name'] = "Change Log";
        $arr['plural_name'] = "Change Logs";
        $arr['table_name'] = "change_logs";
    
        $this->config_arr =$arr;

    }
    public function index(Request $request)
    {
      
       $carr = $this->config_arr; 
       $view_path = getAdminViewFolderPath($carr,"_list");
       return view($view_path,compact('carr'));      

    }
    public function processing(Request $request){
        
       $carr = $this->config_arr;     
        $visible_header = array("id","user_id","admin_id","class_name","field_name","old_value","new_vale","flag","created_at");
        $db_header = array("user_id","admin_id","class_name","field_name","old_value");
        $start = $request->start;
        $length = $request->length;
        $draw = $request->draw;
        $search_req = $request->search;
        $search = $search_req['value'];
        $orderObj = $request->order;  
        $order = isset($orderObj['0'])?$orderObj['0']['dir']:'DESC';
        $orderColumn = isset($orderObj['0'])?$orderObj['0']['column']:0;     

        $query_obj = ChangeLog::query();
        $query_obj->join('users', 'change_logs.user_id', '=', 'users.id',"left"); 
        $query_obj->join('admins', 'change_logs.admin_id', '=', 'admins.id',"left"); 
        $query_obj->select("change_logs.*","users.first_name as user_first_name","admins.first_name as admin_first_name"); 

        /* global search */
        if($search != ''){
            $query_obj->where(function ($query)  use ($db_header, $search){
                foreach($db_header as $key=>$_field){  
                    if($_field == "user_id"){
                        $query->orWhere('users.first_name' ,'like', '%'.$search .'%');  
                    }elseif($_field == "admin_id"){
                        $query->orWhere('admins.first_name' ,'like', '%'.$search .'%');
                    }else{
                        $query->orWhere("change_logs.".$_field ,'like', '%'.$search .'%');    
                    }
                }
            });
        }
        $query_obj->orderBy('change_logs.id',"desc");    
        
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
                if ($header == "user_id") {
                    $_header = $data_row->user_first_name;
                }elseif ($header == "admin_id") {
                    $_header = $data_row->admin_first_name;
                }elseif ($header == "created_at" ) {
                    $_header = date("d-m-Y H:i:s",strtotime($data_row->$header));
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
    
}
