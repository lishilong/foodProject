<?php

namespace tests\codeception\frontend\unit;

/**
 * @inheritdoc
 */
class DbTestCase extends \yii\codeception\DbTestCase
{
    public $appConfig = '@tests/codeception/config/rest/unit.php';
}
