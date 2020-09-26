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

mix.js('resources/js/app.js', 'public/js')

    .scripts([
        'node_modules/admin-lte/plugins/jquery/jquery.min.js',
        'node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'node_modules/admin-lte/dist/js/adminlte.min.js',
        'node_modules/admin-lte/plugins/datatables/jquery.dataTables.min.js',
        'node_modules/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
        'node_modules/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js'

    ], 'public/admin/js/admin.js')

    .styles([
        'node_modules/admin-lte/plugins/fontawesome-free/css/all.min.css',
        'node_modules/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        'node_modules/admin-lte/dist/css/adminlte.min.css',
        'node_modules/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
        'node_modules/admin-lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'

    ], 'public/admin/css/admin.css')


    .copy('node_modules/admin-lte/dist/js/adminlte.min.js.map', 'public/admin/js/adminlte.min.js.map')
    .copy('node_modules/admin-lte/plugins/jquery/jquery.min.map', 'public/admin/js/jquery.min.map')
    .copy('node_modules/admin-lte/dist/css/adminlte.min.css.map', 'public/admin/css/adminlte.min.css.map')
    .copy('node_modules/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js.map', 'public/admin/js/bootstrap.bundle.min.js.map')


    .copyDirectory('node_modules/admin-lte/plugins/fontawesome-free/webfonts', 'public/admin/webfonts')
    .copyDirectory('node_modules/admin-lte/dist/img', 'public/admin/dist/img')


    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
