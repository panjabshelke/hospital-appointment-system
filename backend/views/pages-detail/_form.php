<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PagesDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-detail-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php echo $form->field($model, 'title')->dropDownList(
                        $activePages,
                        ['class'=>'form-control form-control-lg',]
                    )->label('Page Title'); 
        ?>
    
    <?= $form->field($model, 'description')->textarea(['rows' => 3])->widget(CKEditor::className()) ?>
          
    <?= $form->field($model, 'page_image')->fileInput(['rows' => 6, 'multiple' => TRUE]) ?>
    
    <?= $form->field($model, 'status')->dropDownList($categoryStatus, [ 'active' => 'Active', 'class'=>'form-control input-sm',
['disabled' => ($model->isNewRecord) ? 'disabled' : false] ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
