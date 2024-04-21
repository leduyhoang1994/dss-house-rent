<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HouseSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices = [3000000];
        $startPrice = 3000000;
        for ($i = 1; $i < 8; $i++) {
            $prices[] = $startPrice + $i * 500000;
        }

        for ($i = 0; $i < 100; $i++) {
            House::query()->create([
                'name' => 'H' . ($i + 1),
                'a1_price' => $prices[random_int(0, count($prices) - 1)],
                'a2_facility' => random_int(0, 1),
                'a3_parking' => random_int(0, 1),
                'a4_time' => random_int(0, 1),
                'a5_roomate' => random_int(1, 4),
                'a6_toilet' => random_int(0, 1),
                'a7_kitchen' => random_int(0, 1),
                'a8_near_center' => random_int(0, 1),
                'a9_distance' => rand(0, 10),
                'a10_bus' => random_int(0, 1),
                'a11_security' => random_int(0, 1),
            ]);
        }
    }
}
