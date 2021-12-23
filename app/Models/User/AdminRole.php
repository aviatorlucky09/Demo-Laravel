<?php

namespace  App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminRole extends Model
{
    use HasFactory;
    use SoftDeletes;

    public  function permissionArr(){
        $permissionArr = json_decode($this->permission,1);
        if(is_array($permissionArr)){
            return $permissionArr;
        }
        return array();
    }
    public  function permissionNameArr(){
        $array = array();
        foreach ($this->permissionArr() as $module => $option){
               if(is_array($option)){
                   foreach ($option as $okey => $val){
                       if($val){
                           $array[$module."_".$okey] = 1;
                       }
                   }
               }
        }
        return $array;
    }

    public  static  function  roleModules(): array
    {
        $arr = array();
        $arr['user']            = ['label'=>"User",         'option'=>['view','modify','create','delete','login_as_user']];
        $arr['sub_user']        = ['label'=>"Sub User",     'option'=>['view','modify','create','delete']];
        $arr['message']         = ['label'=>"Messages",     'option'=>['view','modify','create','delete']];
        $arr['calendar']        = ['label'=>"Calendar",     'option'=>['view','modify','create','delete']];
        $arr['fleet']           = ['label'=>"Fleet",        'option'=>['view','modify','create','delete']];
        $arr['marina']          = ['label'=>"Marina",       'option'=>['view','modify','create','delete']];
       
        return $arr;

    }

}
