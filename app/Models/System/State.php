<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class State extends Model
{
    use HasFactory;
    use SoftDeletes;
    public static function boot()
    {
        parent::boot();
        // self::created(function($model){ updateModelChangeLog($model,"created"); });
        // self::updated(function($model){ updateModelChangeLog($model); });
        // self::deleted(function($model){ updateModelChangeLog($model,"deleted"); });
    }
     public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

}