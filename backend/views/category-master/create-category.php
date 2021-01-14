<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CategoryMaster */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Create Category';
$this->params['breadcrumbs'][] = ['label' => 'Category Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-master-create">

    <div class="category-master-form col-md-6">

        <?php $form = ActiveForm::begin(); ?>

        <!-- <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div> -->
        
        <?php echo $form->field($model, 'parent_id')->dropDownList(
                        $categoryData,
                        ['prompt'=>'Primary...', 'class'=>'form-control form-control-lg',]
                    ); 
        ?>
        <?= $form->field($model, 'category_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->dropDownList($categoryStatus, [ 'active' => 'Active', 'class'=>'form-control input-sm',
['disabled' => ($model->isNewRecord) ? 'disabled' : false] ]) ?>

        <div class="form-group">
            <?= Html::submitButton(($model->isNewRecord) ? 'Save' : 'Update', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>