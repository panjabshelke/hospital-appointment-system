<?php

use common\models\Banner;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <p>
        <?= Html::a('Add Image', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header' => '&nbsp;',
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($dataProvider) {
                    $filePath = Banner::getBannerDir() . $dataProvider->image;
                    return Html::img($filePath, ['width' => 50, 'height' => 50]);
                },
            ],
            'id',
            'title',
            [
                'attribute'=>'status',
                'header'=>'Status',
                'filter' => Html::activeDropDownList($searchModel, 'status', ['active'=>'Active', 'inactive'=>'In-Active', 'deleted'=>'Deleted'],['class'=>'form-control','prompt' => 'Select status']),
                'format'=>'raw',
                'headerOptions' => ['style' => 'color:#3c8dbc'],    
                'value' => function($model, $key, $index)
                {   
                    if($model->status == 'active') {
                        return 'Active';
                    } else if ($model->status == 'inactive') {
                        return 'In-Active';
                    } else {   
                        return 'Deleted';
                    }
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ];
            //Export Grid
            echo  ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $columns,
                'target' => ExportMenu::TARGET_BLANK,
                'exportConfig' => [
                    ExportMenu::FORMAT_TEXT => false,
                    ExportMenu::FORMAT_PDF => false,
                    ExportMenu::FORMAT_HTML => false,
                ],
                'filename' => 'categoryReport_'.date('d-m-Y h:i:s')
            ]);
        ?>

        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns
        ]); ?>
    <?php Pjax::end(); ?>

</div>
