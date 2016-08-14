<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\food\FoodDetailedList */

$this->title = '更显菜单: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '菜单列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="food-detailed-list-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
