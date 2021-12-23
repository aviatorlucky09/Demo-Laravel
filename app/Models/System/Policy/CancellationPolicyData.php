<?php

namespace App\Models\System\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancellationPolicyData extends Model
{
    use HasFactory;
    public const CANCELLATION_POLICIES = ['relaxed','moderate','firm','strict','hide_this'];
}
