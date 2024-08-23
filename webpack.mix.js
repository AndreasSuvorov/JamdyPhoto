const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .react()
    .sass('resources/sass/app.scss', 'public/css');

mix.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
});
