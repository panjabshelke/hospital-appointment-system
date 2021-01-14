<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\CategoryMaster;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoryMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Category Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-master-index">

    <p>
        <?= Html::a('Create Category', ['create-category'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'category_name',
            // 'parent_category',
            [
                'attribute' => 'parent_category',
                'filter' => Html::activeDropDownList($searchModel, 'parent_category',$searchModel->getPrimaryCategories(),['class'=>'form-control','prompt' => 'Select parent category']),
                'format' => 'raw',
                'value' => function($model) {
                    switch($model->parent_category) {
                        case '':
                            return "Primary";
                            break;
                        case null;
                            return "Primary";
                            break;
                        default;
                            return $model->parent_category;
                            break;
                    }
                },
            ],
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
            // 'status',
            'created_at',
            //'modified_at',
            ['class' => 'yii\grid\ActionColumn'],
        ];
    //Export Grid
    echo ExportMenu::widget([
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
