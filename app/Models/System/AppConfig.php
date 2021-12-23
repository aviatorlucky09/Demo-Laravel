<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
class AppConfig extends Model
{
	use HasFactory;
    public const IMAGES = "uploads/config";
    public const CONFIG_IMAGES = "public/" . (self::IMAGES);

    public static function boot()
    {
        parent::boot();
        self::created(function($model){ 
          Cache::store('file')->put('app_config_'.$model->lang_key,$model->data_value);
          updateModelChangeLog($model,"created");
        });
        self::updated(function($model){ 
          Cache::store('file')->put('app_config_'.$model->lang_key,$model->data_value);
          updateModelChangeLog($model);
        });
        self::deleted(function($model){ 
            updateModelChangeLog($model,"deleted"); 
        });
    }
	public static function getAllCategories(){
/*
        $cats = AppConfig::select('category')->distinct('first_name')->get()->toArray();
        $arr = array();
        foreach ($cats as $key => $cat) {
            $arr[$cat['category']] = $cat['category'];
        }*/
        $arr = array();
        $arr["website"] = "Website";
        $arr["cat_2"] = "cat_2";
        
        return $arr;
    }


}
