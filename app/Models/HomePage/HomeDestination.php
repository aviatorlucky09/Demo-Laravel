<?php

namespace App\Models\HomePage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
class HomeDestination extends Model
{
    use HasFactory;
    use SoftDeletes;
    public const IMAGES = "uploads/destination";
    public const PUBLIC_IMAGES = "public/" . (self::IMAGES);

    protected $appends = ['image_url'];

    public static function boot()
    {
        parent::boot();
        self::created(function($model){ self::cacheAllArray(); });
        self::updated(function($model){ self::cacheAllArray();  });
        self::deleted(function($model){ self::cacheAllArray();  });
    }
    
    public static function cacheAllArray(){
        $allDestiantions = Self::all()->toArray();
        Cache::put('home_destination_array', $allDestiantions);

    }
    public function getImageUrlAttribute(){
        return  upload_image_url($this->image);
    }

}
