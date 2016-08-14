<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\food\Video */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="video-form">

    <?php $form = ActiveForm::begin([ 'options' => [ 'enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'video')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model,'image')->fileInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <label>商品图</label>
            <input type="text" class="form-control" name="image" placeholder="请输入图片路径" value="<?php echo $model->image?>">
        </div>

    </div>
    <br/>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'describe')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'isDelete')->dropDownList([0=>'未删除',1=>'已删除']) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
