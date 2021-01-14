<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title>Piles Free World Hospital - <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="<?=Yii::getAlias('@root') . DIRECTORY_SEPARATOR?>lib-old/jquery/jquery.min.js"></script>
    <!-- Facebook Pixel Code -->
    <!-- <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '425953131775508');
        fbq('track', 'PageView');
    </script>
    <noscript> <img height="1" width="1" src="https://www.facebook.com/tr?id=425953131775508&ev=PageView&noscript=1" /></noscript>End Facebook Pixel Code -->
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="size-1140">
        <div class="">
            <!-- <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
        <?= Alert::widget() ?> -->
            <?= $this->render('header') ?>
            <?= $content ?>
            <?= $this->render('footer') ?>
        </div>
    </div>


    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>