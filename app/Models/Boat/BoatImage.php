<?php

namespace App\Models\Boat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoatImage extends Model
{
    use HasFactory;

    public const IMAGES = "uploads/boat";
    public const BOAT_IMAGES = "public/" . (self::IMAGES);
    public static function boot()
    {
        parent::boot();
        self::created(function($model){ updateModelChangeLog($model,"created"); });
        self::updated(function($model){ updateModelChangeLog($model); });
        self::deleted(function($model){
            $disk = config('filesystems.default');
            $filePath = self::BOAT_IMAGES. "/".$model->boat_id ."/".$model->image;
            if (\Storage::disk($disk)->exists($filePath))
                \Storage::disk($disk)->delete($filePath);

            updateModelChangeLog($model,"deleted");
        });
    }
}
