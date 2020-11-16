<?php

namespace App\Helpers\CuriousPeople;

use Illuminate\Support\Facades\Storage;

class CuriousStorage
{
    public static function randomFileFromPath($directory)
    {
        $files = Storage::allFiles($directory);

        if (count($files) > 0) {
            shuffle($files);
            $file = $files[0];

            return $file;
        }

        return false;
    }
}
