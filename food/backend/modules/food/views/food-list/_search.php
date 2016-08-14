<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\food\FoodList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'foodName') ?>

    <?= $form->field($model, 'img') ?>

    <?= $form->field($model, 'createTime') ?>

    <?= $form->field($model, 'updateTime') ?>

    <?php // echo $form->field($model, 'isDelete') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'creater') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
