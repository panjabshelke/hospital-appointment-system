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

    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'description')->textarea(['rows' => 2])->widget(CKEditor::className()) ?>
   
    <?= $form->field($model, 'image')->fileInput(['rows' => 6, 'multiple' => TRUE]) ?>

    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
      
    <?php ActiveForm::end(); ?>

</div>

