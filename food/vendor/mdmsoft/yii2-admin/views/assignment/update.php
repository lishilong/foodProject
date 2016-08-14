<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = '重置密码';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <p>请设置新密码:</p>
    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <div class="form-group">
        <?php
        echo Html::submitButton(Yii::t('rbac-admin', 'Update'), [
            'class' => 'btn btn-primary',])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
