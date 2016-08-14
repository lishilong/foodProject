<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\food\Video */

$this->title = '添加视频';
$this->params['breadcrumbs'][] = ['label' => '视频列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
