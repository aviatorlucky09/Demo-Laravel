<?php

namespace App\Models\Marina;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarinaOwner extends Model
{
    use HasFactory;
    protected $primaryKey = 'marina_id';

     protected $fillable = [
        'marina_id'
        
    ];
    public static function boot()
    {
        parent::boot();
        self::created(function($model){ updateModelChangeLog($model,"created"); });
        self::updated(function($model){ updateModelChangeLog($model); });
        self::deleted(function($model){ updateModelChangeLog($model,"deleted"); });
    }
    

}
