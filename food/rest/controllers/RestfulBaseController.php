<?php
/**
 * restful 基类
 * Created by PhpStorm.
 * User: yangjie
 * Date: 16/7/8
 * Time: 下午7:35
 */

namespace rest\controllers;


use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\Controller;

class RestfulBaseController   extends Controller
{


    public function behaviors()
    {
        return [
//            'authenticator' => [
//                'class' => CompositeAuth::className(),
//                'authMethods' => [
//                    QueryParamAuth::className(),
//                ],
//            ],

            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    // 允许认证用户
                    [
                        'allow' => true,
                        'roles' => ['?'],
                        'ips'=>['192.168.*.*','127.0.0.1'],
                    ],

                ],
            ],

        ];
    }

}