<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\PagesDetail;

/* @var $this yii\web\View */
/* @var $model backend\models\PagesDetail */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pages-detail-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'header' => '&nbsp;',
                'attribute' => 'page_image',
                'format' => 'raw',
                'value' => function ($dataProvider) {
                    $filePath = PagesDetail::getPagesDir() . $dataProvider->page_image;
                    return Html::img($filePath, ['width' => 100, 'height' => 100]);
                },
            ],
            // 'id',
            'title',
            // 'slug:ntext',
            'description:ntext',
            'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
            'status',
        ],
    ]) ?>

</div>
