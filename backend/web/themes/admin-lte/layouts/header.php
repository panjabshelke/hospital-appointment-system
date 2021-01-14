<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini"><img class="logo-white" src="'.Yii::getAlias('@root') . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR.'Symbol.png" alt="'.Yii::$app->name.'" style="height: 53px;width: 200px;"></span><span class="logo-lg"><img class="logo-white" src="'.Yii::getAlias('@root') . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR.'Symbol.png" alt="Project Base" style="height: 53px;width: 200px;"></span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown messages-menu">
                        <a href="<?= \Yii::$app->getUrlManager()->createUrl('site/contact-us') ?>" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <?php $resCount = 0; //$resCount = \common\models\ContactUs::find()->where(['is_read' => '0'])->count(); ?>
                            <span class="label label-success"><?php echo $resCount; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <?php echo $resCount; ?> contact us</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <?php
                                    if ($resCount > 0) {
                                        // $result = \common\models\ContactUs::find()->where(['is_read' => '0'])->all();
                                        $result = [];
                                        foreach ($result as $key => $val) {
                                            ?>
                                            <li>
                                                <a href="<?= \Yii::$app->getUrlManager()->createUrl('site/view?id=' . $val->id); ?>">
                                                    <h4 style="margin: 0px">
                                                        <?php echo $val->first_name . " " . $val->last_name; ?>
                                                        <small><i class="fa fa-clock-o"></i> <?php
                                                            $diff = strtotime(date("Y-m-d h:i:s")) - strtotime($val->created_at);
                                                            $days = abs(round($diff / 86400));
                                                            if ($days == 0) {
                                                                echo date("h:i A", strtotime($val->created_at));
                                                            } else {
                                                                echo date("D", strtotime($val->created_at)) . " " . date("d/m", strtotime($val->created_at));
                                                            }
                                                            ?>
                                                        </small>
                                                    </h4>
                                                    <p style="margin: 0px"><?php echo strlen($val->message) > 30 ? substr($val->message, 0, 30) . "..." : $val->message; ?></p>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>  
                                </ul>
                            </li>
                            <li class="footer"><a href="<?= \Yii::$app->getUrlManager()->createUrl('site/contact-us'); ?>">See All Messages</a></li>
                        </ul>
                    </li>
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <?php $newOrderCount = 0; // $newOrderCount = \backend\modules\orders\models\Orders::find()->where(['order_view_status' => '0'])->count(); ?>
                            <span class="label label-warning"><?php echo $newOrderCount ? $newOrderCount : '0'; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <?php echo $newOrderCount ? $newOrderCount : '0'; ?> Booking</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <?php
                                    if ($newOrderCount > 0) {
                                        $orderNotify =[];
                                        // $orderNotify = \backend\modules\orders\models\Orders::find()->where(['order_view_status' => '0'])->all();
                                        foreach ($orderNotify as $ordKey => $ordVal) {
                                            ?>
                                            <li>
                                                <a href="<?= \Yii::$app->getUrlManager()->createUrl('patient-appointment-details/?PatientAppointmentDetailsSearch[status]=Pending'); ?>">
                                                    <h4 style="margin: 0px">
                                                        <?php echo $ordVal->full_name; ?>
                                                        <small style="float:right;"><i class="fa fa-clock-o"></i> <?php
                                                            $datediff = strtotime(date("Y-m-d h:i:s")) - strtotime($ordVal->created_at);
                                                            $inDays = abs(round($datediff / 86400));
                                                            if ($inDays == 0) {
                                                                echo date("h:i A", strtotime($ordVal->created_at));
                                                            } else {
                                                                echo date("D", strtotime($ordVal->created_at)) . " " . date("d/m", strtotime($ordVal->created_at));
                                                            }
                                                            ?>
                                                        </small>
                                                    </h4>

                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>  
                                </ul>
                            </li>
                            <li class="footer"><a href="<?= \Yii::$app->getUrlManager()->createUrl('patient-appointment-details/?PatientAppointmentDetailsSearch[status]=Pending'); ?>">View all</a></li>
                        </ul>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                            <span class="hidden-xs"><?= strtoupper(Yii::$app->user->identity->username) ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                     alt="User Image"/>
                                <p>
                                    <?= ucwords(Yii::$app->user->identity->email) ?>
                                    <small>Member since <?= date('M Y', Yii::$app->user->identity->created_at) ?></small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-12 text-center">
                                    <a class="btn btn-default btn-flat" href="<?= Url::toRoute('/admin/user/change-password') ?>">Change Password</a>
                                </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?= Url::toRoute('/admin/user/view-my-profile') ?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <?=
                                    Html::a(
                                            'Sign out', ['/admin/user/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                    )
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                <!-- <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">Admin</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </nav>
</header>
