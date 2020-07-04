<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class NewAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/font-awesome.min.css',
        'new_temp/news/vendor/bootstrap/css/bootstrap.min.css',
        'new_temp/news/vendor/fontawesome-free/css/all.min.css',
        'new_temp/news/vendor/animate/animate.min.css',
        'new_temp/news/vendor/simple-line-icons/css/simple-line-icons.min.css',
        'new_temp/news/vendor/owl.carousel/assets/owl.carousel.min.css',
        'new_temp/news/vendor/owl.carousel/assets/owl.theme.default.min.css',
        'new_temp/news/vendor/magnific-popup/magnific-popup.min.css',
        'new_temp/news/vendor/rs-plugin/revolution-addons/typewriter/css/typewriter.css',
        'new_temp/news/css/theme.css',
        'new_temp/news/css/theme-elements.css',
        'new_temp/news/css/theme-blog.css',
        'new_temp/news/css/theme-shop.css',
        'new_temp/news/vendor/rs-plugin/css/settings.css',
        'new_temp/news/vendor/rs-plugin/css/layers.css',
        'new_temp/news/vendor/rs-plugin/css/navigation.css',
        'new_temp/css/style.css',
        'new_temp/fonts/font-awesome/css/font-awesome.min.css',
        'new_temp/css/toastr.css',
        'new_temp/news/css/skins/skin-corporate-14.css',
        'new_temp/news/css/custom.css'
    ];
    public $js = [
//        'new_temp/news/vendor/jquery/jquery.min.js',
        'js/main.js',
        'js/jquery.mask.js',
        'new_temp/news/vendor/modernizr/modernizr.min.js',
        'new_temp/news/vendor/jquery.appear/jquery.appear.min.js',
        'new_temp/news/vendor/jquery.easing/jquery.easing.min.js',
        'new_temp/news/vendor/jquery.cookie/jquery.cookie.min.js',
        'new_temp/news/vendor/popper/umd/popper.min.js',
        'new_temp/news/vendor/common/common.min.js',
        'new_temp/news/vendor/jquery.validation/jquery.validate.min.js',
        'new_temp/news/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js',
        'new_temp/news/vendor/jquery.gmap/jquery.gmap.min.js',
        'new_temp/news/vendor/jquery.lazyload/jquery.lazyload.min.js',
        'new_temp/news/vendor/isotope/jquery.isotope.min.js',
        'new_temp/news/vendor/owl.carousel/owl.carousel.min.js',
        'new_temp/news/vendor/magnific-popup/jquery.magnific-popup.min.js',
        'new_temp/news/vendor/vide/jquery.vide.min.js',
        'new_temp/news/vendor/vivus/vivus.min.js',
        'new_temp/js/toastr.min.js',
        'new_temp/news/js/theme.js',
        'new_temp/news/vendor/rs-plugin/js/jquery.themepunch.tools.min.js',
        'new_temp/news/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js',
        'new_temp/news/vendor/rs-plugin/revolution-addons/typewriter/js/revolution.addon.typewriter.min.js',
        'new_temp/news/js/custom.js',
        'new_temp/news/js/theme.init.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',

    ];

}
