<?php

namespace App\Models\Boat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoatAmenityRelation extends Model
{
    use HasFactory;
    protected $primaryKey = 'boat_id';
    public $timestamps = false;
    public static function boot()
    {
        parent::boot();
        self::created(function($model){ updateModelChangeLog($model,"created"); });
        self::updated(function($model){ updateModelChangeLog($model); });
        self::deleted(function($model){ updateModelChangeLog($model,"deleted"); });
    }
}
