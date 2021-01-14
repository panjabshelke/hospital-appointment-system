<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientFollowUpDetails */

$this->title = 'Create Patient Follow Up Details';
$this->params['breadcrumbs'][] = ['label' => 'Patient Follow Up Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-follow-up-details-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
