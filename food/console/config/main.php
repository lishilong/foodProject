<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'zh-CN',
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@nineinchnick/nfy' => '@vendor/nineinchnick/yii2-nfy',
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'view' => [
            'renderers' => [
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    'cachePath' => '@runtime/Twig/cache',
                    'options' => [
                        'auto_reload' => true,
                    ],
                ],
            ],
        ],
    ],
    'controllerMap' => [
        'build-rest-doc' => [
            'class' => '\pahanini\restdoc\controllers\BuildController',
            'sourceDirs' => ['@rest/modules/v2/controllers', ],
            'template' => 'restdoc\restdoc.twig',
            'targetFile' => 'console/views/build-rest-doc/restdoc/restdoc.html',
        ],
    ],

    'params' => $params,

];
