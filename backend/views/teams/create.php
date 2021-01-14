<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Award */

$this->title = 'Create Team';
$this->params['breadcrumbs'][] = ['label' => 'teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="award-create">
    <div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
</div>
