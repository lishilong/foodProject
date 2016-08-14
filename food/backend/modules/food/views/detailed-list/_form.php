<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\food\FoodDetailedList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-detailed-list-form">

    <?php $form = ActiveForm::begin([ 'options' => [ 'enctype' => 'multipart/form-data']]);?>

    <div class="row">
        <div class="col-sm-2">
            <?=$form->field($model, 'foodListId')->widget(Select2::classname(),['data'=>ArrayHelper::map(\backend\models\food\FoodList::find()->where(['isDelete' => 0])->all(),'id','foodName')]);?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'isDelete')->dropDownList([0=>'未删除',1=>'已删除']) ?>
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
    <div class="form-group">
        <?= Html::Button($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $("#button").click(function(){
        name=$("#foodlist-foodname").val();
        if(name == '' || name == null){
            swal("Error!",'菜单必填', "error");
            return;
        }

        $("#w0").submit();
    });
</script>
