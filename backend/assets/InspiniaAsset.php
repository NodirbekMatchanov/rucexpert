<?php

namespace backend\assets;


use yii\helpers\FileHelper;
use yii\web\AssetBundle;


class InspiniaAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'vuex-assets/vendors/css/vendors.min.css',
        'vuex-assets/vendors/css/extensions/shepherd-theme-default.css',
        'vuex-assets/vendors/css/file-uploaders/dropzone.min.css',
        'vuex-assets/css/bootstrap.css',
        'vuex-assets/css/bootstrap-extended.css',
        'vuex-assets/css/colors.css',
        'vuex-assets/css/components.css',
        'vuex-assets/css/themes/dark-layout.css',
        'vuex-assets/css/themes/semi-dark-layout.css',
        'vuex-assets/css/pages/authentication.css'
    ];

    public $js = [
        'js/plagin/bootstrap-datepicker.js',
        'vuex-assets/vendors/js/vendors.min.js',
        'vuex-assets/vendors/js/ui/jquery.sticky.js',
        'vuex-assets/js/core/app-menu.js',
        'vuex-assets/js/core/app.js',
        'vuex-assets/js/scripts/components.js',


    ];

    public $depends = [
        'yii\web\YiiAsset',
//        'rmrevin\yii\fontawesome\AssetBundle',
    ];

}
