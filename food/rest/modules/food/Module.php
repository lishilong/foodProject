<?php

namespace rest\modules\food;

class Module extends \yii\base\Module
{


    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }
}
