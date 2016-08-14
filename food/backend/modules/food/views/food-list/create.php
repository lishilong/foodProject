<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\food\FoodList */

$this->title = '创建菜单';
$this->params['breadcrumbs'][] = ['label' => '菜单列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-list-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
