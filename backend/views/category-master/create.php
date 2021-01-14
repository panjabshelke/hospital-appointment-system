<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CategoryMaster */

$this->title = 'Create Category Master';
$this->params['breadcrumbs'][] = ['label' => 'Category Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-master-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
