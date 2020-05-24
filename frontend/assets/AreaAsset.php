<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap-datepicker.css',
        'css/site.css',
        'vuex-assets/vendors/css/vendors.min.css',
//        'vuex-assets/vendors/css/charts/apexcharts.css',
        'vuex-assets/vendors/css/extensions/tether-theme-arrows.css',
        'vuex-assets/vendors/css/extensions/tether.min.css',
        'vuex-assets/vendors/css/extensions/shepherd-theme-default.css',
        'vuex-assets/vendors/css/tables/datatable/datatables.min.css',
        'vuex-assets/vendors/css/file-uploaders/dropzone.min.css',
        'vuex-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css',
        'vuex-assets/css/bootstrap.css',
        'vuex-assets/css/bootstrap-extended.css',
        'vuex-assets/css/colors.css',
        'vuex-assets/css/components.css',
        'vuex-assets/css/themes/dark-layout.css',
        'vuex-assets/css/themes/semi-dark-layout.css',
        'vuex-assets/css/core/menu/menu-types/horizontal-menu.css',
        'vuex-assets/css/core/colors/palette-gradient.css',
        'vuex-assets/css/pages/dashboard-analytics.css',
        'vuex-assets/css/pages/card-analytics.css',
        'vuex-assets/css/plugins/tour/tour.css',
        'vuex-assets/css/plugins/file-uploaders/dropzone.css',
        'vuex-assets/css/core/colors/palette-gradient.css',
        'vuex-assets/css/pages/data-list-view.css',


    ];
    public $js = [
        'js/plagin/bootstrap-datepicker.js',
//        'js/bootstrap-datepicker.js',
        'vuex-assets/vendors/js/vendors.min.js',
        'vuex-assets/vendors/js/ui/jquery.sticky.js',
//        'vuex-assets/vendors/js/charts/apexcharts.min.js',
        'vuex-assets/vendors/js/extensions/tether.min.js',
        'vuex-assets/vendors/js/extensions/shepherd.min.js',
        'vuex-assets/vendors/js/extensions/dropzone.min.js',
        'vuex-assets/vendors/js/tables/datatable/pdfmake.min.js',
        'vuex-assets/vendors/js/tables/tables/datatable/vfs_fonts.js',
        'vuex-assets/vendors/js/tables/datatable/datatables.min.js',
        'vuex-assets/vendors/js/tables/datatable/datatables.buttons.min.js',
        'vuex-assets/vendors/js/tables/datatable/buttons.html5.min.js',
        'vuex-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js',
        'vuex-assets/vendors/js/tables/datatable/buttons.print.min.js',
        'vuex-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js',
        'vuex-assets/vendors/js/tables/datatable/dataTables.select.min.js',
        'vuex-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js',
        'vuex-assets/js/core/app-menu.js',
        'vuex-assets/js/core/app.js',
        'vuex-assets/js/scripts/components.js',
//        'vuex-assets/js/scripts/pages/dashboard-analytics.js'
        'vuex-assets/js/scripts/ui/data-list-view.js',
        'vuex-assets/js/scripts/datatables/datatable.js'


    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset',

    ];
}
