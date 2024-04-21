<?php

namespace App;

class CriteriaCalculator
{
    static function c1_price($a1, $b1, $min, $max) {
        if ($b1 < $a1) {
            return 0;
        }

        $percent = $a1 / $max;

        return 10 * (1 - $percent);
    }

    static function c2_facility($a2, $a6, $a7, $b5, $b6) {
        return (($b6 * $a2 + $a6 + $b5 * $a7) / 3) * 10;
    }

    static function c3_distance($a9, $max) {
        if ($a9 == 0) {
            return 10;
        }

        $percent = $a9 / $max;

        return 10 * (1 - $percent);
    }

    static function c4_service($a3, $a4, $a6, $a10, $b2, $b3) {
        return ((($b3 * $a4 + (1 - $b3) * $a4) + $a6 + ($b2 * $a3 + (1 - $b2) * $a10)) / 3) * 10;
    }

    static function c5_security($a8, $a11) {
        return (($a11 + (1 - $a8)) / 2) * 10;
    }

    static function c6_environment($a5, $a8, $b4) {
        return (($a8 + ((1 / $a5) * $b4)) / 2) * 10;
    }
}
