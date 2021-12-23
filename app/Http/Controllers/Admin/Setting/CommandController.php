<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Config; 
use View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class CommandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $arr = array();
        $this->config_arr =$arr;

    }
    public function index(Request $request,$name)
    {   

        if($name == "migrate-seed"){
            \Artisan::call('migrate:fresh');
            \Artisan::call('db:seed');

            echo "migrate and database seeds completed";
            return;
        }    

    }
     
}
