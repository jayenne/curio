<?php
namespace App\Helpers\CuriousPeople;

use CuriousArr;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class CuriousStr
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
    public static function randomString(
        int $length = 64,
        string $keyspace = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ !\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~"
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    public static function makeChecksum(
        array $data
    ): string {
        $str = json_encode($data);
        return md5($str);
    }

    /**
     * [stringFromCases convert a cased string to a spaced string. Kebab, snake, pascal, dot.notation]
     * @param  [type] $str [description]
     * @return [type]      [description]
     */
    public static function caseToSpace($str)
    {
        $str = preg_replace(['/[-_.]+/uism', '/(?!^)([A-Z])/uism'], [" "," $1"], $str);
        $result = strtolower($str);
        return $result;
    }

    /**
     * [splitTitleText splits a string at the first period or at the given length. appending a string to the end]
     * @param  [type]  $str [description]
     * @param  integer $len [description]
     * @param  string  $end [description]
     * @return [type]       [description]
     */
    public static function splitTitleText($str, $maxLength, $end = '…')
    {
        // CONVERT ANCHORS TO PLACEHOLDERS
        $re = '/<a[^>]*>(?:[^<]+)<\/a>(?:\s*)/';
        $placeholder = '↔';
        preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
        $matches = Arr::flatten($matches);
        \Log::channel('dev')->info(['STRING_IN' => $str,'MATCHES' => $matches]);
        $str = preg_replace($re, $placeholder, $str);
        \Log::channel('dev')->info(['STRING_OUT' => $str]);
        // STRIP HTML TAGS
        $str = strip_tags($str);

        // SPLIT STRING IN TO TITLE & TEXT
        $delimiter ='.';
        $period_at = strpos($str, $delimiter);
        if ($period_at) {
            $title_str = substr($str, 0, $period_at);
            $title = $title_str;
            $text = substr($str, $period_at+1);
        } elseif (strlen($str) > $maxLength) {
            $title_str = substr($str, 0, $maxLength - 1);
            $title_str = substr($title_str, 0, strrpos($title_str, ' '));
            $title = $title_str;
            $text = preg_replace('/' . $title_str . '/', '', $title, 1);
            if (!empty($title) && !empty($text)) {
                $title = trimr($title).$end;
            }
        } else {
            $title = $str;
            $text = '';
        }

        //CONVERT PLACEHOLDERS TO ANCHORS
        $count = substr_count($title, $placeholder);
        $title_matches = array_slice($matches, 0, $count);
        $text_matches = array_slice($matches, $count);
        $title = Str::replaceArray($placeholder, $title_matches, $title);
        $text = Str::replaceArray($placeholder, $text_matches, $text);
        
        $data = ['title' => trim($title), 'text' => trim($text)];
        return $data;
    }

    // EXTRACT ARRAY FROM TEXT
    /**
     * [extract text element from anchor tag: <a href="">text</a> ]
     * @param  string $string  [the string you need processing]
     * @param  string $replace [the replacement string (optional, defaults to '')]
     * @return string          [the text element from anchor tag]
     */
    public static function getTextFromTag(
        string $string
    ): string {
        $pattern = '~>\K[^<>]*(?=<)~';
        preg_match($pattern, $string, $matches, PREG_OFFSET_CAPTURE, 0);
        $matched = \Arr::flatten($matches);
        $return = $matched[0] ?? null;
        return trim($return);
    }

    public static function getPlatformTags(
        string $string
    ): array {
        $tag_pattern = config('platform.twitter.tag_pattern');
        $tag_pattern_options = config('platform.presets.post.tag_pattern');
        $pattern = $tag_pattern_options[$tag_pattern];

        $matches = [];
        preg_match_all($pattern, $string, $matches, PREG_SET_ORDER, 0);
        foreach ($matches as $key => $val) {
            $matches[$key] = array_values(array_filter($val));
        }
        return $matches;
    }

    public static function stripPlatformTag(
        string $string,
        string $tag = 'test'
    ): string {
        $pattern = '/(?:#)(test)(?:(?:!)|(?::)(?:([a-zA-Z0-9,-_."\'\s]+))(?:!)\s*)/mi';
        $subst = '';
        $result = preg_replace($pattern, $subst, $string);
        return trim($result);
    }
    // REPLACE TEXT IN TEXT WITH PATTERN
    /**
     * [replaceString parse a string to remove/replace a given string]
     * @param  string $string  [the string you need processing]
     * @param  string $replace [the replacement string (optional, defaults to '')]
     * @return string          [the string with hashtags replaced]
     */
    public static function replaceString(
        string $string,
        string $find,
        string $replace = ''
    ): string {
        $pattern = '/'.$find.'\s*/im';
        $result = preg_replace($pattern, $replace, $string);
        return $result;
    }
       
    /**
     * [replaceString parse a string to remove/replace a given string]
     * @param  string $string  [the string you need processing]
     * @param  string $replace [the replacement string (optional, defaults to '')]
     * @return string          [the string with hashtags replaced]
     */
    public static function replaceExtraSpaces(
        string $string,
        string $replace = ' '
    ): string {
        $pattern = ['/\h\h+\h*/im','/^\s+|\s+$/im'];
        $result = preg_replace($pattern, $replace, $string);
        return $result;
    }

    /**
     * [replaceString parse a string to remove/replace a given string]
     * @param  string $string  [the string you need processing]
     * @param  string $replace [the replacement string (optional, defaults to '')]
     * @return string          [the string with hashtags replaced]
     */
    public static function replaceExtraLines(
        string $string,
        string $replace = ' '
    ): string {
        $pattern = ['/\v\v+\v*/im','/^\s+|\s+$/im'];
        $result = preg_replace($pattern, $replace, $string);
        return $result;
    }

    /**
     * [replaceHashtags parse a string to remove/replace hashtags]
     * @param  string $string  [the string you need processing]
     * @param  string $replace [the replacement string (optional, defaults to '')]
     * @return string          [the string with hashtags replaced]
     */
    public static function getHashtags(
        string $string
    ): array {
        $pattern = '/\s#(?=[0-9a-zA-Z_]{2,})(?![0-9]+\W)([0-9a-zA-Z_]{2,})\b/mi';
        $matches = [];
        $results = [];
        preg_match_all($pattern, $string, $matches, PREG_SET_ORDER, 0);
        array_walk_recursive($matches, function ($val, $key) use (&$results) {
            if (ltrim($val)[0] !== '#') {
                $results[] = trim($val);
            }
        });
        return array_unique($results);
    }
    /**
     * [replacegetMen parse a string to remove/replace hashtags]
     * @param  string $string  [the string you need processing]
     * @param  string $replace [the replacement string (optional, defaults to '')]
     * @return string          [the string with hashtags replaced]
     */
    public static function replaceHashtags(
        string $string,
        string $replace = ''
    ): string {
        $pattern = '/#[\p{L}]+[\p{L}\p{N}_]*/im';
        $result = preg_replace($pattern, $replace, $string);
        return $result;
    }

    /**
     * [replacePlatformHashbangs parse a string to remove/replace platform specific Hashbangs]
     * @param  string $string  [the string you need processing]
     * @param  string $replace [the replacement string (optional, defaults to '')]
     * @return string          [the string with hashbangs replaced]
     */

    public static function replacePlatformTags(
        string $string,
        string $replace = ''
    ): string {
        $tag_pattern = config('platform.twitter.tag_pattern');
        $tag_pattern_options = config('platform.presets.post.tag_pattern');
        $pattern = $tag_pattern_options[$tag_pattern];
        
        $replacement = '';
        $result = preg_replace($pattern, $replacement, $string);
        return $result;
    }
    /**
     * [replaceUrls parse a string to replace URLs with curio tracker url]
     * @param  string $string  [the string you need processing]
     * @param  string $replace [the replacement string (optional, defaults to '')]
     * @return string          [the string with URLs replaced]
     */
    public static function replaceUrls(
        string $string,
        string $replace = ''
    ): string {
        $pattern = '/(?:(?:https?|ftp):\/\/)(?:\\S+(?::\\S*)?@|\\d{1,3}(?:\\.\\d{1,3}){3}|(?:(?:[a-z\\d\\x{00a1}-\\x{ffff}]+-?)*[a-z\\d\\x{00a1}-\\x{ffff}]+)(?:\\.(?:[a-z\\d\\x{00a1}-\\x{ffff}]+-?)*[a-z\\d\\x{00a1}-\\x{ffff}]+)*(?:\\.[a-z\\x{00a1}-\\x{ffff}]{2,6}))(?::\\d+)?(?:[^\\s]*)?/uism';
        $result = preg_replace($pattern, $replace, $string);
        
        //return $result;
        return $string;
    }
  
    /**
     * [remove source Urls from a string (text)]
     * @param  string $string  [the string you need processing]
     * @param  array $urls [the urls to ignore within string]
     * @return string          [the string with URLs replaced]
     */
  
    public static function removeSourceUrls(
        string $string,
        array $urls
    ): string {
        $pattern = '/(?:(?:https?|ftp):\/\/)(?:\\S+(?::\\S*)?@|\\d{1,3}(?:\\.\\d{1,3}){3}|(?:(?:[a-z\\d\\x{00a1}-\\x{ffff}]+-?)*[a-z\\d\\x{00a1}-\\x{ffff}]+)(?:\\.(?:[a-z\\d\\x{00a1}-\\x{ffff}]+-?)*[a-z\\d\\x{00a1}-\\x{ffff}]+)*(?:\\.[a-z\\x{00a1}-\\x{ffff}]{2,6}))(?::\\d+)?(?:[^\\s]*)?/uism';
        preg_match_all($pattern, $string, $matches);
        $intersect = array_intersect($urls, $matches[0]);
        $remove = array_merge(array_diff($urls, $intersect), array_diff($matches[0], $intersect));
        // remove unlisted urls from string...
        $replace = '';
        foreach ($remove as $url) {
            $string = str_replace($url, $replace, $string);
        }

        return $string;
    }

    public static function autoLinkText(
        string $string,
        string $target = '_blank'
    ): string {
        $pattern = '@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@';
        $replace = '<a href="$1" target="'.$target.'">$1</a>';
        $string = preg_replace($pattern, $replace, $string);
        return $string;
    }

    /**
     * [get Source Platform parse a string to remove/replace URLs]
     * @param  string $string  [the string you need processing]
     * @param  string $replace [the replacement string (optional, defaults to '')]
     * @return string          [the string with URLs replaced]
     */
    public static function getUserMentions(
        array $array,
        string $string = ''
    ): array {
        foreach ($array as $key => $val) {
            if ($val['screen_name'] == $string) {
                unset($array[$key]);
            }
        }
        return $array;
    }
 
    /**
     * [get Source Platform parse a string to remove/replace URLs]
     * @param  string $string  [the string you need processing]
     * @param  string $replace [the replacement string (optional, defaults to '')]
     * @return string          [the string with URLs replaced]
     */
    public static function replaceMentions(
        string $string,
        string $replace = ''
    ): string {
        $pattern = '/(?<=^|(?<=[^a-zA-Z0-9-_\.]))@([A-Za-z]+[A-Za-z0-9-_]+)/uism';
        $result = preg_replace($pattern, $replace, $string);
        return $result;
    }

    /**
     * [get Source Platform parse a string to remove/replace URLs]
     * @param  string $string  [the string you need processing]
     * @param  string $replace [the replacement string (optional, defaults to '')]
     * @return string          [the string with URLs replaced]
     */
    public static function replaceImplicitReply(
        string $string,
        string $replace = ''
    ): string {
        $pattern = '/^([@A-Za-z0-9_]+)\b/uism';
        $result = preg_replace($pattern, $replace, $string);
        return ltrim($result);
    }
    /**
     * [shorten string to a given length by replacing center with a given string]
     * @param  string $string  [the string you need processing]
     * @param integer [the length required for the rreturn string]
     * @param string $seperator [the replacement string (defaults to '…')]
     * @return string [returns the initial string shortened in the middle as directed ]
     */
    public static function truncateStringFromCenter(
        string $string,
        int $length,
        string $seperator = '…'
    ): string {
        // 20 - 30 = -10 so fail/return
        if (strlen($string) <= $length) {
            return $string;
        }

        $strlength = floor(strlen($string));
        $diff = $strlength - $length;
        // 50 - 30 = 20
        // 35 - 30 = 2
        $num = floor(($strlength - $diff) /2);
        // 50 - 20 / 2 = 10
        // 35 - 2 / 2 = 1
        $left = substr($string, 0, $num);
        $right = substr($string, - $num - 1);
        return $left.$seperator.$right;
    }

    /**
     * [break a url in to its consituent parts]
     * @param  string $url  [the url you need processing]
     * @return array [the constituent parts of the given url]
     */
    public static function getUrlArray(
        string $url
    ): array {
        $parts = parse_url($url);
        if (!$parts) {
            // For seriously malformed urls
            return false;
        }
        // Just for good measure, throw in the top level domain, if there is a host with a top level domain
        if (array_key_exists('host', $parts) && strrpos($parts['host'], '.') !== false) {
            $domain_parts = explode('.', $parts['host']);
            $parts['tld'] = end($domain_parts);
            preg_match('/(?:http(?:s)?:\/\/)?(?:www\.)?([a-z0-9\-]+)(?:\.[a-z\.]+[\/]?).*/i', $parts['host'], $matches);
            $parts['domainname'] = rtrim($matches[1], '/');
        }
        if (array_key_exists('path', $parts)) {
            $pathinfo = pathinfo($parts['path']);
            $pathinfo['dirname'] = rtrim($pathinfo['dirname'], '/');
            if (empty($pathinfo['basename'])) {
                // With an empty basename, extension and filename will also be empty
                unset($pathinfo['basename']);
                unset($pathinfo['extension']);
                unset($pathinfo['filename']);
            }
            $parts = array_merge($parts, $pathinfo);
        }
        if (array_key_exists('query', $parts)) {
            parse_str($parts['query'], $query_parts);
            $parts['query_parts'] = $query_parts;
        }
        return $parts;
    }
}
