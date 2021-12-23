<?php

namespace App\Models\Boat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class BoatType extends Model
{
    use HasFactory;
    use SoftDeletes;

    //public const DEFAULT_IMAGES = "default/user.png";
    public const IMAGES = "uploads/boat_type";
    public const PUBLIC_IMAGES = "public/" . (self::IMAGES);

    protected $appends = ['image_url'];

    public static function boot()
    {
        parent::boot();
        self::created(function($model){ 
            self::cacheHomePageArray();
            updateModelChangeLog($model,"created"); 
        });
        self::updated(function($model){
            self::cacheHomePageArray(); 
            updateModelChangeLog($model); 
        });
        self::deleted(function($model){ 
            self::cacheHomePageArray();
            updateModelChangeLog($model,"deleted"); 
        });
    }

    public static function cacheHomePageArray(){
        $homePageBoatType = Self::where('is_active',1)
                                ->where('display_on_homepage',1)
                                ->orderBy('sort_order','ASC')
                                ->get()
                                ->toArray();
        Cache::put('home_boat_type_array', $homePageBoatType);

    }
    public function  getImageUrlAttribute()
    {
        return upload_image_url($this->image);
    }
}
