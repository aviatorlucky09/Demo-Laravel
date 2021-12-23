<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
     protected $fillable = [
        'user_id'
        
    ];
}
