<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PagesDetail */

$this->title = 'Create Page Detail';
$this->params['breadcrumbs'][] = ['label' => 'Pages Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-detail-create">

    <?= $this->render('_form', [
        'model' => $model,
        'activePages' => $activePages,
        'categoryStatus' => $categoryStatus,
    ]) ?>

</div>
