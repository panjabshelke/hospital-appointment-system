<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PatientFollowUpDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Follow Up Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-follow-up-details-index">
    
    <?php Pjax::begin(); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'doctor_name',
            'branch_name',
            'patient_name',
            'patient_contact_no',
            'patient_email:email',
            //'doctor_prescription:ntext',
            'created_at',
            'next_follow_up_date',
            //'created_at',
            //'modified_at',

            // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',//{update}
                'template' => '{view} {update}',
                'buttons' => [
                    'view' => function($url, $model) {
                        $url .= "&contactNo=".$model->patient_contact_no;
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url);
                    },
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
