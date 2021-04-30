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

//bootstrap
mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css');
mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css.map', 'public/css');

//calendar
mix.copy('node_modules/fullcalendar/main.min.css', 'public/css/fullcalendar');

//main css
mix.sass('resources/sass/style.scss', 'public/css');
mix.copy('resources/css/app.css', 'public/css');

//fonts
mix.copy('node_modules/@coreui/icons/fonts', 'public/fonts');
//icons
mix.copy('node_modules/@coreui/icons/css/free.min.css', 'public/css');
mix.copy('node_modules/@coreui/icons/css/free.min.css.map', 'public/css');

//general scripts
mix.copy('node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js', 'public/js');
mix.copy('node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js.map', 'public/js');

//bootstrap
mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', 'public/js');
mix.copy('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js.map', 'public/js');

//calendar
mix.copy('node_modules/fullcalendar/main.min.js', 'public/js/fullcalendar');
mix.copy('node_modules/fullcalendar/locales/es.js', 'public/js/fullcalendar');

//images
mix.copy('resources/assets', 'public/assets');