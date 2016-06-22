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
            '/google-code-prettify/src/prettify.js',
            '/pnotify/dist/pnotify.js',
            '/pnotify/dist/pnotify.buttons.js',
            '/pnotify/dist/pnotify.nonblock.js'
        ], "public/js/dependencies.js", "resources/assets/template/vendors")
        .scripts([
            'jquery-confirm/dist/jquery-confirm.min.js'
        ], "public/js/modules.js", "node_modules")
        .scripts([
            'template/build/js/custom.min.js',
            'js/app.js'
        ], "public/js/app.js", "resources/assets/")
        //.sass('app.scss')
        .styles([
            'template/vendors/bootstrap/dist/css/bootstrap.min.css',
            'template/vendors/font-awesome/css/font-awesome.min.css',
            'template/vendors/iCheck/skins/flat/green.css',
            'template/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css',
            'template/vendors/pnotify/dist/pnotify.css',
            'template/vendors/pnotify/dist/pnotify.buttons.css',
            'template/vendors/pnotify/dist/pnotify.nonblock.css',
            'template/build/css/custom.min.css',
            'css/app.css'
        ], 'public/css/app.css', "resources/assets/")
        .styles([
            'node_modules/jquery-confirm/dist/jquery-confirm.min.css'
        ], 'public/css/modules.css', "node_modules")
        .browserSync({
            proxy: 'local-crm.dev'
        });
});