<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PagesDetail */

$this->title = 'Update Schedule Doctor Availability: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Schedule Doctor Availability', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pages-detail-update">

    <?= $this->render('_form', [
        'model' => $model,
        'activePages' => $activePages,
        'categoryStatus' => $categoryStatus,
    ]) ?>

</div>
