<?php

use backend\models\Testimonial;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TestimonialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Testimonials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testimonial-index">

    <p>
        <?= Html::a('Create Testimony', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],
            // [
            //     'header' => '&nbsp;',
            //     'attribute' => 'image',
            //     'format' => 'raw',
            //     'value' => function ($dataProvider) {
            //         $filePath = Testimonial::getBannerDir() . $dataProvider->image;
            //         return Html::img($filePath, ['width' => 50, 'height' => 50]);
            //     },
            // ],
            'name:ntext',
            'description',
            
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
