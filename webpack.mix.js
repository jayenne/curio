const mix = require('laravel-mix');

const proxy = process.env.BROWSERSYNC_PROXY
const host = process.env.BROWSERSYNC_HOST
const port = process.env.BROWSERSYNC_PORT
console.log(proxy,host,port);
/*
mix.options({
    extractVueStyles: false,
    processCssUrls: false,
    clearConsole: false,
    cssNano: {
        discardComments: {removeAll: false},
    }
});
*/
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.copy('resources/svg/cursors/', 'public/css/cursors/');
mix.js('resources/js/app.js', 'public/js/app.js')
.js([
        //'node_modules/infinite-scroll/dist/infinite-scroll.pkgd.js',
        //'node_modules/packery/dist/packery.pkgd.min.js',
        //'node_modules/draggabilly/dist/draggabilly.pkgd.min.js',
        //'node_modules/jquery-match-height/dist/jquery.matchHeight.min.js',
        'resources/js/platform.js',
        //'node_modules/jquery-sidebar/src/jquery.sidebar.min.js',
        //'node_modules/bootstrap-notify/bootstrap-notify.min.js',
        //'resources/js/alert-modal.js',
        'node_modules/freezeframe/dist/freezeframe.min.js',
        'node_modules/bs4-toast/dist/toast.min.js',
        'resources/js/ajax-forms.js',
        'resources/js/alert-toast.js',
        //
        'resources/js/nav.js',
        //'resources/js/nav_sidebar.js',  
        'resources/js/uploader.js',
        'resources/js/grids.js',
        //'resources/js/grid-overlays.js',
        'resources/js/modals.js',
        'resources/js/reactions.js',
    ], 'public/js/grids.js')
.sass('resources/sass/app.scss', 'public/css')
//.sass('resources/sass/docs.scss', 'resources/themes/PintoDocsTheme/resources/css/theme.css')

/*
mix.browserSync({
    open: false,
    host: host,
    proxy: proxy,
    port: port
});
*/