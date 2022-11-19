const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .js('resources/js/admin.js', 'public/js')
//     .less('resources/less/app.less', 'public/css')
//     .less('resources/less/admin.less', 'public/css');

if (mix.inProduction()) {
    mix
        .setPublicPath('public/dist')
        .js('resources/assets/js/app.js', 'js/all.min.js')
        .sass('resources/assets/sass/app.scss', 'css/styles.min.css')
        .options({
            processCssUrls: false,
            postCss: [
                require('tailwindcss'),
                require('autoprefixer'),
            ]
        })
        //.sourceMaps()
        .version();
} else {
    mix
        .setPublicPath('public/src')
        .js('resources/assets/js/app.js', 'js/all.js')
        .sass('resources/assets/sass/app.scss', 'css/styles.css')
        .options({
            processCssUrls: false,
            postCss: [
                require('tailwindcss'),
                require('autoprefixer'),
            ]
        })
        .sourceMaps()
        .version();

    mix.disableNotifications();

    mix.webpackConfig({
        devServer: {
            disableHostCheck: true,
        }
    });
}

/*
mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
    require('autoprefixer'),
]);

 */
