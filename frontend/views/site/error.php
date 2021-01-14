<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix">
        <div class="container">

            <div class="banner-info">


            </div>
    </section><!-- #intro -->
    <section id="about">
        <div class="container">
            <div class="row about-container">

                <div class="col-lg-12 content order-lg-1 order-2">
                <h2 class="text-size-40  text-m-size-40 text-center"><?= Html::encode($this->title) ?></h2>
            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>
            <p>The above error occurred while the Web server was processing your request.</p>
            <p>Please contact us if you think this is a server error. Thank you.</p>
                </div>
            </div>
        </div>
    </section>
<!-- <section class="section" style="padding-top: 10px;">
        <div class="line">
            <h2 class="text-size-40  text-m-size-40 text-center"><?= Html::encode($this->title) ?></h2>
            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>
            <p>The above error occurred while the Web server was processing your request.</p>
            <p>Please contact us if you think this is a server error. Thank you.</p>
        </div>
</section> -->
