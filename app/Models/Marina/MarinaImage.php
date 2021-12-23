<?php

namespace App\Models\Marina;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarinaImage extends Model
{
    use HasFactory;

    public const IMAGES = "uploads/marina/";
    public const MARINA_IMAGES = "public/" . (self::IMAGES);
    public static function boot()
    {
        parent::boot();
        self::created(function($model){ updateModelChangeLog($model,"created"); });
        self::updated(function($model){ updateModelChangeLog($model); });
        self::deleted(function($model){
            $disk = config('filesystems.default');
            $filePath = self::MARINA_IMAGES. "/".$model->marina_id ."/".$model->image;
            if (\Storage::disk($disk)->exists($filePath))
                \Storage::disk($disk)->delete($filePath);

            updateModelChangeLog($model,"deleted");
        });
    }
}
