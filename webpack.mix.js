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
/**
 * Entry-Exit points
 */
mix.js('resources/assets/js/Accounting/app.js', 'public/Accounting/js')
   .sass('resources/assets/sass/Doctor/app.scss', 'public/Accounting/css');


/**
 * Config
 */
mix.webpackConfig({
    output: {
        chunkFilename: 'js/lazy-js-components/[name].js'
        // chunkFilename: 'js/lazy-js-components/[name].[chunkhash].js'
    },
});