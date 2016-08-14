<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\food\Video */

$this->title = '更新视频: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '视频列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="video-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
