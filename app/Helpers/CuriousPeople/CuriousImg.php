<?php

namespace App\Helpers\CuriousPeople;

use Illuminate\Support\Str;

class CuriousImg
{
    // GENERATE / PARSE TEXT

    /**
     * [makeImgGrid description].
     * @param  [type]  $src    [description]
     * @param  int $width  [description]
     * @param  int $height [description]
     * @return [type]          [description]
     */
    public static function file_get_contents_curl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    public static function makeImgGrid($src, $width = 3, $height = 3): array
    {
        $data = self::file_get_contents_curl($src);
        \Log::channel('dev')->info(['IMG_GRID' => $data, 'URL' => $src]);
        if (empty($data)) {
            return [null, null];
        }

        $img = imagecreatefromstring($data);
        $img = imagescale($img, $width, $height);
        if ($img !== false) {
            header('Content-Type: image/png');
            $public = storage_path('app/public/');
            $path = 'images/grids/';
            $name = Str::random(40);
            $ext = '.png';

            $file = $public.$path.$name.$ext;
            imagepng($img, $file);
            imagedestroy($img);
        }
        $storage = 'storage/';

        return [$file, $storage.$path.$name.$ext];
    }

    /**
     * [getImgThemeColor description].
     * @param  [type]  $src [description]
     * @param  int $x   [description]
     * @param  int $y   [description]
     * @return [type]       [description]
     */
    public static function getImgPixelBrightness($src, $x = 2, $y = 2)
    {
        $img = file_get_contents($src);
        $img = imagecreatefromstring($img);
        $rgb = imagecolorat($img, $x, $y);
        imagedestroy($img);

        if ($rgb !== false) {
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $hsv = self::RGBtoHSV($r, $g, $b);

            $brightness = round($r + $g + $b / 3);

            return $brightness;
        }

        return false;
    }

    public static function getImgPixelBrightnessRow($src, $col = 0, $row = 2)
    {
        $img = file_get_contents($src);
        $img = imagecreatefromstring($img);

        $w = imagesx($img);
        $x = $col > $w ? $w : $col;
        $h = imagesy($img);
        $y = $row > $h ? $h : $row;

        $brightness = 0;
        $divisor = 0;

        for ($i = $x; $i < $h; $i++) {
            $rgb = imagecolorat($img, $i, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $hsv = self::RGBtoHSV($r, $g, $b);
            $brightness += $hsv['v'];
            $divisor++;
        }
        imagedestroy($img);
        $result = $brightness / $divisor;

        return $result;
    }

    /**
     * [getAverageColor description].
     * @param  [type] $src [description]
     * @return [type]      [description]
     */
    public static function getAverageColor($src)
    {
        $img = file_get_contents($src);
        $img = imagecreatefromstring($img);

        $w = imagesx($img);
        $h = imagesy($img);
        $r = $g = $b = 0;
        for ($y = 0; $y < $h; $y++) {
            for ($x = 0; $x < $w; $x++) {
                $rgb = imagecolorat($img, $x, $y);
                $r += $rgb >> 16;
                $g += $rgb >> 8 & 255;
                $b += $rgb & 255;
            }
        }
        $pxls = $w * $h;
        $r = dechex(round($r / $pxls));
        $g = dechex(round($g / $pxls));
        $b = dechex(round($b / $pxls));
        if (strlen($r) < 2) {
            $r = 0 .$r;
        }
        if (strlen($g) < 2) {
            $g = 0 .$g;
        }
        if (strlen($b) < 2) {
            $b = 0 .$b;
        }

        return '#'.$r.$g.$b;
    }

    /**
     * [RGBtoHSV description].
     * @param [type] $r [description]
     * @param [type] $g [description]
     * @param [type] $b [description]
     */
    private static function RGBtoHSV($r, $g, $b)
    {
        $r = ($r / 255);
        $g = ($g / 255);
        $b = ($b / 255);
        $maxRGB = max($r, $g, $b);
        $minRGB = min($r, $g, $b);
        $chroma = $maxRGB - $minRGB;
        if ($chroma == 0) {
            return ['h'=>0, 's'=>0, 'v'=>$maxRGB];
        }
        if ($r == $minRGB) {
            $h = 3 - (($g - $b) / $chroma);
        } elseif ($b == $minRGB) {
            $h = 1 - (($r - $g) / $chroma);
        } else {
            $h = 5 - (($b - $r) / $chroma);
        }

        return ['h'=>60 * $h, 's'=>$chroma / $maxRGB, 'v'=>$maxRGB];
    }
}
