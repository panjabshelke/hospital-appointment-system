<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/mystyle.css',
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/bootstrap-datepicker.css',
        'css/animate.min.css',
        // 'lib/bootstrap/css/bootstrap.min.css',
        // 'lib/animate/animate.min.css',
        // 'lib/font-awesome/css/font-awesome.min.css',
        // 'lib/ionicons/css/ionicons.min.css',
        // 'lib/owlcarousel/assets/owl.carousel.min.css',
        // 'lib/lightbox/css/lightbox.min.css',
        // 'css/style.css',
        // 'css/responsive.css',
        
        // 'css/components.css',
        // 'css/icons.css',
        // 'css/responsee.css',
        // 'owl-carousel/owl.carousel.css',
        // 'owl-carousel/owl.theme.css',
        // 'css/template-style.css',
        // 'css/site.css'
    ];
    /*
    <script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
 <script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/scripts.js"></script>
<script src="plugins/jquery.parallax.js"></script>
<script src="js/min/plugins.min.js"></script>
<script src="js/min/medigo-custom.min.js"></script>
    */
    public $js = [
        // 'js/jquery-3.2.1.slim.min.js',
        // 'js/popper.min.js',
        'js/bootstrap.min.js',
        'js/bootstrap.bundle.min.js',
        'js/bootstrap-datepicker.min.js',
        'js/scripts.js',
        // 'plugins/jquery.parallax.js',
        // 'js/min/plugins.min.js',
        // 'js/min/medigo-custom.min.js',
        // "js/jquery.js",
        // "js/bootstrap.min.js",
        // "lib/jquery/jquery.min.js",
        // "lib/jquery/jquery-migrate.min.js",
        // "lib/bootstrap/js/bootstrap.bundle.min.js",
        // "lib/mobile-nav/mobile-nav.js",
        // "lib/wow/wow.min.js",
        // "lib/waypoints/waypoints.min.js",
        // "lib/counterup/counterup.min.js",
        // "lib/owlcarousel/owl.carousel.min.js",
        // "lib/isotope/isotope.pkgd.min.js",
        // "lib/lightbox/js/lightbox.min.js",
        // "contactform/contactform.js",
        // "js/main.js"
        // "js/owl.carousel.min.js",
    // //    "js/jquery.prettyPhoto.js",
       
    // //    "js/jquery.isotope.min.js",
    //    "js/main.js",
        // "js/jquery-1.8.3.min.js",
        // "js/jquery-ui.min.js",
        // "js/responsee.js",
        // "owl-carousel/owl.carousel.js",
        // "js/template-scripts.js"
    ];
    public $depends = [
        // 'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
