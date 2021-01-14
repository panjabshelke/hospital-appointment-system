<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientFollowUpDetails */

$this->title = 'Update Patient Follow Up Details: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Patient Follow Up Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="patient-follow-up-details-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
