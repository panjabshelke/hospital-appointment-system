<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script src="http://localhost/hospital-appointment-system/xadmin/js/jquery.min.1.8.3.js"></script>
        <script src="http://localhost/hospital-appointment-system/xadmin/js/jquery-ui-1.9.2.js"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    <div id="sound" style="display: none;">
            <audio class='player_audio' id="player_audio" controls='controls'>
                <source src='http://localhost/beep-04.mp3' type='audio/mp3' />
            </audio>
    </div>
    <script type="text/javascript">
    // setTimeout(function(){
    //   // $('#player_audio').play;
    //   $('#player_audio')[0].play();
    //   // $('#player_audio').get(0).play();
    //   // $('#player_audio').pause;
    //   console.log("hi");
    // }, 3000);
        $(document).ready(function(){ 
            setInterval(function() {      
                // $('#player_audio')[0].play();
                checkAppointment();
            //your jQuery ajax code
            }, 5000);

            function checkAppointment() {
                var appointmentType = 'Pending';
                $.ajax({
                    url: '<?php echo Yii::$app->getUrlManager()->createUrl('patient-appointment-details/get-appointment-details') ?>',
                    type: 'POST',
                    data: {appointmentType: appointmentType},
                    dataType: 'json',
                    success: function (result) {
                        if (result.status == "success") {
                            $('#player_audio')[0].play();
                        } 
                    },
                    complete: function (result) {
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                    }
                });
            }
        });
    </script>
    </body>
</html>
    <?php $this->endPage() ?>
<?php } ?>
