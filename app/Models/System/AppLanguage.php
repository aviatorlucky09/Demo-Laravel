<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AppLanguage extends Model
{
    use HasFactory;
    public static function boot()
    {
        parent::boot();
        self::created(function($model){ 
          Cache::store('file')->put('app_language_'.$model->lang_key,$model->data_value);
          updateModelChangeLog($model,"created");
        });
        self::updated(function($model){ 
          Cache::store('file')->put('app_language_'.$model->lang_key,$model->data_value);
          updateModelChangeLog($model);
        });
        self::deleted(function($model){ 
            updateModelChangeLog($model,"deleted"); 
        });
    }

    public static function pages(){

        $pagesArr = array();
        $pagesArr['homepage'] = "Home Page";
        $pagesArr['footer'] = "Footer";

        return $pagesArr;
    }
}
