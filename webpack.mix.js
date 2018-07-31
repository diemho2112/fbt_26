let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('node_modules/font-awesome/fonts/', 'public/fonts')
    .sass('node_modules/font-awesome/scss/font-awesome.scss', 'public/css')
    .version();
mix.js('resources/assets/js/home.js', 'public/js/home.js')
mix.js('resources/assets/js/tour.js', 'public/js/tour.js')
mix.js('resources/assets/js/booking.js', 'public/js/booking.js')
mix.styles([
    'resources/assets/css/main.css',
    'resources/assets/css/main2.css',
    'resources/assets/css/main3.css',
    'resources/assets/css/review.css'
], 'public/css/all.css');
mix.copyDirectory('resources/assets/img', 'public/img');
