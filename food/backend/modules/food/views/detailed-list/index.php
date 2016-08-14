<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\food\DetailedList */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '菜单详细列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-detailed-list-index">
    <p>
        <?= Html::a('创建菜名', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','header'=>'ID'],

            'id',
            [
                'format' => 'raw',
                'attribute' => 'foodListId',
                'value' => function ($m) {
                    return Html::a($m->foodListId, ['food-list/index','FoodList[id]'=>$m->foodListId], ['title' => '主菜单']);
                }
            ],
            'name',
            [
                'attribute'=>'image',
                'format' => ['image',['width'=>'60','height'=>'60',]],
                'value'=>function($data) { if($data->image){return $data->image ;} return '' ; },
            ],
            [
                'format' => 'raw',
                'label' => '创建人',
                'attribute' => 'creater',
                'value' => function ($m) {
                    return \common\models\food\User::find()->where(['id' => $m->creater])->one()->username;
                }
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
