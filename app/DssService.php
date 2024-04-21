<?php

namespace App;

use App\Models\House;
use Illuminate\Support\Collection;

class DssService
{
    protected $name;
    protected float $b1_income;
    protected int $b2_transport;
    protected int $b3_work;
    protected int $b4_mates;
    protected int $b5_meal;
    protected int $b6_assets;
    protected array $criteria = [];
    protected array $criteriaMatrix = [];
    protected array $criteriaWeight = [
        'c1_price' => 0.25,
        'c2_facility' => 0.2,
        'c3_distance' => 0.1,
        'c4_service' => 0.2,
        'c5_security' => 0.2,
        'c6_environment' => 0.05,
    ];
    protected array $normalized = [];
    protected array $weighted = [];
    /** @var House[]|Collection $houses */
    protected $houses = [];
    /** @var House[]|Collection $houses */
    protected $ratedHouses = [];

    public function load($name, $b1_income, $b2_transport, $b3_work, $b4_mates, $b5_meal, $b6_assets): void
    {
        $this->name = $name;
        $this->b1_income = $b1_income;
        $this->b2_transport = $b2_transport;
        $this->b3_work = $b3_work;
        $this->b4_mates = $b4_mates;
        $this->b5_meal = $b5_meal;
        $this->b6_assets = $b6_assets;

        $this->loadHouses();
    }

    public function loadHouses(): void
    {
        $this->houses = House::query()
//            ->limit(20)
            ->get();
    }

    public function cal_criteria(): void
    {
        $prices = array_column($this->houses->toArray(), 'a1_price');
        $minPrice = min($prices);
        $maxPrice = max($prices);
        $averagePrice = array_sum($prices) / count($prices);

        $distances = array_column($this->houses->toArray(), 'a9_distance');
        $maxDistance = max($distances);

        foreach ($this->houses as $house) {
            $tempCr = [
                'c1_price' => CriteriaCalculator::c1_price($house->a1_price, $this->b1_income, $minPrice, $maxPrice),
                'c2_facility' => CriteriaCalculator::c2_facility(
                    $house->a2_facility, $house->a6_toilet, $house->a7_kitchen, $this->b5_meal, $this->b6_assets
                ),
                'c3_distance' => CriteriaCalculator::c3_distance($house->a9_distance, $maxDistance),
                'c4_service' => CriteriaCalculator::c4_service(
                    $house->a3_parking, $house->a4_time, $house->a6_toilet, $house->a10_bus,
                    $this->b2_transport, $this->b3_work
                ),
                'c5_security' => CriteriaCalculator::c5_security(
                    $house->a8_near_center, $house->a11_security
                ),
                'c6_environment' => CriteriaCalculator::c6_environment(
                    $house->a5_roomate, $house->a8_near_center,
                    $this->b4_mates
                )
            ];

            $this->criteria[] = [
                'house_id' => $house->id,
                'house_name' => $house->name,
                'house_price' => $house->a1_price,
                ...$tempCr
            ];

            $this->criteriaMatrix[] = array_values($tempCr);
        }
    }

    private function getSumByCol(): array
    {
        $res = [];
        $n = count($this->criteriaMatrix[0]);

        for ($i = 0; $i < $n; $i++) {
            $arrCol = array_column($this->criteriaMatrix, $i);
            $arrCol = array_map(fn($row) => pow($row, 2), $arrCol);
            $res[] = array_sum($arrCol);
        }

        return $res;
    }

    private function normalize(): void
    {
        $m = count($this->criteria);
        $n = count($this->criteria[0]);
        $sumByCol = $this->getSumByCol();

        $this->normalized = array_map(function ($house, $houseIndex) use ($sumByCol) {
            $r = [];
            foreach ($house as $cIndex => $criteria) {
                $r[] = sqrt($sumByCol[$cIndex]) == 0 ? 0 : $criteria / sqrt($sumByCol[$cIndex]);
            }

            return $r;
        }, $this->criteriaMatrix, array_keys($this->criteriaMatrix));
    }

    private function weight(): void
    {
        $w = array_values($this->criteriaWeight);
        $this->weighted = array_map(function ($house) use ($w) {
            return array_map(fn($norm, $criteriaIndex) => $norm * $w[$criteriaIndex], $house, array_keys($house));
        }, $this->normalized);
    }

    private function distance(): void {
        $max = array_map(function($cIndex) {
            return max(array_column($this->criteriaMatrix, $cIndex));
        }, array_keys($this->criteriaMatrix[0]));

        $min = array_map(function($cIndex) {
            return min(array_column($this->criteriaMatrix, $cIndex));
        }, array_keys($this->criteriaMatrix[0]));

        $distanceByMax = array_map(function($house, $houseIndex) use ($max) {
            return sqrt(array_sum(
                array_map(function($criteria, $cIndex) use ($max) {
                    return pow($criteria - $max[$cIndex], 2);
                }, $house, array_keys($house))
            ));
        }, $this->criteriaMatrix, array_keys($this->criteriaMatrix));

        $distanceByMin = array_map(function($house, $houseIndex) use ($min) {
            return sqrt(array_sum(
                array_map(function($criteria, $cIndex) use ($min) {
                    return pow($criteria - $min[$cIndex], 2);
                }, $house, array_keys($house))
            ));
        }, $this->criteriaMatrix, array_keys($this->criteriaMatrix));

        $houseDistance = array_map(function($house, $houseIndex) use ($distanceByMin, $distanceByMax) {
            return $distanceByMin[$houseIndex] / ($distanceByMin[$houseIndex] + $distanceByMax[$houseIndex]);
        }, $this->criteriaMatrix, array_keys($this->criteriaMatrix));

        $this->houses->each(function ($house, $houseIndex) use ($houseDistance) {
            $house->rate = $houseDistance[$houseIndex];
            $house->criteria = $this->criteriaMatrix[$houseIndex];
        });

        $this->ratedHouses = $this->houses->sortBy(fn($house) => $house->rate, descending: true);
    }

    public function calculate(): Collection
    {
        $this->cal_criteria();
        $this->normalize();
        $this->weight();
        $this->distance();

        return $this->ratedHouses->take(5);
    }
}
