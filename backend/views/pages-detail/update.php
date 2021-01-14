<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PagesDetail */

$this->title = 'Update Pages Detail: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages Details', 'url' => ['index']];
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
