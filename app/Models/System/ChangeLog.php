<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class ChangeLog extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User\User','user_id');
    }
}
