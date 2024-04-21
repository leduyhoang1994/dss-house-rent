<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $name
 * @property $a1_price
 * @property $a2_facility
 * @property $a3_parking
 * @property $a4_time
 * @property $a5_roomate
 * @property $a6_toilet
 * @property $a7_kitchen
 * @property $a8_near_center
 * @property $a9_distance
 * @property $a10_bus
 * @property $a11_security
 */
class House extends Model
{
    use HasFactory;

    public $timestamps = false;
}
