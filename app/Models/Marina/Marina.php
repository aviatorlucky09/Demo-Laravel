<?php

namespace App\Models\Marina;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Boat\Boat;
use App\Models\Marina\MarinaAmenity;
use App\Models\Marina\MarinaAmenityRelation;

class Marina extends Model
{
    use HasFactory;
    use SoftDeletes;

   public static function boot()
    {
        parent::boot();
        self::created(function($model){ updateModelChangeLog($model,"created"); });
        self::updated(function($model){ updateModelChangeLog($model); });
        self::deleted(function($model){ updateModelChangeLog($model,"deleted"); });
    }
    public function boats()
    {
        return $this->hasMany(Boat::class, "marina_id");
    }
    public function amenities()
    {
        return $this->belongsToMany(MarinaAmenity::class, MarinaAmenityRelation::class, "marina_id", "amenity_id");
    }

    public function images()
    {
        return $this->hasMany(MarinaImage::class, "marina_id", "id");
    }
    public function owner()
    {
        return $this->hasOne(MarinaOwner::class, "marina_id", "id")->withDefault(function () {
            return new MarinaOwner();
        });
    }
}
