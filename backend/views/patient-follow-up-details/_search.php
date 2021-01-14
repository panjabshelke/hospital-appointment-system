<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientFollowUpDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-follow-up-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'patient_appointemnt_details_fk') ?>

    <?= $form->field($model, 'patient_name') ?>

    <?= $form->field($model, 'patient_contact_no') ?>

    <?= $form->field($model, 'patient_email') ?>

    <?php // echo $form->field($model, 'doctor_prescription') ?>

    <?php // echo $form->field($model, 'next_follow_up_date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'modified_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
