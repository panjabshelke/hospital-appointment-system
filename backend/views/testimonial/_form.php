<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Award */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="award-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-12">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-12"> 
    <?= $form->field($model, 'description')->textarea(['rows' => 2])->widget(CKEditor::className()) ?>
   </div>
    
    <div class="col-md-12">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="col-md-12">       
        <br/><br/>
    </div>
    <?php ActiveForm::end(); ?>

</div>

