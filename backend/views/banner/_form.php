<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    </div>
    <!-- <?= $form->field($model, 'image')->textInput() ?> -->
    <div class="col-md-12">       
        <?= $form->field($model, 'image')->fileInput(['rows' => 6, 'multiple' => TRUE]) ?>
    </div>
    <div class="row">
    <div class="col-md-6" style="padding-left: 30px;">
    <?= $form->field($model, 'status')->dropDownList($categoryStatus, [ 'active' => 'Active', 'class'=>'form-control input-sm',
['disabled' => ($model->isNewRecord) ? 'disabled' : false] ]) ?>
    </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
