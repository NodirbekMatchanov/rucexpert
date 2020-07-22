<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AreaAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'new_temp/admin/vendor/bootstrap/css/bootstrap.css',
        'new_temp/admin/vendor/animate/animate.css',
        'new_temp/admin/vendor/font-awesome/css/all.min.css',
        'new_temp/admin/vendor/font-awesome/css/fontawesome.css',
        'new_temp/admin/vendor/magnific-popup/magnific-popup.css',
        'new_temp/admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css',
        'new_temp/admin/vendor/jquery-ui/jquery-ui.css',
        'new_temp/admin/vendor/jquery-ui/jquery-ui.theme.css',
        'new_temp/admin/vendor/bootstrap-multiselect/css/bootstrap-multiselect.css',
        'new_temp/admin/vendor/morris/morris.css',
//        'new_temp/css/toastr.css',
        'new_temp/admin/css/theme.css',
        'new_temp/admin/css/skins/default.css',
        'new_temp/admin/css/custom.css'


    ];
    public $js = [
        'new_temp/admin/vendor/modernizr/modernizr.js',
//        'new_temp/admin/vendor/jquery/jquery.js',
        'new_temp/admin/vendor/jquery-browser-mobile/jquery.browser.mobile.js',
        'new_temp/admin/vendor/popper/umd/popper.min.js',
        'new_temp/admin/vendor/bootstrap/js/bootstrap.js',
        'new_temp/admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js',
        'new_temp/admin/vendor/common/common.js',
        'new_temp/admin/vendor/nanoscroller/nanoscroller.js',
        'new_temp/admin/vendor/magnific-popup/jquery.magnific-popup.js',
        'new_temp/admin/vendor/jquery-placeholder/jquery.placeholder.js',
        'new_temp/admin/vendor/ios7-switch/ios7-switch.js',
        'new_temp/admin/vendor/jquery-ui/jquery-ui.js',
        'new_temp/admin/vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js',
        'new_temp/admin/vendor/jquery-appear/jquery.appear.js',
        'new_temp/admin/vendor/bootstrap-multiselect/js/bootstrap-multiselect.js',
        'new_temp/admin/vendor/jquery.easy-pie-chart/jquery.easypiechart.js',
        'new_temp/admin/vendor/flot/jquery.flot.js',
        'new_temp/admin/vendor/flot.tooltip/jquery.flot.tooltip.js',
        'new_temp/admin/vendor/flot/jquery.flot.pie.js',
        'new_temp/admin/vendor/flot/jquery.flot.categories.js',
        'new_temp/admin/vendor/flot/jquery.flot.resize.js',
        'new_temp/admin/vendor/jquery-sparkline/jquery.sparkline.js',
        'new_temp/admin/vendor/raphael/raphael.js',
        'new_temp/admin/vendor/morris/morris.js',
        'new_temp/admin/vendor/gauge/gauge.js',
        'new_temp/admin/vendor/snap.svg/snap.svg.js',
        'new_temp/admin/vendor/liquid-meter/liquid.meter.js',
        'new_temp/admin/vendor/jqvmap/jquery.vmap.js',
        'new_temp/admin/vendor/jqvmap/data/jquery.vmap.sampledata.js',
        'new_temp/admin/vendor/jqvmap/maps/jquery.vmap.world.js',
        'new_temp/admin/vendor/jqvmap/maps/continents/jquery.vmap.africa.js',
        'new_temp/admin/vendor/jqvmap/maps/continents/jquery.vmap.asia.js',
        'new_temp/admin/vendor/jqvmap/maps/continents/jquery.vmap.australia.js',
        'new_temp/admin/vendor/jqvmap/maps/continents/jquery.vmap.europe.js',
        'new_temp/admin/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js',
        'new_temp/admin/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js',
        'new_temp/admin/js/theme.js',
        'new_temp/admin/js/custom.js',
        'new_temp/admin/js/theme.init.js',
        'new_temp/admin/js/examples/examples.header.menu.js',
        'new_temp/admin/js/examples/examples.dashboard.js',
        'new_temp/admin/js/examples/examples.advanced.form.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset',

    ];
}
