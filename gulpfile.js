var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
        .scripts([
            '/jquery/dist/jquery.min.js',
            '/bootstrap/dist/js/bootstrap.min.js',
            '/nprogress/nprogress.js',
            '/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js',
            '/jquery.hotkeys/jquery.hotkeys.js',
            '/google-code-prettify/src/prettify.js'
        ], "public/js/dependencies.js", "resources/assets/template/vendors")
        .scripts([
            'resources/assets/template/build/js/custom.min.js',
            'resources/assets/js/app.js'
        ], "public/js/app.js")
        //.sass('app.scss')
        .styles([
            'resources/assets/template/build/css/custom.min.css',
            'resources/assets/css/app.js'
        ], 'public/css/app.css')
        .browserSync({
            proxy: 'local-crm.dev'
        });
});