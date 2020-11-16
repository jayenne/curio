<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ScheduledImageUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platform:image.cycle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cycle the "current" image periodically from a set library.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $current = config('platform.sheduled_image_update.current_filename', 'current.jpg');
        $library = config('platform.sheduled_image_update.library_directory', 'library/');
        $used = config('platform.sheduled_image_update.used_directory', 'used/');
        $path = config('platform.sheduled_image_update.root_directory', 'public/images/daily/');

        // get all in library dir as array
        $files = glob(storage_path('app/'.$path.$library.'*.jpg'));
        $filepath = Arr::random($files);
        if (count($files) == 1) {
            // move all files in used to library
            $usedfiles = glob(storage_path('app/'.$path.$used.'*.jpg'));
            // move used back to library
            foreach ($usedfiles as $usedfile) {
                $usedfilename = basename($usedfile);
                Storage::move($path.$used.$usedfilename, $path.$library.$usedfilename);
            }
        }
        // get random file from array

        $file = basename($filepath);
        if (Storage::exists($path.$current)) {
            Storage::delete($path.$current);
        }
        // copy image to current.jpg
        Storage::copy($path.$library.$file, $path.$current);
        Storage::move($path.$library.$file, $path.$used.$file);
    }
}
