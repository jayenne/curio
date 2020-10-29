<?php
namespace App\Helpers\CuriousPeople;

class CuriousArr
{
    
// GENERATE / PARSE TEXT

    /**
     * [stringFromCases convert a cased string to a spaced string. Kebab, snake, pascal, dot.notation]
     * @param  [type] $str [description]
     * @return [type]      [description]
     */
    public static function unsetValue($arr, $str)
    {
        if (($str = array_search($str, $arr)) !== false) {
            unset($arr[$str]);
        }
        return $arr;
    }

    /**
     * [filterPlatformTags description]
     * @param  [type] &$array [description]
     * @param  [type] $remove [description]
     * @return [type]         [description]
     */
    // public static function filterPlatformTags(&$array, $remove)
    // {
    //     if (!is_array($remove)) {
    //         $remove = array($remove);
    //     }
    //     foreach ($array as $key => &$value) {
    //         $r = is_string($value) && (empty($value) || in_array($value[0], $remove)) ? true : false;
    //         if ($r === true) {
    //             unset($array[$key]);
    //         } elseif (is_array($value)) {
    //             self::filterPlatformTags($value, $remove);
    //         }
    //     }
    //     return $array;
    // }

    /**
     * [flattenPlatformTags description]
     * @param  [type] $array [description]
     * @return [type]        [description]
     */
    public static function flattenPlatformTags($array)
    {
        $results = [];
        foreach ($array as $val) {
            $k = $val[1];
            $v = $val[3] ?? ($val[2] ?? true);
            $results[$k] = $v;
        }
        return $results;
    }

    // public static function flattenPlatformTags($array)
    // {
    //     $results = [];
    //     foreach ($array as $val) {
    //         $k = $val[1];
    //         $v = $val[2] ?? true;
    //         $results[$k] = $v;
    //     }
    //     return $results;
    // }
}
