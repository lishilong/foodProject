<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="icon" href="<?= Yii::$app->getRequest()->getBaseUrl() ?>/images/bitbug_favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>凌云美食</title>
    <link rel="stylesheet" type="text/css" media="all" href="<?=Yii::$app->getRequest()->getBaseUrl() ?>/css/base.css"/>
    <link rel="stylesheet" type="text/css" media="all" href="<?= Yii::$app->getRequest()->getBaseUrl() ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" media="all" href="<?= Yii::$app->getRequest()->getBaseUrl() ?>/css/index.css"/>
    <script type="text/javascript" src="<?= Yii::$app->getRequest()->getBaseUrl() ?>/css/j.m.js"></script>
    <script type="text/javascript" src="<?=Yii::$app->getRequest()->getBaseUrl() ?>/css/main.js?v=1507"></script>
    <script type="text/javascript" src="<?= Yii::$app->getRequest()->getBaseUrl() ?>/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?= Yii::$app->getRequest()->getBaseUrl() ?>/echarts/echarts.js"></script>
    <script>
        require.config({
            paths: {echarts:"<?=Yii::$app->getRequest()->getBaseUrl() ?>"+'/echarts'}
        });
    </script>
    <?php $this->head() ?>
</head>
<body style="background: #fae8c8">
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
