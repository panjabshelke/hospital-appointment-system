<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PatientFollowUpDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Add Follow Up Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-follow-up-details-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'patient_appointemnt_details_fk',
            'doctor_name',
            'branch_name',
            'patient_name',
            'patient_contact_no',
            'patient_email:email',
            'available_time_slot',
            'available_date',
            [
                'attribute' => 'status',
                'filter' => ['Available' => 'Available','Pending' => 'Pending','Confirmed' => 'Confirmed','Completed' => 'Completed', 'Cancelled' => 'Cancelled'],
            ],
            //'doctor_prescription:ntext',
            // 'next_follow_up_date',
            //'created_at',
            //'modified_at',

            // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',//{update}
                'template' => '{add}',
                'buttons' => [
                    'delete' => function ($url, $searchModel) {
                        if ($searchModel->status != 'Cancelled') {
                           return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['title' => 'Delete', 'data-pjax' => '0','data-confirm'=>'Are you sure you want to cancelled this appointment?', 'data-method'=>'post']);
                        }
                    },
                    'add' => function($url, $model) {
                        // echo "<pre>"; print_r(Yii::$app->user);
                        if ($model->status == 'Confirmed') {
                            $options = [
                                'title' => 'Patient Follow up Data',
                                'aria-label' => 'Patient Follow up Data',
                            ];
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                        } 
                        return '';
                    },
                    'download' => function ($url, $data, $key) {
                        return " -Download- ";
                        // if ($data->status === PacketTracer::STATUS_FAILED) {
                        //     $url = Url::toRoute(['/operations/packet-tracer/retry', 'id' => (string) $data->_id]);
                        //     return Html::a('<br/><span class="glyphicon glyphicon glyphicon-repeat" aria-hidden="true"></span><br/>', $url, ['title' => 'Retry']);
                        // } else if ($data->status === PacketTracer::STATUS_COMPLETE) {
                        //     $url = Url::toRoute(['/operations/packet-tracer/download-pcap-file', 'id' => (string) $data->_id]);
                        //     return Html::a('<br/><span class="glyphicon glyphicon-download" aria-hidden="true"></span><br/>', $url, ['title' => 'Download']);
                        // }
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
