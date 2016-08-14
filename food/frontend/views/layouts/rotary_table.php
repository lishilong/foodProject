<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
p2made\assets\SweetAlertAsset::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="icon" href="<?= Yii::$app->getRequest()->getBaseUrl() ?>/images/bitbug_favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>凌云美食--猜饭</title>
    <link href="<?= Yii::$app->getRequest()->getBaseUrl() ?>/style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?= Yii::$app->getRequest()->getBaseUrl() ?>/js/jquery-1.10.2.js"></script>
    <?php $this->head() ?>
</head>
<body style="overflow-x: hidden; background: rgb(230, 45, 45);width: 35%;">
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
