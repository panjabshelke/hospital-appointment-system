<?php

use backend\models\DoctorAvailability;
use kartik\date\DatePicker;
use kartik\date\DatePickerAsset;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DoctorAvailability */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-detail-form">

    <div class="row">
        <div class="col-md-3">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'doctor_id')->dropDownList($activeDoctors, [ ]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'branch_id')->dropDownList($activeBranches, [ ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?=  $form->field($model, 'available_from')->widget(
                DateTimePicker::className(),
                [
                    'size'=>'md',
                    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        // 'format' => 'yyyy-mm-dd hh:ii',
                        'autoclose' => true,
                        'startDate'=> date('F d, Y  H:i:s A',time()),
                        // Dec 9, 2020 11:55:00 PM
                    ],
                ]);
            // DatePicker::widget([
            //     'name' => 'from_date',
            //     'id' => 'from_date',
            //     'value' => Yii::$app->request->post('from_date'),
            //     'pluginOptions' => [
            //         'autoclose' => true,
            //         'format' => 'yyyy-mm-dd',
            //         'todayHighlight' => true
            //     ]
            // ])
            ?>
        </div>
        <div class="col-md-3">
        <?=  $form->field($model, 'available_upto')->widget(
                DateTimePicker::className(),
                [
                    'size'=>'md',
                    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        // 'format' => 'yyyy-mm-dd hh:ii',
                        'autoclose' => true,
                        'startDate'=> date('d-m-Y H:i:s',time()),
                    ],
                ]);
            ?>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'status')->dropDownList(DoctorAvailability::DOCTOR_AVAILABILITY_STATUS, [
                'active' => 'Active', 'class' => 'form-control input-sm',
                ['disabled' => ($model->isNewRecord) ? 'disabled' : false]
            ]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>