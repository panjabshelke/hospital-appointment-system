<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientFollowUpDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-follow-up-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'patient_appointemnt_details_fk')->textInput() ?>

    <?= $form->field($model, 'patient_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_contact_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doctor_prescription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'next_follow_up_date')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'modified_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
