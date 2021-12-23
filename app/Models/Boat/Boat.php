<?php

namespace App\Models\Boat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Boat\BoatImage;
use App\Models\Boat\BoatAmenity;
use App\Models\Boat\BoatAmenityRelation;
use App\Models\Marina\Marina;
use App\Models\Boat\BoatDetail;



class Boat extends Model
{
    use HasFactory;
    use SoftDeletes;


    public const DEFAULT_IMAGES = "default/boat.png";
    public const IMAGES = "uploads/boa";
    public const PUBLIC_IMAGES = "public/" . (self::IMAGES);

    public static function boot()
    {
        parent::boot();
        self::created(function($model){ updateModelChangeLog($model,"created"); });
        self::updated(function($model){ updateModelChangeLog($model); });
        self::deleted(function($model){ updateModelChangeLog($model,"deleted"); });
    }
    
     public function images()
    {
        return $this->hasMany(BoatsImages::class, "boat_id", "id");
    }

    public function amenities()
    {
        return $this->belongsToMany(BoatAmenity::class, BoatAmenityRelation::class, "boat_id", "amenity_id");
    }

     public function marina()
    {
        return $this->belongsTo(Marina::class, "marina_id")->withDefault(function () {
            return new Marina();
        });
    }

    public function detail()
    {
        return $this->hasOne(BoatDetail::class, "boat_id", "id")->withDefault(function () {
            return new BoatDetail();
        });
    }

     public function prices()
    {
        return $this->hasMany(BoatPrice::class, "boat_id");
    }

    public function price()
    {
        return $this->hasOne(BoatPrice::class, "boat_id")->withDefault(function () {
            return new BoatPrice();
        });
    }


}
