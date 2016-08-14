<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\food\Video */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '视频';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-index">
    <p>
        <?= Html::a('添加视频', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','header'=>'ID'],

            'id',
            'video',
            'describe',
            [
                'attribute'=>'image',
                'format' => ['image',['width'=>'60','height'=>'60',]],
                'value'=>function($data) { if($data->image){return $data->image ;} return '' ; },
            ],
            [
                'format' => 'raw',
                'label' => '状态',
                'attribute' => 'isDelete',
                'filter' =>[0=>"未删除",1=>"已删除",],
                'value' => function ($m) {
                    return $m->isDelete == 0 ? "未删除" : "已删除";
                }
            ],

            ['class' => 'kartik\grid\ActionColumn','header'=>'操作',  'template' => '{update}{delete}',],
        ],
    ]); ?>

</div>
