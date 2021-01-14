<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PagesDetail */

$this->title = 'Schedule Doctor Availability';
$this->params['breadcrumbs'][] = ['label' => 'Doctor Availability', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-detail-create">

    <?= $this->render('_form', [
        'model' => $model,
        'activeDoctors' => $activeDoctors,
        'activeBranches' => $activeBranches,
    ]) ?>

</div>
