<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\Pjax;
use backend\models\PagesDetail;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PagesDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-detail-index">

    <p>
        <?= Html::a('Create Pages Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php 
         $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'header' => '&nbsp;',
                'attribute' => 'page_image',
                'format' => 'raw',
                'value' => function ($dataProvider) {
                    $filePath = PagesDetail::getPagesDir() . $dataProvider->page_image;
                    return Html::img($filePath, ['width' => 50, 'height' => 50]);
                },
            ],
            'title',
            // 'slug:ntext',
            [
                'headerOptions' => ['style' => 'min-width:109px;color:#3c8dbc',],
                'attribute' => 'description',
                'filter' => FALSE,
                'format' => 'html',
                'value' => function ($dataProvider) {//&#10;
                    $dataProvider->description = strip_tags($dataProvider->description);
                    $descriptionMinList = (strlen($dataProvider->description) > 200 && !isset($_POST['export_type'])) ? substr($dataProvider->description, 0, 200) . "..." : $dataProvider->description;
                    return "<span title='$dataProvider->description'>" . $descriptionMinList . "</span>";
                },
                'format' => 'raw',
            ],
            // 'description:ntext',
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
            'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'status',

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
