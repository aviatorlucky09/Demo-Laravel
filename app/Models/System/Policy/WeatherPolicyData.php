<?php

namespace App\Models\System\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherPolicyData extends Model
{
    use HasFactory;
    public const WEATHER_POLICIES_TYPE = ['relaxed','moderate','firm','strict','hide_this'];

	public const WEATHER_POLICIES      =  ['full_refund','rescheduling'];
}
