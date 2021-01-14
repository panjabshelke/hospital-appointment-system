<?php

use backend\models\CategoryMaster;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\Pjax;
use backend\models\DoctorAvailability;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DoctorAvailabilitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doctor Availability';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-detail-index">

    <p>
        <?= Html::a('Add Doctor Availability', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php 
         $columns = [
            ['class' => 'yii\grid\SerialColumn'],

            // [
            //     'header' => '&nbsp;',
            //     'attribute' => 'page_image',
            //     'format' => 'raw',
            //     'value' => function ($dataProvider) {
            //         $filePath = DoctorAvailability::getPagesDir() . $dataProvider->page_image;
            //         return Html::img($filePath, ['width' => 50, 'height' => 50]);
            //     },
            // ],
            [
                // 'header' => 'doctor_name',
                'attribute' => 'doctor_name',
                'format' => 'raw',
                'value' => function ($dataProvider) {
                    
                    $details = CategoryMaster::categoryDetails($dataProvider->doctor_id);
                    return $name = (isset($details->category_name) && !empty($details->category_name)) ? $details->category_name : "-";
                },
            ],
            [
                // 'header' => 'Branch Name',
                'attribute' => 'branch_name',
                'format' => 'raw',
                'value' => function ($dataProvider) {
                    $details = CategoryMaster::categoryDetails($dataProvider->branch_id);
                    return $name = (isset($details->category_name) && !empty($details->category_name)) ? $details->category_name : "-";
                },
            ],
            'available_from',
            'available_upto',
            // 'description:ntext',
            [
                'attribute'=>'status',
                'header'=>'Status',
                'filter' => Html::activeDropDownList($searchModel, 'status', DoctorAvailability::DOCTOR_AVAILABILITY_STATUS,['class'=>'form-control','prompt' => 'Select status']),
                'format'=>'raw',
                'headerOptions' => ['style' => 'color:#3c8dbc'],    
                // 'value' => function($model, $key, $index)
                // {   
                //     if($model->status == 'active') {
                //         return 'Active';
                //     } else if ($model->status == 'inactive') {
                //         return 'In-Active';
                //     } else {   
                //         return 'Deleted';
                //     }
                // },
            ],
            'created_at',
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
            'filename' => 'doctorAvailabilityReport_'.date('d-m-Y h:i:s')
        ]);
     ?>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $columns
        ]); ?>
    <?php Pjax::end(); ?>

</div>
