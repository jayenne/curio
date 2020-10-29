# Custom Artisan Commands
- [image:cycle]('image-cycle')

## Platform
<a name="image-cycle">Cycle "current" Image</a>
The App has a "daily-image" function that randomly selects an image form a library as a scheduled task, copying it to a public folder as "current.jpg", the nmoves the source file to the `used` folder. When the `library` folder has just one file left it moves all the files backfrom the `used` folder (moving the last file (the newly "current" image) to the `used` folder) available to the app's html/css.
The library of images must all be .jpg and all the same aspect ratio. Ideally 16:9 as 1920 x 1080.
The stock `library` and the `used` is `/storage/app/public/images/daily/library` and `/storage/app/public/images/daily/library` respectivly, with the current.jpg shares the same parent folder.
Folders and file names are cofigurable in the config/platform as `scheduled_image_update`
The daily update is triggered as a schedule as an artisan command using `php artisan platform:image.cycle`.
