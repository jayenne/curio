<?php
namespace App\Helpers\CuriousPeople;

class CuriousUrl
{
    
// GENERATE / PARSE TEXT

    /**
     * Generate a random string, using a cryptographically secure
     * pseudorandom number generator (random_int)
     * @param int $length      How many characters do we want?
     * @param string $keyspace A string of all possible characters to select from
     * @return string
     * $a = CuriousString::generatePassword();
     * $b = CuriousString::generatePassword(32);
     * $c = CuriousString::generatePassword(8, 'abcdefghijklmnopqrstuvwxyz');
     */
    public static function resolveUrl($url, $maxRequests = 10)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, $maxRequests);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);

        //customize user agent if you desire...
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Link Checker)');

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_exec($ch);

        $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);
        return $url;
    }
    
    public static function getHttpResponseCode($url)
    {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }
    public static function checkRemoteFile($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        curl_close($ch);
        if ($result !== false) {
            return true;
        } else {
            return false;
        }
    }
}
