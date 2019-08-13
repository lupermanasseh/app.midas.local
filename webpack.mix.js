const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .sass("resources/sass/midas-styles.scss", "public/css")
    .sass("resources/sass/portal.scss", "public/css")
    .sass("resources/sass/print.scss", "public/css")
    .sass("resources/sass/printpdf.scss", "public/css")
    .copy(
        "node_modules/toastr/build/toastr.min.css",
        "public/css/toastr.min.css"
    )
    .copy("node_modules/toastr/build/toastr.min.js", "public/js/toastr.min.js")
    .copy("node_modules/echarts/dist/echarts.min.js", "public/js/echarts.min.js");
