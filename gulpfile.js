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
            '/pnotify/dist/pnotify.nonblock.js',
            '/moment/moment.js',
            '/bootstrap-daterangepicker/daterangepicker.js',
            '/bootstrap-progressbar/bootstrap-progressbar.min.js',
            '/dropzone/dist/min/dropzone.min.js'
        ], "public/js/dependencies.js", "resources/assets/template/vendors")
        .scripts([
            'jquery-confirm/dist/jquery-confirm.min.js',
            'magnific-popup/dist/jquery.magnific-popup.min.js',
            'select2/dist/js/select2.min.js',
            'jquery-datetimepicker/build/jquery.datetimepicker.full.min.js',
        ], "public/js/modules.js", "node_modules")
        .scripts([
            'template/build/js/custom.min.js',
            'js/app.js',
            'js/users.js',
            'js/companies.js'
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
            'template/vendors/dropzone/dist/min/dropzone.min.css',
            'css/app.css'
        ], 'public/css/app.css', "resources/assets/")

        // Datatables
        .scripts([
            '/datatables.net/js/jquery.dataTables.min.js',
            '/datatables.net-bs/js/dataTables.bootstrap.min.js',
            '/datatables.net-buttons/js/dataTables.buttons.min.js',
            '/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
            '/datatables.net-buttons/js/buttons.flash.min.js',
            '/datatables.net-buttons/js/buttons.html5.min.js',
            '/datatables.net-buttons/js/buttons.print.min.js',
            '/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js',
            '/datatables.net-keytable/js/dataTables.keyTable.min.js',
            '/datatables.net-responsive/js/dataTables.responsive.min.js',
            '/datatables.net-responsive-bs/js/responsive.bootstrap.js',
            '/datatables.net-scroller/js/dataTables.scroller.min.js'
        ], "public/js/datatables.js", "resources/assets/template/vendors")
        .styles([
            'template/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css',
            'template/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css',
            'template/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css',
            'template/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css',
            'template/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css'
        ], 'public/css/datatables.css', "resources/assets/")

        .styles([
            'node_modules/jquery-confirm/dist/jquery-confirm.min.css',
            'magnific-popup/dist/magnific-popup.css',
            'select2/dist/css/select2.css',
            'jquery-datetimepicker/build/jquery.datetimepicker.min.css',
        ], 'public/css/modules.css', "node_modules")
        .browserSync({
            files: [
                'app/**/*',
                'resources/views/**/*',
                'public/js/**/*',
                'packages/**/*'
            ],
            proxy: 'local-crm.dev'
        });
});