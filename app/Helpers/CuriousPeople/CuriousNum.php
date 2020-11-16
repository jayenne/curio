<?php

namespace App\Helpers\CuriousPeople;

class CuriousNum
{
    // GENERATE / PARSE TEXT
    /*
        * Return the array element closest by value to the given value
        */
    public static function getClosestElementByValue($arr, $num)
    {
        asort($arr);

        foreach ($arr as $key => $val) {
            if ($num <= $val) {
                return $key;
            }
        }
        $keys = array_keys($arr);

        return end($keys);
    }

    /*
     * Generates a weighted random number
     * 1 is unweighted, low gamma gives higher chances of high numbers gives returned.
     */
    public static function getRandomBias($arr, $log = null)
    {
        $min = 0; //default min
        $max = 100; // default max
        extract($arr); // extract values

        $mean = ((($max - $min) / 100) * $mean) + $min; // mean % as int
        $deviation = $mean * (1 - $deviation); // +- deviation to mean
        $mean_min = $mean - $deviation < $min ? $min : $mean - $deviation;
        $mean_max = $mean + $deviation > $max ? $max : $mean + $deviation;

        $random = mt_rand($mean_min * 100, $mean_max * 100) / 100;
        $result = round($random);

        if ($log !== null) {
            error_log($log.' = '.$result.' (min:'.$min.', max:'.$max.', mean:'.$mean.', deviation:'.$deviation.') : source: ( min:'.$arr['min'].', max:'.$arr['max'].', mean:'.$arr['mean'].', deviation:'.$arr['deviation'].')');
            dd(['arr'=>$arr, 'min'=>$min, 'max'=>$max, 'result'=>$result]);
        }

        return intval($result);
    }
}
