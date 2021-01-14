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
        'css/site.css',
        // 'css/dist/css/bootstrap.css',
    ];
    public $js = [
        // 'js/dist/jquery.js',
        // 'js/dist/jquery.js',
        // 'js/assets/yii.js',

        // 'js/jquery.min.1.8.3.js',
        // 'js/jquery-ui-1.9.2.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
