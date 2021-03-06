const mix = require('laravel-mix');

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

mix.sass('resources/sass/dashboard.scss', 'public/css').version();
mix.sass('resources/sass/styles.scss', 'public/css').version();

mix.js('resources/js/app.js', 'public/js').version();

mix.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'resources/js/like.js'
], 'public/js/like.js');
