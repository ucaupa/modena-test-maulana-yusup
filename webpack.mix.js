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

mix
    .js('resources/js/app.js', 'public/js')
    .minify('public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css')
    .copyDirectory('node_modules/select2', 'public/plugins/select2')
    .copyDirectory('node_modules/jquery-ui-dist', 'public/plugins/jquery-ui')
    .sourceMaps();
