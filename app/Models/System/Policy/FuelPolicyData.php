<?php

namespace App\Models\System\Policy;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelPolicyData extends Model
{
    use HasFactory;
    public const FUEL_POLICIES         = ['included_in_price','amount_charge_placed_non_refundable','charged_after_check_out'];
}
