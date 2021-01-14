<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */

$this->title = 'Update Team: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Testimonial', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="testimonial-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
