<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PatientAppointmentDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Patient Appointment Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-appointment-details-index">
    <p>
        <?= Html::a('Book Appointment', ['doctor-availability/book-appointment'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?php //  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'doctor_availability_id',
            // 'doctor_id',
            // 'branch_id',
            'doctor_name',
            'branch_name',
            'patient_name',
            'patient_contact_no',
            // 'available_date',
            [
                'attribute' => 'available_date',
                'filter' => DatePicker::widget([
                    'model'=>$searchModel,
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'attribute'=>'available_date',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd'
                    ],
                ]),
                'format' => 'html',
            ],
            'available_time_slot',
            //'slot_type',
            // 'booking_status',
            //'appointment_category',
            [
                'attribute' => 'status',
                'filter' => ['Available' => 'Available','Pending' => 'Pending','Confirmed' => 'Confirmed','Completed' => 'Completed', 'Cancelled' => 'Cancelled'],
            ],
            //'created_at',
            //'modified_at',

            // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',//{update}
                'template' => '{confirmed} {revert-confirm} &nbsp; {view}  {delete}',
                'buttons' => [
                    'delete' => function ($url, $searchModel) {
                        $url = Url::toRoute(['/patient-appointment-details/delete', 'id' => $searchModel['id']], true);
                        if ($searchModel['status'] != 'Cancelled' && $searchModel['status'] != 'Completed') {
                           return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['title' => 'Delete', 'data-pjax' => '0','data-confirm'=>'Are you sure you want to cancelled this appointment?', 'data-method'=>'post']);
                        }
                    },
                    'view' => function($url, $model) {
                        $options = [
                            'title' => 'View',
                            'aria-label' => 'View',
                        ];
                        $url = Url::toRoute(['/patient-appointment-details/view', 'id' => $model['id']], true);
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                    },
                    'confirmed' => function($url, $model) {
                        $options = [
                            'title' => 'Confirm',
                            'aria-label' => 'Confirm',
                            'data-confirm' => 'Are you sure you want to confirm this appointment?',
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        if ($model['status'] == 'Pending') {
                            $url = Url::toRoute(['/patient-appointment-details/confirmed', 'id' => $model['id']], true);
                            return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, $options);
                        }
                        return '';
                    },
                    'revert-confirm' => function($url, $model) {
                        $options = [
                            'title' => 'Cancel-Confirmed',
                            'aria-label' => 'Cancel-Confirmed',
                            'data-confirm' => 'Are you sure you want to cancel confirmed this appointment?',
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        if ($model['status'] == 'Confirmed') {
                            $url = Url::toRoute(['/patient-appointment-details/revert-confirm', 'id' => $model['id']], true);
                            return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, $options);
                        }
                        return '';
                    },
                    'download' => function ($url, $data, $key) {
                        return " -Download- ";
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

