<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\food\FoodList */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '菜单列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="food-list-index">


    <p>
        <?= Html::a('创建菜单', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','header'=>'ID'],
            [
                'format' => 'raw',
                'attribute' => 'id',
                'value' => function ($m) {
                    return Html::a($m->id, ['detailed-list/index','DetailedList[foodListId]'=>$m->id], ['title' => '子菜单']);
                }
            ],
            'foodName',
            [
                'attribute'=>'image',
                'format' => ['image',['width'=>'60','height'=>'60',]],
                'value'=>function($data) { if($data->image){return $data->image ;} return '' ; },
            ],
             'total',
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
