<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\food\FoodDetailedList */

$this->title = '创建菜名';
$this->params['breadcrumbs'][] = ['label' => '菜名列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-detailed-list-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
