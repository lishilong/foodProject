<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Assignment */

$this->title = Yii::t('rbac-admin', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-index">

    <p>
        <?= Html::a('创建用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    Pjax::begin([
        'enablePushState' => true,
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn','header'=>'ID'],
            'id',
            [
                'class' => 'yii\grid\DataColumn',
                'label'=>'用户',
                'attribute' => $usernameField,
            ],
            [
                'label' => '状态',
                'value' => function ($m) {
                    return $m->status == 10 ? "启用" : "停用";
                }
            ],


            [
                'label' => '创建时间',
                'value' => function ($m) {
                    return Yii::$app->formatter->format($m->created_at, ['datetime', "yyyy-MM-dd HH:mm:ss"]);
                }
            ],
            [
                'class' => 'kartik\grid\ActionColumn','header'=>'操作',
                'template' => '{view} {update} {disable}',
                'buttons' => [
                    'disable' => function ($url, $model, $key) {
                        $options = [
                            'title' => '启用/停用',
                            'aria-label' => '启用/停用',
                            'data-pjax' => '0',
                            'onclick' => "disableUser(this);return false;"
                        ];
                        return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', $url, $options);
                    },

                ]
            ],
        ],
    ]);
    Pjax::end();
    ?>

</div>

<script type="text/javascript">
    function disableUser(obj) {
        $.ajax({
            'url': obj.href, 'cache': false,
            'success': function (json) {
                if(json.success==true)
                {
                    window.location.reload(true);
                }
            }
        });
        return false;
    }


</script>
